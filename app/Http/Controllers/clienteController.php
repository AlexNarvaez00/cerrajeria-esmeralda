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

    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez (?) xd';
        #this->clientesLista = clienteModelo::all();
        $this->camposVista = ['ID', 'Nombre', 'Apellido Paterno', 'Apellido Mateno', 'N° teléfono', 'Editar', 'Borrar'];
    }

    public function index(Request $request)
    {
        $listaClientes = null;
        if(count($request->all()) >= 0){
            $listaClientes = clienteModelo::where('idcliente','like',$request->inputBusqueda.'%')
                                    ->get();
        }else{
            //se rellena con todos los registros
            $listaClientes = clienteModelo::all();
        }
        return view('clientes')
            ->with ('nombreUsuarioVista', $this->nombreUsuario)
            ->with ('camposVista', $this ->camposVista)
            ->with('registrosVista', $listaClientes);
        
    }
    public function store(Request $request)
    {
        $cliente = new clienteModelo();

        $cliente->idcliente = "cl-".$request->apellidoPaterno[1].$request->apellidoPaterno[3].$request->apellidoMaterno[1].$request->apellidoMaterno[3];
        $cliente->nombre = $request->nombre; 
        $cliente->apellidoPaterno = $request->apellidoPaterno; #checar input
        $cliente->apellidoMaterno = $request->apellidoMaterno; #checar nombre input
        $cliente->telefono = $request->telefono; #checar nombre input
        $cliente->save();

        return redirect()->route('clientes.index');        
    }

    public function show(Request $request, $cliente)
    {

    }
    /**
     * Método para borrar registros de la base de datos
     */
    public function destroy(clienteModelo $cliente){
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
