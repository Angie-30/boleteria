<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidades';
    protected $fillable = ['nombre'];

    public function boletas()
    {
        return $this->hasMany(Boleta::class);
    }
}
