<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/** 
* Cracion dela tabla estados.
*
*/
class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
        | ----------------------------------------------------
        |   Diccionario | Tabla de "estados". 
        | ----------------------------------------------------
        | id    -> Llave primaria de la tabla.
        | nombre -> Nombre dle estado 
        |
        */
        Schema::create('estados', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nombre', 40);
            
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
