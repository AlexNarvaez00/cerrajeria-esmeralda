<?php

namespace Database\Factories;

use App\Models\clienteModelo;
use App\Models\direccionModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    public $listDireccion;
    public $listCliente;

    public function __construct()
    {
        $this->listDireccion = direccionModelo::all();
        $this->listCliente = clienteModelo::all();
    }


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posicionLisDireccion = $this->faker->numberBetween(0, $this->listDireccion->count());
        $posicionLisCliente = $this->faker->numberBetween(0, $this->posicionLisCliente->count());


        return [
            "idservicio" => date("His"),
            "fechayhora" => date("Y-m-d"),
            "iddireccion" => $this->listDireccion[$posicionLisDireccion],
            "monto" => $this->faker->numberBetween(0,100),
            "descripcion" => $this->faker->text(10),
            "idcliente" => $this->listCliente[$posicionLisCliente]
        ];
    }
}
