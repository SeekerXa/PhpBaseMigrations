<?php

namespace App\Commands\WeatherSubscriber;




class CreateWeatherSubscriberCommand 
{
    public function __construct(
        public string $city,
        public string $email,
        public string $sendingHour
    ) {
    }
}

