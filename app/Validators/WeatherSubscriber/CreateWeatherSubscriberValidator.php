<?php

namespace App\Validators\WeatherSubscriber;

use Illuminate\Support\Facades\Validator;
use App\Commands\WeatherSubscriber\CreateWeatherSubscriberCommand;

class CreateWeatherSubscriberValidator
{
    public function __construct(protected CreateWeatherSubscriberCommand $command) {

    }

    public function errors(): ?array
    {
        $validator = Validator::make(
            [
               'city' => $this->command->city,
               'email' => $this->command->email,
               'sendingHour' => $this->command->sendingHour

            ], 
            [
                'city' => 'alpha|required|max:255',
                'email' => 'email|required|max:255',
                'sendingHour' => 'required|numeric'
            ]
        );
      
         if ($validator->fails())
         {
            return $validator->errors()->toArray();
         }
         else
         {
            return null;
         }
    }
}