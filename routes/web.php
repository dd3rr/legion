<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Models\Curso;

// 1. BIENVENIDA
Route::get('/', function () {
    return view('welcome');
});

// 2. DASHBOARD PRINCIPAL (Carga los cursos)
Route::get('/dashboard', function () {
    $cursos = Curso::all(); 
    return view('dashboard', compact('cursos'));
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. RUTAS PROTEGIDAS (Requieren Login)
Route::middleware(['auth'])->group(function () {
    
    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // BOTÓN 1: Registrar Curso
    Route::get('/cursos/crear', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');

    // BOTÓN 2: Registrar Personal (Docentes)
    Route::get('/docentes/crear', [DocenteController::class, 'create'])->name('docentes.create');
    Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes.store');

    // BOTÓN 3: Inscribir Curso (Asignar docente a materia)
    // Nota: Estos métodos 'inscribir' deben existir en tu CursoController
    Route::get('/asignaciones/crear', [CursoController::class, 'inscribir'])->name('asignaciones.create');

    // BOTÓN 4: Reporte de Asistencia
    // Nota: Este método 'reporte' debe existir en tu CursoController
    Route::get('/reportes/asistencia', [CursoController::class, 'reporte'])->name('reportes.asistencia');

    // Dashboards específicos por Rol (Si los ocupas más adelante)
    Route::get('/jefatura/dashboard', function () {
        return view('jefatura.dashboard');
    })->name('jefatura.dashboard');

    Route::get('/docente/dashboard', function () {
        return view('docente.dashboard');
    })->name('docente.dashboard');
});

require __DIR__.'/auth.php';