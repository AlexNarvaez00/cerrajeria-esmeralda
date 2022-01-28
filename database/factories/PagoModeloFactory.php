<?php

namespace Database\Factories;

use App\Models\pagoModelo;
use App\Models\ventaModelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoModeloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = pagoModelo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //- ------------- Listas
        $listVenta = ventaModelo::all();
        //- ------------- Limites
        $limiteVenta = ($listVenta->count() > 0 )? 
                            $listVenta->count()-1 :
                            $listVenta->count();

        // ------------------- Objetos
        $venta = $listVenta[$this->faker->numberBetween(0,$limiteVenta )];                    

        
        
        $total = ventaModelo::select('productos.precio_producto')
        ->join('detalleventa','venta.folio_v','detalleventa.folio_v')
        ->join('productos','detalleventa.clave_producto','productos.clave_producto')
        ->where('venta.folio_v',$venta->folio_v)
        ->sum('productos.precio_producto');
        
        $recibido = $this->faker->numberBetween($total,$total+100);


        return [
            'folio_v' => $venta->folio_v,
            'recibido' => $recibido,
            'total_pagar' => $total ,
            'cambio' => $recibido-$total,
        ];
    }
}
