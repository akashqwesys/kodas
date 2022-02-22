<?php function sendsms($mobileNumber,$otp) {
    //Your authentication key
    $authKey = "272916Ai5UKaaTyz3H612475c9P1";

//Multiple mobiles numbers separated by comma
//    $mobileNumber = "9999999";

//Sender ID,While using route4 sender id should be 6 characters long.
    $senderId = "BIGAME";

//Your message to send, Add URL encoding here.
    $message = urlencode("OTP is $otp");

//Define route 
    $route = 4;
//Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route
    );

//API URL
    
    $url = "http://my.smslab.in/api/sendhttp.php?authkey=$authKey&mobiles=$mobileNumber&message=$message&sender=$senderId&route=$route";

// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
    ));

//Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//get response
    $output = curl_exec($ch);
//    print_r($output);die;
    
//Print error if any
    if (curl_errno($ch)) {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
    return $output;
}

function sendPushNotification($title, $body, $url = null)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $FcmToken = User::select('device_token')->where('user_type', 'MASTER_ADMIN')->pluck('device_token')->all();

    $serverKey = 'AAAAI2QkRPw:APA91bGSXXmthSXP_1saral1ejlOGNAP4MCqAU8Lsib8L1L0rBjE0ubD7vpiq3B4UXK86lTfaTr8Ae4Mm_5uJSp-akeeV0777FgNsG8eZAtRdJI3lXrBJcQxjnn-CeziwYgO7ORFWYeI';

    $data = [
        "registration_ids" => $FcmToken,
        "notification" => [
            "title" => $title,
            "body" => $body,
            "content_available" => true,
            "priority" => "high",
            "sound" => "default",
            "icon" => "/admin_assets/images/logo-small.png",
            "click_action" => $url ?? site_url('/'),
            "data" => [
                "time" => date('d-m-Y H:i:s')
            ]
        ]
    ];
    $encodedData = json_encode($data);

    $headers = [
        'Authorization:key=' . $serverKey,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
        // die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);
    // FCM response
    // dd($result);
}
?>