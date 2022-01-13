<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagoModelo extends Model
{
    use HasFactory;
    /**
     * almacena el nombre de la tabla de la base de datos
     * 
     * @var string
     */
    protected $table = 'pago'; 
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
    
}
