<?php

namespace App\Handlers\WeatherSubscriber;


use Illuminate\Support\Facades\DB;
use App\Commands\WeatherSubscriber\DeleteWeatherSubscriberCommand;


class DeleteWeatherSubscriberHandler
{
    public function __construct(
    ) {
    }
    public function __invoke(DeleteWeatherSubscriberCommand $command)
    {
     return DB::table('weather_subscribers')
     ->where('id', $command->id)
     ->delete();
    }
}




