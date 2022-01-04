<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface 
{
    
    public function getAllPost()
    {
        if(auth()->user()->hasRole() == 'admin'): 
            $posts =  Post::all();
            $fullPost = [];
            foreach($posts as $post):
                $fullPost[] = [
                    "post" => $post,
                    "comments" => $post->comments
                ];
            endforeach;

            return (Object)$fullPost;
        endif;
            $posts =  Post::where('status','approve')->get();
            $fullPost = [];
            foreach($posts as $post):
                $fullPost[] = [
                    "post" => $post,
                    "comments" => $post->comments
                ];
            endforeach;

            return (Object)$fullPost;
    }

    public function getPostById($postId)
    {
        return Post::findOrFail($postId);
    }

    public function createPost(array $postDetails)
    {
       return Post::create([
            'product_id' => 1,
            'user_id' => auth()->user()->id,
            'status' => auth()->user()->hasRole() == 'admin' ? 'approve':'pending',
            'question' => $postDetails['question'],
        ]);
    }

    public function deletePost($postId) 
    {

    }
}