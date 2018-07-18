<?php

namespace app\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    
    public function getPostComment($post_id)
    {
        return $this->comment
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('post_id', '=', $post_id)
            ->orderBy('comments.id', 'ASC')
            ->get(['comments.id', 'name', 'comment', 'comments.updated_at']);
    }

    public function getCommentsByMaxId($post_id, $last_comment_id)
    {
        return $this->comment
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where([['post_id', '=', $post_id], ['comments.id', '>', $last_comment_id]])
            ->orderBy('comments.id', 'ASC')
            ->get(['comments.id', 'name', 'comment', 'comments.updated_at']);
    }

    public function store($post_id, $content)
    {
        $comment = new Comment;
        
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post_id;
        $comment->comment = $content;

        $comment->save();
    }
}
