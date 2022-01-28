<?php

namespace Database\Factories;

use App\Models\productosDescripcionModelo;
use App\Models\productosModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class productosDescripcionModeloFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = productosDescripcionModelo::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $listProdcutos = productosModelo::all();

        $limiteProductos = ($listProdcutos->count() > 0)?
                                $listProdcutos->count()-1 :
                                $listProdcutos->count();   
        $producto = $listProdcutos[$this->faker->numberBetween(0,$limiteProductos)];


        return [
            'descripcion' => $this->faker->text(100),
            'clave_producto' => $producto->clave_producto
        ];
    }
}
