<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'genero_musical',
        'ciudad_origen'
    ];

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'artista_evento');
    }
}