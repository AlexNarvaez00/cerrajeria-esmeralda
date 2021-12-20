<?php

namespace App\Http\Controllers;

use App\Models\reporteProductosModelo;
use App\Models\reporteVentasModelo;
use App\Models\ventaModelo;
use Illuminate\Http\Request;


class reporteProductosController extends Controller
{
     /**
     * Atributos ...
     */
    protected $reporteLista; //para guardar lista de clientes
    private $camposVista;

    public function __construct()
    {
        $this->camposVista = ['Folio venta', 'ID Usuario', 'Fecha', 'Consultar','Borrar'];
    }

    public function index(Request $request)
    {
        $listaReporte = null;
        if(count($request->all()) >= 0){
            $listaReporte = $this->getVentasPorConsulta($request);
        }else{
            //se rellena con todos los registros
            $listaReporte = reporteProductosModelo::paginate(10);
        }

        $aniosDisponible = reporteProductosModelo::selectRaw('year(fechayhora) as anio')->groupBy('anio')->get();
        return view('reporteProductos')
            ->with ('camposVista', $this ->camposVista)
            ->with ('aniosDisponibles', $aniosDisponible)
            ->with('registrosVista', $listaReporte);
        
    }

    private function getVentasPorConsulta(Request $request){
        $rows = null;

        if($request->has('inputBusqueda') && $request->inputBusqueda != null ){
            $rows = reporteProductosModelo::where('folio_v','like',$request->inputBusqueda.'%');
        }
        if($request->has('inputSelectorMes') && $request->inputSelectorMes != null && $request->inputSelectorMes != "0"){
            if($rows == null){
                $rows = reporteProductosModelo::all();     
            }
            $rows = $rows->whereMonth('fechayhora','=',$request->inputSelectorMes);
        }
        if($request->has('inputSelectorAnio') && $request->inputSelectorAnio != null && $request->inputSelectorAnio != "0"){
            if($rows == null){
                $rows = reporteProductosModelo::all();     
            }
            $rows = $rows->whereYear('fechayhora','=',$request->inputSelectorAnio);
        }

        if($rows == null){
            $rows = reporteProductosModelo::paginate(10);     
        }else{
            $rows = $rows->paginate(10);
        }
        return $rows;
    }


    public function store(Request $request)
    {
        $reporte = new reporteVentasModelo();
       
        $reporte->clave_producto = $request->nombre; 
        $reporte->observaciones = $request->observaciones; #checar input     
        $PRYKEY=$reporte->clave_producto;

        $reporte->save();

        $ventas = new ventaModelo();
        $ventas->folio_v = "RV-".$request->clave_producto;
        $ventas->fechayhora = $request->fechayhora; #checar nombre input
        $PRYKEY=$ventas->folio_v;

        $ventas->save();
        
        return redirect()->route('reporteVentas.index');       
    }

    public function show(Request $request, $reporte)
    {

    }
    /**
     * Método para borrar registros de la base de datos
     */
    public function destroy(reporteProductosModelo $reporte){
        $reporte->delete();
        return redirect()->route('reporteProductos.index');
    }
}