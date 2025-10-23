<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo|max:255',
            'contrasena' => 'required|string|min:8',
            'tipo' => 'required|in:ADMIN,COMPRADOR',
        ]);

        try {
            Usuario::create([
                'nombre' => $validated['nombre'],
                'correo' => $validated['correo'],
                'contrasena' => Hash::make($validated['contrasena']),
                'tipo' => $validated['tipo'],
            ]);

            return redirect()->route('usuarios.create')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.create')->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }
}