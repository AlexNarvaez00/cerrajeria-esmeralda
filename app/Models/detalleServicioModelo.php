<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleServicioModelo extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'folio_v';
    public $incrementing = false;
    public $timestamps = false;
}
