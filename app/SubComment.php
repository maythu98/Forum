<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function getCommentTimeAttribute() {
        return $this->created_at->diffForHumans();
    }

    protected $appends = ['comment_time'];
}
