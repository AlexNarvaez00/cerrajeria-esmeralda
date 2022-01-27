<?php

namespace Database\Seeders;

use App\Models\clienteModelo;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        clienteModelo::factory(100)->create();
    }
}
