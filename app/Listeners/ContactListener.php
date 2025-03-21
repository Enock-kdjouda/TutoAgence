<?php

namespace App\Listeners;

use App\Events\ContactRequestEvent;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class ContactListener implements ShouldQueue 
{
    /**
     * Create the event listener.
     */
    public function __construct(private Mailer $mailer )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContactRequestEvent $event): void
    {
        Sleep(3);
        $this->mailer->send(new \App\Mail\PropertyContactMail($event->property, $event->data));
    }
}
