<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productosDescripcionModelo extends Model
{
    use HasFactory;
    protected $table = 'productodescripcion'; 
    protected $primaryKey = 'clave_producto';  
    public $timestamps = false;
    public $incrementing = false;
}
