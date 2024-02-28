<?php

// database/migrations/xxxx_xx_xx_create_pedidos_table.php
// database/migrations/xxxx_xx_xx_create_pedidos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ficha')->constrained(); // Agregamos constrained para indicar la clave foránea
            $table->foreignId('profesor')->constrained(); // Agregamos constrained para indicar la clave foránea
            // Otros campos según tus necesidades
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
