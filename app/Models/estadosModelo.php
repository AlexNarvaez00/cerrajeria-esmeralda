<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class estadosModelo extends Model
{
    use HasFactory;
    protected $table = 'estados';
}*/

class estadosModelo extends Model
{
    public function estados()
    {
        return $this->hasMany(municipiosModelo::class);
    }
}
