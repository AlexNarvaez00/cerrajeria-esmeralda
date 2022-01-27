<?php

namespace Database\Seeders;

use App\Models\direccionModelo;
use Illuminate\Database\Seeder;

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        direccionModelo::factory(100)->create();
    }
}
