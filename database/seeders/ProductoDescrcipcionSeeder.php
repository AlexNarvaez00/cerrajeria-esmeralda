<?php

namespace Database\Seeders;

use App\Models\productosDescripcionModelo;
use Illuminate\Database\Seeder;

class ProductoDescrcipcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        productosDescripcionModelo::factory(100)->create();
    }
}
