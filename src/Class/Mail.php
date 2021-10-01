<?php

namespace App\Class;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private string $api_key = 'e388a72cc6b02ad43925549a25f6536f';

    private string $api_key_secret = '6020c59c1194890abad842121ed674ab';

    public function send($to_email, $to_name, $subject, $content): void
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "helloliohumb@gmail.com",
                        'Name' => "La Garde Robe"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3216582,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}