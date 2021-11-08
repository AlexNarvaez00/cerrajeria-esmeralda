<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleservicio', function (Blueprint $table) {
            $table->integer('cantidad');
            $table->double('total-productos',6,2);
            $table->string('observaciones',45);
            $table->string('clave-producto',10);
            $table->string('idservicio',7);
            $table->foreign('clave-producto')->references('clave-producto')->on('productos');
            $table->foreign('idservicio')->references('idservicio')->on('servicio');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleservicio');
    }
}