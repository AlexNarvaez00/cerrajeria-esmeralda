<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @author Narvaez Ruiz Alexis
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /** 
     | ------------------------------------
     |  User Model
     | ------------------------------------
     |
     |  Modelo para recuperar los registros de la 
     |  base de datos, estos registros son usados para 
     |  verificar que los usuarios existen en el sistema
     |
    */

    /**
     * Llave primaria de la tabla "Usuarios".
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Atribut para indiciar si la llave primaria es autoincrementable.
     * 
     * @var boolean
     */
    public $incrementing = false;
    /**
     * Los atributos que son son llenados en la asignacion masiva.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol'
    ];

    /**
     * Los atributos que deberia ser ocultos para serializacion
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
