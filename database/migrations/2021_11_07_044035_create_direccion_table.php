<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/** 
* Cracion dela tabla Direccion.
*
*/
class CreateDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->string('iddireccion', 30);
            $table->string('calle', 80);
            $table->tinyInteger('numero');
            $table->string('idcoldirec', 20);    
            
            $table->primary('iddireccion'); 
            $table->foreign('idcoldirec')->references('idcolonia')->on('colonia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}
