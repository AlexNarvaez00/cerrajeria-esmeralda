<?php

namespace App\Http\Controllers;

use App\Models\proveedorModelo;
use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\coloniaModelo;
use App\Models\direccionModelo;
use App\Models\telefonoModelo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class proveedorController extends Controller
{
     /**
     * Atributos ...
     */
    protected  $proveedoresLista;//Esta variables para guardar la lista de proveeores
    private $camposTabla;

    private $reglaV = [
        'nombre' => 'required|regex:/^[A-Z][a-zÀ-ÿ\s]/',
        'apellidopaterno' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'apellidomaterno' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'numtelefono' => 'required|regex:/^[0-9]{10}$/',
        'correo' => 'required|email',
        'calle' => 'required|regex:/^[A-Z][a-zÀ-ÿ\s]{1,40}/',
        'numext' => 'required|regex:/^[0-2]+[0-9][0-9]$/' 
    ];

    //Esto va a ser una constante
    private $reglaV2 = [
        'nombreEditar' => 'required|regex:/^[A-Z][a-zÀ-ÿ\s]/',
        'apellidopaternoEditar' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'apellidomaternoEditar' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'numtelefonoEditar' => 'required|regex:/^[0-9]{10}$/',
        'correoEditar' => 'required|email'
    ];


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->camposTabla = ['ID','Nombre','ApellidoPaterno','ApellidoMaterno','Número de Teléfono','Correo','ID Dirección','Editar','Borrar'];
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
            ->paginate(6);
        }else{
            //Sino tiene nada
            //Que lo rellene con todos los registros 
            $listaProveedores = proveedorModelo::paginate(6);
        }
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        $estadosLista = estadosModelo::all();
        $numtelefonoLista = telefonoModelo::all();
        foreach ($listaProveedores as $proveedor) { 
            $telefonos=telefonoModelo::where('idproveedor','=',$proveedor->idproveedor)->get();
            if(count($telefonos)>0){
            $proveedor->telefono=$telefonos[0]->telefono;
            }
        }
        return view('proveedores') //Nombre de la vista
            ->with('camposTabla', $this->camposTabla) //Campos de la tablas
            ->with('registrosVista', $listaProveedores) //Registros de la tabla
            ->with('registroEstados',$estadosLista);    // Listado de los Estados
    }


    public function store(Request $request){
        //Creamos un nuevo objeto.
        $proveedor = new proveedorModelo();
        $request->validate($this->reglaV);
        //Nombre del input del formulario es una tributo "name"
        //Chequen esa parte.

        //Nombre del campo BD----- Nombre input formulario
        $llavePrimaria = "PROV-".
        strtoupper($request->apellidopaterno[0]).
        strtoupper($request->apellidopaterno[1]).
        strtoupper("-".$request->apellidomaterno[0]).
        strtoupper($request->apellidomaterno[1]).
        strtoupper($request->numext[0]).
        strtoupper($request->numext[1]);

        $proveedor->idproveedor =  $llavePrimaria;
        $proveedor->nombre = $request->nombre;
        $proveedor->apellidopaterno = $request->apellidopaterno;
        $proveedor->apellidomaterno = $request->apellidomaterno;
        $proveedor->correo = $request->correo;
        //$proveedor->numtelefono = $request->numtelefono;
        //$proveedor->calle = $request->calle;
        //$proveedor->estado = $request->estado;
        //$proveedor->municipio = $request->municipio;
        //$proveedor->colonia = $request->colonia;

        //Se crea y guarda una dirección con la información del proveedor para posteriormente usarla en el campo de dirección de la tabla
        $direccion = new direccionModelo();
        $direccion->iddireccion = "DIC-".$request->numext[0].$request->numext[1].$request->apellidopaterno[0].$request->apellidopaterno[1]."-".$request->apellidomaterno[0].$request->apellidomaterno[1];
        
        $PRYKEY = $direccion->iddireccion;
        
        $direccion->calle=$request->calle;
        $direccion->numero= $request->numext;
        $direccion->idcoldirec = $request->colonias;
        $direccion->save();

        //Campo de dirección del proveedor en su tabla.
        $proveedor->iddirecproveedor = $PRYKEY;
        
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        //Pero deben de revisar el modelo que les toco, en mi caso es "usuariosModel"
        $proveedor->save();
        //Guardamos el telefono en la tabla telefono, al utilizar una llave foranea (idproveedor) tiene que ir en esta parte, cuando ya se ha creado la llave.
        $telefono_prov = new telefonoModelo();
        $telefono_prov->idtelefono = "Tel-".$request->apellidopaterno[0].$request->apellidopaterno[1]."-".$request->apellidomaterno[0].$request->apellidomaterno[1];
        $telefono_prov->telefono = $request->numtelefono;
        $telefono_prov->idproveedor = $proveedor->idproveedor;
        $telefono_prov->save();

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

    public function update(Request $request,proveedorModelo $proveedore)
    {
        //return $request;
        $request->validate($this->reglaV2);
        $proveedore->nombre = $request->nombreEditar;
        $proveedore->apellidopaterno = $request->apellidopaternoEditar;
        $proveedore->apellidomaterno = $request->apellidomaternoEditar;
        $proveedore->correo = $request->correoEditar;

        $direccion = direccionModelo::find($proveedore->iddirecproveedor);
        $direccion->calle=$request->calleEditar;
        $direccion->numero= $request->numextEditar;
        $direccion->idcoldirec = $request->coloniasEditar;
        $direccion->save();
        $proveedore->save();
        $telefono_prov = telefonoModelo::where('idproveedor','=',$proveedore->idproveedor)->get()[0];
        $telefono_prov->telefono = $request->numtelefonoEditar;
        $telefono_prov->save();
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
