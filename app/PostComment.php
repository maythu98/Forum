<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function getCommentTimeAttribute() {
        return $this->created_at->diffForHumans();
    }

    protected $appends = ['comment_time'];
}