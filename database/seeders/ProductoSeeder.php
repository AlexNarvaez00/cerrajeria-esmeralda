<?php

namespace Database\Seeders;

use App\Models\productosModelo;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        productosModelo::factory(50)->create();
    }
}
