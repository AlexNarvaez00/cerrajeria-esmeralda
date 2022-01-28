<?php

namespace Database\Factories;

use App\Models\coloniaModelo;
use App\Models\direccionModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DireccionModeloFactory extends Factory
{

    private $limiteNumber;


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = direccionModelo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->limiteNumber = coloniaModelo::count();
        $llavePrimaria =  'DIC-' .
            date("His") . '-' .
            $this->faker->buildingNumber() . '-' .
            $this->faker->randomLetter();

        while (direccionModelo::find($llavePrimaria) != null) {
            $llavePrimaria =  'DIC-' .
                                date("His") . '-' .
                                $this->faker->buildingNumber() . '-' .
                                $this->faker->randomLetter();
        }

        return [
            "iddireccion" => $llavePrimaria,
            "calle" => $this->faker->text(30),
            "numero" => $this->faker->numberBetween(100,999),
            "idcoldirec" => $this->faker->numberBetween(1, $this->limiteNumber)
        ];
    }
}
