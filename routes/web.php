<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ConsultaController;

// Eventos
Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/eventos/crear', [EventoController::class, 'create'])->name('eventos.create');
Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');
Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');

// Localidades
Route::get('/localidades/crear', [LocalidadController::class, 'create'])->name('localidades.create');
Route::post('/localidades', [LocalidadController::class, 'store'])->name('localidades.store');

// Boletas
Route::get('/boletas/crear', [BoletaController::class, 'create'])->name('boletas.create');
Route::post('/boletas', [BoletaController::class, 'store'])->name('boletas.store');

// Artistas
Route::get('/artistas/crear', [ArtistaController::class, 'create'])->name('artistas.create');
Route::post('/artistas', [ArtistaController::class, 'store'])->name('artistas.store');

// Consulta pública
Route::get('/consulta-eventos', [ConsultaController::class, 'index'])->name('consulta.index');
