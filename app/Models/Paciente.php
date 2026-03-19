<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nombre', 'edad', 'telefono'];

    public function notasClinicas()
    {
        return $this->hasMany(Nota::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}