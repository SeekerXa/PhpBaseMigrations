<?php

namespace App\Commands;




class CreateCityCommand 
{
    public function __construct(
        public string $cityName
    ) {
    }
}