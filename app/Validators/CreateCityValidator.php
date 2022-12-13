<?php

namespace App\Validators;

use App\Commands\CreateCityCommand;
use Illuminate\Support\Facades\Validator;

class CreateCityValidator
{
    public function __construct(protected CreateCityCommand $command) {

    }

    public function errors(): ?array
    {
        $validator = Validator::make(
            [
               'name' => $this->command->cityName 
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