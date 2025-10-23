<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'usuarios';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
        'tipo',
    ];

    // Ocultar campos sensibles en la salida JSON
    protected $hidden = [
        'contrasena',
    ];
}
