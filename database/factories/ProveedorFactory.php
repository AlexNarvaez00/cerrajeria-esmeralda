<?php

namespace Database\Factories;

use App\Models\direccionModelo;
use App\Models\proveedorModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    public $listDirecciones;
    public function __constructor(){
        $this->listDirecciones = direccionModelo::all(); 
    }
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
        $id = $this->listDirecciones[$this->numberBetween(0,$this->listDirecciones->count())]->iddireccion;

        return [
            "idproveedor" => 'PRO-'.date("H:i:s"),
            "nombre"=>$this->faker->name("female"),
            "apellidopaterno"=>$this->faker->lastName(),
            "apellidomaterno"=>$this->faker->lastName(),
            "correo"=>$this->faker->email(),
            "iddirecproveedor"=>$id
        ];
    }
}
