<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para las rutas.
 * 
 */
class RutasController extends Controller
{
    public function showView($nombreVista)
    {
        
        return view($nombreVista);
        // switch ($nombreVista) {
        //     case 'usuarios':
        //         # code...
        //         break;
        //     case 'menu':
        //         break;

        //         case 'pro':
        //             break;    

        //     default:
        //         # code...
        //         break;
        // }
    }
}
