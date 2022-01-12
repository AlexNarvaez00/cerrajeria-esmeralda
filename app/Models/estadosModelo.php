<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Roberto Alejandro Vásquez Alcántara
 */

class estadosModelo extends Model
{
     /*
     |------------------------
     | estadosModelo
     |------------------------
     |
     |  Modelo para recuperrar los registros de la
     |  base de datos, estos registros son usados para
     |  verificar que los estados existen en el sistema
     |
     */

    /**
     * Nombre de la tabla a la cual hace referencia
     * @var string
     */
    protected $table = 'estados';

    /**
     * LLave primaria de la tabla "estados"
     * 
     * @var string
     */
    protected $primaryKey = 'id';
}
