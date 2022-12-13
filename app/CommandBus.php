<?php

namespace App;

use Illuminate\Support\Facades\App;
use ReflectionClass;

class CommandBus
{
    public function handle($command): mixed
    {
        // resolve handler
        $reflection = new ReflectionClass($command);
        $handlerName = str_replace("Command", "Handler", $reflection->getShortName());
        $handlerName = str_replace($reflection->getShortName(), $handlerName, $reflection->getName());
        $handlerName = str_replace("Commands", "Handlers", $handlerName);

        $handler = App::make($handlerName);
        return $handler($command);
    }
}