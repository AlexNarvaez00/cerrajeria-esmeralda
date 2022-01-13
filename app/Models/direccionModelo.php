<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direccionModelo extends Model
{
    use HasFactory;
    /*
     |------------------------
     | direccionModelo
     |------------------------
     |  Modelo para recuperrar los registros de la
     |  base de datos, estos registros son usados para
     |  verificar que las direcciones existen en el sistema
     */

    /**
     * Nombre de la tabla a la cual hace referencia
     * @var string
     */
    protected $table = 'direccion';

    /**
     * LLave primaria de la tabla "direccion"
     * 
     * @var string
     */
    protected $primaryKey = 'iddireccion';

    /**
     * Atributo para indicar si la llave primaria es autoincrementable
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Atributo para indicar las marcas de tiempo
     * @var boolean
     */
    public $timestamps = false;
}