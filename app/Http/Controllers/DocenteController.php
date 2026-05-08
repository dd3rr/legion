<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'nombre'             => 'required|string|max:255',
            'apellido_paterno'   => 'required|string|max:255',
            'apellido_materno'   => 'required|string|max:255',
            'curp'               => 'required|string|size:18|unique:docentes',
            'rfc'                => 'required|string|min:12|max:13|unique:docentes',
            'genero'             => 'required',
            'gmail'              => 'required|email|unique:users,email',
            'grado_academico'    => 'required',

            'username'           => 'required|unique:users,name',
            'password'           => 'required|min:6',
        ]);

        try {

            DB::beginTransaction();

            // Crear usuario
            $user = User::create([
                'name'     => $request->username,
                'email'    => $request->gmail,
                'password' => Hash::make($request->password),
                'role'     => 'docente',
            ]);

            // Crear docente
            Docente::create([
                'user_id'            => $user->id,
                'nombre'             => $request->nombre,
                'apellido_paterno'   => $request->apellido_paterno,
                'apellido_materno'   => $request->apellido_materno,
                'curp'               => strtoupper($request->curp),
                'rfc'                => strtoupper($request->rfc),
                'genero'             => $request->genero,
                'gmail'              => $request->gmail,
                'grado_academico'    => $request->grado_academico,
            ]);

            DB::commit();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Docente y usuario registrados correctamente.');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Error al registrar: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }
}