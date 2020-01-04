<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostTags extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function tag() {
        return $this->belongsTo(Tag::class, 'tagId');
    }

}
