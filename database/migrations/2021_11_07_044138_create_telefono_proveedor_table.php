<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonoProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefono_proveedor', function (Blueprint $table) {
            $table->string('idtelefono',20);
            $table->primary('idtelefono');
            $table->string('telefono',20);
            $table->string('idproveedor',15);
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefono_proveedor');
    }
}
