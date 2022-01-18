<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleServicioTable extends Migration
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
        |   Diccionario | Tabla de "DetalleServicio".
        | ------------------------------------------------------------
        |
        | cantidad              -> Llave primaria de la tabla en la base de datos.
        | total_productos       -> Cantidad total de los productos que se utilizaron en la realización del servicio
        | clave_producto        -> Clave del producto que se vendió (llave foránea) con esta relacion 
        |                          se interpreta que cada producto vendido llevará su respectiva clave
        | idservicio            -> ID sel servicio que se realizó (llave foránea)
        |
         */
        Schema::create('detalleservicio', function (Blueprint $table) {
            $table->integer('cantidad');
            $table->double('total_productos',6,2);            
            $table->string('clave_producto',10);
            $table->string('idservicio',7);
            $table->foreign('clave_producto')->references('clave_producto')->on('productos');
            $table->foreign('idservicio')->references('idservicio')->on('servicio');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleservicio');
    }
}
