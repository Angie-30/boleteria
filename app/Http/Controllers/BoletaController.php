<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Localidad;
use App\Models\Boleta;
use Illuminate\Database\QueryException;

class BoletaController extends Controller
{
    public function create()
    {
        return view('boletas.create', [
            'eventos' => Evento::all(),
            'localidades' => Localidad::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'localidad_id' => 'required|exists:localidades,id',
            'precio' => 'required|numeric',
            'cantidad_total' => 'required|integer',
        ]);

        try {
            // Verificar si ya existe una boleta con el mismo evento y localidad
            $existeBoleta = Boleta::where('evento_id', $request->evento_id)
                ->where('localidad_id', $request->localidad_id)
                ->exists();

            if ($existeBoleta) {
                return redirect()->route('boletas.create')
                    ->with('error', 'Ya existe una boleta para este evento y localidad.');
            }

            Boleta::create([
                'evento_id' => $request->evento_id,
                'localidad_id' => $request->localidad_id,
                'precio' => $request->precio,
                'cantidad_total' => $request->cantidad_total,
                'cantidad_disponible' => $request->cantidad_total,
            ]);

            return redirect()->route('boletas.create')
                ->with('success', 'Boleta creada correctamente');
        } catch (QueryException $e) {
            return redirect()->route('boletas.create')
                ->with('error', 'No se pudo crear la boleta. Es posible que ya exista para este evento y localidad.');
        }
    }

    public function show($id)
    {
        try {
            $boleta = Boleta::with(['evento', 'localidad'])->findOrFail($id);
            return view('boletas.show', compact('boleta'));
        } catch (\Exception $e) {
            return redirect()->route('boletas.index')
                ->with('error', 'No se encontró la boleta solicitada.');
        }
    }

    public function edit($id)
    {
        try {
            $boleta = Boleta::findOrFail($id);
            $eventos = Evento::all();
            $localidades = Localidad::all();
            return view('boletas.edit', compact('boleta', 'eventos', 'localidades'));
        } catch (\Exception $e) {
            return redirect()->route('boletas.index')
                ->with('error', 'No se encontró la boleta solicitada.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'localidad_id' => 'required|exists:localidades,id',
            'precio' => 'required|numeric',
            'cantidad_total' => 'required|integer',
        ]);

        try {
            $boleta = Boleta::findOrFail($id);

            // Verificar si ya existe otra boleta con el mismo evento y localidad
            $existeBoleta = Boleta::where('evento_id', $request->evento_id)
                ->where('localidad_id', $request->localidad_id)
                ->where('id', '!=', $id)
                ->exists();

            if ($existeBoleta) {
                return redirect()->route('boletas.edit', $id)
                    ->with('error', 'Ya existe otra boleta para este evento y localidad.');
            }

            // Asegurar que cantidad_disponible no sea mayor que cantidad_total
            $cantidadDisponible = $request->cantidad_total < $boleta->cantidad_disponible 
                ? $request->cantidad_total 
                : $boleta->cantidad_disponible;

            $boleta->update([
                'evento_id' => $request->evento_id,
                'localidad_id' => $request->localidad_id,
                'precio' => $request->precio,
                'cantidad_total' => $request->cantidad_total,
                'cantidad_disponible' => $cantidadDisponible,
            ]);

            return redirect()->route('boletas.show', $id)
                ->with('success', 'Boleta actualizada correctamente');
        } catch (QueryException $e) {
            return redirect()->route('boletas.edit', $id)
                ->with('error', 'No se pudo actualizar la boleta. Es posible que ya exista para este evento y localidad.');
        } catch (\Exception $e) {
            return redirect()->route('boletas.edit', $id)
                ->with('error', 'No se encontró la boleta solicitada.');
        }
    }
}