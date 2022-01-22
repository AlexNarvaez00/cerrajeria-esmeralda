<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @author Santiago Solano Dafne
 */
class clienteModelo extends Model
{
    use HasFactory;
    /**
     * ----------------------------
     *  clienteModelo
     * ----------------------------
     * 
     * Modelo para recuperar los registros de la base de
     * datos, estos registros son usados para verificar
     * que los clientes existen en el sistema
     */

     /**
      * Nombre de la tabla a la cual hace referencia
      * @var string
      */
    protected $table = 'cliente';

    /**
     * Llave promaria de la tabla "Clientes"
     * @var string
     */
    protected $primaryKey = 'idcliente';
    
    /**
     * Atributo para indicar si la llave primaria es autoincrementable
     * @var boolean
     */
    public $incrementing = false;

    
    public $timestamps = false;
}
