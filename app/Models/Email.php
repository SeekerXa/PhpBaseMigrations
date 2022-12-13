<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Email extends Authenticatable
{
    use HasFactory;


    public function weather_subscriber()
    {
        return $this->hasOne(Weather_Subscriber::class);
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getSubId()
    {
        return $this->sub_id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getSendingTime() 
    {
        return $this->emailSend;
    }

}
