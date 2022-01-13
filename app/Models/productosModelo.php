<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Omar
 */
  /** 
     | ------------------------------------
     |  productosModelo
     | ------------------------------------
     |
     |  Modelo para recuperar los registros de los productos de la 
     |  base de datos
     |
    */
class productosModelo extends Model
{
    use HasFactory;
    /**
     * almacena el nombre de la tabla de la base de datos
     * 
     * @var string
     */
    protected $table = 'productos'; 
    /**
     * establece que no se creen automaticamento los campos created
     * 
     * @var string
     */   
    public $timestamps = false;
    /**
     * Atribut para indiciar si la llave primaria es autoincrementable.
     * 
     * @var boolean
     */
    public $incrementing = false;
    /**
     * Atributo para establecer la llave primaria de la tabla
     * 
     * @var boolean
     */
    protected $primaryKey = 'clave_producto';
}
