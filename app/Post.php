<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // 一対多のため単数形にする
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id'
    ];
    
    /**
     * 1対多のため複数形になる。（１つの投稿に対して複数のコメントがある。）
     * 多の方のためにhasMany
     */
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with(['category', 'user'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function getByComment(int $limit_count = 5)
    {
        return $this->comments()->with('post')->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
