<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        $posts = Post::homeFeed();

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
