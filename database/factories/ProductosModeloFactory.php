<?php

namespace Database\Factories;

use App\Models\productosModelo;
use App\Models\proveedorModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosModeloFactory extends Factory
{
    public $listProveedores;

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
        $this->listProveedores = proveedorModelo::all();
        $limite = $this->listProveedores->count();
        if($limite>0){
            $limite--;
        }
        $idProveedor = $this->listProveedores[
                            $this->faker->numberBetween(0,$limite)
                        ]->idproveedor;


        $precioCompra = $this->faker->randomDigit();
        $cantidad_existencia = $this->faker->randomDigit();
        $llavePrimaria = 'PRDC-' .$this->faker->regexify('[A-Z0-9]{5}');
            
        while (productosModelo::find($llavePrimaria) != null) {
            $llavePrimaria = 'PRDC-' .
                $this->faker->buildingNumber().
                $this->faker->randomLetter();
        }



        return [
            "clave_producto" => $llavePrimaria,
            "nombre_producto" => $this->faker->firstNameFemale(),
            "clasificacion" => $this->faker->word(),
            "precio_producto" => $precioCompra * 2.3,
            "precio_compra" => $precioCompra ,
            "cantidad_existencia" => $cantidad_existencia,
            "cantidad_stock" => $cantidad_existencia + 5,
            "idproveedor" => $idProveedor
        ];
    }
}
