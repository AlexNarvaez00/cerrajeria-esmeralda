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
