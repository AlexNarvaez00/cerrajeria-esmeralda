<?php

namespace App\Http\Controllers;

use App\Models\proveedorModelo;
use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\coloniaModelo;
use Illuminate\Http\Request;
use DB;

class proveedorController extends Controller
{
     /**
     * Atributos ...
     */
    public  $nombreUsuario; //Este atributo despues lo revisamos
    protected  $proveedoresLista;//Esta variables para guardar la lista de proveeores
    protected  $estadosLista;
    private $camposTabla;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez ';
       //$this->estadosLista = estadosModelo::all();
            /**
             * Del modelo de caprta App/Http/Models
             *  
            */

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

        //$municipio =DB::table('municipio');
        //Obtener el valor del idestado (id de la tabla en la DB) en este caso como ejemplo es "1", no sé como obtenerlo de la vista para que al momento de seleccionarlo se muestre
        //el o los municipios de ese estado.

        $municipiosLista = municipiosModelo::all();

        // obtener el valor del idmunicol (id de la tabla en la DB) en este caso "327" para que se obtenga de la vista y así seleccionando se muestre la colonia
        $coloniaLista = coloniaModelo::all();
        $estadosLista =estadosModelo::all();
        return view('proveedores') //Nombre de la vista
            ->with('nombreUsuarioVista', $this->nombreUsuario) //Titulo de la vista
            ->with('camposTabla', $this->camposTabla) //Campos de la tablas
            ->with('registrosVista', $listaProveedores) //Registros de la tabla
            ->with('registroEstados',$estadosLista)
            ->with('registroMunicipio',$municipiosLista)
            ->with('registroColonia',$coloniaLista);
    }

    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = municipiosModelo::where($select,$value)
        ->grouepBy($dependent)
        ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
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
        $proveedor->iddirecproveedor = "Dir-001";
        
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
}
