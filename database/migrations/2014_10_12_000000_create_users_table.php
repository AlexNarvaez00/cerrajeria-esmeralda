<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        | ----------------------------------------------------------------------
        |   Diccionario | Usuarios
        | ----------------------------------------------------------------------
        | id -> Llave primaria de la tabala en la base de datos.
        | name -> Nombre del usuario.
        | password -> Contrseña para ingresar al sistema.
        | email -> Correo del usuario.
        | rol -> Rol que posee el usuario (Administrador, Empleado, Servicio).
        | timestamps -> "create_at" "update_at" Fecha de creacion y fecha de actualizacion.
        |        
        | rememberToken -> Campo utilizado por laravel.
        */
        Schema::create('users', function (Blueprint $table) {
            $table->string('id',15);
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('rol',15);
            $table->rememberToken();
            $table->timestamps();
            $table->primary('id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
