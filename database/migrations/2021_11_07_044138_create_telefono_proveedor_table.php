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
        /*
        | --------------------------------------------------
        |   Diccionario | Tabla de "telefono_proveedor".
        | --------------------------------------------------
        | 
        | idtelefono    -> Llave primaria del tabla en la base de datos.
        | telefono      -> Telefono.
        | idproveedor   -> ID del proveedor (Llave foranea), con esta relacion se interpreta que el telefono 
        |                   le petenece a X proveedor.         
        */
        Schema::create('telefono_proveedor', function (Blueprint $table) {
            $table->string('idtelefono', 20);
            $table->primary('idtelefono');
            $table->string('telefono', 20);
            $table->string('idproveedor', 15);
            $table->foreign('idproveedor')->references('idproveedor')->on('proveedor');
            $table->softDeletes();
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
