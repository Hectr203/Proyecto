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
        
        try {
            return \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl(
                $this->imagen, now()->addMinutes(60)
            );
        } catch (\Exception $e) {
            return null;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
