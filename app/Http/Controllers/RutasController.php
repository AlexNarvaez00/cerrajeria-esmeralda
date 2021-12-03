<?php

namespace App\Http\Controllers;

use App\Models\ventaModelo;
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
            case 'proveedores':
                /**
                 * En esta parte se llama al controladore de los proveedores,
                 * 
                 * No se si este bien :v jajajajaj pero funciono,
                 * si hay mucho pedo, luego modificamos el archivo web.app xd
                 */
                $controladorProveedor = new proveedorController();
                return $controladorProveedor->index();
            case 'productos':
                /**
                 * En esta parte se llama al controladore de los productos,
                 * 
                 * No se si este bien :v jajajajaj pero funciono,
                 * si hay mucho pedo, luego modificamos el archivo web.app xd
                 */
                $controladorProductos = new productosController();
                return $controladorProductos->index();
            case 'clientes':
                /**
                 * En esta parte se llama al controladore de los clientes,
                 * 
                 * No se si este bien :v jajajajaj pero funciono,
                 * si hay mucho pedo, luego modificamos el archivo web.app xd
                 */
                $clientesController = new clienteController();
                return $clientesController->index();
            case 'ventas':
                /**
                 * En esta parte se llama al controladore de los ventas,
                 * 
                 * No se si este bien :v jajajajaj pero funciono,
                 * si hay mucho pedo, luego modificamos el archivo web.app xd
                 */
                $ventasController = new ventaModelo();
                return $ventasController->index();

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
