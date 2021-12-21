<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleVentaModelo extends Model
{
    use HasFactory;
    protected $table = 'detalleventa';
    public $incrementing = false;
}
