<?php

namespace App\Handlers\Cities;

use App\Api\GeoapifyClient;
use App\Commands\Cities\UpdateCityCommand;
use Illuminate\Support\Facades\DB;

class UpdateCityHandler
{
    public function __construct(
        protected GeoapifyClient $apiGeoRequest, 
    ) {
    }
    public function __invoke(UpdateCityCommand $command)
    {
        $cords = $this->apiGeoRequest->getCoordinates($command->cityName);
        $oldCity = DB::table('cities')->where('id', $command->cityId)->first();
        DB::table('cities')
         ->where('id', $command->cityId)
         ->update(
             ['name'=> $command->cityName,
            'lat'=> $cords['lat'],
             'lon'=> $cords['lon']
             ]
        );
        $newCity = DB::table('cities')->where('id', $command->cityId)->first();

        return [$oldCity,$newCity];
    }
}



