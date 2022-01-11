<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 */
class ModalConfirmacion extends Component
{
    /*
    | --------------------------------------------------------
    |   ModalConfirmacion
    | --------------------------------------------------------
    |   Clase para crear el componente del boton de los formularios de registro,
    |   eviat escribir el "@" en el HTML
    |
    | 
    */

    /**
     * ID modal (atributo del HTML)
     * 
     * @var string
     */
    public $idModal;

    /**
     * Titulo del modal
     * 
     * @var string
     */
    public $tituloModal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idModal, $tituloModal)
    {
        $this->idModal = $idModal;
        $this->tituloModal = $tituloModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modalSimple');
    }
}
