<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class estadosModelo extends Model
{
    use HasFactory;
    protected $table = 'direccion';
    protected $primaryKey = 'iddireccion';
    public $incrementing = false;
    public $timestamps = false;
}
