<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicioModelo;
use App\Models\clienteModelo;
use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\coloniaModelo;
use App\Models\direccionModelo;

class serviciosController extends Controller{
    public  $nombreUsuario;//Este atributo despues lo revisamos
    protected  $serviciosLista;//Esta variables para guardar la lista de usuarios     

    public function __construct(){        
        $this->serviciosLista = servicioModelo::all(); //Obtiene todos los registros de la tabla servicios
        $this->camposTabla = ['idServicio','fecha y hora','idDirección','monto','Descripción','idCliente','Info cliente','Detalle servicio']; //Almacena todos los campos de la tabla de la vista
    }   

    public function show(Request $request){     
        $servicio = servicioModelo::find($request->id);
        return response()->json($servicio);
    }
    //Obtiene un cliente especificado
    public function getCliente(Request $request){            

        $cliente = clienteModelo::find($request->id);
        return response()->json($cliente);
    }

    public function store(Request $request){
        //Obtiene la direccion del cliente y lo almacena
        $direccionClienteServicio = new direccionModelo();
        $clienteServicio = new clienteModelo(); 
        $servicio = new servicioModelo();

        //Si el cliente ya existe        
        if ($request->idCliente == null) {
            $idclienteFormat = "cl-".$request->apellidoP[1].$request->apellidoP[3].$request->apellidoM[1].$request->apellidoM[3]; //Construye la llave primaria
            $clienteServicio->idcliente = $idclienteFormat;
            $clienteServicio->nombre = $request->nombre;
            $clienteServicio->apellidoPaterno = $request->apellidoP;
            $clienteServicio->apellidoMaterno = $request->apellidoM;
            $clienteServicio->telefono = $request->telefono;
            $clienteServicio->save();
            $direccionClienteServicio->iddireccion = "DI-".substr($idclienteFormat,-4)."2021"; 
            $servicio->idservicio = "SE-".substr($idclienteFormat,-4);
            $servicio->iddireccion = "DI-".substr($idclienteFormat,-4)."2021";
            $servicio->idcliente = $idclienteFormat;
         } else{
            $direccionClienteServicio->iddireccion = "DI-".substr($request->idCliente,-4)."2021"; 
            $servicio->idservicio = "SE-".substr($request->idCliente,-4);
            $servicio->iddireccion = "DI-".substr($request->idCliente,-4)."2021";
            $servicio->idcliente = $request->idCliente;
         }              
        $direccionClienteServicio->calle=$request->calle;
        $direccionClienteServicio->numero= $request->numero;
        $direccionClienteServicio->idcoldirec = $request->colonia;
        $direccionClienteServicio->save();

        
        $servicio->fechayhora = date('Y-m-d H:i:s');
        $servicio->monto = $request->monto;
        $servicio->descripcion = $request->descripcion;
        $servicio->save();        

        return redirect()->route('servicios-ventas.index');
    }

    public function index()
    {
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        $estadosLista = estadosModelo::all();
        return view('servicios-ventas') //Nombre de la vista 
            ->with('serviciosLista',$this->serviciosLista)  
            ->with('registroEstados',$estadosLista)    
            ->with('camposTabla',$this->camposTabla);//Campos de la tablas            
            
    }
    /**
     * @param $estado - peticion que se realiza por medio de AJAX
     */
    public function getCiudades(Request $request)
    {
        //Recuperamos la llave primaria de estados
        $llavePrimaria = $request->id;
        //Lista de municipios que coicidan con la llaveprimaria 
        $listaMunicipios = municipiosModelo::where('idestado','=',$llavePrimaria)->get();
        //El 200 significa que las peticiones son buenas.
        //json_encode ---- es para que en JS se manipule mas rapido.
        return response()->json($listaMunicipios);

    }
    public function getColonias(Request $request)
    {
        $llavePrimaria = $request->idmunicipio;
        $listaColonias = coloniaModelo::where('idmunicol','=',$llavePrimaria)->get();
        return response()->json($listaColonias);
    }

}
