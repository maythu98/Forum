<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = [];

    public function post_tags() {
        return $this->hasMany(PostTags::class, 'tagId');
    }

}
