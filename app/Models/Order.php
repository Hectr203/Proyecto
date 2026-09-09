<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'folio', 'correo', 'subtotal', 'impuestos', 'total', 'estatus', 'fecha'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'pedido_id');
    }
}
