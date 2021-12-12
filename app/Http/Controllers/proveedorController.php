<?php

namespace App\Http\Controllers;

use App\Models\proveedorModelo;
use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\coloniaModelo;
use App\Models\direccionModelo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class proveedorController extends Controller
{
     /**
     * Atributos ...
     */
    public  $nombreUsuario; //Este atributo despues lo revisamos
    protected  $proveedoresLista;//Esta variables para guardar la lista de proveeores
    private $camposTabla;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez ';
        $this->camposTabla = ['ID','Nombre','ApellidoPaterno','ApellidoMaterno','Correo','Editar','Borrar'];
    }
    
    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    public function index(Request $request)
    {
        $listaProveedores = null;
        if(count($request->all()) >= 0){
            $listaProveedores = proveedorModelo::where('idproveedor','like',$request->inputBusqueda.'%')
                                    ->get();
        }else{
            //Sino tiene nada
            //Que lo rellene con todos los registros 
            $listaProveedores = proveedorModelo::all();
        }
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...

        
        $estadosLista = estadosModelo::all();
        
        
        
        return view('proveedores') //Nombre de la vista
            ->with('nombreUsuarioVista', $this->nombreUsuario) //Titulo de la vista
            ->with('camposTabla', $this->camposTabla) //Campos de la tablas
            ->with('registrosVista', $listaProveedores) //Registros de la tabla
            ->with('registroEstados',$estadosLista);
    }


    public function store(Request $request){
        //Creamos un nuevo objeto.
        $proveedor = new proveedorModelo();

        //Nombre del input del formulario es una tributo "name"
        //Chequen esa parte.

        //Nombre del campo BD----- Nombre input formulario
        $proveedor->idproveedor = $request->idproveedor;
        $proveedor->nombre = $request->nombre;
        $proveedor->apellidopaterno = $request->apellidopaterno;
        $proveedor->apellidomaterno = $request->apellidomaterno;
        $proveedor->correo = $request->correo;
        //$proveedor->numtelefono = $request->numtelefono;
        //$proveedor->calle = $request->calle;
        //$proveedor->estado = $request->estado;
        //$proveedor->municipio = $request->municipio;
        //$proveedor->colonia = $request->colonia;
        
        $direccion = new direccionModelo();
        $direccion->iddireccion = "DIC-".$request->numext."-".$request->idproveedor;
        
        $PRYKEY = $direccion->iddireccion;
        
        $direccion->calle=$request->calle;
        $direccion->numero= $request->numext;
        $direccion->idcoldirec = $request->colonias;
        $direccion->save();

        $proveedor->iddirecproveedor = $PRYKEY;
        
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        //Pero deben de revisar el modelo que les toco, en mi caso es "usuariosModel"
        $proveedor->save();

        return redirect()->route('proveedores.index');
    }

    public function show(Request $request,$proveedor)
    {
    
    }
    /**
     * Este metodo sirve para borrar los registros de la base de datos,
     * deben de tener cuidado :v 
     * 
    */
    public function destroy(proveedorModelo $proveedore){
        $proveedore->delete();
        return redirect()->route('proveedores.index');
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
