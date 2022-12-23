<?php

namespace App\Handlers\Emails;

use App\Commands\Emails\CreateEmailCommand;
use App\Models\Email;

class CreateEmailHandler
{
    public function __construct(
    ) {
    }

    public function __invoke(CreateEmailCommand $command)
    {
        $email = new Email;
        $email->type = $command->type;
        $email->email = $command->email;
        $email->emailSend = $command->sendingHour;
        $email->save();

        return $email->getId();
    }
}