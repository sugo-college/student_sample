<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];
    /**
     * 1対多のため単数系に（１つのコメントに対して、投稿は１つのため）
     * 単数系のためにbelongsToとなる
    */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * 1対多のため単数系に（１つのコメントに対して、userは一人のため）
     * 単数系のためんbelongsToとなる
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    function getByComment()
    {
        return $this::with('post')->get();
    }

}
