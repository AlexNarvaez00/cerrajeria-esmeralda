<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioTable extends Migration
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
        |   Diccionario | Tabla de "Servicio".
        | ------------------------------------------------------------
        |
        | idservicio            -> Llave primaria de la tabla en la base de datos.
        | fechayhora            -> Fecha y hora en el que se realizo la venta
        | iddirección           -> ID de la dirección donde se realizó el servicio (Llave foranea)
        | monto                 -> Monto que se cobró por el servicio
        | descripcion           -> Descripción y detalles del servicio que se realizó
        | idclientee            -> ID del cliente al que se le realiza la venta (llave foranea)
        |
         */
        Schema::create('servicio', function (Blueprint $table) {
            $table->string('idservicio',100);
            $table->dateTime('fechayhora', $precision = 0);
            $table->string('iddireccion',30);
            $table->double('monto',6,2);
            $table->tinyText('descripcion');
            $table->string('idcliente',20);            
            $table->primary('idservicio');            
            $table->foreign('iddireccion')->references('iddireccion')->on('direccion');
            $table->foreign('idcliente')->references('idcliente')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}
