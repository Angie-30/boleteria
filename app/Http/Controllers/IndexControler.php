<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexControler extends Controller
{
    public function create()
    {
        return view('index.create'); 
    }
}
