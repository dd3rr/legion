<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
<<<<<<< HEAD
=======
        'user_id',
>>>>>>> cc368fae68c785398778cded3400ab76ee9c31e6
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'rfc',
        'genero',
<<<<<<< HEAD
        'gmail',
        'grado_academico',
    ];
=======
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
    return $this->belongsToMany(Curso::class, 'curso_docente', 'docente_id', 'curso_id');
>>>>>>> cc368fae68c785398778cded3400ab76ee9c31e6
}
}