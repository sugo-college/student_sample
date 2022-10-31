<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    public function store(Request $request, Comment $comment, Post $post)
    {
        $input = $request['comment'];
        $comment->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}
