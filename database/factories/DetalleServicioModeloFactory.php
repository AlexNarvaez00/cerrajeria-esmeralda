<?php

namespace Database\Factories;

use App\Models\detalleServicioModelo;
use App\Models\productosModelo;
use App\Models\servicioModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleServicioModeloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = detalleServicioModelo::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $listServicios = servicioModelo::all(); 
        $listProductos = productosModelo::all();

        //limite
        $limiteServicio = ($listServicios->count()>0)?
                                $listServicios->count()-1 :      
                                $listServicios->count();

         $limiteProductos = ($listProductos->count()>0)?
                                $listProductos->count()-1 :      
                                $listProductos->count();
        //IDS
        $idServicio = $listServicios[$this->faker->numberBetween(0,$limiteServicio)]
                                ->idservicio;
        $idProducto = $listProductos[$this->faker->numberBetween(0,$limiteProductos)];

        //Cantidad = numero 
        //total precio = cantidad * precio del prodcuto.
        $cantidad = $this->faker->randomDigit();
        $total_productos = $cantidad * $idProducto->precio_compra;


        return [
            'cantidad' => $cantidad,
            'total_productos' =>$total_productos,
            'clave_producto' => $idProducto->clave_producto,
            'idservicio' => $idServicio
        ];
    }
}
