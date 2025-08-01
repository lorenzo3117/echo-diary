<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeFeedRequest;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(HomeFeedRequest $request): View
    {
        $onlyShowFollowing = $request->validated('following');

        $posts = Post::homeFeed($onlyShowFollowing);

        $request->flash();

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
