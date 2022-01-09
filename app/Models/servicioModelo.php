<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicioModelo extends Model
{
    use HasFactory;
    protected $table = 'servicio';
    protected $primaryKey = 'idservicio';
    public $timestamps = false;
    public $incrementing = false;
}
