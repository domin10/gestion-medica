<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['paciente_id', 'contenido'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}