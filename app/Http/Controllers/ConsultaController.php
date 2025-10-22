<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class ConsultaController extends Controller
{
        public function index(Request $request)
    {
        $eventos = Evento::with(['boletas', 'artistas'])->get();

        return view('consulta.index', compact('eventos'));
    }
}
