<?php

namespace App\Http\Controllers;

use App\CommandBus;
use App\Mail\AlertMail;
use App\Models\City;
use App\Models\Weather;
use App\Api\GeoapifyClient;
use Illuminate\Http\Request;
use App\Api\WeatherapifyClient;
use Illuminate\Support\Facades\DB;
use App\Commands\CreateCityCommand;
use Illuminate\Support\Facades\Mail;
use App\Validators\CreateCityValidator;
use Illuminate\Support\Facades\Validator;
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

    public function validationErrors($request): ?array
    {
        $validator = Validator::make($request->all(), [
            'name' => 'alpha|required|max:255',
         ]);
      
         if($validator->fails())
         {
            return $validator->errors()->toArray();
         }
         else
         {
            return null;
         }
    }

    public function idValidation(int $id): bool
    {
        if(City::where('id', $id)->exists()) {

            return true;
        }
        // echo 'missing id';
        return false;
    }
    public function create(Request $request): JsonResponse
    {
        $command = new CreateCityCommand($request->name);
        if ($errors = (new CreateCityValidator($command))->errors()) return $this->jsonValidate($errors);
        $id = $this->commandBus->handle($command);

        return $this->jsonCreate(['id' => $id]);
    }

    public function update(Request $request, int $id): JsonResponse
    {

        if($errors = $this->validationErrors($request)){
            return $this->jsonValidate($errors);
        }

        if(!$this->idValidation($id)){
            return $this->jsonMissingId();
        }

        $cords = $this->apiGeoRequest->getCoordinates($request->name);
        $city=DB::table('cities')
         ->where('id', $id)
         ->update(
             ['name'=> $request->name,
            'lat'=> $cords['lat'],
             'lon'=> $cords['lon']
             ]
        );
        return $this->jsonResponse($city);
        
    }

    public function destroy(Request $request,int $id): JsonResponse
    {
        if(!$this->idValidation($id))
        {
            return $this->jsonMissingId();
        }
        $this->idValidation($id);
        DB::table('cities')
        ->where('id', $id)
        ->delete();

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