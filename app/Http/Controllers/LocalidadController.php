<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localidad;

class LocalidadController extends Controller
{
    public function create()
    {
        return view('localidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Localidad::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->back()->with('success', 'Localidad creada correctamente');
    }
}
