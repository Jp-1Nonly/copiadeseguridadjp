<?php

// app/Models/Pedido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'ficha',
        'profesor',
        'otros_campos', // Agrega otros campos según tus necesidades
    ];



    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }


    public function ficha()
    {
        return $this->belongsTo(Ficha::class, 'ficha_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'ficha_id');
    }

    
}
