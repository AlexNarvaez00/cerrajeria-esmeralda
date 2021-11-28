<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuariosModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idusuario' => $this->faker->text(7),
            'nombreUsuario'=> $this->faker->text(10),
            'contrasena' => $this->faker->text(10),
            'idjefe'=> $this->faker->text(7),
        ];
    }
}
