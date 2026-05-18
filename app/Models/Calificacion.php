<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
     protected $table = 'calificaciones';
    protected $fillable = ['docente_id', 'curso_id', 'unidad_id', 'calificacion'];

    public function docente()   { return $this->belongsTo(Docente::class); }
    public function curso()     { return $this->belongsTo(Curso::class); }
    public function unidad()    { return $this->belongsTo(Unidad::class); }
}