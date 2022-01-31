<?php

namespace App\Http\Controllers;

use App\Models\productosModelo;
use Illuminate\Http\Request;

class Notificaciones extends Controller
{
    /**
     * Atributos 
     */
    public $parameters;


    public function __construct()
    {
        $this->parameters = [
            'productosEscasos' => $this->getNotify(),
            // 'cantidad' =>  count(productosModelo::whereBetween('cantidad_existencia', [0, 5]))
        ];
    }
    /**
     * Realiza una peticion a la Tabla de 
     * productos.
     *  
     */
    private function getNotify()
    {
        $productos = productosModelo::whereBetween('cantidad_stock', [0, 2])->paginate(10);
        $informacionNotificacion = array();
        for ($index = 0; $index < count($productos); $index++) {
            $titulo = '';
            $conclusion = '';

            if ($productos[$index]->cantidad_stock == 0) {
                $titulo = 'El producto se ha terminado.';
                $conclusion='se ha terminado';
            } else {
                $titulo = 'El producto esta por terminarse';
                $conclusion='esta por terminarse, cuenta con '.
                        $productos[$index]->cantidad_existencia.
                        ' unidades existentes.';
            }

            $informacionNotificacion[]  = [
                'producto' => $productos[$index],
                'titulo' => $titulo,
                'conclusion' => $conclusion
            ];
        }
        return $informacionNotificacion;
    }


    public function existsNotify(){
        $data = productosModelo::whereBetween('cantidad_stock',[0,2])->get()->count();
        $resut= ["cantidad"=>$data];
        return response()->json($resut);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notificaciones', $this->parameters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
