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
        Schema::create('colonia', function (Blueprint $table) {
            $table->string('idcolonia', 20);
            $table->string('nombre', 60);
            $table->tinyInteger('codigopostal');
            $table->string('idmunicol', 10);
            
            $table->primary('idcolonia');
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
