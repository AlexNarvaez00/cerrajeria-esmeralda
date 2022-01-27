<?php

namespace Database\Factories;

use App\Models\direccionModelo;
use App\Models\proveedorModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorModeloFactory extends Factory
{
    public $listDirecciones;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = proveedorModelo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->listDirecciones = direccionModelo::all();
        $limite = $this->listDirecciones->count();
        if ($limite > 0)
            $limite--;
        $id = $this->listDirecciones[$this->faker->numberBetween(0, $limite)]->iddireccion;

        $llavePrimaria = 'PRO-' .
            $this->faker->buildingNumber() . '-' .
            $this->faker->randomLetter() .
            $this->faker->randomLetter();

        while (proveedorModelo::find($llavePrimaria) != null) {
            $llavePrimaria = 'PRO-' . date('His') . '-' .
                $this->faker->buildingNumber() . '-' .
                $this->faker->randomLetter() .
                $this->faker->randomLetter();
        }

        return [
            "idproveedor" => $llavePrimaria,
            "nombre" => $this->faker->name("female"),
            "apellidopaterno" => $this->faker->lastName(),
            "apellidomaterno" => $this->faker->lastName(),
            "correo" => $this->faker->email(),
            "iddirecproveedor" => $id
        ];
    }
}
