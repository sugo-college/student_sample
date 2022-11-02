<?php

    use Illuminate\Support\Facades\Route;
    //  

    Route::group(['middleware' => ['auth']], function(){
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::post('/posts', 'PostController@store');
        Route::get('/posts/create', 'PostController@create');
        Route::get('/posts/{post}', 'PostController@show');
        Route::post('/posts/{post}', 'CommentController@store');
        
        Route::put('/posts/{post}', 'PostController@update');
        Route::delete('posts/{post}', 'PostController@delete');

        Route::post('posts/{post}/favorites', 'FavoriteController@store')->name('favorites');
        Route::post('posts/{post}/unfavorites', 'FavoriteController@destroy')->name('unfavorites');

        Route::get('/posts/{post}/edit', 'PostController@edit');
        Route::get('/categories/{category}', 'CategoryController@index');
    });

    Auth::routes();

    
