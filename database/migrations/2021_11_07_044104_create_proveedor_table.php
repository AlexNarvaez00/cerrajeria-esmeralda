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
        /*
        | ---------------------------------------------------------------
        |   Diccionario | Tabla de "proveedor".
        | ---------------------------------------------------------------
        | 
        | idproveedor       -> Llave primaria de la tabla en la base de datos.
        | nombre            -> Nombre del proveedor 
        | apellidopaterno   -> Apellido del proeeedor (Materno)
        | apellidomaterno   -> Apellido del proeeedor (Peterno)
        | correo            -> Correo del proveedor.
        | iddirecproveedor  -> LLave foranea de la tabla direccion (La direccion del proveedor).
        |
        */
        Schema::create('proveedor', function (Blueprint $table) {
            $table->string('idproveedor', 15);
            $table->string('nombre', 50);
            $table->string('apellidopaterno', 50);
            $table->string('apellidomaterno', 50);
            $table->string('correo', 30);
            $table->string('iddirecproveedor', 30);
            $table->timestamps();
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
