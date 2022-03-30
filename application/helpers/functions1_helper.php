<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('sessionCheck')) {
    function sessionCheck() {        
//        print_r($_SESSION);die;
        if (!isset($_SESSION['user']['user_id'])) {
            redirect(FRONT_LOGOUT_LINK);
        }
//        if (isset($_SESSION['last_login_timestamp'])) {               
//            if ((time() - $_SESSION['last_login_timestamp']) > 900) {                
//                redirect(FRONT_LOGOUT_LINK);
//            }
//            $_SESSION['last_login_timestamp']=time();
//        }
        if ($_SESSION['register_incomplete']==0) {                                         
            redirect(FRONT_SIGNUP_STEP1_LINK);            
        }
        return true;
    }
}
function escap_string_remove($params=array()) {
    $params1=array();
    foreach ($params as $key => $value){        
        $type=gettype($value);
        if($type=='string'){
            $params1[$key]=str_replace("'", "\'", $value);
        }else{
            $params1[$key]=$value;
        }        
    }
    return $params1;
}
function set_selected($desired_value, $new_value) {
    if ($desired_value == $new_value) {
         $str=' selected="selected" ';
         return $str;
    }
    else{
        return '';
    }
}
function set_cheked($desired_value, $new_value) {
    if ($desired_value == $new_value) {
        $str = ' checked ';
        return $str;
    }
    else{
        return '';
    }
}



if (!function_exists('successOrErrorMessage')) {
    function successOrErrorMessage($message,$type) {        
        $_SESSION[$type]=1;
        $_SESSION['message']=$message;
    }
}

