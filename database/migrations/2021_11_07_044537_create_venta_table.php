<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaTable extends Migration
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
        |   Diccionario | Tabla de "Venta".
        | ------------------------------------------------------------
        |
        | folio_v               -> Llave primaria de la tabla en la base de datos.
        | fechayhora            -> Fecha y hora en el que se realizo la venta
        | idusuario             -> ID del usuario que realizó la venta (Llave foranea)
        | idclienteventa        -> ID del cliente al que se le realiza la venta (llave foranea)
        |       
        */
        Schema::create('venta', function (Blueprint $table) {
            $table->string('folio_v',50);
            $table->dateTime('fechayhora', $precision = 0);
            $table->string('idusuario',15);

            $table->string('idclienteventa',20)->nullable();
            $table->primary('folio_v');
            $table->foreign('idusuario')->references('id')->on('users');
            $table->foreign('idclienteventa')->references('idcliente')->on('cliente');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
