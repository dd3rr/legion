<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Curso extends Model
{
    
    protected $fillable = [
        'clave', 'nombre', 'fecha_inicio', 'fecha_fin',
        'hora_inicio', 'hora_fin', 'instructor', 'instructor_id',
    ];

    protected static function booted()
    {
        static::creating(function ($curso) {
            $curso->clave = 'CRS-' . strtoupper(Str::random(6));
        });
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'curso_docente', 'curso_id', 'docente_id');
    }

    public function unidades()
    {
        return $this->hasMany(Unidad::class)->orderBy('numero_unidad');
    }

    public function instructorRelacion()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}