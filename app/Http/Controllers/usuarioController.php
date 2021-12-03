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
        $this->usuariosLista = usuariosModel::all();
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

    /**
     * @param $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario.
     * 
    */
    public function store(Request $request){
        //Creamos un nuevo objeto.
        $usuario = new usuariosModel();

        //Nombre del input del formulario es una tributo "name"
        //Chequen esa parte.

        //Nombre del campo BD----- Nombre input formulario
        $usuario->idUsuario = $request->idUsuario;
        $usuario->nombreUsuario = $request->nombreUsuario;
        $usuario->contrasena = $request->contrasena;
        
        $usuario->idjefe = $request->idUsuario;
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        //Pero deben de revisar el modelo que les toco, en mi caso es "usuariosModel"
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    public function show()
    {
        # code...
    }
}
