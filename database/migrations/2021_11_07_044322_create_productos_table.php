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
        Schema::create('productos', function (Blueprint $table) {
            $table->string('clave_producto',10);
            $table->string('nombre_producto',20);
            $table->string('clasificacion',20);
            $table->double('precio_producto',6,2);
            $table->integer('cantidad_existencia');
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
