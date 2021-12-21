<?php

namespace App\Http\Controllers;

use App\Models\clienteModelo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class clienteController extends Controller
{
    /**
     * Atributos ...
     */
    public $nombreUsuario; //pendiente revisar
    protected $clientesLista; //para guardar lista de clientes
    private $camposVista;

    /*------------------------------ CONSTANTES ---------------------------------------------------*/
    //Esto va a ser una constante
    private $rules = [
        'nombre' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'apellidoPaterno' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'apellidoMaterno' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'telefono' => 'required|numeric:/^[0-9]{10}$/',
    ];

    //Esto va a ser una constante
    private $rules2 = [
        'nombreEditar' => 'required|regex:/^[A-Z][a-z]{2,14}$/',
        'apellidoPaternoEditar' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'apellidoMaternoEditar' => 'required|regex:/^[A-Z][a-z]{2,25}$/',
        'telefonoEditar' => 'required|numeric:/^[0-9]{10}$/',
    ];


    
    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez ';
        #this->clientesLista = clienteModelo::all();
        $this->camposVista = ['ID', 'Nombre', 'Apellido Paterno', 'Apellido Mateno', 'N° teléfono', 'Editar', 'Borrar'];
    }

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
        return view('clientes')
            ->with ('nombreUsuarioVista', $this->nombreUsuario)
            ->with ('camposVista', $this ->camposVista)
            ->with('registrosVista', $listaClientes);
        
    }
    
    public function store(Request $request)
    {
        $request->validate($this->rules);

        $cliente = new clienteModelo();

        $cliente->idcliente = "cl-".$request->apellidoPaterno[1].$request->apellidoPaterno[2].$request->apellidoMaterno[1].$request->apellidoMaterno[2];
        $cliente->nombre = $request->nombre;  
        $cliente->apellidoPaterno = $request->apellidoPaterno; #checar input
        $cliente->apellidoMaterno = $request->apellidoMaterno; #checar nombre input
        $cliente->telefono = $request->telefono; #checar nombre input
        $cliente->save();

        return redirect()->route('clientes.index');        
    }

    
    public function destroy(clienteModelo $cliente){
        $cliente->delete();
        return redirect()
            ->route('clientes.index');
    }

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

