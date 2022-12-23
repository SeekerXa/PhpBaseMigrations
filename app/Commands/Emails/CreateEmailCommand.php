<?php

namespace App\Commands\Emails;




class CreateEmailCommand 
{
    public function __construct(
        public string $type,
        public string $email,
        public string $sendingHour
    ) {
    }
}

