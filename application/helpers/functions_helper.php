<?php function sendsms($mobileNumber,$otp) {

// $url="http://my.smslab.in/api/otp.php";
// $postData = array(
//     'authkey' => "272916Ai5UKaaTyz3H612475c9P1",
//     'mobile' => "$mobileNumber",
//     'message' => urlencode("OTP is $otp"),
//     'sender' => "BIGAME",
//     'route' => $route,
//     'otp' => $otp
// );
// // $paramArr['url'] = $url;
// // $paramArr['postData'] = $postData;


//     // $url = $param['url'];
// 	// $postData = $param['postData'];

// 	$ch = curl_init();
// 	curl_setopt_array($ch, array(
// 	    CURLOPT_URL => $url,
// 	    CURLOPT_RETURNTRANSFER => true,
// 	    CURLOPT_POST => true,
// 	    CURLOPT_POSTFIELDS => $postData
// 	    //,CURLOPT_FOLLOWLOCATION => true
// 	));


// 	//Ignore SSL certificate verification
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


// 	//get response
// 	$output = curl_exec($ch);

// 	//Print error if any
// 	if(curl_errno($ch))
// 	{
// 	    return curl_error($ch);
// 	}

// 	curl_close($ch);

// 	return $output;




    //Your authentication key
    $authKey = "272916Ai5UKaaTyz3H612475c9P1";

//Multiple mobiles numbers separated by comma
//    $mobileNumber = "9999999";

//Sender ID,While using route4 sender id should be 6 characters long.
    $senderId = "PINVAS";

//Your message to send, Add URL encoding here.
    // $message = urlencode("code is $otp");
    $message = urlencode("$otp is Your new PASSWORD for login. Do not share this Password with anyone. PINVAS");

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
    
    $url = "http://my.smslab.in/api/sendhttp.php?authkey=$authKey&mobiles=$mobileNumber&message=$message&sender=$senderId&route=$route&DLT_TE_ID=1307163335376385903";

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
?>