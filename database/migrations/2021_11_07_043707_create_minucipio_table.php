<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/** 
* Cracion dela tabla Municipio.
*
*/
class CreateMinucipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        | ------------------------------------------------------
        |   Diccionario | Tabla de "municipio".
        | ------------------------------------------------------
        | idmunicipio   -> Llave primaria de la tabla en la base de datos
        | nombre        -> Nombre del Municipio 
        | idestado      -> ID del estado al que pertenece.
        |
        |
        */
        Schema::create('municipio', function (Blueprint $table) {
            $table->increments('idmunicipio');
            $table->string('nombre', 100);
            $table->integer('idestado');
            
            //$table->primary('idmunicipio');
            $table->foreign('idestado')->references('id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipio');
    }
}
