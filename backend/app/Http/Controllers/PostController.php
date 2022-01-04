<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    //return posts according to user role
    public function index() 
    {
            return response()->json([
                'data' => $this->postRepository->getAllPost()
            ]);
    }

    //create a post by user
    public function store(Request $request)
    {
        $request->validate([
            'question' => ['required'],
        ]);

        return response()->json([
            'data' => $this->postRepository->createPost($request->all())
        ]);
    }

    //delete user own post
    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        if(auth()->user()->id == $post->user_id):
            return $post->delete(); 
        endif;
       
    }

    public function approve(Request $request)
    {
        if(auth()->user()->hasRole() == 'admin'): 
            $post = Post::find($request->id);
            $post->status = 'approve';
            $post->save();

            return response()->json([
                'data' => $post
            ]);
        endif;
    }

    public function reject(Request $request)
    {
        if(auth()->user()->hasRole() == 'admin'): 
            $post = Post::find($request->id);
            $post->status = 'reject';
            $post->save();

            return response()->json([
                'data' => $post
            ]);
        endif;
    }

    public function search($name)
    {
        return Post::where('question','like','%'.$name.'%')->get();
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'post_id' => ['required'],
            'comment' => ['required']
        ]);


        return Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ]);
    }
    
}
