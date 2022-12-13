<?php

namespace App\Console\Commands;

use App\CommandBus;
use App\Mail\AlertMail;
use App\Models\City;
use Illuminate\Console\Command;
use App\Commands\CreateCityCommand;
use Illuminate\Support\Facades\Mail;
use App\Validators\CreateCityValidator;

class WeatherAlert extends Command
{
    protected $signature = 'weather:alert {cityName} {email}';

    protected $description = 'Sending weather alert, weather-alert {city} {email}';

    public function __construct(protected CommandBus $commandBus)
    {
        parent::__construct();
    }

    public function handle()
    {
        $cityName =(string) $this->argument('cityName');
        $city=City::where('name', $cityName)->first();

        if($city== null)
        {
            $command = new CreateCityCommand($cityName);
            if ($errors = (new CreateCityValidator($command))->errors()) return $this->jsonValidate($errors);
            $id = $this->commandBus->handle($command);
            
        }
        
        $email = $this->argument('email');
        $weather = $city->weathers()->latest()->first();
        //$weather = Weather::where()->first();
        $mailable = new AlertMail($weather, $city);
        
        $test = Mail::to($email)->send($mailable);
        dd('1234');
        
        
        
        return Command::SUCCESS;
    }
}
