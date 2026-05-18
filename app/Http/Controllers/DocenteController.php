<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    // ── JEFATURA: Registrar docente ──────────────────────────────────────────

    public function create()
    {
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'curp'             => 'required|string|size:18|unique:docentes',
            'rfc'              => 'required|string|min:12|max:13|unique:docentes',
            'genero'           => 'required',
            'gmail'            => 'required|email|unique:users,email',
            'grado_academico'  => 'required',
            'username'         => 'required|unique:users,name',
            'password'         => 'required|min:6',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'     => $request->username,
                'email'    => $request->gmail,
                'password' => Hash::make($request->password),
                'role'     => 'docente',
            ]);

            Docente::create([
                'user_id'          => $user->id,
                'nombre'           => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'curp'             => strtoupper($request->curp),
                'rfc'              => strtoupper($request->rfc),
                'genero'           => $request->genero,
                'gmail'            => $request->gmail,
                'grado_academico'  => $request->grado_academico,
            ]);

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Docente registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // ── DOCENTE: Panel principal ──────────────────────────────────────────────

    public function dashboard()
    {
        if (auth()->user()->role !== 'docente') {
            abort(403);
        }

        $docente = Docente::where('user_id', auth()->id())->firstOrFail();
        $cursos  = $docente->cursos()->with('unidades')->get();

        return view('docente.dashboard', compact('docente', 'cursos'));
    }

    // ── DOCENTE: Guardar datos académicos ─────────────────────────────────────

    public function guardarDatosAcademicos(Request $request)
    {
        if (auth()->user()->role !== 'docente') {
            abort(403);
        }

        $request->validate([
            'grado_academico' => 'required|string|max:255',
            'carrera'         => 'required|string|max:255',
            'departamento'    => 'required|string|max:255',
            'rol'             => 'required|string|max:255',
            'especialidad'    => 'nullable|string|max:255',
        ]);

        $docente = Docente::where('user_id', auth()->id())->firstOrFail();

        $docente->update([
            'grado_academico' => $request->grado_academico,
            'carrera'         => $request->carrera,
            'departamento'    => $request->departamento,
            'rol'             => $request->rol,
            'especialidad'    => $request->especialidad,
        ]);

        return redirect()->route('docente.dashboard')
            ->with('success', 'Datos académicos actualizados correctamente.');
    }

    // ── DOCENTE: Ver calificaciones ───────────────────────────────────────────

    public function calificaciones()
    {
        if (auth()->user()->role !== 'docente') {
            abort(403);
        }

        $docente = Docente::where('user_id', auth()->id())->firstOrFail();

        $cursos = $docente->cursos()->with([
            'unidades',
            'calificaciones' => function ($q) use ($docente) {
                $q->where('docente_id', $docente->id);
            }
        ])->get();

        $mapa = [];
        foreach ($cursos as $curso) {
            foreach ($curso->calificaciones as $cal) {
                $mapa[$curso->id][$cal->unidad_id] = $cal->calificacion;
            }
        }

        return view('docente.calificaciones', compact('docente', 'cursos', 'mapa'));
    }

    // ── DOCENTE: Ficha técnica (imprimible) ───────────────────────────────────

    public function fichaTecnica()
    {
        if (auth()->user()->role !== 'docente') {
            abort(403);
        }

        $docente = Docente::where('user_id', auth()->id())->firstOrFail();
        $cursos  = $docente->cursos()->with('unidades')->get();

        $calificaciones = Calificacion::where('docente_id', $docente->id)->get()
            ->groupBy('curso_id')
            ->map(fn($items) => $items->keyBy('unidad_id'));

        return view('docente.ficha_pdf', compact('docente', 'cursos', 'calificaciones'));
    }

    // ── DOCENTE: Boleta de un curso (imprimible) ──────────────────────────────

    public function boletaPdf($cursoId)
    {
        if (auth()->user()->role !== 'docente') {
            abort(403);
        }

        $docente = Docente::where('user_id', auth()->id())->firstOrFail();
        $curso   = $docente->cursos()->with('unidades')->findOrFail($cursoId);

        $calificaciones = Calificacion::where('docente_id', $docente->id)
            ->where('curso_id', $cursoId)
            ->get()
            ->keyBy('unidad_id');

        return view('docente.boleta_pdf', compact('docente', 'curso', 'calificaciones'));
    }
}