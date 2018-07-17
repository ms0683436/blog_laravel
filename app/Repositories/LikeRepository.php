<?php

namespace app\Repositories;

use App\Like;

class LikeRepository
{
    protected $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function store($user_id, $object_id, $object)
    {
        $like = new Like;
        $like->user_id = $user_id;
        $like->object_id = $object_id;
        $like->object = $object;

        $like->save();
    }
    
    public function count($object_id, $object)
    {
        return $this->like
            ->where([['object_id', '=', $object_id], ['object', '=', $object]])
            ->count('user_id');
    }

    public function getLike($user_id, $object_id, $object)
    {
        return $this->like
                ->where([['user_id', $user_id], ['object_id', $object_id], ['object', $object]]);
    }
}
