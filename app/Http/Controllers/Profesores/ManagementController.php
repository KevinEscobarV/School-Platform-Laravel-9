<?php

namespace App\Http\Controllers\Profesores;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\Tema;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::where('profesor_id', auth()->user()->id)->paginate(6);
        return view('profesores.index', compact('asignaturas'));
    }

    public function asignatura(Asignatura $asignatura)
    {
        return view('profesores.asignaturas.show', compact('asignatura'));
    }

    public function tema(Asignatura $asignatura,Tema $tema)
    {
        return view('profesores.asignaturas.tema', compact('asignatura', 'tema'));
    }
}
