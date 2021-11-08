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
        Schema::create('servicio', function (Blueprint $table) {
            $table->string('idservicio',7);
            $table->dateTime('fechayhora', $precision = 0);
            $table->string('iddireccion',30);
            $table->double('monto',6,2);
            $table->string('descripcion',45);
            $table->string('idcliente',7);
            $table->string('clave-producto',10);
            $table->primary('idservicio');
            $table->foreign('clave-producto')->references('clave-producto')->on('productos');
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
