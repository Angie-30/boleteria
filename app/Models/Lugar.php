<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lugar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'municipio_id'
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
