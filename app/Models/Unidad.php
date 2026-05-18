<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
     protected $table = 'unidades';
    protected $fillable = ['curso_id', 'numero_unidad', 'nombre', 'descripcion'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}