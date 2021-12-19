<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->id = 'USU-ADAD-181221';
        $admin->name = 'Adminstrador ROOT ';
        $admin->email = 'correo@correo.com';
        $admin->password = Hash::make('12345678');
        $admin->rol = 'Administrador'; 
        $admin->save();
        
        $this->call([
            estadosSeeder::class,
            municipiosSeeder::class,
            coloniasSeeder::class,
        ]);

        //\App\Models\User::factory(10)->create();
        //usuariosModel::factory(50)->create();
    }
}
