<?php

namespace App\Console\Commands;

use App\CommandBus;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Commands\Emails\CreateEmailCommand;



class SubscriberWeatherSend extends Command
{
    protected $signature = 'weather:sub';
    protected $description = 'Sending weather to subscribent';

    public function __construct(protected CommandBus $commandBus)
    {
        parent::__construct();
    }  

    public function createEmail($email)   
    {
        $dataTime = Carbon::now();
        $command = new CreateEmailCommand('Weather_Email',$email,$dataTime);
        return $this->commandBus->handle($command);
       
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
                $this->createEmail($sub->email);
            }
        }
        else Log::info('Noone wants mail at this hour!');
        
        return Command::SUCCESS;
    }
}
