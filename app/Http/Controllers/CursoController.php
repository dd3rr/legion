<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Curso;
use App\Models\Instructor;
use App\Models\Unidad;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function create()
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        $docentes     = Docente::all();
        $instructores = Instructor::all();

        return view('cursos.create', compact('docentes', 'instructores'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        $request->validate([
            'nombre'                 => 'required|string|max:255',
            'fecha_inicio'           => 'required|date_format:Y-m-d',
            'fecha_fin'              => 'required|date_format:Y-m-d|after_or_equal:fecha_inicio',
            'hora_inicio'            => 'required|date_format:H:i',
            'hora_fin'               => 'required|date_format:H:i|after:hora_inicio',
            'instructor_id'          => 'required|exists:instructores,id',
            'unidades'               => 'required|array|min:1',
            'unidades.*.nombre'      => 'required|string|max:255',
            'unidades.*.descripcion' => 'nullable|string',
        ]);

        $curso = Curso::create([
            'nombre'        => $request->nombre,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'hora_inicio'   => $request->hora_inicio,
            'hora_fin'      => $request->hora_fin,
            'instructor_id' => $request->instructor_id,
        ]);

        foreach ($request->unidades as $index => $unidadData) {
            Unidad::create([
                'curso_id'      => $curso->id,
                'numero_unidad' => $index + 1,
                'nombre'        => $unidadData['nombre'],
                'descripcion'   => $unidadData['descripcion'] ?? null,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Curso registrado correctamente.');
    }

    public function inscribir()
{
    if (auth()->user()->role !== 'jefatura') {
        abort(403);
    }

    $docentes = Docente::all();
    $cursos   = Curso::all();

    // Precargamos los IDs de docentes inscritos por curso
    $inscritos = [];
    foreach ($cursos as $curso) {
        $inscritos[$curso->id] = $curso->docentes()->pluck('docentes.id')->toArray();
    }

    return view('cursos.inscribir', compact('docentes', 'cursos', 'inscritos'));
}

    public function inscribirStore(Request $request)
    {
        $request->validate([
            'curso_id'      => 'required|exists:cursos,id',
            'docente_ids'   => 'required|array|min:1',
            'docente_ids.*' => 'exists:docentes,id',
        ]);

        $curso = Curso::findOrFail($request->curso_id);
        $curso->docentes()->syncWithoutDetaching($request->docente_ids);

        return redirect()->back()->with('success', 'Personal inscrito correctamente al curso.');
    }

    public function reporte()
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        $cursos = Curso::with('docentes')->get();

        return view('cursos.reporte', compact('cursos'));
    }
}