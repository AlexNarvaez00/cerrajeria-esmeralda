<?php

namespace Database\Seeders;

use App\Models\detalleServicioModelo;
use Illuminate\Database\Seeder;

class DetalleServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        detalleServicioModelo::factory(300)->create();
    }
}
