<?php

namespace app\Repositories;

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
            ->orderBy('comments.id', 'desc')
            ->get(['name', 'comment', 'comments.updated_at']);
    }
}
