<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;
use App\Models\Boleta;
use App\Models\Evento;

class IndexController extends Controller
{
    public function index()
    {
        return view('index.inicio');
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        $results = [];

        // Search artists
        $artistas = Artista::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('genero', 'LIKE', "%{$query}%")
            ->orWhere('ciudad', 'LIKE', "%{$query}%")
            ->get()
            ->map(function ($artista) {
                return [
                    'name' => "Artista: {$artista->nombre} ({$artista->genero})",
                    'type' => 'artista'
                ];
            });

        // Search events
        $eventos = Evento::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('fecha', 'LIKE', "%{$query}%")
            ->orWhere('lugar', 'LIKE', "%{$query}%")
            ->get()
            ->map(function ($evento) {
                return [
                    'name' => "Evento: {$evento->nombre} ({$evento->fecha})",
                    'type' => 'evento'
                ];
            });

        // Search tickets
        $boletas = Boleta::where('localidad', 'LIKE', "%{$query}%")
            ->get()
            ->map(function ($boleta) {
                return [
                    'name' => "Boleta: {$boleta->localidad} (\${$boleta->precio})",
                    'type' => 'boleta'
                ];
            });

        $results = array_merge(
            $artistas->toArray(),
            $eventos->toArray(),
            $boletas->toArray()
        );

        return response()->json([
            'results' => $results
        ]);
    }
}