<?php

namespace Database\Factories;

use App\Models\productosModelo;
use App\Models\proveedorModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    public $listProveedores;

    public function __construct()
    {
        $this->listProveedores = proveedorModelo::all();
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = productosModelo::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $precioCompra = $this->faker->randomDigit();
        $cantidad_existencia = $this->faker->randomDigit();
        return [
            "clave_producto" => "CLI-".$this->fake->randomLetter().date("H:i:s"),
            "nombre_producto" => $this->name('female'),
            "clasificacion" => $this->word(),
            "precio_producto" => $precioCompra,
            "precio_compra" => $precioCompra*2.3,
            "cantidad_existencia" => $cantidad_existencia,
            "cantidad_stock" => $cantidad_existencia+10,
            "idproveedor" => $this->listProveedores[
                $this->faker->listProveedores(0,$this->listProveedores->count())
                ]->idproveedor
        ];
    }
}
