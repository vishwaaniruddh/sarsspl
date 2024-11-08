<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Firebase{

	function send_notification_to_all($message,$device_token,$title){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$curl_timeout = 60;
		$httpCode = '';
	
	//	$auth_key = 'AAAANAuYPxk:APA91bFcO8WzAqHgxadGlRNHNAUo2NVw98bnpdX3K2vB8ZSrams9twqVQGEAnRzqh5CejjRVv31ZijRmDxQCv01ggubN6BhlmV2_XW9dWJsPoQ7ROXK5ElkQ3--TWiJ5w-peGZtJ7NKj';
		$auth_key = 'AAAAE7P7SSs:APA91bHIX9Mk2BIxJx6NZ52LMEAynDJ0zfg9UebUxL97uF3gdYH05jw0OMH-guIfW82PdwIDFAkiCzNjfmjaXeXOU2-3Ri1-Bg4GQezU4DA9C016n4jNaYZOaZjSNZFbpDhfPkwJ8xWA';
		
	
	
		$headers = array(
			'Authorization: Key=' . $auth_key,
			'Content-Type: application/json'
		);
		
		$params = array(
 			
            'registration_ids'=>$device_token,
            'priority'=>'high',
			//'notification'=>array('title'=>'Captain India','body'=>$message,"mutable_content"=> true,"content_available" => true),
			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message)),
			'data' => array(
				'body' => strip_tags($message),
				"title" => "Captain India",
				
					"action"=>"no",
			//	 	"sound"=>'default',
				"sound"=>'notification_audio.wav',
			      //  'sound' => "https://captainindia.anekalabs.com/backend/uploads/file/notification_audio.wav",

			)
		);
	
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POSTFIELDS => json_encode($params),
			CURLOPT_TIMEOUT => $curl_timeout
		));
		$result = curl_exec($ch);
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		
		curl_close($ch);
		if ($httpCode == 200) {
			$res = json_decode($result);
			
			$message = array();
			$result = array();
			if (isset($res->message_id)) {
				$result['status'] = true;
				$message = $res->message_id;
			} else {
				$result['status'] = false;
				$message = $res->error;
			}
		} else if ($httpCode == 401) {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an error authenticating the sender account.';
		} else {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an internal error in the FCM connection server while trying to process the request, or that the server is temporarily unavailable.';
		}
		//echo "<pre>";print_r($result);echo "<pre>";print_r($error);exit;
		return $result;
	}
	
	function send_notification($message,$device_token,$title,$tracking = null, $action =null ){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$curl_timeout = 60;
		$httpCode = '';
	
	//	$auth_key = 'AAAANAuYPxk:APA91bFcO8WzAqHgxadGlRNHNAUo2NVw98bnpdX3K2vB8ZSrams9twqVQGEAnRzqh5CejjRVv31ZijRmDxQCv01ggubN6BhlmV2_XW9dWJsPoQ7ROXK5ElkQ3--TWiJ5w-peGZtJ7NKj';
			$auth_key = 'AAAAE7P7SSs:APA91bHIX9Mk2BIxJx6NZ52LMEAynDJ0zfg9UebUxL97uF3gdYH05jw0OMH-guIfW82PdwIDFAkiCzNjfmjaXeXOU2-3Ri1-Bg4GQezU4DA9C016n4jNaYZOaZjSNZFbpDhfPkwJ8xWA';
	
		    
		$headers = array(
			'Authorization: Key=' . $auth_key,
			'Content-Type: application/json'
		);
		$fcmMsg = array(
			'body' => $message,
			'title' => $title,
// 			'sound' => "default",
		//	'sound' => "https://captainindia.anekalabs.com/backend/uploads/file/notification_audio.wav",
			"sound"=>'notification_audio.wav',
		    'color' => "#203E78" 
		);
		$fcmFields = array(
			'to' => $device_token,
		    'priority' => 'high',
			'notification' => $fcmMsg
		);
		//print_r($fcmFields);
		$params = array(
			'to' => $device_token,
			'priority'=>'high',
			'notification' => array(
			 	'body' => 'hgjh',
			 	'title' => 'hgjh',
			),
			'data' => array(
			    'title' => 'hgjh1',
			 	'body' => 'hgjh1'
			)
		);
		
		if($action !=null) {
		    $action = $action;
		} else {
		    $action = "track"; 
		}
		
		if($tracking != null) {
		    $params = array(
            'registration_ids'=>[$device_token],
            //'to'=>$device_token,
            'priority'=>'high',
			//'notification'=>array('title'=>'Captain India','body'=>$message,"mutable_content"=> true,"content_available" => true),
// 			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message),"sound"=>"default"),
			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message),"sound"=>"notification_audio.wav"),
			'data' => array(
				'body' => strip_tags($message),
				"title" => $title,
				// "action"=>"track",
				"action"=> $action,
			//	"sound"=>"default",
			 	"sound"=>'notification_audio.wav',
				"tracking"=>$tracking,
			)
		);
		} else {
		
		$params = array(
            'registration_ids'=>[$device_token],
            //'to'=>$device_token,
            'priority'=>'high',
			//'notification'=>array('title'=>'Captain India','body'=>$message,"mutable_content"=> true,"content_available" => true),
// 			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message),"sound"=>"default"),
			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message),"sound"=>"notification_audio.wav"),
			'data' => array(
				'body' => strip_tags($message),
				"title" => $title,
				"action"=>"show",
			//	"sound"=>"default",
				"sound"=>'notification_audio.wav',
				
			)
		);
		}
		//echo "<pre>";print_r($params);
		$new_params = array('message'=>array('token' => $device_token,'notification'=>array('title'=>$title,'body'=>$message)));
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POSTFIELDS => json_encode($params),
			CURLOPT_TIMEOUT => $curl_timeout
		));
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
	//	echo "<pre>";print_r($result);echo "<pre>";print_r($error);exit;
		curl_close($ch);
		if ($httpCode == 200) {
			$res = json_decode($result);
			
			$message = array();
			$result = array();
			if (isset($res->results['0']->message_id)) {
				$result['status'] = true;
				$message = $res->results['0']->message_id;
			} else {
				$result['status'] = false;
				$message = $res->results['0']->error;
			}
		} else if ($httpCode == 401) {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an error authenticating the sender account.';
		} else {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an internal error in the FCM connection server while trying to process the request, or that the server is temporarily unavailable.';
		}
		return $result;
	}

	function send_notification_to_all_message($message,$device_token,$title){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$curl_timeout = 60;
		$httpCode = '';

	//	$auth_key = 'AAAANAuYPxk:APA91bFcO8WzAqHgxadGlRNHNAUo2NVw98bnpdX3K2vB8ZSrams9twqVQGEAnRzqh5CejjRVv31ZijRmDxQCv01ggubN6BhlmV2_XW9dWJsPoQ7ROXK5ElkQ3--TWiJ5w-peGZtJ7NKj';
		$auth_key = 'AAAAE7P7SSs:APA91bHIX9Mk2BIxJx6NZ52LMEAynDJ0zfg9UebUxL97uF3gdYH05jw0OMH-guIfW82PdwIDFAkiCzNjfmjaXeXOU2-3Ri1-Bg4GQezU4DA9C016n4jNaYZOaZjSNZFbpDhfPkwJ8xWA';
		$headers = array(
			'Authorization: Key=' . $auth_key,
			'Content-Type: application/json'
		);
		$params = array(
            'registration_ids'=>$device_token,
            'priority'=>'high',
			//'notification'=>array('title'=>'Captain India','body'=>$message,"mutable_content"=> true,"content_available" => true),
			//'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message)),
			'notification' => array(
			    'title'=>strip_tags($title),
			    'body'=>strip_tags($message),
    		  //  "mutable_content"=> true,
    		  //  "content_available" => true
    		 //  "sound"=>'default'
    		 	"sound"=>'notification_audio.wav',
		    ),
			'data' => array(
				'body'=>strip_tags($message),
				"title"=>strip_tags($title),
				"action"=>"show",
			  //  "sound"=>'default'
			  	"sound"=>'notification_audio.wav',
			)
		);
		/*
		$params = array(
            'registration_ids'=>$device_token,
            'priority'=>'high',
			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message)),
			'data' => array(
				'body' => strip_tags($message),
				"title" => "Captain India"
			)
		);*/

		$ch = curl_init($url);
		curl_setopt_array($ch, array(
            CURLOPT_URL=>$url,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POSTFIELDS => json_encode($params),
			CURLOPT_TIMEOUT => $curl_timeout
		));
		$result = curl_exec($ch);
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		curl_close($ch);
		
// 		echo "<pre>";
// 		print_R($httpCode);
// 		print_R($result);
// 		print_R(json_decode($result));
		
		if ($httpCode == 200) {
			$res = json_decode($result);
			$message = array();
			$result = array();
			if (isset($res->message_id)) {
				$result['status'] = true;
				$message = $res->message_id;
			} else {
				$result['status'] = false;
				$message = $res->error;
			}
		} else if ($httpCode == 401) {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an error authenticating the sender account.';
		} else {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an internal error in the FCM connection server while trying to process the request, or that the server is temporarily unavailable.';
		}
		//echo "<pre>";print_r($result);echo "<pre>";print_r($error);exit;
		return $result;
	}
	
    function send_bulletin_news_notification_to_all($message,$device_token,$title,$image_path){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$curl_timeout = 60;
		$httpCode = '';

	//	$auth_key = 'AAAANAuYPxk:APA91bFcO8WzAqHgxadGlRNHNAUo2NVw98bnpdX3K2vB8ZSrams9twqVQGEAnRzqh5CejjRVv31ZijRmDxQCv01ggubN6BhlmV2_XW9dWJsPoQ7ROXK5ElkQ3--TWiJ5w-peGZtJ7NKj';
		$auth_key = 'AAAAE7P7SSs:APA91bHIX9Mk2BIxJx6NZ52LMEAynDJ0zfg9UebUxL97uF3gdYH05jw0OMH-guIfW82PdwIDFAkiCzNjfmjaXeXOU2-3Ri1-Bg4GQezU4DA9C016n4jNaYZOaZjSNZFbpDhfPkwJ8xWA';
		$headers = array(
			'Authorization: Key=' . $auth_key,
			'Content-Type: application/json'
		);
		$params = array(
            'registration_ids'=>$device_token,
            'priority'=>'high',
			//'notification'=>array('title'=>'Captain India','body'=>$message,"mutable_content"=> true,"content_available" => true),
			'notification'=>array('title'=>strip_tags($title),'body'=>strip_tags($message)),
			'data' => array(
				'body' => $message,
				"title" => $title,
				"bulletin"=>"bulletin",
				"image"=>$image_path,
				"mutable-content"=>"1",
			    "sound"=>'notification_audio.wav',
			)
		);
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POSTFIELDS => json_encode($params),
			CURLOPT_TIMEOUT => $curl_timeout
		));
		$result = curl_exec($ch);
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		
		curl_close($ch);
		if ($httpCode == 200) {
			$res = json_decode($result);
			$message = array();
			$result = array();
			if (isset($res->message_id)) {
				$result['status'] = true;
				$message = $res->message_id;
			} else {
				$result['status'] = false;
				$message = $res->error;
			}
		} else if ($httpCode == 401) {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an error authenticating the sender account.';
		} else {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an internal error in the FCM connection server while trying to process the request, or that the server is temporarily unavailable.';
		}
		//echo "<pre>";print_r($result);echo "<pre>";print_r($error);exit;
		return $result;
	}

	function sendNotify($message,$device_token,$title){
		$url = 'https://fcm.googleapis.com/fcm/send';
		$curl_timeout = 60;
		$httpCode = '';

	//	$auth_key = 'AAAANAuYPxk:APA91bFcO8WzAqHgxadGlRNHNAUo2NVw98bnpdX3K2vB8ZSrams9twqVQGEAnRzqh5CejjRVv31ZijRmDxQCv01ggubN6BhlmV2_XW9dWJsPoQ7ROXK5ElkQ3--TWiJ5w-peGZtJ7NKj';
		$auth_key = 'AAAAE7P7SSs:APA91bHIX9Mk2BIxJx6NZ52LMEAynDJ0zfg9UebUxL97uF3gdYH05jw0OMH-guIfW82PdwIDFAkiCzNjfmjaXeXOU2-3Ri1-Bg4GQezU4DA9C016n4jNaYZOaZjSNZFbpDhfPkwJ8xWA';
		$headers = array(
			'Authorization: Key=' . $auth_key,
			'Content-Type: application/json'
		);
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=$device_token;

        $notification = [
            'title' =>'title',
            'body' => 'body of message.',
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        // $headers = [
        //     'Authorization: key=' . $auth_key,
        //     'Content-Type: application/json'
        // ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      //  curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      //  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		// curl_setopt($ch, CURLOPT_POSTREDIR, 3);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        
		$result = curl_exec($ch);
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		
		curl_close($ch);
		if ($httpCode == 200) {
			$res = json_decode($result);
			$message = array();
			$result = array();
			if (isset($res->message_id)) {
				$result['status'] = true;
				$message = $res->message_id;
			} else {
				$result['status'] = false;
				$message = $res->error;
			}
		} else if ($httpCode == 401) {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an error authenticating the sender account.';
		} else {
			$result = array();
			$result['status'] = false;
			$result['message'] = 'There was an internal error in the FCM connection server while trying to process the request, or that the server is temporarily unavailable.';
			$result['ch'] = $httpCode;
			$result['err'] = $error;
		}
		//echo "<pre>";print_r($result);echo "<pre>";print_r($error);exit;
		return $result;
	}
	

}