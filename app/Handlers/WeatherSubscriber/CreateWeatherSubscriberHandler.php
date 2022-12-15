<?php

namespace App\Handlers\WeatherSubscriber;


use App\Models\Weather_Subscriber;
use App\Commands\WeatherSubscriber\CreateWeatherSubscriberCommand;

class CreateWeatherSubscriberHandler
{
    public function __construct(
    ) {
    }

    public function __invoke(CreateWeatherSubscriberCommand $command)
    {
       
        $Weather_Subscriber = new Weather_Subscriber;
        $Weather_Subscriber->city = $command->city;
        $Weather_Subscriber->email = $command->email;
        $Weather_Subscriber->sendingHour = $command->sendingHour;
        $Weather_Subscriber->save();

        return $Weather_Subscriber;
    }
}