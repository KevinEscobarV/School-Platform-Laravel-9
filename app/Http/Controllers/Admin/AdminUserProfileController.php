<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserProfileController extends Controller
{
    public function show(User $user)
    {
        return view('admin.user-profile', compact('user'));
    }
}
