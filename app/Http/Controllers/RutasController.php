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
        switch ($nombreVista) {
            case 'usuarios':
                /**
                 * En esta parte se llama al controladore de los usuarios
                 */
                return view('usuarios', [usuarioController::class]);
            break;
            
            default:
                return view($nombreVista);
            break;
        }
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
