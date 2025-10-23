<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

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
        } catch (QueryException $e) {
            return redirect()->route('usuarios.create')
                ->with('error', 'No se pudo crear el usuario. Es posible que el correo ya esté registrado.');
        }
    }

    public function show($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return view('usuario.show', compact('usuario'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No se encontró el usuario solicitado.');
        }
    }

    public function edit($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return view('usuario.edit', compact('usuario'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No se encontró el usuario solicitado.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:usuarios,correo,' . $id,
            'contrasena' => 'nullable|string|min:8',
            'tipo' => 'required|in:ADMIN,COMPRADOR',
        ]);

        try {
            $usuario = Usuario::findOrFail($id);

            $data = [
                'nombre' => $validated['nombre'],
                'correo' => $validated['correo'],
                'tipo' => $validated['tipo'],
            ];

            // Only update password if provided
            if (!empty($validated['contrasena'])) {
                $data['contrasena'] = Hash::make($validated['contrasena']);
            }

            $usuario->update($data);

            return redirect()->route('usuarios.show', $id)
                ->with('success', 'Usuario actualizado exitosamente.');
        } catch (QueryException $e) {
            return redirect()->route('usuarios.edit', $id)
                ->with('error', 'No se pudo actualizar el usuario. Es posible que el correo ya esté registrado.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.edit', $id)
                ->with('error', 'No se encontró el usuario solicitado.');
        }
    }
}