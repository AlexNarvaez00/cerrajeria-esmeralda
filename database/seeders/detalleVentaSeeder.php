<?php

namespace Database\Seeders;

use App\Models\detalleVentaModelo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detalleVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        detalleVentaModelo::factory(300)->create();
    }
}
