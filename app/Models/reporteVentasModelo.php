<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reporteVentasModelo extends Model
{
    use HasFactory;
    protected $table = 'detalleventa';
    protected $primaryKey = 'folio_v';
    public $incrementing = false;
}
