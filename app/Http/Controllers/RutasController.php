<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
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
                 * En esta parte se llama al controladore de los usuarios,
                 * 
                 * No se si este bien :v jajajajaj pero funciono,
                 * si hay mucho pedo, luego modificamos el archivo web.app xd
                 */
                $controladorUsuarios = new usuarioController();
                return $controladorUsuarios->index();
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
