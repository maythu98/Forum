<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function post_tags() {
        return $this->hasMany(PostTags::class, 'postId');
    }
}
