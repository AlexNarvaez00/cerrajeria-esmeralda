<?php

namespace App\Http\Controllers;

use App\Models\usuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Parent_;

class usuarioController extends Controller
{
        /**
     * Atributos ...
     */
    public  $nombreUsuario;

    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->nombreUsuario='Narvaez ';

    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta lrabel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    public function index()
    {
        $usuariosLista = new usuariosModel();
        
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        return view('usuarios')
            ->with('camposVista',['ID','Nombre','Rol','Editar','Borrar'])
            ->with('nombreUsuarioVista',$this->nombreUsuario);
    }


    public function show()
    {
        # code...
    }
}
