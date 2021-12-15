<?php

namespace App\Http\Controllers;

use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\usuariosModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class usuarioController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario; //Este atributo despues lo revisamos
    protected  $usuariosLista; //Esta variables para guardar la lista de usuarios

    //Arreglos constantes.
    private $listaRoles;
    private $camposVista;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez ';
        //$this->usuariosLista = usuariosModel::all();
        $this->camposVista = ['ID', 'Nombre', 'Rol', 'Creado', 'Modificado', 'Editar', 'Borrar'];
        $this->listaRoles = ['Administrador', 'Empleado', 'Servicio XD', 'Siiiiiiuuuuuuu'];
    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
     */
    public function index(Request $request)
    {
        $listaUsuarios = null;
        if (count($request->all()) >= 0) {
            $listaUsuarios = usuariosModel::where('idusuario', 'like', $request->inputBusqueda . '%')
                ->get();
        } else {
            //Sino tiene nada
            //Que lo rellene con todos los registros 
            $listaUsuarios = usuariosModel::all();
        }

        //Obtenemos todos los estado.
        $estadosArreglo = estadosModelo::all();



        return view('usuarios') //Nombre de la vista
            ->with('nombreUsuarioVista', $this->nombreUsuario) //Titulo de la vista
            ->with('camposVista', $this->camposVista) //Campos de la tablas
            ->with('registrosVista', $listaUsuarios) //Registros de la tabla
            ->with('listaRoles', $this->listaRoles); //; //Campos de la tablas

        //Pasamos los estado a las vista
        //->with('estadosArreglo',$estadosArreglo);
    }

    /**
     * Funcion para guardar un nuevo registro en la base de datos.
     * 
     * @param $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario.
     * 
     */
    public function store(Request $request)
    {
        
        $llavePrimaria = '';
        do{
            //Significa que la llave primaria ya fue registrada
            $llavePrimaria = 'USU-'.$this->getNumber();
        }while(usuariosModel::find($llavePrimaria) != null);
        
        //Nombre del campo BD----- Nombre input formulario
        $usuario = new usuariosModel();
        $usuario->idUsuario =  $llavePrimaria;
        $usuario->nombreUsuario = $request->nombreUsuario;
        $usuario->contrasena = $request->contrasena;
        $usuario->rol = $request->rolUser;
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * 
     * 
     */
    public function show(Request $request, $usuario)
    {
    }
    /**
     * Este metodo sirve para borrar los registros de la base de datos,
     * deben de tener cuidado :v 
     * 
     */
    public function destroy(usuariosModel $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }

    public function update(Request $request,usuariosModel $usuario)
    {
        $usuario->nombreUsuario = $request->nombreUsuarioEditar;
        $usuario->save();

        return redirect()->route('usuarios.index');
    }


    public function edit(usuariosModel $usuario)
    {
    }

    /**
     * @return Regresa un numero de tres cifas aleatorio del 000-999
     */
    public function getNumber(){
        return random_int(0,9).''.random_int(0,9).''.random_int(0,9);
    }






    /**
     * @param $estado - peticion que se realiza por medio de AJAX
     */
    public function getCiudades(Request $request)
    {
        //Recuperamos la llave primaria de estados
        $llavePrimaria = $request->id;
        //Lista de municipios que coicidan con la llaveprimaria 
        $listaMunicipios = municipiosModelo::where('idestado', '=', $llavePrimaria)->get();

        //El 200 significa que las peticiones son buenas.
        //json_encode ---- es para que en JS se manipule mas rapido.
        return response()->json($listaMunicipios);
    }
}
