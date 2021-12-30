<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 * Clase para crear el componente del boton de los formularios de registro,
 *  eviat escribir el "@" en el HTML
 */
class ButtonNormalForm extends Component
{
    /**
     * Atributes
     * 
     */
    public $type;
    public $estiloBoton;
    public $texto;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'button', $estiloBoton, $texto)
    {
        $this->type = $type;
        $this->estiloBoton = $estiloBoton;
        $this->texto = $texto;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-normal-form');
    }
}
