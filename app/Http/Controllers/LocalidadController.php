<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localidad;
use Illuminate\Database\QueryException;

class LocalidadController extends Controller
{
    public function create()
    {
        return view('localidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50|unique:localidades,nombre'
        ]);

        try {
            Localidad::create([
                'nombre' => $request->nombre
            ]);

            return redirect()->route('localidades.create')
                ->with('success', 'Localidad creada correctamente');
        } catch (QueryException $e) {
            return redirect()->route('localidades.create')
                ->with('error', 'No se pudo crear la localidad. Es posible que ya exista una con ese nombre.');
        }
    }

    public function show($id)
    {
        try {
            $localidad = Localidad::findOrFail($id);
            return view('localidades.show', compact('localidad'));
        } catch (\Exception $e) {
            return redirect()->route('localidades.index')
                ->with('error', 'No se encontró la localidad solicitada.');
        }
    }

    public function edit($id)
    {
        try {
            $localidad = Localidad::findOrFail($id);
            return view('localidades.edit', compact('localidad'));
        } catch (\Exception $e) {
            return redirect()->route('localidades.index')
                ->with('error', 'No se encontró la localidad solicitada.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:50|unique:localidades,nombre,' . $id
        ]);

        try {
            $localidad = Localidad::findOrFail($id);
            $localidad->update([
                'nombre' => $request->nombre
            ]);

            return redirect()->route('localidades.show', $id)
                ->with('success', 'Localidad actualizada correctamente');
        } catch (QueryException $e) {
            return redirect()->route('localidades.edit', $id)
                ->with('error', 'No se pudo actualizar la localidad. Es posible que ya exista una con ese nombre.');
        } catch (\Exception $e) {
            return redirect()->route('localidades.edit', $id)
                ->with('error', 'No se encontró la localidad solicitada.');
        }
    }
}