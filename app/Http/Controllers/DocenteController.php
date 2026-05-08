<?php
namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function create() {
        return view('docentes.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'curp' => 'required|unique:docentes',
        'rfc' => 'required|unique:docentes',
        'genero' => 'required',
        'gmail' => 'required|email|unique:docentes',
        'grado_academico' => 'required',

        'username' => 'required|unique:users,name',
        'password' => 'required|min:6',
    ]);

    // Guardar docente
    Docente::create([
        'nombre' => $request->nombre,
        'apellido_paterno' => $request->apellido_paterno,
        'apellido_materno' => $request->apellido_materno,
        'curp' => $request->curp,
        'rfc' => $request->rfc,
        'genero' => $request->genero,
        'gmail' => $request->gmail,
        'grado_academico' => $request->grado_academico,
    ]);

    // Crear usuario automáticamente
    User::create([
        'name' => $request->username,
        'email' => $request->gmail,
        'password' => Hash::make($request->password),
        'role' => 'docente',
    ]);

    return redirect()
        ->route('jefatura.dashboard')
        ->with('success', 'Docente y usuario registrados correctamente');
}
}