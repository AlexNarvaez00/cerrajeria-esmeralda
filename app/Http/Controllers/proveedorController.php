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

/** 
 * @author Roberto Alejandro Vásquez Alcántara
*/
class proveedorController extends Controller
{
     /*
     | ------------------------------
     | proveedorController
     | ------------------------------
     | El controlador es utilizado para recuperar
     | la lista de los proveedores en el sistema, mostrando
     | la información básica de los mismos en una tabla
     |
     */

     /**
      * La lista de proveedores recuperada de
      * la base de datos
      * @var array
      */
    protected  $proveedoresLista;

    /**
     * La lista de estados que se mostrarán en un selector
     * al momento de registrar la dirección de un proveedor
     * 
     * @var array
     */
    private $estadosLista;

    /**
     * La lista de campos que se mostrarán en la tabla
     * principal de los proveedores
     * @var array
     */
    private $camposTabla;


    /*---------------------------Constantes-------------------- */
    /**
     * Arreglo de reglas para validar los campos enviados
     * por el formulario, esta validación sirve cuando el
     * proveedor es registrado por primera vez
     * @var array
     */
    private $reglaV = [
        'nombre' => 'required|regex:/^[A-Z][a-zÀ-ÿ\s]/',
        'apellidopaterno' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'apellidomaterno' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'numtelefono' => 'required|regex:/^[0-9]{10}$/',
        'correo' => 'required|email',
        'calle' => 'required|regex:/^[A-Z][a-zÀ-ÿ\s]{1,40}/',
        'numext' => 'required|regex:/^[0-2]+[0-9][0-9]$/' 
    ];

    /**
     * Arreglo de reglas para validar loos campos enviados
     * por el formulario, esta validación sirve cuando los 
     * datos del usuario son actualizados
     * @var array
     */
    private $reglaV2 = [
        'nombreEditar' => 'required|regex:/^[A-Z][a-zÀ-ÿ\s]/',
        'apellidopaternoEditar' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'apellidomaternoEditar' => 'required|regex:/^[A-Z][a-zÀ-ÿ]{2,25}$/',
        'numtelefonoEditar' => 'required|regex:/^[0-9]{10}$/',
        'correoEditar' => 'required|email'
    ];


    //Pagina para referenciar las cosas 
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    /**
     * ----------------------
     * Contructor
     * ----------------------
     * 
     * Inicializa la lista de roles, campos de la tabla.
     */
    public function __construct()
    {
        $this->camposTabla = ['ID','Nombre','ApellidoPaterno','ApellidoMaterno','Número de Teléfono','Correo','ID Dirección','Editar','Borrar']; //Titulos de la tabla en la vista de proveedores
    }
    
    /**
     * Función que es ejecutada cuando la ruta de "proveedores" es 
     * solicitada por el navegador
     * 
     * @param request $request Solicitud por parte del navegador
     * 
     * @return View Vista de proveedores
    */
    public function index(Request $request)
    {
        $listaProveedores = null;
        if(count($request->all()) >= 0){                                    
            $listaProveedores = proveedorModelo::where('idproveedor','like',$request->inputBusqueda.'%')
            ->paginate(6);                                               
        }else{ 
            $listaProveedores = proveedorModelo::paginate(6);
        }

        foreach ($listaProveedores as $proveedor) { 
            $telefonos=telefonoModelo::where('idproveedor','=',$proveedor->idproveedor)->get();
            if(count($telefonos)>0){
            $proveedor->telefono=$telefonos[0]->telefono;
            }
        }

        $estadosLista = estadosModelo::all();
        return view('proveedores') //Nombre de la vista
            ->with('camposTabla', $this->camposTabla) //Campos de la tablas
            ->with('registrosVista', $listaProveedores) //Registros de la tabla
            ->with('registroEstados',$estadosLista);    // Listado de los Estados
    }

    /**
     * Función para guardar un nuevo registro en la base de datos.
     * 
     * @param Request $request Este objeto se encarga de recibir la información
     * que enviamos por el formulario, de manera oculta
     * 
     * @return Redirect Redirecciona a la vista principal
     */
    public function store(Request $request){

        //Creamos un nuevo objeto.
        $proveedor = new proveedorModelo();

        //Validación de los campos
        $request->validate($this->reglaV);

        //Se crea una llave primaria para el proveedor a partir de los datos del formulario
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

        //Se crea un nuevo objeto y guarda una dirección con la información del proveedor 
        //para posteriormente usarla en el campo de dirección de la tabla
        $direccion = new direccionModelo();
        $direccion->iddireccion = "DIC-".
        strtoupper($request->numext[0]).
        strtoupper($request->numext[1]).
        strtoupper($request->apellidopaterno[0]).
        strtoupper($request->apellidopaterno[1]).
        strtoupper("-").
        strtoupper($request->apellidomaterno[0]).
        strtoupper($request->apellidomaterno[1]);
        $direccion->calle=$request->calle;
        $direccion->numero= $request->numext;
        $direccion->idcoldirec = $request->colonias;
        $PRYKEY = $direccion->iddireccion;
        $direccion->save();

        //Campo de dirección del proveedor en su tabla.
        $proveedor->iddirecproveedor = $PRYKEY;
        
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        $proveedor->save();

        //Guardamos el telefono en la tabla telefono, al utilizar una llave foranea (idproveedor) 
        //tiene que ir en esta parte, cuando ya se ha creado la llave.
        $telefono_prov = new telefonoModelo();
        //Se crea un ID (llave primaria)para el registro en la tabla
        $telefono_prov->idtelefono = "Tel-".
        strtoupper($request->apellidopaterno[0]).
        strtoupper($request->apellidopaterno[1]).
        strtoupper("-").
        strtoupper($request->apellidomaterno[0]).
        strtoupper($request->apellidomaterno[1]);
        $telefono_prov->telefono = $request->numtelefono;                 //Número de telefono del proveedor que se almacena en la tabla telefono_proveedor
        $telefono_prov->idproveedor = $proveedor->idproveedor;            //Llave foranea (ID proveedor)
        $telefono_prov->save();                                           //Se guarda el registro
        return redirect()->route('proveedores.index');
    }

