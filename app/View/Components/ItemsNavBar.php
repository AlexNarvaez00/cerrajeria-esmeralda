<?php

namespace App\View\Components\components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 * Clase para crear el componente de los items del barra de navegacion,
 *  eviat escribir el "@" en el HTML
 */
class ItemNavBar extends Component
{
    /**
     * Atributes
     * 
     */
    public $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active)
    {
        $this->active=$active;
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
