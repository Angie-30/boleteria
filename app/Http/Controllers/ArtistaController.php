<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;
use Illuminate\Database\QueryException;

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
}