    /**
     * Función para borrar un registro de la tabla de "proveedores".
     * 
     * @param proveedorModelo $proveedore Registro de la base de datos que será borrado, laravel lo detecta solo.
     * 
     * @return Redirector Redirecciona a la vista principal.
    */
    public function destroy(proveedorModelo $proveedore){

        $telefono_prov = telefonoModelo::where('idproveedor','=',$proveedore->idproveedor)->get();   //Se realiza la consulta a la tabla telefono cuando el id del proveedor coincida
        if(count($telefono_prov)!=null){                                                        //Se evalua la consulta si esta es diferente de null (si hay un registro de telefono)
            $telefono_prov[0]->delete();                                                    //Si la condición se cumple procede a borrar el registro de la tabla
            }


        $direcciontemp = $proveedore->iddirecproveedor;                              //Se hace un guardado de la dirección del proveedor antes de su borrado (esto por las llaves foraneas)
        $direccion= direccionModelo::find($direcciontemp);                           //Se busca la dirección antes guardada en la tabla dirección
        $proveedore->delete();                                                       //Se procede a borrar el registro del proveedor en la tabla proveedor
        $direccion->delete();                                                        //Se procede a borrar el registro de la dirección en la tabla dirección
        return redirect()->route('proveedores.index');
    }

    /**
     * Actualiza la información básica de un Proveedor
     * 
     * @param Request $request Solicitud por parte del Proveedor
     * @param proveedorModelo $proveedore Usuario al que se le actualiza la información
     * 
     * @return Redirector Redirecciona a la vista principal
     */
    public function update(Request $request,proveedorModelo $proveedore)                //Método que nos permite actualizar el registro seleccionado
    {
        $request->validate($this->reglaV2);                                             //A las entradas (imputs) se les valida con reglaV2
        
        $proveedore->nombre = $request->nombreEditar;                                   //Estos datos serán los que se podrán actualziar de un proveedor
        $proveedore->apellidopaterno = $request->apellidopaternoEditar;
        $proveedore->apellidomaterno = $request->apellidomaternoEditar;
        $proveedore->correo = $request->correoEditar;
        //Se busca (find)el registro que se está editando en la tabla de dirección para posteriormente actualizar sus datos
        $direccion = direccionModelo::find($proveedore->iddirecproveedor);              
        $direccion->calle=$request->calleEditar;                                        //Los datos a actualizar incluyen de igual manera los siguientes
        $direccion->numero= $request->numextEditar;
        $direccion->idcoldirec = $request->coloniasEditar;
        $direccion->save();                                                             //Se realiza el guardado de estos datos en la tabla dirección
        $proveedore->save();                                                            //Se realiza el guardado de estos datos en la tabla proveedor
        //Se realiza un consulta (esto devuelve una lista) en el modelo telefonoModelo o tabla (telefono_proveedor) para coincidir en el registro a editar
        $telefono_prov = telefonoModelo::where('idproveedor','=',$proveedore->idproveedor)->get()[0];   
        $telefono_prov->telefono = $request->numtelefonoEditar;                         //Se actualizan sus registros
        $telefono_prov->save();                                                         //Se realiza el guardado de estos datos en la tabla telefono_proveedor
        return redirect()->route('proveedores.index');
    }

    /**
     * Función para obtener los municipios de acuerdo al estado seleccionado
     * 
     * @param Request $request Se encarga de recibir la peticion que se realiza por medio de AJAX
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

    /**
     * Función para obtener las colonias de acuerdo al municipio seleccionado
     * 
     * @param Request $request Se encarga de recibir la peticion que se realiza por medio de AJAX
     */
    public function getColonias(Request $request)
    {  
        $llavePrimaria = $request->idmunicipio;                                         //Recuperamos la llave primaria de los Municipios
        $listaColonias = coloniaModelo::where('idmunicol','=',$llavePrimaria)->get();   //Lista de municipios que coincidan con la llave primaria
        return response()->json($listaColonias);
    }

    /**
     * Función vacia (No hace nada)
     * 
     * @param proveedorModelo $proveedore Usuario a editar, laravel lo detecta solo.
     * 
     */
    public function edit(proveedorModelo $proveedore)
    {
    }

    /**
     * Función vacia (No hace nada).
     * @param Request $request Solicitud por parte del navegador.
     * @param proveedorModelo $proveedore Registro de la tabla "Usuario"
     * 
     */
    public function show(Request $request, proveedorModelo $proveedore)
    {
    }
}
