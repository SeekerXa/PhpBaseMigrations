<?php

namespace App\Console\Commands;

use App\Models\Weather;
use App\Api\WeatherapifyClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckWeather extends Command
{

    protected WeatherapifyClient $apiWeatherRequest;

  
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check weather to all cities';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('check-weather was started!');
        $cities = DB::select('select * from cities');
        $temp= new WeatherapifyClient;

        foreach ($cities as $city) {

            $weather = new Weather;
           
            $data = $temp->getWeather($city->lat, $city->lon);
            $weather->temperature = $data['temperature'];
            $weather->pressure = $data['pressure'];
            $weather->precipitation = $data['precipitation'];
            $weather->wind_speed = $data['wind_speed'];
            $weather->city_id = $city->id;
           // echo $city->name;
           // echo $weather;
            $weather->save();
        }

        return Command::SUCCESS;
    }
}
