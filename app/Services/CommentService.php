<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getPostComment($post_id)
    {
        $comment = $this->commentRepository
        ->getPostComment($post_id);
        
        return $comment;
    }

    public function getCommentsByMaxId($post_id, $last_comment_id)
    {
        $comment = $this->commentRepository
        ->getCommentsByMaxId($post_id, $last_comment_id);
        
        return $comment;
    }

    public function store($post_id, $comment)
    {
        $comment = $this->commentRepository
        ->store($post_id, $comment);
        
        return $comment;
    }
}