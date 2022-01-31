<?php

namespace Database\Factories;

use App\Models\proveedorModelo;
use App\Models\telefonoModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class telefonoModeloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = telefonoModelo::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $proveedores = proveedorModelo::all();
        $limiteVenta = ($proveedores->count() > 0) ?
            $proveedores->count() - 1 :
            $proveedores->count();
        $proveedor = $proveedores[$this->faker->numberBetween(0, $limiteVenta)];
        return [
            'idtelefono' =>  substr($this->faker->uuid(), 0, 20),
            'telefono' => $this->faker->tollFreePhoneNumber(),
            'idproveedor' => $proveedor->idproveedor
        ];
    }
}
