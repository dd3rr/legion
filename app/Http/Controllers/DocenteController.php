<?php
namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function create() {
        return view('docentes.create');
    }

    public function store(Request $request) {
        $request->validate([
            'rfc' => 'required|unique:docentes',
            'nombre' => 'required',
            'apellido' => 'required',
            'grado_academico' => 'required',
            'email' => 'required|email|unique:docentes',
        ]);

        Docente::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Docente registrado con éxito');
    }
}