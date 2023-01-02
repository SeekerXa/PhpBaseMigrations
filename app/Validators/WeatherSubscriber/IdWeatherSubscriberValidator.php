<?php

namespace App\Validators\WeatherSubscriber;

use App\Models\Weather_Subscriber;

class IdWeatherSubscriberValidator
{
    public function __construct() {
    }
    public function idDoesNotExist(int $id): bool
    {
        if(Weather_Subscriber::where('id', $id)->exists()) {
            return false;
        }
        return true;
    }
}

