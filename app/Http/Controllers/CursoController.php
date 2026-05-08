<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Curso;
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
    if (auth()->user()->role !== 'jefatura') {
        abort(403);
    }
    $docentes = \App\Models\Docente::all();
    $cursos = \App\Models\Curso::all();
    return view('cursos.inscribir', compact('docentes', 'cursos'));
}

public function inscribirStore(Request $request)
{
$request->validate([
        'curso_id' => 'required|exists:cursos,id',
        'docente_ids' => 'required|array|min:1', // Validamos que sea un arreglo con al menos uno
        'docente_ids.*' => 'exists:docentes,id',
    ]);

    $curso = \App\Models\Curso::findOrFail($request->curso_id);

    // syncWithoutDetaching añade los nuevos sin borrar los que ya estaban inscritos
    $curso->docentes()->syncWithoutDetaching($request->docente_ids);

    return redirect()->back()->with('success', 'Personal inscrito correctamente al curso.');
}

public function reporte()
{
    // Verificación de seguridad
    if (auth()->user()->role !== 'jefatura') {
        abort(403);
    }

    // "Eager Loading" (with): Traemos los cursos y sus docentes en una sola consulta
    $cursos = \App\Models\Curso::with('docentes')->get();

    return view('cursos.reporte', compact('cursos'));
}
}