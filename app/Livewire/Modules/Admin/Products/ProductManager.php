<?php

namespace App\Livewire\Modules\Admin\Products;

use App\Core\Catalog\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ProductManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    
    // Propiedades del formulario
    public $productId;
    public $sku, $nombre, $descripcion_corta, $descripcion_larga;
    public $precio_usd, $precio_mxn, $stock, $fecha_vigencia, $activo = true, $category_id;
    public $imagen;
    
    public $showModal = false;

    // Reinicia la paginación cuando se realiza una búsqueda
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'sku' => 'required|unique:products,sku,' . $this->productId,
            'nombre' => 'required|regex:/^[a-zA-Z0-9\s]+$/', // Validamos letras, números y espacios, sin caracteres especiales ni acentos
            'descripcion_corta' => 'required|string|max:255',
            'precio_usd' => 'required|numeric|gt:0',
            'precio_mxn' => 'required|numeric|gt:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'imagen' => 'nullable|image|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'nombre.regex' => 'El nombre no debe contener acentos ni caracteres especiales.',
            'precio_usd.gt' => 'El precio USD debe ser mayor a 0.',
            'precio_mxn.gt' => 'El precio MXN debe ser mayor a 0.',
            'sku.unique' => 'Este SKU ya se encuentra registrado.',
            'required' => 'Este campo es obligatorio.',
        ];
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        $this->productId = $product->id;
        $this->sku = $product->sku;
        $this->nombre = $product->nombre;
        $this->descripcion_corta = $product->descripcion_corta;
        $this->descripcion_larga = $product->descripcion_larga;
        $this->precio_usd = $product->precio_usd;
        $this->precio_mxn = $product->precio_mxn;
        $this->stock = $product->stock;
        $this->fecha_vigencia = $product->fecha_vigencia;
        $this->activo = $product->activo;
        $this->category_id = $product->category_id;
        $this->imagen = $product->imagen;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'sku' => $this->sku,
            'nombre' => $this->nombre,
            'descripcion_corta' => $this->descripcion_corta,
            'descripcion_larga' => $this->descripcion_larga,
            'precio_usd' => $this->precio_usd,
            'precio_mxn' => $this->precio_mxn,
            'stock' => $this->stock,
            'fecha_vigencia' => $this->fecha_vigencia,
            'activo' => $this->activo,
            'category_id' => $this->category_id,
        ];

        if ($this->imagen && !is_string($this->imagen)) {
            // Aseguramos que el contenedor exista antes de guardar
            try {
                $proxy = \MicrosoftAzure\Storage\Blob\BlobRestProxy::createBlobService(config('filesystems.disks.azure.connection_string'));
                $proxy->createContainer(config('filesystems.disks.azure.container'));
            } catch (\Exception $e) {
                // Si el contenedor ya existe (o hay otro error menor), ignoramos la excepción
            }

            $path = $this->imagen->store('/', 'azure');
            $data['imagen'] = $path;
        }

        Product::updateOrCreate(['id' => $this->productId], $data);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function toggleActivo($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['activo' => !$product->activo]);
    }

    private function resetInputFields()
    {
        $this->productId = null;
        $this->sku = '';
        $this->nombre = '';
        $this->descripcion_corta = '';
        $this->descripcion_larga = '';
        $this->precio_usd = '';
        $this->precio_mxn = '';
        $this->stock = 0;
        $this->fecha_vigencia = null;
        $this->activo = true;
        $this->category_id = null;
        $this->imagen = null;
    }

    public function render()
    {
        $products = Product::where('sku', 'like', '%' . $this->search . '%')
            ->orWhere('nombre', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('modules.Admin.Products.pages.index', [
            'products' => $products,
            'categories' => \App\Core\Catalog\Models\Category::all(),
            'exchangeRate' => \App\Core\Catalog\Services\ExchangeRateService::getUsdToMxnRate()
        ]);
    }
}
