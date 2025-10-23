<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;
use Illuminate\Database\QueryException;

class ArtistaController extends Controller
{
    public function index()
    {
        $artistas = Artista::all();
        return view('artistas.index', compact('artistas'));
    }
    
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

        try {
            // Verificar si ya existe un artista con los mismos datos
            $existeArtista = Artista::where('nombre', $request->nombre)
                ->where('genero_musical', $request->genero_musical)
                ->where('ciudad_origen', $request->ciudad_origen)
                ->exists();

            if ($existeArtista) {
                return redirect()->route('artistas.create')
                    ->with('error', 'Ya existe un artista con esos datos.');
            }

            // Creación del Artista
            Artista::create($request->all());

            // Redirección a la vista de creación con mensaje de éxito
            return redirect()->route('artistas.create')
                ->with('success', 'Artista registrado correctamente');
        } catch (QueryException $e) {
            // Capturar excepción si la restricción única falla
            return redirect()->route('artistas.create')
                ->with('error', 'No se pudo registrar el artista. Es posible que ya exista con esos datos.');
        }
    }

    public function show($id)
    {
        try {
            $artista = Artista::with('eventos')->findOrFail($id);
            return view('artistas.show', compact('artista'));
        } catch (\Exception $e) {
            return redirect()->route('artistas.index')
                ->with('error', 'No se encontró el artista solicitado.');
        }
    }

    public function edit($id)
    {
        try {
            $artista = Artista::findOrFail($id);
            return view('artistas.edit', compact('artista'));
        } catch (\Exception $e) {
            return redirect()->route('artistas.index')
                ->with('error', 'No se encontró el artista solicitado.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'nombre' => 'required',
            'genero_musical' => 'required',
            'ciudad_origen' => 'required'
        ]);

        try {
            $artista = Artista::findOrFail($id);

            // Verificar si ya existe otro artista con los mismos datos
            $existeArtista = Artista::where('nombre', $request->nombre)
                ->where('genero_musical', $request->genero_musical)
                ->where('ciudad_origen', $request->ciudad_origen)
                ->where('id', '!=', $id)
                ->exists();

            if ($existeArtista) {
                return redirect()->route('artistas.edit', $id)
                    ->with('error', 'Ya existe otro artista con esos datos.');
            }

            // Actualizar el artista
            $artista->update($request->all());

            return redirect()->route('artistas.show', $id)
                ->with('success', 'Artista actualizado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('artistas.edit', $id)
                ->with('error', 'No se pudo actualizar el artista. Es posible que ya exista con esos datos.');
        } catch (\Exception $e) {
            return redirect()->route('artistas.edit', $id)
                ->with('error', 'No se encontró el artista solicitado.');
        }
    }
}