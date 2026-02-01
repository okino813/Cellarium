<?php
namespace App\Services;

use App\Services\Contracts\MailgunServiceInterface;
use Illuminate\Support\Facades\Config;

class MailGunService implements MailgunServiceInterface{

    public function send($to, $subject, $body){
        $url = "https://api.mailgun.net/v3/sandbox12c879afbb7e4db69e067064e5025f77.mailgun.org/messages";

        $userpwd = config('mail.mailers.mailgun.userpwd');
        $postmaster = config('mail.mailers.mailgun.postmaster');

        $data = [
            'from'    => 'Cellarium <'.$postmaster.'>',
            'to'      => $to,
            'subject' => $subject,
            'html'    => $body
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'response' => $response,
            'httpCode' => $httpCode
        ];
    }
}
