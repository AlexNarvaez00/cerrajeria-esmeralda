<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 */
class ModalEditar extends Component
{
    /*
    | ----------------------------------------------------------------
    |   ModalEditar
    | ----------------------------------------------------------------
    |   Clase para crear el componente del modal de "Ediatr",
    |   eviat escribir el "@" en el HTML
    |
    */

    /**
     * ID del modal (atributo del HTML)
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
     * Ruta del formulario del Modal (atributo "action" del fomurlario)
     * 
     * @var string
     */
    public $rutaEnvio;

    
    /**
     * Método de envio del formualario 
     * GET | POST
     * 
     * @var string
     */
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
