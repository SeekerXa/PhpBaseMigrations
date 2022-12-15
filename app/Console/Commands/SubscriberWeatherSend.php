<?php

namespace App\Console\Commands;

use App\CommandBus;
use App\Models\Email;
use App\Mail\AlertMail;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Console\Commands\WeatherAlert;
use Illuminate\Support\Facades\Artisan;


class SubscriberWeatherSend extends Command
{
    protected $signature = 'weather:sub';
    protected $description = 'Sending weather to subscribent';

    public function __construct(protected CommandBus $commandBus)
    {
        parent::__construct();
    }  
    
    public function handle()
    {
        $actualHour = (string)Carbon::now()->hour;
        $subscribers = DB::table('weather_subscribers')->where('sendingHour', $actualHour)->get();

        if(!$subscribers->isEmpty())
        {
            foreach ($subscribers as $sub) {
                $this->call('weather:alert', [
                    'cityName' => $sub->city,
                    'email' => $sub->email
                ]);
            }
        }
        else Log::info('Noone wants mail at this hour!');
        
        return Command::SUCCESS;
    }
}
