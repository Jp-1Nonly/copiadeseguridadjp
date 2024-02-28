<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detallepedidos';

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}