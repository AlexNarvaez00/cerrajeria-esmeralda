<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usuarioController extends Controller
{
    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html


    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta lrabel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    public function index()
    {
        $nombreUsuario = 'csdsdcsc';
        # code...
        return view('usuarios')->with('nombreUsuarioVista',$nombreUsuario);

    }


    public function show()
    {
        # code...
    }
}
