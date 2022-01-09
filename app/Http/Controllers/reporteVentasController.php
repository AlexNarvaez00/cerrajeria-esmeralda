<?php

namespace App\Http\Controllers;

use App\Models\servicioModelo;
use App\Models\reporteVentasModelo;
use App\Models\productosModelo;
use Illuminate\Http\Request;

/**
 * Clase controladora para "Reporte de venta de servicios"
 * 
 * 
*/
class reporteVentasController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario; //Este atributo despues lo revisamos
    protected  $reporteLista; //Esta variables para guardar la lista de usuarios

    private $camposVista;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        
        //$this->reporteLista=servicioModelo::all();
        //$this->usuariosLista = usuariosModel::all();
        /**
         * Del modelo de caprta App/Http/Models
         *  
         */

        $this->camposTabla = ["#","Fecha/Hora","ID Direccion","Monto","Descripcion","ID Cliente","Ver"];
    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
     */
    public function index(Request $request)
    {
        $listaReporte = null;
        if (count($request->all()) >= 0) {
            $listaReporte = $this->getServiciosPorConsulta($request);
        } else {
            //se rellena con todos los registros
            $listaReporte = servicioModelo::paginate(10);
        }
        $aniosDisponible = servicioModelo::selectRaw('year(fechayhora) as anio')->groupBy('anio')->get();
        return view('reporteVentasServicios') //Nombre de la vista
            ->with('camposTabla',$this->camposTabla)//Campos de la tablas
            ->with('aniosDisponibles', $aniosDisponible)
            ->with('registrosVista',$listaReporte);//Registros de la tabla
    }
    /**
     * Obtiene los registros, dependiendo de la consulta.
     * @return $rows Registros filtrados. 
     */
    private function getServiciosPorConsulta(Request $request)
    {
        $rows = null;

        if ($request->has('inputBusqueda') && $request->inputBusqueda != null) {
            $rows = servicioModelo::where('idservicio', 'like', $request->inputBusqueda . '%');
        }
        if ($request->has('inputSelectorMes') && $request->inputSelectorMes != null && $request->inputSelectorMes != "0") {
            if ($rows == null) {
                $rows = servicioModelo::where('idservicio', 'like', '%');
            }
            $rows = $rows->whereMonth('fechayhora', '=', $request->inputSelectorMes);
        }
        if ($request->has('inputSelectorAnio') && $request->inputSelectorAnio != null && $request->inputSelectorAnio != "0") {
            if ($rows == null) {
                $rows = servicioModelo::where('idservicio', 'like', '%');
            }
            $rows = $rows->whereYear('fechayhora', '=', $request->inputSelectorAnio);
        }

        if ($rows == null) {
            $rows = servicioModelo::paginate(10);
        } else {
            $rows = $rows->paginate(10);
        }
        return $rows;
    }

    /**
     * Regresa el JOIN entre las tablas detalleventa, venta y productos
     * @param $folio_v Registro de la venta en la base de datos. 
     */
    public function getServicesAtFolio(servicioModelo $servicio)
    {
        $query1 = productosModelo::
                    join('detalleservicio as ds', 'ds.clave_producto', '=', 'productos.clave_producto')
                    ->where('ds.idservicio', '=', $servicio->idservicio)
                    ->get();
       return response()->json($query1);
    }

    /**
     * @param $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario.
     * 
     */
    public function store(Request $request)
    {
        
    }


    /**
     * 
     * 
     */
    public function show(Request $request, $usuario)
    {
        
    }

}
