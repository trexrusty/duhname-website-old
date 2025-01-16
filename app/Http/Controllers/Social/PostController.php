<?php

namespace App\Http\Controllers\Social;

use App\Http\Requests\Social\Store\StorePostRequest;
use App\Http\Requests\Social\Update\UpdatePostRequest;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with('owner')->latest()->paginate(5);

        if ($request->hasHeader('hx-request')) {
            return view('post.index', compact('posts'));
        }

        return redirect()->route('home');
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
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        Post::create([
            'content' => $validated['content'],
            'owner_id' => Auth::id(),
            'community_id' => $validated['community_id'] ?? null,
        ]);
        if ($request->hasHeader('hx-request')) {
            return redirect()->route('post.index');
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

}
