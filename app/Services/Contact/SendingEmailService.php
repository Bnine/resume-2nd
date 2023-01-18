<?php

namespace App\Services\Contact;

use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Dto\Contact\SendingEmailDto;
use \Exception;

class SendingEmailService
{
    private $emailTo = 'tanreen1@gmail.com';

    public function __construct()
    {
        
    }

    public function send(SendingEmailDto $sendingEmailDto): void
    {
        Mail::to($this->emailTo)
            ->send(new Contact($sendingEmailDto->getEmailAddress(), $sendingEmailDto->getSubject(), $sendingEmailDto->getName(), $sendingEmailDto->getContent()));
    }

}