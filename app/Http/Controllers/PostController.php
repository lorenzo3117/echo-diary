<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostFormRequest;
use App\Models\Post;
use App\Notifications\PostPublishedNotification;
use App\Service\TrixAttachmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;
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
        Gate::authorize('create', Post::class);

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request): RedirectResponse
    {
        Gate::authorize('create', Post::class);

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        $this->processPost($post);

        return redirect()
            ->route('post.show', $post)
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
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
        Gate::authorize('update', $post);

        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostFormRequest $request, Post $post): RedirectResponse
    {
        Gate::authorize('update', $post);

        $post->update($request->validated());

        $this->processPost($post);

        return redirect()
            ->route('post.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, TrixAttachmentService $service): RedirectResponse
    {
        Gate::authorize('delete', $post);

        $service->delete($post->content->attachments());

        DatabaseNotification::query()
            ->where('type', PostPublishedNotification::class)
            ->whereJsonContains('data->post_id', $post->id)
            ->delete();

        $post->delete();

        return redirect()
            ->route('profile.show', Auth::user())
            ->with('success', 'Post deleted successfully.');
    }

    /**
     * Favorite a post.
     */
    public function favorite(Post $post): RedirectResponse
    {
        Gate::authorize('favorite', $post);

        $user = Auth::user();

        $post->favorites()->toggle($user);
        $post->save();

        if ($post->favorites()->where('user_id', '=', $user->id)->exists()) {
            return back()->with('success', 'Post added to your favorites successfully.');
        }

        return back()->with('success', 'Post removed from your favorites successfully.');
    }

    // TODO refactor this logic?
    private function processPost(Post $post): void
    {
        if ($post->isPublished() && $post->first_published_at === null) {
            $post->first_published_at = now();
            $post->save();
            $post->notifyFollowers();
        }
    }
}
