<?php

namespace board\services\users;

use board\services\users\sms\SmsSender;

class SmsRuService implements SmsSender
{
    public function send($number, $code, $text)
    {
        // TODO: Implement send() method.
    }
}