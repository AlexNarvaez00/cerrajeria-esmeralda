<?php

namespace App\View\Components\components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 * Clase para crear el componente del header,
 *  eviat escribir el "@" en el HTML
 */
class header extends Component
{
    /**
     * Atributes
     * 
     */
    public $visible;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($visible)
    {
        $this->visible = $visible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
