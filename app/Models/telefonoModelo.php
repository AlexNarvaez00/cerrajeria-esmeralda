<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class telefonoModelo extends Model
{
    use HasFactory;
    protected $table = 'telefono_proveedor';
    protected $primaryKey = 'idtelefono';
    public $timestamps = false;
    public $incrementing = false;
}
