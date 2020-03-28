<?php

namespace App\Http\Controllers;

use App\Comisionista;
use ExponentPhpSDK\Expo;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notify_oreq($com_id,$body,$oreq){
            $com = (new Comisionista())->where("id",$com_id)->first();
        $channelName = 'reportes';
        $recipient= $com->tokenapp;

        // You can quickly bootup an expo instance
        $expo = Expo::normalSetup();

        // Subscribe the recipient to the server
        $expo->subscribe($channelName, $recipient);

        // Build the notification data
        $notification = [
            'title'=>"Notificación Nueva",'body' => $body, 'data'=> json_encode(array('oreq_id' => $oreq)),
            "sound"=>"default"
        ];

        // Notify an interest with a notification
        $expo->notify($channelName, $notification);
    }
}
