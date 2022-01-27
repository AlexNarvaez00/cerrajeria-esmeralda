<?php

namespace Database\Factories;

use App\Models\clienteModelo;
use App\Models\direccionModelo;
use App\Models\servicioModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioModeloFactory extends Factory
{
    public $listDireccion;
    public $listCliente;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->listDireccion = direccionModelo::all();
        $limiteDireccion = ($this->listDireccion->count() > 0 )? 
                                $this->listDireccion->count() -1 : 
                                $this->listDireccion->count();

        $this->listCliente = clienteModelo::all();
        $limiteCliente = ($this->listCliente->count() > 0 )? 
                                $this->listCliente->count() -1 : 
                                $this->listCliente->count();

        $posicionLisDireccion = $this->faker->numberBetween(0, $limiteDireccion);
        $posicionLisCliente = $this->faker->numberBetween(0, $limiteCliente);

        $idServicio = 'SR-'.
                            $this->faker->regexify('[A-Z0-9]{4}');
        while(servicioModelo::find($idServicio) != null){
            $idServicio = 'SR-'.
                        $this->faker->regexify('[A-Z0-9]{4}');  
        }


        return [
            "idservicio" => $idServicio,
            "fechayhora" => $this->faker->dateTime('America/Mexico_City'),
            "iddireccion" => $this->listDireccion[$posicionLisDireccion],
            "monto" => $this->faker->numberBetween(100,1000),
            "descripcion" => $this->faker->text(10),
            "idcliente" => $this->listCliente[$posicionLisCliente]->idcliente
        ];
    }
}
