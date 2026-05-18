<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\InstructorController;
use App\Models\Curso;

// ── Bienvenida ────────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ── Dashboard principal ───────────────────────────────────────────────────────
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'jefatura') {
        return redirect()->route('jefatura.dashboard');
    } elseif ($role === 'instructor') {
        return redirect()->route('instructor.dashboard');
    } elseif ($role === 'docente') {
        return redirect()->route('docente.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── Rutas protegidas ──────────────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Jefatura: Cursos ──────────────────────────────────────────────────────
    Route::get('/cursos/crear', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');

    // ── Jefatura: Docentes ────────────────────────────────────────────────────
    Route::get('/docentes/crear', [DocenteController::class, 'create'])->name('docentes.create');
    Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes.store');

    // ── Jefatura: Instructores ────────────────────────────────────────────────
    Route::get('/instructores/crear', [InstructorController::class, 'create'])->name('instructores.create');
    Route::post('/instructores', [InstructorController::class, 'store'])->name('instructores.store');

    // ── Jefatura: Inscribir personal ──────────────────────────────────────────
    Route::get('/asignaciones/crear', [CursoController::class, 'inscribir'])->name('asignaciones.create');
    Route::post('/asignaciones', [CursoController::class, 'inscribirStore'])->name('asignaciones.store');

    // ── Jefatura: Reportes ────────────────────────────────────────────────────
    Route::get('/reportes/asistencia', [CursoController::class, 'reporte'])->name('reportes.asistencia');

    // ── Panel Jefatura ────────────────────────────────────────────────────────
    Route::get('/jefatura/dashboard', function () {
        return view('jefatura.dashboard');
    })->name('jefatura.dashboard');

    // ── Panel Docente ─────────────────────────────────────────────────────────
    Route::get('/docente/dashboard', [DocenteController::class, 'dashboard'])->name('docente.dashboard');
    Route::post('/docente/datos-academicos', [DocenteController::class, 'guardarDatosAcademicos'])->name('docente.datos-academicos');
    Route::get('/docente/calificaciones', [DocenteController::class, 'calificaciones'])->name('docente.calificaciones');
    Route::get('/docente/ficha-tecnica', [DocenteController::class, 'fichaTecnica'])->name('docente.ficha-tecnica');
    Route::get('/docente/boleta/{cursoId}', [DocenteController::class, 'boletaPdf'])->name('docente.boleta');

    // ── Panel Instructor ──────────────────────────────────────────────────────
    Route::get('/instructor/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');
    Route::get('/instructor/cursos/{cursoId}/calificaciones', [InstructorController::class, 'calificaciones'])->name('instructor.calificaciones');
    Route::post('/instructor/cursos/{cursoId}/calificaciones', [InstructorController::class, 'calificacionesStore'])->name('instructor.calificaciones.store');

});

require __DIR__.'/auth.php';