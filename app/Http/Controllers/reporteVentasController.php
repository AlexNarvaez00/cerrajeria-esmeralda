<?php

namespace App\Http\Controllers;

use App\Models\reporteVentasModelo;
use Illuminate\Http\Request;

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
        $this->reporteLista=reporteVentasModelo::all();
        //$this->usuariosLista = usuariosModel::all();
        /**
         * Del modelo de caprta App/Http/Models
         *  
         */

        $this->camposTabla = ['Clave Venta', 'Descripcion', 'Fecha', 'Editar', 'Borrar'];
    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
     */
    public function index(Request $request)
    {
        return view('reporteProductos') //Nombre de la vista
            ->with('camposTabla',$this->camposTabla)//Campos de la tablas
            ->with('registrosVista',$this->reporteLista);//Registros de la tabla
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
    /**
     * Este metodo sirve para borrar los registros de la base de datos,
     * deben de tener cuidado :v 
     * 
    */


}
