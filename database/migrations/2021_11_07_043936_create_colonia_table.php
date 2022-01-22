<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/** 
* Cracion dela tabla Municipio.
*
*/
class CreateColoniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        | ---------------------------------------------------------------------
        |   Diccionario | Tabla de "colonia".
        | ---------------------------------------------------------------------
        | idcolonia     -> Llave primaria d ela tabla en la base de datos.
        | nombre        -> Nombre de la colonia.
        | codigopostal  -> Codigo postal
        | idmunicol     -> ID del municipio al que pertenece.
        |
        */
        Schema::create('colonia', function (Blueprint $table) {
            $table->increments('idcolonia');
            $table->string('nombre', 60);
            $table->integer('codigopostal');
            $table->integer('idmunicol')->unsigned();
            
            
            $table->foreign('idmunicol')->references('idmunicipio')->on('municipio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colonia');
    }
}
