<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;

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
        $posts = $this->post
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('posts.id', 'desc')
            ->get(['posts.id', 'user_id', 'name', 'title', 'body', 'posts.updated_at']);

        $posts->each(function ($item, $key) use ($user_id) {
            $count = Like::where([['object', '=', 1], ['object_id', '=', $item->id]])->count();
            $isActive = Like::where([['object', '=', 1], ['user_id', '=', $user_id], ['object_id', '=', $item->id]])->count();
            $item['count'] = $count;
            $item['isActive'] = $isActive;
        });
        return $posts;
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
