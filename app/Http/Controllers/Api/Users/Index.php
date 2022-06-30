<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function __invoke(Request $request): Collection
    {
        return User::query()
            ->select('id', 'name', 'apellido', 'email', 'profile_photo_path')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
            )
            ->when(
                $request->selected,
                fn (Builder $query) => $query->whereIn('id', $request->selected),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
}