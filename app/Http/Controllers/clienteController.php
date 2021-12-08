<?php

namespace App\Http\Controllers;

use App\Models\clienteModelo;
use Illuminate\Http\Request;

class clienteController extends Controller
{
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

        $cliente->idcliente = $request->idcliente; #checar nombre input
        $cliente->nombre = $request->nombre; #checar nomnre input
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
