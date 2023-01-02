<?php

namespace App\Handlers\WeatherSubscriber;


use App\Models\WeatherSubscriber;
use App\Events\WeatherSubscriberCreateEvent;
use App\Commands\WeatherSubscriber\CreateWeatherSubscriberCommand;

class CreateWeatherSubscriberHandler
{
    public function __construct(
    ) {
    }

    public function __invoke(CreateWeatherSubscriberCommand $command)
    {
       
        $Weather_Subscriber = new WeatherSubscriber;
        $Weather_Subscriber->city = $command->city;
        $Weather_Subscriber->email = $command->email;
        $Weather_Subscriber->sendingHour = $command->sendingHour;
        $Weather_Subscriber->save();
        WeatherSubscriberCreateEvent::dispatch($Weather_Subscriber);

        return $Weather_Subscriber;
    }
}