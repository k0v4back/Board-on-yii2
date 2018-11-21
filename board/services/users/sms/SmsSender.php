<?php

namespace board\services\users\sms;

interface SmsSender
{
    public function send($number, $text);
}