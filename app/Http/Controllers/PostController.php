<?php
namespace App\Http\Controllers;

use App\Events\CommentPushEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\PostComment;
use App\Tag;
use App\PostTags;
class PostController extends Controller
{
    public function getPosts()
    {
        $posts = Post::with(['post_tags'=>function($post_tag){$post_tag->with('tag');}])->orderBy('created_at','desc')->get();
        return $posts->toJson();
    }

    public function showPost($id)
    {
        $post = Post::with(['post_tags'=>function($post_tag){$post_tag->with('tag');},'post_comments'=>function($comment){$comment->with('user');}])->find($id);
        return $post->toJson();
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
        foreach (request('tags') as $key => $tagName) {
            $tagName = strtolower($tagName);
            $tag = Tag::where('tagName', $tagName)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'tagName' => $tagName
                ]);
            }
            PostTags::create([
                'postId' => $post->id,
                'tagId' => $tag->id
            ]);
        }
    }

    public function editPost($id) {
        $post = Post::find($id);
        $tags = Tag::whereHas('post_tags', function($query) use ($id) {
            $query->where('postId', $id);
        })->pluck('tagName');
        // $tags = PostTags::where('postId', $id)->pluck('tagName');
        return [$post,$tags->all()];
    }

    public function removePost($id) {
        Post::find($id)->delete();
        $postTags = PostTags::where('postId', $id)->get();
        foreach ($postTags as $key => $postTag) {
            $postTag->delete();
        }
    }

    public function saveComment(Request $request, $id) {
        $comment = PostComment::create([
            'postId' => $id,
            'userId' => Auth::id(),
            'comment' => request('comment')
        ]);
        event(new CommentPushEvent($comment));
        return $comment->id;
    }
}