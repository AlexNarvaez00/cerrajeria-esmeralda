<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Roberto Alejandro Vásquez Alcántara
 */
class proveedorModelo extends Model
{
    use HasFactory;
    /*
     |------------------------
     | proveedorModelo
     |------------------------
     |
     |  Modelo para recuperrar los registros de la
     |  base de datos, estos registros son usados para
     |  verificar que los proveedores existen en el sistema
     |
     */

     use softDeletes;
    /**
     * Nombre de la tabla a la cual hace referencia
     * @var string
     */
    protected $table = 'proveedor';

    /**
     * LLave primaria de la tabla "Proveedores"
     * 
     * @var string
     */
    protected $primaryKey = 'idproveedor';

    /**
     * Atributo para indicar si la llave primaria es autoincrementable
     * @var boolean
     */
    public $incrementing = false;
}
