<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    // ── JEFATURA: Registrar instructor ───────────────────────────────────────

    public function create()
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }
        return view('instructores.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'curp'             => 'required|string|size:18|unique:instructores',
            'rfc'              => 'required|string|min:12|max:13|unique:instructores',
            'genero'           => 'required|in:Masculino,Femenino',
            'gmail'            => 'required|email|unique:users,email',
            'grado_academico'  => 'required|string|max:255',
            'especialidad'     => 'nullable|string|max:255',
            'username'         => 'required|unique:users,name',
            'password'         => 'required|min:6',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'     => $request->username,
                'email'    => $request->gmail,
                'password' => Hash::make($request->password),
                'role'     => 'instructor',
            ]);

            Instructor::create([
                'user_id'          => $user->id,
                'nombre'           => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'curp'             => strtoupper($request->curp),
                'rfc'              => strtoupper($request->rfc),
                'genero'           => $request->genero,
                'gmail'            => $request->gmail,
                'grado_academico'  => $request->grado_academico,
                'especialidad'     => $request->especialidad,
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', 'Instructor registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // ── INSTRUCTOR: Panel principal ───────────────────────────────────────────

    public function dashboard()
    {
        if (auth()->user()->role !== 'instructor') {
            abort(403);
        }

        $instructor = Instructor::where('user_id', auth()->id())->firstOrFail();
        $cursos     = $instructor->cursos()->with(['docentes', 'unidades'])->get();

        return view('instructor.dashboard', compact('instructor', 'cursos'));
    }

    // ── INSTRUCTOR: Tabla de calificaciones ──────────────────────────────────

    public function calificaciones($cursoId)
    {
        if (auth()->user()->role !== 'instructor') {
            abort(403);
        }

        $instructor = Instructor::where('user_id', auth()->id())->firstOrFail();
        $curso      = $instructor->cursos()
                        ->with(['docentes', 'unidades'])
                        ->findOrFail($cursoId);

        $calificaciones = Calificacion::where('curso_id', $cursoId)->get()
            ->groupBy('docente_id')
            ->map(fn($items) => $items->keyBy('unidad_id'));

        return view('instructor.calificaciones', compact('instructor', 'curso', 'calificaciones'));
    }

    // ── INSTRUCTOR: Guardar calificaciones ───────────────────────────────────

    public function calificacionesStore(Request $request, $cursoId)
    {
        if (auth()->user()->role !== 'instructor') {
            abort(403);
        }

        $instructor = Instructor::where('user_id', auth()->id())->firstOrFail();
        $curso      = $instructor->cursos()->findOrFail($cursoId);

        $request->validate([
            'calificaciones'     => 'required|array',
            'calificaciones.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->calificaciones as $docenteId => $unidades) {
                foreach ($unidades as $unidadId => $valor) {
                    if ($valor !== null && $valor !== '') {
                        Calificacion::updateOrCreate(
                            [
                                'docente_id' => $docenteId,
                                'curso_id'   => $cursoId,
                                'unidad_id'  => $unidadId,
                            ],
                            ['calificacion' => $valor]
                        );
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Calificaciones guardadas correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }
}