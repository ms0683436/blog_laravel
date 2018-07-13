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
            ->join('user', 'comment.user_id', '=', 'user.id')   // not test
            ->where('post_id', '=', $post_id)
            ->orderBy('id', 'desc')
            ->get();
    }
}
