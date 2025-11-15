<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreationListener
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
    public function handle(UserCreatedEvent $event): void
    {
        $event->user->notify(new UserCreatedNotification($event->user));
    }
}
