<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentaTable extends Migration
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
        |   Diccionario | Tabla de "detalleVenta".
        | ------------------------------------------------------------
        |
        | observaciones         -> Observaciones realizadas a la venta en proceso
        | cantidad              -> Cantidad de productos que se están vendiendo
        | clave_producto        -> Clave del producto que se vendió (llave foránea) con esta relacion 
        |                          se interpreta que cada producto vendido llevará su respectiva clave
        | folio_v               -> Folio de la venta que se está realizando (llave foránea)
        | importe               -> Cantidad a pagar
        |
         */
        Schema::create('detalleventa', function (Blueprint $table) {
            $table->text('observaciones');
            $table->integer('cantidad');
            $table->string('clave_producto',10);
            $table->string('folio_v',30);
            $table->double('importe',8,2);

            $table->foreign('clave_producto')->references('clave_producto')->on('productos');
            $table->foreign('folio_v')->references('folio_v')->on('venta'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleventa');
    }
}
