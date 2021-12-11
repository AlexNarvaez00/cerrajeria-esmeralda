<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estadosModelo extends Model
{
    use HasFactory;

    /** 
     * Esto tambien lo movio paara poder hacer AJAX, pero
     * se supone que a quien le toco municipios lo debio de cambiar :v
     * 
    */
    protected $table = 'estados';
    protected $primaryKey = 'id';
}
