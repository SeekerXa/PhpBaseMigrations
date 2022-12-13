<?php

namespace Tests\Unit;

use App\Models\Weather;
use PHPUnit\Framework\TestCase;

class WeatherMailTest extends TestCase
{
    /**
     * @dataProvider weatherResults
     */

    public function test_example(float $temperature, string $result)
    {
        $weather = new Weather();
        $weather->temperature = $temperature;
        $message = $weather->getMassage();

        $this->assertEquals($message, $result);
    }

    public function weatherResults()
    {
        return [
            // temperature, result
            [30, 'Its Warm!'],
            [20, 'Put something'],
            [11, 'Put something'],
            [10, 'Put a jacket'],
            [3, 'Put a jacket'],
            [0, 'Dont Forget Hat and Scarrf'],
            [-6, 'Dont Forget Hat and Scarrf']

        ];
    }   

}