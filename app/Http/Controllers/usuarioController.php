<?php

namespace App\Http\Controllers;

use App\Models\usuariosModel;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario;//Este atributo despues lo revisamos
    protected  $usuariosLista;//Esta variables para guardar la lista de usuarios

    private $camposVista;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->nombreUsuario='Narvaez ';
        $this->usuariosLista=usuariosModel::all();
            /**
             * Del modelo de caprta App/Http/Models
             *  
            */

        $this->camposVista = ['ID','Nombre','Rol','Creado','Modificado','Editar','Borrar'];
    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    public function index()
    {
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        return view('usuarios') //Nombre de la vista
            ->with('nombreUsuarioVista',$this->nombreUsuario)//Titulo de la vista
            ->with('camposVista',$this->camposVista)//Campos de la tablas
            ->with('registrosVista',$this->usuariosLista);//Registros de la tabla
    }

    public function show()
    {
        # code...
    }
}
