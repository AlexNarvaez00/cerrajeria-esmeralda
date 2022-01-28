<?php

namespace Database\Seeders;

use App\Models\servicioModelo;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        servicioModelo::factory(100)->create();
    }
}
