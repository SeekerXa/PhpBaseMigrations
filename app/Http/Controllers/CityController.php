<?php

namespace App\Http\Controllers;



use App\Models\City;
use App\Models\Weather;
use Hamcrest\Core\IsEqual;
use App\Api\GeoapifyClient;
use Illuminate\Http\Request;
use App\Api\WeatherapifyClient;
use Illuminate\Support\Facades\DB;





class CityController extends Controller
{
     protected GeoapifyClient $apiGeoRequest;
     protected WeatherapifyClient $apiWeatherRequest;

    public function __construct(GeoapifyClient $apiGeoRequest, WeatherapifyClient $apiWeatherRequest)
    {
        $this->apiGeoRequest = $apiGeoRequest;
        $this->apiWeatherRequest = $apiWeatherRequest;
    }


    public function list(): string
    {
        $cities = DB::table('cities')->get();
        return $cities;
    }

    public function listWeather(): string
    {
        
        $weather = DB::table('weather')->get();
        return $weather;
    }

    public function create(Request $request): string
    {
        $cords = $this->apiGeoRequest->getCoordinates($request->name);
        $city = new City;
        $city->name = $request->name;
        $city->lat = $cords['lat'];
        $city->lon = $cords['lon'];
        $city->save();
        return json_encode($city);
    }

    public function addWeather(Request $request) 
    {
        $cities = DB::select('select * from cities');
        
        foreach ($cities as $city) {

            $weather = new Weather;
            echo $city->name;
            $data = $this->apiWeatherRequest->getWeather($city->lat, $city->lon);
            $weather->temperature = $data['temperature'];
            $weather->pressure = $data['pressure'];
            $weather->precipitation = $data['precipitation'];
            $weather->wind_speed = $data['wind_speed'];

        }

    }

    public function update(Request $request,int $id)
    {
        if($request->id != NULL){

            $cords = $this->apiGeoRequest->getCoordinates($request->name);
            DB::table('cities')
            ->where('id', $id)
            ->update(
                ['name'=> $request->name,
                'lat'=> $cords['lat'],
                'lon'=> $cords['lon']
                ]
            );
        }
    }

    public function destroy(Request $request,int $id)
    {
        DB::table('cities')
        ->where('id', $id)
        ->delete();
    }

    public function testgeo(Request $request)
    {
        $this->apiGeoRequest->getCoordinates($request->name);
    }

    public function testweather(Request $request)
    {
        $this->apiWeatherRequest->getWeather();
    }

    public function testHasMany(Request $request)
    {
        $city = new City;
        echo($city->weathers()->count());
    }
    

}
