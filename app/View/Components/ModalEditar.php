<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 * Clase para crear el componente del modal de "Ediatr",
 *  eviat escribir el "@" en el HTML
 */
class ModalEditar extends Component
{
    /**
     * Atributes
     * 
     */
    public $idModal;
    public $tituloModal;
    public $rutaEnvio;
    public $metodoFormulario;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idModal, $tituloModal, $rutaEnvio, $metodoFormulario)
    {
        $this->idModal = $idModal;
        $this->tituloModal = $tituloModal;
        $this->rutaEnvio = $rutaEnvio;
        $this->metodoFormulario = $metodoFormulario;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
