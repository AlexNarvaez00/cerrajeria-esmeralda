<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicioModelo;

class serviciosController extends Controller{
    public  $nombreUsuario;//Este atributo despues lo revisamos
    protected  $serviciosLista;//Esta variables para guardar la lista de usuarios     

    public function __construct(){        
        $this->serviciosLista = servicioModelo::all(); //Obtiene todos los registros de la tabla servicios
        $this->camposTabla = ['idServicio','fecha y hora','idDirección','monto','Descripción','idCliente']; //Almacena todos los campos de la tabla de la vista
    }   

    public function index()
    {
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        return view('servicios-ventas') //Nombre de la vista 
            ->with('serviciosLista',$this->serviciosLista)           
            ->with('camposTabla',$this->camposTabla);//Campos de la tablas            
            
    }

}
