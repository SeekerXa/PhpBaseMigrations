<?php

namespace App\Commands\Cities;




class UpdateCityCommand 
{
    public function __construct(
        public string $cityName,
        public int $cityId
    ) {
    }
}