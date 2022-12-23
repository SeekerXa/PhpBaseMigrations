<?php

namespace App\Validators\Cities;

use Illuminate\Support\Facades\Validator;

class CityNameValidator
{
    public function __construct(protected string $cityName) {

    }

    public function errors(): ?array
    {
        $validator = Validator::make(
            [
               'name' => $this->cityName
            ], 
            [
                'name' => 'alpha|required|max:255',
            ]
        );
      
         if ($validator->fails())
         {
            return $validator->errors()->toArray();
         }
         else
         {
            return null;
         }
    }
}