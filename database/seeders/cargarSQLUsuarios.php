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
<<<<<<< HEAD
            'idusuario' => 'USU-123',
=======
            'idusuario' => 'USU-124',
>>>>>>> 8ae31f5dea409573fc37e4262d4f8e2de93717b4
            'nombre-usuario' => 'Alexis',
            'contrasena' => 'contraseña',
            'idjefe' => '123',
        ]);


    }
}
