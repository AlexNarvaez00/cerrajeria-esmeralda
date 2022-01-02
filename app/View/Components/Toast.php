<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    /**
     * Atributos
     * 
     */
    public $tituloNotificacion;
    public $tiempo;
    public $nombreProducto;
    public $conclusion;
    public $producto;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tituloNotificacion, $tiempo, $nombreProducto,$conclusion,$producto)
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
