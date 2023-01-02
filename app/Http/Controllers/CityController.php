<?php

namespace App\Http\Controllers;

use App\CommandBus;
use App\Models\City;
use App\Mail\AlertMail;
use App\Models\Weather;
use App\Api\GeoapifyClient;
use Illuminate\Http\Request;
use App\Api\WeatherapifyClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Commands\Cities\CreateCityCommand;
use App\Commands\Cities\DeleteCityCommand;
use App\Commands\Cities\UpdateCityCommand;
use App\Validators\Cities\CityIdValidator;
use App\Validators\Cities\CityNameValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Controllers\Traits\ControllerResponse;

class CityController extends Controller
{
    use ControllerResponse;

    public function __construct(
        protected CommandBus $commandBus,
        protected GeoapifyClient $apiGeoRequest, 
        protected WeatherapifyClient $apiWeatherRequest
    )
    {
    }

    public function list(): JsonResponse
    {
        $cities = DB::table('cities')->get();

        return $this->jsonResponse($cities);
    }

    public function listWeather(): JsonResponse
    {
        $weather = DB::table('weather')->get();

        return $this->jsonResponse($weather);
    }

      public function create(Request $request): JsonResponse
    {
        $command = new CreateCityCommand($request->name);
        if ($errors = (new CityNameValidator($command->cityName))->errors()) return $this->jsonValidate($errors);
        $newCity = $this->commandBus->handle($command);

        return $this->jsonResponse($newCity);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        
        if((new CityIdValidator())->idDoesNotExist($id)){
            return $this->jsonMissingId();
        }
        if ($errors = (new CityNameValidator($request->cityName))->errors()) {
            return $this->jsonValidate($errors);
        }   
        $command = new UpdateCityCommand($request->cityName,$id);
        $updatedCity = $this->commandBus->handle($command);

        return $this->jsonResponse($updatedCity);     
    }

    public function destroy(Request $request,int $id): JsonResponse
    {
        if((new CityIdValidator())->idDoesNotExist($id)){
            return $this->jsonMissingId();
        }
        
        $command = new DeleteCityCommand($id);
        $this->commandBus->handle($command);


        return $this->jsonDelete();
    }

    public function testMail()
    {
        $weather = Weather::first();
        $city = City::first();
        $mailable = new AlertMail($weather, $city);
        $test = Mail::to('tatpat02@gmail.com')->send($mailable);
        dd($test);
    }

    public function testweather(Request $request)
    {
        $this->apiWeatherRequest->getWeather(12,12);
    }

    public function testHasMany(Request $request)
    {
        $city = new City;
        echo($city->weathers()->count());
    }
}