<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ControllerResponse;
use App\Models\City;
use App\Api\GeoapifyClient;
use Illuminate\Http\Request;
use App\Api\WeatherapifyClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{
    use ControllerResponse;

    protected GeoapifyClient $apiGeoRequest;
     protected WeatherapifyClient $apiWeatherRequest;

    public function __construct(GeoapifyClient $apiGeoRequest, WeatherapifyClient $apiWeatherRequest)
    {
        $this->apiGeoRequest = $apiGeoRequest;
        $this->apiWeatherRequest = $apiWeatherRequest;
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
        if ($errors = $this->validationErrors($request)) {

            return $this->jsonValidate($errors);
        }
        $cords = $this->apiGeoRequest->getCoordinates($request->name);
        $city = new City;
        $city->name = $request->name;
        $city->lat = $cords['lat'];
        $city->lon = $cords['lon'];
        $city->save();

        return $this->jsonCreate();
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

    public function testgeo(Request $request)
    {
        $this->apiGeoRequest->getCoordinates($request->name);
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