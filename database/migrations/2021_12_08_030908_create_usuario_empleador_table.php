<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioEmpleadorTable extends Migration
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
        |   Diccionario | Tabla de "usuario_empleador".
        | ------------------------------------------------------------
        |
        | idEmpleador           -> Llave primaria de la tabla en la base de datos.
        | idEmpleado            -> ID del empleado que hace uso del sistema
        |
         */
        Schema::create('usuario_empleador', function (Blueprint $table) {
            $table->string('idEmpleador',7);//El jefe
            $table->string('idEmpleado',7);//El empleado 
            $table->foreign('idEmpleador')->references('id')->on('users');
            $table->foreign('idEmpleado')->references('id')->on('users');
            $table->unique('idEmpleador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_empleador');
    }
}
