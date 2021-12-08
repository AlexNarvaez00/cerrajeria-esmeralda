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
        return view($nombreVista);
    }
}
