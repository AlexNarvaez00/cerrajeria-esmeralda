<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuariosModel extends Model
{
    use HasFactory;

    //Nombre de la tabla    
    protected $table = 'usuarios';
    //LLave primaria
    protected $primaryKey = 'idusuario';
}
