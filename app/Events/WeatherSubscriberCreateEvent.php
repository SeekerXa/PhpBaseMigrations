<?php

namespace App\Events;

use App\Models\WeatherSubscriber;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class WeatherSubscriberCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public WeatherSubscriber $subscriber;
    public function __construct(WeatherSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    
}
