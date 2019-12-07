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
        
        $post = Post::with('post_tags')->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        
        foreach ($request->tags as $key => $tag) {
            PostTags::create([
                'postId' => $post->id,
                'tagName' => $tag
            ]);
        }

        $post = Post::with('post_tags')->find($post->id);

        return $post->toJson();

    }
}
