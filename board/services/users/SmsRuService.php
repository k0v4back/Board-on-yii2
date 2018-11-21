<?php

namespace board\services\users;

use board\services\users\sms\SmsSender;
use GuzzleHttp\Client;
use linslin\yii2\curl;

class SmsRuService implements SmsSender
{
    private $appId;
    private $url;
    private $client;

    public function __construct($appId, $url = 'https://sms.ru/sms/send')
    {
        if (empty($appId)) {
            throw new \InvalidArgumentException('Не установлен appId');
        }

        $this->appId = $appId;
        $this->url = $url;
//        $this->client = new Client();
    }

//    public function send($number, $text)
//    {
//        $this->client->post($this->url, [
//            'from_params' => [
//                'api_id' => $this->appId,
//                'to' => '+' . trim($number, '+'),
//                'text' => $text,
//            ],
//        ]);
//    }

    public function send($number, $text)
    {
        if($ch = curl_init($this->url))
        {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                "api_id"	=>	$this->appId,
                "to"		=>	$number,
                "text"		=>	$text]);

            $code=curl_exec($ch);
            curl_close($ch);
        }
    }
}