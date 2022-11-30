<?php

namespace App\Api;

use Doctrine\DBAL\Driver\PDO\Result;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class GeoapifyClient 
{

    private $cityName;

   

    // która zwróci koordynaty w tablicy
    // [ 'lat' => XX.XXXX, 'lon' => 'XX.XXXXXX']
    public function getCoordinates(string $cityName): array
    {
       

        $response = Http::get('https://api.geoapify.com/v1/geocode/search?', [
        
            'city' => $cityName,
            'format' => 'json',
            'apiKey' => config('api.geoapi.key')

        ]);

        $cityData = $response->json($key = null);
        $lon = (float)Arr::get($cityData, 'results.0.lon');
        $lat = (float)Arr::get($cityData, 'results.0.lat');
        $cords = array(
            'lon' => $lon,
            'lat' => $lat
        );

        return $cords;
    }








};

   // protected GeoapifyClient $client;
    // public function __construct(GeoapifyClient $client)
    // {
    //     $this->client = $client;
    // }
 