<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->string('folio_v',7);
            $table->dateTime('fechayhora', $precision = 0);
            $table->string('idusuario',7);

            $table->string('idclienteventa');
            $table->primary('folio_v');
            $table->foreign('idusuario')->references('id')->on('users');
            $table->foreign('idclienteventa')->references('idcliente')->on('cliente');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
