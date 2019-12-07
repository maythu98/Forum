<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];

    public function post_tags() {
        return $this->hasMany(PostTags::class, 'postId');
    }
}
