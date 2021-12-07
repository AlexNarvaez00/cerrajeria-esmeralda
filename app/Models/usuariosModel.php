<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuariosModel extends Model
{
    use HasFactory;

    //Nombre de la tabla , asi se tienen que cambiar a cada uno de sus modelos  
    protected $table = 'usuarios';
    //Para que nos busque directamente, el "ID" de nuestra tabla, necesitamos 
    //indicarle la llave primaria y decirle que "NO es autoincrementable"
    protected $primaryKey = 'idusuario';
    public $incrementing = false;
}
