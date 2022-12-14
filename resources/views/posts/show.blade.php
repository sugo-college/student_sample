<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    </head>
    
    <body>
        @extends('layouts.app')
        @section('content')
        <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
        
        <h1 class = "title">
            {{ $post->title }}
        </h1>
        
        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        
        <div class = "content">
            <div class = "content_post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>

                
            </div>
        </div>

        @if($post->users()->where('user_id', Auth::id())->exists())
            <div class="col-md-3">
                <form action="{{ route('unfavorites', $post) }}" method="POST">
                    @csrf
                    <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
                </form>
            </div>
        @else
            <div class="col-md-3">
                <form action="{{ route('favorites', $post) }}" method="POST">
                    @csrf
                    <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                </form>
            </div>
        @endif
        <p>いいね数：{{ $post->users()->count() }}</p>

        <h2 class = "comment_title">コメント</h2>
        @foreach($comments as $comment)
            <p>{{ $comment->content }}  {{ $comment->user->name }}</p>
        @endforeach

        <form action = "/posts/{{ $post->id }}" method = "POST">
            @csrf
            {{-- <div class = "comment_body"> --}}
                
                <textarea name = "comment[content]" placeholder = "コメントする" ></textarea>
                <input type = "hidden" name = "comment[post_id]" value = {{ $post->id }} />
                <input type = "hidden" name = "comment[user_id]" value = {{ Auth::user()->id }} />
            {{-- </div> --}}

            <input type="submit" value="コメントする"/>
        </form>

            
        <div class = "footer">
            <a href = "/">戻る</a>
        </div>
        @endsection
    </body>
</html>