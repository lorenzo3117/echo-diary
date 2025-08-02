<?php

namespace App\Http\Controllers;

use App\Notifications\PostPublishedNotification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display the user's notifications.
     *
     * @throws AuthenticationException
     */
    public function notifications(): View
    {
        Auth::authenticate();

        $unreadNotifications = Auth::user()
            ->unreadNotifications()
            ->paginate(10);

        return view('profile.notifications', [
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    /**
     * Display the user's notifications.
     *
     * @throws AuthenticationException
     */
    public function read(DatabaseNotification $notification, Request $request): RedirectResponse
    {
        Auth::authenticate();

        $notification->markAsRead();

        switch ($notification->type) {
            case PostPublishedNotification::class:
                return redirect(route('post.show', $notification->data['post_id']));
        }

        return redirect()->route('home');
    }
}
