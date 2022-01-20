<?php

namespace App\Http\Controllers;

use App\Models\clienteModelo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

    /**
     * @author Santiago Solano Dafne 
     */

class clienteController extends Controller
{
    /* 
    | -----------------------------------
    |   clienteController
    | -----------------------------------
    |   El controlador es utilizado para recuperar
    |   la lista de clientes existentes en el sistema, mostrarndo
    |   la informacion en forma de tabla
    |
    */

    /**
     * La lista de clientes recuperada de 
     * la base de datos
     * 
     * @var array 
     */
    protected $clientesLista;

   /**
     * La lista de campos que se 
     * mostraran en la tabla de 
     * los clientes.  
     * 
     * @var array 
     */
    private $camposVista;

    /*------------------------------ CONSTANTES ---------------------------------------------------*/
    /**
     * Arreglo de reglas para validar los campos enviados 
     * por el formulario, esta validacion sirve cuando el 
     * cliente es registrado en el sistema    
     * 
     * @var array 
     */
    private $rules = [
        'nombre' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'apellidoPaterno' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'apellidoMaterno' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'telefono' => 'required|numeric:/^[0-9]{10}$/',
    ];

    /**
     * Arreglo de reglas para validar los campos enviados 
     * por el formulario, esta validacion sirve cuando los 
     * datos del cliente son actualizados.   
     * 
     * @var array 
     */
    private $rules2 = [
        'nombreEditar' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'apellidoPaternoEditar' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'apellidoMaternoEditar' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'telefonoEditar' => 'required|numeric:/^[0-9]{10}$/',
    ];

    /**
     * -------------------------------------
     *  Constructor
     * -------------------------------------
     * 
     * Inicializa los campos de la tabla.
     * 
     */
    public function __construct()
    {

        $this->camposVista = ['ID', 'Nombre', 'Apellido Paterno', 'Apellido Mateno', 'N° teléfono', 'Editar', 'Borrar'];
    }

    /**
     * Funcion que ejecutada cuando la ruta de "clientes" es 
     * solicitada por el navegador.
     * 
     * @param Request $request Solicitud por parte del navgador.
     * 
     * @return View Vista de clientes.
     */
    public function index(Request $request)
    {
        $listaClientes = null;
        if(count($request->all()) >= 0){
            $listaClientes = clienteModelo::where('nombre','like',$request->inputBusqueda.'%')
                ->paginate(10);
        }else{
            //se rellena con todos los registros
            $listaClientes = clienteModelo::paginate(10);;
        }
        return view('clientes') //nombre de la vista
            ->with ('camposVista', $this ->camposVista) //campos de las tablas
            ->with('registrosVista', $listaClientes); //Registros de la tabla
        
    }
    
    /**
     * Funcion para guardar un nuevo registro en la base de datos.
     * 
     * @param Request $request Este objeto se encarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return Redirect Redirecciona a la vista principal. 
     */
    public function store(Request $request)
    {
        //validacion de lo campos
        $request->validate($this->rules);

        $cliente = new clienteModelo();

        //Nombre del campo BD----- Nombre input formulario        
        $cliente->idcliente = "cl-".$request->apellidoPaterno[1].$request->apellidoPaterno[2].$request->apellidoMaterno[1].$request->apellidoMaterno[2];
        $cliente->nombre = $request->nombre;  
        $cliente->apellidoPaterno = $request->apellidoPaterno; #checar input
        $cliente->apellidoMaterno = $request->apellidoMaterno; #checar nombre input
        $cliente->telefono = $request->telefono; #checar nombre input
        $cliente->save();

        return redirect()->route('clientes.index');        
    }

    /**
     * Funncion para borrar un registro de la tabla "clientes". 
     * 
     * @param User $cliente Registro de la base de datos que sera borrado, laraval lo detecta solo.
     * 
     * @return Redirector Redirecciona a la vista principal.
     */    
    public function destroy(clienteModelo $cliente){
        $cliente->delete();
        return redirect()
            ->route('clientes.index');
    }

    /**
     * Actualiza la informacion basica de un cliente.
     * 
     * @param Request $request Solicitud por parte del cliente
     * @param User $usuario cliente al que se le actualiza la informacion.
     * 
     * @return Redirector Redirecciona a la vista principal.
     * 
     */
    public function update(Request $request, clienteModelo $cliente)
    {
        $request->validate($this->rules2);

        $cliente->idcliente = "cl-".$request->apellidoPaternoEditar[1].$request->apellidoPaternoEditar[2].$request->apellidoMaternoEditar[1].$request->apellidoMaternoEditar[2];
        $cliente->nombre = $request->nombreEditar; 
        $cliente->apellidoPaterno = $request->apellidoPaternoEditar; #checar input
        $cliente->apellidoMaterno = $request->apellidoMaternoEditar; #checar nombre input
        $cliente->telefono = $request->telefonoEditar; #checar nombre input
        $cliente->save();

        return redirect()->route('clientes.index');
    }

    /**
     * Función vacia (No hace nada)
     * 
     * @param User $cliente a editar, laravel lo detecta solo.
     * 
     */
    public function edit(usuariosModel $usuario)
    {
    }

    /**
     * Función vacia (No hace nada).
     * @param Request $request Solicitud por parte del navegador.
     * @param User $cliente Registro de la tabla "cliente"
     * 
     */
    public function show(Request $request, $usuario)
    {
    }
}

