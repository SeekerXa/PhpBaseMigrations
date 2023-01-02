<?php

namespace App\Handlers\Cities;


use Illuminate\Support\Facades\DB;
use App\Commands\Cities\DeleteCityCommand;

class DeleteCityHandler
{
    public function __construct(
    ) {
    }
    public function __invoke(DeleteCityCommand $command)
    {
     return DB::table('cities')
     ->where('id', $command->id)
     ->delete();
    }
}




