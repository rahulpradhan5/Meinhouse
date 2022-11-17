<?php

namespace App\Http\Helper;

use App\Models\UserDevices;
use App\Models\User;
use App\Models\Notification;
class Helper
{
 

	public function activity_save($user_id,$subject,$message,$type,$booking_id,$otp){

        try{ 

           
            $activity = new Notification();
            $activity->user_id = $user_id;
            $activity->subject = $subject;
            $activity->message = $message;
            $activity->type = $type;
            $activity->booking_id = $booking_id;
            $activity->otp = $otp ? $otp : '';
            $activity->save();
            $id = $activity->id;
            return $id;
            
        }catch (Exception $e) {

            return redirect()->back()->with('error', 'Message: '.$e->getMessage().' Line: '.$e->getLine());
        }
    }


	//Latest push notification for ios and android
	public function globalPushNotificationMultiple($deviceTokens,$mesg_info,$message,$data) {

   		$messagedata = [
          'message_information'=> (object)$mesg_info,
          'message'=>$message,

          ];

        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAANVudOBM:APA91bFe7p8El11W3Wy3T4hw9Che7-5RMUWZnKplV4brhy-8CD5jdmKUA7oeM56qrhw3TKZKoRlpDglgTC2IM9MeXFIo1nTygzWh1dKdiV2N5OxOo4LsZ3K5zk6_K8uilHytxw1II71z';
        $title = $mesg_info;
        $body = $message;
        $notification = array('title' =>$title, 'text' => $body, 'sound' => 'default', 'badge' => '1', "custom" => $messagedata , "data" => $data );
        $arrayToSend = array('registration_ids' => $deviceTokens, 'data' => $notification, 'notification' => $notification, 'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $response = curl_exec($ch);
       
        //dd($deviceTokens, $response);

        curl_close($ch);
        return 1;   
    }


}