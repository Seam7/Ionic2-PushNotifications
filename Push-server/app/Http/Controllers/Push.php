<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Push extends Controller
{

    private $FCM_TOKEN = "AAAAGu2cwag:APA91bHXY0sYxy5JXcIUH-2AOyujvIgbl-6f-Qu15HAjJF1ih5-hr7oSH8tTqRbsroJROpnSHqt9s7v1QE0jAotwce0HQGdSBJWSg2cNkC3K4zFItU5YJxvQJdPCTH6gjIC8O5uwYpuv";
    private $DEVICE_TOKEN = "115655623080";

    public function go()
    {
        $title = "Soy un titulo";
        $message = "Soy un mensaje push";

        $pushMessage = "{\"data\":{\"title\":\"" +
                $title +
                "\",\"message\":\"" +
                $message +
                "\"},\"to\":\"" +
                $DEVICE_TOKEN +
                "\"}";


        $client = new Client();
        $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'Authorization' => "key=" + $FCM_TOKEN,
            'secret' => 'test_secret',
        ], $pushMessage);
        return($res);
    }
}
