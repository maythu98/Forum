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
        $posts = Post::with('post_tags')->orderBy('created_at','desc')->get();
        return $posts->toJson();
    }
    
    public function createPost(Request $request, $id) {
        if ($id == 0) {
            $post = Post::create([
                'title' => $request->title,
                'body' => $request->body,
                'userID' => Auth::id() 
            ]);
        }else {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            $old_tags = PostTags::where('postId', $id)->get();
            if ($old_tags) {
                foreach ($old_tags as $tag) {
                    $tag->delete();
                }
            }
        }

        foreach (request('tags') as $key => $tag) {
            PostTags::create([
                'postId' => $post->id,
                'tagName' => $tag
            ]);
        }
    }

    public function editPost($id) {
        $post = Post::find($id);
        $tags = PostTags::where('postId', $id)->pluck('tagName');
        return [$post,$tags->all()];
    }

    public function removePost($id) {
        Post::find($id)->delete();
    }
}