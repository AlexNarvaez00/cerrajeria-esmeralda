<?php

namespace App\Http\Controllers;


use App\Models\usuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;

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


    /**
     * Constructor, inicializa la lsiata de roles, campos de la tabla y los registros de la misma 
     * 
     */
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
            $listaUsuarios = usuariosModel::all();
        }

        return view('usuarios') //Nombre de la vista
            ->with('nombreUsuarioVista', $this->nombreUsuario) //Titulo de la vista
            ->with('camposVista', $this->camposVista) //Campos de la tablas
            ->with('registrosVista', $listaUsuarios) //Registros de la tabla
            ->with('listaRoles', $this->listaRoles); //; //Campos de la tablas
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
        $llavePrimaria = 'USU-' .
            strtoupper($request->nombreUsuario[0]) .
            strtoupper($request->nombreUsuario[1]) .
            strtoupper($request->rolUser[0]).
            strtoupper($request->rolUser[1]).'-'.
            date('dmy');

        //Validacion de los campos
        $validaciones = FacadesValidator::make($request->all(),[
            'nombreUsuario' => 'required'
        ]);

        if($validaciones->fails()){
            return "errores";
        }
        
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
     * Este metodo sirve para borrar los registros de la base de datos.
     * 
     * @param usuario Registro de la base de datos que sera borrado.
     */
    public function destroy(usuariosModel $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
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
        $usuario->nombreUsuario = $request->nombreUsuarioEditar;
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
