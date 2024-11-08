<?php 

class Api_model extends CI_Model {

    public function _consruct() {
        parent::_construct();
        $model = Mage::getModel(form / form)->setData($data);
    }

    function get_table_wheres($select_data, $where_data, $table) {

        $this->db->select($select_data);
        $this->db->where($where_data);

        $query = $this->db->get($table);
        //--- Table name = User
        $result = $query->row_array();

        return $result;
    }

    function getErrorCode($id) {

        $select_data = "*";
        $table = "error_codes";
        $this->db->select($select_data);
        $this->db->where('id', $id);

        $query = $this->db->get($table);  //--- Table name = User
        $result = $query->result();
        //echo "<pre>".count($result);print_r($result[0]);exit;
        if (count($result) > 0) { // user credential is success
            return $result[0];
        } else {
            return false;
        }
    }

    function check_login($request) {

        $select_data = "*";
        $table = "users";

        //$this->db->select($select_data);
        $this->db->where('mobile_no', $request['mobile_number']);
        //	$this->db->where('sap_code',  $request['sap_id']);
        $this->db->where('user_type', '3');
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get($table);  //--- Table name = User
        $result = $query->result();
        //echo "<pre>".count($result);print_r($result[0]);exit;
        if (count($result) > 0) { // user credential is success
            $where_data = array(// ----------------Array for check data exist ot not
                'id' => $result[0]->id,
                'time' => date('Y-m-d h:i:s')
            );

            $auth_key = AUTHORIZATION::generateToken($where_data);
            $this->db->where('id', $result[0]->id);
            $this->db->update('users', array('device_token' => $request['device_token'], 'active_platform' => $request['active_platform'], 'auth_key' => $auth_key));

            $this->db->select($select_data);
            $this->db->where('mobile_no', $request['mobile_number']);
            //	$this->db->where('sap_code',  $request['sap_id']);
            $this->db->where('user_type', '3');

            $query = $this->db->get($table);  //--- Table name = User
            $result = $query->result();
            $result[0]->location_info = $this->db->get_where('user_locations', array('branch_code' => $result[0]->branch_name))->row();
            return $result[0];
        } else {

            return false;
        }
    }

    function sendOTP($request) {
//        error_reporting(E_ALL);
//          ini_set('display_errors', '1');
                date_default_timezone_set('Asia/Kolkata');

        $mobile_no = $request['mobile_number'];

        $select_data = "*";
        $table = "users";
        $this->db->select($select_data);
        $this->db->where('mobile_no', $request['mobile_number']);
        $this->db->where('user_type', '3');
        $this->db->where('is_deleted', '0');
        //	$this->db->where('password',  md5($request['password']));
        // 7-may-2022
        //$this->db->order_by('users.id','desc');
        //$this->db->order_by('users.bulk_update_on','desc');


        $query = $this->db->get($table);  //--- Table name = User
        $result = $query->result();

        // echo $this->db->last_query();exit;
        //	if(count($result) > 0){ // user credential is success
         if (isset($result[0] )) {
        if ($result[0]->id) {
            $id = $result[0]->id;

            // START - 6-aug-2022 // change auth_key // modify 27-sep-2022
            $where_data = array(
                'id' => $id,
                'time' => date('Y-m-d h:i:s')
            );
            $token = AUTHORIZATION::generateToken($where_data);
            //update Acess Token
            $this->db->where('id', $id);
            $this->db->update('users', array('auth_key' => $token));

            // END - 6-aug-2022 
        } else {
            $id = 0;
        }
        } else {
            $id = 0;
        }
        $name = $result[0]->first_name . '' . $result[0]->last_name;
        //echo $name;exit;
        // added on 15-9-2021
        if ($request['mobile_number'] == '9999999995') {
            $otp = '5555';
            $ref = 'l8CbJcDPqs';
        } else {
            
            // 16-10-2023
            $minutes_date = date("Y-m-d H:i:s", strtotime("-30 minutes"));
            $select_data = "*";
            $table = "user_otp";
            $this->db->select($select_data);
            $this->db->where('mobile_no', $request['mobile_number']);
            $this->db->where('user_otp.created_on >=', $minutes_date);
            $query = $this->db->get($table);
            $created_result = $query->result();
            $created_result_count= count($created_result);
            // print_r($created_result);
            // print_r($created_result_count);
            if ($created_result_count < 3) {

            $otp = rand(1000, 9999);
            $ref = random_string('alnum', 10);
            $data = array('user_id' => $id, 'otp' => $otp, 'mobile_no' => $request['mobile_number'], 'ref_no' => $ref, 'purpose' => $request['purpose'], 'active_platform' => $request['active_platform']);

            //7-jun-2022
            date_default_timezone_set('Asia/Kolkata');
            $data['created_on'] = date('Y-m-d H:i:s');
            $this->db->insert('user_otp', $data);
        } else {

                // Maximum limit reached try after 30 min
                $output = false;
                return array('status'=>$output, 'err' => 'ER116');
            }
        }
        $request = ""; //initialise the request variable
        // msg
            /*
            $param[method]= "sendMessage";
            $param[send_to] = "91".$mobile_no;
            $param[msg] = $otp."%20is%20your%20One%20Time%20Password%20%28OTP%29%20for%20CAPTAININDIA%20App%20login–Captain India.";
            $param[msg_type] = "TEXT";
            $param[userid] = "2000148588";
            $param[auth_scheme] = "PLAIN";
            $param[password] = "Msg@2219";
            $param[v] = "1.1";
            //$param[msg_id] = 846187;
            $param[format] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
             //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
            
            //Have to URL encode the values
            foreach($param as $key=>$val) {
            $request.= $key."=".$val;
            //we have to urlencode the values
            $request.= "&";
            //append the ampersand (&) sign after each
            //parameter/value pair
            }
            $request = substr($request, 0, strlen($request)-1);
            //echo $request;exit;
            //remove final (&) sign from the request
            //$url ="http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
            $url ="http://panel.sms4g.com/api/sendhttp.php?".$request;
            //echo $url;
            
            
          //Your authentication key
//$authKey = "hAYTOIglj3cVuDoL";

//Multiple mobiles numbers separated by comma
//$mobileNumber = "91".$mobile_no;
$mobileNumber = $mobile_no;

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "Captain India";

//Your message to send, Add URL encoding here.
//$message = $otp."%20is%20your%20One%20Time%20Password%20%28OTP%29%20for%20CAPTAININDIA%20App%20login. – Captain India";
  $message_content=$otp." is your One Time Password (OTP) for CAPTAININDIA App login - Captain India";
//Define route 
$route = "4";
//Prepare you post parameters
$postData = array(
    'apikey' => $authKey,
    'senderid'  => $senderId,
    'templateid' => 1007067340252390682,
    'number' => $mobileNumber,
    'message' => $message_content
);
// $postData = array(
//     'authkey' => $authKey,
//     'mobiles' => $mobileNumber,
//     'message' => $message,
//     'sender'  => $senderId,
//     'route'   => $route,
//     'country' => '91',
//     'unicode' => '1'
// );

//API URL
//$url="http://panel.sms4g.com/api/sendhttp.php";
$url="https://www.hellotext.live/vb/apikey.php";
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

//Print error if any
if(curl_errno($ch))
{
   // echo 'error:' . curl_error($ch);
}

curl_close($ch);

//echo $output;
*/
        $output = true;
       

        //22-jul-2022
        if ($otp) {
//            $this->userWhatsappOtpMessages($mobile_no, $otp);
//              echo __LINE__;//die;
//            $this->sendOtpMessage($mobile_no, $otp);
            $this->callSendOtpMessage($mobile_no, $otp);
//              echo __LINE__;//die;
        }
        //return  array('user_id' =>$id,'otp_ref_no'=>$ref,'otp'=>$otp);			
        return array('otp_ref_no' => $ref
                //,
                //'otp' => $otp,
                //'post_data'=>$postData,
                // "op" => $output
        );
// 		}else{
// 			return false;
// 		}
    }

    function getEmergencyContacts($request) {

// 		$select_data = "*";

        $select_data = "ec.*,users.first_name, users.first_name, users.last_name, users.email, users.mobile_no, device_token ";

        $table = "emergency_contacts as ec";
        $this->db->select($select_data);
        $this->db->from($table);
        $this->db->join('users', 'users.id = ec.emergency_user_id', 'left');
        $this->db->where('ec.user_id', $request['user_id']);
        $this->db->where('ec.is_deleted', '0');
        $query = $this->db->get();  //--- Table name = User

        $result = $query->result();
//	 echo $this->db->last_query();exit;
        if (count($result) > 0) { // user credential is success
            return $result;
        } else {
            return false;
        }
    }

    function setTracking($data) {

        unset($data['app_security_key']);
        unset($data['auth_key']);

        //7-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        $data['start_time'] = date('Y-m-d H:i:s');

        $this->db->insert('tracking', $data);
        return $this->db->insert_id();
    }

