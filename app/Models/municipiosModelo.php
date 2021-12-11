<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class municipiosModelo extends Model
{
    use HasFactory;
    protected $table = 'municipio';
}*/


class municipiosModelo extends Model
{
    public function municipio()
    {
        return $this->belongsTo(estadosModelo::class);
    }
}

