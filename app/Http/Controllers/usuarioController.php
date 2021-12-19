<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\usuariosModel;
use Illuminate\Http\Request;

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


    /*------------------------------ CONSTANTES ---------------------------------------------------*/
    //Esto va a ser una constante
    private $rules = [
        'nombreUsuario' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'contrasena' => 'required|confirmed|regex:/^[A-Za-z0-9\_]{8,14}$/',
        'correo' => 'required|email',
        'rolUser' => 'required|in:Administrador,Empleado,Ayudante'
    ];

    //Esto va a ser una constante
    private $rules2 = [
        'nombreUsuarioEditar' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'contrasenaEditar' => 'required|confirmed|regex:/^[A-Za-z0-9\_]{8,14}$/',
        'correoEditar' => 'required|email',
        'rolUserEditar' => 'required|in:Administrador,Empleado,Ayudante'
    ];


    /**
     * Constructor, inicializa la lsiata de roles, campos de la tabla y los registros de la misma 
     * 
     */
    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez ';
        //$this->usuariosLista = usuariosModel::all();
        $this->camposVista = ['ID', 'Nombre', 'Rol', 'Creado', 'Modificado', 'Editar', 'Borrar'];
        $this->listaRoles = ['Administrador', 'Empleado', 'Ayudante'];
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
            $listaUsuarios = User::where('id', 'like', $request->inputBusqueda . '%')
                ->paginate(10);
        } else {
            $listaUsuarios = User::paginate(10);
        }

        return view('usuarios') //Nombre de la vista
            ->with('nombreUsuarioVista', $this->nombreUsuario) //Titulo de la vista
            ->with('camposVista', $this->camposVista) //Campos de la tablas
            ->with('registrosVista', $listaUsuarios) //Registros de la tabla
            ->with('listaRoles', $this->listaRoles); // //Campos de la tablas
    }

    /**
     * Funcion para guardar un nuevo registro en la base de datos.
     * 
     * @param request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de nanera oculta
     * 
     */
    public function store(Request $request)
    {
        //Validacion de los campos
        $request->validate($this->rules);

        $llavePrimaria = 'USU-' .
            strtoupper($request->nombreUsuario[0]) .
            strtoupper($request->nombreUsuario[1]) .
            strtoupper($request->rolUser[0]) .
            strtoupper($request->rolUser[1]) . '-' .
            date('dmy');

        //Nombre del campo BD----- Nombre input formulario
        $usuario = new User();
        $usuario->id =  $llavePrimaria;
        $usuario->name = $request->nombreUsuario;
        $usuario->password = $request->contrasena;
        $usuario->email = $request->correo;
        $usuario->rol = $request->rolUser;
        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Este metodo sirve para borrar los registros de la base de datos.
     * 
     * @param usuario Registro de la base de datos que sera borrado.
     */
    public function destroy(usuariosModel $usuario)
    {

        if($usuario->rol == 'Administrador'){
            $usuarioAdminError = ['noValido'=>'No puedes borrar a un admistrador'];
            return redirect()
                ->route('usuarios.index')
                ->withErrors($usuarioAdminError);
        }else{
            $usuario->delete();
            return redirect()
                ->route('usuarios.index');    
        }
    }

    /**
     * Actualiza la informacion basica de un usuario.
     * 
     * @param request Solicitud por parte del cliente
     * @param usuario Usuario al que se le eactualizada la informacion.
     * 
     * @return Redirecciona a la ruta 'index'
     * 
     */
    public function update(Request $request, usuariosModel $usuario)
    {
        $request->validate($this->rules2);

        $llavePrimaria = 'USU-' .
            strtoupper($request->nombreUsuarioEditar[0]) .
            strtoupper($request->nombreUsuarioEditar[1]) .
            strtoupper($request->rolUserEditar[0]) .
            strtoupper($request->rolUserEditar[1]) . '-' .
            date('dmy');

        $usuario->id = $llavePrimaria;
        $usuario->name = $request->nombreUsuarioEditar;
        $usuario->password = $request->contrasenaEditar;
        $usuario->email = $request->correoEditar;
        $usuario->rol = $request->rolUserEditar;
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Función vacia (No hace nada)
     * 
     */
    public function edit(usuariosModel $usuario)
    {
    }

    /**
     * 
     */
    public function show(Request $request, $usuario)
    {
    }
}
