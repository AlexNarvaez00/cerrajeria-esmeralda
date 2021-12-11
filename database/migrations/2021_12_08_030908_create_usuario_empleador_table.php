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
        Schema::create('usuario_empleador', function (Blueprint $table) {
            $table->string('idEmpleador',7);//El jefe
            $table->string('idEmpleado',7);//El empleado 
            $table->foreign('idEmpleador')->references('idusuario')->on('usuarios');
            $table->foreign('idEmpleado')->references('idusuario')->on('usuarios');
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
