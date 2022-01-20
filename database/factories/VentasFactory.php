<?php

namespace Database\Factories;

use App\Models\clienteModelo;
use App\Models\User;
use App\Models\ventaModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VentasFactory extends Factory
{

    public $listCliente;
    public function __construct()
    {
        $this->listCliente = clienteModelo::all();
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ventaModelo::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "folio_v" => 'FOL-' . date("H:i:s") . '-' . $this->faker->randomDigit(),
            "fechayhora" => date("Y-m-d"),
            "idusuario" => User::all()[0]->id,
            "idclienteventa" => $this->listCliente[$this->faker->numberBetween(0, $this->listCliente->count())]
        ];
    }
}
