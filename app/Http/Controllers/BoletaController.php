<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Localidad;
use App\Models\Boleta;

class BoletaController extends Controller
{
    public function create()
    {
        return view('boletas.create', [
            'eventos' => Evento::all(),
            'localidades' => Localidad::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'localidad_id' => 'required|exists:localidades,id',
            'precio' => 'required|numeric',
            'cantidad_total' => 'required|integer',
        ]);

        Boleta::create([
            'evento_id' => $request->evento_id,
            'localidad_id' => $request->localidad_id,
            'precio' => $request->precio,
            'cantidad_total' => $request->cantidad_total,
            'cantidad_disponible' => $request->cantidad_total,
        ]);

        return redirect()->route('boletas.create')
        ->with('success', 'Localidad creada correctamente');
    }
}