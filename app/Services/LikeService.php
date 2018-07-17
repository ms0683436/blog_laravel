<?php

namespace App\Services;

use App\Repositories\LikeRepository;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function store($user_id, $object_id, $object)
    {
        $like = $this->likeRepository
        ->store($user_id, $object_id, $object);
    }

    public function count($object_id, $object)
    {
        $like = $this->likeRepository
        ->count($object_id, $object);
        
        return $like;
    }

    public function getLike($user_id, $object_id, $object)
    {
        $like = $this->likeRepository
        ->getLike($user_id, $object_id, $object);
        
        return $like;
    }
}