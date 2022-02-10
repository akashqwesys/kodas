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
}
?>