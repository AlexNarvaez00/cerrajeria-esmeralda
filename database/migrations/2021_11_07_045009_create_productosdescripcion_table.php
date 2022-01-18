<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosDescripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         /*
        | ------------------------------------------------------------
        |   Diccionario | Tabla de "productodescripcion".
        | ------------------------------------------------------------
        |
        | descripcion           -> Descripción general del producto
        | clave_producto        -> Clave del producto que se vendió (llave foránea) 
        |
         */
        Schema::create('productodescripcion', function (Blueprint $table) {
            $table->text('descripcion');
            $table->string('clave_producto',10);
            $table->foreign('clave_producto')->references('clave_producto')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productodescripcion');
    }
}
