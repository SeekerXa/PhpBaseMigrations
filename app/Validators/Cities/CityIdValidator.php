<?php

namespace App\Validators\Cities;

use App\Models\City;

class CityIdValidator
{
    public function __construct() {
    }
    public function idDoesNotExist(int $id): bool
    {
        if(City::where('id', $id)->exists()) {
            return false;
        }
        return true;
    }
}

