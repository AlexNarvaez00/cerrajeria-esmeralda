<?php

namespace Database\Seeders;

use App\Models\pagoModelo;
use Illuminate\Database\Seeder;

class PagoModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pagoModelo::factory(100)->create();
    }
}
