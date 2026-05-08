<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'rfc',
        'genero',
        'gmail',
        'grado_academico',
    ];
}
