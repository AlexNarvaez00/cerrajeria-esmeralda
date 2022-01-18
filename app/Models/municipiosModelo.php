<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @author Roberto Alejandro Vásquez Alcántara
 */

class municipiosModelo extends Model
{
     /*
     |------------------------
     | municipiosModelo
     |------------------------
     |
     |  Modelo para recuperrar los registros de la
     |  base de datos, estos registros son usados para
     |  verificar que los municipios existen en el sistema
     |
     */

    /**
     * Nombre de la tabla a la cual hace referencia
     * @var string
     */
    protected $table = 'municipio'; 

    /**
     * LLave primaria de la tabla "municipio"
     * 
     * @var string
     */
    protected $primaryKey = 'idmunicipio';
}

