<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $post = $this->postRepository
        ->index();
        
        return $post;
    }

    public function store($title, $body)
    {
        $post = $this->postRepository
        ->store($title, $body);
    }

    public function update($id, $title, $body)
    {
        $post = $this->postRepository
        ->update($id, $title, $body);
    }
}