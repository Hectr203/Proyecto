<?php

namespace App\Core\Checkout\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Catalog\Models\Product;

class OrderDetail extends Model
{
    protected $fillable = [
        'pedido_id', 'producto_id', 'cantidad', 'precio_usd', 'precio_mxn'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'pedido_id');
    }

    public function product()
    {
        // Relación con el producto asociado a este detalle
        return $this->belongsTo(Product::class, 'producto_id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }
}
