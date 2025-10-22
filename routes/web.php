<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/evento', function () {
    return view('evento');
}); */

Route::get('/evento', [EventoController::class, 'create']);

Route::get('/alerta', function () {
    return view('alerta');
});