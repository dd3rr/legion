<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    // Muestra el formulario de registro
    public function create()
    {
        if (auth()->user()->role !== 'jefatura') {
    abort(403);
}
        return view('cursos.create');
    }

    // Guarda el curso en la base de datos
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'jefatura') {
    abort(403);
}
        // Validamos que los datos sean correctos (Seguridad)
        $request->validate([
            'clave' => 'required|unique:cursos',
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        // Guardamos en la base de datos
        Curso::create($request->all());

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Curso registrado correctamente.');
    }
}