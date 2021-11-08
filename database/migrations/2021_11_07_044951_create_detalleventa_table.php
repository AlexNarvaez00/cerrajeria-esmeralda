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
            $table->string('clave-producto',10);
            $table->string('folio_v',7);

            $table->foreign('clave-producto')->references('clave-producto')->on('productos');
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
