<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clienteModelo extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey = 'idcliente';
    public $incrementing = false;
    public $timestamps = false;
}
