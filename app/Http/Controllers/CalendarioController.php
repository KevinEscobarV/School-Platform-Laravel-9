<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function CalendarioEstudiante()
    {
        return view('estudiantes.calendario.index');
    }
}
