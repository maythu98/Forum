<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTags extends Model
{
    //
    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class, 'postId');
    }

}
