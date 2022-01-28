<?php

namespace Database\Factories;

use App\Models\detalleVentaModelo;
use App\Models\productosModelo;
use App\Models\ventaModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleVentaModeloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = detalleVentaModelo::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cantidad = $this->faker->randomDigit();

        // ------------------Listas
        $listVenta = ventaModelo::all();
        $listProductos = productosModelo::all();
        //------------------Limites
        $limiteListVenta = ($listVenta->count() > 0 )?
                                $listVenta->count()-1 :
                                $listVenta->count();
        $limiteListProductos = ($listProductos->count() > 0 )? 
                                        $listProductos->count()-1 : 
                                        $listProductos->count();


        // ---------------- Objetos                        
        $venta = $listVenta[$this->faker->numberBetween(0,$limiteListVenta)];
        $producto = $listProductos[$this->faker->numberBetween(0,$limiteListProductos)];

        return [
                'observaciones' => $this->faker->paragraph(),
                'cantidad' => $cantidad,
                'clave_producto' => $producto->clave_producto,
                'folio_v' => $venta->folio_v,
                'importe' => $producto->precio_producto * $cantidad
        ];
    }
}
