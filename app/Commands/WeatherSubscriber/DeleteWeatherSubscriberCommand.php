<?php

namespace App\Commands\WeatherSubscriber;




class DeleteWeatherSubscriberCommand 
{
    public function __construct(
        public int $id
    ) {
    }
}