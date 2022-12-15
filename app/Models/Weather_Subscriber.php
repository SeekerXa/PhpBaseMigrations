<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Weather_Subscriber extends Authenticatable
{
    use HasFactory;

    
    protected $table = 'weather_subscribers';
    

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getID()
    {
        return $this->id;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getSendingHour()
    {
        return $this->sendingHour;
    }
}
