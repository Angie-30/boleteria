<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'evento_id',
        'localidad_id',
        'precio',
        'cantidad_total',
        'cantidad_disponible',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
}
