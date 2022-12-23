<?php

namespace App\Listeners;

use App\Events\WEATHER_SUBSCRIBER_CREATED_EVENT;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailsOnSubscriberCreate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\WEATHER_SUBSCRIBER_CREATED_EVENT  $event
     * @return void
     */
    public function handle(WEATHER_SUBSCRIBER_CREATED_EVENT $event)
    {
        //
    }
}
