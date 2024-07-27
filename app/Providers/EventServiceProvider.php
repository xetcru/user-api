<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Карта слушателей событий для приложения.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Listeners\SendWelcomeEmail',
        ],
    ];

    /**
     * Регистрация любых других служб событий.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
