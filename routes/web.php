<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioController;

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
Route::get('/artistas/create', [ArtistaController::class, 'create'])->name('artistas.create');
Route::get('/artistas', [ArtistaController::class, 'index'])->name('artistas.index');
Route::get('/artistas/{id}', [ArtistaController::class, 'show'])->name('artistas.show');
Route::get('/artistas/{id}/edit', [ArtistaController::class, 'edit'])->name('artistas.edit');
Route::put('/artistas/{id}', [ArtistaController::class, 'update'])->name('artistas.update');

// Consulta pública
Route::get('/consulta-eventos', [ConsultaController::class, 'index'])->name('consulta.index');

//incio
Route::get('/inicio', [IndexController::class, 'index'])->name('index.inicio');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/search', [IndexController::class, 'search'])->name('search');


// Mostrar formulario de login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Procesar el login
Route::post('login', [LoginController::class, 'login']);

// Cerrar sesión
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Usuarios
Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
