<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;

class ArtistaController extends Controller
{
    public function create()
    {
        return view('artistas.create');
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required',
            'genero_musical' => 'required',
            'ciudad_origen' => 'required'
        ]);

        // Creación del Artista
        Artista::create($request->all());

        // Redirección a la vista de creación con mensaje de éxito
        return redirect()->route('artistas.create')
            ->with('success', 'Artista registrado correctamente');
    }
}
