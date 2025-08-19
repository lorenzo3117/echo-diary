<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CommentFormRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentPostedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentFormRequest $request, Post $post): RedirectResponse
    {
        Gate::authorize('comment', $post);

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $postedComment = $post->comments()->create($data);
        $post->user->notify(new CommentPostedNotification($postedComment));

        return redirect()
            ->to(url()->previous() . '#comments')
            ->with('success', __('Comment added successfully.'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentFormRequest $request, Comment $comment): RedirectResponse
    {
        Gate::authorize('update', $comment);

        $comment->update($request->validated());

        return redirect()
            ->to(url()->previous() . '#comments')
            ->with('success', __('Comment updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        Gate::authorize('delete', $comment);

        DatabaseNotification::query()
            ->where('type', CommentPostedNotification::class)
            ->whereJsonContains('data->comment_id', $comment->id)
            ->delete();

        $comment->delete();

        return redirect()
            ->to(url()->previous() . '#comments')
            ->with('success', __('Comment deleted successfully.'));
    }
}
