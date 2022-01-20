<?php

namespace Database\Factories;

use App\Models\clienteModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = clienteModelo::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = $this->faker->randomDigit() . ''
            . $this->faker->randomDigit() . ''
            . $this->faker->randomDigit() . ''
            . $this->faker->randomDigit();
        return [
            "idcliente" => 'CLI-' . date("H:i:s"),
            "nombre" => $this->faker->name('female'),
            "apellidoPaterno" => $this->faker->lastName(),
            "apellidoMaterno" => $this->faker->lastName(),
            "telefono" => $number
        ];
    }
}
