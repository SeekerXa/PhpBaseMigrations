<?php

namespace App\Http\Controllers;



use App\Models\City;
use Hamcrest\Core\IsEqual;
use App\Api\GeoapifyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;





class CityController extends Controller
{
     protected GeoapifyClient $apiGeoRequest;
    public function __construct(GeoapifyClient $apiGeoRequest)
    {
        $this->apiGeoRequest = $apiGeoRequest;
    }


    public function list(): string
    {
        $cities = DB::table('cities')->get();
        return json_encode($cities);
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

}