if (!function_exists('subscriptionStatus')) {
function subscriptionStatus($strip_cusId='') {
    if($strip_cusId==''){
        $strip_cusId = $_SESSION['user']['user_stripeId'];
    }
        try {
            $customer = \Stripe\Customer::retrieve("$strip_cusId");
            $res = responseStrip($customer);
        } catch (Exception $e) {
            $eror = $e->getError()->message;
            $_SESSION['stripeError'] = 1;
            $_SESSION['stripeError_message'] = $eror;
            $res = array();
        }        
        if (!empty($res['subscriptions']['data'])) {
            foreach ($res['subscriptions']['data'] as $row) {
                if ($row['status'] == 'active') {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
}

if (!function_exists('subscriptionStatusByCusId')) {
function subscriptionStatusByCusId($strip_cusId) {      
        try {
            $customer = \Stripe\Customer::retrieve("$strip_cusId");
            $res = responseStrip($customer);
        } catch (Exception $e) {
            $eror = $e->getError()->message;
            $_SESSION['stripeError'] = 1;
            $_SESSION['stripeError_message'] = $eror;
            $res = array();
        }        
        if (!empty($res['subscriptions']['data'])) {
            foreach ($res['subscriptions']['data'] as $row) {
                if ($row['status'] == 'active') {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
}



if (!function_exists('unixTimestampToDayAgo')) { 
    function unixTimestampToDayAgo($timestamps) { 
        $dt = new DateTime($timestamps, new DateTimeZone('UTC'));
        $localtimezone=$_SESSION['timezone'];    
        $dt->setTimezone(new DateTimeZone("$localtimezone"));
        return time_elapsed_string(date('Y-m-d H:i:s', strtotime($dt->format('d M Y H:i:s'))));
    }
}

if (!function_exists('unixTimestampToDT')) { 
    function unixTimestampToDT($timestamps) { 
        $dt = new DateTime($timestamps, new DateTimeZone('UTC'));
        $localtimezone=$_SESSION['timezone'];    
        $dt->setTimezone(new DateTimeZone("$localtimezone"));
        return date('d M Y', strtotime($dt->format('d M Y H:i'))).' at '.date('h:i A', strtotime($dt->format('d M Y H:i')));
    }
}

function convertThousandToK($value) {
    if ($value >= 1000) {
        $number = $value / 1000;
        return $number . 'k';
    } else {
        return $value;
    }
}

if (!function_exists('sessionDestroy')) {

    function sessionDestroy() {
        session_destroy();
    }

}
if (!function_exists('sessionUser')) {

    function sessionUser($row) {         
        $_SESSION['user'] = $row;
//        $_SESSION['last_login_timestamp'] = time(); 
        $_SESSION['register_incomplete']=1;
    }

}

if (!function_exists('profileimageusers')) {

    function profileimageusers($oauth_provider, $picture) {
        if ($oauth_provider == 'facebook') {
            return $picture;
        } elseif ($oauth_provider == 'linkpan') {
            if (!empty($picture) && $picture != '') {
                return IMG_URL . 'profile-pic/' . $picture;
            } else {
                return IMG_URL . 'profile-pic/default.png';
            }
        } elseif ($oauth_provider == 'google') {
            return $picture;
        } elseif ($oauth_provider == 'linkedin') {
            return $picture;
        } else {
            return IMG_URL . 'profile-pic/default.png';
        }
    }

}


if (!function_exists('profileimage')) {

    function profileimage() {
        if ($_SESSION['user']['oauth_provider'] == 'facebook') {
            return $_SESSION['user']['picture'];
        } elseif ($_SESSION['user']['oauth_provider'] == 'linkpan') {
            if (!empty($_SESSION['user']['picture']) && $_SESSION['user']['picture'] != '') {
                return IMG_URL . 'profile-pic/' . $_SESSION['user']['picture'];
            } else {
                return IMG_URL . 'profile-pic/default.png';
            }
        } elseif ($_SESSION['user']['oauth_provider'] == 'google') {
            return $_SESSION['user']['picture'];
        } elseif ($_SESSION['user']['oauth_provider'] == 'linkedin') {
            return $_SESSION['user']['picture'];
        } else {
            return IMG_URL . 'profile-pic/default.png';
        }
    }

}

if (!function_exists('responseStrip')) {

    function responseStrip($responseStripe) {
        $pos = strpos($responseStripe, ":");
        $response = substr($responseStripe, $pos + 1);
        return json_decode($response, true);
    }

}

/*

 * ***********************************************************************************

 * VIDEO UPLOAD START

 * ***********************************************************************************

 */


if (!function_exists('singleVideoUpload')) {

    function singleVideoUpload($file_tag) {

        $file_ary = $_FILES[$file_tag];

        return videoUpload($file_ary);
    }

}

if (!function_exists('multiVideoUpload')) {

    function multiVideoUpload($file_tag) {

        //print_r($_FILES[$file_tag]);die;

        $file_ary = reArrayFiles($_FILES[$file_tag]);

        //print_r($file_ary);die;

        $output_array = array();

        foreach ($file_ary as $file) {

            array_push($output_array, videoUpload($file));
        }

        return $output_array;
    }

}



if (!function_exists('videoUpload')) {

    function videoUpload($file) {

        //If directory doesnot exists create it.

        $data = array();

        $output_dir = IMG_DIR;
        $output_subdir = $output_dir . "video/";

        if (isset($file)) {

            // print_r($file);die;

            $errors = array();

            $file_name = $file['name'];

            $file_size = $file['size'];

            $file_tmp = $file['tmp_name'];

            $file_type = $file['type'];

            //print_r($file_name) ;die;

            $file_epld = explode('.', $file_name);

            $file_ext_temp = end($file_epld);

            $file_ext = strtolower($file_ext_temp);

            $filename = '';

            $expensions = array(
                "WEBM", "webm",
                "MPG", "mpg",
                "MP2", "mp2",
                "MPEG", "mpeg",
                "MPE", "mpe",
                "MPV", "mpv",
                "OGG", "ogg",
                "MP4", "mp4",
                "M4P", "m4p",
                "M4V", "m4v",
                "AVI", "avi",
                "WMV", "wmv",
                "MOV", "mov",
                "QT", "qt",
                "FLV", "flv",
                "SWF", "swf"
            );
            //echo $file_ext;die;       
            if (in_array($file_ext, $expensions) === false) {

                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            if ($file_size > 104857600) {
                $errors[] = 'File size must be less than 100 MB';
            }
            if (empty($errors) == true) {

                $RandomNum = time() . date("-Ymd-hisa");

                $ImageName = str_replace(' ', '-', strtolower($file_name));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));

                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = 'uploads-' . rand(111, 999) . rand(11, 99) . '-' . $RandomNum . '.' . $ImageExt;

                $filepath_original = $output_subdir . $NewImageName;

//                $path_size = array(
//                    array('path' => $output_subdir1 . $NewImageName, 'size' => 500),
//                    array('path' => $output_subdir2 . $NewImageName, 'size' => 300),
//                    array('path' => $output_subdir3 . $NewImageName, 'size' => 100)
//                );
//                if (imageResizeLib($file_tmp, $filepath_original, $path_size)) {
                if (move_uploaded_file($file_tmp, "$filepath_original")) {
                    $data["video_name"] = $NewImageName;
                    $message = 'File uploaded successfully';
                    return array(true, $message, $data);
                    die;
                } else {
                    $message = "Invalid, File not correct";
                    return array(false, $message, $data);
                }
            } else {
                $message = implode(" , ", $errors);
                return array(false, $message, $data);
            }
        } else {
            $message = "Required resource is invalid";
            return array(false, $message, $data);
        }
        return array(false, "System error", $data);
    }

}


if (!function_exists('singleFileUpload')) {

    function singleFileUpload($file_tag) {

         $file_ary = $_FILES[$file_tag];

        return fileUpload($file_ary);       
    }

}

if (!function_exists('multiFileUpload')) {

    function multiFileUpload($file_tag) {

        //print_r($_FILES[$file_tag]);die;

        $file_ary = reArrayFiles($_FILES[$file_tag]);

        //print_r($file_ary);die;

        $output_array = array();

        foreach ($file_ary as $file) {

            array_push($output_array, fileUpload($file));
        }

        return $output_array;
    }

}
if (!function_exists('fileUpload')) {

    function fileUpload($file) {
        
        //If directory doesnot exists create it.

        $data = array();

        $output_dir = IMG_DIR;
        $output_subdir = $output_dir . "doc/";

        if (isset($file)) {

            // print_r($file);die;

            $errors = array();

            $file_name = $file['name'];

            $file_size = $file['size'];

            $file_tmp = $file['tmp_name'];

            $file_type = $file['type'];

            //print_r($file_name) ;die;

            $file_epld = explode('.', $file_name);

            $file_ext_temp = end($file_epld);

            $file_ext = strtolower($file_ext_temp);

            $filename = '';

            $expensions = array(
                "jpeg",
                "jpg",
                "png",
                "pdf",
                "xlsx",
                "doc",
                "docx",
                "txt"
            );
            //echo $file_ext;die;       
            if (in_array($file_ext, $expensions) === false) {

                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            if ($file_size > 104857600) {
                $errors[] = 'File size must be less than 100 MB';
            }
            if (empty($errors) == true) {

                $RandomNum = time() . date("-Ymd-hisa");

                $ImageName = str_replace(' ', '-', strtolower($file_name));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));

                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = 'uploads-' . rand(111, 999) . rand(11, 99) . '-' . $RandomNum . '.' . $ImageExt;

                $filepath_original = $output_subdir . $NewImageName;

//                $path_size = array(
//                    array('path' => $output_subdir1 . $NewImageName, 'size' => 500),
//                    array('path' => $output_subdir2 . $NewImageName, 'size' => 300),
//                    array('path' => $output_subdir3 . $NewImageName, 'size' => 100)
//                );
//                if (imageResizeLib($file_tmp, $filepath_original, $path_size)) {
                if (move_uploaded_file($file_tmp, "$filepath_original")) {
                    $data["file_name"] = $NewImageName;
                    $data['original_file_name']=$file_name;
                    $data["file_ext"] = $file_ext;
                    $message = 'File uploaded successfully';
                    return array(true, $message, $data);
                    die;
                } else {
                    $message = "Invalid, File not correct";
                    return array(false, $message, $data);
                }
            } else {
                $message = implode(" , ", $errors);
                return array(false, $message, $data);
            }
        } else {
            $message = "Required resource is invalid";
            return array(false, $message, $data);
        }
        return array(false, "System error", $data);
    }

}

/*

 * ***********************************************************************************

 * IMAGE UPLOAD START

 * ***********************************************************************************

 */


if (!function_exists('singleImageUpload')) {

    function singleImageUpload($file_tag) {

        $file_ary = $_FILES[$file_tag];

        return imageUpload($file_ary);
    }

}

if (!function_exists('multiImageUpload')) {

    function multiImageUpload($file_tag) {

        //  print_r($_FILES[$file_tag]);die;

        $file_ary = reArrayFiles($_FILES[$file_tag]);

//        print_r($file_ary);die;

        $output_array = array();
		$temp_remove_images = array();
		if(isset($_REQUEST['remove_images'])){
			$temp_remove_images = $_REQUEST['remove_images'];
		}

        foreach ($file_ary as $file) {

			$name = $file['name'];

			if(!in_array($name,$temp_remove_images)){
				array_push($output_array, imageUpload($file));
			}


        }

        return $output_array;
    }

}


if (!function_exists('reArrayFiles')) {

    function reArrayFiles(&$file_post) {

        // print_r($file_post['name']);die;

        $file_ary = array();

        $file_count = count($file_post['name']);

        $file_keys = array_keys($file_post);



        for ($i = 0; $i < $file_count; $i++) {

            foreach ($file_keys as $key) {

                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        //print_r($file_ary);die;

        return $file_ary;
    }

}

if (!function_exists('imageResizeLib')) {

    function imageResizeLib($file, $filepath_original, $path_size) {

        if ($file) {

            $image = new \Eventviva\ImageResize($file);

            $image->save($filepath_original);

            if ($path_size && !empty($path_size)) {

                foreach ($path_size as $ps) {

                    if (isset($ps['width']) && isset($ps['path'])) {

                        $image->resizeToBestFit($ps['width'], $ps['width'],true);

                        $image->save($ps['path']);
                    }
                }
                return true;
            }
        }

        return false;
    }
}
if (!function_exists('imageUpload')) {

    function imageUpload($file) {

        //If directory doesnot exists create it.

        $data = array();

        $output_dir = 'attachments/uploads/';

        $output_subdir = $output_dir . "original/";

        $output_subdir1 = $output_dir . "exlarge/";

        $output_subdir2 = $output_dir . "large/";

        $output_subdir3 = $output_dir . "medium/";

        $output_subdir4 = $output_dir . "thumb/";

        $output_subdir5 = $output_dir . "small/";

        $output_subdir6 = $output_dir . "exsmall/";

        if (isset($file)) {

            // print_r($file);die;

            $errors = array();

            $file_name = $file['name'];

            $file_size = $file['size'];

            $file_tmp = $file['tmp_name'];

            $file_type = $file['type'];

            //print_r($file_name) ;die;

            $file_epld = explode('.', $file_name);

            $file_ext_temp = end($file_epld);

            $file_ext = strtolower($file_ext_temp);

            $filename = '';

            $expensions = array(
                "jpeg",
                "jpg",
                "png",
                "gif"
            );

            //echo $file_ext;die;       

            if (in_array($file_ext, $expensions) === false) {

                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 10485760) {
                $errors[] = 'File size must be less than 10 MB';
            }
            if (empty($errors) == true) {

                $RandomNum = time() . date("-Ymd-hisa");

                $ImageName = str_replace(' ', '-', strtolower($file_name));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));

                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = 'uploads-' . rand(111, 999) . rand(11, 99) . '-' . $RandomNum . '.' . $ImageExt;

                $filepath_original = $output_subdir . $NewImageName;

                $path_size = array(
                    array('path' => $output_subdir1 . $NewImageName, 'width' => 500),
                    array('path' => $output_subdir2 . $NewImageName, 'width' => 450),
                    array('path' => $output_subdir3 . $NewImageName, 'width' => 350),
                    array('path' => $output_subdir4 . $NewImageName, 'width' => 250),
                    array('path' => $output_subdir5 . $NewImageName, 'width' => 200),
                    array('path' => $output_subdir6 . $NewImageName, 'width' => 150)                   
                );
                if (imageResizeLib($file_tmp, $filepath_original, $path_size)) {
                    // if(move_uploaded_file($file_tmp, "$output_dir/$NewImageName")){                                                            
                    $data["file_name"] = $NewImageName;
                    $data['original_file_name']=$file_name;
                    $data["file_ext"] = $file_ext;
                    $message = 'File uploaded successfully';                                        
                    return array(true, $message, $data);
                    die;
                } else {
                    $message = "Invalid, File not correct";
                    return array(false, $message, $data);
                }
            } else {
                $message = implode(" , ", $errors);
                return array(false, $message, $data);
            }
        } else {
            $message = "Required resource is invalid";
            return array(false, $message, $data);
        }
        return array(false, "System error", $data);
    }

}
if (!function_exists('time_elapsed_string')) {

    function time_elapsed_string($time) {

		$time = strtotime($time);

		$time = time() - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
		}
    }
}

if (!function_exists('shorter')) {

	function shorter($text, $chars_limit){
		// Check if length is larger than the character limit
		if (strlen($text) > $chars_limit)
		{
			// If so, cut the string at the character limit
			$new_text = substr($text, 0, $chars_limit);
			// Trim off white space
			$new_text = trim($new_text);
			// Add at end of text ...
			return $new_text . "...";
		}
		// If not just return the text as is
		else
		{
			return $text;
		}
	}

}


function notification_str($resAddProductNotification = array(), $resCommentNotification = array()) {
        $str = "";
        $result = array();
        if (!empty($resAddProductNotification)) {
            foreach ($resAddProductNotification as $aRow) {
                array_push($result, $aRow);
            }
        }
        if (!empty($resCommentNotification)) {
            foreach ($resCommentNotification as $aRow) {
                array_push($result, $aRow);
            }
        }
        $volume = array_column($result, 'all_notification_id');
        array_multisort($volume, SORT_DESC, $result);
        foreach ($result as $row) {            
            $oauth_provider = $row['oauth_provider'];
            $picture = $row['picture'];
            $profileimage = profileimageusers($oauth_provider, $picture);
            $username = $row['user_firstName'] . ' ' . $row['user_lastName'];            
            $datetime = unixTimestampToDayAgo($row['datetime']);                        
            if ($row['notification_type'] == 'new_product') { 
                $otheruser_link = OTHER_USER_PROFILE_LINK . $row['refUsers_id'];
                $product_link = UPDATE_PRODUCT_NOTIFICATION . $row['products_id'] . '/' . $row['products_type'];
                $str .= "<li class='un-read'>
                        <div class='author-thumb'>
                            <img src='" . $profileimage . "' alt='author' style='width:34px;height:34px;object-fit:cover'>
                        </div>
                        <div class='notification-event'>
                            <div><a href='" . $otheruser_link . "' class='h6 notification-friend'>" . $username . "</a> uploaded new product.</div>
                              
                            <span class='notification-date'><time class='entry-date updated'>" . $datetime . "</time></span>
                        </div>
                        <span class='notification-icon'>
                                <a href='" . $product_link . "'><i class='fa fa-eye'></i></a>
                        </span>
                        <div class='more'>                                  
                            <svg class='olymp-little-delete'><use xlink:href='" . ASSETS_FOLDER . "svg-icons/sprites/icons.svg#olymp-little-delete'></use></svg>
                        </div>
                    </li>";
            }
            if ($row['notification_type'] == 'post_comment') { 
                $otheruser_link = UPDATE_COMMENT_NOTIFICATION.$row['refPost_comment_id'].'/'.$row['refUser_id'];                
                $str .= "<li class='un-read'>
                        <div class='author-thumb'>
                            <img src='" . $profileimage . "' alt='author' style='width:34px;height:34px;object-fit:cover'>
                        </div>
                        <div class='notification-event'>
                            <div><a href='" . $otheruser_link . "' class='h6 notification-friend'>" . $username . "</a> commented on your post.</div>
                              
                            <span class='notification-date'><time class='entry-date updated'>" . $datetime . "</time></span>
                        </div>
                        <span class='notification-icon'>
                                <a href='" . $otheruser_link . "'><i class='fa fa-eye'></i></a>
                        </span>
                        <div class='more'>                                  
                            <svg class='olymp-little-delete'><use xlink:href='" . ASSETS_FOLDER . "svg-icons/sprites/icons.svg#olymp-little-delete'></use></svg>
                        </div>
                    </li>";
            }
        }
        return $str;
    }
?>
