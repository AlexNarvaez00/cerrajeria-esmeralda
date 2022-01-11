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
<<<<<<< HEAD
     * Atributes
     * 
     */
    public $type;
    public $estiloBoton;
    public $texto;
=======
   | -----------------------------------------------------------
   |    ButtonNormalForm
   | -----------------------------------------------------------
   |
   |    Boton comun que se utiliza en los formularios de envio,
   |    el proposito de este componente es evitar que el HTML cresca mucho
   |
   |
     */


    /**
     * Tipo de boton
     * 
     * @var string
     */
    public $type;

    /**
     * Estilo visual del boton, son las clases CSS
     * 
     * @var string
     */
    public $estiloBoton;

    /**
     * Texto que se mostrar en el boton
     * 
     * @var string
     */
    public $texto;

>>>>>>> 0fb8a5ab18860ff684cd8ca77c7f53e83d9d5a3f
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
