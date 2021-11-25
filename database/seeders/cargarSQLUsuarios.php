<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cargarSQLUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuarios')->insert([
            'idusuario' => 'USU-123',
            'nombre-usuario' => 'Alexis',
            'contrasena' => 'contraseña',
            'idjefe' => '123',
        ]);


    }
}
