<?php

namespace App\Queries;

use App\Models\City;

class GetCityQuery
{
    public function __construct(private string $name) {
    }

    public function getData(): City
    {
        return City::query()->findOrFail($this->name);
    }
}