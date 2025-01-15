<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::with('owner')->orderBy('created_at', 'desc')->paginate(10);
        return view('index', compact('posts'));
    }
}
