<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    public function getTemperature(): float
    {
        return $this->temperature;
    }
    public function getPressure(): float
    {
        return $this->pressure;
    }
    public function getPrecipitation(): float
    {
        return $this->precipitation;
    }
    public function getWindSpeed(): float
    {
        return $this->wind_speed;
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }

    public function getMassage()
    {
        $temp=$this->getTemperature();

        if($temp>20) return 'Its Warm!';
        if($temp>10) return 'Put something';
        if($temp>0) return 'Put a jacket';
        else return 'Dont Forget Hat and Scarrf';
    }


}
