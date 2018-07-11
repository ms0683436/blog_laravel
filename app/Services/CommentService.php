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
}