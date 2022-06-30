<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function home()
    {
        return view('posts.home', ['posts' => Post::where('is_draft', false)->orderBy('created_at', 'desc')->paginate(6)]);
    }

    public function detail(Post $post)
    {
        abort_unless(!$post->isDraft(), 403, 'La publicación está en borrador.');
        return view('posts.post', ['post' => $post]);
    }

    public function store(Request $request)
    {     
        $filePath = $request->file('upload')->store('images');
        $img = new Image();
        $img->image_url = $filePath;
        $img->save();
        return response()->json([
            'url' => Storage::url($filePath),
        ]);
    }
}
