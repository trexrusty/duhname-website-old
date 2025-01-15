<?php

namespace App\Http\Controllers\Social;

use App\Models\Like;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function post_like(Post $post)
    {

        $user = Auth::user();

        if($user->hasLikedPost($post))
        {
            $user->likes()->where('post_id', $post->id)->delete();
        }
        else
        {
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
        }


        return view('post.post', compact('post'));
    }

    public function comment_like(Comment $comment)
    {

        $user = Auth::user();

        if($user->hasLikedComment($comment))
        {
            $user->likes()->where('comment_id', $comment->id)->delete();
        }
        else
        {
            Like::create([
                'comment_id' => $comment->id,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
