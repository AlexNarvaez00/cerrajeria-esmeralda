<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * @author Narvaez Ruiz Alexis 
 * 
 * 
 * Clase para crear el componente de los inputs de los formularios,
 *  evita escribir el "@" en el HTML
 */
class InputNormal extends Component
{
    /**
     * Atributes
     * 
     */
    public $classesLabel;
    public $idInput;
    public $type;
    public $texto;
    public $activeInput;
    public $valor;
    public $nombreInput;
    public $nombreError;
    /**
     * Create a new component instance.
     *
     * @param var $classesLabel Clases de css para la etiqueta del componente 
     * @param var $idInput ID del input
     * @param var $texto Texto que ira en la etiqueta
     * @param var $active Agrega una clase (is-valid) si el elemento cuenta con un valor anterior "old"
     * @param var $valor Value del input 
     * @param var $nombreInput Nombre dle input "name"
     * @param var $nombreError Nombre del error a mostrar
     * 
     * 
     * @return void
     */
    public function __construct($classesLabel = '', $type = 'text', $idInput, $texto, $valor = '', $nombreInput, $nombreError = '', $activeInput = '')
    {
        $this->classesLabel = $classesLabel;
        $this->type = $type;
        $this->idInput = $idInput;
        $this->texto = $texto;
        $this->valor = $valor;
        $this->nombreInput = $nombreInput;
        $this->nombreError = $nombreError;

        if ($this->valor != '') {
            $this->activeInput = 'is-valid';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-normal');
    }
}
