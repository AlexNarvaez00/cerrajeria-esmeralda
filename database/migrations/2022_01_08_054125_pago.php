<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pago extends Migration
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
        |   Diccionario | Tabla de "pago".
        | ------------------------------------------------------------
        |
        | folio_v               -> Folio de la venta (llave foránea)
        | recibido              -> Pago en efectivo dado por el cliente 
        | total_pagar           -> Importe total a pagar
        | cambio                -> El cambio en efectivo que se extenderá al cliente
        |
         */
        Schema::create('pago', function (Blueprint $table) {
            $table->string('folio_v',30);
            $table->double('recibido',8,2);
            $table->double('total_pagar',8,2);
            $table->double('cambio',8,2);
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
        Schema::dropIfExists('pago');
    }
}
