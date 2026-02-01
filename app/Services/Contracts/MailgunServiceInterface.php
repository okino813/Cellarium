<?php

namespace App\Services\Contracts;

interface MailgunServiceInterface
{
    public function send($to, $subject, $body);
}
