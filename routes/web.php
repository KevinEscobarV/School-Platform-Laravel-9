<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\Estudiantes\AsignaturasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Profesores\ManagementController;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/estudiante/asignaturas', [AsignaturasController::class, 'index'])->name('estudiante.asignaturas');

Route::get('/estudiante/calendario', [CalendarioController::class, 'CalendarioEstudiante'])->name('estudiante.calendario');

Route::get('/estudiante/asignaturas/{asignatura}', [AsignaturasController::class, 'show'])->name('estudiante.asignaturas.show');

Route::get('/estudiante/asignaturas/{asignatura}/{tema}/{school_work}', [AsignaturasController::class, 'school_workork'])->name('estudiante.school_work');

Route::post('/entrega/images', [AsignaturasController::class, 'store_images'])->name('entrega.images');


Route::get('/profesor/administracion', [ManagementController::class, 'index'])->name('profesor.index');
Route::get('/profesor/administracion/{asignatura}', [ManagementController::class, 'asignatura'])->name('profesor.asignatura');
Route::get('/profesor/administracion/{asignatura}/edit', [ManagementController::class, 'asignaturaEdit'])->name('profesor.asignatura.edit');
Route::get('/profesor/administracion/{asignatura}/{tema}', [ManagementController::class, 'tema'])->name('profesor.asignatura.tema');





Route::get('/publicaciones', [PostController::class, 'home'])->name('posts.home');

Route::get('/publicaciones/{post}', [PostController::class, 'detail'])->name('posts.detail');

Route::post('images', [PostController::class, 'store'])->name('posts.images');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
