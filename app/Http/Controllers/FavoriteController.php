<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;

class FavoriteController extends Controller
{
    public function store(Post $post)
    {
        $post->users()->attach(Auth::id());
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->users()->detach(Auth::id());
        return redirect()->route('posts.index');
    }
}
