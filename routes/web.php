<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Models\Curso;
use App\Http\Controllers\DocenteController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    $cursos = Curso::all(); // Traemos todos los cursos de la base de datos
    return view('dashboard', compact('cursos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Agrupamos todo lo que requiere estar logueado aquí
Route::middleware(['auth'])->group(function () {
    // Rutas para Cursos
    Route::get('/cursos/crear', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');

    // Rutas para Docentes
    Route::get('/docentes/crear', [DocenteController::class, 'create'])->name('docentes.create');
    Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes.store');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/jefatura/dashboard', function () {
        return view('jefatura.dashboard');
    })->name('jefatura.dashboard');

    Route::get('/docente/dashboard', function () {
        return view('docente.dashboard');
    })->name('docente.dashboard');

});
Route::get('/docentes/create', [DocenteController::class, 'create'])
    ->name('docentes.create');

Route::post('/docentes', [DocenteController::class, 'store'])
    ->name('docentes.store');
