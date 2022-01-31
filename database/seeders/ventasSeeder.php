<?php

namespace Database\Seeders;

use App\Models\ventaModelo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ventasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ventaModelo::factory(100)->create();
    }
}
