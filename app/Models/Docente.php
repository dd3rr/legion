<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'rfc',
        'genero',
        'rol',
        'departamento',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con cursos
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_docente');
    }
}