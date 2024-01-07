<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PushNotificationController extends Controller
{
    public function sendPushNotification(Request $request) {

       try {
        $url = "https://fcm.googleapis.com/fcm/send";
        $topic = "/topics/". $request->topic;

        $serverKey = 'AAAAqhAdlOQ:APA91bE9KhwOBnhw4-m7LAdZC6AXRCTmJ3Bvv_kBilpoe9enBRDsVnLR9v60pp6gEo4QMgHaelPxwuOPV8LTgDkx6cX2R0IhaDe07ofGeyz02_3kISuofkyBaZjVYe9J-m9wnb2__dR0';

        $title = $request->title;
        $body = $request->body;

        $data = $request->data;

        $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => $topic, 'notification' => $notification, 'priority'=>'high', 'data' => $data);

        $json = json_encode($arrayToSend);

        $headers = array();

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        //Send the request
        curl_exec($ch);

        curl_close($ch);
        

        // prevent return message_id
        return true;
        
       } catch (\Throwable $th) {
        Log::error($th);
        return false;
       }
    }
}
