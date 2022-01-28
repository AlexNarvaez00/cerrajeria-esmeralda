<?php

namespace Database\Factories;

use App\Models\clienteModelo;
use App\Models\User;
use App\Models\ventaModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VentaModeloFactory extends Factory
{

    public $listCliente;
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
        $this->listCliente = clienteModelo::all();
        $folio_v = 'FOL-'.$this->faker->regexify('[A-Z0-9]{15}');

        $listCliente = clienteModelo::all();

        $limiteCliente = ($listCliente->count() > 0 )?
                                $listCliente->count()-1 : 
                                $listCliente->count();   

        $idCliente = $listCliente[$this->faker->numberBetween(0,$limiteCliente)]
                                    ->idcliente;
        return [
            "folio_v" => $folio_v,
            "fechayhora" => $this->faker->dateTime('America/Mexico_City'),
            "idusuario" => User::all()[0]->id,
            "idclienteventa" => $idCliente
        ];
    }
}
