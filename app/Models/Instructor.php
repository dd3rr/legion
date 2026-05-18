<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
     protected $table = 'instructores';
    protected $fillable = [
        'user_id', 'nombre', 'apellido_paterno', 'apellido_materno',
        'curp', 'rfc', 'genero', 'gmail', 'grado_academico', 'especialidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'instructor_id');
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }
}