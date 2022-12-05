<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class WeatherapifyClient 
{
    public function getWeather($lat, $lon): array
    {
        $now = Carbon::now()->format('Y-m-d');
        $currHour = Carbon::now()->hour;
        $params = urldecode(http_build_query([
            'latitude' => $lat,
            'longitude' => $lon,
            'hourly' => 'temperature_2m,precipitation,surface_pressure,windspeed_10m',
            'timezone' => 'Europe/Berlin',
            'start_date' => $now,
            'end_date' => $now,
            'timeformat' => 'unixtime'
        ]));
        $response = Http::get('https://api.open-meteo.com/v1/forecast?' . $params)->json($key = null);
        //echo json_encode($response);
        $weatherData = array(
            'temperature' => (float)Arr::get($response, 'hourly.temperature_2m.'.$currHour),
            'pressure' => (float)Arr::get($response, 'hourly.surface_pressure.'.$currHour),
            'precipitation' => (float)Arr::get($response, 'hourly.precipitation.'.$currHour),
            'wind_speed' => (float)Arr::get($response, 'hourly.windspeed_10m.'.$currHour)
        );

        return $weatherData;
    }
};