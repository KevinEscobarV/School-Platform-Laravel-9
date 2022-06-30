<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\EntregaImage;
use App\Models\SchoolWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsignaturasController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->curso_id, 403, 'No te encuentras en ningun matriculado en nigun curso.');
        $asignaturas = Asignatura::where('curso_id', auth()->user()->curso_id)->paginate(6);
        return view('estudiantes.asignaturas.asignaturas' , compact('asignaturas'));
    }

    public function show(Asignatura $asignatura)
    {
        abort_unless($asignatura->curso_id == auth()->user()->curso_id, 403, 'No puedes ver esta asignatura.');
        return view('estudiantes.asignaturas.show', compact('asignatura'));
    }

    public function school_workork(Asignatura $asignatura, $tema, SchoolWork $school_work)
    { 
        abort_unless($asignatura->curso_id == auth()->user()->curso_id, 403, 'No puedes ver esta tarea.');
        $entrega = $school_work->entregas()->where('student_id', auth()->user()->id)->first();
        return view('estudiantes.entregas.school_work', compact('asignatura', 'tema', 'school_work', 'entrega'));
    }

    public function store_images(Request $request)
    {     
        $file_path = $request->file('upload')->store('images_entregas');
        $img = new EntregaImage();
        $img->url = $file_path;
        $img->user_id = auth()->user()->id;
        $img->save();
        return response()->json([
            'url' => Storage::url($file_path),
        ]);
    }
}
