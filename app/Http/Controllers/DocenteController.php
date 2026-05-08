<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
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
        'departamento'     => 'required',
        'email'            => 'required|email|unique:users',
        'password'         => 'required|min:8',
    ]);

    try {
        \DB::beginTransaction(); // Inicia la transacción

        // 1. Crear el Usuario
        $user = \App\Models\User::create([
            'name'     => $request->nombre . ' ' . $request->apellido_paterno,
            'email'    => $request->email,
            'password' => \Hash::make($request->password),
            'role'     => 'docente',
        ]);

        // 2. Crear el Docente
        \App\Models\Docente::create([
            'user_id'          => $user->id,
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'curp'             => strtoupper($request->curp),
            'rfc'              => strtoupper($request->rfc),
            'genero'           => $request->genero,
            'rol'              => 'Docente',
            'departamento'     => $request->departamento,
        ]);

        \DB::commit(); // Si todo sale bien, guarda los cambios
        return redirect()->route('dashboard')->with('success', 'Docente registrado correctamente.');

    } catch (\Exception $e) {
        \DB::rollback(); // Si algo falla, deshace todo
        return redirect()->back()->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()])->withInput();
    }
}
}