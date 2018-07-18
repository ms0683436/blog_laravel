<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        return $this->post
            ->select('posts.id', 'user_id', 'name', 'title', 'body', 'posts.updated_at', 
                    DB::raw("(SELECT COUNT(likelist.user_id) FROM likelist WHERE likelist.object_id = posts.id AND likelist.object = 1) AS count"),
                    DB::raw("(SELECT COUNT(likelist.user_id) FROM likelist WHERE likelist.user_id = ". $user_id ." AND likelist.object_id = posts.id AND likelist.object = 1) AS isActive"))
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('posts.id', 'desc')
            ->paginate(5);
    }

    public function store($title, $body)
    {
        $post = new Post;
        
        $post->user_id = Auth::user()->id;
        $post->title = $title;
        $post->body = $body;

        $post->save();
    }

    public function update($id, $title, $body)
    {
        $post = Post::find($id);
        $post->title = $title;
        $post->body = $body;

        $post->save();
    }
}
