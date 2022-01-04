<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPost();
    public function getPostById($postId);
    public function createPost(array $postDetails);
    public function deletePost($postId);

}

