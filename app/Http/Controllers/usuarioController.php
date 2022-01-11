<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\usuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @author Narvaez Ruiz Alexis  
 */

class usuarioController extends Controller
{
    /* 
    | -----------------------------------
    |   usuarioController
    | -----------------------------------
    |   El controlador es utilizado para recuperar
    |   la lista de los usuarios en el sistema, mostrarndo
    |   la  informacion basica de los mismo en una tabla
    |
    */

    /**
     * La lista de usuarios recuperada de 
     * la base de datos.
     * 
     * @var array 
     */
    protected  $usuariosLista;

    /**
     * La lista de roles que se pueden 
     * asignar a los usuarios, cuando estos
     * son registrados
     * 
     * @var array 
     */
    private $listaRoles;

    /**
     * La lista de campos que se 
     * mostraran en la tabla principal 
     * de los usuarios.  
     * 
     * @var array 
     */
    private $camposVista;


    /*------------------------------ CONSTANTES ---------------------------------------------------*/
    /**
     * Arreglo de reglas para validar los campos enviados 
     * por el formulario, esta validacion sirve cuando el 
     * usuario es registrado por primera vez  
     * 
     * @var array 
     */
    private $rules = [
        'nombreUsuario' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'contrasena' => 'required|confirmed|regex:/^[A-Za-z0-9\_]{8,14}$/',
        'correo' => 'required|email',
        'rolUser' => 'required|in:Administrador,Empleado,Ayudante'
    ];

    /**
     * Arreglo de reglas para validar los campos enviados 
     * por el formulario, esta validacion sirve cuando los 
     * datos del usuario son actualizados.   
     * 
     * @var array 
     */
    private $rules2 = [
        'nombreUsuarioEditar' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'contrasenaEditar' => 'required|confirmed|regex:/^[A-Za-z0-9\_]{8,14}$/',
        'correoEditar' => 'required|email',
        'rolUserEditar' => 'required|in:Administrador,Empleado,Ayudante'
    ];


    /**
     * -------------------------------------
     *  Constructor
     * -------------------------------------
     * 
     * Inicializa la lsiata de roles, campos de la tabla.
     * 
     */
    public function __construct()
    {
        $this->camposVista = ['ID', 'Nombre', 'Rol', 'Creado', 'Modificado', 'Editar', 'Borrar'];
        $this->listaRoles = ['Administrador', 'Empleado', 'Ayudante'];
    }

    /**
     * Funcion que ejecutada cuando la ruta de "usuarios" es 
     * solicitada por el navegador.
     * 
     * @param Request $request Solicitud por parte del navgador.
     * 
     * @return View Vista de usuarios.
     */
    public function index(Request $request)
    {
        $listaUsuarios = null;
        if (count($request->all()) >= 0) {
            $listaUsuarios = User::where('id', 'like', $request->inputBusqueda . '%')
                ->paginate(6);
        } else {
            $listaUsuarios = User::paginate(6);
        }

        return view('usuarios') //Nombre de la vista
            ->with('camposVista', $this->camposVista) //Campos de la tablas
            ->with('registrosVista', $listaUsuarios) //Registros de la tabla
            ->with('listaRoles', $this->listaRoles); // //Campos de la tablas
    }

    /**
     * Funcion para guardar un nuevo registro en la base de datos.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return Redirect Redirecciona a la vista principal. 
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
        $usuario->password = Hash::make($request->contrasena);
        $usuario->email = $request->correo;
        $usuario->rol = $request->rolUser;
        $usuario->save();
        return redirect()->route('usuarios.index');
    }

    /**
     * Funncion para borrar un registro de la tabla de "usuarios". 
     * 
     * @param User $usuario Registro de la base de datos que sera borrado, laraval lo detecta solo.
     * 
     * @return Redirector Redirecciona a la vista principal.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->id == auth()->user()->id) {
            $usuarioAdminError = ['noValido' => 'No te puedes borrar a ti mismo'];
            return redirect()
                ->route('usuarios.index')
                ->withErrors($usuarioAdminError);
        }
        if ($usuario->rol == 'Administrador') {
            $usuarioAdminError = ['noValido' => 'No puedes borrar a un admistrador'];
            return redirect()
                ->route('usuarios.index')
                ->withErrors($usuarioAdminError);
        } else {
            $usuario->delete();
            return redirect()
                ->route('usuarios.index');
        }
    }

    /**
     * Actualiza la informacion basica de un usuario.
     * 
     * @param Request $request Solicitud por parte del cliente
     * @param User $usuario Usuario al que se le eactualizada la informacion.
     * 
     * @return Redirector Redirecciona a la vista principal.
     * 
     */
    public function update(Request $request, User $usuario)
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
        $usuario->password = Hash::make($request->contrasenaEditar);
        $usuario->email = $request->correoEditar;
        $usuario->rol = $request->rolUserEditar;
        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Función vacia (No hace nada)
     * 
     * @param User $usuario Usuario a editar, laravel lo detecta solo.
     * 
     */
    public function edit(User $usuario)
    {
    }

    /**
     * Función vacia (No hace nada).
     * @param Request $request Solicitud por parte del navegador.
     * @param User $usuario Registro de la tabla "Usuario"
     * 
     */
    public function show(Request $request, User $usuario)
    {
    }
}
