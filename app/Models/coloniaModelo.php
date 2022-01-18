<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Roberto Alejandro Vásquez Alcántara
 */

class coloniaModelo extends Model
{
     /*
     |------------------------
     | coloniaModelo
     |------------------------
     |
     |  Modelo para recuperrar los registros de la
     |  base de datos, estos registros son usados para
     |  verificar que las colonias existen en el sistema
     |
     */

    /**
     * Nombre de la tabla a la cual hace referencia
     * @var string
     */
    protected $table = 'colonia'; 

     /**
     * LLave primaria de la tabla "colonia"
     * 
     * @var string
     */
    protected $primaryKey = 'idcolonia';
}