    function createPanicRequest($data) {

        unset($data['app_security_key']);
        unset($data['auth_key']);

        //7-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        $data['timestamp'] = date('Y-m-d H:i:s');

        $this->db->insert('panic_request', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function sendMessage($msg, $loc, $url) {
        $content = array(
            "en" => $msg
        );
        $headings = array(
            "en" => "Captain India",
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Location",
            "icon" => "http://captainindia.anekalabs.com/img/map.png",
            "url" => $loc
        ));
        $fields = array(
            'app_id' => "8ad390eb-06a8-4c5b-857a-be72e9e8f1f7",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'headings' => $headings,
            'contents' => $content,
            "url" => $url,
            'web_buttons' => $hashes_array
        );

        $fields = json_encode($fields);
        // print("\nJSON sent:\n");
        // print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            // 'Authorization: Basic ZjNkY2M5YjktOTllNC00ZTdkLWFlY2MtYzAxYTdmMGY4MGFl'
            'Authorization: Basic MjI3YmI3NTEtOWRjNy00OWIwLWEyZTItNTNmZDc1NmRjMzNk' // uat
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function getNotifications($datas, $user_id) {
        //4-aug-2022
        $tenant_id = 1;
        $this->db->where('user_type', '3');
        $this->db->where('status', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('id', $user_id);
        $query_users = $this->db->get('users');
        $result_users = $query_users->row();
        if ($result_users) {
            $tenant_id = $result_users->tenant_id;
        }
        // print_r($tenant_id);die;

        $select_data = "n.*";
        $table = "notifications as n";
        $this->db->select($select_data);
        $this->db->where('is_deleted', '0');
        $this->db->from($table);

        //4-aug-2022
        $this->db->where('n.tenant_id', $tenant_id);

        $this->db->where('n.type', '1');
        $this->db->group_by('n.id');

        $query = $this->db->get();  //--- Table name = User
        $result = $query->result();

        if (count($result) > 0) { // user credential is success
            foreach ($result as $k => $v) {
                $result[$k]->message = strip_tags($result[$k]->message);
            }
            return $result;
        } else {
            return array();
        }
    }

    function updateTracking($data) {
        //7-jun-2022
        date_default_timezone_set('Asia/Kolkata');

        unset($data['app_security_key']);
        unset($data['auth_key']);
        if ($data['mode'] == "") {
            $data_mode = null;
        }
        $this->db->where('id', $data['tracking_id']);
        $this->db->update('tracking', array('status' => $data['status'], 'end_time' => date('Y-m-d H:i:s'), 'mode' => $data_mode));
        return $this->db->affected_rows();
    }

    function updateTrackingMultiple($data) {
        date_default_timezone_set('Asia/Kolkata');

        unset($data['app_security_key']);
        unset($data['auth_key']);
        if ($data['mode'] == "") {
            $data_mode = null;
        }
        $this->db->where('firebase_key', "Tracking_id_" . $data['tracking_id']);
        $this->db->update('tracking', array('status' => $data['status'], 'end_time' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }

    function updateDeviceToken($data) {

        // unset($data['app_security_key']);
        if ($data['device_token'] && $data['user_id']) {
            $this->db->where('id', $data['user_id']);
            $this->db->update('users', array('device_token' => $data['device_token']));
            return 1;
        } else {
            return 0;
        }
    }

    function getTracking($data) {

        $select_data = "*,t.firebase_key as keyy,t.mode, users.profile_image";
        $table = "tracking as t";
        $this->db->select($select_data);
        $this->db->from($table);
        //	$this->db->join('users','users.id = t.tracker_id','left');
        $this->db->join('users', 'users.id = t.trackee_id', 'left');
        $this->db->where('t.tracking_type', '1');
        $this->db->where('t.status', '1');

        $this->db->group_start();
        $this->db->where('t.trackee_id', $data['user_id']);
        $this->db->or_where('t.tracker_id', $data['user_id']);
        $this->db->group_end();
        //$this->db->where('t.end_time', '0000-00-00 00:00:00');

        $query = $this->db->get();  //--- Table name = User
        //  echo $this->db->last_query();exit;
        $result = $query->result();

        if (count($result) > 0) { // user credential is success
            return $result;
        } else {
            return false;
        }
    }

    function getPreTriggerTracking($data) {

        $select_data = "*,t.firebase_key as keyy, t.mode";
        $table = "tracking as t";
        $this->db->select($select_data);
        $this->db->from($table);
        $this->db->join('users', 'users.id = t.tracker_id', 'left');
        $this->db->where('t.tracking_type', '2');
        $this->db->where('t.status', '1');
        $this->db->group_start();
        $this->db->where('t.trackee_id', $data['user_id']);
        $this->db->or_where('t.tracker_id', $data['user_id']);
        $this->db->group_end();
        //$this->db->where('t.end_time', '0000-00-00 00:00:00');

        $query = $this->db->get();  //--- Table name = User
        // echo $this->db->last_query();exit;
        $result = $query->result();

        if (count($result) > 0) { // user credential is success
            return $result;
        } else {
            return false;
        }
    }

    function verifyOTP($request) {
        date_default_timezone_set('Asia/Kolkata');

        // added on 15-9-2021
        // START - hard code for play store
        if ($request['otp_ref_no'] == 'l8CbJcDPqs' && $request['otp'] == '5555') {
            $select_data = "*";
            $table = "users";
            $this->db->select($select_data);
            $this->db->where('id', 220);
            $query = $this->db->get($table); //echo $this->db->last_query();//exit; //--- Table name = User
            $result = $query->result();

            $tenant_licence_id = $result[0]->tenant_licence_id;

            $tenant_licence = '0';
            if ($tenant_licence_id != null) {
                $tenant_licence = '1';
            }

            $output = array('user_id' => $result[0]->id, 'auth_key' => $result[0]->auth_key, 'Licence' => $tenant_licence);
            //print_r( $output);die;	
            return $output;
            // return true;
            // STOP - hard code for play store
        } else {
            $select_data = "*";
            $table = "user_otp";
            $this->db->select($select_data);
            $this->db->join('users', 'users.id = user_otp.user_id', 'left');
            $this->db->where('ref_no', $request['otp_ref_no']);

            $this->db->where('otp', $request['otp']);
            //	$this->db->where('users.auth_key', $request['auth_key']);
            $this->db->where('user_type', '3');
            $this->db->where('email !=', '');
            $this->db->where('is_deleted', '0');
            //$this->db->where('status', '1');
            //	$this->db->or_where('email !=','');
            //	$this->db->where('password',  md5($request['password']));
            $query = $this->db->get($table);  //--- Table name = User
            $result = $query->result();

//	echo "<pre>".count($result);print_r($result[0]);exit;
            if (count($result) > 0) { // user credential is success
                $otp = $result[0]->otp;
                if ($otp == $request['otp']) {

                    $tenant_licence_id = $result[0]->tenant_licence_id;
                    $res_user_id = $result[0]->user_id;
                    $tenant_licence = '0';
                    if ($tenant_licence_id != null) {
                        $tenant_licence = '1';
                    }


                    //   // START - 6-aug-2022 // change auth_key
                    //  	$res_user_id = $result[0]->user_id;
                    // $where_data = array(
                    // 	'id' =>  $res_user_id
                    // );
                    // $token = AUTHORIZATION::generateToken($where_data);
                    // //update Acess Token
                    // $this->db->where('id',$res_user_id);
                    // $this->db->update('users',array('auth_key'=>$token));
                    // // END - 6-aug-2022 
                    // 12-jul-2022
                    $this->addUserPlan($result[0]->user_id);

                    // 10-dec-2021
                    // check otp
                    //if( $request['user_id11']==1101) {
                    $date1 = $result[0]->created_on;
                    $date2 = date('Y-m-d H:i:s');
                    $diff = abs(strtotime($date2) - strtotime($date1));
                    $date = new DateTime($date1);
                    $date2 = new DateTime($date2);
                    $diff = $date2->getTimestamp() - $date->getTimestamp();
                    //}

                    if ($diff <= 180) { // 3 min (in second) // otp expired
                        $output = array('status' => true, 'user_id' => $result[0]->user_id, 'auth_key' => $result[0]->auth_key, 'Licence' => $tenant_licence);
                        return $output;
                    } else {
                        $output = array('status' => false, 'user_id' => '0', 'auth_key' => '0', 'Licence' => $tenant_licence);
                        return $output;
                    }

                    //   $output= array('user_id'=>$result[0]->user_id,'auth_key'=>$result[0]->auth_key);
                    // return $output;
                } else {
                    return false;
                }
            } else {
                $output = array('user_id' => '0', 'auth_key' => '0', 'Licence' => '0');
                return false;
            }
        }
    }

    function checkIsActive($request) {

        $select_data = "*";
        $table = "user_otp";
        $this->db->select($select_data);
        $this->db->join('users', 'users.id = user_otp.user_id', 'left');
        $this->db->where('ref_no', $request['otp_ref_no']);

        $this->db->where('otp', $request['otp']);
        //	$this->db->where('users.auth_key', $request['auth_key']);
        $this->db->where('user_type', '3');
        $this->db->where('email !=', '');
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        //	$this->db->or_where('email !=','');
        //	$this->db->where('password',  md5($request['password']));
        $query = $this->db->get($table); //echo $this->db->last_query();exit; //--- Table name = User
        $result = $query->result();
//	echo "<pre>".count($result);print_r($result[0]);exit;
        if (count($result) > 0) { // user credential is success
            $otp = $result[0]->otp;
            if ($otp == $request['otp']) {
                $output = array('user_id' => $result[0]->user_id, 'auth_key' => $result[0]->auth_key);
                return $output;
            } else {
                return false;
            }
        } else {
            $output = array('user_id' => '0', 'auth_key' => '0');
            return false;
        }
    }

    function verifyUser($request) {
//echo "<pre>";print_r($request);exit;
        $table = "users";

        $this->db->where('id', $request['user_id']);
        //$this->db->where('users.auth_key', $request['auth_key']);
        $query = $this->db->get($table);  //--- Table name = User
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) { // user credential is success
            return true;
        } else {
            return false;
        }
    }

    function is_mobile_exists($mobile) {
        /* function return
          ---------------------------------
          'true'   if user exist
          'false'  if user does not exist

         */

        $select_data = "*";

        $where_data = array(// ----------------Array for check data exist ot not
            'mob' => $mobile
        );

        $table = "user";  //------------ Select table
        $result = $this->get_table_where($select_data, $where_data, $table);

        if (count($result) > 0) { // check if user exist or not
            return true;
        }

        return false;
    }

    function is_username_exists($username) {
        /* function return
          ---------------------------------
          'true'   if user exist
          'false'  if user does not exist

         */

        $select_data = "*";

        $where_data = array(// ----------------Array for check data exist ot not
            'username' => $username
        );

        $table = "user";  //------------ Select table
        $result = $this->get_table_where($select_data, $where_data, $table);

        if (count($result) > 0) { // check if user exist or not
            return true;
        }

        return false;
    }

    function registration($request) {

        $uinfo = $this->db->get_where('users', array('mobile_no' => $request['mobile_no'], 'is_deleted' => '0'))->row()->id;
        // print_r($uinfo);die;
        if (!$uinfo) {
            $tenant_licence_id = null;
            if (isset($request['licence_key'])) {
                $this->db->select("*");
                $this->db->where('is_use', '0');
                $this->db->where('is_deleted', '0');
                $this->db->where('tenant_licence.start_date <=', date('Y-m-d'));
                $this->db->where('tenant_licence.licence_key', $licence_key);
                $query_tenant_licence = $this->db->get('tenant_licence')->row();
                //echo $this->db->last_query();
                if ($query) {
                    //	return $query;
                    $tenant_licence_id = $query_tenant_licence->id;
                } else {
                    //return false;
                    $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                    print json_encode($result);
                }
            }

            $table = 'users';
            if (preg_match('/\s/', $request['first_name'])) {

                $arr = explode(' ', $request['first_name']);
                $request['first_name'] = $arr['0'];
                $request['last_name'] = $arr['1'];
            }

            $request['password'] = md5($request['password']);
            $emergency_contacts = $request['emergency_contacts'];
            //////////////
            $critical_illness_id = $request['critical_illness_id'];
            $critical_illness_name = $request['critical_illness_name'];

            unset($request['critical_illness_id']);
            unset($request['critical_illness_name']);
            unset($request['app_security_key']);
            unset($request['emergency_contacts']);

            // START - 9-may-2022
            $request['tenant_id'] = 1;
            $request['from_bulk'] = 1;
            // END - 9-may-2022
            // START - 7-jun-2022
            date_default_timezone_set('Asia/Kolkata');
            $request['created_at'] = date('Y-m-d H:i:s');
            $request['modified_at'] = date('Y-m-d H:i:s');

            //19-sep-2022
            $request['email'] = isset($request['email']) ? trim($request['email']) : null;

            //22-jul-2022
            // city key value added for address for api
            // $request['address'] = isset($request['address']) ? $request['address'] : null;
            $request['address'] = isset($request['city']) ? $request['city'] : null;
            $request['city'] = isset($request['city']) ? $request['city'] : null;
            $request['state'] = isset($request['state']) ? $request['state'] : null;
            $request['pincode'] = isset($request['pincode']) ? $request['pincode'] : null;
            $request['govt_id_image_url'] = isset($request['govt_id_image_url']) ? $request['govt_id_image_url'] : null;
            $request['govt_id_number'] = isset($request['govt_id_number']) ? $request['govt_id_number'] : null;
            $request['govt_id_type'] = isset($request['govt_id_type']) ? $request['govt_id_type'] : null;

            $request['last_name'] = isset($request['last_name']) ? $request['last_name'] : ".";

            // 8-aur-2022
            $request['tenant_licence_id'] = isset($tenant_licence_id) ? $tenant_licence_id : NULL;

            // 26-jun-2023
            $request['additional_information'] = isset($request['additional_information']) ? $request['additional_information'] : null;

            $this->db->insert($table, $request);

            $insert_id = $this->db->insert_id();

            if ($insert_id) {

                // 4-oct-2022
                $this->sendWhatAppMessageToRegister($insert_id);
                //  $gender_value = $request['gender']==1 ?  "Male" : 'Female';
                //  $health_insurance_array = array(
                //      'user_id' => $insert_id,
                //      'member_id' => $insert_id,
                // 		    'name'=>$request['first_name']." ".$request['last_name'] ,
                // 		    'gender'=> $gender_value ? $gender_value : 'Male',
                // 		    'email'=>$request['email'] ,
                // 		    'date_of_birth','plan_type'=>'A');
                // 		    $this->sendHealthysureRegister($health_insurance_array   );
                // START - user_govt_id_image
                // 25-jul-2022
                if (isset($_FILES['profile_image']['name'])) {
                    $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
                    if ($_FILES['profile_image']['name'] != '') {
                        $temp = explode(".", $_FILES['profile_image']['name']);
                        $ext = end($temp);
                    }
                    if (in_array($ext, $allowed)) {
                        if ($_FILES['profile_image']['name'] != '') {
                            $target_path = './uploads/profile_image/';
                            $temp = explode(".", $_FILES['profile_image']['name']);
                            $newfilename = '';
                            $image_url_path_new = "";
                            $time = mt_rand(10, 100) . time() . rand();
                            $newfilename = $time . '.' . end($temp);
                            $newthumbfilename = $time . '_thumb.' . end($temp);

                            $target_path_new = $target_path . $newfilename;
                            if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_path_new)) {
                                $return = array("status" => 'false', "message" => 'Could not move the file!');
                                echo json_encode($return);
                            } else {
                                $this->load->library('image_lib');
                                $configer = array(
                                    'image_library' => 'gd2',
                                    'source_image' => $target_path_new,
                                    'create_thumb' => TRUE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 950,
                                    'height' => 950,
                                    'new_image' => FCPATH . '/uploads/profile_image/thumbnail/'
                                );

                                $this->image_lib->clear();
                                $this->image_lib->initialize($configer);
                                $this->image_lib->resize();

                                // $image_url_path = base_url() . 'uploads/profile_image/';
                                // $target_path_url_main = $image_url_path . $newfilename;
                                // $target_thumbnail_path_url_main = $image_url_path . 'thumbnail/' . $newthumbfilename;
                                // 7-feb-2023
                                $target_path_url_main = '/profile_image/' . $newfilename;
                                $target_thumbnail_path_url_main = '/profile_image/' . 'thumbnail/' . $newthumbfilename;

                                $arr_image_to_update = array(
                                    'profile_image' => $target_path_url_main,
                                    'profile_image_thumb' => $target_thumbnail_path_url_main
                                );

                                $this->db->where('id', $insert_id);
                                $res = $this->db->update('users', $arr_image_to_update);
                                //  if($res) {
                                //      $result = array('status'  => 'Success','message' => "Image updated" ,  );
                                //      print json_encode( $result );
                                //  } else {
                                //      $result = array('status'  => 'Fail','message' => "No record found." ,  );
                                //      print json_encode( $result );
                                //  }
                            }
                        }
                    }
                }

                // START - user_govt_id_image
                // 23-jul-2022
                $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
                $img_value = "";
                if (isset($_FILES['govt_id_image_url']['name'])) {
                    if ($_FILES['govt_id_image_url']['name'] != '') {
                        $temp = explode(".", $_FILES['govt_id_image_url']['name']);
                        $ext = end($temp);
                    }
                    if (in_array($ext, $allowed)) {
                        if ($_FILES['govt_id_image_url']['name'] != '') {
                            $target_path = './uploads/user_govt_id_image/';
                            $temp = explode(".", $_FILES['govt_id_image_url']['name']);
                            $newfilename = '';
                            $image_url_path_new = "";
                            $time = mt_rand(10, 100) . time() . rand();
                            $newfilename = $time . '.' . end($temp);
                            $newthumbfilename = $time . '_thumb.' . end($temp);

                            $target_path_new = $target_path . $newfilename;
                            if (!move_uploaded_file($_FILES['govt_id_image_url']['tmp_name'], $target_path_new)) {
                                $return = array("status" => 'false', "message" => 'Could not move the file!');
                                echo json_encode($return);
                            } else {
                                $this->load->library('image_lib');

                                $configer = array(
                                    'image_library' => 'gd2',
                                    'source_image' => $target_path_new,
                                    'create_thumb' => TRUE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 950,
                                    'height' => 950,
                                    'new_image' => FCPATH . '/uploads/user_govt_id_image/thumbnail/'
                                );

                                $this->image_lib->clear();
                                $this->image_lib->initialize($configer);
                                $this->image_lib->resize();

                                // $image_url_path = base_url() . 'uploads/user_govt_id_image/';
                                // $target_path_url_main = $image_url_path . $newfilename;
                                // $target_thumbnail_path_url_main = $image_url_path . 'thumbnail/' . $newthumbfilename;
                                // 7-feb-2023
                                $target_path_url_main = '/user_govt_id_image/' . $newfilename;
                                $target_thumbnail_path_url_main = '/user_govt_id_image/thumbnail/' . $newthumbfilename;

                                $arr_image_to_update = array(
                                    'govt_id_image_url' => $target_path_url_main,
                                    'govt_id_image_url_thumb' => $target_thumbnail_path_url_main
                                );

                                $this->db->where('id', $insert_id);
                                $this->db->update('users', $arr_image_to_update);
                            }
                        }
                    }
                }
                // END - user_govt_id_image
                //  $contacts = json_decode($emergency_contacts);
                //  foreach($contacts as $kk=>$vv){
                //      $idata = array('emergency_user_id'=>$vv->emergency_user_id,'serial_no'=>$vv->serial_no,'user_id'=>$insert_id);
                //      $this->db->insert('emergency_contacts',$idata);
                //  }

                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d', strtotime($start_date . ' +30 days'));
                // 22-dec-2022 -  plan_id 1 to 0 changed, status 1 to 0 changed
                // plan_id 0 default entry when register user
                $this->db->insert('user_plan', array('user_id' => $insert_id, 'plan_id' => '0', 'start_date' => $start_date, 'end_date' => '2050-01-01', 'status' => '0'));

                /////////////////
                if ($critical_illness_id != null) {
                    $critical_illness_id_explod = explode(",", $critical_illness_id);
                    foreach ($critical_illness_id_explod as $key => $value) {
                        $insert_critical_illness_arr = array();
                        $critical_illness_id = trim($value);
                        $insert_critical_illness_arr['user_id'] = $insert_id;
                        $insert_critical_illness_arr['critical_illness_id'] = $critical_illness_id;
                        if ($critical_illness_id == 6) {
                            $insert_critical_illness_arr['critical_illness_name'] = trim($critical_illness_name);
                        } else {
                            $insert_critical_illness_arr['critical_illness_name'] = null;
                        }
                        $this->db->insert('user_critical_illness', $insert_critical_illness_arr);
                    }
                }
                /////////////////
                // 22-jul-2022
                //$this->addUserMyresqr($insert_id);
                // 23-jul-2022
                $this->addUserMobileWhatsappRegister($request['mobile_no']);
            }
            $where_data = array(// ----------------Array for check data exist ot not
                'id' => $insert_id
            );

            $token = AUTHORIZATION::generateToken($where_data);
            //update Acess Token
            $this->db->where('id', $insert_id);
            $this->db->update($table, array('auth_key' => $token));

            $select_data = "*";
            //------------ Select table
            $result = $this->get_table_where($select_data, $where_data, $table);
            /* 	//echo "<pre>";print_r($result); */
            foreach ($result as $key => $value) {
                # code...
                $this->db->from('user_plan');
                $this->db->join('plan_master', 'plan_master.id = user_plan.plan_id', 'left');
                $this->db->where('user_id', $insert_id);
                $res = $this->db->get()->row_array();
                $result[$key]['plan_info'] = $res;

                $this->db->from('emergency_contacts');

                $this->db->where('user_id', $insert_id);
                $ress = $this->db->get()->result_array();
                $result[$key]['emergency_contacts'] = $ress;
            }



            //$result[0]->token = $token;
            //echo "<pre>";print_r($result);exit;
            return $result[0];
        } else {
            // START - user_govt_id_image
            // 25-jul-2022
            if (isset($_FILES['profile_image']['name'])) {
                $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
                if ($_FILES['profile_image']['name'] != '') {
                    $temp = explode(".", $_FILES['profile_image']['name']);
                    $ext = end($temp);
                }
                if (in_array($ext, $allowed)) {
                    if ($_FILES['profile_image']['name'] != '') {
                        $target_path = './uploads/profile_image/';
                        $temp = explode(".", $_FILES['profile_image']['name']);
                        $newfilename = '';
                        $image_url_path_new = "";
                        $time = mt_rand(10, 100) . time() . rand();
                        $newfilename = $time . '.' . end($temp);
                        $newthumbfilename = $time . '_thumb.' . end($temp);

                        $target_path_new = $target_path . $newfilename;
                        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_path_new)) {
                            $return = array("status" => 'false', "message" => 'Could not move the file!');
                            echo json_encode($return);
                        } else {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/profile_image/thumbnail/'
                            );

                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();

                            $image_url_path = base_url() . 'uploads/profile_image/';
                            $target_path_url_main = $image_url_path . $newfilename;
                            $target_thumbnail_path_url_main = $image_url_path . 'thumbnail/' . $newthumbfilename;

                            $arr_image_to_update = array(
                                'profile_image' => $target_path_url_main,
                                'profile_image_thumb' => $target_thumbnail_path_url_main
                            );

                            $this->db->where('id', $uinfo);
                            $res = $this->db->update('users', $arr_image_to_update);
                            //  if($res) {
                            //      $result = array('status'  => 'Success','message' => "Image updated" ,  );
                            //      print json_encode( $result );
                            //  } else {
                            //      $result = array('status'  => 'Fail','message' => "No record found." ,  );
                            //      print json_encode( $result );
                            //  }
                        }
                    }
                }
            }

            $userinfo = $this->db->get_where('users', array('mobile_no' => $request['mobile_no'], 'is_deleted' => '0'))->row();
            //print_r($userinfo->email);die;
            if ($userinfo->email != '') {

                $table = 'users';
                if (isset($request['password'])) {
                    $request['password'] = md5($request['password']);
                }
                if (isset($request['emergency_contacts'])) {
                    $emergency_contacts = $request['emergency_contacts'];
                }
                unset($request['app_security_key']);
                unset($request['emergency_contacts']);
                unset($request['critical_illness_id']);

                // START - 7-jun-2022
                date_default_timezone_set('Asia/Kolkata');
                $request['modified_at'] = date('Y-m-d H:i:s');

                // 26-jun-2023
                $request['additional_information'] = isset($request['additional_information']) ? $request['additional_information'] : null;
                
                $this->db->where('id', $uinfo);
                $this->db->update($table, $request);
                if ($uinfo) {

                    //
                    $this->db->select("*");
                    $this->db->where('user_plan.user_id', $uinfo);
                    $query_user_plan = $this->db->get('user_plan');
                    ///print_r($query_user_plan);die;
                    if ($query_user_plan->num_rows() < 0) {
                        $start_date = date('Y-m-d');
                        $end_date = date('Y-m-d', strtotime($start_date . ' +30 days'));
                        $this->db->insert('user_plan', array('user_id' => $uinfo, 'plan_id' => '1', 'start_date' => $start_date, 'end_date' => $end_date, 'status' => '1'));
                    }
                }
                $where_data = array(// ----------------Array for check data exist ot not
                    'id' => $uinfo
                );

                $token = AUTHORIZATION::generateToken($where_data);
                //update Acess Token
                $this->db->where('id', $uinfo);
                $this->db->update($table, array('auth_key' => $token));

                $select_data = "*";
                //------------ Select table
                $result = $this->get_table_where($select_data, $where_data, $table);
                if ($result) {
                    $result[0]['user_name'] = $result[0]['user_name'] != null ? $result[0]['user_name'] : "";
                    $result[0]['first_name'] = $result[0]['first_name'] != null ? $result[0]['first_name'] : "";
                    $result[0]['middle_name'] = $result[0]['middle_name'] != null ? $result[0]['middle_name'] : "";
                    $result[0]['last_name'] = $result[0]['last_name'] != null ? $result[0]['last_name'] : "";
                    $result[0]['mobile_no'] = $result[0]['mobile_no'] != null ? $result[0]['mobile_no'] : "";
                    $result[0]['age'] = $result[0]['age'] != null ? $result[0]['age'] : "";
                    $result[0]['gender'] = $result[0]['gender'] != null ? $result[0]['gender'] : "";
                    $result[0]['blood_group'] = $result[0]['blood_group'] != null ? $result[0]['blood_group'] : "";
                    $result[0]['date_of_birth'] = $result[0]['date_of_birth'] != null ? $result[0]['date_of_birth'] : "";
                    $result[0]['address'] = $result[0]['address'] != null ? $result[0]['address'] : "";
                    $result[0]['mpin'] = $result[0]['mpin'] != null ? $result[0]['mpin'] : "";
                    $result[0]['user_dp'] = $result[0]['user_dp'] != null ? $result[0]['user_dp'] : "";
                    $result[0]['firebase_key'] = $result[0]['firebase_key'] != null ? $result[0]['firebase_key'] : "";
                    $result[0]['profile_image'] = $result[0]['profile_image'] != null ? $result[0]['profile_image'] : "";
                    $result[0]['profile_image_thumb'] = $result[0]['profile_image_thumb'] != null ? $result[0]['profile_image_thumb'] : "";

                    $result[0]['from_bulk'] = $result[0]['from_bulk'] != null ? $result[0]['from_bulk'] : "";
                    $result[0]['tenant_id'] = $result[0]['tenant_id'] != null ? $result[0]['tenant_id'] : "";
                    $result[0]['bulk_update_on'] = $result[0]['bulk_update_on'] != null ? $result[0]['bulk_update_on'] : "";
                    $result[0]['govt_id_image_url'] = $result[0]['govt_id_image_url'] != null ? $result[0]['govt_id_image_url'] : "";
                    $result[0]['govt_id_image_url_thumb'] = $result[0]['govt_id_image_url_thumb'] != null ? $result[0]['govt_id_image_url_thumb'] : "";
                    $result[0]['govt_id_number'] = $result[0]['govt_id_number'] != null ? $result[0]['govt_id_number'] : "";
                    $result[0]['govt_id_type'] = $result[0]['govt_id_type'] != null ? $result[0]['govt_id_type'] : "";
                    $result[0]['unique_id'] = $result[0]['unique_id'] != null ? $result[0]['unique_id'] : "";
                    $result[0]['plan_info'] = $result[0]['plan_info'] != null ? $result[0]['plan_info'] : "";
                }
                /* 	//echo "<pre>";print_r($result); */
                foreach ($result as $key => $value) {
                    # code...
                    $this->db->from('user_plan');
                    $this->db->join('plan_master', 'plan_master.id = user_plan.plan_id', 'left');
                    $this->db->where('user_id', $uinfo);
                    $res = $this->db->get()->row_array();
                    $result[$key]['plan_info'] = $res;

                    $this->db->from('emergency_contacts');

                    $this->db->where('user_id', $uinfo);
                    $ress = $this->db->get()->result_array();
                    $result[$key]['emergency_contacts'] = $ress;
                }



                //$result[0]->token = $token;
                //echo "<pre>";print_r($result);exit;
                return $result[0];
            } else {
                return false;
            }
        }
    }

    function getUserDetails($data) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $select_data = "*";
        $where_data = array('id' => $data['user_id']);
        //------------ Select table
        $result = $this->get_table_where($select_data, $where_data, 'users');
        /* 	//echo "<pre>";print_r($result); */
        // START - 17-jun
        $user_critical_illness_detail = $this->getUserCriticalIllnessByUserId($data['user_id']);
        $critical_illness_array = array();
        if (count($user_critical_illness_detail)) {
            foreach ($user_critical_illness_detail as $key => $value) {
                $critical_illness_array[$key]['critical_illness_id'] = $value['critical_illness_id'];
                if ($value['critical_illness_id'] != 6) {
                    $critical_illness_name = $this->getCriticalIllnessById($value['critical_illness_id']);
                    if ($critical_illness_name != null) {
                        $critical_illness_array[$key]['critical_illness_name'] = $critical_illness_name['critical_illness_name'];
                    }
                } else {
                    $critical_illness_array[$key]['critical_illness_name'] = $value['critical_illness_name'];
                }
            }
        }
        $result[0]['critical_illness_info'] = $critical_illness_array;
        // END - 17-jun

        foreach ($result as $key => $value) {
            # code...

            $result[$key]['user_name'] = $value['user_name'] ? $value['user_name'] : "";
            $result[$key]['password'] = $value['password'] ? $value['password'] : "";
            $result[$key]['middle_name'] = $value['middle_name'] ? $value['middle_name'] : "";
            $result[$key]['user_dp'] = $value['user_dp'] ? $value['user_dp'] : "";
            $result[$key]['firebase_key'] = $value['firebase_key'] ? $value['firebase_key'] : "";
            $result[$key]['bulk_update_on'] = $value['bulk_update_on'] ? $value['bulk_update_on'] : "";

            $result[$key]['city'] = $value['city'] ? $value['city'] : "";

            $blood_group = '';
            if ($result[$key]['blood_group'] == '1') {
                $blood_group = 'A+';
            } else if ($result[$key]['blood_group'] == '2') {
                $blood_group = 'B+';
            } else if ($result[$key]['blood_group'] == '3') {
                $blood_group = 'O+';
            } else if ($result[$key]['blood_group'] == '4') {
                $blood_group = 'AB+';
            } else if ($result[$key]['blood_group'] == '5') {
                $blood_group = 'A-';
            } else if ($result[$key]['blood_group'] == '6') {
                $blood_group = 'B-';
            } else if ($result[$key]['blood_group'] == '7') {
                $blood_group = 'O-';
            } else if ($result[$key]['blood_group'] == '8') {
                $blood_group = 'AB-';
            }
            $result[$key]['blood_group_value'] = $blood_group ? $blood_group : "";

            if ($value['profile_image'] != null || $value['profile_image'] != "") {
                $result[$key]['profile_image'] = GetProfileImagePath($value['profile_image']);
            } else {
                $result[$key]['profile_image'] = DefaultProfileImage();
            }
            if ($value['profile_image_thumb'] != null || $value['profile_image_thumb'] != "") {
                $result[$key]['profile_image_thumb'] = GetProfileImagePath($value['profile_image_thumb']);
            } else {
                $result[$key]['profile_image_thumb'] = DefaultProfileImage();
            }
            if ($value['govt_id_image_url'] != null || $value['govt_id_image_url'] != "") {
                $result[$key]['govt_id_image_url'] = GetProfileImagePath($value['govt_id_image_url']);
            }
            if ($value['govt_id_image_url_thumb'] != null || $value['govt_id_image_url_thumb'] != "") {
                $result[$key]['govt_id_image_url_thumb'] = GetProfileImagePath($value['govt_id_image_url_thumb']);
            }

            $this->db->from('user_plan');
            $this->db->join('plan_master', 'plan_master.id = user_plan.plan_id', 'left');
            $this->db->where('user_id', $data['user_id']);
            $this->db->where('user_plan.is_deleted', '0');
            $this->db->order_by('user_plan.id', 'DESC');
            $res = $this->db->get()->row_array();

            // START - chatbot_url 28-march-2023
            $chatbot_url = '';
            $enterprise_type = '';
            if ($value['tenant_id'] != null) {
                $this->db->from('user_admin');
                $this->db->where('id', $value['tenant_id']);
                $user_admin_res = $this->db->get()->row_array();
                if ($user_admin_res) {
                    $chatbot_url = $user_admin_res['chatbot_url'];
                    $enterprise_type = $user_admin_res['enterprise_type'];
                }
            }
            //&data_attrs={FirstName=Onkar}&launch_flow=welcome_86202&env=p
            $first_name_text = '';
            if ($value['first_name']) {
                $first_name_text = $value['first_name'];
            }
            $chatbot_text = '&data_attrs={FirstName=' . $first_name_text . '}&launch_flow=welcome_86202&env=p';
            $result[$key]['chatbot_url'] = $chatbot_url . $chatbot_text;
            $result[$key]['enterprise_type'] = $enterprise_type;
            // END - chatbot_url 28-march-2023

            $query_tenant_licence = array();
            if ($value['tenant_licence_id'] != null) {
                $this->db->select("*");
                $this->db->where('tenant_licence.id', $value['tenant_licence_id']);
                $query_tenant_licence = $this->db->get('tenant_licence')->row();

                $this->db->select("*");
                $this->db->where('is_use', '1');
                $this->db->where('is_deleted', '0');
                //	$this->db->where('tenant_licence.start_date <=',  date('Y-m-d'));
                $this->db->where('tenant_licence.end_date <=', date('Y-m-d'));
                $this->db->where('tenant_licence.id', $value['tenant_licence_id']);
                $expire_query = $this->db->get('tenant_licence')->row();
                //echo $this->db->last_query();die;
                if ($expire_query) {
                    $query_tenant_licence->licence_expired = 1;
                } else {
                    $query_tenant_licence->licence_expired = 0;
                }
            }
            if (!empty($query_tenant_licence)) {
                $result[$key]['tenant_licence'] = $query_tenant_licence;
            } else {
                $result[$key]['tenant_licence'] = array(
                    "id" => "",
                    "licence_key" => "",
                    "tenant_id" => "",
                    "start_date" => "",
                    "end_date" => "",
                    "user_id" => "",
                    "is_use" => "",
                    "title" => "",
                    "is_deleted" => "",
                    "created_at" => "",
                    "licence_expired" => 1
                );
            }
            //$result[$key]['plan_info'] = $res;
            // 11-jun-2022 added empty object
            if ($res) {

                $sos_count = $this->getSosCount($data['user_id']);
                $follow_me_count = $this->getFollowMeCount($data['user_id']);
                $posh_count = $this->getPoshCount($data['user_id']);
                $ambulance_count = $this->getAmbulanceCount($data['user_id']);
                $road_side_assistance_count = $this->getRoadSideAssistanceCount($data['user_id']);
                $accidental_insurance_count = $this->getAccidentalInsuranceCount($data['user_id']);

                $res['sos_remaining_count'] = $res['sos'] - $sos_count;
                $res['follow_me_remaining_count'] = $res['follow_me'] - $follow_me_count;
                $res['posh_remaining_count'] = $res['posh'] - $posh_count;
                $res['ambulance_remaining_count'] = $res['ambulance'] - $ambulance_count;
                $res['road_side_assistance_remaining_count'] = $res['road_side_assistance'] - $road_side_assistance_count;
                $res['accidental_insurance_remaining_count'] = $res['accidental_insurance'] - $accidental_insurance_count;
                $result[$key]['plan_info'] = $res;
            } else {
                $result[$key]['plan_info'] = array(
                    "id" => "",
                    "user_id" => "",
                    "plan_id" => "",
                    "start_date" => "",
                    "end_date" => "",
                    "transaction_id" => "",
                    "status" => "",
                    "created_at" => "",
                    "title" => "",
                    "duration" => "",
                    "price" => ""
                );
            }

            $this->db->from('emergency_contacts');

            $this->db->where('is_deleted', '0');
            $this->db->where('user_id', $data['user_id']);
            $ress = $this->db->get()->result_array();
            $result[$key]['emergency_contacts'] = $ress;

            // 25-jul-2022
            // ambulance details
            $this->db->select('*');
            $this->db->from('call_ambulance');
            $this->db->where('call_ambulance.user_id', $data['user_id']);
            $this->db->order_by('id', 'DESC');
            $q = $this->db->get();
            $res_call_ambulance = $q->row_array();
            if ($res_call_ambulance) {
                $result[$key]['call_ambulance'] = $res_call_ambulance;
            } else {
                $result[$key]['call_ambulance'] = array(
                    "id" => "",
                    "user_id" => "",
                    "unique_id" => "",
                    "latitude" => "",
                    "longitude" => "",
                    "device_id" => "",
                    "request_id" => "",
                    "request_result" => "",
                    "ambulance_service_used" => "",
                    "created_at" => "",
                    "updated_at" => "",
                );
            }

            // 25-jul-2022
            // rsa details
            $this->db->select('*');
            $this->db->from('call_rsa');
            $this->db->where('call_rsa.user_id', $data['user_id']);
            $this->db->where('call_rsa.cancel_status', '0');
            $this->db->order_by('id', 'DESC');
            $q = $this->db->get();
            $res_call_ambulance = $q->row_array();
            if ($res_call_ambulance) {
                $result[$key]['call_rsa'] = $res_call_ambulance;
            } else {
                $result[$key]['call_rsa'] = array(
                    "id" => "",
                    "user_id" => "",
                    "client" => "",
                    "contact_name" => "",
                    "mobile_no" => "",
                    "pincode" => "",
                    "bdlatitude" => "",
                    "bdlongitude" => "",
                    "bdlocation" => "",
                    "state" => "",
                    "subject" => "",
                    "service" => "",
                    "subservice" => "",
                    "fuel" => "",
                    "vehicleno" => "",
                    "vinn" => "",
                    "manufacturer" => "",
                    "model" => "",
                    "runningkm" => "",
                    "serviceeligibility" => "",
                    "policyno" => "",
                    "warrplcystartdate" => "",
                    "warrplcyenddate" => "",
                    "policytype" => "",
                    "voiceofcustomer" => "",
                    "uniqueid" => "",
                    "vehiclecondition" => "",
                    "saledate" => "",
                    "accidenttype" => "",
                    "vehicletype" => "",
                    "vehicleloaded" => "",
                    "extrafittings" => "",
                    "drploctype" => "",
                    "dealer" => "",
                    "custpreftype" => "",
                    "custdrploc" => "",
                    "custdrplat" => "",
                    "custdrplong" => "",
                    "requestedby" => "",
                    "caseid" => "",
                    "caseid_result" => "",
                    "updated_at" => "",
                    "created_at" => "",
                );
            }

            return $result[0];
        }
    }

    function getPlans($data) {
// 	   $select_data="*";
// 	   $result = $this->get_table_where( $select_data, $where_data, 'plan_master' );
// 			return $result;
        if (isset($data['tenant_id']) && ($data['tenant_id'] != null)) {
            $this->db->select('plan_master.*, user_admin.first_name, user_admin.last_name');
            $this->db->from('plan_master');
            $this->db->join('user_admin', 'user_admin.id = plan_master.tenant_id', 'left');
            $this->db->where('plan_master.status', '1');
            $this->db->where('plan_master.is_deleted', '0');
            $this->db->where('plan_master.is_changed', '0');
            $this->db->where('plan_master.tenant_id', $data['tenant_id']);
            $q = $this->db->get();
            return $q->result_array();
        } else {
            $this->db->select('plan_master.*, user_admin.first_name, user_admin.last_name');
            $this->db->from('plan_master');
            $this->db->join('user_admin', 'user_admin.id = plan_master.tenant_id', 'left');
            $this->db->where('plan_master.status', '1');
            $this->db->where('plan_master.is_deleted', '0');
            $this->db->where('plan_master.is_changed', '0');
            $q = $this->db->get();
            return $q->result_array();
        }
    }

    function updateUserDetails($data) {
        $table = 'users';
        //$request['password']=md5($request['password']);
        $emergency_contacts = array();
        $critical_illness_id = null;
        if (isset($data['emergency_contacts'])) {
            $emergency_contacts = $data['emergency_contacts'];
        }
        $user_id = $data['user_id'];
        if (isset($data['critical_illness_id'])) {
            $critical_illness_id = $data['critical_illness_id'];
        }
        if (isset($data['critical_illness_name'])) {
            $critical_illness_name = $data['critical_illness_name'];
        }

        unset($data['critical_illness_id']);
        unset($data['critical_illness_name']);

        unset($data['app_security_key']);
        unset($data['auth_key']);
        unset($data['emergency_contacts']);
        unset($data['user_id']);

        if (isset($data['city'])) {
            $data['address'] = isset($data['city']) ? $data['city'] : null;
        }

        $this->db->where('id', $user_id);
        $this->db->update($table, $data);

        if ($user_id) {

            // START - user_govt_id_image
            // 25-jul-2022
            if (isset($_FILES['profile_image']['name'])) {
                $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
                if ($_FILES['profile_image']['name'] != '') {
                    $temp = explode(".", $_FILES['profile_image']['name']);
                    $ext = end($temp);
                }
                if (in_array($ext, $allowed)) {
                    if ($_FILES['profile_image']['name'] != '') {
                        $target_path = './uploads/profile_image/';
                        $temp = explode(".", $_FILES['profile_image']['name']);
                        $newfilename = '';
                        $image_url_path_new = "";
                        $time = mt_rand(10, 100) . time() . rand();
                        $newfilename = $time . '.' . end($temp);
                        $newthumbfilename = $time . '_thumb.' . end($temp);

                        $target_path_new = $target_path . $newfilename;
                        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_path_new)) {
                            $return = array("status" => 'false', "message" => 'Could not move the file!');
                            echo json_encode($return);
                        } else {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/profile_image/thumbnail/'
                            );

                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();

                            // $image_url_path = base_url() . 'uploads/profile_image/';
                            // $target_path_url_main = $image_url_path . $newfilename;
                            // $target_thumbnail_path_url_main = $image_url_path . 'thumbnail/' . $newthumbfilename;
                            // 7-feb-2023
                            $target_path_url_main = '/profile_image/' . $newfilename;
                            $target_thumbnail_path_url_main = '/profile_image/' . 'thumbnail/' . $newthumbfilename;

                            $arr_image_to_update = array(
                                'profile_image' => $target_path_url_main,
                                'profile_image_thumb' => $target_thumbnail_path_url_main
                            );

                            $this->db->where('id', $user_id);
                            $res = $this->db->update('users', $arr_image_to_update);
                            //  if($res) {
                            //      $result = array('status'  => 'Success','message' => "Image updated" ,  );
                            //      print json_encode( $result );
                            //  } else {
                            //      $result = array('status'  => 'Fail','message' => "No record found." ,  );
                            //      print json_encode( $result );
                            //  }
                        }
                    }
                }
            }
            // START - user_govt_id_image
            // 23-jul-2022
            $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
            $img_value = "";
            if (isset($_FILES['govt_id_image_url']['name'])) {
                if ($_FILES['govt_id_image_url']['name'] != '') {
                    $temp = explode(".", $_FILES['govt_id_image_url']['name']);
                    $ext = end($temp);
                }
                if (in_array($ext, $allowed)) {
                    if ($_FILES['govt_id_image_url']['name'] != '') {
                        $target_path = './uploads/user_govt_id_image/';
                        $temp = explode(".", $_FILES['govt_id_image_url']['name']);
                        $newfilename = '';
                        $image_url_path_new = "";
                        $time = mt_rand(10, 100) . time() . rand();
                        $newfilename = $time . '.' . end($temp);
                        $newthumbfilename = $time . '_thumb.' . end($temp);

                        $target_path_new = $target_path . $newfilename;
                        if (!move_uploaded_file($_FILES['govt_id_image_url']['tmp_name'], $target_path_new)) {
                            $return = array("status" => 'false', "message" => 'Could not move the file!');
                            echo json_encode($return);
                        } else {
                            $this->load->library('image_lib');

                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/user_govt_id_image/thumbnail/'
                            );

                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();

                            // $image_url_path = base_url() . 'uploads/user_govt_id_image/';
                            // $target_path_url_main = $image_url_path . $newfilename;
                            // $target_thumbnail_path_url_main = $image_url_path . 'thumbnail/' . $newthumbfilename;
                            // 7-feb-2023
                            $target_path_url_main = '/user_govt_id_image/' . $newfilename;
                            $target_thumbnail_path_url_main = '/user_govt_id_image/' . 'thumbnail/' . $newthumbfilename;

                            $arr_image_to_update = array(
                                'govt_id_image_url' => $target_path_url_main,
                                'govt_id_image_url_thumb' => $target_thumbnail_path_url_main
                            );

                            $this->db->where('id', $user_id);
                            $this->db->update('users', $arr_image_to_update);
                        }
                    }
                }
            }
            // END - user_govt_id_image
            /// 23-jul-2022
            //  $this->updateUserMyresqr($user_id);
            //	 	echo "<pre>";print_r($emergency_contacts);exit;

            if (!empty($emergency_contacts)) {
                $contacts = json_decode($emergency_contacts);

                foreach ($contacts as $kk => $vv) {
                    if ($vv->delete == 'true' || $vv->delete == true) {
                        $is_deleted = '1';
                    } else {
                        $is_deleted = '0';
                    }

                    if ($vv->emergency_user_id == '0') {
                        if (preg_match('/\s/', $vv->name)) {
                            $arr = explode(' ', $vv->name);
                            $fname = $arr['0'];
                            $lname = $arr['1'];
                        } else {
                            $fname = $vv->name;
                            $lname = '';
                        }

                        $uinfo_res = $this->db->get_where('users', array('mobile_no' => $vv->mobile_no, 'is_deleted' => '0'))->row();
                        if ($uinfo_res) {
                            $uinfo_id = $uinfo_res->id;
                            //  $emergency_contacts_details = $this->db->get_where('emergency_contacts',array('user_id'=>$user_id,'emergency_user_id'=>$uinfo_id,'is_deleted'=>'0'))->row()->id;
                            $emergency_contacts_details = $this->db->get_where('emergency_contacts', array('user_id' => $user_id, 'emergency_user_id' => $uinfo_id, 'is_deleted' => '0'))->row();
                            if (!$emergency_contacts_details) {

                                $this->db->insert('emergency_contacts', array('user_id' => $user_id, 'emergency_user_id' => $uinfo_id, 'serial_no' => $vv->serial_no, 'name' => $fname, 'is_deleted' => $is_deleted));

                                // 4-oct-2022
                                $this->sendWhatAppMessageToEmergencyContact($user_id, $vv->mobile_no);
                            }
                            // $this->sendWhatAppMessageToEmergencyContact($user_id, $vv->mobile_no  );
                        } else {
                            $euid_res = $this->db->get_where('users', array('mobile_no' => $vv->mobile_no, 'is_deleted' => '0'))->row();
                            if ($euid_res) {
                                $uid = $euid_res->id;
                            } else {
                                $this->db->insert('users', array('first_name' => $fname, 'last_name' => $lname, 'mobile_no' => $vv->mobile_no, 'email' => $fname . '@email.com'));
                                $uid = $this->db->insert_id();

                                // 4-oct-2022
                                $this->sendWhatAppMessageToEmergencyContact($user_id, $vv->mobile_no);
                            }


                            if ($uid) {
                                $emergency_contacts_details = $this->db->get_where('emergency_contacts', array('user_id' => $user_id, 'emergency_user_id' => $uid, 'is_deleted' => $is_deleted))->row();
                                if (!$emergency_contacts_details)
                                    $this->db->insert('emergency_contacts', array('user_id' => $user_id, 'emergency_user_id' => $uid, 'serial_no' => $vv->serial_no, 'name' => $fname, 'is_deleted' => $is_deleted));

                                // 4-oct-2022
                                $this->sendWhatAppMessageToEmergencyContact($user_id, $vv->mobile_no);
                            }
                        }
                    } else {
                        // echo $vv->emergency_user_id;exit;
                        if ($is_deleted == "1") {
                            $this->db->close();
                            $this->load->database();
                            $user_info = $this->db->get_where('users', array('id' => $vv->emergency_user_id, 'is_deleted' => 0))->row();
                            if ($user_info) {
                                //$emergency_user_info = $this->db->get_where('emergency_contacts',array('emergency_user_id'=>$vv->emergency_user_id,'user_id'=>$user_id))->row();
                                $emergency_user_info = $this->db->get_where('emergency_contacts', array('emergency_user_id' => $vv->emergency_user_id, 'user_id' => $user_id))->result_array();
                                if ($emergency_user_info) {

                                    foreach ($emergency_user_info as $row) {
                                        if ($row['id'] != null) {
                                            $this->db->where('id', $row['id']);
                                            $this->db->where('user_id', $user_id);
                                            $this->db->where('emergency_user_id', $vv->emergency_user_id);
                                            $this->db->update('emergency_contacts', array('user_id' => $user_id, 'emergency_user_id' => $vv->emergency_user_id, 'serial_no' => $vv->serial_no, 'name' => $vv->name, 'is_deleted' => $is_deleted));
                                        }
                                    }
                                } else {
                                    
                                }
                            } else {

                                // if delete
                                $this->db->where('user_id', $user_id);
                                $this->db->where('emergency_user_id', $vv->emergency_user_id);
                                $this->db->update('emergency_contacts',
                                        array('user_id' => $user_id,
                                            'emergency_user_id' => $vv->emergency_user_id,
                                            'serial_no' => $vv->serial_no,
                                            'name' => $vv->name,
                                            'is_deleted' => $is_deleted));
                            }
                        }
                    }
                }
            }

            if ($critical_illness_id != null) {
                $critical_illness_id_explod = explode(",", $critical_illness_id);
                $critical_illness_old_id = $this->getUserCriticalIllnessByUserId($user_id);
                $critical_illness_id_arr = array();
                if (!empty($critical_illness_old_id)) {
                    $critical_illness_id_arr = array_column($critical_illness_old_id, 'critical_illness_id');
                }
                $diff_add_arr = array_diff($critical_illness_id_explod, $critical_illness_id_arr);
                $diff_remove_arr = array_diff($critical_illness_id_arr, $critical_illness_id_explod);
                if (!empty($diff_add_arr)) {
                    foreach ($diff_add_arr as $key => $value) {
                        $critical_illness_name_value = null;
                        if ($value == "6") {
                            $critical_illness_name_value = $critical_illness_name;
                        }
                        $insert_critical_illness_arr = [
                            'user_id' => $user_id,
                            'critical_illness_id' => $value,
                            'critical_illness_name' => $critical_illness_name_value,
                        ];
                        $this->db->insert('user_critical_illness', $insert_critical_illness_arr);
                    }
                }
                if (!empty($diff_remove_arr)) {
                    foreach ($diff_remove_arr as $key => $value) {
                        $result = $this->deleteCriticalIllnessByUserId($user_id, $value);
                    }
                }
                if (empty($diff_add_arr)) {
                    if (in_array(6, $diff_add_arr)) {
                        
                    } else {
                        if (in_array(6, $critical_illness_id_explod)) {
                            $update_result = $this->updateCriticalIllnessByUserId($user_id, 6, $critical_illness_name);
                        }
                    }
                }
            }
            ////////////
        }
        return true;
    }

    function updatePlans($data) {
        unset($data['app_security_key']);
        unset($data['auth_key']);
        if ($data['transaction_id']) {

            //update old license status to in-active
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('user_plan', array('status' => '0'));

            $license_duration = $this->db->get_where('plan_master', array('id' => $data['plan_id']))->row()->duration;

            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($start_date . ' +' . $license_duration . ' days'));
            $this->db->insert('user_plan', array('user_id' => $data['user_id'], 'plan_id' => $data['plan_id'], 'start_date' => $start_date, 'end_date' => $end_date, 'status' => '1'));
            return true;
        }
    }

    function forget_password($data) {

        $select_data = "*";

        $where_data = array(// ----------------Array for check data exist ot not
            'id' => $data['user_id']
        );
        $table = "tbl_users";

        //------------ Select table
        $result = $this->get_table_where($select_data, $where_data, $table);
        //var_dump($result);
        //exit;

        if (count($result) == 1) { // check if user exist or not
            $email = $result[0]['email'];
            $full_name = $result[0]['full_name'];

            $newpassword = rand(10000, 99999);
            $update_data = array(
                'password' => md5($newpassword)
            );
            $where_data = array(// ----------------Array for check data exist ot not
                'id' => $data['user_id']
            );

            $results = $this->update_table_where($update_data, $where_data, $table);
            $this->send_link($email, $newpassword, $full_name);
            return true;
        }
    }

    public function send_link($email, $newpassword, $full_name) {

        $from = 'smtp@citysmile.in';
        $site_name = 'OneLove';
        $s = base_url();
        $sub = "Forgot Password";
        $template['userName'] = $email;

        $select_data = "*";
        $table = "email_templates";
        $this->db->select($select_data);
        $this->db->where('email_template_id', '2');
        $query = $this->db->get($table);  //--- Table name = User
        $email_template = $query->result_array();
        //echo "<pre>";print_r($email_template);exit;
        //  $email_template = $this->common_model->getRecords("email_templates", '*', array("email_template_id" => '2'));
        $rawstring = $email_template[0]['message'];
        $base_url = base_url();
        $username = $email;
        $user_name = $full_name;
        $placeholders = array('[SITE_NAME]', '[BASE_URL]', '[USERNAME]', '[PASSWORD]', '[USER_NAME]');
        $vals_1 = array($site_name, $base_url, $username, $newpassword, $user_name);
        //replace
        $message = str_replace($placeholders, $vals_1, $rawstring);

        $ci = & get_instance();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.citysmile.in';
        $config['smtp_port'] = '587';
        $config['smtp_user'] = 'smtp@citysmile.in';
        $config['smtp_pass'] = 'GzdumLMPS*h;';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;
        $config['wordwrap'] = TRUE;

        $ci->email->initialize($config);
        $ci->email->from($from, $name);
        $ci->email->to($email);

        $ci->email->subject($sub);
        $ci->email->message($message);

        $send = $ci->email->send(); //echo $send;
        if ($send) { // check if user exist or not
            return true;
        } else {
            //	echo $ci->email->print_debugger();
        }
    }

    public function reset_password_users($data) {
        //var_dump($data['key']);

        $table = "user";

        $where_data = array(// ----------------Array for check data exist ot not
            //'reset_key'     => $data['key'],
            'username' => $data['email']
        );
        $select_data = "*";
        $result = $this->get_table_where($select_data, $where_data, $table);

        if (count($result) == 1) {
            $where_data = array(// ----------------Array for check data exist ot not

                'username' => $data['email']
            );
            $update_data = array(
                'reset_key' => '',
                'password' => md5($data['password'])
            );
            $results = $this->update_table_where($update_data, $where_data, $table);

            return true;
        } else {
            return false;
        }
    }

    function update_table_where($update_data, $where_data, $table) {
        $this->db->where($where_data);
        $this->db->update($table, $update_data);
    }

    public function updateProfile($data) {

        $update_data = array(
            //	'user_type'=>$data['user_type'],
            'sap_code' => $data['sap_code'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'branch_name' => $data['branch_name'],
            'department' => $data['department'],
            'designation' => $data['designation'],
            'mobile_no' => $data['mobile_no'],
            'vertical' => $data['vertical'],
            'blood_group' => $data['blood_group'],
            'date_of_birth' => date('Y-m-d', strtotime($data['date_of_birth'])),
            'reporting_manager_sap_code' => $data['reporting_manager_sap_code'],
            'reporting_manager_name' => $data['reporting_manager_name'],
            'reviewing_manager_sap_code' => $data['reviewing_manager_sap_code'],
            'reviewing_manager_name' => $data['reviewing_manager_name'],
            'ho_poc_sap_code' => $data['ho_poc_sap_code'],
            'ho_poc_name' => $data['ho_poc_name'],
            'department_head_sap_code' => $data['department_head_sap_code'],
            'department_head_name' => $data['department_head_name'],
            'status' => $data['status']
        );
        $this->db->where('id', $data['user_id']);
        $this->db->update('users', $update_data);
        //echo $this->db->last_query();exit;
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_table_where($select_data, $where_data = '', $table) {

        $this->db->select($select_data);
        if ($where_data)
            $this->db->where($where_data);
        $query = $this->db->get($table);  //--- Table name = User
        $result = $query->result_array();
        return $result;
    }

    public function raiseQuery($data) {
        // 9-jun-2022
        date_default_timezone_set('Asia/Kolkata');

        $this->db->insert('queries', array('user_id' => $data['user_id'], 'description' => $data['description'], 'type' => $data['type'],
            // 9-jun-2022
            'created_at' => date('Y-m-d H:i:s')
        ));
        return $this->db->insert_id();
    }

    public function getQueryType($data) {
        $this->db->select('id,title');
        $this->db->where('type', $data['type']);
        $this->db->or_where('type', '0');
        $query = $this->db->get('query_type');  //--- Table name = User
        $result = $query->result_array();
        return $result;
    }

    public function getBanners($user_id) {
        $tenant_id = "";
        if ($user_id) {
            $this->db->select('id, tenant_id');
            $this->db->from('users');
            $this->db->where('users.id', $user_id);
            $this->db->where('is_deleted', '0');
            $q = $this->db->get();
            $res_users = $q->row_array();
            $tenant_id = $res_users['tenant_id'];
        }
        if ($tenant_id != "") {
            $this->db->where('is_deleted', '0');
            $this->db->where('tenant_id', $tenant_id);
            $this->db->from('banners');
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            $result = $query->result_array();
            if (!empty($result)) {
                return $result;
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    public function pages($id) {

        if ($id['page_id'] == '1') {

            $this->db->select('api_about_us as about_us');
            $query = $this->db->get('pages');  //--- Table name = User

            $result = $query->row_array();
            return $result;
        }
        if ($id['page_id'] == '2') {

            $this->db->select('api_privacy_policy as privacy_policy');
            $query = $this->db->get('pages');  //--- Table name = User

            $result = $query->row_array();
            return $result;
        }

        if ($id['page_id'] == '3') {

            $this->db->select('api_terms as terms_conditions');
            $query = $this->db->get('pages');  //--- Table name = User

            $result = $query->row_array(); // echo $this->db->last_query();exit;
            return $result;
        }

        if ($id['page_id'] == '4') {

            $this->db->select('api_help as help');
            $query = $this->db->get('pages');  //--- Table name = User

            $result = $query->row_array();
            return $result;
        }

        if ($id['page_id'] == '5') {

            $this->db->select('api_tutorial as tutorial');
            $query = $this->db->get('pages');  //--- Table name = User

            $result = $query->row_array();
            return $result;
        }

        return false;
    }

    public function getUserCriticalIllnessByUserId($user_id) {
        $this->db->select('user_critical_illness.id,user_critical_illness.critical_illness_id,user_critical_illness.critical_illness_name');
        $this->db->from('user_critical_illness');
        $this->db->where('user_critical_illness.user_id', $user_id);
        $this->db->where('user_critical_illness.is_deleted', "0");
        $this->db->order_by('user_critical_illness.critical_illness_id');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getCriticalIllnessById($critical_illness_id) {
        $this->db->select('critical_illness.critical_illness_name');
        $this->db->from('critical_illness');
        $this->db->where('critical_illness.id', $critical_illness_id);
        $q = $this->db->get();
        return $q->row_array();
    }

    public function deleteCriticalIllnessByUserId($user_id, $illness_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('critical_illness_id', $illness_id);
        $this->db->update('user_critical_illness', array('is_deleted' => "1", 'updated_at' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }

    public function updateCriticalIllnessByUserId($user_id, $illness_id, $critical_illness_name) {
        $this->db->where('user_id', $user_id);
        $this->db->where('critical_illness_id', $illness_id);
        $this->db->where('is_deleted', "0");
        $this->db->update('user_critical_illness', array('critical_illness_name' => $critical_illness_name, 'updated_at' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }

    // 10-dec-2021
    // notifiction for tracking
    public function sendMessageOnesignalTracking($message) {
        $msg = $message;
        $content = array(
            "en" => $msg
        );
        $headings = array(
            "en" => "Captain INDIA",
        );
        $hashes_array = array();
        $fields = array(
            'app_id' => "8ad390eb-06a8-4c5b-857a-be72e9e8f1f7",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'headings' => $headings,
            'contents' => $content,
            "url" => $url,
            // 'web_buttons' => $hashes_array
        );
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            // 'Authorization: Basic ZjNkY2M5YjktOTllNC00ZTdkLWFlY2MtYzAxYTdmMGY4MGFl'
            'Authorization: Basic MjI3YmI3NTEtOWRjNy00OWIwLWEyZTItNTNmZDc1NmRjMzNk' // uat
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    public function getFollowMeUserRequests($user_id) {
        $this->db->select('*');
        $this->db->from('pre_trigger_notifications');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'desc');
        //	$this->db->group_by('panic_request.id');
        $this->db->group_by('pre_trigger_notifications.user_id');
        $this->db->group_by('pre_trigger_notifications.pre_trigger_id');
        $q = $this->db->get();
        $res = $q->result_array();
        foreach ($res as $key => $row) {
            if ($row['pre_trigger_id'] != "") {
                $this->db->select('pre_trigger_notifications.status_stop_date');
                $this->db->from('pre_trigger_notifications');
                if ((isset($row['pre_trigger_id']) ) || ($row['pre_trigger_id'] != "")) {
                    $this->db->where('pre_trigger_notifications.pre_trigger_id', $row['pre_trigger_id']);
                    $this->db->where('pre_trigger_notifications.status', "1");
                }
                $q = $this->db->get();
                $res2 = $q->row_array();

                $res_tracking_status_start_date = "";
                $res_tracking_status_end_date = "";
                // 14-jul-2022
                if ((isset($row['tracking_id']) ) || ($row['tracking_id'] != "")) {
                    $this->db->select('tracking.start_time as tracking_start_time, tracking.end_time as tracking_end_time');
                    $this->db->from('tracking');
                    $this->db->where('tracking.id', $row['tracking_id']);
                    $q = $this->db->get();
                    $res_tracking = $q->row_array();
                    if ($res_tracking) {
                        $res_tracking_status_start_date = $res_tracking['tracking_start_time'] ? $res_tracking['tracking_start_time'] : '';
                        $res_tracking_status_end_date = $res_tracking['tracking_end_time'] ? $res_tracking['tracking_end_time'] : '';
                    }
                }
            }
            $res[$key]['status_stop_date'] = $res2['status_stop_date'];

            $res[$key]['status_start_date'] = $res_tracking_status_start_date;
            $res[$key]['status_stop_date'] = $res_tracking_status_end_date;
        }
        return $res;
    }

    // 18-jun-2022
    function updateUserMpin($data) {
        date_default_timezone_set('Asia/Kolkata');
        unset($data['app_security_key']);
        unset($data['auth_key']);
        if ($data['user_id'] != "") {
            if ($data['mpin'] != "" || $data['mpin'] != NULL) {
                $update_data = array(
                    'mpin' => $data['mpin'],
                    'modified_at' => date('Y-m-d H:i:s'),
                );
                $this->db->where('id', $data['user_id']);
                $this->db->update('users', $update_data);
                // echo $this->db->last_query();exit;
                if ($this->db->affected_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // 20-jun-2022
    function getPoshEvidenceDetails($data) {
        unset($data['app_security_key']);
        unset($data['auth_key']);

        if ($data['user_id'] != "") {
            // echo $this->db->last_query();exit;
            if (isset($data['module_type'])) {
                // $this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp');
                $this->db->distinct();
                $this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,panic_request.user_lat,panic_request.user_long,panic_request.timestamp');
                $this->db->from('panic_request');
                // 		$this->db->join('user_multimedia','user_multimedia.panic_id = panic_request.id','left');
                // 		$this->db->join('users','users.id = user_multimedia.user_id','left');
                $this->db->join('users', 'users.id = panic_request.user_id', 'left');
                $this->db->where('users.id', $data['user_id']);
                $this->db->where('users.is_deleted', '0');
                // 		$this->db->where('user_multimedia.module_type', $data['module_type']);
                $this->db->where('panic_request.module_type', $data['module_type']);

                // $this->db->group_by('panic_request.id');
                $this->db->order_by('timestamp', 'desc');
                $q = $this->db->get();
                return $q->result_array();
            } else {
                $this->db->distinct();
                $this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp');
                $this->db->from('panic_request');
                $this->db->join('user_multimedia', 'user_multimedia.panic_id = panic_request.id', 'left');
                $this->db->join('users', 'users.id = user_multimedia.user_id', 'left');
                $this->db->where('users.id', $data['user_id']);
                $this->db->where('users.is_deleted', '0');
                $this->db->where('user_multimedia.module_type', '3');
                // $this->db->group_by('panic_request.id');
                $this->db->order_by('timestamp', 'desc');
                $q = $this->db->get();
                return $q->result_array();
            }
        } else {
            return false;
        }
    }

    // 20-jun-2022
    function addFollowmeSafe($data) {
        date_default_timezone_set('Asia/Kolkata');

        $insert_data = array(
            'user_id' => $data['user_id'],
            'followme_id' => $data['followme_id'],
            'status' => $data['status'],
            'user_lat' => $data['user_lat'],
            'user_long' => $data['user_long'],
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('followme_safe', $insert_data);
        $followme_safe_id = $this->db->insert_id();

        // 18-jul-2022
        if ($followme_safe_id && isset($data['followme_id'])) {
            $this->db->select('id, followme_id');
            $this->db->from('followme_safe');
            if ($data['followme_id']) {
                $this->db->where('followme_id', $data['followme_id']);
            }
            $this->db->where('status', '1');
            $this->db->order_by('id', 'desc');
            $res = $this->db->get();
            //  if ($res->num_rows() == 1 &&  $data['status'] == "1"){
            if ($data['status'] == "1") {
                $insert_panic_request_data = array(
                    'user_id' => $data['user_id'],
                    'user_lat' => $data['user_lat'],
                    'user_long' => $data['user_long'],
                    'timestamp' => date('Y-m-d H:i:s'),
                    'module_type' => '1'
                );
                $this->db->insert('panic_request', $insert_panic_request_data);
                // 	echo $this->db->last_query();
                $panic_request_id = $this->db->insert_id();
                if ($panic_request_id) {
                    $insert_panic_request_data = array(
                        'user_id' => $data['user_id'],
                        'panic_id' => $panic_request_id,
                        'user_lat' => $data['user_lat'],
                        'user_long' => $data['user_long'],
                        'content_type' => '4', // other
                        'module_type' => '4', // followme
                        'followme_id' => $data['followme_id'],
                        'followme_safe_id' => $followme_safe_id,
                        'followme_safe_status' => $data['status'],
                        'file_path' => NULL,
                        'thumbnail_file_path' => NULL,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('user_multimedia', $insert_panic_request_data);
                }
                //	echo $this->db->last_query();die;
            }

            $this->db->select('id, followme_id');
            $this->db->from('followme_safe');
            if ($data['followme_id']) {
                $this->db->where('followme_id', $data['followme_id']);
            }
            $this->db->where('status', '2');
            $this->db->order_by('id', 'desc');
            $res1 = $this->db->get();
            //	echo $this->db->last_query();die;
            //  if ($res1->num_rows() == 3 &&  $data['status'] == "2"){
            $num_rows = $res1->num_rows();
            if ($num_rows % 3 == 0 && $data['status'] == "2") {
                $insert_panic_request_data = array(
                    'user_id' => $data['user_id'],
                    'user_lat' => $data['user_lat'],
                    'user_long' => $data['user_long'],
                    'timestamp' => date('Y-m-d H:i:s'),
                    'module_type' => '1'
                );
                $this->db->insert('panic_request', $insert_panic_request_data);
                $panic_request_id_2 = $this->db->insert_id();
                if ($panic_request_id_2) {
                    $insert_panic_request_data = array(
                        'user_id' => $data['user_id'],
                        'panic_id' => $panic_request_id_2,
                        'user_lat' => $data['user_lat'],
                        'user_long' => $data['user_long'],
                        'content_type' => '4', // other
                        'module_type' => '4', // followme
                        'followme_id' => $data['followme_id'],
                        'followme_safe_id' => $followme_safe_id,
                        'followme_safe_status' => $data['status'],
                        'file_path' => NULL,
                        'thumbnail_file_path' => NULL,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('user_multimedia', $insert_panic_request_data);
                }
            }
        }
        return $followme_safe_id;
    }

    public function getUserEvidenceImages($panic_id) {

        $this->db->where('content_type', '1');
        //$this->db->where('module_type','1');

        $this->db->where('panic_id', $panic_id);
        //	$this->db->limit('1');
        $res = $this->db->get('user_multimedia')->result_array();
        //	echo $this->db->last_query();exit;
        return $res;
    }

    public function getUserEvidenceVideos($panic_id) {

        $this->db->where('content_type', '3');
//	    $this->db->where('module_type','1');
        $this->db->where('panic_id', $panic_id);
        //	$this->db->limit('1');
        return $this->db->get('user_multimedia')->result_array();
    }

    public function getUserEvidenceAudios($panic_id) {

        $this->db->where('content_type', '2');
        //  $this->db->where('module_type','1');
        $this->db->where('panic_id', $panic_id);
        //	$this->db->limit('1');
        return $this->db->get('user_multimedia')->result_array();
    }

    // 30-jun-2022
    function getFollowme($data) {

        $select_data = "*,t.id as  current_tracking_id, t.firebase_key as keyy,t.mode";
        $table = "tracking as t";
        $this->db->select($select_data);
        $this->db->from($table);
        //	$this->db->join('users','users.id = t.tracker_id','left');
        $this->db->join('users', 'users.id = t.trackee_id', 'left');
        $this->db->where('t.tracking_type', '2');
        $this->db->where('t.status', '1');

        $this->db->group_start();
        $this->db->where('t.trackee_id', $data['user_id']);
        $this->db->or_where('t.tracker_id', $data['user_id']);
        $this->db->group_end();
        //$this->db->where('t.end_time', '0000-00-00 00:00:00');

        $query = $this->db->get();  //--- Table name = User
        $result = $query->result();
        if (count($result) > 0) { // user credential is success
            return $result;
        } else {
            return false;
        }
    }

    public function getPreTriggerNotificationsTrackingId($tracking_id) {
        $this->db->select('pre_trigger_notifications.pre_trigger_id, pre_trigger_notifications.vehicle_number');
        $this->db->from('pre_trigger_notifications');
        $this->db->where('pre_trigger_notifications.tracking_id', $tracking_id);
        $q = $this->db->get();
        $res = $q->row_array();
        $res_arr = null;
        if ($res['pre_trigger_id']) {
            $res_arr['pre_trigger_id'] = $res['pre_trigger_id'];
        }
        if ($res['vehicle_number']) {
            $res_arr['vehicle_number'] = $res['vehicle_number'];
        }
        return $res_arr;
    }

    public function addUserPlan($user_id) {
        $this->db->select("*");
        $this->db->where('user_plan.user_id', $user_id);
        $query = $this->db->get('user_plan');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            date_default_timezone_set('Asia/Kolkata');
            $insert_data = array(
                'user_id' => $user_id,
                'plan_id' => 1,
                'start_date' => date('Y-m-d'),
                'end_date' => "2050-01-01",
                'transaction_id' => NULL,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('user_plan', $insert_data);
            return $this->db->insert_id();
        }
    }

    public function addUserMyresqr($user_id) {
	   // error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

       // $input_data = $_POST;
	   // if($input_data) {
	    if ($user_id) {
            // $data = $input_data;
	       // $insert_data= array(
    // 		//	'user_type'=>$data['user_type'],
    // 		 	'user_name'=>$data['user_name'],
    // 			'first_name'=>$data['firstname'],
    // 			'middle_name'=>$data['middlename'],
    // 			'last_name'=>$data['lastname'],
    // 			'email'=>$data['email'],
    // 			'address'=>$data['address'],
    // 			'city'=>$data['city'],
    // 			'state'=>$data['state'],
    // 			'pincode'=>$data['pincode'],
    // 			'age'=>$data['age'],
    // 			'gender'=>$data['gender'],
    // 			'mobile_no'=>$data['mobile_no'],
    // 			'blood_group'=>$data['blood_group'],
    // 			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    // 			'status'=>$data['status'],
    // 			'govt_id_image_url'=>$data['govt_id_image_url'],
    // 			'govt_id_number'=>$data['govt_id_number'],
    // 			'govt_id_type'=>$data['govt_id_type'],
    // 			'myresqr_status'=> '1',
		  //  );
    // 		$this->db->insert('users',$insert_data);
    		 $user_detail = array();
    	    if ($user_id) {
    	        //$user_id = 209;
    		  //  $unique_id= "capind".$user_id;
    	   //     $update_data['unique_id'] = $unique_id;
        //     	$this->db->where('id',$user_id);
        // 		$this->db->update('users',$update_data);

        	    $this->db->where('id', $user_id);
    		    $user_detail = $this->db->get('users')->row();
            }

            if (!empty($user_detail)) {
                //$user_id = 209;
                $this->db->where('id', $user_id);
                $user_detail = $this->db->get('users')->row();
                if ($user_detail) {
                    $unique_id = "";
                    $user_id = "";
                    $first_name = "";
                    $middle_name = "";
                    $last_name = "";
                    $email = "";
                    $mobile_no = "";
                    $gender = "";
                    $address = "";
                    $date_of_birth = "";
                    $city = "";
                    $state = "";
                    $pincode = "";
                    $govt_id_image_url = "";
                    $govt_id_number = "";
                    $govt_id_type = "";

                    $user_id = $user_detail->id;
                    if ($user_detail->unique_id == null) {
                        $unique_id = "capind" . $user_id;
                    } else {
                        $unique_id = $user_detail->unique_id;
                    }
                    $first_name = $user_detail->first_name;
                    $middle_name = $user_detail->middle_name;
                    $last_name = $user_detail->last_name;
                    $email = $user_detail->email;
                    $mobile_no = $user_detail->mobile_no;
                    $gender = $user_detail->gender ? "Male" : "Female";
                    $address = $user_detail->address;
                    $date_of_birth = $user_detail->date_of_birth;
                    $city = $user_detail->city;
                    $state = $user_detail->state;
                    $pincode = $user_detail->pincode;
                    $govt_id_image_url = $user_detail->govt_id_image_url;
                    $govt_id_number = $user_detail->govt_id_number;
                    $govt_id_type = $user_detail->govt_id_type;

                    $insert_myresqr_user = array(
                        'uniqueId' => $unique_id,
                        'firstname' => $first_name,
                        'lastname' => $last_name,
                        'mobile' => $mobile_no,
                        'email' => $email,
                        'gender' => $gender,
                        'address' => $address,
                        'dob' => $date_of_birth,
                        'city' => $city,
                        'state' => $state,
                        'pincode' => $pincode,
                        'govtIdImageUrl' => $govt_id_image_url,
                        'govtIdNumber' => $govt_id_number,
                        'govtIdType' => $govt_id_type,
                    );
                    // print_r($insert_myresqr_user);  		  //  die;
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
                    $php_utcNow = date("D, d M Y h:i:s ") . date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/register/" . "\n" . $php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials . "&Signature=" . $sig;

                    $header_arr = array(
                        'x-myresqr-date: ' . $php_utcNow,
                        'Authorization: ' . $newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );

                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://api.myresqr.life/tps/v1/register/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    //   print_r($response);

                    $json_result = json_decode($response, true);
                    if (!empty($json_result)) {
                        if (array_key_exists("errorMessage", $json_result)) {

                            $json_result_error_msg = $json_result['errorMessage'];
                            //   print_r($json_result_error_msg);
                            // if (str_contains($json_result_error_msg, 'lastname')) { 
                            if (strpos($json_result_error_msg, 'lastname') !== false) {
                                $error_msg_return[] = "Lastname";
                            }
                            // if (str_contains($json_result_error_msg, 'address')) {
                            if (strpos($json_result_error_msg, 'address') !== false) {
                                $error_msg_return[] = "Address";
                            }
                            // if (str_contains($json_result_error_msg, 'city')) { 
                            if (strpos($json_result_error_msg, 'city') !== false) {
                                $error_msg_return[] = "City";
                            }
                            // if (str_contains($json_result_error_msg, 'state')) { 
                            if (strpos($json_result_error_msg, 'state') !== false) {
                                $error_msg_return[] = "State";
                            }
                            // if (str_contains($json_result_error_msg, 'pincode')) { 
                            if (strpos($json_result_error_msg, 'pincode') !== false) {
                                $error_msg_return[] = "Pincode";
                            }


                            // if (str_contains($json_result_error_msg, 'govtIdImageUrl')) { 
                            if (strpos($json_result_error_msg, 'govtIdImageUrl') !== false) {
                                $error_msg_return[] = "Govt Id Image";
                            }

                            // if (str_contains($json_result_error_msg, 'govtIdType')) { 
                            if (strpos($json_result_error_msg, 'govtIdType') !== false) {
                                $error_msg_return[] = "Govt Id Type";
                            }
                            // if (str_contains($json_result_error_msg, 'govtIdNumber')) { 
                            if (strpos($json_result_error_msg, 'govtIdNumber') !== false) {
                                $error_msg_return[] = "Govt Id Number";
                            }
                        } else {
                            $unique_id = "capind" . $user_id;
                            $user_update_data['unique_id'] = $unique_id;
                            $user_update_data['myresqr_status'] = "1";
                            $this->db->where('id', $user_id);
                            $this->db->update('users', $user_update_data);
                        }
                    }
                    // $json_result = json_decode($response, true);
                    //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    // if (curl_errno($curl)) {
                    //echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                    //echo "\n";
                    // print_r(json_encode($insert_myresqr_user));
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function updateUserMyresqr($user_id) {
        // error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        if ($user_id) {
            $user_detail = array();
            if ($user_id) {
                //$user_id = 209;
                $this->db->where('id', $user_id);
                $user_detail = $this->db->get('users')->row();
            }

            if (!empty($user_detail)) {

                //     if( $user_detail->unique_id ==  null ||  $user_detail->unique_id !="") {
                //         $unique_id= "tst_".$user_id;
                //         $this->db->where('id',$user_id);
                //  $this->db->update('users',array('unique_id'=>$unique_id));
                //     }
                //$user_id = 209;
                $this->db->where('id', $user_id);
                $user_detail = $this->db->get('users')->row();
                if ($user_detail) {
                    $unique_id = "";
                    $user_id = "";
                    $first_name = "";
                    $middle_name = "";
                    $last_name = "";
                    $email = "";
                    $mobile_no = "";
                    $gender = "";
                    $address = "";
                    $date_of_birth = "";
                    $city = "";
                    $state = "";
                    $pincode = "";
                    $govt_id_image_url = "";
                    $govt_id_number = "";
                    $govt_id_type = "";

                    $user_id = $user_detail->id;
                    $unique_id = $user_detail->unique_id;
                    $first_name = $user_detail->first_name;
                    $middle_name = $user_detail->middle_name;
                    $last_name = $user_detail->last_name;
                    $email = $user_detail->email;
                    $mobile_no = $user_detail->mobile_no;
                    $gender = $user_detail->gender == 1 ? "Male" : "Female";
                    $address = $user_detail->address;
                    $date_of_birth = $user_detail->date_of_birth;
                    $city = $user_detail->city;
                    $state = $user_detail->state;
                    $pincode = $user_detail->pincode;
                    $govt_id_image_url = $user_detail->govt_id_image_url;
                    $govt_id_number = $user_detail->govt_id_number;
                    $govt_id_type = $user_detail->govt_id_type;

                    $insert_myresqr_user = array();

                    $insert_myresqr_user['uniqueId'] = $unique_id;

                    if ($first_name) {
                        $insert_myresqr_user['firstname'] = $first_name;
                    }
                    if ($last_name) {
                        $insert_myresqr_user['lastname'] = $last_name;
                    }
                    if ($mobile_no) {
                        $insert_myresqr_user['mobile'] = $mobile_no;
                    }
                    if ($email) {
                        $insert_myresqr_user['email'] = $email;
                    }
                    if ($gender) {
                        $insert_myresqr_user['gender'] = $gender;
                    }
                    if ($address) {
                        $insert_myresqr_user['address'] = $address;
                    }
                    if ($date_of_birth) {
                        $insert_myresqr_user['dob'] = $date_of_birth;
                    }
                    if ($city) {
                        $insert_myresqr_user['city'] = $city;
                    }
                    if ($state) {
                        $insert_myresqr_user['state'] = $state;
                    }
                    if ($pincode) {
                        $insert_myresqr_user['pincode'] = $pincode;
                    }
                    if ($govt_id_image_url) {
                        $insert_myresqr_user['govtIdImageUrl'] = $govt_id_image_url;
                    }
                    if ($govt_id_number) {
                        $insert_myresqr_user['govtIdNumber'] = $govt_id_number;
                    }
                    if ($govt_id_type) {
                        $insert_myresqr_user['govtIdType'] = $govt_id_type;
                    }
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
                    $php_utcNow = date("D, d M Y h:i:s ") . date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/update/" . "\n" . $php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials . "&Signature=" . $sig;

                    $header_arr = array(
                        'x-myresqr-date: ' . $php_utcNow,
                        'Authorization: ' . $newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );

                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://api.myresqr.life/tps/v1/update/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    if ($response) {
                        $json_result = json_decode($response, true);
                        if (isset($json_result['success'])) {
                            if ($json_result['success'] == false && $json_result['errorCode'] == 141 && $json_result['errorMessage'] == "uniqueId does not exist") {
                                $this->addUserMyresqr($user_id);
                            }
                        }
                        //print_R($json_result);
                        // echo $json_result['uniqueId'];
                    }
                    //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    // if (curl_errno($curl)) {
                    //  echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                    //echo "\n";
                    // print_r(json_encode($insert_myresqr_user));
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    // 23- jul-2022
    // send whatapp message to user
    public function userWhatsappOtpMessages($mobile_no, $otp) {

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $input_data = $_POST;
        // if($input_data && isset($input_data['mobile_no']) && isset($input_data['otp']) ) {
        if ($mobile_no != "" && $otp != "") {
            $data = $input_data;
            $user_detail = array();
            $unique_id = "";
            //	$mobile_no = $data['mobile_no'];
            //	$otp = $data['otp'];
            if (!empty($mobile_no)) {
                if ($mobile_no) {
                    $mobile_no_length = strlen((string) $mobile_no);
                    if ($mobile_no_length == 10) {
                        $mobile_no = "91" . $mobile_no;
                    }
                    $insert_myresqr_user = array(
                        'type' => "template",
                        'to' => array($mobile_no),
                        'content' => array(
                            "template_name" => "otp_for_verification",
                            "language" => "en",
                            "params" => array(
                                "1" => $otp
                            ),
                            "ttl" => "P1D"),
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                    $header_arr = array(
                        'Authorization: Bearer emltYXhXOjY5Y0NWOHpo',
                        'Content-Type: application/json',
                    );
                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'webpostservice.com/api/whatsapp/v1.0/zimaxW/messages');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    // print_r($response);
                    // $json_result = json_decode($response, true);
                    // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    // echo "httpcode = ". $httpcode;
                    // if (curl_errno($curl)) {
                    //   echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                    //echo "\n";
                    // print_r(json_encode($insert_myresqr_user));
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function addUserMobileWhatsappRegister($mobile_no = '') {
        if ($mobile_no != "") {

            if ($mobile_no) {
                $user_detail = array();
                // 		$numbers = $data['numbers'];
                $numbers = $mobile_no;
                //print_r($numbers); //   	 die;
                if (!empty($numbers)) {
                    if ($numbers) {
                        $insert_myresqr_user = array(
                            'numbers' => $numbers,
                        );
                        $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                        $header_arr = array(
                            'Authorization: Bearer emltYXhXOjY5Y0NWOHpo',
                            'Content-Type: application/json',
                        );
                        // START - curl
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, 'webpostservice.com/api/whatsapp/v1.0/zimaxW/register/optin');
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_ENCODING, '');
                        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                        // curl_setopt($curl, CURLOPT_HEADER, true);
                        curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                        $response = curl_exec($curl);
                        curl_close($curl);
                        //   print_r($response);
                        // $json_result = json_decode($response, true);
                        // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        //   echo "httpcode = ". $httpcode;
                        // if (curl_errno($curl)) {
                        ///echo 'Error:' . curl_error($curl);
                        // }
                        // $info = curl_getinfo($curl);
                        //echo "\n";
                        // print_r(json_encode($insert_myresqr_user));
                    } else {
                        $result = array('status' => 'Fail', 'message' => "No record found.",);
                        print json_encode($result);
                    }
                }
            }
        }
    }

    // 8-aug-2022
    public function validateLicence($licence_key) {
        $this->db->select("*");
        $this->db->where('is_use', '0');
        $this->db->where('is_deleted', '0');
        $this->db->where('tenant_licence.start_date <=', date('Y-m-d'));
        $this->db->where('tenant_licence.end_date >=', date('Y-m-d'));
        $this->db->where('tenant_licence.licence_key', $licence_key);
        $query = $this->db->get('tenant_licence')->row();

        $this->db->select("*");
        $this->db->where('is_use', '1');
        $this->db->where('is_deleted', '0');
        //	$this->db->where('tenant_licence.start_date <=',  date('Y-m-d'));
        //	$this->db->where('tenant_licence.end_date >=',  date('Y-m-d'));
        $this->db->where('tenant_licence.licence_key', $licence_key);
        $used_query = $this->db->get('tenant_licence')->row();

        $this->db->select("*");
        $this->db->where('is_use', '0');
        $this->db->where('is_deleted', '0');
        $this->db->where('tenant_licence.start_date <=', date('Y-m-d'));
        $this->db->where('tenant_licence.end_date <=', date('Y-m-d'));
        $this->db->where('tenant_licence.licence_key', $licence_key);
        $expire_query = $this->db->get('tenant_licence')->row();

        $this->db->select("*");
        $this->db->where('is_use', '0');
        $this->db->where('is_deleted', '0');
        //	$this->db->where('tenant_licence.start_date <=',  date('Y-m-d'));
        // 	$this->db->where('tenant_licence.end_date <=',  date('Y-m-d'));
        $this->db->where('tenant_licence.start_date is  NULL', NULL, FALSE);
        $this->db->where('tenant_licence.end_date  is  NULL', NULL, FALSE);
        $this->db->where('tenant_licence.licence_key', $licence_key);
        $query_date = $this->db->get('tenant_licence')->row();
        if ($used_query) {
            return array('status' => 'used');
        } else if ($expire_query) {
            return array('status' => 'expire', 'end_date' => $expire_query->end_date);
        } else if ($query) {
            return array('status' => 'found', 'query' => $query);
        } else if ($query_date) {
            return array('status' => 'found', 'query' => $query_date);
        } else {
            return array('status' => 'not_found');
        }
    }

    public function getAdminLicenceKey() {
        $this->db->select("*");
        $this->db->where('tenant_id', '1');
        $this->db->where('is_use', '0');
        $this->db->where('is_deleted', '0');
        $this->db->where('tenant_licence.start_date <=', date('Y-m-d'));
        $this->db->where('tenant_licence.end_date >=', date('Y-m-d'));

        $query = $this->db->get('tenant_licence')->row();

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function validateLicenceReference($licence_key) {

        $this->db->select("*");
        //	$this->db->where('is_use', '0');
        //  $this->db->where('tenant_licence_reference.licence_key',$licence_key);
        $this->db->where("tenant_licence_reference.licence_reference", $licence_key);
        $query_invalid = $this->db->get('tenant_licence_reference')->row();

        $this->db->select("*");
        $this->db->where('is_use', '0');
        //  $this->db->where('tenant_licence_reference.licence_key',$licence_key);
        $this->db->where("tenant_licence_reference.licence_reference", $licence_key);
        $query = $this->db->get('tenant_licence_reference')->row();
        if ($query) {
            return array('status' => 'found', 'query' => $query);
        } else if ($query_invalid) {
            return array('status' => 'limit_reached');
        } else {
            return array('status' => 'not_found');
        }
    }

    function getSettings() {
        $this->db->from('settings');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getPanicRequestById($id) {
        $this->db->select('panic_request.*');
        $this->db->from('panic_request');
        $this->db->where('panic_request.id', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return 0;
        }
    }

    public function deactiveUser($user_id) {
        $update_data = array(
            'status' => '2',
            'is_deleted' => 1,
            'modified_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $update_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 26-sep-2022
    public function getCityState($pincode) {
        if ($pincode != '') {
            $this->db->where('is_deleted', '0');
            $this->db->where('pincode', $pincode);
            $this->db->from('pincode_city_state');
            $res = $this->db->get();
            if ($res->num_rows() > 0) {
                return $res->row();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sendWhatAppMessageToEmergencyContact($user_id, $mobile_no) {
        // error_reporting(E_ALL); ini_set('display_errors', '1');

        $user_full_name = '';
        if ($user_id) {
            $this->db->select('first_name, last_name');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $user_id);
            $query_users = $this->db->get('users');
            $result_users = $query_users->row();
            if ($result_users) {
                $user_first_name = $result_users->first_name ? $result_users->first_name : '';
                $user_last_name = $result_users->last_name ? $result_users->last_name : '';
                $user_full_name = $user_first_name . " " . $user_last_name;
            }

            if (!empty($mobile_no)) {
                if ($mobile_no) {

                    $this->addUserMobileWhatsappRegister($mobile_no);
                    $mobile_no = '91' . $mobile_no;

                    $insert_myresqr_user = array(
                        'mobile_no' => $mobile_no,
                        'name' => $user_full_name,
                    ); 
                    
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $header_arr = array('Content-Type: application/json');

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://meraqr.co/api/EmergencyContactsMessage');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                //  print_r($response);
                    // $json_result = json_decode($response, true);
                    if ($response) {
                        $json_result = json_decode($response, true);
                    }  

                    // register number
                    /*
                    $insert_myresqr_user = array(
                        'type' => "template",
                        'to' => array($mobile_no),
                        'content' => array(
                            "template_name" => "emergency_contact_with_template_emergency_3",
                            "language" => "en",
                            "params" => array(
                                "1" => $user_full_name,
                                "2" => $user_full_name,
                                "3" => $user_full_name
                            ),
                            "ttl" => "P1D"),
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                    $header_arr = array(
                        'Authorization: Bearer emltYXhXOjY5Y0NWOHpo',
                        'Content-Type: application/json',
                    );
                   
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'webpostservice.com/api/whatsapp/v1.0/zimaxW/messages');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    // print_r($response);
                    $json_result = json_decode($response, true); */
                    // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    //  echo "httpcode = ". $httpcode;
                    // if (curl_errno($curl)) {
                    // echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => "No record found.");
                print json_encode($result);
            }
        }
    }

    public function sendWhatAppMessageToRegister($user_id) {
        //  error_reporting(E_ALL); ini_set('display_errors', '1');

        $user_full_name = '';
        $mobile_no = '';
        if ($user_id) {
            $this->db->select('first_name, last_name, mobile_no');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $user_id);
            $query_users = $this->db->get('users');
            $result_users = $query_users->row();
            if ($result_users) {
                $user_first_name = $result_users->first_name ? $result_users->first_name : '';
                $user_last_name = $result_users->last_name ? $result_users->last_name : '';
                $user_full_name = $user_first_name . " " . $user_last_name;
                $mobile_no = $result_users->mobile_no ? $result_users->mobile_no : '';
            }
            if (!empty($mobile_no)) {
                if ($mobile_no) {
                    // register number
                    $mobile_no = '91' . $mobile_no;
                    $this->addUserMobileWhatsappRegister($mobile_no);
                    $insert_myresqr_user = array(
                        'type' => "template",
                        'to' => array($mobile_no),
                        'content' => array(
                            "template_name" => "welcome_3",
                            "language" => "en",
                            "params" => array(
                                "1" => $user_full_name,
                            ),
                            "ttl" => "P1D"),
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                    $header_arr = array(
                        'Authorization: Bearer emltYXhXOjY5Y0NWOHpo',
                        'Content-Type: application/json',
                    );
                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'webpostservice.com/api/whatsapp/v1.0/zimaxW/messages');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                    // print_r($response);
                    $json_result = json_decode($response, true);
                    // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    //  echo "httpcode = ". $httpcode;
                    // if (curl_errno($curl)) {
                    //  echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => "No record found.");
                print json_encode($result);
            }
        }
    }

    // 10-oct-2022
    public function sendHealthysureRegister($data) {
        // error_reporting(E_ALL); ini_set('display_errors', '1');
        if ($data) {
            if (isset($data['member_id'])) {
                $member_id = $data['member_id'];
                $header_arr = array('client-id: qxHocZ0Lmw0qfe8FB5fK5UM4axbmlDgLyE39NTVX');
                // $post_fields = array('member_id' => '12','name' => 'manish12 ','gender' => 'Male','email' => 'manish12@gmail.com','date_of_birth' => '2010-10-19','plan_type' => 'C');
                $post_fields = $data;
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://stagingapi.healthysure.co/product_integration/digit_grp/digit_grp');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                $response = curl_exec($curl);
                if ($response) {
                    $json_result = json_decode($response, true);
                    if ($json_result) {
                        if (isset($json_result['data'])) {
                            $user_update_data['member_id'] = $json_result['data']['member_id'];
                            $user_update_data['sum_insured'] = $json_result['data']['sum_insured'];
                            $user_update_data['plan_type'] = $json_result['data']['plan_type'];
                            $this->db->where('id', $post_fields['user_id']);
                            $this->db->update('users', $user_update_data);
                        }
                    }
                }
                if ($response) {
                    //   print  ( $response );
                    // die;
                } else {
                    
                }
            }
        }
    }

    public function getUsers() {
        $this->db->from('users');
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
	    $q = $this->db->get();
	    return $q->result_array();
    }
    
    // 17-nov-2022
    public function getBulletinTag() {
         $tenant_id = '';
        if (isset($_POST['user_id'])) {
            $this->db->where('id', $_POST['user_id']);
            $this->db->limit('1');
            $q = $this->db->get('users');
            $res = $q->row_array();
            if ($q->num_rows() > 0) {
                $tenant_id = $res['tenant_id'];
            }
        }
        $this->db->select('id, title, tenant_id, status, created_at');
	    $this->db->where('is_deleted', '0');
 		$this->db->where('status', '1');
	    $this->db->from('bulletin_tag');
        if ($tenant_id != "") {
            $this->db->where('bulletin_tag.tenant_id', $tenant_id);
        }
	    $res = $this->db->get();
   		if ($res->num_rows() > 0) {
			return $res->result_array();
		} else {
			return false;
		}
    }
    
    // 18-nov-2022
    public function getBanner() {
        $this->db->select('id, title  ');
	    $this->db->where('is_deleted', '0');
	    $this->db->from('banners');
	    $res = $this->db->get();
   		if ($res->num_rows() > 0) {
			return $res->result_array();
		} else {
			return false;
		}
    }
    
    public function getUserPlan($user_id) {
        $this->db->from('user_plan');
        $this->db->join('plan_master', 'plan_master.id = user_plan.plan_id', 'left');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('user_plan.id', 'desc');
        $result = $this->db->get()->row_array();
        if (!empty($result)) {
            $sos_count = $this->getSosCount($user_id);
	        $follow_me_count = $this->getFollowMeCount($user_id);
            $posh_count = $this->getPoshCount($user_id);
		    $ambulance_count = $this->getAmbulanceCount($user_id);
		    $road_side_assistance_count = $this->getRoadSideAssistanceCount($user_id);
		    $accidental_insurance_count = $this->getAccidentalInsuranceCount($user_id);
		    $result['sos_remaining_count'] = $result['sos'] - $sos_count;
		    $result['follow_me_remaining_count'] = $result['follow_me'] - $follow_me_count;
		    $result['posh_remaining_count'] = $result['posh'] - $posh_count;
		    $result['ambulance_remaining_count'] = $result['ambulance'] - $ambulance_count;
		    $result['road_side_assistance_remaining_count'] = $result['road_side_assistance'] - $road_side_assistance_count;
		    $result['accidental_insurance_remaining_count'] = $result['accidental_insurance'] - $accidental_insurance_count;
		    return $result;
        } else {
            return false;
	}
    }

    // 12-dec-2022 - panic_request table
    public function getSosCount($user_id) {
        $this->db->select('panic_request.id');
        $this->db->from('panic_request');
        $this->db->where('panic_request.module_type', '1');
        $this->db->where('panic_request.user_id', $user_id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    // 12-dec-2022 - panic_request table
    public function getFollowMeCount($user_id) {
        $this->db->select('tracking.id');
        $this->db->from('tracking');
        $this->db->where('tracking.tracking_type', '2');
        $this->db->where('tracking.trackee_id', $user_id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    // 12-dec-2022 - call_ambulance table
    public function getAmbulanceCount($user_id) {
        $this->db->select('call_ambulance.id');
        $this->db->from('call_ambulance');
        $this->db->where('call_ambulance.user_id', $user_id);
        $this->db->where('call_ambulance.status', '1');
        $result = $this->db->get();
        return $result->num_rows();
    }

    // 12-dec-2022 - call_rsa table
    public function getRoadSideAssistanceCount($user_id) {
        $this->db->select('call_rsa.id');
        $this->db->from('call_rsa');
        $this->db->where('call_rsa.user_id', $user_id);
        $this->db->where('call_rsa.status', '1');
        $result = $this->db->get();
        return $result->num_rows();
    }

    // 12-dec-2022 - call_health_insurance table
    public function getAccidentalInsuranceCount($user_id) {
        $this->db->select('call_health_insurance.id');
        $this->db->from('call_health_insurance');
        $this->db->where('call_health_insurance.member_id', $user_id);
        $this->db->where('call_health_insurance.status', '1');
        $result = $this->db->get();
        return $result->num_rows();
    }

    // 12-dec-2022 - panic_request table
    public function getPoshCount($user_id) {
        $this->db->select('panic_request.id');
        $this->db->from('panic_request');
        $this->db->where('panic_request.module_type', '3');
        $this->db->where('panic_request.user_id', $user_id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    // 17-12-2022
    public function getUserAmbulance($user_id) {
        $this->db->select('id, user_id, unique_id, latitude, longitude, device_id, request_id, status, ambulance_service_used, created_at, updated_at, ambulance_service_id, dest_lat, dest_long, crn');
        $this->db->from('call_ambulance');
        $this->db->where('call_ambulance.user_id', $user_id);
        $this->db->order_by('id', 'desc');
        $res = $this->db->get();
        $result_array = $res->result_array();
        if (!empty($result_array)) {
            foreach ($result_array as $k => $row) {
                if ($row['ambulance_service_id'] == 2) {
                    $result_array[$k]['request_id'] = $row['crn'];
                    $result_array[$k]['latitude'] = $row['dest_lat'];
                    $result_array[$k]['longitude'] = $row['dest_long'];
                }
            }
        }
        return $result_array;
    }

    // 17-12-2022
    public function getUserRoadSideAssistance($user_id) {
        $this->db->select('id, user_id, client, contact_name, mobile_no, pincode, bdlatitude, bdlongitude, bdlocation, state, subject, service, subservice, fuel, vehicleno, vinn, manufacturer, model, runningkm, serviceeligibility, policyno,warrplcystartdate, warrplcyenddate, policytype, voiceofcustomer, uniqueid,vehiclecondition,saledate, accidenttype, vehicletype, vehicleloaded, extrafittings, drploctype, dealer, custpreftype, custdrploc, custdrplat, custdrplong, requestedby, caseid, status, caseid_result, cancel_status, cancel_result, updated_at, created_at');
        $this->db->from('call_rsa');
        $this->db->where('call_rsa.user_id', $user_id);
        $this->db->order_by('id', 'desc');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function addUserDevice($data) {
        date_default_timezone_set('Asia/Kolkata');
        $update_data = array(
            'device_info' => $data['device'],
            'modified_at' => date('Y-m-d H:i:s'),
        );
        $this->db->where('id', $data['user_id']);
        $this->db->update('users', $update_data);

        $insert_data = array(
            'user_id' => $data['user_id'],
            'device' => $data['device'],
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('user_device_info', $insert_data);
        return $this->db->insert_id();
    }

    public function checkQrCodeExists($code) {
        if ($code) {
            $this->db->select('qr_code.id, qr_code.type, qr_code.type_title');
            $this->db->from('qr_code');
            $this->db->where('qr_code.code', $code);
            $this->db->where('qr_code.user_id IS NULL', NULL, FALSE);
            $this->db->where('is_deleted', '0');
            $result = $this->db->get();
//            return $result->num_rows();
            return $result->row_array();
        } else {
//            return 0;
            return array();
        }
    }

    public function checkQrCodeType($data) {
        if ($data['code']) {
            if ($data['type'] == 4) {
                $this->db->select('qr_code.id');
                $this->db->from('qr_code');
                $this->db->where('qr_code.code', $data['code']);
                $this->db->where('qr_code.type', '1');
                $this->db->where('qr_code.user_id IS NULL', NULL, FALSE);
                $result = $this->db->get();
            } else {
                $this->db->select('qr_code.id');
                $this->db->from('qr_code');
                $this->db->where('qr_code.code', $data['code']);
                $this->db->where('qr_code.type', $data['type']);
                $this->db->where('qr_code.user_id IS NULL', NULL, FALSE);
                $result = $this->db->get();
            }
            return $result->num_rows();
        } else {
            return 0;
        }
    }

    public function checkQrCodeUsed($data) {
        if ($data['code']) {
            $this->db->select('qr_code.id');
            $this->db->from('qr_code');
            $this->db->where('qr_code.code', $data['code']);
            $this->db->where('qr_code.user_id IS NOT NULL', NULL, FALSE);
            $this->db->where('is_deleted', '0');
            $result = $this->db->get();
            return $result->num_rows();
        } else {
            return 0;
        }
    }

    public function addQrCode_OLD($data) {
        date_default_timezone_set('Asia/Kolkata');
        $insert_data = array();
        $insert_data_person = array();

        if ($data['id']) {

            $qr_code_id = $data['id'];
            $data['qr_code_id'] = null;
            if ($qr_code_id) {
                $data['qr_code_id'] = $qr_code_id;
            }
            $type_title = null;
            if ($data['type'] == "1" && $data['code_for'] == "1") {
                $type_title = "Self";
            } else if ($data['type'] == "1" && $data['code_for'] == "2") {
                $type_title = "Person";
            } else if ($data['type'] == "2") {
                $type_title = "Pet";
            } else if ($data['type'] == "3") {
                $type_title = "Things";
            }
            $update_qr_code = array(
                'user_id' => $data['user_id'],
                'code_for' => $data['code_for'],
                'type_title' => $type_title,
            );
            $this->db->where('id', $qr_code_id);
            $this->db->where('is_deleted', '0');
            $this->db->update('qr_code', $update_qr_code);

            // code_for = 2 for Other
            if ($data['code_for'] == 2) {

                // type = 1 for Person
                if ($data['type'] == 1) {

                    $person_user_id = $this->addQrCodeOtherPerson($data);
                    if ($person_user_id != null) {
                        $data['person_user_id'] = $person_user_id;
                        $this->addPersonEmergencyContact($data);
                    }
                }

                // type = 2 for Animal
                if ($data['type'] == 2) {
                    $this->addQrCodeOtherAnimal($data);
                }

                // type = 3 for Things
                if ($data['type'] == 3) {
                    $this->addQrCodeOtherThings($data);
                }
            }
            return $qr_code_id;
        }
    }

    public function addQrCode($data) {
        date_default_timezone_set('Asia/Kolkata');
        $insert_data = array();
        $insert_data_person = array();

        if ($data['id'] && $data['type'] != "") {

            $qr_code_id = $data['id'];
            $data['qr_code_id'] = null;
            if ($qr_code_id) {
                $data['qr_code_id'] = $qr_code_id;
            }
            $type_title = null;
            $type = $data['type'];
            if ($data['type'] == "1" && $data['code_for'] == "1") {
                $type_title = "Self";
                $type = '1';
            } else if ($data['type'] == "4" && $data['code_for'] == "1") {
                $type_title = "Self";
                $type = '1';
            } else if ($data['type'] == "1" && $data['code_for'] == "2") {
                $type_title = "Person";
                $type = '1';
            } else if ($data['type'] == "2") {
                $type_title = "Pet";
                $type = '2';
            } else if ($data['type'] == "3") {
                $type_title = "Things";
                $type = '3';
            }
            $update_qr_code = array(
                'user_id' => $data['user_id'],
                'code_for' => $data['code_for'],
                'type' => $type,
                'type_title' => $type_title,
                'updated_at' => date('Y-m-d H:i:s'),
                //28-jun-2023
                'additional_information' => $data['additional_information'],
            );
            $this->db->where('id', $qr_code_id);
            $this->db->where('is_deleted', '0');
            $this->db->update('qr_code', $update_qr_code);

            // code_for = 1 for self
            if ($data['code_for'] == 1) {
                $this->addQrCodeSelf($data);
            }

            // code_for = 2 for Other
            if ($data['code_for'] == 2) {

                // type = 1 for Person
                if ($data['type'] == 1) {

                    $person_user_id = $this->addQrCodeOtherPerson($data);
                    if ($person_user_id != null) {
                        $data['person_user_id'] = $person_user_id;
                        // $this->addPersonEmergencyContact($data);
                        $this->addQrCodeEmergencyContact($data);
                    }
                }

                // type = 2 for Animal
                if ($data['type'] == 2) {
                    $this->addQrCodeOtherAnimal($data);
                    $this->addQrCodeEmergencyContact($data);
                }

                // type = 3 for Things
                if ($data['type'] == 3) {
                    $this->addQrCodeOtherThings($data);
                    $this->addQrCodeEmergencyContact($data);
                }
            }
            return $qr_code_id;
        }
    }

    public function addQrCodeSelf($data) {
        $insert_data=array();
        if ($data['qr_code_id']) {
            $insert_data['qr_code_id'] = $data['qr_code_id'];
        }
        if ($data['user_id']) {
            $insert_data['parent_user_id'] = $data['user_id'];
        }
        if ($data['user_id']) {
            $insert_data['user_id'] = $data['user_id'];
        }
        if ($data['location']) {
            $insert_data['location'] = $data['location'];
        }
        if ($data['lat']) {
            $insert_data['lat'] = $data['lat'];
        }
        if ($data['long']) {
            $insert_data['long'] = $data['long'];
        }
        $insert_data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('qr_self', $insert_data);
    }

    public function addQrCodeOtherPerson($data) {
        $insert_data = array();
        $insert_user_data = array();
        if ($data['qr_code_id']) {
            $insert_data['qr_code_id'] = $data['qr_code_id'];
        }
        if ($data['user_id']) {
            $insert_data['parent_user_id'] = $data['user_id'];
        }
        if ($data['first_name']) {
            $insert_data['first_name'] = $data['first_name'];
            $insert_user_data['first_name'] = $data['first_name'];
        }
        if ($data['last_name']) {
            $insert_data['last_name'] = $data['last_name'];
            $insert_user_data['last_name'] = $data['last_name'];
        }
        if ($data['mobile_no']) {
            $insert_data['mobile_no'] = $data['mobile_no'];
            $insert_user_data['mobile_no'] = $data['mobile_no'];
        }
        if ($data['email']) {
            $insert_data['email'] = $data['email'];
            $insert_user_data['email'] = $data['email'];
        }
        if ($data['blood_group_id']) {
            $insert_data['blood_group_id'] = $data['blood_group_id'];
            $insert_user_data['blood_group'] = $data['blood_group_id'];
        }
        if ($data['image']) {
            $insert_data['image'] = $data['image'];
            $insert_data['image_path'] = $data['image_path'];
            $insert_user_data['profile_image'] = $data['image_path'];
        }
        
        if ($data['location']) {
            $insert_data['location'] = $data['location'];
        }
        if ($data['lat']) {
            $insert_data['lat'] = $data['lat'];
        }
        if ($data['long']) {
            $insert_data['long'] = $data['long'];
        }
        
        $insert_user_data['from_bulk'] = '3';
        $insert_user_data['created_at'] = date('Y-m-d H:i:s');
        $person_user_id = null;
        if (isset($data['mobile_no']) && $data['mobile_no'] != "") {
            $this->db->where('users.mobile_no', $data['mobile_no']);
            $this->db->where('users.status', "1");
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
            $check_res_users = $q->row_array();
            if ($check_res_users) {
                $person_user_id = $check_res_users['id'];
                $insert_data['user_id'] = $person_user_id;
            } else {
                $this->db->insert('users', $insert_user_data);
                if ($this->db->insert_id()) {
                    $person_user_id = $this->db->insert_id();
                    $insert_data['user_id'] = $person_user_id;
                }
            }
        }
        $insert_data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('qr_person', $insert_data);
        return $person_user_id;
    }

    public function addQrCodeOtherAnimal($data) {
        if ($data['qr_code_id']) {
            $insert_data['qr_code_id'] = $data['qr_code_id'];
        }
        if ($data['name']) {
            $insert_data['name'] = $data['name'];
        }
        if ($data['color']) {
            $insert_data['color'] = $data['color'];
        }
        if ($data['description']) {
            $insert_data['description'] = $data['description'];
        }
        if ($data['mobile_no']) {
            $insert_data['mobile_no'] = $data['mobile_no'];
        }
        if ($data['user_id']) {
            $insert_data['parent_user_id'] = $data['user_id'];
        }
        if ($data['image']) {
            $insert_data['image'] = $data['image'];
            $insert_data['image_path'] = $data['image_path'];
        }
        // 7-feb-2023
        if ($data['date_of_birth']) {
            $insert_data['date_of_birth'] = $data['date_of_birth'];
        }
        if ($data['age']) {
            $insert_data['age'] = $data['age'];
        }
        if ($data['identification_mark']) {
            $insert_data['identification_mark'] = $data['identification_mark'];
        }
        if ($data['vaccination_name']) {
            $insert_data['vaccination_name'] = $data['vaccination_name'];
        }
        if ($data['vaccination_date']) {
            $insert_data['vaccination_date'] = $data['vaccination_date'];
        }
        if ($data['allergy']) {
            $insert_data['allergy'] = $data['allergy'];
        }
        if ($data['surgery']) {
            $insert_data['surgery'] = $data['surgery'];
        }
        if ($data['medication']) {
            $insert_data['medication'] = $data['medication'];
        }
        if ($data['medical_condition']) {
            $insert_data['medical_condition'] = $data['medical_condition'];
        }
        if ($data['mating_cycle']) {
            $insert_data['mating_cycle'] = $data['mating_cycle'];
        }
        if ($data['location']) {
            $insert_data['location'] = $data['location'];
        }
        if ($data['lat']) {
            $insert_data['lat'] = $data['lat'];
        }
        if ($data['long']) {
            $insert_data['long'] = $data['long'];
        }
        $insert_data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('qr_animal', $insert_data);
    }

    public function addQrCodeOtherThings($data) {
        if ($data['qr_code_id']) {
            $insert_data['qr_code_id'] = $data['qr_code_id'];
        }
        if ($data['name']) {
            $insert_data['name'] = $data['name'];
        }
        if ($data['device_name']) {
            $insert_data['device_name'] = $data['device_name'];
        }
        if ($data['model_number']) {
            $insert_data['model_number'] = $data['model_number'];
        }
        if ($data['serial_number']) {
            $insert_data['serial_number'] = $data['serial_number'];
        }
        if ($data['color']) {
            $insert_data['color'] = $data['color'];
        }
        if ($data['description']) {
            $insert_data['description'] = $data['description'];
        }
        if ($data['mobile_no']) {
            $insert_data['mobile_no'] = $data['mobile_no'];
        }
        if ($data['user_id']) {
            $insert_data['parent_user_id'] = $data['user_id'];
        }
        if ($data['image']) {
            $insert_data['image'] = $data['image'];
            $insert_data['image_path'] = $data['image_path'];
        }
        if ($data['location']) {
            $insert_data['location'] = $data['location'];
        }
        if ($data['lat']) {
            $insert_data['lat'] = $data['lat'];
        }
        if ($data['long']) {
            $insert_data['long'] = $data['long'];
        }
        $insert_data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('qr_things', $insert_data);
    }

    public function addPersonEmergencyContact($data) {

        $user_id = $data['user_id'];
        $person_user_id = $data['person_user_id'];
        if (isset($data['emergency_contact'])) {
            $contact = json_decode($data['emergency_contact']);
            foreach ($contact as $k => $row) {
                $first_name = null;
                $last_name = null;
                if ($row->delete == 'true' || $row->delete == true) {
                    $is_deleted = '1';
                } else {
                    $is_deleted = '0';
                }
                if ($row->emergency_user_id == '0') {
                    if (preg_match('/\s/', $row->name)) {
                        $arr = explode(' ', $row->name);
                        $first_name = $arr['0'];
                        $last_name = $arr['1'];
                    } else {
                        $first_name = $row->name;
                        $last_name = '';
                    }
                }
                $this->db->select('users.id, users.mobile_no, users.is_deleted');
                $this->db->from('users');
                $this->db->where('mobile_no', $row->mobile_no);
                $this->db->where('is_deleted', '0');
                $q = $this->db->get();
                $users_res = $q->row_array();

                if ($users_res) {
                    $emergency_user_id = $users_res['id'];
                    $this->db->select('emergency_contacts.id, emergency_contacts.is_deleted');
                    $this->db->from('emergency_contacts');
                    $this->db->where('user_id', $person_user_id);
                    $this->db->where('emergency_user_id', $emergency_user_id);
                    $this->db->where('is_deleted', '0');
                    $q = $this->db->get();
                    $users_res = $q->row_array();
                     if ($q->num_rows() > 0) {
                        $update_emergency_contacts = array(
                            'name' => $row->name,
                            'serial_no' => $row->serial_no,
                            'is_deleted' => $is_deleted
                        );
                        $this->db->where('emergency_user_id', $emergency_user_id);
                        $this->db->where('user_id', $person_user_id);
                        $this->db->where('is_deleted', '0');
                        $this->db->update('emergency_contacts', $update_emergency_contacts);
                     } else {
                        $insert_data_emergency_contacts = array(
                            'user_id' => $person_user_id,
                            'emergency_user_id' => $emergency_user_id,
                            'serial_no' => $row->serial_no,
                            'name' => $row->name
                        );
                        $this->db->insert('emergency_contacts', $insert_data_emergency_contacts);
                    }
                } else {
                    $insert_data_users = array(
                        'first_name' => $row->name,
                        'last_name' => $last_name,
                        'mobile_no' => $row->mobile_no,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('users', $insert_data_users);
                    $emergency_user_id = $this->db->insert_id();

                    $insert_data_emergency_contacts = array(
                        'user_id' => $person_user_id,
                        'emergency_user_id' => $emergency_user_id,
                        'serial_no' => $row->serial_no,
                        'name' => $row->name
                    );
                    $this->db->insert('emergency_contacts', $insert_data_emergency_contacts);
                    $this->db->insert_id();
                }
            }
        }
    }

    public function getQrcodeDetail($qr_code) {
        $this->db->select('id, user_id, code, type, type_title, code_for, missing_status, is_deleted, created_at');
	    $this->db->where('is_deleted', '0');
	    $this->db->where('code', $qr_code);
	    $this->db->from('qr_code');
	    $res = $this->db->get();
		return $res->row_array();
    }

    public function getLinkedQrcodeByUserid($user_id) {

        $this->db->select('id, user_id, code, type, type_title, code_for, missing_status, is_deleted, created_at');
        $this->db->where('is_deleted', '0');
        $this->db->where('user_id', $user_id);
        //parent_qr_id
        $this->db->where('qr_code.parent_qr_id IS NULL', NULL, FALSE);
        $this->db->order_by('qr_code.id', 'desc');
        $this->db->from('qr_code');
        $res = $this->db->get();
        $qr_code_result = $res->result_array();
        $base_url = str_replace("/index.php/", "", base_url());
        if (!empty($qr_code_result)) {
            foreach ($qr_code_result as $k => $row) {
                if ($row['type'] == "1" && $row['code_for'] == "1") {
                    $qr_code_result[$k]['type_title'] = "Self";
                } else if ($row['type'] == "1" && $row['code_for'] == "2") {
                    $qr_code_result[$k]['type_title'] = "Person";
                } else if ($row['type'] == "2") {
                    $qr_code_result[$k]['type_title'] = "Pet";
                } else if ($row['type'] == "3") {
                    $qr_code_result[$k]['type_title'] = "Things";
                }

                if ($row['type'] == '1') {
                   
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_person.id, qr_person.qr_code_id, qr_person.user_id, qr_person.first_name, qr_person.last_name, qr_person.email, qr_person.image, qr_person.image_path, qr_person.mobile_no, qr_person.email, qr_person.blood_group_id, qr_person.is_deleted, qr_person.created_at, blood_group.title as blood_group  ');
                    $this->db->from('qr_person');
                    $this->db->join('blood_group', 'blood_group.id = qr_person.blood_group_id', 'left');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['first_name'] = $row_array_qr_person_res['first_name'];
                        $qr_code_result[$k]['last_name'] = $row_array_qr_person_res['last_name'];
                        $qr_code_result[$k]['email'] = $row_array_qr_person_res['email'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $qr_code_result[$k]['blood_group'] = $row_array_qr_person_res['blood_group'];
                        $qr_code_result[$k]['image'] = $row_array_qr_person_res['image'];
                        $qr_code_result[$k]['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . 'uploads' . $row_array_qr_person_res['image_path'] : null;

                        $user_id = $row_array_qr_person_res['user_id'];
                        $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted, users.mobile_no ');
                        $this->db->from('emergency_contacts');
                        $this->db->join('users', 'users.id = emergency_contacts.emergency_user_id', 'left');
                        // $this->db->where('users.from_bulk', '3');
                        $this->db->where('emergency_contacts.user_id', $user_id);
                        $this->db->order_by('emergency_contacts.serial_no', 'ASC');
                        $q = $this->db->get();
                        $result_array_emergency_contacts = $q->result_array();
                       
                        $qr_code_result[$k]['emergency_contacts'] = $result_array_emergency_contacts;
                    }
                }
                if ($row['type'] == '2') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_animal.id, qr_animal.qr_code_id, qr_animal.name, qr_animal.image, qr_animal.image_path, qr_animal.color, qr_animal.description, qr_animal.mobile_no, qr_animal.is_deleted, qr_animal.created_at, qr_animal.date_of_birth, qr_animal.age, qr_animal.identification_mark, qr_animal.vaccination_name, qr_animal.vaccination_date, qr_animal.allergy, qr_animal.surgery, qr_animal.medication, qr_animal.medical_condition, qr_animal.mating_cycle');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['name'] = $row_array_qr_person_res['name'];
                        $qr_code_result[$k]['image'] = $row_array_qr_person_res['image'];
                        if ($row_array_qr_person_res['image_path'] != null) {
                            $qr_code_result[$k]['image_path'] = GetProfileImagePath($row_array_qr_person_res['image_path']);
                        } else {
                            $qr_code_result[$k]['image_path'] = null;
                        }
                        $qr_code_result[$k]['color'] = $row_array_qr_person_res['color'];
                        $qr_code_result[$k]['description'] = $row_array_qr_person_res['description'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $qr_code_result[$k]['date_of_birth'] = $row_array_qr_person_res['date_of_birth'];
                        $qr_code_result[$k]['age'] = $row_array_qr_person_res['age'];
                        $qr_code_result[$k]['identification_mark'] = $row_array_qr_person_res['identification_mark'];
                        $qr_code_result[$k]['vaccination_name'] = $row_array_qr_person_res['vaccination_name'];
                        $qr_code_result[$k]['vaccination_date'] = $row_array_qr_person_res['vaccination_date'];
                        $qr_code_result[$k]['allergy'] = $row_array_qr_person_res['allergy'];
                        $qr_code_result[$k]['surgery'] = $row_array_qr_person_res['surgery'];
                        $qr_code_result[$k]['medication'] = $row_array_qr_person_res['medication'];
                        $qr_code_result[$k]['medical_condition'] = $row_array_qr_person_res['medical_condition'];
                        $qr_code_result[$k]['mating_cycle'] = $row_array_qr_person_res['mating_cycle'];
                    }
                }

                if ($row['type'] == '3') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_things.id, qr_things.qr_code_id, qr_things.name, qr_things.device_name, qr_things.model_number, qr_things.serial_number, qr_things.color, qr_things.description, qr_things.mobile_no, qr_things.image, qr_things.image_path, qr_things.is_deleted, qr_things.created_at ');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['name'] = $row_array_qr_person_res['name'];
                        $qr_code_result[$k]['device_name'] = $row_array_qr_person_res['device_name'];
                        $qr_code_result[$k]['model_number'] = $row_array_qr_person_res['model_number'];
                        $qr_code_result[$k]['serial_number'] = $row_array_qr_person_res['serial_number'];
                        $qr_code_result[$k]['color'] = $row_array_qr_person_res['color'];
                        $qr_code_result[$k]['image'] = $row_array_qr_person_res['image'];
                        $qr_code_result[$k]['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $qr_code_result[$k]['description'] = $row_array_qr_person_res['description'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                    }
                }
                
                if ($row['type'] == "1" && $row['code_for'] == "1") {
                    $user_id = $row['user_id'];
                    $this->db->select('users.id,  users.first_name, users.last_name, users.email,  users.profile_image , users.profile_image_thumb, users.mobile_no,  users.blood_group, users.is_deleted, users.created_at  ,users.blood_group,  blood_group.title as blood_group ');
                    $this->db->from('users');
                    $this->db->join('blood_group', 'blood_group.id = users.blood_group', 'left');
                    $this->db->where('users.id', $user_id);
                    $q = $this->db->get();
                    $row_array_users_res = $q->row_array();
                    if ($row_array_users_res) {
                        $qr_code_result[$k]['first_name'] = $row_array_users_res['first_name'];
                        $qr_code_result[$k]['last_name'] = $row_array_users_res['last_name'];
                        $qr_code_result[$k]['email'] = $row_array_users_res['email'];
                        $qr_code_result[$k]['blood_group'] = $row_array_users_res['blood_group'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_users_res['mobile_no'];
                        $qr_code_result[$k]['profile_image'] = $row_array_users_res['profile_image'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image'] : null;
                        $qr_code_result[$k]['profile_image_thumb'] = $row_array_users_res['profile_image_thumb'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image_thumb'] : null;
                    }
                }
            }
        }
        return $qr_code_result;
    }

    public function getQrCodeById($id = '') {
        $base_url = str_replace("/index.php/", "", base_url());
        if ($id != "") {
            $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.type, qr_code.type_title, qr_code.code_for, qr_code.missing_status,  qr_code.additional_information, qr_code.is_deleted, qr_code.created_at, users.first_name, users.last_name, users.mobile_no');
            $this->db->join('users', 'users.id = qr_code.user_id', 'left');
            $this->db->from('qr_code');
            $this->db->where('qr_code.id', $id);
            $q = $this->db->get();
            $row_array_res = $q->row_array();

            if ($row_array_res) {

                $qr_code_type = $row_array_res['type'];
                if ($row_array_res['type'] == '1') {
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_person.id, qr_person.qr_code_id, qr_person.user_id, qr_person.first_name, qr_person.last_name, qr_person.email, qr_person.image, qr_person.image_path, qr_person.mobile_no, qr_person.blood_group_id, qr_person.is_deleted, qr_person.created_at, blood_group.title as blood_group  , qr_person.location,  qr_person.lat,  qr_person.long ');
                    $this->db->from('qr_person');
                    $this->db->join('blood_group', 'blood_group.id = qr_person.blood_group_id', 'left');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();

                    if ($row_array_qr_person_res) {
                        $row_array_res['first_name'] = $row_array_qr_person_res['first_name'];
                        $row_array_res['last_name'] = $row_array_qr_person_res['last_name'];
                        $row_array_res['email'] = $row_array_qr_person_res['email'];
                        $row_array_res['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $row_array_res['blood_group'] = $row_array_qr_person_res['blood_group'];
                        $row_array_res['image'] = $row_array_qr_person_res['image'];
                        if ($row_array_qr_person_res['image_path'] != null) {
                            $row_array_res['image_path'] = GetProfileImagePath($row_array_qr_person_res['image_path']);
                        } else {
                            $row_array_res['image_path'] = DefaultProfileImage();
                        }
                        $row_array_res['location'] = $row_array_qr_person_res['location'];
                        $row_array_res['lat'] = $row_array_qr_person_res['lat'];
                        $row_array_res['long'] = $row_array_qr_person_res['long'];

                        $user_id = $row_array_qr_person_res['user_id'];

                        $this->db->select('qr_emergency_contacts.id, qr_emergency_contacts.qr_code_id, qr_emergency_contacts.qr_type, qr_emergency_contacts.serial_no, qr_emergency_contacts.mobile_no, qr_emergency_contacts.name, qr_emergency_contacts.is_deleted ');
                        $this->db->from('qr_emergency_contacts');
                        $this->db->where('qr_emergency_contacts.qr_code_id', $qr_code_id);
                        $this->db->where('qr_emergency_contacts.qr_type', $qr_code_type);
                        $this->db->where('qr_emergency_contacts.is_deleted', '0');
                        $this->db->order_by('qr_emergency_contacts.serial_no', 'ASC');
                        $q = $this->db->get();

                        $result_array_emergency_contacts = $q->result_array();
                        $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                    }
                }

                if ($row_array_res['type'] == '2') {
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_animal.id, qr_animal.qr_code_id, qr_animal.name, qr_animal.image, qr_animal.image_path, qr_animal.color, qr_animal.description, qr_animal.mobile_no, qr_animal.is_deleted, qr_animal.created_at , qr_animal.date_of_birth, qr_animal.age, qr_animal.identification_mark, qr_animal.vaccination_name, qr_animal.vaccination_date, qr_animal.allergy, qr_animal.surgery, qr_animal.medication, qr_animal.medical_condition, qr_animal.mating_cycle , qr_animal.location,  qr_animal.lat,  qr_animal.long');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $this->db->where('qr_animal.is_deleted', '0');
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $row_array_res['additional_information'] = $row_array_res['additional_information'];
                        $row_array_res['name'] = $row_array_qr_person_res['name'];
                        $row_array_res['image'] = $row_array_qr_person_res['image'];
                        $row_array_res['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $row_array_res['color'] = $row_array_qr_person_res['color'];
                        $row_array_res['description'] = $row_array_qr_person_res['description'];
                        $row_array_res['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $row_array_res['date_of_birth'] = $row_array_qr_person_res['date_of_birth'];
                        $row_array_res['age'] = $row_array_qr_person_res['age'];
                        $row_array_res['identification_mark'] = $row_array_qr_person_res['identification_mark'];
                        $row_array_res['vaccination_name'] = $row_array_qr_person_res['vaccination_name'];
                        $row_array_res['vaccination_date'] = $row_array_qr_person_res['vaccination_date'];
                        $row_array_res['allergy'] = $row_array_qr_person_res['allergy'];
                        $row_array_res['surgery'] = $row_array_qr_person_res['surgery'];
                        $row_array_res['medication'] = $row_array_qr_person_res['medication'];
                        $row_array_res['medical_condition'] = $row_array_qr_person_res['medical_condition'];
                        $row_array_res['mating_cycle'] = $row_array_qr_person_res['mating_cycle'];
                        $row_array_res['location'] = $row_array_qr_person_res['location'];
                        $row_array_res['lat'] = $row_array_qr_person_res['lat'];
                        $row_array_res['long'] = $row_array_qr_person_res['long'];

                        $this->db->select('qr_emergency_contacts.id, qr_emergency_contacts.qr_code_id, qr_emergency_contacts.qr_type, qr_emergency_contacts.serial_no, qr_emergency_contacts.mobile_no, qr_emergency_contacts.name, qr_emergency_contacts.is_deleted ');
                        $this->db->from('qr_emergency_contacts');
                        $this->db->where('qr_emergency_contacts.qr_code_id', $qr_code_id);
                        $this->db->where('qr_emergency_contacts.qr_type', $qr_code_type);
                        $this->db->where('qr_emergency_contacts.is_deleted', '0');
                        $this->db->order_by('qr_emergency_contacts.serial_no', 'ASC');
                        $q = $this->db->get();

                        $result_array_emergency_contacts = $q->result_array();
                        $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                    }
                }

                if ($row_array_res['type'] == '3') {
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_things.id, qr_things.qr_code_id, qr_things.name, qr_things.device_name, qr_things.model_number, qr_things.serial_number, qr_things.color, qr_things.description, qr_things.mobile_no, qr_things.image, qr_things.image_path, qr_things.is_deleted, qr_things.created_at,  qr_things.location,  qr_things.lat,  qr_things.long ');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $this->db->where('qr_things.is_deleted', '0');
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $row_array_res['name'] = $row_array_qr_person_res['name'];
                        $row_array_res['device_name'] = $row_array_qr_person_res['device_name'];
                        $row_array_res['model_number'] = $row_array_qr_person_res['model_number'];
                        $row_array_res['serial_number'] = $row_array_qr_person_res['serial_number'];
                        $row_array_res['color'] = $row_array_qr_person_res['color'];
                        $row_array_res['image'] = $row_array_qr_person_res['image'];
                        $row_array_res['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $row_array_res['description'] = $row_array_qr_person_res['description'];
                        $row_array_res['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $row_array_res['location'] = $row_array_qr_person_res['location'];
                        $row_array_res['lat'] = $row_array_qr_person_res['lat'];
                        $row_array_res['long'] = $row_array_qr_person_res['long'];

                        $this->db->select('qr_emergency_contacts.id, qr_emergency_contacts.qr_code_id, qr_emergency_contacts.qr_type, qr_emergency_contacts.serial_no, qr_emergency_contacts.mobile_no, qr_emergency_contacts.name, qr_emergency_contacts.is_deleted ');
                        $this->db->from('qr_emergency_contacts');
                        $this->db->where('qr_emergency_contacts.qr_code_id', $qr_code_id);
                        $this->db->where('qr_emergency_contacts.qr_type', $qr_code_type);
                        $this->db->where('qr_emergency_contacts.is_deleted', '0');
                        $this->db->order_by('qr_emergency_contacts.serial_no', 'ASC');
                        $q = $this->db->get();

                        $result_array_emergency_contacts = $q->result_array();
                        $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                    }
                }
                
                if ($row_array_res['type'] == "1" && $row_array_res['code_for'] == "1") {
                    $user_id = $row_array_res['user_id'];
                    $this->db->select('users.id,  users.first_name, users.last_name, users.email,  users.profile_image , users.profile_image_thumb, users.mobile_no,  users.blood_group, users.is_deleted, users.created_at  ,users.blood_group,  blood_group.title as blood_group ');
                    $this->db->from('users');
                    $this->db->join('blood_group', 'blood_group.id = users.blood_group', 'left');
                    $this->db->where('users.id', $user_id);
                    $q = $this->db->get();
                    $row_array_users_res = $q->row_array();

                    
                    if ($row_array_users_res) {
                        $row_array_res['first_name'] = $row_array_users_res['first_name'];
                        $row_array_res['last_name'] = $row_array_users_res['last_name'];
                        $row_array_res['email'] = $row_array_users_res['email'];
                        $row_array_res['blood_group'] = $row_array_users_res['blood_group'];
                        $row_array_res['mobile_no'] = $row_array_users_res['mobile_no'];
                        $profile_image = "";
                        if ($row_array_users_res['profile_image'] != null) {
                            $profile_image = GetProfileImagePath($row_array_users_res['profile_image']);
                        } else {
                            $profile_image = DefaultProfileImage();
                        }
                        // $row_array_res['profile_image'] = $profile_image;
                        $row_array_res['image'] = $profile_image;
                        // $row_array_res['profile_image_thumb'] = $row_array_users_res['profile_image_thumb'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image_thumb'] : null;
                        $row_array_res['image_path'] = $row_array_users_res['profile_image_thumb'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image_thumb'] : null;
                        $row_array_res['blood_group'] = $row_array_users_res['blood_group'];
                    }
                    
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_self.id, qr_self.qr_code_id, qr_self.user_id, qr_self.is_deleted, qr_self.created_at, qr_self.location, qr_self.lat, qr_self.long ');
                    $this->db->from('qr_self');
                    $this->db->where('qr_self.user_id', $user_id);
                    $this->db->where('qr_self.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_self_res = $q->row_array();
                    if ($row_array_qr_self_res) {
                        $row_array_res['location'] = $row_array_qr_self_res['location'];
                        $row_array_res['lat'] = $row_array_qr_self_res['lat'];
                        $row_array_res['long'] = $row_array_qr_self_res['long'];
                    } else {
                        $row_array_res['location'] = '';
                        $row_array_res['lat'] ='';
                        $row_array_res['long'] ='';
                    }
                    
                    $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted, users.mobile_no ');
                    $this->db->from('emergency_contacts');
                    $this->db->join('users', 'users.id = emergency_contacts.emergency_user_id', 'left');
                    $this->db->where('emergency_contacts.user_id', $user_id);
                    $this->db->where('emergency_contacts.is_deleted', 0);
                    $this->db->order_by('emergency_contacts.serial_no', 'ASC');
                    $q = $this->db->get();

                    $result_array_emergency_contacts = $q->result_array();
                    $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                }

                // getQrCodeChild
                $row_array_res['qr_code_child'] = $this->getQrCodeChild($id);
            }
            return $row_array_res;
        } else {
            return array();
        }
    }

    public function verifyOTPqrcode($request) {
        $select_data = "*";
        $table = "user_otp";
        $this->db->select($select_data);
//            $this->db->join('users', 'users.id = user_otp.user_id', 'left');
//            $this->db->where('ref_no', $request['otp_ref_no']);
        $this->db->where('otp', $request['otp']);
//            $this->db->where('user_type', '3');
//            $this->db->where('email !=', '');
//            $this->db->where('is_deleted', '0');
        $query = $this->db->get($table);
        $result = $query->result();
        if (count($result) > 0) {
            $otp = $result[0]->otp;
            if ($otp == $request['otp']) {
                $date1 = $result[0]->created_on;
                $date2 = date('Y-m-d H:i:s');
                $diff = abs(strtotime($date2) - strtotime($date1));
                $date = new DateTime($date1);
                $date2 = new DateTime($date2);
                $diff = $date2->getTimestamp() - $date->getTimestamp();
                if ($diff <= 150) {
                    $output = array('status' => true, 'user_id' => '0', 'auth_key' => '0');
                    return $output;
                } else {
                    $output = array('status' => false, 'user_id' => '0', 'auth_key' => '0');
                    return $output;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function changeMissingStatus($data) {
        date_default_timezone_set('Asia/Kolkata');
        if ($data['qr_code'] && $data['missing_status'] != "") {
            $qr_code = $data['qr_code'];
            $missing_status = $data['missing_status'];
            $update_qr_code = array(
                'missing_status' => $missing_status,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('code', $qr_code);
            $this->db->where('is_deleted', '0');
            $this->db->update('qr_code', $update_qr_code);
            // send notification
            if ($missing_status == '2') {
                $res = $this->getQrcodeDetail($qr_code);
                if (!empty($res) && $res['id'] != null) {
                    $this->sendAdminNotificationQrCodeMissingAlert($res['id']);
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function addmissingalert($data) {
        date_default_timezone_set('Asia/Kolkata');
        $latitude = null;
        $longitude = null;
        $userIP = $_SERVER['REMOTE_ADDR'];
        if ($userIP != "") {
            $url = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $userIP);
            $getInfo = json_decode($url);
            $latitude = $getInfo->geoplugin_latitude;
            $longitude = $getInfo->geoplugin_longitude;
        }
        $insert_data = array(
            'qr_code_id' => isset($data['code_id']) ? $data['code_id'] : null,
            'first_name' => isset($data['first_name']) ? $data['first_name'] : null,
            'last_name' => isset($data['last_name']) ? $data['last_name'] : null,
            'mobile_no' => isset($data['mobile_number']) ? $data['mobile_number'] : null,
            // 'latitude' => $latitude ? $latitude : null,
            // 'longitude' => $longitude ? $longitude : null,
            'latitude' => isset($data['latitude']) && $data['latitude'] != "" ? $data['latitude'] : null,
            'longitude' => isset($data['longitude']) && $data['longitude'] != "" ? $data['longitude'] : null,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('qr_code_missing_alert', $insert_data);
        return $this->db->insert_id();
    }

    public function addQrCodeScanAlert($data) {
        date_default_timezone_set('Asia/Kolkata');
        $insert_data = array(
            'qr_code_id' => isset($data['code_id']) ? $data['code_id'] : null,
            'latitude' => isset($data['latitude']) && $data['latitude'] != "" ? $data['latitude'] : null,
            'longitude' => isset($data['longitude']) && $data['longitude'] != "" ? $data['longitude'] : null,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('qr_code_scan_alert', $insert_data);
        return $this->db->insert_id();
    }

    // notification 
    public function sendNotificationMessageOnesignal($message) {
        $msg = $message;
        $content = array(
            "en" => $msg
        );
        $headings = array(
            "en" => "Captain INDIA",
        );
        $hashes_array = array();
        $url = '';
        $fields = array(
            // 'app_id' => "67ec0441-3085-4e29-8f11-ebc163cf0cc2", //live
            'app_id' => "8ad390eb-06a8-4c5b-857a-be72e9e8f1f7",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'headings' => $headings,
            'contents' => $content,
            "url" => $url,
            // 'web_buttons' => $hashes_array
        );
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            // 'Authorization: Basic ZjNkY2M5YjktOTllNC00ZTdkLWFlY2MtYzAxYTdmMGY4MGFl' //live
            // 'Authorization: Basic ZTYxMzMzYTItYTM1OS00Y2EyLTk5NWUtM2RkNDAxODcwNjU0'
            'Authorization: Basic MjI3YmI3NTEtOWRjNy00OWIwLWEyZTItNTNmZDc1NmRjMzNk' // uat
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    public function saveNotificationMessage($save_notification_arr, $table_name) {
        $this->db->insert($table_name, $save_notification_arr);
        return $this->db->insert_id();
    }

    // 14-feb-2023
    public function checkQrCodeExistsById($qr_code_id) {
        if ($qr_code_id) {
            $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.type, qr_code.type_title, qr_code.code_for, qr_code.missing_status, qr_code.code_image, qr_code.code_image_path, is_deleted, qr_code.created_at');
            $this->db->from('qr_code');
            $this->db->where('qr_code.id', $qr_code_id);
            $result = $this->db->get();
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function checkQrCodeUsedById($qr_code_id) {
        if ($qr_code_id) {
            $this->db->select('qr_code.id');
            $this->db->from('qr_code');
            $this->db->where('qr_code.id', $qr_code_id);
            $this->db->where('qr_code.user_id IS NOT NULL', NULL, FALSE);
            $result = $this->db->get();
            return $result->num_rows();
        } else {
            return 0;
        }
    }

    // 14-feb-2023
    public function deleteQrCode($data) {
        if ($data['qr_code_id']) {
            $qr_code = $this->checkQrCodeExistsById($data['qr_code_id']);
            if ($qr_code) {
                $qr_id = $data['qr_code_id'];
                $update_qr_code = array(
                    'is_deleted' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $qr_id);
                $this->db->where('is_deleted', '0');
                $this->db->update('qr_code', $update_qr_code);

                if ($this->db->affected_rows() > 0) {
                    $type_title = null;
                    $qr_code_type = $qr_code['type'];
                    $qr_code = $qr_code['code'];
                    if ($qr_code_type == '1') {
                        $delete_qr_person_data['updated_at'] = date('Y-m-d H:i:s');
                        $delete_qr_person_data['is_deleted'] = '1';
                        $this->db->where('qr_code_id', $data['qr_code_id']);
                        $this->db->update('qr_person', $delete_qr_person_data);
                    } else if ($qr_code_type == '2') {
                        $delete_qr_animal_data['updated_at'] = date('Y-m-d H:i:s');
                        $delete_qr_animal_data['is_deleted'] = '1';
                        $this->db->where('qr_code_id', $data['qr_code_id']);
                        $this->db->update('qr_animal', $delete_qr_animal_data);
                    } else if ($qr_code_type == '3') {
                        $delete_qr_things_data['updated_at'] = date('Y-m-d H:i:s');
                        $delete_qr_things_data['is_deleted'] = '1';
                        $this->db->where('qr_code_id', $data['qr_code_id']);
                        $this->db->update('qr_things', $delete_qr_things_data);
                    }
                    $insert_data = array(
                        'code' => $qr_code,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('qr_code', $insert_data);
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function getQrCodeTypeNameByType($user_id, $post_qr_code_type) {
        $qr_code_type = null;
        $qr_code_for = null;
        if ($post_qr_code_type == '1') {
            $qr_code_type = '1';
            $qr_code_for = '2';
        } else if ($post_qr_code_type == '2') {
            $qr_code_type = '2';
            $qr_code_for = '2';
        } else if ($post_qr_code_type == '3') {
            $qr_code_type = '3';
            $qr_code_for = '2';
        } else if ($post_qr_code_type == '4') {
            $qr_code_type = '1';
            $qr_code_for = '1';
        }

        $this->db->select('id, user_id, code, type, type_title, code_for ');
        $this->db->where('qr_code.is_deleted', '0');
        $this->db->where('qr_code.user_id', $user_id);
        $this->db->where('qr_code.type', $qr_code_type);
        $this->db->where('qr_code.code_for', $qr_code_for);
        $this->db->order_by('qr_code.id', 'desc');
        $this->db->from('qr_code');
        $res = $this->db->get();
        $qr_code_result = $res->result_array();
        if (!empty($qr_code_result)) {
            foreach ($qr_code_result as $k => $row) {
                if ($row['type'] == "1" && $row['code_for'] == "1") {
                    $qr_code_result[$k]['type_title'] = "Self";
                } else if ($row['type'] == "1" && $row['code_for'] == "2") {
                    $qr_code_result[$k]['type_title'] = "Person";
                } else if ($row['type'] == "2") {
                    $qr_code_result[$k]['type_title'] = "Pet";
                } else if ($row['type'] == "3") {
                    $qr_code_result[$k]['type_title'] = "Things";
                }
                if ($row['type'] == '1') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_person.id, qr_person.qr_code_id, qr_person.user_id, qr_person.first_name, qr_person.last_name, qr_person.is_deleted, qr_person.created_at,  ');
                    $this->db->from('qr_person');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['first_name'] = $row_array_qr_person_res['first_name'];
                        $qr_code_result[$k]['last_name'] = $row_array_qr_person_res['last_name'];
                    }
                }
                if ($row['type'] == '2') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_animal.id, qr_animal.qr_code_id, qr_animal.name, qr_animal.is_deleted, qr_animal.created_at');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['name'] = $row_array_qr_person_res['name'];
                    }
                }
                if ($row['type'] == '3') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_things.id, qr_things.qr_code_id, qr_things.name,   qr_things.is_deleted, qr_things.created_at ');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['name'] = $row_array_qr_person_res['name'];
                    }
                }

                if ($row['type'] == "1" && $row['code_for'] == "1") {
                    $user_id = $row['user_id'];
                    $this->db->select('users.id,  users.first_name, users.last_name, users.is_deleted, users.created_at   ');
                    $this->db->from('users');
                    $this->db->where('users.id', $user_id);
                    $q = $this->db->get();
                    $row_array_users_res = $q->row_array();
                    if ($row_array_users_res) {
                        $qr_code_result[$k]['first_name'] = $row_array_users_res['first_name'];
                        $qr_code_result[$k]['last_name'] = $row_array_users_res['last_name'];
                    }
                }
            }
        }
        return $qr_code_result;
    }

    public function updateQrCode($data) {
        if ($data['qr_code_id']) {
            $qr_code = $this->checkQrCodeExistsById($data['qr_code_id']);
            if ($qr_code) {
                $qr_id = $data['qr_code_id'];
                $qr_code_type = $qr_code['type'];
                $qr_code_code_for = $qr_code['code_for'];

                // 2-july-2023
                $update_qr_code_value['additional_information'] = $data['additional_information'];
                $this->db->where('id', $data['qr_code_id']);
                $this->db->update('qr_code', $update_qr_code_value);
                // echo $this->db->last_query();

                $data['type'] = $qr_code['type'];
                if ($qr_code_code_for == '2') {
                if ($qr_code_type == '1') {
                    $this->updateQrCodeOtherPerson($data);
                    $this->addQrCodeEmergencyContact($data);
                } else if ($qr_code_type == '2') {
                    $this->updateQrCodeOtherAnimal($data);
                    $this->addQrCodeEmergencyContact($data);
                } else if ($qr_code_type == '3') {
                    $this->updateQrCodeOtherThings($data);
                    $this->addQrCodeEmergencyContact($data);
                }
                }
                if ($qr_code_type == '1' && $qr_code_code_for == '1') {
                    $this->updateQrCodeSelf($data);
                    $this->addSelfEmergencyContact($data);
                }
                return true;
            }
        } else {
            return false;
        }
    }

    public function updateQrCodeOtherPerson($data) {
        $update_qr_person_data = array();
        $insert_user_data = array();
        if (isset($data['first_name'])) {
            $update_qr_person_data['first_name'] = $data['first_name'];
            $insert_user_data['first_name'] = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $update_qr_person_data['last_name'] = $data['last_name'];
            $insert_user_data['last_name'] = $data['last_name'];
        }
        if (isset($data['mobile_no'])) {
            $update_qr_person_data['mobile_no'] = $data['mobile_no'];
            $insert_user_data['mobile_no'] = $data['mobile_no'];
        }
        if (isset($data['email'])) {
            $update_qr_person_data['email'] = $data['email'];
            $insert_user_data['email'] = $data['email'];
        }
        if (isset($data['blood_group_id'])) {
            $update_qr_person_data['blood_group_id'] = $data['blood_group_id'];
            $insert_user_data['blood_group'] = $data['blood_group_id'];
        }
        if (isset($data['image'])) {
            $update_qr_person_data['image'] = $data['image'];
            $update_qr_person_data['image_path'] = $data['image_path'];
            $insert_user_data['profile_image'] = $data['image_path'];
        }
        if (isset($data['location'])) {
            $update_qr_person_data['location'] = $data['location'];
        }
        if (isset($data['lat'])) {
            $update_qr_person_data['lat'] = $data['lat'];
        }
        if (isset($data['long'])) {
            $update_qr_person_data['long'] = $data['long'];
        }
        
        $insert_user_data['from_bulk'] = '3';
        $insert_user_data['created_at'] = date('Y-m-d H:i:s');
        $person_user_id = null;
        $insert_user_id = null;
        if (isset($data['mobile_no']) && $data['mobile_no'] != "") {
            $this->db->where('users.mobile_no', $data['mobile_no']);
            $this->db->where('users.status', "1");
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
            $check_res_users = $q->row_array();
            if ($check_res_users) {
                $person_user_id = $check_res_users['id'];
            } else {
                $this->db->insert('users', $insert_user_data);
                if ($this->db->insert_id()) {
                    $person_user_id = $this->db->insert_id();
                    $insert_user_id = $person_user_id;
                }
            }
        }
        if ($insert_user_id != null) {
            $delete_qr_person_data['updated_at'] = date('Y-m-d H:i:s');
            $delete_qr_person_data['is_deleted'] = '1';
            $this->db->where('qr_code_id', $data['qr_code_id']);
            $this->db->update('qr_person', $delete_qr_person_data);

            $update_qr_person_data['qr_code_id'] = $data['qr_code_id'];
            $update_qr_person_data['user_id'] = $insert_user_id;
            $update_qr_person_data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('qr_person', $update_qr_person_data);
            return $person_user_id;
        } else {
            $update_qr_person_data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('qr_code_id', $data['qr_code_id']);
            $this->db->where('is_deleted', '0');
            $this->db->update('qr_person', $update_qr_person_data);
            return $person_user_id;
        }
    }

    public function updateQrCodeOtherAnimal($data) {
        if (isset($data['qr_code_id'])) {
            $insert_data['qr_code_id'] = $data['qr_code_id'];
        }
        if (isset($data['name'])) {
            $insert_data['name'] = $data['name'];
        }
        if (isset($data['color'])) {
            $insert_data['color'] = $data['color'];
        }
        if (isset($data['description'])) {
            $insert_data['description'] = $data['description'];
        }
        if (isset($data['user_id'])) {
            $insert_data['parent_user_id'] = $data['user_id'];
        }
        if (isset($data['image'])) {
            $insert_data['image'] = $data['image'];
            $insert_data['image_path'] = $data['image_path'];
        }
        if (isset($data['date_of_birth'])) {
            $insert_data['date_of_birth'] = $data['date_of_birth'];
        }
        if (isset($data['age'])) {
            $insert_data['age'] = $data['age'];
        }
        if (isset($data['identification_mark'])) {
            $insert_data['identification_mark'] = $data['identification_mark'];
        }
        if (isset($data['vaccination_name'])) {
            $insert_data['vaccination_name'] = $data['vaccination_name'];
        }
        if (isset($data['vaccination_date'])) {
            $insert_data['vaccination_date'] = $data['vaccination_date'];
        }
        if (isset($data['allergy'])) {
            $insert_data['allergy'] = $data['allergy'];
        }
        if (isset($data['surgery'])) {
            $insert_data['surgery'] = $data['surgery'];
        }
        if (isset($data['medication'])) {
            $insert_data['medication'] = $data['medication'];
        }
        if (isset($data['medical_condition'])) {
            $insert_data['medical_condition'] = $data['medical_condition'];
        }
        if (isset($data['mating_cycle'])) {
            $insert_data['mating_cycle'] = $data['mating_cycle'];
        }
        if (isset($data['location'])) {
            $insert_data['location'] = $data['location'];
        }
        if (isset($data['lat'])) {
            $insert_data['lat'] = $data['lat'];
        }
        if (isset($data['long'])) {
            $insert_data['long'] = $data['long'];
        }
        if (isset($data['qr_code_id']) && isset($data['mobile_no'])) {
            $qr_animal = $this->getAnimalByQrCodeId($data['qr_code_id'], $data['mobile_no']);
            if (!empty($qr_animal)) {
                $insert_data['updated_at'] = date('Y-m-d H:i:s');
                $this->db->where('qr_code_id', $data['qr_code_id']);
                $this->db->where('mobile_no', $data['mobile_no']);
                $this->db->where('is_deleted', '0');
                $this->db->update('qr_animal', $insert_data);
                //   echo $this->db->last_query();
            } else {
                $delete_qr_animal_data['updated_at'] = date('Y-m-d H:i:s');
                $delete_qr_animal_data['is_deleted'] = '1';
                $this->db->where('qr_code_id', $data['qr_code_id']);
                $this->db->where('is_deleted', '0');
                $this->db->update('qr_animal', $delete_qr_animal_data);
                //   echo $this->db->last_query();
                if (isset($data['mobile_no'])) {
                    $insert_data['mobile_no'] = $data['mobile_no'];
                }
                $insert_data['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('qr_animal', $insert_data);
                //  echo $this->db->last_query();
            }
        }
    }

    public function getAnimalByQrCodeId($qr_code_id, $mobile_no = '') {
        if ($qr_code_id) {
            $this->db->select('qr_animal.id, qr_animal.qr_code_id, qr_animal.name, qr_animal.image, qr_animal.image_path, qr_animal.color, qr_animal.description, qr_animal.mobile_no, qr_animal.is_deleted, qr_animal.created_at, qr_animal.date_of_birth, qr_animal.age, qr_animal.identification_mark, qr_animal.vaccination_name, qr_animal.vaccination_date, qr_animal.allergy, qr_animal.surgery, qr_animal.medication, qr_animal.medical_condition, qr_animal.mating_cycle');
            $this->db->from('qr_animal');
            $this->db->where('qr_animal.qr_code_id', $qr_code_id);
            if ($mobile_no != '') {
                $this->db->where('qr_animal.mobile_no', $mobile_no);
            }
            $q = $this->db->get();
            $row_array_qr_animal_res = $q->row_array();
            return $row_array_qr_animal_res;
        } else {
            return array();
        }
    }

    public function updateQrCodeOtherThings($data) {
        if (isset($data['qr_code_id'])) {
            $insert_data['qr_code_id'] = $data['qr_code_id'];
        }
        if (isset($data['name'])) {
            $insert_data['name'] = $data['name'];
        }
        if (isset($data['device_name'])) {
            $insert_data['device_name'] = $data['device_name'];
        }
        if (isset($data['model_number'])) {
            $insert_data['model_number'] = $data['model_number'];
        }
        if (isset($data['serial_number'])) {
            $insert_data['serial_number'] = $data['serial_number'];
        }
        if (isset($data['color'])) {
            $insert_data['color'] = $data['color'];
        }
        if (isset($data['description'])) {
            $insert_data['description'] = $data['description'];
        }

        if (isset($data['user_id'])) {
            $insert_data['parent_user_id'] = $data['user_id'];
        }
        if (isset($data['image'])) {
            $insert_data['image'] = $data['image'];
            $insert_data['image_path'] = $data['image_path'];
        }
        if (isset($data['location'])) {
            $insert_data['location'] = $data['location'];
        }
        if (isset($data['lat'])) {
            $insert_data['lat'] = $data['lat'];
        }
        if (isset($data['long'])) {
            $insert_data['long'] = $data['long'];
        }
        if (isset($data['qr_code_id']) && isset($data['mobile_no'])) {
            $qr_animal = $this->getThingsByQrCodeId($data['qr_code_id'], $data['mobile_no']);
            if (!empty($qr_animal)) {
                $insert_data['updated_at'] = date('Y-m-d H:i:s');
                $this->db->where('qr_code_id', $data['qr_code_id']);
                $this->db->where('mobile_no', $data['mobile_no']);
                $this->db->update('qr_things', $insert_data);
            } else {
                $delete_qr_things_data['updated_at'] = date('Y-m-d H:i:s');
                $delete_qr_things_data['is_deleted'] = '1';
                $this->db->where('qr_code_id', $data['qr_code_id']);
                $this->db->update('qr_things', $delete_qr_things_data);
                if (isset($data['mobile_no'])) {
                    $insert_data['mobile_no'] = $data['mobile_no'];
                }
                $insert_data['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('qr_things', $insert_data);
            }
        }
    }

    public function getThingsByQrCodeId($qr_code_id, $mobile_no = '') {
        if ($qr_code_id) {
            $this->db->select('qr_things.id, qr_things.qr_code_id, qr_things.name, qr_things.device_name, qr_things.model_number, qr_things.serial_number, qr_things.image, qr_things.image_path, qr_things.color, qr_things.description, qr_things.mobile_no, qr_things.is_deleted, qr_things.created_at ');
            $this->db->from('qr_things');
            $this->db->where('qr_things.qr_code_id', $qr_code_id);
            if ($mobile_no != '') {
                $this->db->where('qr_things.mobile_no', $mobile_no);
            }
            $q = $this->db->get();
            $row_array_qr_things_res = $q->row_array();
            return $row_array_qr_things_res;
        } else {
            return array();
        }
    }

    public function addQrCodeEmergencyContact($data) {
        if (isset($data['emergency_contact'])) {
            $contact = json_decode($data['emergency_contact']);
            foreach ($contact as $k => $row) {
                $is_deleted = "";
                if ($row->delete == 'true' || $row->delete == true) {
                    $is_deleted = '1';
                } else {
                    $is_deleted = '0';
                }
                $name = $row->name ? $row->name : null;
                $mobile_no = $row->mobile_no ? $row->mobile_no : null;
                $serial_no = $row->serial_no ? $row->serial_no : null;
                if ($mobile_no) {
                    $this->db->select('qr_emergency_contacts.id, qr_emergency_contacts.qr_code_id, qr_emergency_contacts.qr_type, qr_emergency_contacts.mobile_no, qr_emergency_contacts.serial_no, qr_emergency_contacts.name, qr_emergency_contacts.is_deleted, qr_emergency_contacts.created_at');
                    $this->db->from('qr_emergency_contacts');
                    $this->db->where('qr_emergency_contacts.qr_code_id', $data['qr_code_id']);
                    $this->db->where('qr_emergency_contacts.qr_type', $data['type']);
                    $this->db->where('qr_emergency_contacts.mobile_no', $mobile_no);
                    $this->db->where('qr_emergency_contacts.is_deleted', '0');
                    $q = $this->db->get();
                    $row_array_qr_emergency_contacts_res = $q->row_array();

                    if ($row_array_qr_emergency_contacts_res) {

                        if ($is_deleted == '1') {
                            $update_data['updated_at'] = date('Y-m-d H:i:s');
                            $update_data['is_deleted'] = '1';
                            $update_data['name'] = $name;
                            $this->db->where('id', $row_array_qr_emergency_contacts_res['id']);
                            $this->db->update('qr_emergency_contacts', $update_data);
                        } else {
                            $update_data_qr_emergency_contacts['updated_at'] = date('Y-m-d H:i:s');
                            $update_data_qr_emergency_contacts['name'] = $name;
                            $update_data_qr_emergency_contacts['serial_no'] = $serial_no;
                            $this->db->where('id', $row_array_qr_emergency_contacts_res['id']);
                            $this->db->update('qr_emergency_contacts', $update_data_qr_emergency_contacts);
                        }
                    } else {
                        if ($is_deleted == '0') {
                            $insert_data_emergency_contacts = array(
                                'qr_code_id' => $data['qr_code_id'],
                                'qr_type' => $data['type'],
                                'mobile_no' => $mobile_no,
                                'serial_no' => $serial_no,
                                'name' => $name,
                                'created_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('qr_emergency_contacts', $insert_data_emergency_contacts);
                            $this->db->insert_id();
                        }
                    }
                }
            }
        }
    }
  
    public function addChildQrCode($qr_code_id, $child_qr_code_id, $parent_user_id) {
        if ($qr_code_id && $child_qr_code_id) {
            $qr_code = $this->checkQrCodeExistsById($qr_code_id);
            if ($qr_code) {
                $update_qr_code_data['parent_qr_id'] = $qr_code_id;
                $update_qr_code_data['user_id'] = $qr_code['user_id'];
                $update_qr_code_data['type'] = $qr_code['type'];
                $update_qr_code_data['type_title'] = $qr_code['type_title'];
                $update_qr_code_data['code_for'] = $qr_code['code_for'];
                $update_qr_code_data['missing_status'] = $qr_code['missing_status'];
                $update_qr_code_data['code_image'] = $qr_code['code_image'];
                $update_qr_code_data['code_image_path'] = $qr_code['code_image_path'];
                $update_qr_code_data['updated_at'] = date('Y-m-d H:i:s');
                $this->db->where('id', $child_qr_code_id);
                $this->db->update('qr_code', $update_qr_code_data);

                $qr_code_type = $qr_code['type'];
                if ($qr_code_type == '1') {
                    $this->copyQrCodeOtherPerson($qr_code_id, $child_qr_code_id, $parent_user_id);
                } else if ($qr_code_type == '2') {
                    $this->copyQrCodeOtherAnimal($qr_code_id, $child_qr_code_id, $parent_user_id);
                } else if ($qr_code_type == '3') {
                    $this->copyQrCodeOtherThings($qr_code_id, $child_qr_code_id, $parent_user_id);
                }
                return true;
            }
        } else {
            return 0;
        }
    }

    public function copyQrCodeOtherPerson($qr_code_id, $child_qr_code_id, $parent_user_id) {
        $insert_qr_code_data = array();
        $qr_code = $this->getPersonByQrCodeId($qr_code_id);
        if ($qr_code) {
            $insert_qr_code_data['parent_user_id'] = $parent_user_id ? $parent_user_id : null;
            $insert_qr_code_data['user_id'] = $qr_code['user_id'] ? $qr_code['user_id'] : null;
            $insert_qr_code_data['first_name'] = $qr_code['first_name'] ? $qr_code['first_name'] : null;
            $insert_qr_code_data['last_name'] = $qr_code['last_name'] ? $qr_code['last_name'] : null;
            $insert_qr_code_data['mobile_no'] = $qr_code['mobile_no'] ? $qr_code['mobile_no'] : null;
            $insert_qr_code_data['email'] = $qr_code['email'] ? $qr_code['email'] : null;
            $insert_qr_code_data['blood_group_id'] = $qr_code['blood_group_id'] ? $qr_code['blood_group_id'] : null;
            $insert_qr_code_data['image'] = $qr_code['image'] ? $qr_code['image'] : null;
            $insert_qr_code_data['image_path'] = $qr_code['image_path'] ? $qr_code['image_path'] : null;
            $insert_qr_code_data['created_at'] = date('Y-m-d H:i:s');
            $insert_qr_code_data['qr_code_id'] = $child_qr_code_id;
            $this->db->insert('qr_person', $insert_qr_code_data);
        }
    }

    public function copyQrCodeOtherAnimal($qr_code_id, $child_qr_code_id, $parent_user_id) {
        $insert_qr_code_data = array();
        $qr_code = $this->getAnimalByQrCodeId($qr_code_id);
        if ($qr_code) {
            $insert_qr_code_data['parent_user_id'] = $parent_user_id ? $parent_user_id : null;
            $insert_qr_code_data['name'] = $qr_code['name'] ? $qr_code['name'] : null;
            $insert_qr_code_data['color'] = $qr_code['color'] ? $qr_code['color'] : null;
            $insert_qr_code_data['description'] = $qr_code['description'] ? $qr_code['description'] : null;
            $insert_qr_code_data['mobile_no'] = $qr_code['mobile_no'] ? $qr_code['mobile_no'] : null;
            $insert_qr_code_data['image'] = $qr_code['image'] ? $qr_code['image'] : null;
            $insert_qr_code_data['image_path'] = $qr_code['image_path'] ? $qr_code['image_path'] : null;
            $insert_qr_code_data['date_of_birth'] = $qr_code['date_of_birth'] ? $qr_code['date_of_birth'] : null;
            $insert_qr_code_data['age'] = $qr_code['age'] ? $qr_code['age'] : null;
            $insert_qr_code_data['identification_mark'] = $qr_code['identification_mark'] ? $qr_code['identification_mark'] : null;
            $insert_qr_code_data['vaccination_name'] = $qr_code['vaccination_name'] ? $qr_code['vaccination_name'] : null;
            $insert_qr_code_data['vaccination_date'] = $qr_code['vaccination_date'] ? $qr_code['vaccination_date'] : null;
            $insert_qr_code_data['allergy'] = $qr_code['allergy'] ? $qr_code['allergy'] : null;
            $insert_qr_code_data['surgery'] = $qr_code['surgery'] ? $qr_code['surgery'] : null;
            $insert_qr_code_data['medication'] = $qr_code['medication'] ? $qr_code['medication'] : null;
            $insert_qr_code_data['medical_condition'] = $qr_code['medical_condition'] ? $qr_code['medical_condition'] : null;
            $insert_qr_code_data['mating_cycle'] = $qr_code['mating_cycle'] ? $qr_code['mating_cycle'] : null;

            $insert_qr_code_data['qr_code_id'] = $child_qr_code_id;
            $insert_qr_code_data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('qr_animal', $insert_qr_code_data);
        }
    }

    public function copyQrCodeOtherThings($qr_code_id, $child_qr_code_id, $parent_user_id) {
        $insert_qr_code_data = array();
        $qr_code = $this->getThingsByQrCodeId($qr_code_id);
        if ($qr_code) {
            $insert_qr_code_data['parent_user_id'] = $parent_user_id ? $parent_user_id : null;
            $insert_qr_code_data['name'] = $qr_code['name'] ? $qr_code['name'] : null;
            $insert_qr_code_data['device_name'] = $qr_code['device_name'] ? $qr_code['device_name'] : null;
            $insert_qr_code_data['model_number'] = $qr_code['model_number'] ? $qr_code['model_number'] : null;
            $insert_qr_code_data['serial_number'] = $qr_code['serial_number'] ? $qr_code['serial_number'] : null;
            $insert_qr_code_data['color'] = $qr_code['color'] ? $qr_code['color'] : null;
            $insert_qr_code_data['description'] = $qr_code['description'] ? $qr_code['description'] : null;
            $insert_qr_code_data['mobile_no'] = $qr_code['mobile_no'] ? $qr_code['mobile_no'] : null;
            $insert_qr_code_data['image'] = $qr_code['image'] ? $qr_code['image'] : null;
            $insert_qr_code_data['image_path'] = $qr_code['image_path'] ? $qr_code['image_path'] : null;
            $insert_qr_code_data['qr_code_id'] = $child_qr_code_id;
            $insert_qr_code_data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('qr_things', $insert_qr_code_data);
        }
    }

    public function getPersonByQrCodeId($qr_code_id, $mobile_no = '') {
        if ($qr_code_id) {
            $this->db->select('qr_person.id, qr_person.qr_code_id, qr_person.user_id, qr_person.parent_user_id, qr_person.first_name, qr_person.last_name, qr_person.mobile_no, qr_person.email, qr_person.blood_group_id, qr_person.image, qr_person.image_path,    qr_person.is_deleted, qr_person.created_at ');
            $this->db->from('qr_person');
            $this->db->where('qr_person.qr_code_id', $qr_code_id);
            if ($mobile_no != '') {
                $this->db->where('qr_person.mobile_no', $mobile_no);
            }
            $q = $this->db->get();
            $row_array_qr_person_res = $q->row_array();
            return $row_array_qr_person_res;
        } else {
            return array();
        }
    }

    public function updateQrCodeSelf($data) {

        $update_qr_self_data=array();
        if ($data['location']) {
            $update_qr_self_data['location'] = $data['location'];
        }
        if ($data['lat']) {
            $update_qr_self_data['lat'] = $data['lat'];
        }
        if ($data['long']) {
            $update_qr_self_data['long'] = $data['long'];
        }
        $update_qr_self_data['updated_at'] = date('Y-m-d H:i:s');
      
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('qr_code_id', $data['qr_code_id']);
        $this->db->update('qr_self', $update_qr_self_data);

        
        if (isset($data['first_name'])) {
            $insert_data['first_name'] = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $insert_data['last_name'] = $data['last_name'];
        }
        if (isset($data['email'])) {
            $insert_data['email'] = $data['email'];
        }
        if (isset($data['blood_group_id'])) {
            $insert_data['blood_group'] = $data['blood_group_id'];
        }

        if (isset($data['qr_code_id']) && isset($data['user_id']) && isset($data['mobile_no'])) {
            $qr_user = $this->getUserDetailsById($data['user_id']);
            if (!empty($qr_user)) {
                $insert_data['modified_at'] = date('Y-m-d H:i:s');
                $this->db->where('id', $data['user_id']);
                $this->db->where('mobile_no', $data['mobile_no']);
                $this->db->update('users', $insert_data);
            }
        }
    }

    public function getUserDetailsById($user_id) {
        $res_users = array();
        if ($user_id) {
            $this->db->select('id, tenant_id');
            $this->db->from('users');
            $this->db->where('users.id', $user_id);
//            $this->db->where('is_deleted', '0');
            $q = $this->db->get();
            $res_users = $q->row_array();
        }
        return $res_users;
    }

    public function addSelfEmergencyContact($data) {
        if (isset($data['emergency_contact'])) {
            $user_id = $data['user_id'];
            $contact = json_decode($data['emergency_contact']);
            foreach ($contact as $k => $row) {
                $is_deleted = "";
                if ($row->delete == 'true' || $row->delete == true) {
                    $is_deleted = '1';
                } else {
                    $is_deleted = '0';
                }
                $fname = "";
                $lname = "";
                if (preg_match('/\s/', $row->name)) {
                    $arr = explode(' ', $row->name);
                    $fname = $arr['0'];
                    $lname = $arr['1'];
                } else {
                    $fname = $row->name;
                    $lname = '';
                }

                if ($row->emergency_user_id == '0') {
                    $serial_no = $row->serial_no ? $row->serial_no : null;
                    $name = $row->name ? $row->name : null;
                    $mobile_no = $row->mobile_no ? $row->mobile_no : null;
                    $this->db->from('users');
                    $this->db->where('mobile_no', $row->mobile_no);
                    $this->db->where('is_deleted', '0');
                    $q = $this->db->get();
                    $user_info_res = $q->row_array();

                    if ($user_info_res) {
                        $user_info_id = $user_info_res['id'];
                        $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted ');
                        $this->db->from('emergency_contacts');
                        $this->db->where('emergency_contacts.user_id', $user_id);
                        $this->db->where('emergency_contacts.emergency_user_id', $user_info_id);
                        $this->db->where('emergency_contacts.is_deleted', '0');
                        $q = $this->db->get();
                        $emergency_contacts_res = $q->row_array();
                        if (!$emergency_contacts_res) {
                            $insert_data_emergency_contacts = array(
                                'user_id' => $user_id,
                                'emergency_user_id' => $user_info_id,
                                'serial_no' => $serial_no,
                                'name' => $name,
                                'is_deleted' => $is_deleted,
                            );
                            $this->db->insert('emergency_contacts', $insert_data_emergency_contacts);
                        } else {
                            $update_data_qr_emergency_contacts['serial_no'] = $serial_no;
                            $update_data_qr_emergency_contacts['name'] = $name;
                            $update_data_qr_emergency_contacts['is_deleted'] = $is_deleted;
                            $this->db->where('user_id', $user_id);
                            $this->db->where('emergency_user_id', $user_info_id);
                            $this->db->update('emergency_contacts', $update_data_qr_emergency_contacts);
                        }
                    } else {
                        $insert_data_users = array(
                            'first_name' => $fname,
                            'last_name' => $lname,
                            'mobile_no' => $mobile_no,
                            'email' => $fname . '@email.com',
                            'is_deleted' => $is_deleted,
                        );
                        $this->db->insert('users', $insert_data_users);
                        $new_user_id = $this->db->insert_id();
                        if ($new_user_id) {
                            $insert_data_emergency_contacts = array(
                                'user_id' => $user_id,
                                'emergency_user_id' => $new_user_id,
                                'serial_no' => $serial_no,
                                'name' => $name,
                                'is_deleted' => $is_deleted,
                            );
                            $this->db->insert('emergency_contacts', $insert_data_emergency_contacts);
                        }
                    }
                } else {
                    if ($is_deleted == "1") {
                        $this->db->from('users');
                        $this->db->where('mobile_no', $row->mobile_no);
                        $this->db->where('is_deleted', '0');
                        $q = $this->db->get();
                        $user_info_res = $q->row_array();
                        if ($user_info_res) {
                            $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted ');
                            $this->db->from('emergency_contacts');
                            $this->db->where('emergency_contacts.user_id', $user_id);
                            $this->db->where('emergency_contacts.emergency_user_id', $row->emergency_user_id);
                            $this->db->where('emergency_contacts.is_deleted', '0');
                            $q = $this->db->get();
                            $emergency_contacts_res = $q->row_array();
                            if ($emergency_contacts_res) {

                                $update_data_qr_emergency_contacts['serial_no'] = $serial_no;
                                $update_data_qr_emergency_contacts['name'] = $name;
                                $update_data_qr_emergency_contacts['is_deleted'] = $is_deleted;
                                $this->db->where('user_id', $user_id);
                                $this->db->where('emergency_user_id', $row->emergency_user_id);
                                $this->db->update('emergency_contacts', $update_data_qr_emergency_contacts);
                            }
                        } else {
                            $update_data_qr_emergency_contacts['serial_no'] = $serial_no;
                            $update_data_qr_emergency_contacts['name'] = $name;
                            $update_data_qr_emergency_contacts['is_deleted'] = $is_deleted;
                            $this->db->where('user_id', $user_id);
                            $this->db->where('emergency_user_id', $row->emergency_user_id);
                            $this->db->update('emergency_contacts', $update_data_qr_emergency_contacts);
                        }
                    }
                }
            }
        }
    }

    public function getQrCodeChild($post_qr_code_id) {
      
    	$this->db->select('id, user_id, code, parent_qr_id, is_deleted');
    	$this->db->where('qr_code.is_deleted', '0');
    	$this->db->where('qr_code.parent_qr_id', $post_qr_code_id);
    	$this->db->order_by('qr_code.id', 'desc');
    	$this->db->from('qr_code');
    	$res = $this->db->get();
        $qr_code_result = $res->result_array();
        return $qr_code_result;
    }

    public function getUsersById($user_id) {
        $this->db->from('users');
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $user_id);
	    $q = $this->db->get();
	    return $q->row_array();
    }
    
    public function sendAdminNotificationQrCodeMissingAlert($id) {
        date_default_timezone_set('Asia/Kolkata');
        $qr_time = date('Y-m-d h:i:s');
        $qr_code = '';
        $qr_code_user_id = '';
        $qr_code_type = '';
        $type_val = '';
        $qr_type_name = '';
        if ($id != "") {
            $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.missing_status, qr_code.type');
            $this->db->from('qr_code');
            $this->db->where('qr_code.id', $id);
            $q = $this->db->get();
            $row_array_res = $q->row_array();
            if ($row_array_res) {
                $qr_code_id = $row_array_res['id'];
                $qr_code = $row_array_res['code'];
                $qr_code_user_id = $row_array_res['user_id'];
                $qr_code_type = $row_array_res['type'];
                if ($qr_code_type == '1') {
                    $type_val = "Person";
                    $this->db->select('qr_person.id, qr_person.user_id, qr_person.first_name, qr_person.last_name');
                    $this->db->from('qr_person');
                    $this->db->where('qr_person.is_deleted', '0');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_type_name = $row_array_qr_person_res['first_name'] . " " . $row_array_qr_person_res['last_name'];
                    }
                } else if ($qr_code_type == '2') {
                    $type_val = "Pet";
                    $this->db->select('qr_animal.id, qr_animal.name');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_type_name = $row_array_qr_person_res['name'];
                    }
                } else if ($qr_code_type == '3') {
                    $type_val = "Thing";
                    $this->db->select('qr_things.id, qr_things.name');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_type_name = $row_array_qr_person_res['name'];
                    }
                }
                if ($row_array_res['type'] == "1" && $row_array_res['code_for'] == "1") {
                $user_id = $row_array_res['user_id'];
                    $this->db->select('users.id, users.first_name, users.last_name, users.email, users.profile_image, users.profile_image_thumb, users.mobile_no,  users.blood_group, users.is_deleted, users.created_at  ,users.blood_group,  blood_group.title as blood_group ');
                    $this->db->from('users');
                    $this->db->join('blood_group', 'blood_group.id = users.blood_group', 'left');
                    $this->db->where('users.id', $user_id);
                    $q = $this->db->get();
                    $row_array_users_res = $q->row_array();
                    if ($row_array_users_res) {
                        $qr_type_name = $row_array_users_res['first_name'] . ' ' . $row_array_users_res['last_name'];
                    }
                }
            }
        }
        if ($qr_code != "" && $qr_code_user_id != "") {
            // $send_message = 'QR Code - ' . $qr_code . ' Missing Alert on Captain India. Time:' . $qr_time;
            $send_message = $type_val . ' - ' . $qr_type_name . ', QR-' . $qr_code . ' has been missing. Time: ' . $qr_time;
            $msg_response = $this->sendNotificationMessageOnesignal($send_message);
            $save_notification_arr = array(
                'message_type' => '2',
                'qr_code_id' => $id,
                'qr_code' => $qr_code,
                'message' => $send_message,
                'message_response' => $msg_response,
                'created_at' => date('Y-m-d h:i:s')
            );
            $table_name = "qr_code_notification";
            $save_notification = $this->saveNotificationMessage($save_notification_arr, $table_name);
        }
    }
    
    public function getLinkedQrcodeByUseridnew($user_id) {

        $this->db->select('id, user_id, code, type, type_title, code_for, missing_status, is_deleted, created_at');
        $this->db->where('is_deleted', '0');
        $this->db->where('user_id', $user_id);
        //parent_qr_id
        $this->db->where('qr_code.parent_qr_id IS NULL', NULL, FALSE);
        $this->db->order_by('qr_code.id', 'desc');
        $this->db->from('qr_code');
        $res = $this->db->get();
        $qr_code_result = $res->result_array();
        $base_url = str_replace("/index.php/", "", base_url());
        if (!empty($qr_code_result)) {
            foreach ($qr_code_result as $k => $row) {
                if ($row['type'] == "1" && $row['code_for'] == "1") {
                    $qr_code_result[$k]['type_title'] = "Myself";
                } else if ($row['type'] == "1" && $row['code_for'] == "2") {
                    $qr_code_result[$k]['type_title'] = "My Family";
                } else if ($row['type'] == "2") {
                    $qr_code_result[$k]['type_title'] = "My Pets";
                } else if ($row['type'] == "3") {
                    $qr_code_result[$k]['type_title'] = "My Personal Belongings";
                }

                if ($row['type'] == '1') {
                   
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_person.id, qr_person.qr_code_id, qr_person.user_id, qr_person.first_name, qr_person.last_name, qr_person.email, qr_person.image, qr_person.image_path, qr_person.mobile_no, qr_person.email, qr_person.blood_group_id, qr_person.is_deleted, qr_person.created_at, blood_group.title as blood_group  ');
                    $this->db->from('qr_person');
                    $this->db->join('blood_group', 'blood_group.id = qr_person.blood_group_id', 'left');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['first_name'] = $row_array_qr_person_res['first_name'];
                        $qr_code_result[$k]['last_name'] = $row_array_qr_person_res['last_name'];
                        $qr_code_result[$k]['email'] = $row_array_qr_person_res['email'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $qr_code_result[$k]['blood_group'] = $row_array_qr_person_res['blood_group'];
                        $qr_code_result[$k]['image'] = $row_array_qr_person_res['image'];
                        $qr_code_result[$k]['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . 'uploads' . $row_array_qr_person_res['image_path'] : null;

                        $user_id = $row_array_qr_person_res['user_id'];
                        $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted, users.mobile_no ');
                        $this->db->from('emergency_contacts');
                        $this->db->join('users', 'users.id = emergency_contacts.emergency_user_id', 'left');
                        $this->db->where('emergency_contacts.user_id', $user_id);
                        $this->db->order_by('emergency_contacts.serial_no', 'ASC');
                        $q = $this->db->get();
                        $result_array_emergency_contacts = $q->result_array();
                       
                        $qr_code_result[$k]['emergency_contacts'] = $result_array_emergency_contacts;
                        $qr_code_result[$k]['created_at'] = $row_array_qr_person_res['created_at'];
                    }
                }
                if ($row['type'] == '2') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_animal.id, qr_animal.qr_code_id, qr_animal.name, qr_animal.image, qr_animal.image_path, qr_animal.color, qr_animal.description, qr_animal.mobile_no, qr_animal.is_deleted, qr_animal.created_at, qr_animal.date_of_birth, qr_animal.age, qr_animal.identification_mark, qr_animal.vaccination_name, qr_animal.vaccination_date, qr_animal.allergy, qr_animal.surgery, qr_animal.medication, qr_animal.medical_condition, qr_animal.mating_cycle');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['name'] = $row_array_qr_person_res['name'];
                        $qr_code_result[$k]['image'] = $row_array_qr_person_res['image'];
                        if ($row_array_qr_person_res['image_path'] != null) {
                            $qr_code_result[$k]['image_path'] = GetProfileImagePath($row_array_qr_person_res['image_path']);
                        } else {
                            $qr_code_result[$k]['image_path'] = null;
                        }
                        $qr_code_result[$k]['color'] = $row_array_qr_person_res['color'];
                        $qr_code_result[$k]['description'] = $row_array_qr_person_res['description'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $qr_code_result[$k]['date_of_birth'] = $row_array_qr_person_res['date_of_birth'];
                        $qr_code_result[$k]['age'] = $row_array_qr_person_res['age'];
                        $qr_code_result[$k]['identification_mark'] = $row_array_qr_person_res['identification_mark'];
                        $qr_code_result[$k]['vaccination_name'] = $row_array_qr_person_res['vaccination_name'];
                        $qr_code_result[$k]['vaccination_date'] = $row_array_qr_person_res['vaccination_date'];
                        $qr_code_result[$k]['allergy'] = $row_array_qr_person_res['allergy'];
                        $qr_code_result[$k]['surgery'] = $row_array_qr_person_res['surgery'];
                        $qr_code_result[$k]['medication'] = $row_array_qr_person_res['medication'];
                        $qr_code_result[$k]['medical_condition'] = $row_array_qr_person_res['medical_condition'];
                        $qr_code_result[$k]['mating_cycle'] = $row_array_qr_person_res['mating_cycle'];
                        $qr_code_result[$k]['created_at'] = $row_array_qr_person_res['created_at'];
                    }
                }

                if ($row['type'] == '3') {
                    $qr_code_id = $row['id'];
                    $this->db->select('qr_things.id, qr_things.qr_code_id, qr_things.name, qr_things.device_name, qr_things.model_number, qr_things.serial_number, qr_things.color, qr_things.description, qr_things.mobile_no, qr_things.image, qr_things.image_path, qr_things.is_deleted, qr_things.created_at ');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_code_result[$k]['name'] = $row_array_qr_person_res['name'];
                        $qr_code_result[$k]['device_name'] = $row_array_qr_person_res['device_name'];
                        $qr_code_result[$k]['model_number'] = $row_array_qr_person_res['model_number'];
                        $qr_code_result[$k]['serial_number'] = $row_array_qr_person_res['serial_number'];
                        $qr_code_result[$k]['color'] = $row_array_qr_person_res['color'];
                        $qr_code_result[$k]['image'] = $row_array_qr_person_res['image'];
                        $qr_code_result[$k]['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $qr_code_result[$k]['description'] = $row_array_qr_person_res['description'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $qr_code_result[$k]['created_at'] = $row_array_qr_person_res['created_at'];
                    }
                }
                
                if ($row['type'] == "1" && $row['code_for'] == "1") {
                    $user_id = $row['user_id'];
                    $this->db->select('users.id,  users.first_name, users.last_name, users.email,  users.profile_image , users.profile_image_thumb, users.mobile_no,  users.blood_group, users.is_deleted, users.created_at  ,users.blood_group,  blood_group.title as blood_group ');
                    $this->db->from('users');
                    $this->db->join('blood_group', 'blood_group.id = users.blood_group', 'left');
                    $this->db->where('users.id', $user_id);
                    $q = $this->db->get();
                    $row_array_users_res = $q->row_array();
                    if ($row_array_users_res) {
                        $qr_code_result[$k]['first_name'] = $row_array_users_res['first_name'];
                        $qr_code_result[$k]['last_name'] = $row_array_users_res['last_name'];
                        $qr_code_result[$k]['email'] = $row_array_users_res['email'];
                        $qr_code_result[$k]['blood_group'] = $row_array_users_res['blood_group'];
                        $qr_code_result[$k]['mobile_no'] = $row_array_users_res['mobile_no'];
                        $qr_code_result[$k]['profile_image'] = $row_array_users_res['profile_image'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image'] : null;
                        $qr_code_result[$k]['profile_image_thumb'] = $row_array_users_res['profile_image_thumb'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image_thumb'] : null;
                    }
                }
            }
        }
        return $qr_code_result;
    }

    public function getTypeTitle($qr_code_type) {
        $type_title = null;
        if ($qr_code_type == 1) {
            $type_title = 'Person';
        }
        if ($qr_code_type == 2) {
            $type_title = 'Animal';
        }
        if ($qr_code_type == 3) {
            $type_title = 'Things';
        }
        if ($qr_code_type == 4) {
            $type_title = 'Self';
        }
        return $type_title;
    }

    public function getTenantKeyword($tenant_id = null) {
        $this->db->select('tenant_keyword.id, tenant_keyword.tenant_id, tenant_keyword.keyword, tenant_keyword.is_deleted');
        $this->db->where('tenant_keyword.is_deleted', '0');
        if ($tenant_id != null) {
            $this->db->where('tenant_keyword.tenant_id', $tenant_id);
        }
        $this->db->order_by('tenant_keyword.id', 'desc');
        $this->db->from('tenant_keyword');
        $res = $this->db->get();
        $qr_code_result = $res->result_array();
        return $qr_code_result;
    }

    public function getAdmin() {
        $this->db->select('id, first_name,middle_name,last_name,email,mobile_no,gender,age,blood_group,date_of_birth,status');
        $this->db->where('is_deleted', '0');
        return $this->db->get('user_admin')->result_array();
    }

    public function getTenantIdByTenantKeyword($keyword = null) {
        $qr_code_result = array();
        if ($keyword != null) {
            $this->db->select('tenant_keyword.id, tenant_keyword.tenant_id, tenant_keyword.keyword, tenant_keyword.is_deleted');
            $this->db->where('tenant_keyword.is_deleted', '0');
            $this->db->where('tenant_keyword.keyword', $keyword);
            $this->db->order_by('tenant_keyword.id', 'desc');
            $this->db->from('tenant_keyword');
            $res = $this->db->get();
            $qr_code_result = $res->row_array();
        }
        return $qr_code_result;
    }

    public function getAdminDetailById($id = '') {
        if ($id) {
            $this->db->select('user_admin.id , user_admin.user_name, user_admin.first_name,user_admin.middle_name,user_admin.last_name,user_admin.email,user_admin.mobile_no  ');
            $this->db->where('user_admin.is_deleted', '0');
            $this->db->where('user_admin.id', $id);
            $res = $this->db->get();
            $user_admin_result = $res->row_array();
            return $user_admin_result;
        } else {
            return false;
        }
    }

// START - 17-jun-2023 - tenant_licence update
    public function updateTenantLicence($data) {
        $user_id_value = $data['user_id'];
        $this->db->where("tenant_licence.user_id", $user_id_value);
        $this->db->order_by('tenant_licence.id', 'desc');
        $query_tenant_licence_date = $this->db->get('tenant_licence')->row();

        $start_date = null;
        $end_date = null;
        if ($query_tenant_licence_date) {
            $tenant_licence_id = $query_tenant_licence_date->id;
            $licence_days_count = $query_tenant_licence_date->licence_days;
            if ($query_tenant_licence_date->start_date == null && $query_tenant_licence_date->end_date == null) {
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days_count . ' day'));
                $update_data_tenant_licence = array(
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $tenant_licence_id);
                $this->db->update('tenant_licence', $update_data_tenant_licence);

                // update user_plan
                $update_data_user_plan = array(
                    'status' => 0,
                    'is_deleted' => '1',
                );
                $this->db->where('user_id', $data['user_id']);
                $this->db->update('user_plan', $update_data_user_plan);

                // insert user_plan
                $insert_data_user_plan = array(
                    'user_id' => $data['user_id'],
                    'plan_id' => isset($query_tenant_licence_date->plan_id) ? $query_tenant_licence_date->plan_id : null,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'licence_key_id' => $tenant_licence_id,
                    'status' => 1,
                );
                $this->db->insert('user_plan', $insert_data_user_plan);
            }
            if ($query_tenant_licence_date->start_date != null) {
                $this->db->where('user_plan.status', 1);
                $this->db->where('user_plan.licence_key_id', $tenant_licence_id);
                $this->db->from('user_plan');
                $res = $this->db->get();
                $user_plan_result = $res->row_array();

                if (!$user_plan_result) {
                    // update user_plan
                    $update_data_user_plan = array(
                        'status' => 0,
                        'is_deleted' => '1',
                    );
                    $this->db->where('user_id', $data['user_id']);
                    $this->db->update('user_plan', $update_data_user_plan);

                    // insert user_plan
                    $insert_data_user_plan = array(
                        'user_id' => $data['user_id'],
                        'plan_id' => isset($query_tenant_licence_date->plan_id) ? $query_tenant_licence_date->plan_id : null,
                        'start_date' => $query_tenant_licence_date->start_date,
                        'end_date' => $query_tenant_licence_date->end_date,
                        'licence_key_id' => $tenant_licence_id,
                        'status' => '1',
                    );
                    $this->db->insert('user_plan', $insert_data_user_plan);
                }
            }
        }
    }

    function getSettingFirebaseApp() {
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where_in('settings.id', array(4,5));
        $q = $this->db->get();
        $row_arr = $q->result_array();
        if (!empty($row_arr)) {
            $return_arr = array('firebase_app_email' => $row_arr[0]['value'], 'firebase_app_password' => $row_arr[1]['value']);
            return $return_arr;
        } else {
            return array();
        }
    }

    public function sendOtpMessage($mobile_no, $otp) {
        // https://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=919619411107&msg=123 is your One Time Password (OTP) for Captain India App login -Zimaxx Tech&msg_type=TEXT&userid=2000232718&auth_scheme=plain&password=NtyqmU0Qg &v=1.1&format=text
        $mobile_no = "91".$mobile_no;
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=".$mobile_no."&msg=".$otp."%20is%20your%20One%20Time%20Password%20(OTP)%20for%20Captain%20India%20App%20login%20-Zimaxx%20Tech&msg_type=TEXT&userid=2000232718&auth_scheme=plain&password=NtyqmU0Qg%20&v=1.1&format=text";
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
           $json_result = json_decode($result, true);
           print_R($json_result);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
    }
    public function getSettingById($id) {
        $this->db->from('settings');
        $this->db->where('settings.id', $id);
        $q = $this->db->get();
        $row_arr = $q->row_array();
        if (!empty($row_arr)) {
            return $row_arr;
        } else {
            return array();
        }
    }
    
    public function getFirebaseLocationByFirebaseId($firebase_key = null) {
        $return_array = array();
        if($firebase_key != null) {
            $setting_url_res = $this->getSettingById(6);
            $setting_url_res_value ='';
            if ($setting_url_res) {
                $setting_url_res_value = $setting_url_res['value'];
            }
            $setting_auth_key_res = $this->getSettingById(3);
            $setting_auth_key_value ='';
            if ($setting_auth_key_res) {
                $setting_auth_key_value = $setting_auth_key_res['value'];
            }
            $handle = curl_init();
            // $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
            $url = $setting_url_res_value . $firebase_key . "/location.json?auth=" . $setting_auth_key_value;
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
            $return_array = $output;
        }
        return $return_array;
    }
    
    function callSendOtpMessage($mobile_no, $otp) {
//        $mobile_no = 9921572275;
//        $otp=2121;
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => "https://captainindiatest2.anekalabs.com/backend/index.php/user/callSendOtpMessageUatZimaxxtech",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'mobile_no' => $mobile_no,
                'otp' => $otp,
            )
        );
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        print_r($result);
    }
}

?>
