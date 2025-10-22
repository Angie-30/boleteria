<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'lugar_id', // Si usas lugares
        'artistas',
    ];

    // Relaciones
    public function boletas()
    {
        return $this->hasMany(Boleta::class);
    }

    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'artista_evento');
    }
}
