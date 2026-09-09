<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    // Definimos los campos que se pueden guardar de forma masiva
    protected $fillable = [
        'sku', 'nombre', 'descripcion_corta', 'descripcion_larga',
        'precio_usd', 'precio_mxn', 'imagen', 'stock', 'fecha_vigencia', 'activo'
    ];
}
