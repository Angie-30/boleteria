<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    public function create()
    {
        return view('evento.create'); // Cambié a 'evento.create'
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'hora_inicio' => 'required',
            'fecha_fin' => 'required|date',
            'hora_fin' => 'required',
        ]);

        Evento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio . ' ' . $request->hora_inicio . ':00',
            'fecha_fin' => $request->fecha_fin . ' ' . $request->hora_fin . ':00',
        ]);

        return redirect()->route('eventos.create')  // ← ESTO TE LLEVA A /eventos/crear
            ->with('success', '¡Evento creado correctamente!');
    }
}