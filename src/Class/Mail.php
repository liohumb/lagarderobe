<?php

namespace App\Class;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'b5f4ebe7eda65869b11aed4001e09a48';
    private $api_key_secret = '8ebc98dbc660ef6d73dccff7afff952b';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "lgr@liohumb.com",
                        'Name' => "La Garde Robe"
                    ],
                    'To' => [
                        [
                            'Email' => "$to_email",
                            'Name' => "$to_name"
                        ]
                    ],
                    'TemplateID' => 3237937,
                    'TemplateLanguage' => true,
                    'Subject' => "$subject",
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