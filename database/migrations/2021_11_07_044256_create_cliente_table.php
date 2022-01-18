<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        | -------------------------------------------------------
        |   Diccionario | Tabla de "Cliente".
        | -------------------------------------------------------
        | 
        | idcliente         -> Llave primaria de la tablla en la base de datos. 
        | nombre            -> Nombre del cliente.
        | apellidoPaterno   -> Apellido del cliente (Paterno).
        | apellidoMaterno   -> Apellido del cliente (Materno).
        | telefono          -> Telefono del cliente.
        |
        */
        Schema::create('cliente', function (Blueprint $table) {
            $table->string('idcliente',20);
            $table->string('nombre',30);
            $table->string('apellidoPaterno',30);
            $table->string('apellidoMaterno',30);
            $table->string('telefono',15);
            $table->primary('idcliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
