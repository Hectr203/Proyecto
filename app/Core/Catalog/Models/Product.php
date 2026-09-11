<?php

namespace App\Core\Catalog\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    // Definimos los campos que se pueden guardar de forma masiva
    protected $fillable = [
        'sku', 'nombre', 'descripcion_corta', 'descripcion_larga',
        'precio_usd', 'precio_mxn', 'imagen', 'stock', 'fecha_vigencia', 'activo', 'category_id', 'metrics'
    ];

    protected $appends = ['image_url'];

    protected function casts(): array
    {
        return [
            'metrics' => 'array',
        ];
    }

    public function getImageUrlAttribute()
    {
        if (!$this->imagen) return null;
        
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }

        // Si la imagen todavía está en el directorio temporal local (el Job aún no termina)
        if (str_starts_with($this->imagen, 'temp_products/')) {
            return '/storage/' . $this->imagen;
        }
        
        try {
            return \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl(
                $this->imagen, now()->addMinutes(60)
            );
        } catch (\Exception $e) {
            return null;
        }
    }

    protected static function booted()
    {
        static::saved(function ($product) {
            try {
                $service = app(\App\Services\ElasticsearchService::class);
                $service->indexProduct($product);
            } catch (\Exception $e) {}
        });

        static::deleted(function ($product) {
            try {
                $service = app(\App\Services\ElasticsearchService::class);
                $service->deleteProduct($product);
            } catch (\Exception $e) {}
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
