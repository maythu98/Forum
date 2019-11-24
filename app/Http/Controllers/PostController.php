<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\PostTags;

class PostController extends Controller
{
    //
    public function createPost(Request $request) {
        
        Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
    }
}
