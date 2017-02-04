<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Push extends Controller
{

    private $FCM_TOKEN = "AAAAGu2cwag:APA91bHXY0sYxy5JXcIUH-2AOyujvIgbl-6f-Qu15HAjJF1ih5-hr7oSH8tTqRbsroJROpnSHqt9s7v1QE0jAotwce0HQGdSBJWSg2cNkC3K4zFItU5YJxvQJdPCTH6gjIC8O5uwYpuv";
    private $DEVICE_TOKEN = "dpJnRZzlnYs:APA91bGqF-b3MNfA5zeofmw14jJ3lZ92yWGgDbUUZ4G0NURxbyTY3Rxe_epvS5k9Q5Efl6fbm5WI90KsjfOKra7ma5LAUXyXWrOVYTm18MIkeFTuPmDFpZzOoYuQTRq9VsQvBEEDmjdV";

    public function go()
    {
        $title = "Soy un titulo";
        $message = "Soy un mensaje push";

        $pushMessage = [
            "data" => [
                "title" => $title,
                "message" => $message,
            ],
            "to" => $this->DEVICE_TOKEN
        ];

        $client = new Client();
        $res = $client->post('http://fcm.googleapis.com/fcm/send', [
            "headers" => [
                'Authorization' => "key=" . $this->FCM_TOKEN,
                'Content-Type' => 'application/json'
            ],
            "body" => json_encode($pushMessage)
        ]);
        return ["Send Push"];
    }
}
