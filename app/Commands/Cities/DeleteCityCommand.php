<?php

namespace App\Commands\Cities;




class DeleteCityCommand 
{
    public function __construct(
        public int $id
    ) {
    }
}