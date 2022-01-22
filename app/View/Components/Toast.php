<?php

namespace App\View\Components;


use App\Models\productosModelo;
use Illuminate\View\Component;

/**
 *  @author Narvaez Ruiz Alexis 
 */
class Toast extends Component
{
    /*
    | -------------------------------------------------------------
    |   Toast
    | -------------------------------------------------------------
    |   Esta clase recrea los elmentos toast de bootstrap
    |
    |
    */


    /**
     * Titulo del componente
     * 
     * @var string
     */
    public $tituloNotificacion;

    /**
     * Texto del tiempo "cuanto a transcurrido desde que se lanzo la notificación"
     * 
     * @var string
     */
    public $tiempo;

    /**
     * Nombre del producto que cumple la condicion para lanzar la notificación.
     * 
     * @var string
     */
    public $nombreProducto;

    /**
     * Conclusion - Indica cual es la situacion del producto 
     * -> Esta por terminarce 
     * -> El prodcuto se ha terminado
     * 
     * @var string
     */
    public $conclusion;


    /**
     * Objeto que contiene toda la informacion sobre el producto
     * 
     * @var productosModelo
     */
    public $producto;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tituloNotificacion, $tiempo, $nombreProducto, $conclusion, $producto)
    {
        $this->tituloNotificacion = $tituloNotificacion;
        $this->tiempo = $tiempo;
        $this->nombreProducto = $nombreProducto;
        $this->conclusion = $conclusion;
        $this->producto = $producto;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toast');
    }
}
