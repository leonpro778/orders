<?php


namespace App\Service;


class SmsApi
{
    private $token, $from;

    public function __construct()
    {
        $this->token = config('smsapi.token');
        $this->from = config('smsapi.from');

    }

    public function sendSms($to, $message, $test = false)
    {
        $url = 'https://api.smsapi.pl/sms.do';

        $params = [
            'to' => $to,
            'from' => $this->from,
            'message' => $message,
            'format' => 'json',
        ];

        if ($test) { $params['test'] = 1; }

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $params);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $this->token"
        ));

        $content = curl_exec($c);

        curl_close($c);

        return $content;
    }
}
