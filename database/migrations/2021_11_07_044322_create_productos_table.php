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
            $table->string('clave-producto',10);
            $table->string('nombre-producto',20);
            $table->string('clasificacion',20);
            $table->double('precio-producto',6,2);
            $table->integer('cantidad-existencia');
            $table->primary('clave-producto');
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
