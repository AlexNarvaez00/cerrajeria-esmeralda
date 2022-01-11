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
        $this->camposTabla = ['ID','Nombre','ApellidoPaterno','ApellidoMaterno','Número de Teléfono','Correo','ID Dirección','Editar','Borrar']; //Titulos de la tabla en la vista de proveedores
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
        if(count($request->all()) >= 0){                                    //Condición para el imput de búsques que se encuentra en la vista de proveedores
            $listaProveedores = proveedorModelo::where('idproveedor','like',$request->inputBusqueda.'%')                //Consulta con where para buscar todos los registros que coincidan con el id a buscar
            ->paginate(6);                                                  //Paginado a 6 registros por página
        }else{
            //Sino tiene nada
            //Que lo rellene con todos los registros 
            $listaProveedores = proveedorModelo::paginate(6);
        }
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
        //Se crea una llave primaria a partir de los datos del formulario
        $llavePrimaria = "PROV-".
        strtoupper($request->apellidopaterno[0]).
        strtoupper($request->apellidopaterno[1]).
        strtoupper("-".$request->apellidomaterno[0]).
        strtoupper($request->apellidomaterno[1]).
        strtoupper($request->numext[0]).
        strtoupper($request->numext[1]);

        //Nombre del campo BD----- Nombre input formulario
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
        $direccion->calle=$request->calle;
        $direccion->numero= $request->numext;
        $direccion->idcoldirec = $request->colonias;
        $PRYKEY = $direccion->iddireccion;
        $direccion->save();

        //Campo de dirección del proveedor en su tabla.
        $proveedor->iddirecproveedor = $PRYKEY;
        
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        $proveedor->save();
        //Guardamos el telefono en la tabla telefono, al utilizar una llave foranea (idproveedor) tiene que ir en esta parte, cuando ya se ha creado la llave.
        $telefono_prov = new telefonoModelo();
        $telefono_prov->idtelefono = "Tel-".$request->apellidopaterno[0].$request->apellidopaterno[1]."-".$request->apellidomaterno[0].$request->apellidomaterno[1];    //Se crea un ID (llave primaria)para el registro en la tabla
        $telefono_prov->telefono = $request->numtelefono;                                       //Número de telefono del proveedor que se almacena en la tabla telefono_proveedor
        $telefono_prov->idproveedor = $proveedor->idproveedor;                                  //Llave foranea (ID proveedor)
        $telefono_prov->save();                                                                 //Se guarda el registro

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
        $telefono_prov = telefonoModelo::where('idproveedor','=',$proveedore->idproveedor)->get()[0];   //Se realiza la consulta a la tabla telefono cuando el id del proveedor coincida
        if($telefono_prov!=null){                                                        //Se evalua la consulta si esta es diferente de null (si hay un registro de telefono)
            $telefono_prov->delete();                                                    //Si la condición se cumple procede a borrar el registro de la tabla
            }
            $direcciontemp = $proveedore->iddirecproveedor;                              //Se hace un guardado de la dirección del proveedor antes de su borrado (esto por las llaves foraneas)
            $direccion= direccionModelo::find($direcciontemp);                           //Se busca la dirección antes guardada en la tabla dirección
            $proveedore->delete();                                                       //Se procede a borrar el registro del proveedor en la tabla proveedor
            $direccion->delete();                                                        //Se procede a borrar el registro de la dirección en la tabla dirección
        return redirect()->route('proveedores.index');
    }

    public function update(Request $request,proveedorModelo $proveedore)                //Método que nos permite actualizar el registro seleccionado
    {
        //return $request;
        $request->validate($this->reglaV2);                                             //A las entradas (imputs) se les valida con reglaV2
        $proveedore->nombre = $request->nombreEditar;                                   //Estos datos serán los que se podrán actualziar de un proveedor
        $proveedore->apellidopaterno = $request->apellidopaternoEditar;
        $proveedore->apellidomaterno = $request->apellidomaternoEditar;
        $proveedore->correo = $request->correoEditar;

        $direccion = direccionModelo::find($proveedore->iddirecproveedor);              //Se busca (find)el registro que se está editando en la tabla de dirección para posteriormente actualizar sus datos
        $direccion->calle=$request->calleEditar;                                        //Los datos a actualizar incluyen de igual manera los siguientes
        $direccion->numero= $request->numextEditar;
        $direccion->idcoldirec = $request->coloniasEditar;
        $direccion->save();                                                             //Se realiza el guardado de estos datos en la tabla dirección
        $proveedore->save();                                                            //Se realiza el guardado de estos datos en la tabla proveedor
        $telefono_prov = telefonoModelo::where('idproveedor','=',$proveedore->idproveedor)->get()[0];   //Se realiza un consulta (esto devuelve una lista) en el modelo telefonoModelo o tabla (telefono_proveedor) para coincidir en el registro a editar
        $telefono_prov->telefono = $request->numtelefonoEditar;                         //Se actualizan sus registros
        $telefono_prov->save();                                                         //Se realiza el guardado de estos datos en la tabla telefono_proveedor
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
        $llavePrimaria = $request->idmunicipio;                                         //Recuperamos la llave primaria de los Municipios
        $listaColonias = coloniaModelo::where('idmunicol','=',$llavePrimaria)->get();   //Lista de municipios que coincidan con la llave primaria
        return response()->json($listaColonias);
    }

}
