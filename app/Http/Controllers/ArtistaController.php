<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    public function create()
    {
        return view('artistas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'genero_musical' => 'required',
            'ciudad_origen' => 'required'
        ]);

        Artista::create($request->all());

        return redirect()->back()->with('success', 'Artista registrado correctamente');
    }
}
