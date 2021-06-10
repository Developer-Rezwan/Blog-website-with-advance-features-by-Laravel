<?php

namespace App\Providers;

use App\Events\ChattingEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\PostListener;
use App\Events\PostUpdated;
use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Listeners\ChatListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostCreated::class => [
            PostListener::class
        ],
        PostUpdated::class => [
            PostListener::class
        ],
        PostDeleted::class => [
            PostListener::class
        ],
        ChattingEvent::class => [
            ChatListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}