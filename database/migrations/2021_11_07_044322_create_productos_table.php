<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
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
        |   Diccionario | Tabla de "productos".
        | ------------------------------------------------------------
        |
        | clave_producto        -> Llave primaria de la tabla en la base de datos.
        | nombre_producto       -> Nombre del producto.
        | clasificacion         -> Clasificacion del prodcuto.
        | precio_producto       -> Precio del producto.
        | precio_compra         -> Precio de compra del producto.
        | cantidad_existencia   -> Cantidad en existencia del prodcuto.
        | cantidad_stock        -> Cantidad de stock del prodcuto
        | idproveedor           -> ID del proveedor (De que proveedor es el producto.)
        |
         */
        Schema::create('productos', function (Blueprint $table) {
            $table->string('clave_producto',10);
            $table->string('nombre_producto',20);
            $table->string('clasificacion',20);
            $table->double('precio_producto',6,2);
            $table->double('precio_compra',6,2);
            $table->integer('cantidad_existencia');
            $table->integer('cantidad_stock');
            $table->primary('clave_producto');
            $table->string('idproveedor',15);
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations c.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
