<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Artista;
use Carbon\Carbon;

class EventoController extends Controller
{
    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $artistas = Artista::all();
        return view('evento.create', compact('artistas'));
    }

    /**
     * Store a newly created event in storage.
     */
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

        // Convert start and end date/time to Carbon format
        $fecha_inicio = Carbon::parse($request->fecha_inicio . ' ' . $request->hora_inicio);
        $fecha_fin = Carbon::parse($request->fecha_fin . ' ' . $request->hora_fin);

        // Check if the artist already has an event in the same time slot
        $eventoExistente = Evento::whereHas('artistas', function($query) use ($request, $fecha_inicio, $fecha_fin) {
            $query->where('artista_id', $request->artista_id)
                ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                    $query->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->orWhereBetween('fecha_fin', [$fecha_inicio, $fecha_fin])
                        ->orWhere(function($query2) use ($fecha_inicio, $fecha_fin) {
                            $query2->where('fecha_inicio', '<=', $fecha_inicio)
                                ->where('fecha_fin', '>=', $fecha_fin);
                        });
                });
        })->exists();

        if ($eventoExistente) {
            return back()->withErrors(['artista_id' => 'El artista ya tiene un evento registrado en ese horario.'])->withInput();
        }

        // Create the new event
        $evento = Evento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        ]);

        // Associate the artist with the event
        $evento->artistas()->attach($request->artista_id);

        return redirect()->route('eventos.create')
            ->with('success', '¡Evento creado correctamente!');
    }

    /**
     * Display the specified event.
     */
    public function show(Evento $evento)
    {
        // Load the associated artists
        $evento->load('artistas');
        return view('evento.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Evento $evento)
    {
        $artistas = Artista::all();
        // Load the associated artists
        $evento->load('artistas');
        return view('evento.edit', compact('evento', 'artistas'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Evento $evento)
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

        // Convert start and end date/time to Carbon format
        $fecha_inicio = Carbon::parse($request->fecha_inicio . ' ' . $request->hora_inicio);
        $fecha_fin = Carbon::parse($request->fecha_fin . ' ' . $request->hora_fin);

        // Check if the artist already has another event in the same time slot (excluding the current event)
        $eventoExistente = Evento::whereHas('artistas', function($query) use ($request, $fecha_inicio, $fecha_fin, $evento) {
            $query->where('artista_id', $request->artista_id)
                ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                    $query->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->orWhereBetween('fecha_fin', [$fecha_inicio, $fecha_fin])
                        ->orWhere(function($query2) use ($fecha_inicio, $fecha_fin) {
                            $query2->where('fecha_inicio', '<=', $fecha_inicio)
                                ->where('fecha_fin', '>=', $fecha_fin);
                        });
                });
        })->where('id', '!=', $evento->id)->exists();

        if ($eventoExistente) {
            return back()->withErrors(['artista_id' => 'El artista ya tiene un evento registrado en ese horario.'])->withInput();
        }

        // Update the event
        $evento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        ]);

        // Sync the artist (replace existing associations)
        $evento->artistas()->sync([$request->artista_id]);

        return redirect()->route('eventos.show', $evento)
            ->with('success', '¡Evento actualizado correctamente!');
    }

    public function index()
    {
        $eventos = Evento::with('artistas')->get();
        return view('evento.index', compact('eventos'));
    }
}