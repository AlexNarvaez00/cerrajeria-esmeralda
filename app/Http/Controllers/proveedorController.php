<?php

namespace App\Http\Controllers;

use App\Models\proveedorModelo;
use Illuminate\Http\Request;

class proveedorController extends Controller
{
     /**
     * Atributos ...
     */
    protected  $proveedoresLista;//Esta variables para guardar la lista de proveeores
    private $camposTabla;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->proveedoresLista=proveedorModelo::all();
            /**
             * Del modelo de caprta App/Http/Models
             *  
            */

        $this->camposTabla = ['ID','Nombre','ApP','ApM','Correo','Editar','Borrar'];
    }
    
    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    public function index()
    {
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        return view('proveedores') //Nombre de la vista
            ->with('camposTabla',$this->camposTabla)//Campos de la tablas
            ->with('registrosVista',$this->proveedoresLista);//Registros de la tabla
    }

    public function show()
    {
        # code...
    }
}
