<?php

namespace App\Listeners;

use Bouncer;
use Illuminate\Auth\Events\Registered;

class LoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        echo "User $user->name has been registered and logged in.\n";
        Bouncer::allow($user)->to([
            'update',
            'delete',
        ], $user);
    }
}
