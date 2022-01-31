<?php

namespace Database\Seeders;

use App\Models\proveedorModelo;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        proveedorModelo::factory(4)->create();
    }
}
