<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Curso extends Model
{
    protected $fillable = [
        'clave',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'instructor',
        'co_instructor',
    ];

    protected static function booted()
    {
        static::creating(function ($curso) {
            $curso->clave = 'CRS-' . strtoupper(Str::random(6));
        });
    }

    // Relación con docentes
    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'curso_docente');
    }
}