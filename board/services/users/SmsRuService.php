<?php

namespace board\services\users;

use board\services\users\sms\SmsSender;
use GuzzleHttp\Client;

class SmsRuService implements SmsSender
{
    private $appId;
    private $url;
    private $client;

    public function __construct($appId = '2FE45213-64F9-A0F6-03C6-68BB2BE064E0', $url = 'https://sms.ru/sms/send?')
    {
        if (empty($appId)) {
            throw new \InvalidArgumentException('Не установлен appId');
        }

        $this->appId = $appId;
        $this->url = $url;
        $this->client = new Client();
    }

    public function send($number, $text)
    {
        $this->client->post($this->url, [
            'from_params' => [
                'api_id' => $this->appId,
                'to' => '+' . trim($number, '+'),
                'msg' => $text,
                'json' => 1,
            ],
        ]);
    }
}