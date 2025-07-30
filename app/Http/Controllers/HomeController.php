<?php

namespace App\Http\Controllers;

use App\Enum\PostStatus;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(Request $request): View
    {
        $user = $request->user();

        $posts = Post::query()
            ->when($user != null, function ($query) use ($user) {
                $query->where('user_id', '!=', $user->id);
            })
            ->where('status', '=', PostStatus::PUBLISHED->value)
            ->orderByDesc('created_at')
            ->with('user')
            ->paginate(10);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
