<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
class IndexController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('owner', 'likes')->latest()->paginate(5);

        if ($request->hasHeader('hx-request')) {
            return view('post.index', compact('posts'))->render();
        }

        return view('index', compact('posts'));
    }


}
