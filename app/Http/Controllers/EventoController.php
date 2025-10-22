<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Artista;

class EventoController extends Controller
{
    public function create()
    {
        $artistas = Artista::all();
        return view('evento.create', compact('artistas')); // Pass $artistas to the view
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'artista_id' => 'required|exists:artistas,id',
            'fecha_inicio' => 'required|date',
            'hora_inicio' => 'required',
            'fecha_fin' => 'required|date',
            'hora_fin' => 'required',
        ]);

        $evento = Evento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio . ' ' . $request->hora_inicio . ':00',
            'fecha_fin' => $request->fecha_fin . ' ' . $request->hora_fin . ':00',
        ]);
        
        $evento->artistas()->attach($request->artista_id);

        return redirect()->route('eventos.create')
            ->with('success', '¡Evento creado correctamente!');
    }
}