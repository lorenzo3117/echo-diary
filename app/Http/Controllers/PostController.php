<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostFormRequest;
use App\Models\Post;
use Bouncer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Bouncer::authorize('create', Post::class);

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request): RedirectResponse
    {
        Bouncer::authorize('create', Post::class);

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        return redirect()->route('post.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        // TODO allow guests
        Gate::authorize('view', $post);

        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        Bouncer::authorize('update', $post);

        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostFormRequest $request, Post $post): RedirectResponse
    {
        Bouncer::authorize('update', $post);

        $post->update($request->validated());

        return redirect()->route('post.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        Bouncer::authorize('delete', $post);

        $post->delete();

        return redirect()->route('post.index');
    }
}
