<?php

namespace App\Listeners;

use Illuminate\Events\Dispatcher;
use App\Mail\PropertyContactMail;

use App\Events\ContactRequestEvent;
use Illuminate\Mail\Mailer;

class ContactEventSubscriber {
    
    public function __construct(private Mailer $mailer)
    {
        
    }
    public function sendEmailForContact(ContactRequestEvent $event){

        $this->mailer->send(new \App\Mail\PropertyContactMail($event->property, $event->data));
    }
    public function subscribe(Dispatcher $dispatcher) {
        $dispatcher->listen(
            ContactRequestEvent::class,
            [ContactEventSubscriber::class, 'sendEmailForContact']
        );
    }

}


