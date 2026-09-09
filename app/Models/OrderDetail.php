<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'pedido_id', 'producto_id', 'cantidad', 'precio_usd', 'precio_mxn'
    ];
    
    public function product()
    {
        // Relación con el producto asociado a este detalle
        return $this->belongsTo(Product::class, 'producto_id');
    }
}
