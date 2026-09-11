<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Core\Catalog\Models\Product;
use Exception;

class UploadProductImageToAzure implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $productId;
    public $localPath;

    /**
     * Create a new job instance.
     */
    public function __construct($productId, $localPath)
    {
        $this->productId = $productId;
        $this->localPath = $localPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = Product::find($this->productId);
        if (!$product) {
            return;
        }

        if (!Storage::disk('public')->exists($this->localPath)) {
            Log::warning("El archivo local temporal no existe: " . $this->localPath);
            return;
        }

        // Definir la ruta final en Azure (cambiar temp_products por products)
        $azurePath = str_replace('temp_products/', 'products/', $this->localPath);
        $contents = Storage::disk('public')->get($this->localPath);

        try {
            // Estrategia optimista: subir a Azure
            Storage::disk('azure')->put($azurePath, $contents);
            
            // Actualizar DB y eliminar archivo temporal local
            $product->update(['imagen' => $azurePath]);
            Storage::disk('public')->delete($this->localPath);

        } catch (Exception $e) {
            // Si falla, intentamos crear el contenedor y volver a subir
            try {
                $proxy = \MicrosoftAzure\Storage\Blob\BlobRestProxy::createBlobService(config('filesystems.disks.azure.connection_string'));
                $proxy->createContainer(config('filesystems.disks.azure.container'));
                
                Storage::disk('azure')->put($azurePath, $contents);
                
                $product->update(['imagen' => $azurePath]);
                Storage::disk('public')->delete($this->localPath);
            } catch (Exception $e2) {
                Log::error('Error crítico al subir la imagen a Azure en Job: ' . $e2->getMessage());
                throw $e2; // Dejar que falle el Job para que la cola lo intente de nuevo
            }
        }
    }
}
