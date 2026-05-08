<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function create()
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        // Cargamos los docentes para los combobox de instructor y co-instructor
        $docentes = Docente::all();

        return view('cursos.create', compact('docentes'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        $request->validate([
            'nombre'        => 'required|string|max:255',
            'fecha_inicio'  => 'required|date_format:Y-m-d',
            'fecha_fin'     => 'required|date_format:Y-m-d|after_or_equal:fecha_inicio',
            'hora_inicio'   => 'required|date_format:H:i',
            'hora_fin'      => 'required|date_format:H:i|after:hora_inicio',
            'instructor'    => 'required|string',
            'co_instructor' => 'required|string',
        ]);

        // La clave se genera automáticamente en el modelo, no viene del request
        Curso::create([
            'nombre'        => $request->nombre,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'hora_inicio'   => $request->hora_inicio,
            'hora_fin'      => $request->hora_fin,
            'instructor'    => $request->instructor,
            'co_instructor' => $request->co_instructor,
        ]);

        return redirect()->route('dashboard')->with('success', 'Curso registrado correctamente.');
    }

    public function inscribir()
    {
        return view('cursos.inscribir');
    }

    public function reporte()
    {
        return view('reportes.asistencia');
    }
}