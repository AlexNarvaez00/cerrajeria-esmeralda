<?php

namespace App\Http\Controllers;

use App\Models\reporteProductosModel;
use App\Models\reporteProductosModelo;
use App\Models\reporteVentasModelo;
use App\Models\ventaModelo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class reporteProductosController extends Controller
{
     /**
     * Atributos ...
     */
    public $nombreUsuario; //pendiente revisar
    protected $reporteLista; //para guardar lista de clientes
    private $camposVista;

    public function __construct()
    {
        $this->nombreUsuario = 'Narvaez';
        $this->camposVista = ['Clave Venta', 'Clave Producto', 'Descripcion', 'Fecha', 'Borrar'];
    }

    public function index(Request $request)
    {
        $listaReporte = null;
        if(count($request->all()) >= 0){
            $listaReporte = reporteProductosModelo::where('folio_v','like',$request->inputBusqueda.'%')
                                    ->get();
        }else{
            //se rellena con todos los registros
            $listaReporte = reporteProductosModelo::all();
        }
        return view('reporteProductos')
            ->with ('nombreUsuarioVista', $this->nombreUsuario)
            ->with ('camposVista', $this ->camposVista)
            ->with('registrosVista', $listaReporte);
        
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