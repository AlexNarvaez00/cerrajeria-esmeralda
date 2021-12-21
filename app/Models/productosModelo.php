<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productosModelo extends Model
{
    use HasFactory;
    protected $table = 'productos';    
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'clave_producto';
}
