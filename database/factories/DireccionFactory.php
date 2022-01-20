<?php

namespace Database\Factories;

use App\Models\coloniaModelo;
use App\Models\direccionModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DireccionFactory extends Factory
{

    private $limiteNumber;
    
    public function __construct(){
        $this->limiteNumber = coloniaModelo::count();
    }

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
        return [
            "iddireccion" => 'DIC-'.$this->faker->regexify('[A-Z0-9]{5}').'-'.date("H:i:s"),
            "calle"=> $this->faker->text(30),
            "numero" =>$this->faker->randomDigit(),
            "idcoldirec" => $this->faker->numberBetween(0,$this->limiteNumber)
        ];
    }
}
