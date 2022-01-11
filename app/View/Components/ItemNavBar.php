<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 */
class ItemNavBar extends Component
{
    /*
        | --------------------------------------------------------------
        |  ItemNavBar
        | ---------------------------------------------------------------
        | Clase para crear el componente de los items del barra de navegacion,
        |  eviat escribir el "@" en el HTML
        |
        |
     */



    /**
     * Nombre del elmento que se iluminara cuando este este activo
     * 
     * @var string
     */
    public $active;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.itemsNavBar');
    }
}
