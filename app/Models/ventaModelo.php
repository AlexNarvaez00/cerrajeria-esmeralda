<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventaModelo extends Model
{
    use HasFactory;
    protected $table = 'venta';
    public $timestamps = false;
}
