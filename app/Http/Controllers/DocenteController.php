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
        if (auth()->user()->role !== 'jefatura') {
            abort(403);
        }

        $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'curp'             => 'required|string|size:18|unique:docentes',
            'rfc'              => 'required|string|min:12|max:13|unique:docentes',
            'genero'           => 'required|in:Masculino,Femenino,Otro',
            'departamento'     => 'required|string',
            'name'             => 'required|string|max:255|unique:users',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
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
            'rol'              => 'Docente', // Se asigna automáticamente
            'departamento'     => $request->departamento,
        ]);

        return redirect()->route('dashboard')->with('success', 'Docente registrado correctamente.');
    }
}