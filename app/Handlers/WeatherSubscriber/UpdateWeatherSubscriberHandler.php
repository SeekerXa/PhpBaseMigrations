<?php

namespace App\Handlers\WeatherSubscriber;

use Illuminate\Support\Facades\DB;
use App\Commands\WeatherSubscriber\UpdateWeatherSubscriberCommand;

class UpdateWeatherSubscriberHandler
{
    public function __construct(
    ) {
    }
    public function __invoke(UpdateWeatherSubscriberCommand $command)
    {
        DB::table('weather_subscribers')
         ->where('id', $command->id)
         ->update(
             ['city'=> $command->city,
               'email'=> $command->email,
               'sendingHour'=> $command->sendingHour
             ]
        );
     
        $newCity = DB::table('weather_subscribers')->where('id', $command->id)->first();

        return [$newCity];
    }
}


