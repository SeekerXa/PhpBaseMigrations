<?php

namespace App\Http\Controllers;

use Hamcrest\Core\IsEqual;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function list(): string
    {
        $cities = DB::table('cities')->get();
        return json_encode($cities);
    }

    public function create(Request $request): string
    {
        $city = new City;
        $city->name = $request->name;
        $city->lat = $request->lat;
        $city->lon = $request->lon;
        $city->save();
        return json_encode($city);
    }
        
    public function update(Request $request,int $id)
    {
        if($request->id != NULL){

            DB::table('cities')
            ->where('id', $id)
            ->update(
                ['name'=> $request->name,
                'lat'=> $request->lat,
                'lon'=> $request->lon
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
}
