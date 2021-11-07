<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * Clase para la creacion de la tabla proveedores.
 * 
*/
class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->string('idproveedor', 15);
            $table->string('nombre', 50);
            $table->string('apellidopaterno', 50);
            $table->string('apellidomaterno', 50);
            $table->string('correo', 30);
            $table->string('iddirecproveedor', 30);

            $table->primary('idproveedor');
                            //Nombre de la FK       Nombre PK tabla externa    nombre-tabla      
            $table->foreign('iddirecproveedor')->references('iddireccion')->on('direccion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
}
