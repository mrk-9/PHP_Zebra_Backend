<?php 
    function saveProfilesImage($base64)
        {
            $img = imagecreatefromstring(base64_decode($base64)); 
            if($img != false)
            { 
                $imageName = time().'.jpg';
                $path = $_SERVER['DOCUMENT_ROOT'];
                $path = IMAGE_DIRECTORY.'campaignImage/'.$imageName;
                if(imagejpeg($img,$path)) 
                    return $imageName;
                else
                    return '';
            }
    }
    
    function saveUserProfileImage($base64)
        {
            $img = imagecreatefromstring(base64_decode($base64)); 
            if($img != false)
            { 
                $imageName = time().'.jpg';
                $path = $_SERVER['DOCUMENT_ROOT'];
                $path = IMAGE_DIRECTORY.'profile/'.$imageName;
                if(imagejpeg($img,$path)) 
                    return $imageName;
                else
                    return '';
            }
    }
    
    function user_last_seen_format($request_time){
        $time_middle = new DateTime($request_time, new DateTimeZone(date_default_timezone_get()));
        $time_middle->setTimeZone(new DateTimeZone($_COOKIE['bl_timezone']));
        return $time_middle->format('Y-m-d H:i:s');
    }

    function generate_unique_code(){
        return substr(str_shuffle("1234567890"),'0','8');   
    }
   
   function generateServerResponse($msg_code, $res_msg, $data = null){
        
        $getDateTime = getDateAndIp();
        $array[APP_NAME] = array();
        $resultMsg = Messages($res_msg);
        $array[APP_NAME]["resCode"] = $msg_code;
        $array[APP_NAME]["resMsg"]  = $resultMsg;  
        
        if(!empty($data)){
            foreach($data as $key=>$val){
                $array[APP_NAME][$key]  = $val;
            }
        }
        $str = json_encode($array, true);
        echo str_replace("null",'""', $str);
        exit;
    }
    function getDateAndIp(){
        $result = array();  
        $result['ip'] = $_SERVER['REMOTE_ADDR'];
        $result['date'] = time();
        $result['datetime'] = date('Y-m-d h:i:s');
        return $result ; 
    }
    function validateJson($requestJson, $check_request_keys){
        
        if($requestJson){
            $validate_keys      = array();
            
            foreach($requestJson[APP_NAME] as $key=>$val){
                $validate_keys[] = $key;
            }
            
            $result = array_diff($validate_keys,$check_request_keys);

            if($result){ 
                return "0";
            }else{
                return  "1";
            } 
        }else{
            return  "0";
        }          
    }
    
    function validateEmail($email_a){
        if (!filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
            return 0;
        }
    }
    
    function isBlank($fieldName, $msgCode, $msgType){
        if($fieldName == ''){
            generateServerResponse($msgCode, $msgType);
        }
    }
    
    function checkLength($fieldName, $fieldLength,$msgCode, $msgType){
        $length =  strlen($fieldName);
        if($length > $fieldLength){
           generateServerResponse($msgCode, $msgType);
        }
    }
    
    function isPhone($fieldName, $msgCode, $msgType){
        if(!ctype_digit($fieldName)){
          generateServerResponse($msgCode, $msgType);
        } 
    }
    
    function isDobBlank($fieldName, $msgCode, $msgType){
        if($fieldName == '' || $fieldName == '0000-00-00'){
            generateServerResponse($msgCode, $msgType);
        }
    }
    function isDobFormat($fieldName, $msgCode, $msgType){
        if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$fieldName)){
            generateServerResponse($msgCode, $msgType);
        }
    }
    
    function isFutureDate($fieldName, $msgCode, $msgType){
        if($fieldName < mktime()){
            generateServerResponse($msgCode, $msgType);
        }
    }
    
    function phoneLength($fieldName, $msgCode, $msgType){
        if(strlen($fieldName) != 10){
             generateServerResponse($msgCode, $msgType);
        }
    }
    
    function phoneMinLength($fieldName, $msgCode, $msgType){
        if(strlen($fieldName) < 9){
             generateServerResponse($msgCode, $msgType);
        }
    }
    function phoneMaxLength($fieldName, $msgCode, $msgType){
        if(strlen($fieldName) >= 15){
             generateServerResponse($msgCode, $msgType);
        }
    }
    
    function Messages($res_msg){
        $codes = Array(
                    '100' => 'Input json is not valid.',
                    '101' => 'Json Used is not valid.',
                    '102' => 'Please enter your username.',
                    '103' => 'Username entered already exists.',
                    '104' => 'Please enter your email.',
                    '105' => 'Email entered is not valid.',
                    '106' => 'Email entered already exists.',
                    '107' => 'Please enter your password.',
                    '108' => 'Type can not be empty',
                    '109' => 'Address cannot be empty',
                    '110' => 'Email cannot be empty',
                    '111' => 'Category cannot be empty',
                    '112' => 'Subject cannot be empty',
                    '113' => 'Message cannot be empty',
                    '114' => 'category is blank',
                    '115' => 'Charity id cannot be empty',
                    '116' => 'Campaign Id cannot be empty',
                    '117' => '!Oops account already login other device.',
                    '118' => 'Invalid UUID',
                    '119' => 'Comment Text cannot be empty',
                    '120' => 'Name cannot be empty',
                    '121' => 'Phone number cannot be empty',
                    '122' => 'longitude cannot be empty',
                    '123' => 'City cannot be empty',
                    '125' => 'userId cannot be empty',
                    '126' => 'Image cannot be empty',
                    '127' => 'Invalid otp.',
                    '128' => 'Invalid Mobile number or Password',
                    '129' => 'Invalid login id.',
                    '130' => 'User already logged out.', 
                    '131' => 'Login id can not be empty.', 
                    '132' => 'Invalid credentials.', 
                    '133' => 'Device Id can not be empty.',
                    '134' => 'Mobile network id cannot be empty.',
                    '135' => 'Mobile number already registered.',
                    '136' => 'File can not be empty.',
                    '137' => 'Country id cannot be empty.',
                    '138' => 'Invalid mobile number',
                    '139' => 'Mobile network cannot be empty.',
                    '140' => 'Auth token can not be empty.',
                    '141' => 'Invalid user ID and device Id.',
                    '142' => 'Invalid old password',
                    '143' => 'Invalid user type',
                    '144' => 'Invalid user Id',
                    '145' => 'Invalid mobile number',
                    '146' => 'Invalid type value.',
                    '147' => 'User already registered',
                    '148' => 'User Id not found',                              
                    '149' => 'Successfully Logged In',
                    '150' => 'Login type cannot be empty',
                    'URL' => 'Invalid api request',
                    '201' => 'Successfully Logged Out',
                    'W'   => 'Something went wrong',
                    'Success'   => 'Success',
                    'otp'   => 'otp',
                    'Fail'   => 'Fail',
                    'E'   => 'Data Not Found',
                    '404' => '404'
                );

        return (isset($codes[$res_msg])) ? $codes[$res_msg] : '';        
    }

    function getRequestJson()
    {
        $request_data  = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : file_get_contents('php://input');
        
        return json_decode($request_data,true);
    }


    function get_coin_points($attempt){

        $coin = 0;

        switch ($attempt) {
            case '1':
                $coin = 5;
                break;
            
            default:
                $coin = 0;
            break;
        }

        return $coin;
    }

    function get_last_active($interval){

        if($interval->s):
            $return =$interval->s . " seconds ago";
        endif;

        if($interval->i):
            $return =$interval->i . " minutes ago";
        endif;

        if($interval->h):
            $return =$interval->h . " hours ago";
        endif;

        if($interval->d):
            $return =$interval->d . " days ago";
        endif;

        if($interval->m):
            $return =$interval->m . " months ago";
        endif;

        return $return;

    }
  function sendPushNotification($fcm_id  = false,$msg = false,$booking_id  = false,$type= false,$device_type=false) {
            $registrationIds = $fcm_id;
            if(!empty($booking_id) && !empty($type)  && !empty($device_type) ):
               $msg2 = array('booking_id'=> $booking_id,'message'=> $msg,'type' => $type,'title'=> $msg);
              # If device type equal two 1 that mean this is android notification otherwise iOS notification send
               if($device_type == 1){
                 $fields = array('to'=> $registrationIds,'data'=>$msg2);
               }else{
                 $fields = array('to'=> $registrationIds,'notification'=>$msg2);
               }
             
            endif;
            if(empty($type)):
               $msg2 = array('message'=> $msg,'title'=> $msg);
               $device_type = $booking_id;
                # If device type equal two 1 that mean this is android notification otherwise iOS notification send
               if($device_type == 1){
                 $fields = array('to'=> $registrationIds,'data'=>$msg2);
               }else{
                 $fields = array('to'=> $registrationIds,'notification'=>$msg2);
               }
            endif;
            /* echo json_encode( $msg ); exit;*/
            $headers = array ('Authorization: key='.API_ACCESS_KEYS,
                                'Content-Type: application/json');
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
                $result = curl_exec($ch );
            curl_close( $ch );
            return $result;
        }
