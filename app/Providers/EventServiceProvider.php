<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;

use App\Events\ContactRequestEvent;
use App\Listeners\ContactEventSubscriber;
use App\Listeners\ContactListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ]
        
    ];
    protected $subscribe = [    
        ContactEventSubscriber::class 
       
    ];




    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
