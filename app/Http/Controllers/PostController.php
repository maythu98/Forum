<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\PostTags;
class PostController extends Controller
{
    
    public function getPosts()
    {
        $posts = Post::with('post_tags')->get();
        return $posts->toJson();
    }
    
    public function createPost(Request $request) {
        
        $post = Post::with('post_tags')->create([
            'title' => $request->title,
            'body' => $request->body,
            'userID' => Auth::id() 
        ]);
        
        foreach ($request->tags as $key => $tag) {
            PostTags::create([
                'postId' => $post->id,
                'tagName' => $tag
            ]);
        }
        return $post->toJson();
    }
}