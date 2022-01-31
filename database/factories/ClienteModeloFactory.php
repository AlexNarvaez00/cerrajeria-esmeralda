<?php

namespace Database\Factories;

use App\Models\clienteModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteModeloFactory extends Factory
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
        $number = $this->faker->ean8();
        $llavePrimaria = 'CLI-'.
                        $this->faker->buildingNumber().'-'.
                        $this->faker->buildingNumber().'-'.
                        $this->faker->randomLetter();
                        
        while(clienteModelo::find($llavePrimaria) != null){
            $llavePrimaria = 'CLI-'.
                        $this->faker->buildingNumber().'-'.
                        $this->faker->buildingNumber().'-'.
                        $this->faker->randomLetter();
        }


        return [
            "idcliente" => $llavePrimaria,
            "nombre" => $this->faker->name('female'),
            "apellidoPaterno" => $this->faker->lastName(),
            "apellidoMaterno" => $this->faker->lastName(),
            "telefono" => $number
        ];
    }
}
