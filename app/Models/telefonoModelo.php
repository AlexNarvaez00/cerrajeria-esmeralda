<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Roberto Alejandro Vásquez Alcántara
 */
class telefonoModelo extends Model
{
    use HasFactory;
     /*
     |------------------------
     | telefonoModelo
     |------------------------
     |  Modelo para recuperrar los registros de la
     |  base de datos, estos registros son usados para
     |  verificar que los números de telefonos existen en el sistema
     */
    /**
     * Nombre de la tabla a la cual hace referencia
     * @var string
     */
    protected $table = 'telefono_proveedor';

    /**
     * LLave primaria de la tabla "telefono_proveedor"
     * 
     * @var string
     */
    protected $primaryKey = 'idtelefono';

    /**
     * Atributo para indicar las marcas de tiempo
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Atributo para indicar si la llave primaria es autoincrementable
     * @var boolean
     */
    public $incrementing = false;
}