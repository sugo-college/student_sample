<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>

        {{-- CDNでfontawesomeを使えるように --}}
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>
    
    <body>
        @extends('layouts.app')
        
        @section('content')
        
        
        <h1>Blog Name</h1>
        
        [<a href='/posts/create'>create</a>]

        <div class="col-5 ml-3">
            <div class="card">
                <div class="card-header">投稿一覧</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>内容</th>
                            <th>カテゴリー</th>
                            <th>投稿者</th>
                            <th>投稿日</th>
                            <th>いいね</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td><a href = "posts/{{ $post->id }}">{{ $post->title }} </a></td>
                            <td>{{ $post->body }}</td>
                            <td><a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
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
                            </td>
                            <td>
                                <form action = "/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="deisplay:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type = "submit">delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class = 'paginate'>
            {{ $posts->links() }}
        </div>
        @endsection
    </body>
</html>