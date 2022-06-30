<?php

use App\Http\Controllers\Admin\AdminUserProfileController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Livewire\Admin\UsersComponent;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:Super Admin', 'auth:sanctum', 'verified']], function () {

Route::get('/usuarios', UsersComponent::class)->name('admin.users');
Route::get('/publicaciones/creacion', [PostController::class, 'create'])->name('admin.post.create');
Route::get('/usuarios/profile/{user}/gestion', [AdminUserProfileController::class, 'show'])->name('admin.profile.show');

});