<?php

namespace App\Commands\WeatherSubscriber;




class UpdateWeatherSubscriberCommand
{
    public function __construct(
        public int $id,
        public ?string $city,
        public ?string $email,
        public ?string $sendingHour
    ) {
    }
}