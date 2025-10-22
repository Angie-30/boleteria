<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\eventoRequest;

class EventoController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function create(){
        return view('evento');
    }
}
