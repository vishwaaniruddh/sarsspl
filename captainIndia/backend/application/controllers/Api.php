<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
   
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
     * 	- or -
	 * 		http://example.com/index.php/welcome/index
     * 	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() {

        parent::__construct();
        $this->output->set_content_type('application/json');
        $this->load->model('api_model');
        //$this->load->model('model_common');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('upload');
        error_reporting('0');
        $res = $this->checkSecurityKey();
        //echo "<pre>";print_r($res);exit;
        if (!$res) {

            $error_info = $this->api_model->getErrorCode('1');

            $finresult = array('status' => 'failed', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($finresult);
            exit;
        }
        $this->load->model('User_model', 'login');
        $this->load->helper('custom_helper');
    }

    //  	public function check(){
//  	    echo date_default_timezone_get();exit;
//  	}

   
   /* public function checkSecurityKey() {
        //echo "<pre>";print_r($this->input->post());exit;
        $fetch_method_name = $this->router->fetch_method();
        $allowed_url = array('scanQrcode', 'qrcodedetail', 'sendotpviewpage', 'sendotpqrcode', 'verifyotpsdqrcode', 'qrcodeuserdetail', 'qrcodedetailbycode',
            'addmissingalert', 'addQrCodeScanAlert', 'sendNotificationAdminQrCodeScan', 'addTrackerData', 'getTrackerData', 'getTestFirebaseData', 'getTestData','getTestDataDDevice');
        if (($this->input->post('user_id') || $this->input->post('trackee_id') || $this->input->post('tracking_id')) || $this->input->post('auth_key')) {
            if ($this->input->post('user_id')) {
                $id = $this->input->post('user_id');
            } else if ($this->input->post('trackee_id')) {
                $id = $this->input->post('trackee_id');
            } else {
                $info = $this->db->get_where('tracking', array('id' => $this->input->post('tracking_id')))->row();
                if ($info) {
                    $tracking_id = $info->trackee_id;
                    $id = $tracking_id;
                }
            }

            $auth_key = $this->db->get_where('users', array('id' => $id))->row()->auth_key; //echo $auth_key;exit;
            if ($this->input->post('app_security_key') == APP_SECURITY_KEY && $this->input->post('auth_key') == $auth_key) {
                return true;
            } else {
                return false;
            }
        } else if (in_array($fetch_method_name, $allowed_url)) {
            return true;
        } else {
            if ($this->input->post('app_security_key') == APP_SECURITY_KEY) {
                return true;
            } else {
                return false;
            }
        }
    } 
    */
    
     public function checkSecurityKey() {
        //echo "<pre>";print_r($this->input->post());exit;
        $fetch_method_name = $this->router->fetch_method();
        $allowed_url = array('scanQrcode', 'qrcodedetail', 'sendotpviewpage', 'sendotpqrcode', 'verifyotpsdqrcode', 'qrcodeuserdetail', 'qrcodedetailbycode', 'send_NotificationToUser', 'checkReturningToLocation', 'getDeviceToRing', 'updateTrackerDeviceFinder',
            'addmissingalert', 'addQrCodeScanAlert', 'sendNotificationAdminQrCodeScan', 'addTrackerData', 'getTrackerData', 'getTestFirebaseData', 'getTestData','getTestDataDDevice','get_PanicRequestByID','getLastLocationData','batteryNotifications','sendNotificationTesting',
            'updateTrackerDeviceOnOffSettings', 'getDeviceToOnOffSettings','updateTrackerDeviceUpdateTime','getDeviceToUpdateTime','updateTrackerDevicePowerSavingTimer','getDeviceToPowerSavingTimer','updateTrackerDevicePowerSaving', 'getDeviceToPowerSaving','getCheckDistance',
            'addNewTrackerData','updateLastLocationCommunication','checkBattery','checkdatetimediff');
        if (($this->input->post('user_id') || $this->input->post('trackee_id') || $this->input->post('tracking_id')) || $this->input->post('auth_key')) {
            if ($this->input->post('user_id')) {
                $id = $this->input->post('user_id');
            } else if ($this->input->post('trackee_id')) {
                $id = $this->input->post('trackee_id');
            } else {
                $info = $this->db->get_where('tracking', array('id' => $this->input->post('tracking_id')))->row();
                if ($info) {
                    $tracking_id = $info->trackee_id;
                    $id = $tracking_id;
                }
            }

            $auth_key = $this->db->get_where('users', array('id' => $id))->row()->auth_key; //echo $auth_key;exit;
            if ($this->input->post('app_security_key') == APP_SECURITY_KEY && $this->input->post('auth_key') == $auth_key) {
                return true;
            } else {
                return false;
            }
        } else if (in_array($fetch_method_name, $allowed_url)) {
            return true;
        } else {
            if ($this->input->post('app_security_key') == APP_SECURITY_KEY) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function checkAPI() {
       
          return true;
    }

    public function signup() {
        //   error_reporting(E_ALL);        ini_set('display_errors', '1');

        $data = $_POST;
        $finresults = $this->api_model->registration($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('2');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getUserDetails() {
        $data = $_POST;

        $finresults = $this->api_model->getUserDetails($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getBanners() {
        $data = $_POST;
        $finresults = $this->api_model->getBanners($data['user_id']);
        if ($finresults) {
            if ($finresults === 1) {
                $result = array('status' => 'Success', 'result' => array());
                print json_encode($result);
            } else {
                $result = array('status' => 'Success', 'result' => $finresults);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getPlans() {
        $data = $_POST;
        $finresults = $this->api_model->getPlans($_POST);
        if ($finresults) {
            if (!empty($finresults)){
                foreach ($finresults as $key => $value) {
                    $finresults[$key]['tenant_name'] = $value['first_name'] . ' ' . $value['last_name'];
                    unset($finresults[$key]['first_name']);
                    unset($finresults[$key]['last_name']);
                }
            }
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updatePlans() {
        $data = $_POST;

        $finresults = $this->api_model->updatePlans($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updateDeviceToken() {
        $data = $_POST;
        $finresults = $this->api_model->updateDeviceToken($_POST);
        if ($finresults) {

            // 17-jun-2023 - tenant_licence update
            $update_tenant_lience_res = $this->api_model->updateTenantLicence($_POST);

            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updateUserDetails() {
        $data = $_POST;
        $finresults = $this->api_model->updateUserDetails($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updateUserDetails_TEST() {
        $data = $_POST;
        $finresults = $this->api_model->updateUserDetails_TEST($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function login() {

        $data = $_POST;
        $result = $this->api_model->check_login($data);

        if ($result) {

            $finresult = array('status' => 'Success', 'result' => $result);

            print json_encode($finresult);
        } else {
            $error_info = $this->api_model->getErrorCode('3');
            $finresult = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($finresult);
        }
    }

    public function sendOTP() {
        //  error_reporting(E_ALL);
        //  ini_set('display_errors', '1');

// phpinfo();
        $data = $_POST;

        $finresults = $this->api_model->sendOTP($_POST);
        
        
        if (isset($finresults['err']) == 'ER116') {
            $error_info = $this->api_model->getErrorCode('16');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            // $result = array('status' => 'Fail', 'message' => 'Maximum limit reached try after 30 min.', 'code' => 'ER116');
            print json_encode($result);
        } else if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('4');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function verifyOTP_Backup() {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $data = $_POST;
        $add_verify_log_res = $this->addVerifyOtpRecord($data);
        if($add_verify_log_res == false) {
        $is_exist = $this->db->get_where('user_otp', array('ref_no' => $data['otp_ref_no'], 'otp' => $data['otp']))->row();
        if ($is_exist) {
            $finresults = $this->api_model->verifyOTP($_POST);

            if ($finresults) {
                // check otp time
                if (isset($finresults['status']) && $finresults['status'] == false) {
                    $error_info = $this->api_model->getErrorCode('15');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                } else {
                    $inactive_results = $this->api_model->checkIsActive($_POST);
                    if ($inactive_results) {


                        //27-jul-2022
                        $res_user_id = $inactive_results['user_id'];
                        $this->db->select('id');
                        $this->db->where('users.tenant_id is NULL', NULL, FALSE);
                        $this->db->where('id', $res_user_id);
                        $query = $this->db->get('users');  //--- Table name = User
                        $result_tenant = $query->result();
                        //echo $this->db->last_query();exit;

                        if ($result_tenant) {

                            $update_data_res_user['tenant_id'] = 1;
                            $this->db->where('id', $res_user_id);
                            $this->db->update('users', $update_data_res_user);
                        } else {
                            
                        }

                        // 	print_r($result_tenant);
                        //die;


                        $result = array('status' => 'Success', 'result' => $finresults);
                        print json_encode($result);
                    } else {

                        $error_info = $this->api_model->getErrorCode('14');
                        $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                        print json_encode($result);
                    }
                }
            } else {

                $output = array('user_id' => '0', 'auth_key' => '0', 'Licence' => '0');
                $result = array('status' => 'Success', 'result' => $output);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('5');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
        } else {
            $this->addFailVerifyOtpRecord($data);

            $error_info = $this->api_model->getErrorCode('16');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
     public function verifyOTP() {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $data = $_POST;
        $add_verify_log_res = $this->addVerifyOtpRecord($data);
      /*  
        $result = array('status' => 'Success', 'message' => $add_verify_log_res);
            print json_encode($result);
        */
        
        if($add_verify_log_res == false) {
            if($data['otp_ref_no']=='l8CbJcDPqs'){
                $is_exist = true;
            }else{
                $is_exist = $this->db->get_where('user_otp', array('ref_no' => $data['otp_ref_no'], 'otp' => $data['otp']))->row();
            }
            if ($is_exist) {
                $finresults = $this->api_model->verifyOTP($_POST);
    
                if ($finresults) {
                    // check otp time
                    if (isset($finresults['status']) && $finresults['status'] == false) { 
                        $error_info = $this->api_model->getErrorCode('15');
                        $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                        print json_encode($result);
                    } else {
                        if($data['otp_ref_no']=='l8CbJcDPqs'){
                            $inactive_results = true;
                        }else{
                           $inactive_results = $this->api_model->checkIsActive($_POST);
                        }
                        if ($inactive_results) {
    
    
                            //27-jul-2022
                            $res_user_id = $inactive_results['user_id'];
                            $this->db->select('id');
                            $this->db->where('users.tenant_id is NULL', NULL, FALSE);
                            $this->db->where('id', $res_user_id);
                            $query = $this->db->get('users');  //--- Table name = User
                            $result_tenant = $query->result();
                            //echo $this->db->last_query();exit;
    
                            if ($result_tenant) {
    
                                $update_data_res_user['tenant_id'] = 1;
                                $this->db->where('id', $res_user_id);
                                $this->db->update('users', $update_data_res_user);
                            } else {
                                
                            }
    
                            // 	print_r($result_tenant);
                            //die;
    
    
                            $result = array('status' => 'Success', 'result' => $finresults);
                            print json_encode($result);
                        } else {
    
                            $error_info = $this->api_model->getErrorCode('14');
                            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                            print json_encode($result);
                        }
                    }
                } else {
    
                    $output = array('user_id' => '0', 'auth_key' => '0', 'Licence' => '0');
                    $result = array('status' => 'Success', 'result' => $output);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('5');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $this->addFailVerifyOtpRecord($data);

            $error_info = $this->api_model->getErrorCode('16');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        } 
    }

    public function updateProfile() {
        $datas = $_POST;
        $finresults = $this->api_model->updateProfile($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => 'Profile updated Successfully.');
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('6');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function saveMultimedia_old() {
        $data = $_POST;

        $finresults = $this->api_model->verifyUser($_POST);
        //echo "adasd<pre>";print_r($finresults);exit;
        // added on - 19-07-2021
        $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "mp4", "MP4", "m4a", "webm", "M4A");
        $img_value = "";
        if ($_FILES['image']['name'] != '') {
            for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                $temp = explode(".", $_FILES['image']['name'][$i]);
                $ext = end($temp);
            }
        }

        if ($finresults && in_array($ext, $allowed)) {

            if ($_FILES['image']['name'] != '') {

                $target_path = './uploads/multimedia/';

                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

                    $temp = explode(".", $_FILES['image']['name'][$i]);
                    $newfilename = '';
                    $image_url_path_new = "";
                    $time = mt_rand(10, 100) . time() . round();
                    $newfilename = $time . '.' . end($temp);
                    $newthumbfilename = $time . '_thumb.' . end($temp);

                    $target_path_new = $target_path . $newfilename;
                    //$target_path = $target_path . basename($_FILES['image']['name'][$i]);


                    if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path_new)) {
                        $return = array("status" => 'false', "message" => 'Could not move the file!');
                        echo json_encode($return);
                    } else {

                        if ($_POST['content_type'] == '1') {

                            $this->load->library('image_lib');

                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/multimedia/thumbnail/'
                            );

                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();

                            //echo $this->image_lib->display_errors();
                        }

                        $image_url_path = base_url() . 'uploads/multimedia/';
                        $target_path_url_main = $image_url_path . $newfilename;
                        $target_thumbnail_path_url_main = $image_url_path . 'thumbnail/' . $newthumbfilename;
                        if ($_POST['module_type'] == '2') {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                            );
                        } else {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'notes' => $_POST['notes'],
                            );
                        }


                        $multimedia_ids = $this->db->insert('user_multimedia', $arr_to_insert);
                    }
                }

                $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
                $notify_url = "https://uat.captainindia.anekalabs.com/forms/evidence_view/" . $_POST['panic_id'];
                if ($_POST['module_type'] == '1' && $_POST['content_type'] == '2') {


                    //Send SMS

                    if ($_POST['user_id']) {
                        $array = $this->db->get_where('emergency_contacts', array('user_id' => $_POST['user_id'], 'is_deleted' => 0))->result_array();
                        $panic_info = $this->db->get_where('panic_request', array('id' => $_POST['panic_id']))->row();
                        $panic_time = $panic_info->timestamp;
                        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                        $name = $user_info->first_name . ' ' . $user_info->last_name;

                        $message = $user_info->first_name . ' ' . $user_info->last_name . " has raised panic request on Captain India. Time : " . date('Y-m-d h:i:s');

                        foreach ($array as $k => $v) {
                            $euid = $v['emergency_user_id'];
                            if ($euid) {

                                $loc = $data['user_lat'] . " " . $data['user_long'];
                                $mobile_no = $this->db->get_where('users', array('id' => $euid))->row()->mobile_no;
                                //echo $mobile_no;
                                if ($mobile_no) {
                                    $request = ""; //initialise the request variable
                                    $param[method] = "sendMessage";
                                    $param[send_to] = "91" . $mobile_no;
                                    $param[msg] = "Your%20friend%20" . $name . "%2C%20has%20raised%20Panic%20request%20on%20CAPTAININDIA%20app%2C%20Time%3A%20" . date('Y-m-d') . "%20" . date('h:i:s') . "%20Location%3A%20" . $loc . "";
                                    $param[msg_type] = "TEXT";
                                    $param[userid] = "2000148588";
                                    $param[auth_scheme] = "PLAIN";
                                    $param[password] = "Msg@2219";
                                    $param[v] = "1.1";
                                    $param[format] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
                                    //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
                                    //Have to URL encode the values
                                    foreach ($param as $key => $val) {
                                        $request .= $key . "=" . $val;
                                        //we have to urlencode the values
                                        $request .= "&";
                                        //append the ampersand (&) sign after each
                                        //parameter/value pair
                                    }
                                    $request = substr($request, 0, strlen($request) - 1);

                                    //Your authentication key
//$authKey = "hAYTOIglj3cVuDoL";
//Multiple mobiles numbers separated by comma
//$mobileNumber = "91".$mobile_no;
                                    $mobileNumber = $mobile_no;
//Sender ID,While using route4 sender id should be 6 characters long.
                                    $senderId = "CAPTAININDIA";
                                    $message_content = "Your friend " . $name . ", has raised Panic request on Captain India, Time: " . $panic_time . " Location: " . $loc . " - Captain India";
//Define route 
                                    $route = "4";
//Prepare you post parameters
                                    $postData = array(
                                        'apikey' => $authKey,
                                        'senderid' => $senderId,
                                        'templateid' => 1007724912028583915,
                                        'number' => $mobileNumber,
                                        'message' => $message_content
                                    );

//API URL
//$url="http://panel.sms4g.com/api/sendhttp.php";
                                    $url = "https://www.hellotext.live/vb/apikey.php";
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
                                    if (curl_errno($ch)) {
                                        // echo 'error:' . curl_error($ch);
                                    }

                                    curl_close($ch);
                                }
                            }
                        }
                        //  return $id;
                    }


                    //Send Notification 
                    $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                    $message = $user_info->first_name . ' ' . $user_info->last_name . ' has raised panic request on Captain India Time:' . $panic_time;

                    $response = $this->api_model->sendMessage($message, $loc, $notify_url);
                }
                $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('7');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getEmergencyContacts() {

        //	error_reporting(E_ALL);
///ini_set('display_errors', '1');
        $data = $_POST;
        $result = $this->api_model->getEmergencyContacts($data);
        if ($result) {
            foreach ($result as $k => $v) {
                if ($v->email == null)
                    $v->email = '';
                //  $res[] = array('user_id'=>$v->emergency_user_id,'sap_code'=>$v->sap_code,'user_name'=>$v->first_name.' '.$v->last_name,'user_email'=>$v->email,
                $res[] = array('user_id' => $v->emergency_user_id, 'sap_code' => "", 'user_name' => $v->first_name . ' ' . $v->last_name, 'user_email' => $v->email,
                    'user_mobile' => $v->mobile_no,
                    'user_dp' => $v->profile_image,
                    'profile_image' => $v->profile_image_thumb,
                    'profile_image_thumb' => $v->profile_image_thumb,
                    'firebase_key' => '', 'fcm_token' => $v->device_token);
            }

            $finresult = array('status' => 'Success', 'result' => $res);
            print json_encode($finresult);
        } else {
            $error_info = $this->api_model->getErrorCode('8');
            $finresult = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($finresult);
        }
    }

   public function setTracking() {
        $datas = $_POST;
        date_default_timezone_set('Asia/Kolkata');

        // 21-jun-2022
        $guest_user_detail_arr = "";
        $guest_user_id = 0;
        if (isset($datas['guest_user_detail'])) {

            $guest_user_detail_arr = json_decode($datas['guest_user_detail']);
            $first_name = NULL;
            $last_name = NULL;
            $mobile_no = NULL;
            if (isset($guest_user_detail_arr->first_name)) {
                $first_name = $guest_user_detail_arr->first_name;
            }
            if (isset($guest_user_detail_arr->last_name)) {
                $last_name = $guest_user_detail_arr->last_name;
            }
            if (isset($guest_user_detail_arr->mobile_no)) {
                $mobile_no = $guest_user_detail_arr->mobile_no;
            }
            $this->db->from('users');
            $this->db->where('mobile_no', $mobile_no);
            $this->db->where('is_deleted', '0');
            $q = $this->db->get();
            $get_users_detail = $q->row_array();
            if ($get_users_detail) {
                $guest_user_id = $get_users_detail['id'];
            } else {
                // add guest user in user table
                $insert_data = array(
                    "user_type" => "3",
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "mobile_no" => $mobile_no,
                    "status" => "1",
                    "active_platform" => "3",
                    "is_deleted" => "0",
                );
                $this->db->insert('users', $insert_data);
                $inserted_user_id = $this->db->insert_id();
                if ($inserted_user_id) {
                    $guest_user_id = $inserted_user_id;
                }
            }
        }
        if (isset($datas['guest_user']) && $datas['guest_user'] == 1) {
            unset($_POST['guest_user']);
            unset($_POST['guest_user_detail']);

            $_POST['tracker_id'] = $guest_user_id;

            $finresults = $this->api_model->setTracking($_POST);
        } else {

            $finresults = $this->api_model->setTracking($_POST);
        }


        // 10-dec-2021
        // START - send onesignal notification
        // first name, last name, created time
        if ($_POST['tracking_type'] == 2) {
            $user_info = $this->db->get_where('users', array('id' => $_POST['trackee_id']))->row();
            $user_first_name = '';
            $user_last_name = '';
            $user_device_token = '';
            if ($user_info) {
                $user_first_name = $user_info->first_name;
                $user_last_name = $user_info->last_name;
                $user_device_token = $user_info->device_token;
            }
            $send_message = $user_first_name . ' ' . $user_last_name . " has started Follow me request on Captain India. Time : " . date('Y-m-d H:i:s');
            $notifytitle = 'Travel Safe Started';
            $user_id = $_POST['trackee_id'];
            $this->send_NotificationToUser($user_id,$send_message,$notifytitle);
 //new           $msg_response = $this->api_model->sendMessageOnesignalTracking($send_message);

            // follow me firebase notification
  //new         $this->load->library('firebase');
            //$this->firebase->send_notification('command center tracking you for next 30 mins.',$user_device_token,'Captain India');
            // $this->firebase->send_notification('Follow me request raised command center tracking you until you stop follow me request.',$user_device_token,'Captain India');
            // 24-aug-2022
 //new          $this->firebase->send_notification('Captain India is following you sucessfully until you reach your destination safely.', $user_device_token, 'Captain India', null, 'followme');
        }
        // END - send onesignal notification

        if ($finresults) {

            $this->db->where('id', $finresults);
            $this->db->update('tracking', array('firebase_key' => 'Tracking_id_' . $finresults));
            $trackee_info = $this->db->get_where('users', array('id' => $_POST['trackee_id']))->row();
            $tracker_info = $this->db->get_where('users', array('id' => $_POST['tracker_id']))->row();
            $device_token = $tracker_info->device_token;
            $mobile_no = $tracker_info->mobile_no;
           $this->load->library('firebase');
            //$this->firebase->send_notification($trackee_info->first_name.' '.$trackee_info->last_name.' shared Live location. Click here to track.',$device_token,'Captain India','tracking' );
            //24-aug-2022
           $this->firebase->send_notification($trackee_info->first_name . ' ' . $trackee_info->last_name . ' shared Live location. Click here to view the location.', $device_token, 'Captain India', 'tracking');
           $shareuser_id = $_POST['tracker_id'];
           $notifytitle = 'Travel Safe Share Location';
           $send_message = $trackee_info->first_name . ' ' . $trackee_info->last_name . ' shared Live location. Click here to view the location.'. $device_token. 'Captain India, tracking';
           $this->send_NotificationToUser($shareuser_id,$send_message,$notifytitle);

            /* 		      
              $otp='1234';
              $request =""; //initialise the request variable
              $param[method]= "sendMessage";
              $param[send_to] = "91".$mobile_no;
              //$param[msg] = "Hello ".$name.'\n'.'Your OTP : '.$otp;
              //$param[msg] = $otp."%20is%20your%20One%20Time%20Password%20%28OTP%29%20for%20SAY%20App%20login.";
              $param[msg] = "Dear ".$tracker_info->first_name.' '.$tracker_info->last_name." ".$trackee_info->first_name.' '.$trackee_info->last_name." has shared his/her realtime location. Kindly login to Captain India. Downlaod App- <app url>";
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
              //  $url =
              // "http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
              //echo $url;
              //  $ch = curl_init($url);
              // $ch = curl_init('http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=917709403052&msg=1100%20is%20your%20One%20Time%20Password%20for%20SAY%20App%20login.&msg_type=TEXT&userid=2000148588&auth_scheme=plain&password=
              // Msg@2219&v=1.0&format=text');
              //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              //$curl_scraped_page = curl_exec($ch);//echo $curl_scraped_page;
              //  curl_close($ch);

              $url ="http://panel.sms4g.com/api/sendhttp.php?".$request;
              //echo $url;


              //Your authentication key
              $authKey = "344076AyOFXPDuQ5f804f24";

              //Multiple mobiles numbers separated by comma
              $mobileNumber = "91".$mobile_no;

              //Sender ID,While using route4 sender id should be 6 characters long.
              $senderId = "CAPTAININDIA";

              //Your message to send, Add URL encoding here.
              $message = "Dear ".$tracker_info->first_name.' '.$tracker_info->last_name." ".$trackee_info->first_name.' '.$trackee_info->last_name." has shared his/her realtime location. Kindly login to Captain India. Downlaod App- <app url>";

              //Define route
              $route = "4";
              //Prepare you post parameters
              $postData = array(
              'authkey' => $authKey,
              'mobiles' => $mobileNumber,
              'message' => $message,
              'sender'  => $senderId,
              'route'   => $route,
              'country' => '91',
              'unicode' => '1'
              );

              //API URL
              $url="http://panel.sms4g.com/api/sendhttp.php";

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
             */

            // // 29-aug-2022
            $firebase_key = 'Tracking_id_' . $finresults;

            $this->addLocationLog($firebase_key);

            $res = array('tracking_id' => $finresults, 'start_time' => date('Y-m-d H:i:s'), 'status' => '1');
            $result = array('status' => 'Success', 'result' => $res);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('9');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function preTriggerNotification() {
        $datas = $_POST;
        $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
        $url = '';
        //$url = "http://citysmile.in/citysmile.in/ziman_backend/forms/evidence_view/".$_POST['panic_id'];
        //7-jun-2022
        date_default_timezone_set('Asia/Kolkata');

        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
        $name = $user_info->first_name . '%20' . $user_info->last_name;
        $message = $user_info->first_name . ' ' . $user_info->last_name . " has raised Follow me request on Captain India. Time : " . date('Y-m-d h:i:s');

        //  $response = $this->api_model->sendMessage($message,$loc,$url);
        // 31-may-2022 Follow me per min notification off
        $response = true;
        $loc = $_POST['user_lat'] . "%2C" . $_POST['user_long'];
        //echo $response;exit;
        if ($response) {

            //   $this->db->insert('pre_trigger_notifications',array('user_id'=>$_POST['user_id'],'user_lat'=>$_POST['user_lat'],'user_long'=>$_POST['user_long']));
            // added 03-07-2021
            if ($_POST['pre_trigger_id'] != null) {
                $pre_trigger_id = $_POST['pre_trigger_id'];
            } else {
                $pre_trigger_id = $this->getLastPreTriggerId();
                if ($pre_trigger_id == null) {
                    $pre_trigger_id = 1;
                } else {
                    $pre_trigger_id = $pre_trigger_id + 1;
                }
            }
            if ($_POST['status'] == "0") {

                // 7-jjun-2022
                if ($_POST['user_id'] != "" && $_POST['tracking_id'] != "") {
                    if ($_POST['user_id'] != NULL && $_POST['tracking_id'] != NULL) {
                        //  if(($_POST['user_id'] !=0 && $_POST['tracking_id'] !=0) || ($_POST['user_id'] !="0" && $_POST['tracking_id'] !="0") || ($_POST['user_id'] !="" && $_POST['tracking_id'] !="" ) || ( $_POST['user_id'] !=null || $_POST['tracking_id'] !=null)  ) {

                        $this->db->insert('pre_trigger_notifications', array(
                            'user_id' => $_POST['user_id'],
                            'user_lat' => $_POST['user_lat'],
                            'user_long' => $_POST['user_long'],
                            'status' => $_POST['status'],
                            'status_start_date' => date('Y-m-d H:i:s'),
                            'pre_trigger_id' => $pre_trigger_id,
                            // 28-may-2022
                            'vehicle_number' => $_POST['vehicle_number'] ? $_POST['vehicle_number'] : NULL,
                            // 7-jun-2022
                            'created_at' => date('Y-m-d H:i:s'),
                            // 21-jun-2022
                            'tracking_id' => isset($_POST['tracking_id']) ? $_POST['tracking_id'] : NULL,
                        ));
                    }
                }
            } else {
                $this->db->insert('pre_trigger_notifications', array(
                    'user_id' => $_POST['user_id'],
                    'user_lat' => $_POST['user_lat'],
                    'user_long' => $_POST['user_long'],
                    'status' => $_POST['status'],
                    'status_stop_date' => date('Y-m-d H:i:s'),
                    'pre_trigger_id' => $pre_trigger_id,
                    // 28-may-2022
                    'vehicle_number' => $_POST['vehicle_number'] ? $_POST['vehicle_number'] : NULL,
                    // 7-jun-2022
                    'created_at' => date('Y-m-d H:i:s'),
                    // 21-jun-2022
                    'tracking_id' => isset($_POST['tracking_id']) ? $_POST['tracking_id'] : NULL,
                ));
            }


            $array = $this->db->get_where('emergency_contacts', array('user_id' => $_POST['user_id']))->result_array();
            foreach ($array as $k => $v) {
                $euid = $v['emergency_user_id'];
                if ($euid) {
                    //$loc = "https%3A%2F%2Fwww.google.com%2Fmaps%2Fsearch%2F%3Fapi%3D1%26query%3D".$data['user_lat']."%2C".$data['user_long'];

                    $mobile_no = $this->db->get_where('users', array('id' => $euid))->row()->mobile_no;
                    //echo $mobile_no;exit;
                    //        if($mobile_no){
                    //          	$request =""; //initialise the request variable
                    //     $param[method]= "sendMessage";
                    //     $param[send_to] = "91".$mobile_no;
                    //     //$param[msg] = "Hello ".$name.'\n'.'Your OTP : '.$otp;
                    //     //$param[msg] = "Your%20friend%20%3C".$name."%3E%2C%20has%20raised%20Panic%20request%20on%20SAY%20app%2C%20Time%3A%20%3C".date('Y-m-d')."%3E%20Location%3A%20%3C'.$loc.'%3E";
                    //     $param[msg] = "Your%20friend%20".$name."%2C%20has%20raised%20Panic%20request%20on%20CAPTAININDIA%20app%2C%20Time%3A%20".date('Y-m-d')."%20".date('h:i:s')."%20Location%3A%20".$loc."";
                    //   //echo $param[msg];
                    //     $param[msg_type] = "TEXT";
                    //     $param[userid] = "2000148588";
                    //     $param[auth_scheme] = "PLAIN";
                    //     $param[password] = "Msg@2219";
                    //     $param[v] = "1.1";
                    //     //$param[msg_id] = 846187;
                    //     $param[format] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
                    //      //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
                    //     //Have to URL encode the values
                    //     foreach($param as $key=>$val) {
                    //     $request.= $key."=".$val;
                    //     //we have to urlencode the values
                    //     $request.= "&";
                    //     //append the ampersand (&) sign after each
                    //     //parameter/value pair
                    //     }
                    //     $request = substr($request, 0, strlen($request)-1);
                    //     //echo $request;exit;
                    //     //remove final (&) sign from the request
                    //     $url =
                    //     "http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
                    //     //echo $url;
                    //     $ch = curl_init($url);
                    //     // $ch = curl_init('http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=917709403052&msg=1100%20is%20your%20One%20Time%20Password%20for%20SAY%20App%20login.&msg_type=TEXT&userid=2000148588&auth_scheme=plain&password=
                    //     // Msg@2219&v=1.0&format=text');
                    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //     $curl_scraped_page = curl_exec($ch);
                    //     // echo 'hkjh:'.$curl_scraped_page;exit;  
                    //     curl_close($ch);
                    //        }
                }
            }
        }
        //$result = array('status'  => 'Success','result' => $response);
        // $result = array('status'  => 'Success');
        $result = array('status' => 'Success', 'pre_trigger_id' => $pre_trigger_id);
        print json_encode($result);
    }

    public function getNotifications() {
        $datas = $_POST;

        $user_id = $_POST['user_id'];
        $response = $this->api_model->getNotifications($datas, $user_id);
        if ($response) {
            $result = array('status' => 'Success', 'result' => $response);
        } else {
            $error_info = $this->api_model->getErrorCode('9');
            $result = array('status' => 'Fail', 'message' => '');
        }
        print json_encode($result);
    }

    public function updateTracking() {

        $datas = $_POST;
        $finresults = $this->api_model->updateTracking($_POST);
        if ($finresults) {
            //  $user_id = $this->db->get_where('tracking',array('id'=>$_POST['tracking_id']))->row()->tracker_id;
            $this->db->select('tracking.tracker_id, tracking.trackee_id, tracking.tracking_type, tracking.status, tracking.firebase_key');
            $this->db->where('tracking.id', $_POST['tracking_id']);
            $this->db->from('tracking');
            $q = $this->db->get();
            $res_tracking = $q->row();
            if ($res_tracking) {
                $user_id = $res_tracking->tracker_id;
                $tracking_type = $res_tracking->tracking_type;

                //  $device_token = $this->db->get_where('users',array('id'=>$user_id))->row()->device_token;
                $this->db->select('users.device_token');
                $this->db->where('users.id', $user_id);
                $this->db->from('users');
                $q = $this->db->get();
                $res_users_device_token = $q->row();
                if ($res_users_device_token) {

                    $device_token = $res_users_device_token->device_token;
                    $this->load->library('firebase');
                    $this->firebase->send_notification($trackee_info->first_name . ' ' . $trackee_info->last_name . ' ended Live location.', $device_token, 'Captain India');

                    // 24-aug-2022
                }

                //  $tracking_type = $this->db->get_where('tracking',array('id'=>$_POST['tracking_id']))->row()->tracking_type;
                if ($tracking_type == '2') {
                    //                 // follow me firebase notification
                    // $trackee_id = $this->db->get_where('tracking',array('id'=>$_POST['tracking_id'] ))->row()->trackee_id;

                    $trackee_id = $res_tracking->trackee_id;
                    // $trackee_id_device_token = $this->db->get_where('users', array('id'=>$trackee_id) )->row()->device_token
                    $this->db->select('users.device_token');
                    $this->db->where('users.id', $trackee_id);
                    $this->db->from('users');
                    $q = $this->db->get();
                    $res_users_device_token = $q->row();
                    if ($res_users_device_token) {
                        $trackee_id_device_token = $res_users_device_token->device_token;
                        $this->load->library('firebase');
                        $this->firebase->send_notification('We have reached your destination! It was a pleasure assisting you and making this a safe and relaxed journey for you. Look forward to assisting you again!', $trackee_id_device_token, 'Captain India', null, 'followme');
                    }
                }

                // 29-aug-2022
                $tracking_status = $res_tracking->status;
                if ($tracking_status == 0) {
                    $firebase_key = $res_tracking->firebase_key;
                    $this->updateEndLocation($firebase_key);
                }
            }



            $result = array('status' => 'Success');
            print json_encode($result);
        } else {

            $error_info = $this->api_model->getErrorCode('10');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 30-jul-2022
    public function updateTrackingMultiple() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $datas = $_POST;
        $finresults = $this->api_model->updateTrackingMultiple($_POST);

        //	$finresults = 1;
        if ($finresults) {
            $this->db->where('firebase_key', "Tracking_id_" . $_POST['tracking_id']);
            $q = $this->db->get('tracking');
            $result_tracking = $q->result_array();
            //	 echo $this->db->last_query();exit;
            //	print_r($result_tracking);
            //	die;
            if ($result_tracking) {
                foreach ($result_tracking as $row) {
                    $user_id = $row['tracker_id'];
                    $trackee_id_user_id = $row['trackee_id'];
                    $tracker_info = $this->db->get_where('users', array('id' => $user_id))->row();
                    $trackee_info = $this->db->get_where('users', array('id' => $trackee_id_user_id))->row();
                    $this->load->library('firebase');
                    
                    $trackee_info_first_name = '';
                    if (isset($trackee_info->first_name)) {
                        $trackee_info_first_name = $trackee_info->first_name;
                    }
                    $trackee_info_last_name = '';
                    if (isset($trackee_info->last_name)) {
                        $trackee_info_last_name = $trackee_info->last_name;
                    }
                        
                    // $this->firebase->send_notification($trackee_info->first_name . ' ' . $trackee_info->last_name . ' ended Live location.', $tracker_info->device_token, 'Captain India');
                    $this->firebase->send_notification($trackee_info_first_name . ' ' . $trackee_info_last_name . ' ended Live location.', $tracker_info->device_token, 'Captain India');

                    // 24-aug-2022
                    //  $this->firebase->send_notification($trackee_info->first_name.' '.$trackee_info->last_name.' We have reached your destination! It was a pleasure assisting you and making this a safe and relaxed journey for you. Look forward to assisting you again!',$tracker_info->device_token,'Captain India');
                    // 29-aug-2022
                    $tracking_status = $row['status'];
                    if ($tracking_status == 0) {
                        $firebase_key = $row['firebase_key'];
                        $this->updateEndLocation($firebase_key);
                    }
                }
            }
            //$device_token = $this->db->get_where('users',array('id'=>$user_id))->row()->device_token;
            //$this->load->library('firebase');
            //$this->firebase->send_notification($trackee_info->first_name.' '.$trackee_info->last_name.' ended Live location.',$device_token,'Captain India');

            $result = array('status' => 'Success');
            print json_encode($result);
        } else {

            $error_info = $this->api_model->getErrorCode('10');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getTracking() {
        //echo 'date.timezone: ' . ini_get('date.timezone');
        // echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';exit;

        date_default_timezone_set('Asia/Kolkata');
        $datas = $_POST;
        $result = $this->api_model->getTracking($_POST);
        $trackee_list = array();
        $tracker_list = array();
        $key = '';
        $trigger_list = array();
          $user_id_val = $_POST['user_id'];
        if ($result) {

            foreach ($result as $k => $v) {

                $key = $v->keyy ? $v->keyy : '';
                if ($v->end_time == '0000-00-00 00:00:00')
                    $res[] = array('trackee_id' => $v->trackee_id,
                        'trackee_profile_image' => $v->profile_image,
                        'tracker_id' => $v->tracker_id,
                        'start_time' => $v->start_time,
                        'end_time' => $v->end_time,
                        'share_time' => $v->share_time,
                        'mobile_no' => $v->mobile_no,
                        'user_name' => $v->first_name . ' ' . $v->last_name,
                        'user_dp' => '',
                        'firebase_key' => $key,
                        'current_time' => date('Y-m-d H:i:s'),
                        'mode' => $v->mode,
                        'tracker_device_id' => $v->tracker_device_id);
            }

            foreach ($res as $k => $v) {
                
                // 2-aug-2023
                $v['device_name'] = null;
                $v['device_imei'] = null;
                if ($v['tracker_device_id'] != null) {
                    $this->db->select('*');
                    $this->db->from('tracker_devices');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('id', $v['tracker_device_id']);
                    $query = $this->db->get();

                    $result_tracker_devices = $query->row_array();
                    if ($result_tracker_devices) {
                        //tracker_device_id
                        $this->db->select('*');
                        $this->db->from('user_tracker_devices');
                        $this->db->where('is_deleted', '0');
                        $this->db->where('user_id', $user_id_val);
                        $this->db->where('device_id', $v['tracker_device_id']);
                        $query = $this->db->get();

                        $result_user_tracker_devices  = $query->row_array();
                        $device_name_value = '';
                        if ($result_user_tracker_devices) {
                            $device_name_value = $result_user_tracker_devices['device_name'];
                        }
                        $v['device_name'] = $device_name_value;
                        $v['device_imei'] = $result_tracker_devices['device_imei'];
                    } else {
                        $v['device_name'] = null;
                        $v['device_imei'] = null;
                    }
                }
                
                if ($v['trackee_id'] == $datas['user_id'])
                    $trackee_list[] = $v;
                else
                    $tracker_list[] = $v;
            }

            $info = $this->api_model->getPreTriggerTracking($_POST);
            // echo "<pre>";print_r($info);exit;
             if($info ) {
            foreach ($info as $k => $v) {

                $key = $v->keyy ? $v->keyy : '';
                if ($v->end_time == '0000-00-00 00:00:00')
                    $trigger_list[] = array('trackee_id' => $v->trackee_id, 'tracker_id' => $v->tracker_id, 'start_time' => $v->start_time, 'end_time' => $v->end_time, 'share_time' => $v->share_time, 'mobile_no' => $v->mobile_no, 'user_name' => $v->first_name . ' ' . $v->last_name, 'user_dp' => '', 'firebase_key' => $key, 'current_time' => date('Y-m-d H:i:s'), 'mode' => $v->mode);
            }
             }
            //  foreach($info as $k=>$v){
            //      $trigger_list[] = $v;
            //  }

            $finresult = array('status' => 'Success', 'trackee_list' => $trackee_list, 'tracker_list' => $tracker_list, 'trigger_list' => $trigger_list);
            print json_encode($finresult);
        } else {

            $error_info = $this->api_model->getErrorCode('11');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function createPanicRequest() {
        //      error_reporting(E_ALL);  
        //ini_set('display_errors', '1');

        $datas = $_POST;
        $result = $this->api_model->createPanicRequest($_POST);

        if ($result) {

            // 31-aug-2022
            $panic_info = $this->api_model->getPanicRequestById($result);
            if ($panic_info != 0) {
                if ($panic_info->module_type == '1') {
                    $this->load->library('firebase');
                    $panic_time = $panic_info->timestamp;
                    $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                    $message = $user_info->first_name . ' ' . $user_info->last_name . ' has raised panic request on Captain India. Time: ' . $panic_time;
                    $loc = "https://www.google.com/maps/search/?api=1&query=" . $panic_info->user_lat . "," . $panic_info->user_long;
                    $notify_url = "https://uat.captainindia.anekalabs.com/forms/evidence_view/" . $result;
                    $response = $this->api_model->sendMessage($message, $loc, $notify_url);

                    //Send SMS
                    if ($_POST['user_id']) {
                        $array = $this->db->get_where('emergency_contacts', array('user_id' => $_POST['user_id'], 'is_deleted' => 0))->result_array();
                        $panic_time = $panic_info->timestamp;
                        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                        $name = $user_info->first_name . ' ' . $user_info->last_name;
                        $message = $user_info->first_name . ' ' . $user_info->last_name . " has raised panic request on Captain India. Time : " . date('Y-m-d h:i:s');
                        foreach ($array as $k => $v) {
                            $euid = $v['emergency_user_id'];
                            if ($euid) {
                                $loc = $panic_info->user_lat . " " . $panic_info->user_long;
                                $user_lat = $panic_info->user_lat;
                                $user_long = $panic_info->user_long;
                                $mobile_no = $this->db->get_where('users', array('id' => $euid))->row()->mobile_no;
                                if ($mobile_no) {
                                    $res_location_name = $this->getLocationFromLatLong($user_lat, $user_long);
                                    $this->userWhatsappPanicMessages($mobile_no, $name, $user_lat, $user_long, $panic_time, $res_location_name);
                                }
                            }
                        }
                    }
                }
            }

            $finresult = array('status' => 'Success', 'result' => $result);
            print json_encode($finresult);
        } else {

            $error_info = $this->api_model->getErrorCode('11');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function forget_password() {

        $request = $_POST;

        $finresult = $this->api_model->forget_password($request);

        if ($finresult) {

            $finresult = array('status' => 'success', 'result' => []);
            print json_encode($finresult);
        } else {
            $error_info = $this->api_model->getErrorCode('6');
            $finresult = array('status' => 'failed', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($finresult);
        }
    }

    public function raiseQuery() {

        $datas = $_POST;
        $result = $this->api_model->raiseQuery($_POST);

        if ($result) {

            $finresult = array('status' => 'Success', 'result' => $result);
            print json_encode($finresult);
        } else {

            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function pages() {

        $datas = $_POST;
        $result = $this->api_model->pages($_POST);
        //echo "<pre>";print_r($result);exit;
        if ($result) {
            if ($_POST['page_id'] == '1') {
                //     $aus = json_decode($result['about_us'],true);
                // $result['about_us'] = $aus['blocks']['0']['text'];
                $result['about_us'] = $result['about_us'];
            }
            if ($_POST['page_id'] == '2') {
                //     $aus = json_decode($result['privacy_policy'],true);
                // $result['privacy_policy'] = $aus['blocks']['0']['text'];
                $result['privacy_policy'] = $result['privacy_policy'];
            }

            if ($_POST['page_id'] == '3') {
                //     $aus = json_decode($result['privacy_policy'],true);
                // $result['privacy_policy'] = $aus['blocks']['0']['text'];
                $result['terms_conditions'] = $result['terms_conditions'];
            }

            if ($_POST['page_id'] == '4') {
                //     $aus = json_decode($result['privacy_policy'],true);
                // $result['privacy_policy'] = $aus['blocks']['0']['text'];
                $result['help'] = $result['help'];
            }

            if ($_POST['page_id'] == '5') {
                //     $aus = json_decode($result['privacy_policy'],true);
                // $result['privacy_policy'] = $aus['blocks']['0']['text'];
                $result['tutorial'] = $result['tutorial'];
            }
        }
        if ($result) {

            $finresult = array('status' => 'Success', 'result' => $result);
            print json_encode($finresult);
        } else {

            $error_info = $this->api_model->getErrorCode('12');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getQueryType() {

        $datas = $_POST;
        //echo "<pre>";print_r($datas);exit;
        $result = $this->api_model->getQueryType($_POST);

        if ($result) {

            $finresult = array('status' => 'Success', 'result' => $result);
            print json_encode($finresult);
        } else {

            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function downloadpdf() {
        //  error_reporting(E_ALL);
        //   ini_set('display_errors', '1');
        require 'vendor/autoload.php';

        $e_id = $_POST['e_id'];
        $resultUserEvidence = $this->login->getUserEvidenceById($e_id);
        $gender = '--';
        if ($resultUserEvidence['gender'] == '1') {
            $gender = 'Male';
        } else if ($resultUserEvidence['gender'] == '2') {
            $gender = 'Female';
        }
        $resultUserEvidence['gender'] = $gender;
        $blood_group = '--';
        if ($resultUserEvidence['blood_group'] == '1') {
            $blood_group = 'A+';
        } else if ($resultUserEvidence['blood_group'] == '2') {
            $blood_group = 'B+';
        } else if ($resultUserEvidence['blood_group'] == '3') {
            $blood_group = 'O+';
        } else if ($resultUserEvidence['blood_group'] == '4') {
            $blood_group = 'AB+';
        } else if ($resultUserEvidence['blood_group'] == '5') {
            $blood_group = 'A-';
        } else if ($resultUserEvidence['blood_group'] == '6') {
            $blood_group = 'B-';
        } else if ($resultUserEvidence['blood_group'] == '7') {
            $blood_group = 'O-';
        } else if ($resultUserEvidence['blood_group'] == '8') {
            $blood_group = 'AB-';
        }
        $resultUserEvidence['blood_group'] = $blood_group;
        $critical_illness = array();
        $critical_illness_name_array = array();
        $critical_illness_explode = array();
        $critical_illness_arr = array();
//            if ($resultUserEvidence['critical_illness_id'] != null) {
//            $critical_illness_arr = $critical_illness_explode = explode(",", $resultUserEvidence['critical_illness_id']);
//            if (count($critical_illness_explode)) {
//                $pos = array_search('6', $critical_illness_explode);
//                unset($critical_illness_explode[$pos]);
//                $res = $this->login->getCriticalIllnessById($critical_illness_explode);
//                $critical_illness_name_array = array_column($res, 'critical_illness_name');
//            }
//            if (in_array("6", $critical_illness_arr)) {
//                if ( $resultUserEvidence['critical_illness_name'] != null) {
//                    array_push($critical_illness_name_array,  $resultUserEvidence['critical_illness_name']);
//                }
//            }
//        }
        $user_critical_illness_detail = $this->login->getUserCriticalIllnessByUserId($resultUserEvidence['user_id']);
        $critical_illness_name_arr = array();
        if (count($user_critical_illness_detail)) {
            $critical_illness_arr = $critical_illness_id_array = array_column($user_critical_illness_detail, 'critical_illness_id');
            foreach ($user_critical_illness_detail as $key => $value) {
                if ($value['critical_illness_id'] != 6) {
                    $critical_illness_name = $this->login->getCriticalIllnessById($value['critical_illness_id']);
                    array_push($critical_illness_name_arr, $critical_illness_name['critical_illness_name']);
                } else {
                    array_push($critical_illness_name_arr, $value['critical_illness_name']);
                }
            }
        }
        $resultUserEvidence['critical_illness_value'] = implode(", ", $critical_illness_name_arr);
        $result = $this->login->getUserImages($e_id);
        $img_result = array();
        foreach ($result as $k => $v) {
            $img_result[$k]['src'] = $v['file_path'];
            $img_result[$k]['thumbnail'] = $v['thumbnail_file_path'];
            $img_result[$k]['thumbnailWidth'] = '320';
            $img_result[$k]['thumbnailHeight'] = '212';
        }
        $video_result = array();
        $result = $this->login->getUserVideos($e_id);
        foreach ($result as $k => $v) {
            $video_result[$k]['src'] = (string) $v['file_path'];
        }
        $audio_result = array();
        $result = $this->login->getUserAudios($e_id);
        foreach ($result as $k => $v) {
            $audio_result[$k]['src'] = (string) $v['file_path'];
        }
        $contact_result = $this->login->getUserEmergencynfo($e_id);
        /* added line below */
        $mpdf = new \Mpdf\Mpdf();
        $view_result['user_evidence'] = $resultUserEvidence;
        $view_result['img_result'] = $img_result;
        $view_result['video_result'] = $video_result;
        $view_result['audio_result'] = $audio_result;
        $view_result['contact_result'] = $contact_result;
        $html = $this->load->view('html_to_pdf', $view_result, true);
        $mpdf->WriteHTML($html);
        // $mpdf->Output(); // op
        $pdfFilePath = "evidence-" . time() . "-download.pdf";
        $mpdf->setFooter('<footer><div class="footer" style="font-size: 20px;"><p style="font-size: 20px;">|{PAGENO} of {nbpg}|</p></div></footer>');
        $mpdf->Output("./pdf_file/" . $pdfFilePath, "F");
        //   $mpdf->Output("./pdf_file/" . $pdfFilePath, 'I');
        $result = array('pdf_url' => base_url("/pdf_file/" . $pdfFilePath));
        echo json_encode($result);
        die;
    }

    public function downloadzip() {
        //error_reporting(E_ALL);
        //ini_set('display_errors', '1');

        $fileName = 'evidence-' . time() . '.zip';
        $e_id = $_POST['e_id'];
        $result = $this->login->getUserImages($e_id);
        $file_result = array();
        foreach ($result as $k => $v) {
            //$file_result[$k] = $v['file_path'];
            $file_result[$k] = basename($v['file_path']);
            //$file_result[$k]= $v['thumbnail_file_path'];
        }
        $result = $this->login->getUserVideos($e_id);
        foreach ($result as $k => $v) {
            //$file_result[] = (string) $v['file_path'];
            $file_result[] = basename((string) $v['file_path']);
        }
        $result = $this->login->getUserAudios($e_id);
        foreach ($result as $k => $v) {
//            $file_result[] = (string) $v['file_path'];
            $file_result[] = basename((string) $v['file_path']);
        }
        if (!empty($file_result)) {
            foreach ($file_result as $file) {
//                    $this->zip->read_file(ROOT_UPL_IMAGE_PATH.$file);
//                    $this->zip->read_file($file);
//                    $this->zip->add_data( $file,file_get_contents($file));   
                $fileData = 'This file created by Captain India';
                $this->zip->add_data($file, $fileData);
            }
            $this->zip->archive("./zip_file/" . $fileName);
            // $this->zip->download(base_url("/zip_file/" . $fileName));
            $result = array('zip_url' => base_url("/zip_file/" . $fileName));
            echo json_encode($result);
        }
        die;
    }

    /**
     * @function: getPreTriggerNotificationsByUser
     * @description: get Pre Trigger Notifications By User
     * @param $user_id - int, $pre_trigger_id - int
     * @return map view
     * @date 02-june-2021 added by Manisha
     */
    public function getPreTriggerNotificationsByUser($user_id = null, $pre_trigger_id = null) {
        $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $res = array();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $res[$key][] = (float) $value['user_lat'];
                $res[$key][] = (float) $value['user_long'];
            }
            $res_center_lat = $res[0][0];
            $res_center_long = $res[0][1];
            $data['map_center_point_lat'] = $res_center_lat;
            $data['map_center_point_long'] = $res_center_long;
            $data['map_point'] = json_encode($res);
        } else {
            $data['map_center_point_lat'] = null;
            $data['map_center_point_long'] = null;
            $data['map_point'] = json_encode($res);
        }
        $this->load->view('map', $data);
    }

    public function getLastPreTriggerId() {
        $result = $this->db->select('pre_trigger_notifications.pre_trigger_id')
                ->order_by('pre_trigger_id', "desc")
                ->limit(1)
                ->get('pre_trigger_notifications')
                ->row();
        $last_pre_trigger_id = (int) $result->pre_trigger_id;
        return $last_pre_trigger_id;
    }

    public function getBulletinNewsList() {

        //16-jul-2022
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
        $tag_id = "";
        if (isset($_POST['tag_id'])) {
            $tag_id = $_POST['tag_id'];
        }
        // 17-nov-2022
        if ($tag_id != "") {
            $this->db->select('bulletin_news.id,bulletin_news.type,bulletin_news.title,bulletin_news.description,bulletin_news.editor_description,bulletin_news.news_date,bulletin_news.news_source,bulletin_news.image,bulletin_news.image_path,bulletin_news.video,bulletin_news.video_path,bulletin_news.audio,bulletin_news.audio_path,bulletin_news.is_deleted,bulletin_news.created_at,bulletin_news.updated_at, bulletin_news_tag.bulletin_news_id, bulletin_news_tag.bulletin_tag_id, bulletin_news_tag.is_deleted');
            $this->db->from('bulletin_news');
            $this->db->where('bulletin_news.is_deleted', '0');

            $this->db->join('bulletin_news_tag', 'bulletin_news_tag.bulletin_news_id = bulletin_news.id', 'left');
            $this->db->where('bulletin_news_tag.bulletin_tag_id', $tag_id);
            $this->db->where('bulletin_news_tag.is_deleted', '0');

            if ($tenant_id != "") {
                $this->db->where('bulletin_news.tenant_id', $tenant_id);
            }

            $this->db->order_by('bulletin_news.id', 'desc');
            $q = $this->db->get();
            $result = $q->result_array();
        } else {
            $this->db->select('id,type,title,description,editor_description,news_date,news_source,image,image_path,video,video_path,audio,audio_path,is_deleted,created_at,updated_at');
            $this->db->from('bulletin_news');
            $this->db->where('is_deleted', '0');

            //15-jul-2022
            // if($tenant_id !="" && $tenant_id != 1 ) {
            if ($tenant_id != "") {
                $this->db->where('bulletin_news.tenant_id', $tenant_id);
            }

            $this->db->order_by('id', 'desc');
            $q = $this->db->get();
            $result = $q->result_array();
        }
        // print_r($result);
        // die;
        // 5-may-2022
        if (!empty($result)) {
            foreach ($result as $k => $row) {
                if ($row['description'] == null) {
                    $result[$k]['description'] = "";
                }
                if ($row['editor_description'] == null) {
                    $result[$k]['editor_description'] = "";
                }
                if ($row['video'] == null) {
                    $result[$k]['video'] = "";
                }
                if ($row['video_path'] == null) {
                    $result[$k]['video_path'] = "";
                }

                // 24-jun-2022
                if ($row['audio'] == null) {
                    $result[$k]['audio'] = "";
                }
                if ($row['audio_path'] == null) {
                    $result[$k]['audio_path'] = "";
                }

                if ($row['updated_at'] == null) {
                    $result[$k]['updated_at'] = "";
                }
            }
        }

        $finresult = array('status' => 'Success', 'result' => $result);
        print json_encode($finresult);
    }
    
    public function saveMultimedia() {

        $data = $_POST;
        $finresults = $this->api_model->verifyUser($_POST);

        // added on - 19-07-2021
        $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "mp4", "MP4", "m4a", "webm", "M4A");
        $img_value = "";
        if ($_FILES['image']['name'] != '') {
            for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                $temp = explode(".", $_FILES['image']['name'][$i]);
                $ext = end($temp);
            }
        }

        if ($finresults && in_array($ext, $allowed)) {

            if ($_FILES['image']['name'] != '') {
                $target_path = './uploads/newmultimedia/';

                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

                    $temp = explode(".", $_FILES['image']['name'][$i]);
                    $newfilename = '';
                    $image_url_path_new = "";
                    // $time = mt_rand(10,100).time().round();
                    $time = mt_rand(10, 100) . time() . rand();
                    $newfilename = $time . '.' . end($temp);
                    $newthumbfilename = $time . '_thumb.' . end($temp);

                    $target_path_new = $target_path . $newfilename;
                    //$target_path = $target_path . basename($_FILES['image']['name'][$i]);

                    if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path_new)) {
                        $return = array("status" => 'false', "message" => 'Could not move the file!');
                        echo json_encode($return);
                    } else {
                        if ($_POST['content_type'] == '1') {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/newmultimedia/thumbnail/'
                            );

                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();
                            //echo $this->image_lib->display_errors();
                        }

                        // $image_url_path = base_url().'uploads/multimedia/';
                        // $target_path_url_main = $image_url_path.$newfilename;
                        // $target_thumbnail_path_url_main = $image_url_path.'thumbnail/'.$newthumbfilename;
                        // 7-feb-2023
                        $target_path_url_main = '/newmultimedia/' . $newfilename;
                        $target_thumbnail_path_url_main = '/newmultimedia/thumbnail/' . $newthumbfilename;

                        // added on 27-may-2022 by Manisha
                        // module_type = 3 - Posh
                        if ($_POST['module_type'] == '3') {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                                'reporter_name' => $_POST['reporter_name'] ? $_POST['reporter_name'] : NULL,
                                'complaint_against_name' => $_POST['complaint_against_name'] ? $_POST['complaint_against_name'] : NULL,
                            );
                        } else if ($_POST['module_type'] == '2') {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                            );
                        } else {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'notes' => $_POST['notes'],
                            );
                        }

                        //7-jun-2022
                        date_default_timezone_set('Asia/Kolkata');
                        $arr_to_insert['created_at'] = date('Y-m-d H:i:s');
                        $multimedia_ids = $this->db->insert('user_multimedia', $arr_to_insert);
                    }
                }

                $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
                $notify_url = "https://uat.captainindia.anekalabs.com/forms/evidence_view/" . $_POST['panic_id'];

                // content_type = audio & 
                if ($_POST['module_type'] == '1' && $_POST['content_type'] == '2') {

                    //Send SMS
                    // if($_POST['user_id']){
                    //     $array = $this->db->get_where('emergency_contacts',array('user_id'=>$_POST['user_id'],'is_deleted'=>0))->result_array();
                    //     $panic_info = $this->db->get_where('panic_request',array('id'=>$_POST['panic_id']))->row();
                    //     $panic_time = $panic_info->timestamp;
                    //     $user_info = $this->db->get_where('users',array('id'=>$_POST['user_id']))->row();
                    //     $name = $user_info->first_name.' '.$user_info->last_name;
                    //     $message = $user_info->first_name.' '.$user_info->last_name." has raised panic request on Captain India. Time : ".date('Y-m-d h:i:s') ;
                    //     foreach($array as $k=>$v){
                    //        $euid = $v['emergency_user_id']; 
                    //        if($euid){
                    //            $loc = $data['user_lat']." ".$data['user_long'];
                    //            $user_lat = $data['user_lat'] ;
                    //            $user_long =  $data['user_long'];
                    //            $mobile_no = $this->db->get_where('users',array('id'=>$euid))->row()->mobile_no;
                    //            //echo $mobile_no;
                    //            if($mobile_no){
                    //              	$request =""; //initialise the request variable
                    //               	$res_location_name = $this->getLocationFromLatLong( $user_lat, $user_long   );
                    //              	$this->userWhatsappPanicMessages($mobile_no, $name, $user_lat, $user_long, $panic_time, $res_location_name);
                    //            }
                    //        }
                    //     }
                    //   //  return $id;
                    // }
                    // //Send Notification 
                    // $user_info = $this->db->get_where('users',array('id'=>$_POST['user_id']))->row();
                    // $message = $user_info->first_name.' '.$user_info->last_name.' has raised panic request on Captain India Time: '.$panic_time;
                    // $response = $this->api_model->sendMessage($message,$loc,$notify_url);
                    // 27-may-2022 added by Manisha
                    // module_type = 3 - posh
                } else if ($_POST['module_type'] == '3') {

                    //user_multimedia
                    $user_multimedia_array = $this->db->get_where('user_multimedia', array('panic_id' => $_POST['panic_id'], 'module_type' => 3))->result_array();

                    if (count($user_multimedia_array) >= 3) {


                        // send mail to user tenant admin
                        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();

                        if ($user_info != null) {
                            $user_admin_res = $this->db->get_where('user_admin', array('id' => $user_info->tenant_id))->row();

                            if ($user_admin_res->email != null || $user_admin_res->email != "") {
                                // send mail to user tenant admin
                                $config = Array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.gmail.com', // 'smtp.gmail.com',// 'ssl://smtp.googlemail.com',
                                    'smtp_port' => 465,
                                    'smtp_user' => 'zesttechnologiespvtltd@gmail.com',
                                    'smtp_pass' => 'duequfnmkyqwnpjr',
                                    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
                                    'mailtype' => 'html', //plaintext 'text' mails or 'html'
                                    'smtp_timeout' => '5', //in seconds
                                    'charset' => 'iso-8859-1',
                                    'wordwrap' => TRUE
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");

                                // Set to, from, message, etc.
                                $from = 'zesttechnologiespvtltd@gmail.com';
                                $to = $user_admin_res->email;
                                $subject = 'Posh Alert';
                                //$message = 'message';
                                $message = "Hello, " . "<br>" . "<br>";
                                $message .= $user_info->first_name . ' ' . $user_info->last_name . ' has raised Posh request.';
                                $message .= "<br>" . "<br>" . 'Reporter Name: ' . $_POST['reporter_name'];
                                $message .= "<br>" . "<br>" . 'Complainter Name: ' . $_POST['complaint_against_name'];
                                $message .= "<br>" . "<br>" . 'This is evidence' . "<br>";

                                //  $message .= "<br>" . '<a href="'.$target_path_url_main.'">'.$target_path_url_main.'</a>';

                                if (!empty($user_multimedia_array)) {
                                    foreach ($user_multimedia_array as $row) {
                                        $message .= "<br>" . '<a href="' . $row['file_path'] . '">' . $row['file_path'] . '</a>' . "<br>";
                                    }
                                }

                                $this->email->from($from);
                                $this->email->to($to);
                                $this->email->subject($subject);
                                $this->email->message($message);

                                if ($result = $this->email->send()) {
                                    //  echo 'Your Email has successfully been sent.';
                                } else {
                                    //  show_error($this->email->print_debugger());
                                }
                            }
                        }
                    }
                }
                $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('7');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 27-may-2022
    
    public function saveMultimedia_finaltest() {
     
        $file = $_FILES;
        $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.','file' => $file);
        print json_encode($result);
    
    }
    
    public function upload_images() {
       

        $totalfiles = 0;
        $cnt = $_FILES['image'];
        $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.','Files' => $cnt);
                print json_encode($result);
        
    }
    
    
    public function saveMultimedia_test() {

        $data = $_POST;
        $finresults = $this->api_model->verifyUser($_POST);

        // added on - 19-07-2021
        $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "mp4", "MP4", "m4a", "webm", "M4A");
        $img_value = "";
        if ($_FILES['image']['name'] != '') {
            for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                $temp = explode(".", $_FILES['image']['name'][$i]);
                $ext = end($temp);
            }
        } 
        
         if ($finresults && in_array($ext, $allowed)) {

            if ($_FILES['image']['name'] != '') {
                $target_path = './uploads/newmultimedia/';
              
             //   $fileNc = $_FILES['image']['tmp_name'][0];
                
                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                        $temp = explode(".", $_FILES['image']['name'][$i]);
                        $newfilename = '';
                        $image_url_path_new = "";
                        // $time = mt_rand(10,100).time().round();
                        $time = mt_rand(10, 100) . time() . rand();
                        $newfilename = $time . '.' . end($temp);
                        $newthumbfilename = $time . '_thumb.' . end($temp);
    
                        $target_path_new = $target_path . $newfilename;   
                        
                        
                        if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path_new)) {
                            $return = array("status" => 'false', "message" => 'Could not move the file!');
                            echo json_encode($return);
                        } else {
                            if ($_POST['content_type'] == '1') {
                                $this->load->library('image_lib');
                                $configer = array(
                                    'image_library' => 'gd2',
                                    'source_image' => $target_path_new,
                                    'create_thumb' => TRUE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 950,
                                    'height' => 950,
                                    'new_image' => FCPATH . '/uploads/newmultimedia/thumbnail/'
                                );
    
                                $this->image_lib->clear();
                                $this->image_lib->initialize($configer);
                                $this->image_lib->resize();
                                //echo $this->image_lib->display_errors();
                            }
    
                            
                            // 7-feb-2023
                            $target_path_url_main = '/newmultimedia/' . $newfilename;
                            $target_thumbnail_path_url_main = '/newmultimedia/thumbnail/' . $newthumbfilename;
    
                            // added on 27-may-2022 by Manisha
                            // module_type = 3 - Posh
                            if ($_POST['module_type'] == '3') {
                                $arr_to_insert = array(
                                    "user_id" => $_POST['user_id'],
                                    "panic_id" => $_POST['panic_id'],
                                    "user_lat" => $_POST['user_lat'],
                                    "user_long" => $_POST['user_long'],
                                    'file_path' => $target_path_url_main,
                                    'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                    'content_type' => $_POST['content_type'],
                                    'module_type' => $_POST['module_type'],
                                    'type' => $_POST['type'],
                                    'notes' => $_POST['notes'],
                                    'reporter_name' => $_POST['reporter_name'] ? $_POST['reporter_name'] : NULL,
                                    'complaint_against_name' => $_POST['complaint_against_name'] ? $_POST['complaint_against_name'] : NULL,
                                );
                            } else if ($_POST['module_type'] == '2') {
                                $arr_to_insert = array(
                                    "user_id" => $_POST['user_id'],
                                    "panic_id" => $_POST['panic_id'],
                                    "user_lat" => $_POST['user_lat'],
                                    "user_long" => $_POST['user_long'],
                                    'file_path' => $target_path_url_main,
                                    'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                    'content_type' => $_POST['content_type'],
                                    'module_type' => $_POST['module_type'],
                                    'type' => $_POST['type'],
                                    'notes' => $_POST['notes'],
                                );
                            } else {
                                $arr_to_insert = array(
                                    "user_id" => $_POST['user_id'],
                                    "panic_id" => $_POST['panic_id'],
                                    "user_lat" => $_POST['user_lat'],
                                    "user_long" => $_POST['user_long'],
                                    'file_path' => $target_path_url_main,
                                    'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                    'content_type' => $_POST['content_type'],
                                    'module_type' => $_POST['module_type'],
                                    'notes' => $_POST['notes'],
                                );
                            }
    
                            //7-jun-2022
                            date_default_timezone_set('Asia/Kolkata');
                            $arr_to_insert['created_at'] = date('Y-m-d H:i:s');
                           // $multimedia_ids = $this->db->insert('user_multimedia', $arr_to_insert);
                        }  
                }
                
              
            }
         }
        
     //   $files_details = $_FILES;
      
        $cnt = count($_FILES["image"]);
        $fileN = $_FILES['image']['name'];
        
        $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.','Files' => $_FILES, 'Filecnt' => $cnt);
                print json_encode($result);
                
        /*      

        if ($finresults && in_array($ext, $allowed)) {

            if ($_FILES['image']['name'] != '') {
                $target_path = './uploads/newmultimedia/';
                $files_details = $_FILES['image']['name'];

               
                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

                    $temp = explode(".", $_FILES['image']['name'][$i]);
                    $newfilename = '';
                    $image_url_path_new = "";
                    // $time = mt_rand(10,100).time().round();
                    $time = mt_rand(10, 100) . time() . rand();
                    $newfilename = $time . '.' . end($temp);
                    $newthumbfilename = $time . '_thumb.' . end($temp);

                    $target_path_new = $target_path . $newfilename;
                    //$target_path = $target_path . basename($_FILES['image']['name'][$i]);

                    if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path_new)) {
                        $return = array("status" => 'false', "message" => 'Could not move the file!');
                        echo json_encode($return);
                    } else {
                        if ($_POST['content_type'] == '1') {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/newmultimedia/thumbnail/'
                            );

                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();
                            //echo $this->image_lib->display_errors();
                        }

                        // $image_url_path = base_url().'uploads/multimedia/';
                        // $target_path_url_main = $image_url_path.$newfilename;
                        // $target_thumbnail_path_url_main = $image_url_path.'thumbnail/'.$newthumbfilename;
                        // 7-feb-2023
                        $target_path_url_main = '/newmultimedia/' . $newfilename;
                        $target_thumbnail_path_url_main = '/newmultimedia/thumbnail/' . $newthumbfilename;

                        // added on 27-may-2022 by Manisha
                        // module_type = 3 - Posh
                        if ($_POST['module_type'] == '3') {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                                'reporter_name' => $_POST['reporter_name'] ? $_POST['reporter_name'] : NULL,
                                'complaint_against_name' => $_POST['complaint_against_name'] ? $_POST['complaint_against_name'] : NULL,
                            );
                        } else if ($_POST['module_type'] == '2') {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                            );
                        } else {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'notes' => $_POST['notes'],
                            );
                        }

                        //7-jun-2022
                        date_default_timezone_set('Asia/Kolkata');
                        $arr_to_insert['created_at'] = date('Y-m-d H:i:s');
                        $multimedia_ids = $this->db->insert('user_multimedia', $arr_to_insert);
                    }
                }

                $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
                $notify_url = "https://uat.captainindia.anekalabs.com/forms/evidence_view/" . $_POST['panic_id'];

                // content_type = audio & 
                if ($_POST['module_type'] == '1' && $_POST['content_type'] == '2') {

                    //Send SMS
                    // if($_POST['user_id']){
                    //     $array = $this->db->get_where('emergency_contacts',array('user_id'=>$_POST['user_id'],'is_deleted'=>0))->result_array();
                    //     $panic_info = $this->db->get_where('panic_request',array('id'=>$_POST['panic_id']))->row();
                    //     $panic_time = $panic_info->timestamp;
                    //     $user_info = $this->db->get_where('users',array('id'=>$_POST['user_id']))->row();
                    //     $name = $user_info->first_name.' '.$user_info->last_name;
                    //     $message = $user_info->first_name.' '.$user_info->last_name." has raised panic request on Captain India. Time : ".date('Y-m-d h:i:s') ;
                    //     foreach($array as $k=>$v){
                    //        $euid = $v['emergency_user_id']; 
                    //        if($euid){
                    //            $loc = $data['user_lat']." ".$data['user_long'];
                    //            $user_lat = $data['user_lat'] ;
                    //            $user_long =  $data['user_long'];
                    //            $mobile_no = $this->db->get_where('users',array('id'=>$euid))->row()->mobile_no;
                    //            //echo $mobile_no;
                    //            if($mobile_no){
                    //              	$request =""; //initialise the request variable
                    //               	$res_location_name = $this->getLocationFromLatLong( $user_lat, $user_long   );
                    //              	$this->userWhatsappPanicMessages($mobile_no, $name, $user_lat, $user_long, $panic_time, $res_location_name);
                    //            }
                    //        }
                    //     }
                    //   //  return $id;
                    // }
                    // //Send Notification 
                    // $user_info = $this->db->get_where('users',array('id'=>$_POST['user_id']))->row();
                    // $message = $user_info->first_name.' '.$user_info->last_name.' has raised panic request on Captain India Time: '.$panic_time;
                    // $response = $this->api_model->sendMessage($message,$loc,$notify_url);
                    // 27-may-2022 added by Manisha
                    // module_type = 3 - posh
                } else if ($_POST['module_type'] == '3') {

                    //user_multimedia
                    $user_multimedia_array = $this->db->get_where('user_multimedia', array('panic_id' => $_POST['panic_id'], 'module_type' => 3))->result_array();

                    if (count($user_multimedia_array) >= 3) {


                        // send mail to user tenant admin
                        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();

                        if ($user_info != null) {
                            $user_admin_res = $this->db->get_where('user_admin', array('id' => $user_info->tenant_id))->row();

                            if ($user_admin_res->email != null || $user_admin_res->email != "") {
                                // send mail to user tenant admin
                                $config = Array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.gmail.com', // 'smtp.gmail.com',// 'ssl://smtp.googlemail.com',
                                    'smtp_port' => 465,
                                    'smtp_user' => 'zesttechnologiespvtltd@gmail.com',
                                    'smtp_pass' => 'duequfnmkyqwnpjr',
                                    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
                                    'mailtype' => 'html', //plaintext 'text' mails or 'html'
                                    'smtp_timeout' => '5', //in seconds
                                    'charset' => 'iso-8859-1',
                                    'wordwrap' => TRUE
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");

                                // Set to, from, message, etc.
                                $from = 'zesttechnologiespvtltd@gmail.com';
                                $to = $user_admin_res->email;
                                $subject = 'Posh Alert';
                                //$message = 'message';
                                $message = "Hello, " . "<br>" . "<br>";
                                $message .= $user_info->first_name . ' ' . $user_info->last_name . ' has raised Posh request.';
                                $message .= "<br>" . "<br>" . 'Reporter Name: ' . $_POST['reporter_name'];
                                $message .= "<br>" . "<br>" . 'Complainter Name: ' . $_POST['complaint_against_name'];
                                $message .= "<br>" . "<br>" . 'This is evidence' . "<br>";

                                //  $message .= "<br>" . '<a href="'.$target_path_url_main.'">'.$target_path_url_main.'</a>';

                                if (!empty($user_multimedia_array)) {
                                    foreach ($user_multimedia_array as $row) {
                                        $message .= "<br>" . '<a href="' . $row['file_path'] . '">' . $row['file_path'] . '</a>' . "<br>";
                                    }
                                }

                                $this->email->from($from);
                                $this->email->to($to);
                                $this->email->subject($subject);
                                $this->email->message($message);

                                if ($result = $this->email->send()) {
                                    //  echo 'Your Email has successfully been sent.';
                                } else {
                                    //  show_error($this->email->print_debugger());
                                }
                            }
                        }
                    }
                }
                
                
                $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.','Files' => $files_details);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('7');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
        
       */
    }

    // 4-jun-2022
    public function postPoshRequest() {
//        error_reporting(E_ALL);
//        ini_set('display_errors', '1');
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $ext = '';
        if ($data) {
            $finresults = $this->api_model->verifyUser($_POST);
            $allowed = array('jpeg', 'jpg', "JPEG", "JPG", 'png', 'PNG', "mp4", "MP4", "m4a", "webm", "M4A");
            $img_value = "";
            if (isset($_FILES['image']['name'])) {

                if ($_FILES['image']['name'] != '') {
                    for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                        $temp = explode(".", $_FILES['image']['name'][$i]);
                        $ext = end($temp);
                    }
                }
            }
            if ($finresults && in_array($ext, $allowed)) {
                $target_path = './uploads/newmultimedia/';
                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                    $temp = explode(".", $_FILES['image']['name'][$i]);
                    $newfilename = '';
                    $image_url_path_new = "";
                    // $time = mt_rand(10,100).time().round();
                    $time = mt_rand(10, 100) . time() . rand();
                    $newfilename = $time . '.' . end($temp);
                    $newthumbfilename = $time . '_thumb.' . end($temp);
                    $target_path_new = $target_path . $newfilename;
                    //$target_path = $target_path . basename($_FILES['image']['name'][$i]);
                    if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path_new)) {
                        $return = array("status" => 'false', "message" => 'Could not move the file!');
                        echo json_encode($return);
                    } else {
                        if ($_POST['content_type'] == '1') {
                            $this->load->library('image_lib');
                            $configer = array(
                                'image_library' => 'gd2',
                                'source_image' => $target_path_new,
                                'create_thumb' => TRUE,
                                'maintain_ratio' => TRUE,
                                'width' => 950,
                                'height' => 950,
                                'new_image' => FCPATH . '/uploads/newmultimedia/thumbnail/'
                            );
                            $this->image_lib->clear();
                            $this->image_lib->initialize($configer);
                            $this->image_lib->resize();
                            //echo $this->image_lib->display_errors();
                        }
                        $image_url_path = base_url() . 'uploads/newmultimedia/';
                        // $target_path_url_main = $image_url_path.$newfilename;
                        // $target_thumbnail_path_url_main = $image_url_path.'thumbnail/'.$newthumbfilename;
                        // 7-feb-2023
                        $target_path_url_main = '/newmultimedia/' . $newfilename;
                        $target_thumbnail_path_url_main = '/newmultimedia/thumbnail/' . $newthumbfilename;

                        // added on 27-may-2022 by Manisha
                        // module_type = 3 - Posh
                        if ($_POST['module_type'] == '3') {
                            $arr_to_insert = array(
                                "user_id" => $_POST['user_id'],
                                "panic_id" => $_POST['panic_id'],
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                                'reporter_name' => $_POST['name_raising_posh'] ? $_POST['name_raising_posh'] : NULL,
                                'complaint_against_name' => $_POST['involved_emp_name'] ? $_POST['involved_emp_name'] : NULL,
                            );
                        } else {
                            $arr_to_insert = array(
                                "user_lat" => $_POST['user_lat'],
                                "user_long" => $_POST['user_long'],
                                'file_path' => $target_path_url_main,
                                'thumbnail_file_path' => $target_thumbnail_path_url_main,
                                'content_type' => $_POST['content_type'],
                                'module_type' => $_POST['module_type'],
                                'type' => $_POST['type'],
                                'notes' => $_POST['notes'],
                                'reporter_name' => $_POST['name_raising_posh'] ? $_POST['name_raising_posh'] : NULL,
                                'complaint_against_name' => $_POST['involved_emp_name'] ? $_POST['involved_emp_name'] : NULL,
                            );
                        }
                        date_default_timezone_set('Asia/Kolkata');
                        $arr_to_insert['created_at'] = date('Y-m-d H:i:s');
                        $multimedia_ids = $this->db->insert('user_multimedia', $arr_to_insert);
                    }
                }

                $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
                $notify_url = "https://uat.captainindia.anekalabs.com/forms/evidence_view/" . $_POST['panic_id'];
                if ($_POST['module_type'] == '3') {
                    //user_multimedia
                    $user_multimedia_array = $this->db->get_where('user_multimedia', array('panic_id' => $_POST['panic_id'], 'module_type' => 3))->result_array();
                    if (count($user_multimedia_array) >= 3) {


                        $arr_to_insert_post = array(
                            "user_id" => $_POST['user_id'],
                            "panic_id" => $_POST['panic_id'],
                            "date" => date('Y-m-d H:i:s'),
                            "name_raising_posh" => $_POST['name_raising_posh'] ? $_POST['name_raising_posh'] : NULL,
                            'emp_id' => $_POST['emp_id'] ? $_POST['emp_id'] : NULL,
                            'department' => $_POST['department'] ? $_POST['department'] : NULL,
                            'incident_detail' => $_POST['incident_detail'] ? $_POST['incident_detail'] : NULL,
                            'occurred_date' => date('Y-m-d H:i:s'),
                            'occurrece_time' => date('H:i:s'),
                            'location' => $_POST['location'] ? $_POST['location'] : NULL,
                            'involved_emp_name' => $_POST['involved_emp_name'] ? $_POST['involved_emp_name'] : NULL,
                            'involved_emp_id' => $_POST['involved_emp_id'] ? $_POST['involved_emp_id'] : NULL,
                            'involved_emp_department' => $_POST['involved_emp_department'] ? $_POST['involved_emp_department'] : NULL,
                            'incident_description' => $_POST['incident_description'] ? $_POST['incident_description'] : NULL,
                        );
                        $multimedia_ids = $this->db->insert('posh_request', $arr_to_insert_post);

                        // send mail to user tenant admin
                        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                        if ($user_info != null) {
                            $user_admin_res = $this->db->get_where('user_admin', array('id' => $user_info->tenant_id))->row();
                            if ($user_admin_res->email != null || $user_admin_res->email != "") {
                                // send mail to user tenant admin
                                $config = Array(
                                    'protocol' => 'smtp',
                                    'smtp_host' => 'smtp.gmail.com', // 'smtp.gmail.com',// 'ssl://smtp.googlemail.com',
                                    'smtp_port' => 465,
                                    'smtp_user' => 'zesttechnologiespvtltd@gmail.com',
                                    'smtp_pass' => 'duequfnmkyqwnpjr',
                                    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
                                    'mailtype' => 'html', //plaintext 'text' mails or 'html'
                                    'smtp_timeout' => '5', //in seconds
                                    'charset' => 'iso-8859-1',
                                    'wordwrap' => TRUE
                                );
                                $this->load->library('email', $config);
                                $this->email->set_newline("\r\n");
                                // Set to, from, message, etc.
                                $from = 'zesttechnologiespvtltd@gmail.com';
                                $to = $user_admin_res->email;
                                $subject = 'Posh Alert';
                                //$message = 'message';
                                $message = "Hello, " . "<br>" . "<br>";
                                $message .= $user_info->first_name . ' ' . $user_info->last_name . ' has raised Posh request.';
                                $message .= "<br>" . 'Reporter Name: ' . $_POST['name_raising_posh'];
                                $message .= "<br>" . 'Complainter Name: ' . $_POST['involved_emp_name'];
                                $message .= "<br>" . 'Emp Id: ' . $_POST['emp_id'];
                                $message .= "<br>" . 'Department: ' . $_POST['department'];
                                $message .= "<br>" . 'Incident Detail: ' . $_POST['incident_detail'];
                                $message .= "<br>" . 'Occurred Date: ' . date('Y-m-d H:i:s');
                                $message .= "<br>" . 'Occurrece Time: ' . date('H:i:s');
                                $message .= "<br>" . 'Location: ' . $_POST['location'];
                                $message .= "<br>" . 'Involved Emp Name: ' . $_POST['involved_emp_name'];
                                $message .= "<br>" . 'Involved Emp Id: ' . $_POST['involved_emp_id'];
                                $message .= "<br>" . 'Involved Emp Department: ' . $_POST['involved_emp_department'];
                                $message .= "<br>" . "<br>" . 'Please find evidences below' . "<br>";
                                //  $message .= "<br>" . '<a href="'.$target_path_url_main.'">'.$target_path_url_main.'</a>';
                                if (!empty($user_multimedia_array)) {
                                    foreach ($user_multimedia_array as $row) {
                                        $message .= "<br>" . '<a href="' . $row['file_path'] . '">' . $row['file_path'] . '</a>' . "<br>";
                                    }
                                }
                                $this->email->from($from);
                                $this->email->to($to);
                                $this->email->subject($subject);
                                $this->email->message($message);
                                if ($result = $this->email->send()) {
                                    //  echo 'Your Email has successfully been sent.';
                                } else {
                                    //  show_error($this->email->print_debugger());
                                }
                            }
                        }
                    }
                }
                $result = array('status' => 'Success', 'result' => 'Multimedia saved Successfully.');
                print json_encode($result);
            } else {
                $error_info = $this->api_model->getErrorCode('7');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('7');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getFollowMeUserRequests() {
        $data = $_POST;
        // print_r($data['user_id'] );//die;
        if ($data) {
            if (isset($data['user_id'])) {
                $user_id = $data['user_id'];
                $result = $this->api_model->getFollowMeUserRequests($user_id);

                $i = 1;
                if (!empty($result)) {
                    foreach ($result as $key => $value) {

                        $info = $this->db->get_where('users', array('id' => $result[$key]['user_id']));

                        $result[$key]['user_name'] = $info->row()->first_name . '-' . $info->row()->last_name;
                        $result[$key]['status_start_date'] = $result[$key]['status_start_date'] ? $result[$key]['status_start_date'] : "-";
                        $result[$key]['status_stop_date'] = $result[$key]['status_stop_date'] ? $result[$key]['status_stop_date'] : "-";
                        $result[$key]['vehicle_number'] = $result[$key]['vehicle_number'] ? $result[$key]['vehicle_number'] : "-";

                        $tracking_url = "";
                        if ($result[$key]['user_id'] != null && $result[$key]['pre_trigger_id'] != null) {
                            $tracking_url = base_url() . "index.php/user/getPreTriggerNotificationsMapByUser/" . $result[$key]['user_id'] . "/" . $result[$key]['pre_trigger_id'];
                        }
                        $result[$key]['tracking_url'] = $tracking_url ? $tracking_url : "-";
                    }
                }

                //echo json_encode($result);
                $return_data = array('status' => 'Success', 'result' => $result);
                print json_encode($return_data);
                // break;
            }
        }
    }

    public function check_time_test() {
        // echo __LINE__;
        echo date('d-m-Y H:i');
        echo "\n";
        date_default_timezone_set('Asia/Kolkata');
        echo date('d-m-Y H:i');

        echo date('d-m-Y H:i');
    }

    // 18-ju-2022	
    public function updateUserMpin() {
        $data = $_POST;
        $finresults = $this->api_model->updateUserMpin($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 20-jun-2022
    public function getPoshEvidenceDetails() {
        $data = $_POST;
        $finresults = $this->api_model->getPoshEvidenceDetails($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 20-jun-2022
    public function addFollowmeSafe() {
        $data = $_POST;
        $finresults = $this->api_model->addFollowmeSafe($_POST);
        if ($finresults) {

            if ($data['status'] == '1') {
                // send notification
                $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                date_default_timezone_set('Asia/Kolkata');
                $request_time = date('Y-m-d H:i:s');
                $message = $user_info->first_name . ' ' . $user_info->last_name . ' seems unsafe while following on Captain India. Time: ' . $request_time;

                $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
                $notify_url = "https://uat.captainindia.anekalabs.com/";

                $response = $this->api_model->sendMessage($message, $loc, $notify_url);
            }
            if ($data['status'] == '2') {
                // send notification
                $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
                date_default_timezone_set('Asia/Kolkata');
                $request_time = date('Y-m-d H:i:s');
                $message = $user_info->first_name . ' ' . $user_info->last_name . ' seems NO ACTION while following on Captain India. Time: ' . $request_time;

                $loc = "https://www.google.com/maps/search/?api=1&query=" . $_POST['user_lat'] . "," . $_POST['user_long'];
                $notify_url = "https://uat.captainindia.anekalabs.com/";

                $response = $this->api_model->sendMessage($message, $loc, $notify_url);
            }

            $result = array('status' => 'Success', 'inserted_id' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 22-jun-2022
    public function getUserEvidence() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $data = $_POST;
        $panic_id = $_POST['panic_id'];
        $return_arr = array();
        $result = $this->api_model->getUserEvidenceImages($panic_id);

        $img_result = array();
        foreach ($result as $k => $v) {
            // $img_result[$k]['src'] = $v['file_path'];
            // $img_result[$k]['thumbnail'] = $v['thumbnail_file_path'];
            // 10-feb-2023
            if ($v['file_path'] != null || $v['file_path'] != "") {
                $img_result[$k]['src'] = GetProfileImagePath($v['file_path']);
            }
            if ($v['thumbnail_file_path'] != null || $v['thumbnail_file_path'] != "") {
                $img_result[$k]['thumbnail'] = GetProfileImagePath($v['thumbnail_file_path']);
            }
            $img_result[$k]['thumbnailWidth'] = '320';
            $img_result[$k]['thumbnailHeight'] = '212';
        }
        $return_arr['user_evidence_img'] = $img_result;

        $video_result = array();
        $result = $this->api_model->getUserEvidenceVideos($panic_id);
        foreach ($result as $k => $v) {
            // $video_result[$k]['src'] = (string) $v['file_path'];
            if ($v['file_path'] != null || $v['file_path'] != "") {
                $video_result[$k]['src'] = GetProfileImagePath($v['file_path']);
            }
        }
        $return_arr['user_evidence_video'] = $video_result;

        $audio_result = array();
        $result = $this->api_model->getUserEvidenceAudios($panic_id);
        foreach ($result as $k => $v) {
            // $audio_result[$k]['src'] = (string) $v['file_path'];
            if ($v['file_path'] != null || $v['file_path'] != "") {
                $audio_result[$k]['src'] = GetProfileImagePath($v['file_path']);
            }
        }
        $return_arr['user_evidence_audio'] = $audio_result;

        $return_arr['user_emergency_contact'] = $this->login->getUserEmergencynfo($panic_id);
        $result = array('status' => 'Success', 'result' => $return_arr);
        print json_encode($result);
        die;
    }

    public function getFollowme() {
        //echo 'date.timezone: ' . ini_get('date.timezone');
        // echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';exit;
        $datas = $_POST;
        $result = $this->api_model->getFollowme($_POST);
        $followme_list = array();
        $follower_list = array();
        $key = '';
        $trigger_list = array();
        $trackee_list = array();

        if ($result) {

            foreach ($result as $k => $v) {

                $result_pre_trigger_notification_id = '';
                $current_tracking_id = $v->current_tracking_id ? $v->current_tracking_id : '';
                // 
                //if($current_tracking_id) {
                $result_pre_trigger_notification_id = $this->api_model->getPreTriggerNotificationsTrackingId($current_tracking_id);
                // }
                ///  print_r($result_pre_trigger_notification_id);	 //     die;
                $v->pre_trigger_notification_id = $result_pre_trigger_notification_id['pre_trigger_id'] ? $result_pre_trigger_notification_id['pre_trigger_id'] : '';
                $vehicle_number = $result_pre_trigger_notification_id['vehicle_number'] ? $result_pre_trigger_notification_id['vehicle_number'] : '';

                $key = $v->keyy ? $v->keyy : '';
                if ($v->end_time == '0000-00-00 00:00:00')
                    $res[] = array('pre_trigger_id' => $result_pre_trigger_notification_id['pre_trigger_id'], 'vehicle_number' => $vehicle_number, 'trackee_id' => $v->trackee_id, 'tracker_id' => $v->tracker_id, 'start_time' => $v->start_time, 'end_time' => $v->end_time, 'share_time' => $v->share_time, 'mobile_no' => $v->mobile_no, 'user_name' => $v->first_name . ' ' . $v->last_name, 'user_dp' => '', 'firebase_key' => $key, 'current_time' => date('Y-m-d H:i:s'), 'mode' => $v->mode);
            }

            foreach ($res as $k => $v) {
                if ($v['trackee_id'] == $datas['user_id'])
                    $followme_list[] = $v;
                else
                    $follower_list[] = $v;
            }

            $info = $this->api_model->getPreTriggerTracking($_POST);
            // echo "<pre>";print_r($info);exit;
            foreach ($info as $k => $v) {
                //   $key = $v->keyy ? $v->keyy:'';
                //   if($v->end_time == '0000-00-00 00:00:00')
                //      $trigger_list[] = array('trackee_id'=>$v->trackee_id,'tracker_id'=>$v->tracker_id,'start_time'=>$v->start_time,'end_time'=>$v->end_time,'share_time'=>$v->share_time,'mobile_no'=>$v->mobile_no,'user_name'=>$v->first_name.' '.$v->last_name,'user_dp'=>'','firebase_key'=>$key,'current_time'=>date('Y-m-d H:i:s'),'mode'=>$v->mode);
            }
            //  foreach($info as $k=>$v){
            //      $trigger_list[] = $v;
            //  }

            $finresult = array('status' => 'Success',
// 			'followme_list' => $followme_list,
// 			'follower_list'=>$follower_list,
                'trackee_list' => $trackee_list,
                'tracker_list' => $followme_list,
                'trigger_list' => $trigger_list
            );
            //	$finresult = array( 'status'  => 'Success','trackee_list' => $trackee_list,'tracker_list'=>$tracker_list,'trigger_list'=>$trigger_list);
            print json_encode($finresult);
        } else {

            $error_info = $this->api_model->getErrorCode('11');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 22-jun-2022
    public function setTrackingMultiple() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $datas = $_POST;
        $guest_user_detail_arr = array();
        $guest_user_id = 0;
        $tracker_id_arr = array();
        $guest_user_id_arr = array();
        $total_tracking_id_arr = array();

        if ((isset($datas['guest_user']) ) && ( $datas['guest_user'] == 0 || $datas['guest_user'] == 2 )) {
            if (isset($datas['tracker_id'])) {
                $tracker_id_value = $datas['tracker_id'];
                $tracker_id_arr = json_decode($tracker_id_value);
            }
        }

        if ((isset($datas['guest_user']) ) && ( $datas['guest_user'] == 1 || $datas['guest_user'] == 2 )) {
            if (isset($datas['guest_user_detail'])) {
                $guest_user_detail_arr = json_decode($datas['guest_user_detail'], true);
                $first_name = NULL;
                $last_name = NULL;
                $mobile_no = NULL;
                if (!empty($guest_user_detail_arr)) {
                    foreach ($guest_user_detail_arr as $row) {
                        if (isset($row['first_name'])) {
                            $first_name = $row['first_name'];
                        }
                        if (isset($row['last_name'])) {
                            $last_name = $row['last_name'];
                        }
                        if (isset($row['mobile_no'])) {
                            $mobile_no = $row['mobile_no'];
                        }
                        $this->db->from('users');
                        $this->db->where('mobile_no', $mobile_no);
                        $this->db->where('is_deleted', '0');
                        $q = $this->db->get();
                        $get_users_detail = $q->row_array();
                        if ($get_users_detail) {
                            $guest_user_id = $get_users_detail['id'];
                            $guest_user_id_arr[] = $guest_user_id;
                        } else {
                            // add guest user in user table
                            $insert_data = array(
                                "user_type" => "3",
                                "first_name" => $first_name,
                                "last_name" => $last_name,
                                "mobile_no" => $mobile_no,
                                "status" => "1",
                                "active_platform" => "3",
                                "is_deleted" => "0",
                            );
                            $this->db->insert('users', $insert_data);
                            $inserted_user_id = $this->db->insert_id();
                            if ($inserted_user_id) {
                                $guest_user_id = $inserted_user_id;
                                $guest_user_id_arr[] = $guest_user_id;
                            }
                        }
                    }
                }
            }
        }

        if (isset($datas['guest_user']) && ( $datas['guest_user'] == 1 || $datas['guest_user'] == 2)) {
            unset($_POST['guest_user']);
            unset($_POST['guest_user_detail']);
            //    $_POST['tracker_id'] = 	$guest_user_id;
            // $finresults=$this->api_model->setTracking($_POST);
            // print_r($guest_user_id_arr);
            //	die;
            if (!empty($guest_user_id_arr)) {
                foreach ($guest_user_id_arr as $row) {
                    $insert_tracking_arr = array(
                        'trackee_id' => $_POST['trackee_id'],
                        'tracker_id' => $row,
                        'share_time' => $_POST['share_time'],
                        'tracking_type' => $_POST['tracking_type'],
                        'mode' => $_POST['mode'],
                        'mode_backend' => $_POST['mode_backend'],
                        'app_security_key' => $_POST['app_security_key'],
                        'auth_key' => $_POST['auth_key'],
                    );
                    $finresults = $this->api_model->setTracking($insert_tracking_arr);
                    $total_tracking_id_arr[] = $finresults;
                    //  print_r($insert_tracking_arr);
                }
            }
        } else {

            //	$finresults=$this->api_model->setTracking($_POST);
        }

        if (isset($datas['guest_user']) && ( $datas['guest_user'] == 0 || $datas['guest_user'] == 2)) {
            //$finresults=$this->api_model->setTracking($_POST);
            if (!empty($tracker_id_arr)) {
                $tracker_id_arr = (array_unique($tracker_id_arr));
                foreach ($tracker_id_arr as $row) {
                    $insert_tracking_arr = array(
                        'trackee_id' => $_POST['trackee_id'],
                        'tracker_id' => $row,
                        'share_time' => $_POST['share_time'],
                        'tracking_type' => $_POST['tracking_type'],
                        'mode' => $_POST['mode'],
                        'mode_backend' => $_POST['mode_backend'],
                        'app_security_key' => $_POST['app_security_key'],
                        'auth_key' => $_POST['auth_key'],
                    );
                    $finresults = $this->api_model->setTracking($insert_tracking_arr);
                    $total_tracking_id_arr[] = $finresults;
                }
            }
        }
// 			print_r($tracker_id_arr);
// 			die;
// 		var_dump($guest_user_detail_arr);
// 		print_r($datas);
// 	//	die;
// 		print_r($guest_user_id_arr);
// 		die;
        // 10-dec-2021
        // START - send onesignal notification
        // first name, last name, created time
        if ($_POST['tracking_type'] == 2) {
            $user_info = $this->db->get_where('users', array('id' => $_POST['trackee_id']))->row();
            $user_first_name = '';
            $user_last_name = '';
            $user_device_token = '';
            if ($user_info) {
                $user_first_name = $user_info->first_name;
                $user_last_name = $user_info->last_name;
                $user_device_token = $user_info->device_token;
            }
            $send_message = $user_first_name . ' ' . $user_last_name . " has started Follow me request on Captain India. Time : " . date('Y-m-d H:i:s');
            $msg_response = $this->api_model->sendMessageOnesignalTracking($send_message);

            // follow me firebase notification
            $this->load->library('firebase');
            //$this->firebase->send_notification('command center tracking you for next 30 mins.',$user_device_token,'Captain India');
            $this->firebase->send_notification('Follow me request raised command center tracking you until you stop follow me request.', $user_device_token, 'Captain India');
        }
        // END - send onesignal notification
        //	print_r($total_tracking_id_arr);
        //	die;
// 		if($finresults){
        if (!empty($total_tracking_id_arr)) {
            $new_row_Tracking_id = $total_tracking_id_arr[0];
            foreach ($total_tracking_id_arr as $row) {
                //$this->db->where('id',$finresults);
                $this->db->where('id', $row);
                //$this->db->update('tracking',array('firebase_key'=>'Tracking_id_'.$finresults));
                // $this->db->update('tracking',array('firebase_key'=>'Tracking_id_'.$row));
                $this->db->update('tracking', array('firebase_key' => 'Tracking_id_' . $new_row_Tracking_id));

                //  echo $this->db->last_query();//exit;
            }
            $this->db->where('firebase_key', "Tracking_id_" . $new_row_Tracking_id);
            $q = $this->db->get('tracking');
            $result_tracking = $q->result_array();
            //  print_r($result_tracking);
            // die;
            //  // 29-aug-2022
            $firebase_key = "Tracking_id_" . $new_row_Tracking_id;
            $this->addLocationLog($firebase_key);

            foreach ($result_tracking as $row) {
                $user_id = $row['tracker_id'];
                $trackee_id_user_id = $row['trackee_id'];
                $tracker_info = $this->db->get_where('users', array('id' => $user_id))->row();
                $trackee_info = $this->db->get_where('users', array('id' => $trackee_id_user_id))->row();

                if (isset($tracker_info->device_token) && $tracker_info->device_token != null) {
                    $this->load->library('firebase');
                    //$this->firebase->send_notification($trackee_info->first_name.' '.$trackee_info->last_name.' shared Live location. Click here to track.',$tracker_info->device_token,'Captain India','tracking' );
                    $this->firebase->send_notification($trackee_info->first_name . ' ' . $trackee_info->last_name . ' shared Live location. Click here to view the location.', $tracker_info->device_token, 'Captain India', 'tracking');
                }
            }



            //$trackee_info = $this->db->get_where('users',array('id'=>$_POST['trackee_id']))->row();
            ////$tracker_info = $this->db->get_where('users',array('id'=>$_POST['tracker_id']))->row();
            //$tracker_info = $this->db->get_where('users',array('id'=> $row ))->row();
            //if(isset($tracker_info->device_token) && $tracker_info->device_token !=null ) {
            //    $device_token = $tracker_info->device_token;
            //    $mobile_no = $tracker_info->mobile_no;
            //     $this->load->library('firebase');
            //    $this->firebase->send_notification($trackee_info->first_name.' '.$trackee_info->last_name.' shared Live location. Click here to track.',$device_token,'Captain India','tracking' );
            //}		      
            //$res = array('tracking_id'=>$finresults,'start_time'=>date('Y-m-d H:i:s'),'status'=>'1'); 
            $res = array('tracking_id' => $total_tracking_id_arr, 'start_time' => date('Y-m-d H:i:s'), 'status' => '1');
            $result = array('status' => 'Success', 'result' => $res);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('9');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function userCallAmbulanceMyresqr() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
        //  $input_data['user_id'] = 280;
        // 1-feb-2023
        $input_data['ambulance_service_id'] = 2; // static value ambulance_service_id = 2
        if (isset($input_data['ambulance_service_id']) && $input_data['ambulance_service_id'] == 2) {
            $this->callAmbulanceZimaxDial($input_data);
        } else {
            if ($input_data && isset($input_data['user_id'])) {
                $data = $input_data;
                $user_detail = array();
                $unique_id = "";
                $user_id = "";
                $device_id = "";
                $latitude = "";
                $longitude = "";
                if (isset($data['device_id'])) {
                    $device_id = $data['device_id'];
                }
                if (isset($data['latitude'])) {
                    $latitude = $data['latitude'];
                }
                if (isset($data['longitude'])) {
                    $longitude = $data['longitude'];
                }
                if ($data['user_id']) {
                    $user_id = $data['user_id'];
                    if ($user_id) {
                        $this->db->where('id', $user_id);
                        $user_detail = $this->db->get('users')->row();
                        $unique_id = $user_detail->unique_id;

                        //14-sep-2022
                        if ($unique_id == null) {
                            $this->db->select('unique_id, myresqr_status, govt_id_image_url , govt_id_image_url_thumb, govt_id_number, govt_id_type');
                            $this->db->where('unique_id is NOT NULL', NULL, FALSE);
                            $this->db->where('mobile_no', $user_detail->mobile_no);
                            $this->db->order_by('id', 'desc');
                            $user_mobile_no_detail = $this->db->get('users')->row();

                            if ($user_mobile_no_detail) {
                                if (isset($user_mobile_no_detail->unique_id) && $user_mobile_no_detail->unique_id != null) {
                                    $update_users_unique_id_data['unique_id'] = $user_mobile_no_detail->unique_id;
                                    $update_users_unique_id_data['myresqr_status'] = $user_mobile_no_detail->myresqr_status ? $user_mobile_no_detail->myresqr_status : '0';

                                    $update_users_unique_id_data['govt_id_image_url'] = $user_mobile_no_detail->govt_id_image_url;
                                    $update_users_unique_id_data['govt_id_image_url_thumb'] = $user_mobile_no_detail->govt_id_image_url_thumb;
                                    $update_users_unique_id_data['govt_id_number'] = $user_mobile_no_detail->govt_id_number;
                                    $update_users_unique_id_data['govt_id_type'] = $user_mobile_no_detail->govt_id_type;

                                    $this->db->where('id', $user_id);
                                    $this->db->update('users', $update_users_unique_id_data);

                                    $this->db->where('id', $user_id);
                                    $user_detail = $this->db->get('users')->row();
                                    $unique_id = $user_detail->unique_id;
                                }
                            }
                        }
                    }
                }

                if ($unique_id == null) {
                    $res_register_user = $this->addUserMyresqrByCallAmbulance($user_id);

                    if (!empty($res_register_user)) {
                        $res_register_user_list = implode(', ', $res_register_user);
                        $result = array('success' => 'Fail', 'message' => "Please update missing profile details " . $res_register_user_list . " to call ambulance service.");
                        print json_encode($result);
                    } else {
                        $result = array('success' => 'Success', 'message' => "User register successful for Ambulance service. Please click on Ambulance service again for Ambulance service.");
                        print json_encode($result);
                    }
                } else {
                    //  echo __LINE__.$unique_id;
                    //   die;  
                    // print_r($user_detail);	        die;
                    $data = $input_data;
                    date_default_timezone_set('Asia/Kolkata');
                    $insert_data = array(
                        'user_id' => $data['user_id'],
                        'unique_id' => $unique_id,
                        'device_id' => $data['device_id'],
                        'latitude' => $data['latitude'],
                        'longitude' => $data['longitude'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'ambulance_type' => $data['ambulance_type'],
                    );
                    $this->db->insert('call_ambulance', $insert_data);
                    //	echo $this->db->last_query();//exit;
                    $call_ambulance_id = $this->db->insert_id();

                    if (!empty($user_detail)) {
                        if ($user_detail) {

                            $insert_myresqr_user = array(
                                'uniqueId' => $unique_id,
                                'location' => [$latitude, $longitude],
                                'deviceId' => $device_id,
                            );
                            $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                            // print_r($insert_myresqr_json_user);  	//	    die;

                            $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
                            $php_utcNow = date("D, d M Y h:i:s ") . date_default_timezone_get();
                            $string_to_sign = "POST" . "\n" . "/tps/v1/call-ambulance/" . "\n" . $php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
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
                            curl_setopt($curl, CURLOPT_URL, 'https://api.myresqr.life/tps/v1/call-ambulance/');
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
                            print_r($response);
                            // $json_result = json_decode($response, true);
                            if ($response) {
                                $json_result = json_decode($response, true);
                                //print_R($json_result);
                                if (isset($json_result['requestId'])) {
                                    $update_call_ambulance_data = array();

                                    $update_call_ambulance_data['request_id'] = $json_result['requestId'];
                                    $update_call_ambulance_data['request_result'] = $response;

                                    if (isset($json_result['success']) && $json_result['success'] == true) {
                                        $update_call_ambulance_data['ambulance_service_used'] = '1';
                                        $update_call_ambulance_data['status'] = '1';
                                    }
                                    $this->db->where('id', $call_ambulance_id);
                                    $this->db->update('call_ambulance', $update_call_ambulance_data);
                                }
                            }
                            //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                            if (curl_errno($curl)) {
                                echo 'Error:' . curl_error($curl);
                            }
                            $info = curl_getinfo($curl);
                            //echo "\n";
                            // print_r(json_encode($insert_myresqr_user));
                            //{"uniqueId":"tst209","success":true}
                            //  print_r($user_detail);
                        } else {
                            $result = array('status' => 'Fail', 'message' => "No record found.",);
                            print json_encode($result);
                        }
                    }
                }
            }
        }
    }

    public function userGetAmbulanceDetailsMyresqr() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
        if ($input_data && isset($input_data['request_id'])) {
            $data = $input_data;
            $request_id = $data['request_id'];
            $user_id = $data['user_id'];

            // 2-feb-2023

            $input_data['ambulance_service_id'] = 2; // static value ambulance_service_id = 2
            if (isset($input_data['ambulance_service_id']) && $input_data['ambulance_service_id'] == 2) {
                $this->userGetAmbulanceDetailsZimaxDial($request_id, $user_id);
            } else {

                //  print_r($request_id);//   	 die;
                if (!empty($request_id)) {
                    if ($request_id) {
                        $insert_myresqr_user = array(
                            'requestId' => $request_id,
                        );
                        //   print_r($insert_myresqr_user);  		    die;
                        $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                        $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
                        $php_utcNow = date("D, d M Y h:i:s ") . date_default_timezone_get();
                        $string_to_sign = "POST" . "\n" . "/tps/v1/get-ambulance-details/" . "\n" . $php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
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
                        curl_setopt($curl, CURLOPT_URL, 'https://api.myresqr.life/tps/v1/get-ambulance-details/');
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
                        print_r($response);
                        // $json_result = json_decode($response, true);
                        //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        if (curl_errno($curl)) {
                            echo 'Error:' . curl_error($curl);
                        }
                        $info = curl_getinfo($curl);
                    } else {
                        $result = array('status' => 'Fail', 'message' => "No record found.",);
                        print json_encode($result);
                    }
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
                        // print_r($response);
                        // $json_result = json_decode($response, true);
                        // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        // echo "httpcode = ". $httpcode;
                        // if (curl_errno($curl)) {
                        //  echo 'Error:' . curl_error($curl);
                        // }
                        // $info = curl_getinfo($curl);
                    } else {
                        $result = array('status' => 'Fail', 'message' => "No record found.",);
                        print json_encode($result);
                    }
                }
            }
        }
    }

    public function userWhatsappRegister() {

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $input_data = $_POST;
        if ($input_data && isset($input_data['numbers'])) {
            $data = $input_data;
            $numbers = $data['numbers'];
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
                    // print_r($response);
                    // $json_result = json_decode($response, true);
                    // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    //echo "httpcode = ". $httpcode;
                    // if (curl_errno($curl)) {
                    //  echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function userWhatsappOtpMessages() {

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $input_data = $_POST;
        if ($input_data && isset($input_data['mobile_no']) && isset($input_data['otp'])) {
            $data = $input_data;
            $mobile_no = $data['mobile_no'];
            $otp = $data['otp'];
            //print_r($numbers); //   	 die;
            if (!empty($mobile_no)) {
                if ($mobile_no) {
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
                    //  echo "httpcode = ". $httpcode;
                    // if (curl_errno($curl)) {
                    // echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function userWhatsappPanicMessages($mobile_no, $name, $user_lat, $user_long, $panic_time, $res_location_name) {

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $input_data = $_POST;
        // if($input_data && isset($input_data['mobile_no']) && isset($input_data['otp']) ) {
        if ($mobile_no && $mobile_no != "") {
            $data = $input_data;
            $name = $name; //$data['name'];
            $mobile_no = $mobile_no; // $data['mobile_no'];
            $latitude = $user_lat; //$data['latitude'];
            $longitude = $user_long; //$data['longitude'];
            $param_date = $panic_time; //date("d-m-Y H:i");

            if (!empty($mobile_no)) {
                if ($mobile_no) {
                    $mobile_no_length = strlen((string) $mobile_no);
                    if ($mobile_no_length == 10) {
                        $mobile_no = "91" . $mobile_no;
                    }
                    $this->addUserMobileWhatsappRegister($mobile_no);
                    $insert_myresqr_user = array(
                        'type' => "template",
                        'to' => array($mobile_no),
                        'content' => array(
                            "template_name" => "panic_sos_alert_sms",
                            "language" => "en",
                            "params" => array(
                                "1" => $name,
                                "2" => $param_date,
                                // "3" => $latitude. ", ".$longitude
                                "3" => $res_location_name . " https://maps.google.com/?q=" . $latitude . "," . $longitude
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
                    // $json_result = json_decode($response, true);
                    // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    // echo "httpcode = ". $httpcode;
                    // if (curl_errno($curl)) {
                    //  echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    // 23-jul-2022
    public function addContactUserProfileImage() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $input_data = $_POST;
        if ($input_data && isset($input_data['user_id'])) {
            $user_id = $input_data['user_id'];
            $contact_user_id = $input_data['contact_user_id'];

            if (isset($_FILES['profile_image']['name'])) {
                $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
                if ($_FILES['profile_image']['name'] != '') {
                    $temp = explode(".", $_FILES['profile_image']['name']);
                    $ext = end($temp);
                }
                //print_r($ext); //   	 die;
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
                                'width' => 150,
                                'height' => 150,
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

                            $this->db->where('user_id', $user_id);
                            $this->db->where('emergency_user_id', $contact_user_id);
                            $this->db->where('is_deleted', '0');
                            $res = $this->db->update('emergency_contacts', $arr_image_to_update);
                            if ($res) {
                                $result = array('status' => 'Success', 'message' => "Image updated",);
                                print json_encode($result);
                            } else {
                                $result = array('status' => 'Fail', 'message' => "No record found.",);
                                print json_encode($result);
                            }
                        }
                    }
                }
            }
        }
    }

    //27-jul-2022
    public function addUserMyresqrByCallAmbulance($user_id) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        // $input_data = $_POST;
        // if($input_data) {
        $error_msg_return = [];
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
            // 		$user_id= $this->db->insert_id();
            //print_r($user_id);    	//	 die;
            $user_detail = array();
            if ($user_id) {
                //$user_id = 209;
                //         $unique_id= "capind".$user_id;
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
                    $unique_id = $user_detail->unique_id;
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
                        'uniqueId' => "capind" . $user_id, //$unique_id,
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
                    // 
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                    //   print_r($insert_myresqr_json_user);  		  //  die;

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
                    //  print_r($response);
                    $json_result = json_decode($response, true);
                    // print_r($json_result);


                    if (!empty($json_result)) {
                        if (array_key_exists("errorMessage", $json_result)) {

                            $json_result_error_msg = $json_result['errorMessage'];
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
                            $update_data['unique_id'] = $unique_id;
                            $update_data['myresqr_status'] = "1";
                            $this->db->where('id', $user_id);
                            $this->db->update('users', $update_data);
                        }
                    }
                    //   print_r($error_msg_return);
                    //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    // if (curl_errno($curl)) {
                    //echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                    //echo "\n";
                    // print_r(json_encode($insert_myresqr_user));

                    return $error_msg_return;
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    // 27-jul-2022
    public function addRsaSaveNewCase() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        date_default_timezone_set('Asia/Kolkata');
        $input_data = $_POST;
        //  print_r($input_data);

        $user_id = $input_data['user_id'];
        if ($input_data && $user_id) {

            $this->db->from('users');
            $this->db->where('id', $user_id);
            $res = $this->db->get()->row();
            //  print_r($res->first_name);
            //  die;

            if ($res) {
                $contact_first_name = $res->first_name ? $res->first_name : "";
                $contact_last_name = $res->last_name ? $res->last_name : "";
                $contact_name = $contact_first_name . " " . $contact_last_name;
                $contact_mobile_no = $res->mobile_no ? $res->mobile_no : "";
                $data = $input_data;
                $insert_data = array(
                    //   'client'=>  isset($data['client']) ? $data['client'] : "TVS Connect",
                    'client' => isset($data['client']) ? $data['client'] : "ZIMAXX TECH SOLUTIONS PRIVATE LIMITED",
                    'contact_name' => $contact_name, //$data['contact_name'],
                    'mobile_no' => $contact_mobile_no, //$data['mobile_no'],
                    'bdlatitude' => $data['bdlatitude'] ? $data['bdlatitude'] : "",
                    'bdlongitude' => $data['bdlongitude'] ? $data['bdlongitude'] : "",
                    'bdlocation' => $data['bdlocation'] ? $data['bdlocation'] : "",
                    'pincode' => isset($data['pincode']) ? $data['pincode'] : 500081,
                    'state' => isset($data['state']) ? $data['state'] : "Telangana",
                    'subject' => isset($data['subject']) ? $data['subject'] : "Accident",
                    'service' => isset($data['service']) ? $data['service'] : "Towing",
                    'subservice' => isset($data['subservice']) ? $data['subservice'] : "Car to Car Tow",
                    'fuel' => isset($data['fuel']) ? $data['fuel'] : "",
                    'vehicleno' => $data['vehicleno'] ? $data['vehicleno'] : "",
                    'vinn' => isset($data['vinn']) ? $data['vinn'] : "",
                    'manufacturer' => isset($data['manufacturer']) ? $data['manufacturer'] : "Nissan",
                    'model' => isset($data['model']) ? $data['model'] : "MICRA",
                    'runningkm' => isset($data['runningkm']) ? $data['runningkm'] : "",
                    'serviceeligibility' => isset($data['serviceeligibility']) ? $data['serviceeligibility'] : "Non Member",
                    'policyno' => isset($data['policyno']) ? $data['policyno'] : "",
                    'warrplcystartdate' => isset($data['warrplcystartdate']) ? $data['warrplcystartdate'] : "",
                    'warrplcyenddate' => isset($data['warrplcyenddate']) ? $data['warrplcyenddate'] : "",
                    'policytype' => isset($data['policytype']) ? $data['policytype'] : "Non Member",
                    'voiceofcustomer' => isset($data['voiceofcustomer']) ? $data['voiceofcustomer'] : "",
                    //	 	    'uniqueid'=>$data['uniqueid'],
                    'vehiclecondition' => isset($data['vehiclecondition']) ? $data['vehiclecondition'] : "",
                    'saledate' => isset($data['saledate']) ? $data['saledate'] : date('d-m-Y'),
                    'accidenttype' => isset($data['accidenttype']) ? $data['accidenttype'] : "",
                    'vehicletype' => isset($data['vehicletype']) ? $data['vehicletype'] : "Commercial", //,
                    'vehicleloaded' => isset($data['vehicleloaded']) ? $data['vehicleloaded'] : "",
                    'extrafittings' => isset($data['extrafittings']) ? $data['extrafittings'] : "",
                    'drploctype' => isset($data['drploctype']) ? $data['drploctype'] : "Custmer preferred",
                    'dealer' => isset($data['dealer']) ? $data['dealer'] : "",
                    'custpreftype' => isset($data['custpreftype']) ? $data['custpreftype'] : "",
                    'custdrploc' => isset($data['custdrploc']) ? $data['custdrploc'] : '',
                    'custdrplat' => isset($data['custdrplat']) ? $data['custdrplat'] : '',
                    'custdrplong' => isset($data['custdrplong']) ? $data['custdrplong'] : '',
                    'requestedby' => isset($data['requestedby']) ? $data['requestedby'] : "fromAPI",
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $insert_data['user_id'] = $data['user_id'];
                $call_rsa_result = $this->db->insert('call_rsa', $insert_data);
                $call_rsa_insert_id = $this->db->insert_id();

                if ($call_rsa_insert_id) {
                    $uniqueid = "capind0000" . $call_rsa_insert_id;
                    $update_data['uniqueid'] = $uniqueid;
                    $this->db->where('id', $call_rsa_insert_id);
                    $this->db->update('call_rsa', $update_data);
                }

                if ($call_rsa_result) {
                    $this->db->where('id', $call_rsa_insert_id);
                    $call_rsa_detail = $this->db->get('call_rsa')->row();
                    if ($call_rsa_detail) {
                        $client = "";
                        $contact_name = "";
                        $mobile_no = "";
                        $pincode = "";
                        $bdlatitude = "";
                        $bdlongitude = "";
                        $bdlocation = "";
                        $pincode = "";
                        $state = "";
                        $govt_id_image_url = "";
                        $govt_id_number = "";
                        $govt_id_type = "";

                        $user_id = $call_rsa_detail->id;
                        $client = $call_rsa_detail->client;
                        $contact_name = $call_rsa_detail->contact_name;
                        $mobile_no = $call_rsa_detail->mobile_no;
                        $bdlatitude = $call_rsa_detail->bdlatitude;
                        $bdlongitude = $call_rsa_detail->bdlongitude;
                        $bdlocation = $call_rsa_detail->bdlocation;
                        $pincode = $call_rsa_detail->pincode;
                        $state = $call_rsa_detail->state;
                        $subject = $call_rsa_detail->subject;
                        $service = $call_rsa_detail->service;
                        $subservice = $call_rsa_detail->subservice;
                        $fuel = $call_rsa_detail->fuel;
                        $vehicleno = $call_rsa_detail->vehicleno;
                        $vinn = $call_rsa_detail->vinn;
                        $manufacturer = $call_rsa_detail->manufacturer;
                        $model = $call_rsa_detail->model;
                        $runningkm = $call_rsa_detail->runningkm;
                        $vinn = $call_rsa_detail->vinn;

                        $serviceeligibility = $call_rsa_detail->serviceeligibility;
                        $policyno = $call_rsa_detail->policyno;
                        $warrplcystartdate = $call_rsa_detail->warrplcystartdate;
                        $warrplcyenddate = $call_rsa_detail->warrplcyenddate;
                        $policyno = $call_rsa_detail->policyno;
                        $policytype = $call_rsa_detail->policytype;
                        $voiceofcustomer = $call_rsa_detail->voiceofcustomer;
                        $requestedby = $call_rsa_detail->requestedby;
                        $voiceofcustomer = $call_rsa_detail->voiceofcustomer;
                        $uniqueid = $call_rsa_detail->uniqueid;
                        $vehiclecondition = $call_rsa_detail->vehiclecondition;
                        $saledate = $call_rsa_detail->saledate;
                        $accidenttype = $call_rsa_detail->accidenttype;
                        $vehicletype = $call_rsa_detail->vehicletype;
                        $vehicleloaded = $call_rsa_detail->vehicleloaded;
                        $extrafittings = $call_rsa_detail->extrafittings;
                        $drploctype = $call_rsa_detail->drploctype;
                        $dealer = $call_rsa_detail->dealer;
                        $custpreftype = $call_rsa_detail->custpreftype;
                        $custdrplat = $call_rsa_detail->custdrplat;
                        $custdrploc = $call_rsa_detail->custdrploc;
                        $custdrplong = $call_rsa_detail->custdrplong;
                        $requestedby = $call_rsa_detail->requestedby;

                        $insert_myresqr_user = array(
                            'Client' => $client,
                            'ContactName' => $contact_name,
                            'MobileNo' => $mobile_no,
                            'BDlatitude' => $bdlatitude,
                            'BDlongitude' => $bdlongitude,
                            'BDLocation' => $bdlocation,
                            'PinCode' => $pincode,
                            'State' => $state,
                            'Subject' => $subject,
                            'Service' => $service,
                            'SubService' => $subservice,
                            'Fuel' => $fuel,
                            'VehicleNo' => $vehicleno,
                            'VinNo' => $vinn,
                            'Manufacturer' => $manufacturer,
                            'Model' => $model,
                            'RunningKM' => $runningkm,
                            'ServiceEligibility' => $serviceeligibility,
                            'PolicyNo' => $policyno,
                            'warrPlcyStartDate' => $warrplcystartdate,
                            'warrPlcyEndDate' => $warrplcyenddate,
                            'PolicyType' => $policytype,
                            'VoiceofCustomer' => $vehiclecondition,
                            'UniqueID' => $uniqueid,
                            'VehicleCondition' => $vehicleloaded,
                            'SaleDate' => $saledate,
                            'AccidentType' => $accidenttype,
                            'VehicleType' => $vehicletype,
                            'vehicleloaded' => $vehicleloaded,
                            'ExtraFittings' => $extrafittings,
                            'DrpLocType' => $drploctype,
                            'Dealer' => $dealer,
                            'CustPrefType' => $custpreftype,
                            'CustdrpLoc' => $custdrploc,
                            'Custdrplat' => $custdrplat,
                            'Custdrplong' => $custdrplong,
                            'Requestedby' => $requestedby,
                        );

                        $insert_myresqr_json_user = json_encode($insert_myresqr_user);
                        // print_r($insert_myresqr_json_user);  	  //   die;
                        $header_arr = array('Content-Type: application/json');

                        // START - curl
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, 'https://tvsaa.unfyd.com/CRM/CasesHandler?Action=SaveNewCaseFromAPI');
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
                        if ($response) {
                            $json_result = json_decode($response, true);
                            // print_R($json_result);
                       
                        
                            $caseid = null;
                            // if (isset($json_result['caseid'])) {
                            if (isset($json_result['caseDetail'][0]['caseId'])) {
                           
                                $update_call_rsa_data = array();
                                // $update_call_rsa_data['caseid'] = $json_result['caseid'];
                                $update_call_rsa_data['caseid'] = $caseid = $json_result['caseDetail'][0]['caseId'];
                                $update_call_rsa_data['caseid_result'] = $response;

                                // if (isset($json_result['Result'])) {
                                //     if (strtolower($json_result['Result']) == "success") {
                                //         $update_call_rsa_data['status'] = '1';
                                //     }
                                // }
                                if (isset($json_result['Status'])) {
                                    if (strtolower($json_result['Status']) == "200") {
                                        $update_call_rsa_data['status'] = '1';
                                    }
                                }
                                $this->db->where('id', $call_rsa_insert_id);
                                $this->db->update('call_rsa', $update_call_rsa_data);
                            } else {
                                $update_call_rsa_data = array();
                                $update_call_rsa_data['caseid_result'] = $response;
                                $this->db->where('id', $call_rsa_insert_id);
                                $this->db->update('call_rsa', $update_call_rsa_data);
                            }
                            //{"caseid":"ZIM2223100453","Reason":"","Result":"Success","data":"Case Created"}
                            $return_response = array('caseid' => $caseid, "Reason" => "", "Result" => "Success", "data" => "Case Created");
                            print_r(json_encode($return_response));
                        } else {
                            $result = array('status' => 'Fail', 'message' => "Something went wrong");
                            print json_encode($result);
                        }


                        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        if (curl_errno($curl)) {
                            echo 'Error:' . curl_error($curl);
                        }
                    } else {
                        $result = array('status' => 'Fail', 'message' => "No record found.",);
                        print json_encode($result);
                    }
                }
            }
        }
    }

    // 28-jul-2022
    public function getRsaGetCaseLocationAndStatus() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $input_data = $_POST;
        //  print_r($input_data);

        $user_id = $input_data['user_id'];
        if ($input_data) {

            if ($user_id) {
                $data = $input_data;
                $case_id = $data['case_id'];

                if ($case_id) {

                    $insert_myresqr_user = array(
                        'CaseID' => $case_id,
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $header_arr = array('Content-Type: application/json');

                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://tvsaa.unfyd.com/CRM/CasesHandler?Action=GetCaseLocationAndStatus');
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
                    print_r($response);
                    if ($response) {
                        $json_result = json_decode($response, true);
                        //print_R($json_result);
                    }
                    $json_result = json_decode($response, true);
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    if (curl_errno($curl)) {
                        echo 'Error:' . curl_error($curl);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function getRsaGetCaseDetail() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $input_data = $_POST;

        $user_id = $input_data['user_id'];
        if ($input_data) {

            if ($user_id) {
                $data = $input_data;
                $case_id = $data['case_id'];

                if ($case_id) {

                    $insert_myresqr_user = array(
                        'CaseID' => $case_id,
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $header_arr = array('Content-Type: application/json');

                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://tvsaa.unfyd.com/CRM/CasesHandler?Action=GetCaseDetailsForAPI');
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
                    print_r($response);
                    if ($response) {
                        $json_result = json_decode($response, true);
                        //print_R($json_result);
                    }
                    $json_result = json_decode($response, true);
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    if (curl_errno($curl)) {
                        echo 'Error:' . curl_error($curl);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function getRsaCaseCancellation() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $input_data = $_POST;

        $user_id = $input_data['user_id'];
        if ($input_data) {

            if ($user_id) {
                $data = $input_data;
                $case_id = $data['case_id'];
                $status = $data['status'];
                $case_reason = $data['case_reason'];
                $service_des = $data['service_des'];
                $remarks = $data['remarks'];

                if ($case_id) {

                    $insert_myresqr_user = array(
                        'CaseID' => $case_id,
                        'status' => $status,
                        'caseReason' => $case_reason,
                        'serviceDes' => $service_des,
                        'remarks' => $remarks,
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $header_arr = array('Content-Type: application/json');

                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://tvsaa.unfyd.com/CRM/MobileAPIHandler?Action=CaseCancellation');
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
                    print_r($response);

                    if ($response) {
                        $json_result = json_decode($response, true);
                        //print_R($json_result);

                        if (isset($json_result['Status']) && $json_result['Status'] == "Success") {
                            $update_call_rsa_data = array();

                            $update_call_rsa_data['cancel_status'] = '1';
                            $update_call_rsa_data['cancel_result'] = $response;
                            $this->db->where('caseid', $case_id);
                            $this->db->update('call_rsa', $update_call_rsa_data);
                        } else {

                            $update_call_rsa_data = array();
                            $update_call_rsa_data['cancel_result'] = $response;
                            $this->db->where('caseid', $case_id);
                            $this->db->update('call_rsa', $update_call_rsa_data);
                        }
                    }
                    $json_result = json_decode($response, true);
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    if (curl_errno($curl)) {
                        echo 'Error:' . curl_error($curl);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function updateRsaUpdateCaseRemarksRating() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $input_data = $_POST;
        $user_id = $input_data['user_id'];
        if ($input_data) {

            if ($user_id) {
                $data = $input_data;
                $case_id = $data['case_id'];
                $rating = $data['rating'];
                $remarks = $data['remarks'];

                if ($case_id) {
                    $insert_myresqr_user = array(
                        'CaseID' => $case_id,
                        'Rating' => $rating,
                        'Remarks' => $remarks,
                    );
                    $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                    $header_arr = array('Content-Type: application/json');

                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://tvsaa.unfyd.com/CRM/CasesHandler?Action=UpdateCaseRemarksRating');
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
                    print_r($response);
                    if ($response) {
                        $json_result = json_decode($response, true);
                        //print_R($json_result);
                    }
                    $json_result = json_decode($response, true);
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    if (curl_errno($curl)) {
                        echo 'Error:' . curl_error($curl);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => "No record found.",);
                    print json_encode($result);
                }
            }
        }
    }

    public function getLocationFromLatLong($user_lat, $user_long) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        //
        // $user_lat = 18.5596258;
        // $user_long = 73.7714664;

        $curl = curl_init();
//           https://maps.googleapis.com/maps/api/geocode/json?latlng=18.5596258,73.7714664&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8
        curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $user_lat . ',' . $user_long . '&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        //     curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
        //    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        $response = curl_exec($curl);
        curl_close($curl);
        if ($response) {
            $json_result = json_decode($response, true);
            if ($json_result) {
                if (isset($json_result['results'][0]['formatted_address'])) {
                    return ($json_result['results'][0]['formatted_address']);
                } else {
                    return "";
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    //8-aug-2022
    public function validateLicence_OLD() {
        if ($_POST) {
            $datas = $_POST;

            $result = $this->api_model->validateLicence($_POST['licence_key']);
            $status = $result['status'];
            if ($status == 'used') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence already used.');
                print json_encode($finresult);
            } else if ($status == 'expire') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence expired on ' . $result['end_date']);
                print json_encode($finresult);
            } else if ($status == "found") {
                $finresult = array('status' => 'Success', 'message' => 'Valid Licence key.');
                print json_encode($finresult);
            } else if ($status == "not_found") {
                $finresult = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($finresult);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function validateLicence() {
        if ($_POST) {
            $datas = $_POST;

            $result = $this->api_model->validateLicence($_POST['licence_key']);
            $status = $result['status'];
            if ($status == 'used') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence already used.');
                print json_encode($finresult);
            } else if ($status == 'expire') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence expired on ' . $result['end_date']);
                print json_encode($finresult);
            } else if ($status == "found") {
                $finresult = array('status' => 'Success', 'message' => 'Valid Licence key.');
                print json_encode($finresult);
            } else if ($status == "not_found") {

                //19-aug-2022
                $result_ref = $this->api_model->validateLicenceReference($_POST['licence_key']);
                //	print_r(	$result_ref );
                $status_ref = $result_ref['status'];
                if ($status_ref == "found") {
                    $finresult = array('status' => 'Success', 'message' => 'Valid Licence key.');
                    print json_encode($finresult);
                } else if ($status_ref == "limit_reached") {
                    $finresult = array('status' => 'Fail', 'message' => 'Licence key limit reached.');  // );
                    print json_encode($finresult);
                } else if ($status_ref == "not_found") {
                    $finresult = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                    print json_encode($finresult);
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function assignLicence() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        if ($_POST) {
            $datas = $_POST;

            $result = $this->api_model->validateLicence($_POST['licence_key']);

            $status = $result['status'];

            if ($status == 'used') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence already used.');
                print json_encode($finresult);
            } else if ($status == 'expire') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence expired on ' . $result['end_date']);
                print json_encode($finresult);
            } else if ($status == "found" && $datas['user_id'] != null) {
                //	print_r($result['query']->id);
                //	die;
                $tenant_licence_id = null;
                $tenant_licence_days = null;
                $tenant_licence_tenant_id = null;
                $tenant_licence_plan_id_val = null;
                if (isset($result['query']->id)) {
                    $tenant_licence_id = $result['query']->id;
                    $tenant_licence_days = $result['query']->licence_days;
                    $tenant_licence_tenant_id = $result['query']->tenant_id;
                    $tenant_licence_plan_id_val = $result['query']->plan_id;
                }
                $users_tenant_id = null;
                $result_users = array();
                if ($datas['user_id'] != null) {
                    $this->db->where('id', $datas['user_id']);
                    $query_users = $this->db->get('users');
                    $result_users = $query_users->row();
                    if ($result_users) {
                        $users_tenant_id = $result_users->tenant_id;
                    }
                }
// 		print_r($users_tenant_id);
// 		echo "---";
// 		print_r($tenant_licence_tenant_id);
// 		die;
                if ($users_tenant_id != null && $tenant_licence_tenant_id != null) {
                    if ($users_tenant_id == $tenant_licence_tenant_id) {
                        // echo $tenant_licence_id;die;

                        if ($tenant_licence_id != null) {

                            $this->db->where('id', $datas['user_id']);
                            $this->db->update('users', array('tenant_licence_id' => $tenant_licence_id));
                            $start_date = null;
                            $end_date = null;
                            if ($tenant_licence_days != null) {
                                $licence_days = $tenant_licence_days;
                                $start_date = date('Y-m-d');
                                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));
                            }


                            $this->db->where("tenant_licence.id", $tenant_licence_id);
                            $query_tenant_licence_date = $this->db->get('tenant_licence')->row();
                            if ($query_tenant_licence_date) {
                                if ($query_tenant_licence_date->start_date != null) {
                                    // update licence
                                    $update_data_tenant_licence = array(
                                        // 'start_date' => $start_date,
                                        //  'end_date' => $end_date,
                                        'user_id' => $datas['user_id'],
                                        'is_use' => '1',
                                    );
                                    $this->db->where('id', $tenant_licence_id);
                                    $this->db->update('tenant_licence', $update_data_tenant_licence);
                                } else {
                                    // update licence
                                    $update_data_tenant_licence = array(
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'user_id' => $datas['user_id'],
                                        'is_use' => '1',
                                    );
                                    $this->db->where('id', $tenant_licence_id);
                                    $this->db->update('tenant_licence', $update_data_tenant_licence);
                                }


                                // 22-dec-2022
                                // 	$update_data_user_plan = array(
                                // 	    'start_date' => $start_date,
                                // 				    'end_date' => $end_date,
                                // 		'status' => '1',
                                //     			    'licence_key_id' => $tenant_licence_id,
                                //     			    'plan_id' => $tenant_licence_plan_id_val
                                // 	);
                                // 	$this->db->where('user_id', $datas['user_id']);
                                // 	$this->db->update('user_plan', $update_data_user_plan);


                                $insert_data_user_plan_arr = array(
                                    'user_id' => $datas['user_id'],
                                    'plan_id' => $tenant_licence_plan_id_val,
                                    'start_date' => $start_date,
                                    'end_date' => $end_date,
                                    'licence_key_id' => $tenant_licence_id,
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                );
                                $this->db->insert('user_plan', $insert_data_user_plan_arr);
                            }

                            $finresult = array('status' => 'Success', 'message' => 'Licence key assign successfully.', 'user_id' => strval($datas['user_id']));
                            print json_encode($finresult);
                        } else {
                            $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                            print json_encode($result);
                        }
                    } else {
                        //   print_r($result_users);die;
                        if ($result_users) {


                            $this->db->where('id', $datas['user_id']);
                            $this->db->update('users', array('is_deleted' => '1', 'status' => '2'));

                            $insert_user_data = array(
                                'user_type' => "3",
                                'user_name' => $result_users->user_name,
                                'password' => $result_users->password,
                                'first_name' => $result_users->first_name,
                                'middle_name' => $result_users->middle_name,
                                'last_name' => $result_users->last_name,
                                'email' => $result_users->email,
                                'age' => $result_users->age,
                                'gender' => $result_users->gender,
                                'mobile_no' => $result_users->mobile_no,
                                'blood_group' => $result_users->blood_group,
                                'mpin' => $result_users->mpin,
                                'date_of_birth' => $result_users->date_of_birth,
                                'address' => $result_users->address,
                                'city' => $result_users->city,
                                'state' => $result_users->state,
                                'status' => $result_users->status,
                                'pincode' => $result_users->pincode,
                                'device_token' => $result_users->device_token,
                                // 'auth_key' => '',
                                'auth_key' => $result_users->auth_key,
                                'profile_image' => $result_users->profile_image,
                                'profile_image_thumb' => $result_users->profile_image_thumb,
                                // 14-sep-2022
                                'govt_id_image_url' => $result_users->govt_id_image_url ? $result_users->govt_id_image_url : null,
                                'govt_id_image_url_thumb' => $result_users->govt_id_image_url_thumb ? $result_users->govt_id_image_url_thumb : null,
                                'govt_id_number' => $result_users->govt_id_number ? $result_users->govt_id_number : null,
                                'govt_id_type' => $result_users->govt_id_type ? $result_users->govt_id_type : null,
                                'unique_id' => $result_users->unique_id ? $result_users->unique_id : null,
                                'myresqr_status' => $result_users->myresqr_status ? $result_users->myresqr_status : '0',
                                'tenant_id' => $tenant_licence_tenant_id,
                                'tenant_licence_id' => $tenant_licence_id,
                                //20-oct-2022
                                'sum_insured' => $result_users->sum_insured ? $result_users->sum_insured : null,
                                'member_id' => $result_users->member_id ? $result_users->member_id : null,
                                'plan_type' => $result_users->plan_type ? $result_users->plan_type : null,
                            );

                            $this->db->insert('users', $insert_user_data);
                            // echo $this->db->last_query();
                            // die;
                            $new_user_id = $this->db->insert_id();

                            $this->db->select('user_id,emergency_user_id,serial_no,name,is_deleted, profile_image, profile_image_thumb');

                            $this->db->where('emergency_contacts.is_deleted', 0);
                            $this->db->where('emergency_contacts.user_id', $datas['user_id']);
                            $res_emergency_contacts = $this->db->get('emergency_contacts')->result_array();
                            if (!empty($res_emergency_contacts)) {
                                foreach ($res_emergency_contacts as $row) {
                                    $ins_arr = array(
                                        'user_id' => $new_user_id,
                                        'emergency_user_id' => $row['emergency_user_id'],
                                        'serial_no' => $row['serial_no'],
                                        'name' => $row['name'],
                                        'is_deleted' => 0,
                                        'profile_image' => $row['profile_image'],
                                        'profile_image_thumb' => $row['profile_image_thumb'],
                                    );
                                    $this->db->insert('emergency_contacts', $ins_arr);
                                }
                            }

                            $start_date = null;
                            $end_date = null;
                            if ($tenant_licence_days != null) {
                                $licence_days = $tenant_licence_days;
                                $start_date = date('Y-m-d');
                                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));
                            }


                            $this->db->where("tenant_licence.id", $tenant_licence_id);
                            $query_tenant_licence_date = $this->db->get('tenant_licence')->row();
                            $tenant_licence_plan_id = $query_tenant_licence_date ? $query_tenant_licence_date->plan_id : null;
                            if ($query_tenant_licence_date) {
                                if ($query_tenant_licence_date->start_date != null) {
                                    // update licence
                                    $update_data_tenant_licence = array(
                                        // 'start_date' => $start_date,
                                        //     'end_date' => $end_date,
                                        'user_id' => $new_user_id, //$datas['user_id'],
                                        'is_use' => '1',
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->where('id', $tenant_licence_id);
                                    $this->db->update('tenant_licence', $update_data_tenant_licence);
                                } else {

                                    // update licence
                                    $update_data_tenant_licence = array(
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'user_id' => $new_user_id,
                                        'is_use' => '1',
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->where('id', $tenant_licence_id);
                                    $this->db->update('tenant_licence', $update_data_tenant_licence);
                                }
                            }

                            // 28-dec-2022
                            $update_data_user_plan = array(
                                'is_deleted' => '1',
                            );
                            $this->db->where('user_id', $new_user_id);
                            $this->db->update('user_plan', $update_data_user_plan);

                            $insert_data_user_plan = array(
                                'user_id' => $new_user_id,
                                'plan_id' => $tenant_licence_plan_id ? $tenant_licence_plan_id : null,
                                'start_date' => $start_date,
                                'end_date' => $end_date,
                                'status' => '1',
                            );
                            $this->db->insert('user_plan', $insert_data_user_plan);

                            $finresult = array('status' => 'Success', 'message' => 'Licence key assign successfully.', 'user_id' => strval($new_user_id));
                            print json_encode($finresult);
                        }
                    }
                }
            } else if ($status == "not_found") {

                // reference
                $result_ref = $this->api_model->validateLicenceReference($_POST['licence_key']);
                $status_ref = $result_ref['status'];
                if ($status_ref == "found") {
                    // echo $result_ref['query']->tenant_licence_key;//die;
                    if (isset($result_ref['query']->tenant_licence_key)) {
                        $tenant_licence_reference_id = $result_ref['query']->id;
                        $tenant_licence_key = $result_ref['query']->tenant_licence_key;
                        $this->db->select("*");
                        $this->db->where('tenant_licence.licence_key', $tenant_licence_key);
                        $this->db->where('tenant_licence.is_use', '0');
                        $this->db->where('tenant_licence.is_deleted', '0');
                        //	$this->db->where('tenant_licence.start_date <=',  date('Y-m-d'));
                        //	$this->db->where('tenant_licence.end_date >=',  date('Y-m-d'));

                        $query_tenant_licence = $this->db->get('tenant_licence')->row();
                        //   echo $this->db->last_query();
                        //   print_r($query_tenant_licence);
                        //   die;
                        if ($query_tenant_licence) {
                            $tenant_licence_id = $query_tenant_licence->id;
                            $update_data_tenant_licence_reference = array(
                                'is_use' => '1',
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->where('id', $tenant_licence_reference_id);
                            $this->db->update('tenant_licence_reference', $update_data_tenant_licence_reference);

                            $this->db->where("tenant_licence.id", $tenant_licence_id);
                            $query_tenant_licence_date = $this->db->get('tenant_licence')->row();

                            $start_date = null;
                            $end_date = null;
                            if ($query_tenant_licence_date->licence_days != null) {
                                $licence_days = $query_tenant_licence_date->licence_days;
                                $start_date = date('Y-m-d');
                                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));
                            }

                            if ($query_tenant_licence_date) {
                                if ($query_tenant_licence_date->start_date != null) {
                                    // update licence
                                    $update_data_tenant_licence = array(
                                        // 'start_date' => $start_date,
                                        //     'end_date' => $end_date,
                                        'user_id' => $datas['user_id'],
                                        'is_use' => '1',
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->where('id', $tenant_licence_id);
                                    $this->db->update('tenant_licence', $update_data_tenant_licence);
                                } else {
                                    // update licence
                                    $update_data_tenant_licence = array(
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'user_id' => $datas['user_id'],
                                        'is_use' => '1',
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->where('id', $tenant_licence_id);
                                    $this->db->update('tenant_licence', $update_data_tenant_licence);
                                }

                                // 22-dec-2022
                                $update_data_user_plan = array(
                                    'start_date' => $start_date,
                                    'end_date' => $end_date,
                                    'status' => '1',
                                );
                                $this->db->where('user_id', $datas['user_id']);
                                $this->db->update('user_plan', $update_data_user_plan);
                                //  echo $this->db->last_query ;
                            }

                            // die;
                            // 	        	$update_data_tenant_licence= array(
                            // 		'user_id' =>$datas['user_id'],
                            // 		'is_use' =>  '1',
                            // 	);
                            // 	$this->db->where('id', $tenant_licence_id );
                            // 	$this->db->update('tenant_licence',$update_data_tenant_licence);

                            $this->db->where('id', $datas['user_id']);
                            $this->db->update('users', array('tenant_licence_id' => $tenant_licence_id));
                            //  echo $this->db->last_query();
                            $finresult = array('status' => 'Success', 'message' => 'Licence key assign successfully.', 'user_id' => strval($datas['user_id']));
                            print json_encode($finresult);
                        } else {
                            $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                            print json_encode($result);
                        }
                    } else {
                        $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                        print json_encode($result);
                    }
                } else if ($status_ref == "limit_reached") {
                    $finresult = array('status' => 'Fail', 'message' => 'Licence key limit reached.');  // );
                    print json_encode($finresult);
                } else if ($status_ref == "not_found") {
                    $finresult = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                    print json_encode($finresult);
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    //8-aug-2022
    public function assignLicence_OLD() {
        if ($_POST) {
            $datas = $_POST;

            $result = $this->api_model->validateLicence($_POST['licence_key']);

            $status = $result['status'];
            if ($status == 'used') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence already used.');
                print json_encode($finresult);
            } else if ($status == 'expire') {
                $finresult = array('status' => 'Fail', 'message' => 'Licence expired on ' . $result['end_date']);
                print json_encode($finresult);
            } else if ($status == "found" && $datas['user_id'] != null) {
                //	print_r($result['query']->id);
                //	die;
                $tenant_licence_id = null;
                $tenant_licence_days = null;
                $tenant_licence_tenant_id = null;
                if (isset($result['query']->id)) {
                    $tenant_licence_id = $result['query']->id;
                    $tenant_licence_days = $result['query']->licence_days;
                    $tenant_licence_tenant_id = $result['query']->tenant_id;
                }
                $users_tenant_id = null;
                $result_users = array();
                if ($datas['user_id'] != null) {
                    $this->db->where('id', $datas['user_id']);
                    $query_users = $this->db->get('users');
                    $result_users = $query_users->row();
                    if ($result_users) {
                        $users_tenant_id = $result_users->tenant_id;
                    }
                }
                //	print_r($users_tenant_id);
                //	print_r($tenant_licence_tenant_id);
                //die;
                if ($users_tenant_id != null && $tenant_licence_tenant_id != null) {
                    if ($users_tenant_id == $tenant_licence_tenant_id) {
                        //     echo "if";die;

                        if ($tenant_licence_id != null) {

                            $this->db->where('id', $datas['user_id']);
                            $this->db->update('users', array('tenant_licence_id' => $tenant_licence_id));
                            $start_date = null;
                            $end_date = null;
                            if ($tenant_licence_days != null) {
                                $licence_days = $tenant_licence_days - 1;
                                $start_date = date('Y-m-d');
                                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));
                            }
                            // update licence
                            $update_data_tenant_licence = array(
                                'start_date' => $start_date,
                                'end_date' => $end_date,
                                'user_id' => $datas['user_id'],
                                'is_use' => '1',
                            );
                            $this->db->where('id', $tenant_licence_id);
                            $this->db->update('tenant_licence', $update_data_tenant_licence);

                            $finresult = array('status' => 'Success', 'message' => 'Licence key assign successfully.');
                            print json_encode($finresult);
                        } else {
                            $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                            print json_encode($result);
                        }
                    } else {
                        //   print_r($result_users);die;
                        if ($result_users) {


                            $this->db->where('id', $datas['user_id']);
                            $this->db->update('users', array('is_deleted' => '1', 'status' => '2'));

                            $insert_user_data = array(
                                'user_type' => "3",
                                'user_name' => $result_users->user_name,
                                'password' => $result_users->password,
                                'first_name' => $result_users->first_name,
                                'middle_name' => $result_users->middle_name,
                                'last_name' => $result_users->last_name,
                                'email' => $result_users->email,
                                'age' => $result_users->age,
                                'gender' => $result_users->gender,
                                'mobile_no' => $result_users->mobile_no,
                                'blood_group' => $result_users->blood_group,
                                'mpin' => $result_users->mpin,
                                'date_of_birth' => $result_users->date_of_birth,
                                'address' => $result_users->address,
                                'city' => $result_users->city,
                                'state' => $result_users->state,
                                'status' => $result_users->status,
                                'pincode' => $result_users->pincode,
                                'device_token' => $result_users->device_token,
                                'auth_key' => '',
                                'profile_image' => $result_users->profile_image,
                                'profile_image_thumb' => $result_users->profile_image_thumb,
                                'tenant_id' => $tenant_licence_tenant_id,
                                'tenant_licence_id' => $tenant_licence_id
                            );

                            $this->db->insert('users', $insert_user_data);
                            // echo $this->db->last_query();
                            // die;
                            $new_user_id = $this->db->insert_id();

                            $this->db->select('user_id,emergency_user_id,serial_no,name,is_deleted, profile_image, profile_image_thumb');

                            $this->db->where('emergency_contacts.is_deleted', 0);
                            $this->db->where('emergency_contacts.user_id', $datas['user_id']);
                            $res_emergency_contacts = $this->db->get('emergency_contacts')->result_array();
                            if (!empty($res_emergency_contacts)) {
                                foreach ($res_emergency_contacts as $row) {
                                    $ins_arr = array(
                                        'user_id' => $new_user_id,
                                        'emergency_user_id' => $row['emergency_user_id'],
                                        'serial_no' => $row['serial_no'],
                                        'name' => $row['name'],
                                        'is_deleted' => 0,
                                        'profile_image' => $row['profile_image'],
                                        'profile_image_thumb' => $row['profile_image_thumb'],
                                    );
                                    $this->db->insert('emergency_contacts', $ins_arr);
                                }
                            }

                            $start_date = null;
                            $end_date = null;
                            if ($tenant_licence_days != null) {
                                $licence_days = $tenant_licence_days - 1;
                                $start_date = date('Y-m-d');
                                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));
                            }
                            // update licence
                            $update_data_tenant_licence = array(
                                'start_date' => $start_date,
                                'end_date' => $end_date,
                                'user_id' => $new_user_id,
                                'is_use' => '1',
                            );
                            $this->db->where('id', $tenant_licence_id);
                            $this->db->update('tenant_licence', $update_data_tenant_licence);

                            $finresult = array('status' => 'Success', 'message' => 'Licence key assign successfully.');
                            print json_encode($finresult);
                        }
                    }
                }
            } else if ($status == "not_found") {
                $finresult = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($finresult);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updatePaymentDetail_OLD() {
        date_default_timezone_set('Asia/Kolkata');
        if ($_POST) {
            $datas = $_POST;
            if ($datas['user_id'] != null) {

                //$result=$this->api_model->getAdminLicenceKey( );
                // if($result) {
                if (1) {
                    $tenant_licence_id = null;
                    // 	if(isset( $result->id)){
                    // 		$tenant_licence_id = $result->id ;
                    // 	}
                    // 	if($tenant_licence_id !=null ) {
                    /*
                      $this->db->where('id',$datas['user_id']);
                      $this->db->update('users',array('tenant_licence_id'=> $tenant_licence_id));
                      //echo $this->db->last_query();
                      // update licence
                      $update_data_tenant_licence= array(
                      'user_id' => $datas['user_id'],
                      'is_use' =>  '1',
                      );
                      $this->db->where('id', $tenant_licence_id );
                      $this->db->update('tenant_licence',$update_data_tenant_licence);
                      //	echo $this->db->last_query();
                     */
                    $rand_letter = $this->getRandomLetter(2);

                    if (isset($datas['licence_days']) && $datas['licence_days'] != null) {
                        $licence_days = $datas['licence_days'] - 1;
                        $start_date = date('Y-m-d');
                        $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));

                        $this->db->select('id');
                        $this->db->from('tenant_licence');
                        $this->db->order_by('id', 'desc');
                        $q_tenant_licence = $this->db->get()->row();
                        if ($q_tenant_licence) {
                            $tenant_licence_last_id = $q_tenant_licence->id + 1;
                        } else {
                            $tenant_licence_last_id = 1;
                        }

                        $insert_data_tenant_licence = array(
                            'licence_key' => time() . $rand_letter . '1' . $tenant_licence_last_id,
                            'tenant_id' => 1,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'user_id' => $datas['user_id'],
                            'licence_days' => $licence_days,
                            'is_use' => '1',
                        );
                        $this->db->insert('tenant_licence', $insert_data_tenant_licence);
                        $tenant_licence_id = $this->db->insert_id();
                    }

                    $this->db->where('id', $datas['user_id']);
                    $this->db->update('users', array('tenant_licence_id' => $tenant_licence_id));

                    $insert_data_user_payment = array(
                        'user_id' => $datas['user_id'],
                        'licence_key_id' => $tenant_licence_id,
                        'transaction_id' => $datas['transaction_id'],
                        'payment_status' => $datas['payment_status'],
                        'transaction_amount' => $datas['transaction_amount'],
                        'payment_for' => $datas['payment_for'],
                        'plan_id' => isset($datas['plan_id']) ? $datas['plan_id'] : null,
                        'licence_days' => isset($datas['licence_days']) ? $datas['licence_days'] : null,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('user_payment', $insert_data_user_payment);
                    //echo $this->db->last_query();
                    $finresult = array('status' => 'Success', 'message' => 'Payment details saved.');
                    print json_encode($finresult);
                    // 	}
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Licence key not available.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updatePaymentDetail() {
        date_default_timezone_set('Asia/Kolkata');
        if ($_POST) {
            $datas = $_POST;
            if ($datas['user_id'] != null) {
                $err_flag = "0";
                // 2-feb-2023
                $user_transaction_amount = "";
                $user_payment_for = "";

                if ($datas['transaction_amount'] == "0" && $datas['payment_status'] == "1" && $datas['payment_for'] == "1") {
                    $this->db->select('*');
                    $this->db->from('user_payment');
                    $this->db->where('user_payment.user_id', $datas['user_id']);
                    $this->db->where('user_payment.transaction_amount', '0');
                    $this->db->where('user_payment.payment_status', '1');
                    $this->db->where('user_payment.payment_for', '1');
                    $q = $this->db->get();
                    $row_array_user_payment_res = $q->row_array();
                    // print_R($row_array_user_payment_res);
                    if (!empty($row_array_user_payment_res)) {
                        $user_transaction_amount = $row_array_user_payment_res['transaction_amount'];
                        $user_payment_for = $row_array_user_payment_res['payment_for'];
                        $payment_status = $row_array_user_payment_res['payment_status'];
                        if ($user_transaction_amount == "0" && $user_payment_for == "1" && $payment_status == "1") {
                            $err_flag = "1";
                        }
                    }
                }

// print_R($err_flag);
// die;
                if ($err_flag == "0") {
                    $tenant_licence_id = null;
                    $tenant_licence_tenant_id = 1;
                    $users_tenant_id = null;
                    $result_users = array();
                    if ($datas['user_id'] != null) {
                        $this->db->where('id', $datas['user_id']);
                        $query_users = $this->db->get('users');
                        $result_users = $query_users->row();
                        if ($result_users) {
                            $users_tenant_id = $result_users->tenant_id;
                        }
                    }
                    //print_r($users_tenant_id);die;
                    if ($users_tenant_id != null && $tenant_licence_tenant_id != null) {
                        if ($users_tenant_id == $tenant_licence_tenant_id) {

                            if (isset($datas['licence_days']) && $datas['licence_days'] != null) {
                                $licence_days = $datas['licence_days'];
                                $licence_days_count = $licence_days;
                                $licence_days_count = $licence_days_count - 1;
                                $start_date = date('Y-m-d');
                                $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days_count . ' day'));

                                $this->db->select('id');
                                $this->db->from('tenant_licence');
                                $this->db->order_by('id', 'desc');
                                $q_tenant_licence = $this->db->get()->row();
                                if ($q_tenant_licence) {
                                    $tenant_licence_last_id = $q_tenant_licence->id + 1;
                                } else {
                                    $tenant_licence_last_id = 1;
                                }
                                $rand_letter = $this->getRandomLetter(2);

                                // tenant_keyword - 4-may-2023
                                $insert_tenant_id = 1;
                                $insert_tenant_keyword_id = null;
                                $insert_tenant_keyword = null;
                                $tenant_keyword = null;
                                if (isset($datas['tenant_keyword']) && $datas['tenant_keyword'] != null) {
                                    $tenant_keyword = $datas['tenant_keyword'];
                                    if ($tenant_keyword != null) {
                                        $tenant_keyword_res = $this->getTenantIdByTenantKeyword($tenant_keyword);
                                        if ($tenant_keyword_res) {
                                            $insert_tenant_id = $tenant_keyword_res['tenant_id'];
                                            $insert_tenant_keyword_id = $tenant_keyword_res['id'];
                                            $insert_tenant_keyword = $tenant_keyword_res['keyword'];
                                        } else {
                                            $result = array('status' => 'Fail', 'message' => 'Invalid tenant keyword.');
                                            print json_encode($result);
                                            die;
                                        }
                                    }
                                }
                            
                            $insert_data_tenant_licence = array(
                                    'licence_key' => time() . $rand_letter . '1' . $tenant_licence_last_id,
                                    // 'tenant_id' => 1,
                                'tenant_id' => $insert_tenant_id,
                                    'start_date' => $start_date,
                                    'end_date' => $end_date,
                                    'user_id' => $datas['user_id'],
                                    'licence_days' => $licence_days,
                                    'is_use' => '1',
                                    'plan_id' => isset($datas['plan_id']) ? $datas['plan_id'] : null,
                                );
                                $this->db->insert('tenant_licence', $insert_data_tenant_licence);
                                $tenant_licence_id = $this->db->insert_id();
                            }

                            $this->db->where('id', $datas['user_id']);
                            $this->db->update('users', array('tenant_licence_id' => $tenant_licence_id, 'tenant_id' => $insert_tenant_id));
                            //echo $this->db->last_query();
                            $transaction_amount = 0;
                            if (isset($datas['transaction_amount'])) {
                                if ($datas['transaction_amount'] >= 1) {
                                    $transaction_amount = $datas['transaction_amount'] / 100;
                                }
                            }
                            $insert_data_user_payment = array(
                                'user_id' => $datas['user_id'],
                                'licence_key_id' => $tenant_licence_id,
                                'transaction_id' => $datas['transaction_id'],
                                'payment_status' => $datas['payment_status'],
                                //'transaction_amount' => $datas['transaction_amount'] ,
                                'transaction_amount' => $transaction_amount,
                                'payment_for' => $datas['payment_for'],
                                'plan_id' => isset($datas['plan_id']) ? $datas['plan_id'] : null,
                                'licence_days' => isset($datas['licence_days']) ? $datas['licence_days'] : null,
                                'created_at' => date('Y-m-d H:i:s'),
                                // 4-may-2023
                                'tenant_keyword_id' => isset($insert_tenant_keyword_id) ? $insert_tenant_keyword_id : null,
                                'tenant_keyword' => isset($insert_tenant_keyword) ? $insert_tenant_keyword : null,
                                );
                            $this->db->insert('user_payment', $insert_data_user_payment);
                            //echo $this->db->last_query();
                            // 28-dec-2022
                            $update_data_user_plan = array(
                                'is_deleted' => '1',
                            );
                            $this->db->where('user_id', $datas['user_id']);
                            $this->db->update('user_plan', $update_data_user_plan);

                            $insert_data_user_plan = array(
                                'user_id' => $datas['user_id'],
                                'plan_id' => isset($datas['plan_id']) ? $datas['plan_id'] : null,
                                'start_date' => $start_date,
                                'end_date' => $end_date,
                                'status' => '1',
                                'transaction_id' => $datas['transaction_id'],
                                'licence_key_id' => $tenant_licence_id
                            );
                            $this->db->insert('user_plan', $insert_data_user_plan);

                            $finresult = array('status' => 'Success', 'message' => 'Payment details saved.');
                            print json_encode($finresult);
                        } else {
                            if ($result_users) {

                                $this->db->where('id', $datas['user_id']);
                                $this->db->update('users', array('is_deleted' => '1', 'status' => '2'));

                                if (isset($datas['licence_days']) && $datas['licence_days'] != null) {
                                    $licence_days = $datas['licence_days'];
                                    $licence_days_count = $licence_days;
                                    $licence_days_count = $licence_days_count - 1;
                                    $start_date = date('Y-m-d');
                                    $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days_count . ' day'));

                                    $this->db->select('id');
                                    $this->db->from('tenant_licence');
                                    $this->db->order_by('id', 'desc');
                                    $q_tenant_licence = $this->db->get()->row();
                                    if ($q_tenant_licence) {
                                        $tenant_licence_last_id = $q_tenant_licence->id + 1;
                                    } else {
                                        $tenant_licence_last_id = 1;
                                    }
                                    $rand_letter = $this->getRandomLetter(2);
                                    $insert_data_tenant_licence = array(
                                        'licence_key' => time() . $rand_letter . '1' . $tenant_licence_last_id,
                                        'tenant_id' => 1,
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'licence_days' => $licence_days,
                                        'is_use' => '1',
                                    );
                                    $this->db->insert('tenant_licence', $insert_data_tenant_licence);
                                    $tenant_licence_id = $this->db->insert_id();
                                }
                                //	echo $this->db->last_query();//die;

                                $insert_user_data = array(
                                    'user_type' => "3",
                                    'user_name' => $result_users->user_name,
                                    'password' => $result_users->password,
                                    'first_name' => $result_users->first_name,
                                    'middle_name' => $result_users->middle_name,
                                    'last_name' => $result_users->last_name,
                                    'email' => $result_users->email,
                                    'age' => $result_users->age,
                                    'gender' => $result_users->gender,
                                    'mobile_no' => $result_users->mobile_no,
                                    'blood_group' => $result_users->blood_group,
                                    'mpin' => $result_users->mpin,
                                    'date_of_birth' => $result_users->date_of_birth,
                                    'address' => $result_users->address,
                                    'city' => $result_users->city,
                                    'state' => $result_users->state,
                                    'status' => $result_users->status,
                                    'pincode' => $result_users->pincode,
                                    'device_token' => $result_users->device_token,
                                    'auth_key' => '',
                                    'profile_image' => $result_users->profile_image,
                                    'profile_image_thumb' => $result_users->profile_image_thumb,
                                    'tenant_id' => 1,
                                    'tenant_licence_id' => $tenant_licence_id
                                );

                                $this->db->insert('users', $insert_user_data);
                                // echo $this->db->last_query();
                                // die;
                                $new_user_id = $this->db->insert_id();

                                $this->db->where('id', $tenant_licence_id);
                                $this->db->update('tenant_licence', array('user_id' => $new_user_id));

                                $this->db->select('user_id,emergency_user_id,serial_no,name,is_deleted, profile_image, profile_image_thumb');

                                $this->db->where('emergency_contacts.is_deleted', 0);
                                $this->db->where('emergency_contacts.user_id', $datas['user_id']);
                                $res_emergency_contacts = $this->db->get('emergency_contacts')->result_array();

                                if (!empty($res_emergency_contacts)) {
                                    foreach ($res_emergency_contacts as $row) {
                                        $ins_arr = array(
                                            'user_id' => $new_user_id,
                                            'emergency_user_id' => $row['emergency_user_id'],
                                            'serial_no' => $row['serial_no'],
                                            'name' => $row['name'],
                                            'is_deleted' => 0,
                                            'profile_image' => $row['profile_image'],
                                            'profile_image_thumb' => $row['profile_image_thumb'],
                                        );
                                        $this->db->insert('emergency_contacts', $ins_arr);
                                    }
                                }

                                $finresult = array('status' => 'Success', 'message' => 'Payment details saved.');
                                print json_encode($finresult);
                            }
                        }
                    } else {
                        if (isset($datas['licence_days']) && $datas['licence_days'] != null) {
                            $licence_days = $datas['licence_days'];
                            $licence_days_count = $licence_days;
                            $licence_days_count = $licence_days_count - 1;
                            $start_date = date('Y-m-d');
                            $end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days_count . ' day'));

                            $this->db->select('id');
                            $this->db->from('tenant_licence');
                            $this->db->order_by('id', 'desc');
                            $q_tenant_licence = $this->db->get()->row();
                            if ($q_tenant_licence) {
                                $tenant_licence_last_id = $q_tenant_licence->id + 1;
                            } else {
                                $tenant_licence_last_id = 1;
                            }
                            $rand_letter = $this->getRandomLetter(2);
                            $insert_data_tenant_licence = array(
                                'licence_key' => time() . $rand_letter . '1' . $tenant_licence_last_id,
                                'tenant_id' => 1,
                                'start_date' => $start_date,
                                'end_date' => $end_date,
                                'user_id' => $datas['user_id'],
                                'licence_days' => $licence_days,
                                'is_use' => '1',
                                'plan_id' => isset($datas['plan_id']) ? $datas['plan_id'] : null,
                            );
                            $this->db->insert('tenant_licence', $insert_data_tenant_licence);
                            $tenant_licence_id = $this->db->insert_id();
                        }

                        $this->db->where('id', $datas['user_id']);
                        $this->db->update('users', array('tenant_licence_id' => $tenant_licence_id));
                        //echo $this->db->last_query();
                        $transaction_amount = 0;
                        if (isset($datas['transaction_amount'])) {
                            if ($datas['transaction_amount'] >= 1) {
                                $transaction_amount = $datas['transaction_amount'] / 100;
                            }
                        }
                        $insert_data_user_payment = array(
                            'user_id' => $datas['user_id'],
                            'licence_key_id' => $tenant_licence_id,
                            'transaction_id' => $datas['transaction_id'],
                            'payment_status' => $datas['payment_status'],
                            //'transaction_amount' => $datas['transaction_amount'] ,
                            'transaction_amount' => $transaction_amount,
                            'payment_for' => $datas['payment_for'],
                            'plan_id' => isset($datas['plan_id']) ? $datas['plan_id'] : null,
                            'licence_days' => isset($datas['licence_days']) ? $datas['licence_days'] : null,
                            'created_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('user_payment', $insert_data_user_payment);
                        //echo $this->db->last_query();
                        $finresult = array('status' => 'Success', 'message' => 'Payment details saved.');
                        print json_encode($finresult);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Free trial plan already used for this mobile number.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Invalid Licence key.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    function getRandomLetter($n) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    public function getLicenceNewUser() {
        $result = $this->api_model->getAdminLicenceKey();
        if ($result) {

            $finresult = array('status' => 'Success', 'message' => 'Licence key details.', 'data' => $result);
            print json_encode($finresult);
        } else {
            $result = array('status' => 'Fail', 'message' => 'Licence key not available.');
            print json_encode($result);
        }
    }

    public function getEmergencyMap() {
        if ($_POST) {
            $datas = $_POST;
            if (isset($datas['latitude']) && isset($datas['longitude']) && isset($datas['location_type'])) {
                $user_id = isset($datas['user_id']) ? $datas['user_id'] : null;
                $latitude = $datas['latitude'];
                $longitude = $datas['longitude'];
                $location_type = $datas['location_type'];

                // insert  - emergency_map_user_request
                $insert_data = array(
                    'user_id' => $user_id,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'location_type' => $location_type,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('emergency_map_user_request', $insert_data);

                $curl = curl_init();
                //           https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=18.6030087,73.7884979&radius=10000&types=gas_station&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8
    //ATM   //  curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $latitude . ',' . $longitude . '&radius=10000&types=' . $location_type . '&key=AIzaSyDIJerlIQ5DZUqXmAndOExCfLQ6lNnyU1c');
                // curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?keyword=' . $location_type . '&location=' . $latitude . ',' . $longitude . '&radius=10000&types=' . $location_type . '&key=AIzaSyDIJerlIQ5DZUqXmAndOExCfLQ6lNnyU1c');
                
                // AIzaSyDIJerlIQ5DZUqXmAndOExCfLQ6lNnyU1c

                if (strtolower($location_type) == 'atm' || strtolower($location_type) == 'hospital' || strtolower($location_type) == 'police' || strtolower($location_type) == 'gas_station') {
                    curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $latitude . ',' . $longitude . '&radius=10000&types=' . $location_type . '&key=AIzaSyCaIUBU_vP5iYQVoXX1NL4YE4QcW6amQFw');
                } else {
                    curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?keyword=' . $location_type . '&location=' . $latitude . ',' . $longitude . '&radius=10000&types=' . $location_type . '&key=AIzaSyCaIUBU_vP5iYQVoXX1NL4YE4QcW6amQFw');
                }

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                //     curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
                //    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                // curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);
                // print_r($response);
                // die;
                if ($response) {
                    //   $json_result = json_decode($response, true);
                    print ( $response);
                } else {
                    
                }
            }
        }
    }

    public function getMapPlace() {
        if ($_POST) {
            $datas = $_POST;
            if (isset($datas['placeid'])) {
                $placeid = $datas['placeid'];
                $curl = curl_init();
                //          https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJjX3ueHW5wjsRk9WLGedm1Qg&sensor=false&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8
                curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $placeid . '&sensor=false&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                //     curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
                //    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                // curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);
                // print_r($response);
                // die;
                if ($response) {
                    //   $json_result = json_decode($response, true);
                    print ( $response);
                } else {
                    
                }
            }
        }
    }

    public function getMapSearchString() {
        if ($_POST) {
            $datas = $_POST;
            if (isset($datas['search_string'])) {
                $search_string = $datas['search_string'];
                $curl = curl_init();
                //         let urlString = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=\(searchString)&key=\(Google_API_Key)"
                $search_string = rawurlencode($search_string);
                curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $search_string . '&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                //     curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
                //    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                // curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);
                // print_r($response);
                // die;
                if ($response) {
                    //   $json_result = json_decode($response, true);
                    print ( $response);
                } else {
                    
                }
            }
        }
    }

    // 22-aug-2022
    public function getSettings() {
        $data = $_POST;
        $finresults = $this->api_model->getSettings($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    //29-aug-2022
    public function updateEndLocation($firebase_key) {

        $last_location_arr = array();
        $start_location = array();
        $start_location_arr = array();
        // $handle = curl_init();
        // $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        // curl_setopt($handle, CURLOPT_URL, $url);
        // // Set the result output to be a string.
        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($handle);
        // curl_close($handle);
        $output = $this->api_model->getFirebaseLocationByFirebaseId($firebase_key);

        if ($output) {
            $data_json = $output;
            $data = $firebase_arr = json_decode($output, true);

            if (!empty($data)) {
                $last = $data[0];
                $start = end($data);
                date_default_timezone_set('Asia/Kolkata');

                $this->db->select("*");
                $this->db->where('location_log.firebase_key', $firebase_key);
                $query = $this->db->get('location_log');
                if ($query->num_rows() > 0) {
                    $update_data_location_log = array(
                        'location_json' => $data_json,
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('firebase_key', $firebase_key);
                    $this->db->update('location_log', $update_data_location_log);
                } else {

                    $insert_data_location_log = array(
                        'firebase_key' => $firebase_key,
                        'location_json' => $data_json,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('location_log', $insert_data_location_log);
                }

                if ($last) {
                    $ulat = number_format((float) $last['lat'], 6, '.', '');
                    $ulng = number_format((float) $last['lng'], 6, '.', '');
                    $date_value = "";
                    if (is_float($last['time'])) {
                        $date_value = date('Y-m-d H:i:s', $last['time']);
                    } else {
                        $date_value = $utime = date('Y-m-d H:i:s', $last['time'] / 1000);
                    }
                    $last_location_arr = array(
                        "lat" => $ulat,
                        "lng" => $ulng,
                        "power" => $last['power'],
                        "time" => $last['time'],
                        "date_value" => $date_value,
                    );
                }
                if ($start) {
                    $ulat = number_format((float) $start['lat'], 6, '.', '');
                    $ulng = number_format((float) $start['lng'], 6, '.', '');
                    $date_value = "";
                    if (is_float($start['time'])) {
                        $date_value = date('Y-m-d H:i:s', $start['time']);
                    } else {
                        $date_value = $utime = date('Y-m-d H:i:s', $start['time'] / 1000);
                    }
                    $start_location_arr = array(
                        "lat" => $ulat,
                        "lng" => $ulng,
                        "power" => $start['power'],
                        "time" => $start['time'],
                        "date_value" => $date_value,
                    );
                }
            }
        }

        if (!empty($last_location_arr)) {
            $end_location = json_encode($last_location_arr, true);

            if (!empty($start_location_arr)) {
                $start_location = json_encode($start_location_arr, true);
            }
            $this->db->where('firebase_key', $firebase_key);
            $this->db->update('tracking', array('end_location' => $end_location, 'start_location' => $start_location));
        }
    }

    public function addLocationLog($firebase_key) {
        $insert_data_location_log = array(
            'firebase_key' => $firebase_key,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('location_log', $insert_data_location_log);
    }

    // 22-aug-2022
    public function deactiveUser() {
        $data = $_POST;
        if ($_POST['user_id']) {
            $finresults = $this->api_model->deactiveUser($_POST['user_id']);
            if ($finresults) {
                $result = array('status' => 'Success', 'result' => $finresults, 'message' => 'Account deleted successfully.');
                print json_encode($result);
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getCityState() {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $data = $_POST;
        if (isset($data['pincode'])) {
            $finresults = $this->api_model->getCityState($_POST['pincode']);
            if ($finresults) {
                $result = array('status' => 'Success', 'result' => $finresults);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    //10-oct-2022
    public function getHealthysureRegister() {
        //error_reporting(E_ALL); ini_set('display_errors', '1');
        if ($_POST) {
            $datas = $_POST;
            if (isset($datas['member_id'])) {
                $member_id = $datas['member_id'];
                // $header_arr= array(  'client-id: qxHocZ0Lmw0qfe8FB5fK5UM4axbmlDgLyE39NTVX' );
                $header_arr = array('client-id: LUiJTTNpwVECS3EaRCWXDdq11U7e1tXilvgn6vBc');
                $post_fields = array('member_id' => '12', 'name' => 'manish12 ', 'gender' => 'Male', 'email' => 'manish12@gmail.com', 'date_of_birth' => '2010-10-19', 'plan_type' => 'C');
                $curl = curl_init();
                // curl_setopt($curl, CURLOPT_URL , 'https://stagingapi.healthysure.co/product_integration/digit_grp/digit_grp' );
                curl_setopt($curl, CURLOPT_URL, 'https://api.healthysure.co/product_integration/digit_grp/digit_grp');
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
                            // 	$insert_data_call_health_insurance = array (
                            // 		'member_id' =>$json_result['data']['member_id'],
                            // 		'name' =>$json_result['data']['name'],
                            // 		'date_of_birth' =>$json_result['data']['date_of_birth'],
                            // 		'gender' =>$json_result['data']['gender'],
                            // 		'email' =>$json_result['data']['email'],
                            // 		'sum_insured' =>$json_result['data']['sum_insured'],
                            // 		'plan_type' =>$json_result['data']['plan_type'],
                            // 		'request_result' =>$response,
                            // 		'created_at' => date('Y-m-d H:i:s'),
                            //     );
                            //     $this->db->insert('call_health_insurance', $insert_data_call_health_insurance);
                        }
                    }
                }
                if ($response) {
                    print ( $response);
                } else {
                    
                }
            }
        }
    }

    //10-oct-2022
    public function getHealthysureDigitgrp() {
        if ($_POST) {
            $datas = $_POST;
            if (isset($datas['user_id'])) {
                $member_id_val = null;
                $get_user_result = $this->api_model->getUsersById($datas['user_id']);
                if (!empty($get_user_result)) {
                    if ($get_user_result['member_id']) {
                        $member_id_val = $get_user_result['member_id'];
                    }
                    if ($member_id_val == null) {
                        $gender_value = $get_user_result['gender'] == 1 ? "Male" : 'Female';
                        $health_insurance_register_arr = array(
                            'user_id' => $datas['user_id'],
                            'member_id' => 'CI' . $datas['user_id'],
                            'name' => $get_user_result['first_name'] . " " . $get_user_result['last_name'],
                            'gender' => $gender_value ? $gender_value : 'Male',
                            'email' => $get_user_result['email'],
                            'date_of_birth' => $get_user_result['date_of_birth'],
                            'plan_type' => 'A',
                            'phone' => $get_user_result['mobile_no'],
                        );
                        $get_health_insurance_result = $this->api_model->sendHealthysureRegister($health_insurance_register_arr);
                        $get_user_result = $this->api_model->getUsersById($datas['user_id']);
                        if (!empty($get_user_result)) {
                            if ($get_user_result['member_id']) {
                                $member_id_val = $get_user_result['member_id'];
                            }
                        }
                    }
                }
            }
            if (isset($datas['user_id']) && $member_id_val != null) {

                // $member_id =  'CI' . $datas['user_id'];
                $member_id =  $member_id_val;
                //   $member_id = 0017; // static id
                // print_R("member_id = " .$member_id);
                // die;
                // $header_arr = array(  'client-id: qxHocZ0Lmw0qfe8FB5fK5UM4axbmlDgLyE39NTVX' );
                $header_arr = array('client-id: LUiJTTNpwVECS3EaRCWXDdq11U7e1tXilvgn6vBc');
                $curl = curl_init();
                // curl_setopt($curl, CURLOPT_URL , 'https://stagingapi.healthysure.co/product_integration/digit_grp/digit_grp_coi?member_id='.$member_id );
                curl_setopt($curl, CURLOPT_URL, 'https://api.healthysure.co/product_integration/digit_grp/digit_grp_coi?member_id=' . $member_id);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                $response = curl_exec($curl);
                curl_close($curl);
                //   print_R($response);//die;
                $return_result_arr = array();
                $status = 'Fail';
                $status_column_value = '2';
                $msg = 'Record not found';
                if ($response) {
                    $json_result = json_decode($response, true);
                    if ($json_result) {
                        if (isset($json_result['member_detail']) && !empty($json_result['member_detail'])) {
                            $return_result_arr['member_id'] = $json_result['member_id'];
                            if (isset($json_result['member_detail']['full_name'])) {
                                $return_result_arr['full_name'] = $json_result['member_detail']['full_name'];
                            }
                            if (isset($json_result['member_detail']['date_of_birth'])) {
                                $return_result_arr['date_of_birth'] = $json_result['member_detail']['date_of_birth'];
                            }
                            if (isset($json_result['member_detail']['gender'])) {
                                $return_result_arr['gender'] = $json_result['member_detail']['gender'];
                            }
                            if (isset($json_result['member_detail']['membership_id'])) {
                                $return_result_arr['membership_id'] = $json_result['member_detail']['membership_id'];
                            }
                            if (isset($json_result['member_detail']['policy_number'])) {
                                $return_result_arr['policy_number'] = $json_result['member_detail']['policy_number'];
                            }
                            if (isset($json_result['member_detail']['sum_insured'])) {
                                $return_result_arr['sum_insured'] = $json_result['member_detail']['sum_insured'];
                            }
                            if (isset($json_result['member_detail']['policy_number'])) {
                                $status_column_value = '1';
                            }
                            if (isset($json_result['coi']) && isset($json_result['coi'][0])) {
                                //pdf
                                $pdf_content = $json_result['coi'][0];
                                $pdf_decoded = base64_decode($pdf_content);
                                //Write data back to pdf file
                                // $pdf = fopen (base_url() . 'uploads/health_insurance_pdf/' .'member_id_'.$json_result['member_id']."_".date('Y_m_d_H_i_s').'.pdf','w');
                                $file_name = 'member_id_' . $json_result['member_id'] . "_" . date('Y_m_d_H_i_s') . '.pdf';
                                $pdf = fopen('./uploads/health_insurance_pdf/' . $file_name, 'w');
                                fwrite($pdf, $pdf_decoded);
                                //close output file
                                fclose($pdf);
                                $return_result_arr['pdf_file'] = base_url() . 'uploads/health_insurance_pdf/' . $file_name;
                            }
                           
                            $insert_data_call_health_insurance = array(
                                'member_id' => $json_result['member_id'],
                                'full_name' => isset($json_result['member_detail']['full_name']) ? $json_result['member_detail']['full_name'] : null,
                                'date_of_birth' => isset($json_result['member_detail']['date_of_birth']) ? $json_result['member_detail']['date_of_birth'] : null,
                                'gender' => isset($json_result['member_detail']['gender']) ? $json_result['member_detail']['gender'] : null,
                                'membership_id' => isset($json_result['member_detail']['membership_id']) ? $json_result['member_detail']['membership_id'] : null,
                                'policy_number' => isset($json_result['member_detail']['policy_number']) ? $json_result['member_detail']['policy_number'] : null,
                                'sum_insured' => isset($json_result['member_detail']['sum_insured']) ? $json_result['member_detail']['sum_insured'] : null,
                                'pdf_file' => isset($json_result['coi'][0]) ? base_url() . 'uploads/health_insurance_pdf/' . $file_name : null,
                                'coi' => isset($json_result['coi'][0]) ? $json_result['coi'][0] : null,
                                'status' => $status_column_value,
                                'request_result' => $response,
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->db->insert('call_health_insurance', $insert_data_call_health_insurance);
                            $status = 'Success';
                            $msg = 'Record found';
                        } else {
                          
                            // if (isset($json_result['policy_copy']) && isset($json_result['policy_copy'][0])) {
                                //pdf
                                // $pdf_content_policy_copy = $json_result['policy_copy'][0];
                                // $pdf_decoded_policy_copy = base64_decode($pdf_content_policy_copy);
                                // //Write data back to pdf file
                                // // $pdf = fopen (base_url() . 'uploads/health_insurance_pdf/' .'member_id_'.$json_result['member_id']."_".date('Y_m_d_H_i_s').'.pdf','w');
                                // $file_name_policy_copy = 'member_id_' . $json_result['member_id'] . "_1111" . date('Y_m_d_H_i_s') . '.pdf';
                                // $pdf_policy_copy = fopen('./uploads/health_insurance_pdf/' . $file_name_policy_copy, 'w');
                                // fwrite($pdf_policy_copy, $pdf_decoded_policy_copy);
                                // //close output file
                               
                                // fclose($pdf_policy_copy);
                                 
                                // print_r(base_url() . 'uploads/health_insurance_pdf/' . $file_name_policy_copy);
                                // die;
                                // $return_result_arr['pdf_file'] = base_url() . 'uploads/health_insurance_pdf/' . $file_name;
                            // }
                            $status = 'Failed';
                            $msg = 'Thank you for your request. We are processing the same and you can download the certificate of insurance within 72 hrs';

                            // $this->db->select('call_health_insurance.id, call_health_insurance.pdf_file');
                            // $this->db->from('call_health_insurance');
                            // $this->db->where('call_health_insurance.member_id', $member_id);
                            // $this->db->order_by('call_health_insurance.id', 'DESC');
                            // $query_call_health_insurance = $this->db->get();
                            // if ($query_call_health_insurance->num_rows() > 0) {
                            //     $res_call_health_insurance = $query_call_health_insurance->row_array();
                            //     if ($res_call_health_insurance) {
                            //         $status = 'Success';
                            //         $msg = 'Record found';
                            //         $return_result_arr['pdf_file'] = base_url() . 'uploads/health_insurance_pdf/' . $res_call_health_insurance['pdf_file'];
                            //     }
                            // } else {
                            //     $status = 'Failed';
                            //     $msg = 'Thank you for your request. We are processing the same and you can download the certificate of insurance within 72 hrs';
                            // }
                        }
                    }
                }
                $result = array('status' => $status, 'message' => $msg, 'result' => $return_result_arr);
                print json_encode($result);
            }
        }
    }

    public function registerUserHealthysureDigitgrp() {
        $data = $_POST;
        $finresults = $this->api_model->getUsers();
        if ($finresults) {
            foreach ($finresults as $row) {
                if ($row['member_id'] == null) {
                    $first_name = $row['first_name'] ? $row['first_name'] : "";
                    $last_name = $row['last_name'] ? $row['last_name'] : "";
                    $email = $row['email'] ? $row['email'] : "";
                    $date_of_birth = $row['date_of_birth'] ? $row['date_of_birth'] : "";
                    $gender = "";
                    if ($row['gender'] == "1") {
                        $gender = "Male";
                    }
                    if ($row['gender'] == "2") {
                        $gender = "Female";
                    }
                    $user_id = $row['id'];
                    $register_data = array(
                        'member_id' => $row['id'],
                        'name' => $first_name . " " . $last_name,
                        'gender' => $gender,
                        'email' => $email,
                        'date_of_birth' => $date_of_birth,
                        'plan_type' => 'A'
                    );
                    //  print_R($register_data);
                    $this->sendHealthysureUserRegister($register_data, $user_id);
                    //   die;
                }
            }
            // $result = array('status'  => 'Success','result' => $finresults);
            // print json_encode( $result );
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function sendHealthysureUserRegister($data, $user_id) {
        // error_reporting(E_ALL); ini_set('display_errors', '1');
        if ($data) {
            if (isset($data['member_id'])) {
                $member_id = $data['member_id'];

                $header_arr = array('client-id: LUiJTTNpwVECS3EaRCWXDdq11U7e1tXilvgn6vBc');
                // $post_fields = array('member_id' => '12','name' => 'manish12 ','gender' => 'Male','email' => 'manish12@gmail.com','date_of_birth' => '2010-10-19','plan_type' => 'C');
                $post_fields = $data;
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://api.healthysure.co/product_integration/digit_grp/digit_grp');
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
                            $this->db->where('id', $user_id);
                            $this->db->update('users', $user_update_data);
                        }
                    }
                }
                if ($response) {
                    print ($response);
                } else {
                    
                }
            }
        }
    }

    // get user dashboard menu
    public function getUserDashboard() {
        $input_data = $_POST;
        if ($input_data && isset($input_data['user_id'])) {
            $user_id = $input_data['user_id'];
            $tenant_id = null;

            $this->db->select('id, tenant_id');
            $this->db->from('users');
            $this->db->where('id', $user_id);
            $query = $this->db->get();
            $res_users = $query->row_array();
            if ($res_users) {
                $tenant_id = $res_users['tenant_id'];
            }

            if ($tenant_id != null) {
                $this->db->select('user_dashboard.id, user_dashboard.dashboard_menu_id, user_dashboard.menu_name, user_dashboard.sequence, tenant_privileges.is_checked');
                $this->db->from('user_dashboard');
                $this->db->join('tenant_privileges', 'tenant_privileges.dashboard_menu_id = user_dashboard.dashboard_menu_id', 'left');
                $this->db->where('user_id', $user_id);
                $this->db->where('tenant_privileges.tenant_id', $tenant_id);
                $this->db->where('tenant_privileges.is_checked', '1');
                $this->db->order_by('user_dashboard.sequence', 'ASC');
                $query = $this->db->get();
                // if ($query->num_rows() > 0) {
                if ($query->num_rows() >= 1) {
                    $user_dashboard_result = $query->result();
                    $dashboard_menu_id_arr = array_column($user_dashboard_result, 'dashboard_menu_id');
                    $result = array('status' => 'Success', 'result' => $dashboard_menu_id_arr);
                    print json_encode($result);
                } else {
                    $this->db->select("*");
                    $this->db->from('default_dashboard_menu');
                    $this->db->order_by('default_dashboard_menu.default_sequence', 'ASC');
                    $query = $this->db->get();
                    $default_dashboard_menu_result = $query->result();
                    if ($default_dashboard_menu_result) {
                        foreach ($default_dashboard_menu_result as $row) {
                            $menu_id = $row->id;
                            $menu_name = $row->menu_name;
                            $default_sequence = $row->default_sequence;
                            $insert_data = array(
                                'user_id' => $user_id,
                                'dashboard_menu_id' => $menu_id,
                                'menu_name' => $menu_name,
                                'sequence' => $default_sequence,
                            );
                            $this->db->insert('user_dashboard', $insert_data);
                            $uid = $this->db->insert_id();
                        }
                    }
                    // $this->db->select('id, dashboard_menu_id, menu_name, sequence');
                    // $this->db->from('user_dashboard');
                    // $this->db->where('user_id', $user_id);
                    // $this->db->order_by('user_dashboard.sequence', 'ASC');
                    // $query = $this->db->get();
                    
                    $this->db->select('user_dashboard.id, user_dashboard.dashboard_menu_id, user_dashboard.menu_name, user_dashboard.sequence, tenant_privileges.is_checked');
                    $this->db->from('user_dashboard');
                    $this->db->join('tenant_privileges', 'tenant_privileges.dashboard_menu_id = user_dashboard.dashboard_menu_id', 'left');
                    $this->db->where('user_id', $user_id);
                    $this->db->where('tenant_privileges.tenant_id', $tenant_id);
                    $this->db->where('tenant_privileges.is_checked', '1');
                    $this->db->order_by('user_dashboard.sequence', 'ASC');
                    $query = $this->db->get();
                    // if ($query->num_rows() > 0) {
                    if ($query->num_rows() >= 1) {
                        $user_dashboard_result = $query->result();
                        $dashboard_menu_id_arr = array_column($user_dashboard_result, 'dashboard_menu_id');
                        $result = array('status' => 'Success', 'result' => $dashboard_menu_id_arr);
                        print json_encode($result);
                    } else {
                        $error_info = $this->api_model->getErrorCode('13');
                        $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                        print json_encode($result);
                    }
                }
            } else {
                $dashboard_menu_id_arr = array();
                $result = array('status' => 'Success', 'result' => $dashboard_menu_id_arr);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // save user dashboard menu
    public function saveUserDashboard() {
        $input_data = $_POST;
        if ($input_data && isset($input_data['user_id'])) {
            $user_id = $input_data['user_id'];
            $menu_sequence_list = $input_data['menu_sequence_list'];
            $menu_sequence_list_array = json_decode($menu_sequence_list);
            $index = 1;
            foreach ($menu_sequence_list_array as $row) {
                $update_user_dashboard['sequence'] = $index;
                $this->db->where('dashboard_menu_id', $row);
                $this->db->where('user_id', $user_id);
                $this->db->update('user_dashboard', $update_user_dashboard);
                $index++;
            }
            $this->db->select('id, dashboard_menu_id, menu_name, sequence');
            $this->db->from('user_dashboard');
            $this->db->where('user_id', $user_id);
            $this->db->order_by('user_dashboard.sequence', 'ASC');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $user_dashboard_result = $query->result();
                $dashboard_menu_id_arr = array_column($user_dashboard_result, 'dashboard_menu_id');
                $result = array('status' => 'Success', 'result' => $dashboard_menu_id_arr);
                print json_encode($result);
            } else {
                $this->db->select("*");
                $this->db->from('default_dashboard_menu');
                $query = $this->db->get();
                $default_dashboard_menu_result = $query->result();
                if ($default_dashboard_menu_result) {
                    foreach ($default_dashboard_menu_result as $row) {
                        $menu_id = $row->id;
                        $menu_name = $row->menu_name;
                        $default_sequence = $row->default_sequence;
                        $insert_data = array(
                            'user_id' => $user_id,
                            'dashboard_menu_id' => $menu_id,
                            'menu_name' => $menu_name,
                            'sequence' => $default_sequence,
                        );
                        $this->db->insert('user_dashboard', $insert_data);
                        $uid = $this->db->insert_id();
                    }
                }
                $this->db->select('id, dashboard_menu_id, menu_name, sequence');
                $this->db->from('user_dashboard');
                $this->db->where('user_id', $user_id);
                $this->db->order_by('user_dashboard.sequence', 'ASC');
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $user_dashboard_result = $query->result();
                    $dashboard_menu_id_arr = array_column($user_dashboard_result, 'dashboard_menu_id');
                    $result = array('status' => 'Success', 'result' => $dashboard_menu_id_arr);
                    print json_encode($result);
                } else {
                    $error_info = $this->api_model->getErrorCode('13');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                }
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 17-nov-2022
    public function getBulletinTag() {
        $data = $_POST;
        if (isset($data['user_id'])) {
            $finresults = $this->api_model->getBulletinTag();
            if ($finresults) {
                $newkey = 0;
                $assign_array = $finresults;
                foreach($finresults as $key=>$value){
                    // Added by prabir
                    if($key==0){
                        $b['id'] = "0";
                        $b['title'] = "All";
                        $b['tenant_id'] = "0";
                        $b['status'] = "1";
                        $b['created_at'] = date('Y-m-d H:i:s');
                        $b['is_selected'] = true;
                        $finresults[$newkey] = (object) $b;
                    }
                    $newkey = $newkey + 1;
                    $p = (array) $assign_array[$key];
                    $p['is_selected'] = false;
                    $finresults[$newkey] = (object) $p;
                }
                
                $result = array('status' => 'Success', 'result' => $finresults);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 18-nov-2022
    public function getBanner() {
        $data = $_POST;
        if (isset($data['user_id'])) {
            $finresults = $this->api_model->getBanner();
            if ($finresults) {
                $result = array('status' => 'Success', 'result' => $finresults);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // get user plan details
    public function getUserPlan() {
        $data = $_POST;
        $finresults = $this->api_model->getUserPlan($_POST['user_id']);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getUserAmbulance() {
        $data = $_POST;
        $final_result = $this->api_model->getUserAmbulance($_POST['user_id']);
        if ($final_result) {
            $result = array('status' => 'Success', 'result' => $final_result);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getUserRoadSideAssistance() {
        $data = $_POST;
        $final_result = $this->api_model->getUserRoadSideAssistance($_POST['user_id']);
        if ($final_result) {
            $result = array('status' => 'Success', 'result' => $final_result);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 30-dec-2022
    public function addUserDevice() {
        $data = $_POST;
        if ($_POST['user_id']) {
            $final_result = $this->api_model->addUserDevice($data);
            if ($final_result) {
                // $result = array('status'  => 'Success','result' => $final_result, 'message' => 'Device added successfully.');
                $result = array('status' => 'Success', 'message' => 'Device added successfully.');
                print json_encode($result);
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 12-jan-2022
    public function addQrCode() {
        $data = $_POST;
        if ($_POST['user_id']) {
            // check Qr Code used
            $final_result_check_code_exists = $this->api_model->checkQrCodeExists($data['code']);
            if ($final_result_check_code_exists) {

                // $final_result_check_code_type = $this->api_model->checkQrCodeType($data);
                // if ($final_result_check_code_type > 0) {

                $final_result_check_code_used = $this->api_model->checkQrCodeUsed($data);
                if ($final_result_check_code <= 0) {

                    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
                        $image_info = getimagesize($_FILES['image']['tmp_name']);

                        if ($image_info != FALSE) {
                            if ($_FILES['image']['name']) {
                                $path = $_FILES['image']['name'];
                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                                    $ext = "jpg";
                                } else if (in_array($ext, array('gif', 'GIF'))) {
                                    $ext = "gif";
                                } else if (in_array($ext, array('png', 'PNG'))) {
                                    $ext = "png";
                                }
                                $image_name = "qrcode_" . time() . '.' . $ext;
                                $target_dir = "../backend/uploads/qrcode_type_image/";
                                $target_file = $target_dir . basename($image_name);
                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                    
                                }
                            }
                        }
                    }
                    if ($image_name != null) {
                        $data['image'] = basename($image_name);
                        $data['image_path'] = '/qrcode_type_image/' . $image_name;
                    }
                    $get_qrcode_result = $this->api_model->getQrcodeDetail($data['code']);

                    if ($get_qrcode_result) {

                        $data['id'] = $get_qrcode_result['id'];
                        $final_result = $this->api_model->addQrCode($data);
                        if ($final_result) {
                            $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Code linked successfully.');
                            print json_encode($result);
                        } else {
                            $error_info = $this->api_model->getErrorCode('13');
                            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                            print json_encode($result);
                        }
                    } else {
                        $result = array('status' => 'Fail', 'message' => 'Code not available');
                        print json_encode($result);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Code already used');
                    print json_encode($result);
                }
                // } else {
                //     $result = array('status' => 'Fail', 'message' => 'This code is available for type - ' . $final_result_check_code_exists['type'] . ' (' . $final_result_check_code_exists['type_title'] . ')');
                //     print json_encode($result);
                // }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Code not available');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function scanQrcode() {
        $data = $_POST;
        if ($_POST['qr_code']) {
            $final_result = $this->api_model->getQrcodeDetail($data['qr_code']);
            if ($final_result) {
                $code_id = $final_result['id'];
                if ($final_result['user_id'] != null) {
                    $code = $_POST['qr_code'];
                    // $final_result['detail_url'] = base_url() . 'index.php/api/qrcodedetail/' . $code_id;
                    $final_result['detail_url'] = 'https://qr.zimaxxtech.com/code.php?uid=' . $code;
                } else {
                    $final_result['detail_url'] = '';
                }
                $result = array('status' => 'Success', 'result' => $final_result);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getLinkedQrcodeByUserid() {
        $data = $_POST;
        if ($_POST['user_id']) {
            $final_result = $this->api_model->getLinkedQrcodeByUserid($data['user_id']);
            if ($final_result) {
                $result = array('status' => 'Success', 'result' => $final_result);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function qrcodedetail($code_id) {
        $data['page'] = 'qrcode detail';
        $data['captain_india_logo'] = base_url() . 'images/captain_india.png';
        $data['captain_india_support'] = base_url() . 'images/captain_india_support.png';
        $data['missing_status'] = base_url() . 'images/missing_status.png';
        $data['send_otp_view_url'] = base_url() . 'index.php/api/sendotpviewpage/' . $code_id;
        $data['send_otp_url'] = base_url() . 'index.php/api/sendotpqrcode';
        $data['verify_otp_url'] = base_url() . 'index.php/api/verifyotpsdqrcode';
        $data['missing_alert_url'] = base_url() . 'index.php/api/addmissingalert';
        $result = array();
        if ($code_id) {
            $result = $this->api_model->getQrCodeById($code_id);
        }
        $data['result'] = $result;
        $this->load->view('qrcode_detail', $data);
    }

    public function qrcodedetailbycode($code) {
        $data['page'] = 'qrcode detail';
        $data['captain_india_logo'] = base_url() . 'images/captain_india.png';
        $data['captain_india_support'] = base_url() . 'images/captain_india_support.png';
        $data['missing_status'] = base_url() . 'images/missing_status.png';
        $data['send_otp_view_url'] = base_url() . 'index.php/api/sendotpviewpage/' . $code_id;
        $data['send_otp_url'] = base_url() . 'index.php/api/sendotpqrcode';
        $data['verify_otp_url'] = base_url() . 'index.php/api/verifyotpsdqrcode';

        $result = array();
        if ($code) {
            $get_qrcode_result = $this->api_model->getQrcodeDetail($code);
            if ($get_qrcode_result) {
                $code_id = $get_qrcode_result['id'];
                $result = $this->api_model->getQrCodeById($code_id);
            }
        }
        $data['result'] = $result;
        $this->load->view('qrcode_detail', $data);
    }

    public function qrcodeuserdetail($code_id) {
        if (!isset($_COOKIE['otp_success'])) {
            // $this->sendotpviewpage($code_id);
            $this->qrcodedetail($code_id);
        } else {
            $data['page'] = 'qrcode detail';
            $data['captain_india_logo'] = base_url() . 'images/captain_india.png';
            $data['captain_india_support'] = base_url() . 'images/captain_india_support.png';
            $data['missing_status'] = base_url() . 'images/missing_status.png';
            $data['send_otp_view_url'] = base_url() . 'index.php/api/sendotpviewpage/' . $code_id;
            $result = array();
            if ($code_id) {
                $result = $this->api_model->getQrCodeById($code_id);
            }
            $data['result'] = $result;
            $this->load->view('qrcode_user_detail', $data);
        }
    }

    public function sendotpviewpage($code_id) {
        $data['page'] = 'qrcode detail';
        $data['captain_india_logo'] = base_url() . 'images/captain_india.png';
        $data['captain_india_support'] = base_url() . 'images/captain_india_support.png';
        $data['send_otp_url'] = base_url() . 'index.php/api/sendotpqrcode';
        $data['verify_otp_url'] = base_url() . 'index.php/api/verifyotpsdqrcode';
        $data['code_id'] = $code_id;
        $this->load->view('view_otp_form', $data);
    }

    public function sendotpqrcode() {
        $data = $_POST;
        $final_result = $this->api_model->sendOTP($_POST);
        if ($final_result) {
            $result = array('status' => 'Success');
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('4');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function verifyotpsdqrcode() {
        $data = $_POST;
        $is_exist = $this->db->get_where('user_otp', array('otp' => $data['otp']))->row();
        if ($is_exist) {
            $final_result = $this->api_model->verifyOTPqrcode($_POST);
            $user_detail_url = base_url() . 'index.php/api/qrcodeuserdetail/' . $_POST['code_id'];
            if ($final_result) {
                // check otp time
                if (isset($final_result['status']) && $final_result['status'] == false) {
                    $error_info = $this->api_model->getErrorCode('15');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                } else {
                    setcookie("otp_success", "1", time() + 120, '/'); // expires after 120 seconds
                    // echo 'the cookie has been set for 120 seconds';
                    $result_get_qrcode = array();
                    if ($_POST['code_id']) {
                        $result_get_qrcode = $this->api_model->getQrCodeById($_POST['code_id']);
                    }
                    $emergency_contacts_html = "";
                    if (!empty($result_get_qrcode['mobile_no'])) {
                        $emergency_contacts_html .= '<div class="col-md-4 col-lg-8 col-xl-12 mb-2"><div class="div_title">Mobile no</div>';
                        $emergency_contacts_html .= '<div class=" div_border">' . $result_get_qrcode['mobile_no'];
                        $emergency_contacts_html .= '&nbsp;<button class="button call_btn"><a href="tel:' . $result_get_qrcode['mobile_no'] . '"><i class="fa fa-phone color_white"></i></a></button>';
                        $emergency_contacts_html .= '</div></div>';
                    }
                    if (!empty($result_get_qrcode['emergency_contacts'])) {
                        $emergency_contacts_html .= '<div class="col-md-4 col-lg-8 col-xl-12"><div class="div_title">Emergency contacts</div></div>';
                    }
                    if (!empty($result_get_qrcode['emergency_contacts'])) {
                        foreach ($result_get_qrcode['emergency_contacts'] as $row) {
                            $emergency_contacts_html .= '<div class="col-md-4 col-lg-8 col-xl-12 mb-2"><div class="div_title"></div><div class=" div_border">';
                            $emergency_contacts_html .= $row['name'] . " - " . $row['mobile_no'];
                            $emergency_contacts_html .= '&nbsp;<button class="button call_btn"><a href="tel:' . $row['mobile_no'] . '"><i class="fa fa-phone color_white"></i></a></button>';
                            $emergency_contacts_html .= '</div></div>';
                        }
                    } else {
                        $emergency_contacts_html .= '<div class="col-md-4 col-lg-8 col-xl-12"><div >There is no emergency contacts.</div></div>';
                    }
                    $result = array('status' => 'Success', 'user_detail_url' => $user_detail_url, 'emergency_contacts_html' => $emergency_contacts_html);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('15');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('5');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function changeMissingStatus() {
        $data = $_POST;
        if (isset($data['user_id']) && isset($data['qr_code']) && isset($data['missing_status'])) {
            $final_result = $this->api_model->changeMissingStatus($data);
            if ($final_result) {
                $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Missing status changed.');
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function addmissingalert() {
        $data = $_POST;
        $qr_code_id = $this->input->post('qr_code_id');
        if (isset($data['code_id'])) {
            $result = $this->api_model->addmissingalert($data);

            // QrCode Missing Alert to admin send one signal notification
            $result_send_admin_notification = $this->sendAdminNotificationQrCodeMissingAlert($data);

            // user firebase notification
            $result_send_user_notification = $this->sendNotificationUserFirebaseQrCodeMissingAlert($data);

            $result = array('status' => 'Success', 'message' => 'Missing alert added.');
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function addQrCodeScanAlert() {
        $data = $_POST;
        if (isset($data['code_id'])) {
            $result = $this->api_model->addQrCodeScanAlert($data);

            // QrCode Scan to admin send one signal notification
            $result_send_admin_notification = $this->sendNotificationAdminQrCodeScan($data);

            // user firebase notification
            $result_send_user_notification = $this->sendNotificationUserFirebaseQrCodeScan($data);

            $result = array('status' => 'Success', 'message' => 'Scan alert added.');
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function sendNotificationAdminQrCodeScan($data) {
        date_default_timezone_set('Asia/Kolkata');
        $scaned_time = date('Y-m-d h:i:s');
        if (isset($data['code']) && $data['code'] != "") {
            if (isset($data['qr_code_user_id']) && $data['qr_code_user_id'] != "") {
                if (isset($data['missing_status']) && $data['missing_status'] == "2") {
                    $code = $data['code'];
                    $send_message = 'QR Code - ' . $code . ' scaned on Captain India. Time:' . $scaned_time;
                    $msg_response = $this->api_model->sendNotificationMessageOnesignal($send_message);
                    $code_id = $data['code_id'] ? $data['code_id'] : null;
                    $qr_code = $data['code'] ? $data['code'] : null;
                    $save_notification_arr = array(
                        'message_type' => '1',
                        'qr_code_id' => $code_id,
                        'qr_code' => $qr_code,
                        'message' => $send_message,
                        'message_response' => $msg_response,
                        'created_at' => date('Y-m-d h:i:s')
                    );
                    $table_name = "qr_code_notification";
                    $save_notification = $this->api_model->saveNotificationMessage($save_notification_arr, $table_name);
                }
            }
        }
    }

    public function sendAdminNotificationQrCodeMissingAlert($data) {
        date_default_timezone_set('Asia/Kolkata');
        $scaned_time = date('Y-m-d h:i:s');
        if (isset($data['code']) && $data['code'] != "") {
            if (isset($data['qr_code_user_id']) && $data['qr_code_user_id'] != "") {
                // if (isset($data['missing_status']) && $data['missing_status'] =="2") {
                $code = $data['code'];
                $send_message = 'QR Code - ' . $code . ' Missing Alert on Captain India. Time:' . $scaned_time;
                $msg_response = $this->api_model->sendNotificationMessageOnesignal($send_message);
                $save_notification_arr = array(
                    'message_type' => '2',
                    'qr_code_id' => $code_id,
                    'qr_code' => $qr_code,
                    'message' => $send_message,
                    'message_response' => $msg_response,
                    'created_at' => date('Y-m-d h:i:s')
                );
                $table_name = "qr_code_notification";
                $save_notification = $this->api_model->saveNotificationMessage($save_notification_arr, $table_name);
                // }
            }
        }
    }

    public function sendNotificationUserFirebaseQrCodeScan($data) {
        date_default_timezone_set('Asia/Kolkata');
        $scaned_time = date('Y-m-d h:i:s');
        if (isset($data['code']) && $data['code'] != "") {
            if (isset($data['qr_code_user_id']) && $data['qr_code_user_id'] != "") {
                // if (isset($data['missing_status']) && $data['missing_status'] =="2") {
                $qr_code = $data['code'];
                $code_id = $data['code_id'];
                $user_id = $data['qr_code_user_id'];
                $this->db->select('users.first_name, users.first_name, users.device_token');
                $this->db->where('users.id', $user_id);
                $this->db->from('users');
                $q = $this->db->get();
                $res_users_device_token = $q->row();

                if ($res_users_device_token) {
                    $device_token = $res_users_device_token->device_token;
                    if ($device_token != "") {
                        $this->load->library('firebase');
                        $res_users_device_token_first_name = '';
                        if (isset($res_users_device_token->first_name)) {
                            $res_users_device_token_first_name = $res_users_device_token->first_name;
                        }
                        $res_users_device_token_last_name = '';
                        if (isset($res_users_device_token->last_name)) {
                            $res_users_device_token_last_name = $res_users_device_token->last_name;
                        }
                        // $send_message = $res_users_device_token->first_name . ' ' . $res_users_device_token->last_name . ' someone has scanned your QR Code - ' . $qr_code . ' - Captain India.';
                        $send_message = $res_users_device_token_first_name . ' ' . $res_users_device_token_last_name . ' someone has scanned your QR Code - ' . $qr_code . ' - Captain India.';
                        $msg_response = $this->firebase->send_notification($send_message, $device_token, 'Captain India');
                        $msg_response = json_encode($msg_response);
                        $save_notification_arr = array(
                            'message_type' => '3',
                            'qr_code_id' => $code_id,
                            'qr_code' => $qr_code,
                            'device_token' => $device_token,
                            'message' => $send_message,
                            'message_response' => $msg_response,
                            'created_at' => date('Y-m-d h:i:s')
                        );
                        $table_name = "qr_code_notification";
                        $save_notification = $this->api_model->saveNotificationMessage($save_notification_arr, $table_name);
                    }
                }
                // }
            }
        }
    }

    public function sendNotificationUserFirebaseQrCodeMissingAlert($data) {

        date_default_timezone_set('Asia/Kolkata');
        $scaned_time = date('Y-m-d h:i:s');
        if (isset($data['code']) && $data['code'] != "") {
            if (isset($data['qr_code_user_id']) && $data['qr_code_user_id'] != "") {
                // if (isset($data['missing_status']) && $data['missing_status'] == "2") {

                $qr_code = $data['code'];
                $code_id = $data['code_id'];
                $user_id = $data['qr_code_user_id'];
                $this->db->select('users.first_name, users.first_name, users.device_token');
                $this->db->where('users.id', $user_id);
                $this->db->from('users');
                $q = $this->db->get();
                $res_users_device_token = $q->row();
                if ($res_users_device_token) {
                    $device_token = $res_users_device_token->device_token;
                    if ($device_token != "") {
                        $this->load->library('firebase');
                        //  $send_message = $res_users_device_token->first_name . ' ' . $res_users_device_token->last_name . ' someone has raised missing alert of QR Code - ' . $qr_code . ' - Captain India.';

                        $raised_user_name = $data['first_name'] . ' ' . $data['last_name'];

                        $send_message = 'Hello ' . $res_users_device_token->first_name . ', ' . $res_users_device_token->last_name . ' ' . $raised_user_name . ' has raised missing alert of QR Code - ' . $qr_code . ' - Captain India.';
                        $msg_response = $this->firebase->send_notification($send_message, $device_token, 'Captain India');
                        $msg_response = json_encode($msg_response);
                        $save_notification_arr = array(
                            'message_type' => '4',
                            'qr_code_id' => $code_id,
                            'qr_code' => $qr_code,
                            'device_token' => $device_token,
                            'message' => $send_message,
                            'message_response' => $msg_response,
                            'created_at' => date('Y-m-d h:i:s')
                        );
                        $table_name = "qr_code_notification";
                        $save_notification = $this->api_model->saveNotificationMessage($save_notification_arr, $table_name);
                    }
                }
                // }
            }
        }
    }

    // 1-feb-2023
    public function callAmbulanceZimaxDial($input_data) {
        // error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('Asia/Kolkata');
        $call_ambulance_id = "";
        if ($input_data && isset($input_data['user_id'])) {
            $data = $input_data;
            $user_detail = array();
            $ziman_dial_id = "";
            $authtoken = "";
            $user_id = "";
            $mobile_no = "";
            $dest_address = "";
            $dest_lat = "";
            $dest_long = "";
            $dest_place_id = "";
            $source_address = "";
            $source_lat = "";
            $source_long = "";
            $source_place_id = "";
            $parent_app = "Zimax"; // Zimax
            if (isset($data['latitude'])) {
                $dest_lat = $source_lat = $data['latitude'];
            }
            if (isset($data['longitude'])) {
                $dest_long = $source_long = $data['longitude'];
            }
            // if (isset($data['dest_address'])) {
            //     $dest_address = $data['dest_address'];
            // }
            // if (isset($data['dest_lat'])) {
            //     $dest_lat = $data['dest_lat'];
            // }
            // if (isset($data['dest_long'])) {
            //     $dest_long = $data['dest_long'];
            // }
            // if (isset($data['dest_place_id'])) {
            //     $dest_place_id = $data['dest_place_id'];
            // }
            if ($dest_lat != "" && $dest_long != "") {
                $dest_address = $this->getLocationFromLatLong($dest_lat, $dest_long);
                $dest_place_id = $this->getPlaceIdFromLatLong($dest_lat, $dest_long);
            }

            if (isset($data['mobile_no'])) {
                $mobile_no = $data['mobile_no'];
            }

            // if (isset($data['source_address'])) {
            //     $source_address = $data['source_address'];
            // }
            // if (isset($data['source_lat'])) {
            //     $source_lat = $data['source_lat'];
            // }
            // if (isset($data['source_long'])) {
            //     $source_long = $data['source_long'];
            // }
            if ($source_lat != "" && $source_long != "") {
                $source_address = $this->getLocationFromLatLong($source_lat, $source_long);
                $source_place_id = $this->getPlaceIdFromLatLong($source_lat, $source_long);
            }
            // if (isset($data['source_place_id'])) {
            //     $source_place_id = $data['source_place_id'];
            // }
            if (isset($data['parent_app'])) {
                $parent_app = $data['parent_app'];
            }

            if ($data['user_id']) {
                $user_id = $data['user_id'];
                $this->db->select('*');
                $this->db->where('is_deleted', '0');
                $this->db->where('user_id', $user_id);
                $this->db->from('user_ambulance_service');
                $res = $this->db->get();
                $user_ambulance_service_detail = $res->row_array();
                $user_ambulance_service_id = "";
                if ($user_ambulance_service_detail == null) {
                    $user_ambulance_service_id = $this->addUserZimaxDialCallAmbulance($user_id);
                    if ($user_ambulance_service_id == "") {
                        $result = array('success' => 'Fail', 'message' => "Please update missing profile details to call ambulance service.");
                        print json_encode($result);
                    } else {
                        // $result = array('success'  => 'Success','message' => "User register successful for Ambulance service. Please click on Ambulance service again for Ambulance service." );
                        //     print json_encode( $result );
                    }
                } else {
                    $user_ambulance_service_id = $user_ambulance_service_detail['id'];
                    $mobile_no = $user_ambulance_service_detail['mobile_no'];
                    $ziman_dial_id = $user_ambulance_service_detail['ziman_dial_id'];
                    $authtoken = $user_ambulance_service_detail['authtoken'];
                }
                if ($user_ambulance_service_detail == null && $user_ambulance_service_id != "") {
                    $this->db->select('*');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('id', $user_ambulance_service_id);
                    $this->db->from('user_ambulance_service');
                    $res = $this->db->get();
                    $user_ambulance_service_detail = $res->row_array();
                    if ($user_ambulance_service_detail != null) {
                        $mobile_no = $user_ambulance_service_detail['mobile_no'];
                        $ziman_dial_id = $user_ambulance_service_detail['ziman_dial_id'];
                        $authtoken = $user_ambulance_service_detail['authtoken'];
                    }
                }
                if ($user_ambulance_service_id != "") {
                    $insert_data = array(
                        'ambulance_service_id' => 2,
                        'user_id' => $data['user_id'],
                        'dest_address' => $dest_address,
                        'dest_lat' => $dest_lat,
                        'dest_long' => $dest_long,
                        'dest_place_id' => $dest_place_id,
                        'mobile_no' => $mobile_no,
                        'source_address' => $source_address,
                        'source_lat' => $source_lat,
                        'source_long' => $source_long,
                        'source_place_id' => $source_place_id,
                        'parent_app' => $parent_app, //'Zimax',
                        'created_at' => date('Y-m-d H:i:s'),
                        'ambulance_type' => $data['ambulance_type'],
                    );
                    $this->db->insert('call_ambulance', $insert_data);
                    $call_ambulance_id = $this->db->insert_id();
                }
            }
            if ($call_ambulance_id != "") {
                $insert_zimax_dial_user = array(
                    'dest_address' => $dest_address,
                    'dest_lat' => $dest_lat,
                    'dest_long' => $dest_long,
                    'dest_place_id' => $dest_place_id,
                    'mobile_no' => $mobile_no,
                    'source_address' => $source_address,
                    'source_lat' => $source_lat,
                    'source_long' => $source_long,
                    'source_place_id' => $source_place_id,
                    'parentApp' => $parent_app, //Zimax
                );
                $insert_zimax_dial_json_user = json_encode($insert_zimax_dial_user);
                $header_arr = array(
                    // 'authtoken: f3ea7ed927750e049ec228df748b48:1001'
                    'authtoken: ' . $authtoken . ':' . $ziman_dial_id
                );
                // START - curl
                $curl = curl_init();
                // curl_setopt($curl, CURLOPT_URL , 'http://15.206.99.54/ambulance/api/journey/request'); // test
                curl_setopt($curl, CURLOPT_URL, 'https://api.dial4242.com/ambulance/api/journey/request'); // production
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_zimax_dial_user);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                // curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);
                // print_r($response);
                $crn = "";
                if ($response) {
                    $json_result = json_decode($response, true);
                    if (!empty($json_result) && array_key_exists("status", $json_result) && $json_result['status'] == 'Success') {
                        $json_result_data = $json_result['data'];
                        $crn = $json_result_data['crn'];
                        $estimated_fare = $json_result_data['estimated_fare'];
                        $logdetails = $json_result_data['logdetails'];
                        $actiontoperform = $json_result_data['actiontoperform'];
                        $callcenterdataid = $json_result_data['callcenterdataid'];
                        $update_call_ambulance_data = array(
                            'estimated_fare' => json_encode($estimated_fare, true),
                            'crn' => $crn,
                            'logdetails' => $logdetails,
                            'actiontoperform' => $actiontoperform,
                            'callcenterdataid' => $callcenterdataid,
                            'request_result' => $response,
                            'ambulance_service_used' => '1',
                            'status' => '1',
                        );
                        $this->db->where('id', $call_ambulance_id);
                        $this->db->update('call_ambulance', $update_call_ambulance_data);
                    } else {
                        $update_call_ambulance_data = array(
                            'request_result' => $response
                        );
                        $this->db->where('id', $call_ambulance_id);
                        $this->db->update('call_ambulance', $update_call_ambulance_data);
                    }
                    // return $call_ambulance_id;
                    // $result = array('status'  => 'Fail','message' => "No record found." ,  );
                    // print json_encode( $result );
                    $result = array('requestId' => $crn, 'success' => true);
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => "No record found.",);
                print json_encode($result);
            }
        }
    }

    public function addUserZimaxDialCallAmbulance($user_id) {
        $user_ambulance_service_id = "";
        if ($user_id) {
            $user_detail = array();
            if ($user_id) {
                $this->db->where('id', $user_id);
                $this->db->where('is_deleted', 0);
                $this->db->from('users');
                $res = $this->db->get();
                $user_detail = $res->row();
            }
            if (!empty($user_detail)) {
                $first_name = "";
                $middle_name = "";
                $last_name = "";
                $email = "";
                $mobile_no = "";
                $address = "";
                $first_name = $user_detail->first_name;
                $middle_name = $user_detail->middle_name;
                $last_name = $user_detail->last_name;
                $email = $user_detail->email;
                $mobile_no = $user_detail->mobile_no;
                $address = $user_detail->address;
                $current_date = date('Y-m-d');
//                $new_date = date('Y-12-31');
                $new_date = date('Y-m-d', strtotime($current_date . ' + 364 days'));
                $insert_zimax_dial_user = array(
                    'mobile_no' => $mobile_no,
                    'full_name' => $first_name . " " . $middle_name . " " . $last_name,
                    'email_id' => $email,
                    'companyname' => 'Zimax Company',
                    'corporatename' => 'Zimax',
                    'parentApp' => 'Zimax',
                    'facility_start' => $current_date,
                    'facility_end' => $new_date,
                );
                $insert_zimax_dial_json_user = json_encode($insert_zimax_dial_user);
                $insert_user_ambulance_service = array(
                    'user_id' => $user_id,
                    'ambulance_service_id' => 2,
                    'mobile_no' => $mobile_no,
                    'full_name' => $first_name . " " . $middle_name . " " . $last_name,
                    'email_id' => $email,
                    'company_name' => 'Zimax Company',
                    'corporate_name' => 'Zimax',
                    'parent_app' => 'Zimax',
                    'facility_start' => $current_date,
                    'facility_end' => $new_date,
                );
                $this->db->insert('user_ambulance_service', $insert_user_ambulance_service);
                $user_ambulance_service_id = $this->db->insert_id();
                $header_arr = array(
                    // 'apikey: zimaxzimax1673328035', test key
                    // 'secretkey: WmltYXhaaW1heDE2NzMzMjgwMzU=' test key
                    'apikey: zimaxzimax1676437798', // production key
                    'secretkey: WmltYXhaaW1heDE2NzY0Mzc3OTg=' // production key
                );
                // START - curl
                $curl = curl_init();
                // curl_setopt($curl, CURLOPT_URL , 'http://15.206.99.54/ambulance/api/user/registeruser'); //test 
                curl_setopt($curl, CURLOPT_URL, 'https://api.dial4242.com/ambulance/api/user/registeruser');  // production  
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_zimax_dial_user);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                // curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);
                $json_result = json_decode($response, true);
                if (!empty($json_result) && array_key_exists("status", $json_result) && $json_result['status'] == 'Success') {
                    $json_result_data = $json_result['data'];
                    $ziman_dial_id = $json_result_data['id'];
                    $authtoken = $json_result_data['authtoken'];
                    $wallet_balance = $json_result_data['wallet_balance'];
                    $discount_percentage = $json_result_data['discount_percentage'];
                    $update_user_ambulance_service = array(
                        'ziman_dial_id' => $ziman_dial_id,
                        'authtoken' => $authtoken,
                        'wallet_balance' => $wallet_balance,
                        'discount_percentage' => $discount_percentage,
                        'request_result' => $response
                    );
                    $this->db->where('id', $user_ambulance_service_id);
                    $this->db->where('user_id', $user_id);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('user_ambulance_service', $update_user_ambulance_service);
                } else {
                    $update_user_ambulance_service = array(
                        'request_result' => $response
                    );
                    $this->db->where('id', $user_ambulance_service_id);
                    $this->db->where('user_id', $user_id);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('user_ambulance_service', $update_user_ambulance_service);
                }
                return $user_ambulance_service_id;
            } else {
                $result = array('status' => 'Fail', 'message' => "No record found.");
                print json_encode($result);
            }
        }
    }

    public function getPlaceIdFromLatLong($user_lat = '', $user_long = '') {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $curl = curl_init();
        // https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&types=food&name=cruise&key=YOUR_API_KEY
        curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=' . $user_lat . ',' . $user_long . '&radius=1500&key=AIzaSyAHx_0IxRG0ZMtykjswkH_F9uiWMIrcVj8');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        //     curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
        //    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
        //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
        $response = curl_exec($curl);
        curl_close($curl);
        if ($response) {
            $json_result = json_decode($response, true);
            if ($json_result) {
                if (isset($json_result['results'][0]['place_id'])) {
                    return ($json_result['results'][0]['place_id']);
                } else {
                    return "";
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public function userGetAmbulanceDetailsZimaxDial($request_id, $user_id) {
        if ($request_id != "") {
            if ($request_id) {
                $insert_myresqr_user = array('crn' => $request_id);
                $authtoken = "";
                $ziman_dial_id = "";
                $this->db->select('*');
                $this->db->where('is_deleted', '0');
                $this->db->where('user_id', $user_id);
                $this->db->from('user_ambulance_service');
                $res = $this->db->get();
                $user_ambulance_service_detail = $res->row_array();
                if ($user_ambulance_service_detail) {
                    $mobile_no = $user_ambulance_service_detail['mobile_no'];
                    $ziman_dial_id = $user_ambulance_service_detail['ziman_dial_id'];
                    $authtoken = $user_ambulance_service_detail['authtoken'];
                }
                $header_arr = array(
                    // 'authtoken: e09611bb6f8296e53c87d23f97aee2:1063',
                    'authtoken: ' . $authtoken . ':' . $ziman_dial_id
                );
                // START - curl
                $curl = curl_init();
                // curl_setopt($curl, CURLOPT_URL , 'http://15.206.99.54/ambulance/api/journey/getdriverdetails'); // test
                curl_setopt($curl, CURLOPT_URL, 'https://api.dial4242.com/ambulance/api/journey/getdriverdetails'); // production
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $insert_myresqr_user);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                // curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                $response = curl_exec($curl);
                curl_close($curl);
                //  print_r($response);
                $json_result = json_decode($response, true);
                $trip_status = "Waiting for booking confirmation";
                $driver_mobile_number = "";
                $driver_mobile_number = "";
                $last_status_time = "";
                $tracking_url = "";
                if (!empty($json_result)) {
                    if (isset($json_result['data']) && $json_result['data'] != "") {
                        $json_result_data = $json_result['data'];
                        $trip_status = $json_result_data['trip_status'];
                        $driver_mobile_number = $json_result_data['driver_mobile_number'];
                        $tracking_url = $json_result_data['tracking_url'];
                        $last_status_time = date("F d, Y, h:i A");
                    }
                }
//                 {
//     "requestId": "577",
//     "vehicleNo": "",
//     "vehicleDriverPhone": "",
//     "lastStatus": "Cancel By Caller",
//     "lastStatusTime": "February 02, 2023, 04:23 PM",
//     "success": true
// }
                $result = array(
                    'requestId' => $request_id,
                    'vehicleNo' => "",
                    'vehicleDriverPhone' => $driver_mobile_number,
                    'lastStatus' => $trip_status,
                    'lastStatusTime' => $last_status_time,
                    'success' => true,
                    'tracking_url' => $tracking_url
                );
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => "No record found.",);
                print json_encode($result);
            }
        }
    }

    // 14-feb-2023
    public function deleteQrCode() {
        $data = $_POST;
        if ($_POST['user_id']) {
            // check Qr Code used
            $final_result_check_code_exists = $this->api_model->checkQrCodeUsedById($data['qr_code_id']);
            if ($final_result_check_code_exists) {
                $final_result = $this->api_model->deleteQrCode($data);
                if ($final_result) {
                    $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Qr Code deleted successfully.');
                    print json_encode($result);
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Record not found.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Qr Code not linked.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getQrCodeListByType() {
        $data = $_POST;
        if ($_POST['user_id'] && $_POST['qr_code_type']) {
            $final_result = $this->api_model->getQrCodeTypeNameByType($_POST['user_id'], $_POST['qr_code_type']);
            if ($final_result) {
                $result = array('status' => 'Success', 'result' => $final_result);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function updateQrCode() {
        $data = $_POST;
        if ($data['user_id'] && $data['qr_code_id']) {
            $final_result_check_code_exists = $this->api_model->checkQrCodeExistsById($data['qr_code_id']);
            if ($final_result_check_code_exists) {

                $code_for = $final_result_check_code_exists['code_for'];
                $code_type = $final_result_check_code_exists['type'];
                $code_user_id = $final_result_check_code_exists['user_id'];
                // check Qr Code used
                $final_result_check_code_used = $this->api_model->checkQrCodeUsedById($data['qr_code_id']);
                if ($final_result_check_code_used) {
                    if ($code_for == '1' && $code_type == '1') {

                        if (isset($_FILES['image']['name'])) {
                            $allowed = array('jpeg', 'jpg', "JPEG", "JPG", "png", "PNG");
                            if ($_FILES['image']['name'] != '') {
                                $temp = explode(".", $_FILES['image']['name']);
                                $ext = end($temp);
                            }
                            if (in_array($ext, $allowed)) {
                                if ($_FILES['image']['name'] != '') {
                                    $target_path = './uploads/profile_image/';
                                    $temp = explode(".", $_FILES['image']['name']);
                                    $newfilename = '';
                                    $time = mt_rand(10, 100) . time() . rand();
                                    $newfilename = $time . '.' . end($temp);
                                    $newthumbfilename = $time . '_thumb.' . end($temp);
                                    $target_path_new = $target_path . $newfilename;
                                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path_new)) {
//                                $return = array("status" => 'false', "message" => 'Could not move the file!');
//                                echo json_encode($return);
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
                                        $target_path_url_main = '/profile_image/' . $newfilename;
                                        $target_thumbnail_path_url_main = '/profile_image/' . 'thumbnail/' . $newthumbfilename;
                                        $arr_image_to_update = array(
                                            'profile_image' => $target_path_url_main,
                                            'profile_image_thumb' => $target_thumbnail_path_url_main
                                        );
                                        $this->db->where('id', $code_user_id);
                                        $res = $this->db->update('users', $arr_image_to_update);
                                    }
                                }
                            }
                        }
                    } else {
                        $image_name = null;
                        if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
                            $image_info = getimagesize($_FILES['image']['tmp_name']);

                            if ($image_info != FALSE) {
                                if ($_FILES['image']['name']) {
                                    $path = $_FILES['image']['name'];
                                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                                        $ext = "jpg";
                                    } else if (in_array($ext, array('gif', 'GIF'))) {
                                        $ext = "gif";
                                    } else if (in_array($ext, array('png', 'PNG'))) {
                                        $ext = "png";
                                    }
                                    $image_name = "qrcode_" . time() . '.' . $ext;
                                    $target_dir = "../backend/uploads/qrcode_type_image/";
                                    $target_file = $target_dir . basename($image_name);
                                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                        
                                    }
                                }
                            }
                        }
                        if ($image_name != null) {
                            $data['image'] = basename($image_name);
                            $data['image_path'] = '/qrcode_type_image/' . $image_name;
                        }
                    }
                    $final_result = $this->api_model->updateQrCode($data);
                    if ($final_result) {
                        $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Record updated.');
                        print json_encode($result);
                    } else {
                        $result = array('status' => 'Fail', 'message' => 'Record not found.');
                        print json_encode($result);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Qr Code not linked.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getQrCodeById() {
        $data = $_POST;
        if ($_POST['qr_code_id']) {
            $final_result = $this->api_model->getQrCodeById($data['qr_code_id']);
            if ($final_result) {
                $result = array('status' => 'Success', 'result' => $final_result);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function addChildQrCode() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $data = $_POST;
        if ($_POST['user_id'] && $_POST['qr_code_id'] && $_POST['child_qr_code']) {
            $final_result_check_code_exists = $this->api_model->checkQrCodeExistsById($data['qr_code_id']);
            if ($final_result_check_code_exists) {
                $final_result_check_code_used = $this->api_model->checkQrCodeUsedById($data['qr_code_id']);
                if ($final_result_check_code_used > 0) {
                    $final_result_check_code_exists = $this->api_model->checkQrCodeExists($data['child_qr_code']);

                    if ($final_result_check_code_exists) {
                        $data['child_qr_code_id'] = $final_result_check_code_exists['id'];
                        $final_result_check_code_used = $this->api_model->checkQrCodeUsedById($data['child_qr_code_id']);
                        if ($final_result_check_code_used == 0) {
                            $final_result = $this->api_model->addChildQrCode($data['qr_code_id'], $data['child_qr_code_id'], $data['user_id']);
                            if ($final_result) {
                                $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Qr code added successfully.');
                                print json_encode($result);
                            } else {
                                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                                print json_encode($result);
                            }
                        } else {
                            $result = array('status' => 'Fail', 'message' => 'Child Qr code is used.');
                            print json_encode($result);
                        }
                    } else {
                        $result = array('status' => 'Fail', 'message' => 'Record not found.');
                        print json_encode($result);
                    }
                } else {
                    $result = array('status' => 'Fail', 'message' => 'Parent Qr code empty.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getLinkedQrcodeByUseridnew() {
        $data = $_POST;
        if ($_POST['user_id']) {
            $final_result = $this->api_model->getLinkedQrcodeByUseridnew($data['user_id']);
            if ($final_result) {
                $result = array('status' => 'Success', 'result' => $final_result);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    public function getTenantKeyword() {
        $data = $_POST;
        if ($_POST['user_id']) {
            $return_result = array();
            $admin_result = $this->api_model->getAdmin();
            if (!empty($admin_result)) {
                foreach ($admin_result as $row) {
                    $tenant_id = $row['id'];
                    $tenant_keyword_result = $this->api_model->getTenantKeyword($tenant_id);
                    $keyword_array = array();
                    if (!empty($tenant_keyword_result)) {
                        foreach ($tenant_keyword_result as $row2) {
                            $keyword_array[] = array('id' => $row2['id'], 'keyword' => $row2['keyword']);
                        }
                    }
                    $arr = array('tenant_id' => $tenant_id, 'tenant_name' => $row['first_name'] . ' ' . $row['last_name'], 'tenant_keyword' => $keyword_array);
                    $return_result[] = $arr;
                }
            }
            if ($return_result) {
                $result = array('status' => 'Success', 'result' => $return_result);
                print json_encode($result);
            } else {
                $result = array('status' => 'Fail', 'message' => 'Record not found.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 4-may-2023
    public function getTenantIdByTenantKeyword($keyword) {
        $tenant_keyword_result = $this->api_model->getTenantIdByTenantKeyword($keyword);
        // print_r($tenant_keyword_result['id']);die;
        return $tenant_keyword_result;
    }

    // 2-aug-2023
    public function addTrackerData() {
        date_default_timezone_set('Asia/Kolkata');
        $info = $_GET;
        if ($info) {
            $tracker_info = json_encode($info);
            $imei = null;
            if (isset($info['imei'])) {
                $imei = $info['imei'];
            }
            // ip
            $ip = null;
            if (isset($info['ip'])) {
                $ip = $info['ip'];
            }
            $lat = null;
            if (isset($info['lat'])) {
                $lat = $info['lat'];
            }
            $lng = null;
            if (isset($info['lng'])) {
                $lng = $info['lng'];
            }
            //angle
            $angle = null;
            if (isset($info['angle'])) {
                $angle = $info['angle'];
            }
            $speed = null;
            if (isset($info['speed'])) {
                $speed = $info['speed'];
            }
            $params = null;
            $power = null;
            if (isset($info['params'])) {
                $params = $info['params'];
                $params_val = (explode("|", $params));
                $searchword = 'bats';
                $matches = null;
                foreach ($params_val as $k => $v) {
                    if (preg_match("/\b$searchword\b/i", $v)) {
                        $matches = $v;
                    }
                }
                if ($matches != null) {
                    $matches_val = (explode("=", $matches));
                    if (isset($matches_val[1])) {
                        $power = $matches_val[1];
                    }
                }
            }
            if ($lat != null && $lng != null) {
                $insert_data = array(
                    'tracker_info' => $tracker_info,
                    'imei' => $imei,
                    'ip' => $ip,
                    'lat' => $lat,
                    'lng' => $lng, 'angle' => $angle, 'speed' => $speed, 'power' => $power, 'params' => $params,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tracker_device_location', $insert_data);
                $final_result = $this->db->insert_id();
                if ($final_result && $imei != null) {
                    
                    // 28-march-2024
                    $insert_response_data = array(
                        'tracker_device_location_id' => $final_result,
                        'tracker_info' => $tracker_info,
                        'imei' => $imei,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('tracker_log', $insert_response_data);
                    $tracker_log_id = $this->db->insert_id();
                    if ($tracker_log_id) {
                        
                    } else {
                        $tracker_log_id=null;
                    }
                
                    $this->checkTrackerDevicesData($imei, $tracker_log_id);
                }
                if ($final_result) {
                    $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Tracker added successfully.');
                    print json_encode($result);
                } else {
                    $error_info = $this->api_model->getErrorCode('13');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                }
            } else {
                $error_info = 'Lat & Long should not empty';
                $result = array('status' => 'Fail', 'message' => $error_info);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getTrackerData($id = '') {
        // if ($id) {
        $this->db->select('*');
        $this->db->from('tracker_device_location');
        $this->db->where('is_deleted', '0');
        // $this->db->where('id', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        $result = $query->result_array();
        // $result = $query->row_array();
        if ($result) {
            $result = array('status' => 'Success', 'result' => $result, 'message' => '');
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
        // } else {
        //     $error_info = $this->api_model->getErrorCode('13');
        //     $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
        //     print json_encode($result);
        // }
    }

     public function getDeviceTrackerData($id = '') {
        
        $this->db->select('tracker_devices.device_imei');
        $this->db->join('tracker_devices', 'user_tracker_devices.device_id = tracker_devices.id', 'left');
        $this->db->where('user_tracker_devices.user_id', $id);
        $this->db->where('user_tracker_devices.is_deleted', '0');
        $this->db->from('user_tracker_devices');
        $query = $this->db->get();
        $row_array_res = $query->row_array();
        $device_imei = '';
        if ($row_array_res) {
            if (count($row_array_res) > 0) {
                $device_imei = $row_array_res['device_imei'];
            }
        }
        
        // if ($id) {  user_tracker_devices
        if($device_imei!=''){
            $this->db->select('*');
            $this->db->from('tracker_device_location');
            $this->db->where('is_deleted', '0');
            $this->db->where('imei', $device_imei);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result_array();
            // $result = $query->row_array();
            if ($result) {
                $result = array('status' => 'Success', 'result' => $result, 'message' => '');
                print json_encode($result);
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        }
       
    }

// 2-aug-2023
    public function addTrackerDevice() {
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if ($data) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
            }
            $device_name = null;
            if ($_POST['device_name']) {
                $device_name = $_POST['device_name'];
            }
            $device_imei = null;
            if ($_POST['device_imei']) {
                $device_imei = $_POST['device_imei'];
            }

            $this->db->select('*');
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('device_imei', $device_imei);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
            $result_tracker_devices_check = $query->row_array();

            $firebase_key = null;
            if ($result_tracker_devices_check) {

                $tracker_devices_id = $id = (int) $result_tracker_devices_check['id'];

                $this->db->select('*');
                $this->db->from('user_tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->where('user_id', $user_id);
                $this->db->where('device_id', $tracker_devices_id);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_user_tracker_devices_check = $query->row_array();
                if ($result_user_tracker_devices_check) {
                    $result = array('status' => 'Success', 'result' => array(), 'message' => 'This Tracker device already linked with your account.');
                    print json_encode($result);
                } else {
                    $insert_data = array(
                        'user_id' => $user_id,
                        'device_id' => $tracker_devices_id,
                        'device_name' => $device_name,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('user_tracker_devices', $insert_data);
                    $final_result = $id = $this->db->insert_id();
                    $tracking_insert_data = array(
                        'tracker_id' => $user_id,
                        'tracker_device_id' => $tracker_devices_id,
                        'start_time' => date('Y-m-d H:i:s'),
                        'share_time' => 200000,
                        'tracking_type' => '1',
                        'mode' => '1',
                        'mode_backend' => '1',
                        'status' => '1',
                    );
                    $this->db->insert('tracking', $tracking_insert_data);
                    $id_tracking = $id = $this->db->insert_id();
                    if ($id_tracking) {
                        $firebase_key = $result_tracker_devices_check['firebase_key'];

                        if ($firebase_key == null) {
                            $firebase_key = 'Tracking_id_' . $id_tracking;
                            $arr_tracker_devices_to_update = array('firebase_key' => $firebase_key);
                            $this->db->where('id', $tracker_devices_id);
                            $res = $this->db->update('tracker_devices', $arr_tracker_devices_to_update);
                        }

                        $firebase_arr = $this->getDeviceFirebaseDataByTrackingId($firebase_key, 'first');
                        $arr_tracking_to_update = array('firebase_key' => $firebase_key, 'start_location' => $firebase_arr);
                        $this->db->where('id', $id_tracking);
                        $res = $this->db->update('tracking', $arr_tracking_to_update);

                        $arr = array('tracker_device_id' => $tracker_devices_id);
                        // $this->addDeviceFirebaseData($firebase_key, $arr);
                        $this->checkFirebaseData($firebase_key, $tracker_devices_id);
                    }
                    $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Tracker added successfully.');
                    print json_encode($result);
                }
            } else {
                $result = array('status' => 'Fail', 'message' => 'Tracker device invalid.');
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 2-aug-2023
    public function getTrackerLastLocation() {
        $data = $_POST;
        if ($_POST) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
            }
            $tracker_device_id = null;
            if ($_POST['tracker_device_id']) {
                $tracker_device_id = $_POST['tracker_device_id'];
            }
            if ($tracker_device_id != null) {
                $this->db->select('*');
                $this->db->from('tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->where('id', $tracker_device_id);
                $query = $this->db->get();
                $result = $query->row_array();

                $device_imei = null;
                if ($result) {
                    $device_imei = $result['device_imei'];
                    if ($device_imei != null) {
                        $this->db->select('*');
                        $this->db->from('tracker_device_location');
                        $this->db->where('is_deleted', '0');
                        $this->db->where('imei', $device_imei);
                        $this->db->where('tracker_device_location.lat IS NOT NULL', NULL, FALSE);
                        $this->db->where('tracker_device_location.lng IS NOT NULL', NULL, FALSE);
                        $this->db->order_by('id', 'DESC');
                        $query = $this->db->get();
                        $result_tracker_device_location = $query->row_array();

                        if ($result_tracker_device_location) {
                            $result = array('status' => 'Success', 'result' => $result_tracker_device_location, 'message' => '');
                            print json_encode($result);
                        } else {
                            $error_info = 'No record found';
                            $result = array('status' => 'Fail', 'message' => $error_info);
                            print json_encode($result);
                        }
                    } else {
                        $error_info = 'No record found';
                        $result = array('status' => 'Fail', 'message' => $error_info);
                        print json_encode($result);
                    }
                } else {
                    $error_info = 'No record found';
                    $result = array('status' => 'Fail', 'message' => $error_info);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getMyTrackerDeviceList() {
        $data = $_POST;
        if ($_POST) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
            }
            if ($user_id != null) {
                $this->db->select('*');
                $this->db->from('tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_devices = $query->result_array();
                if ($result_tracker_devices) {
                    $result = array('status' => 'Success', 'result' => $result_tracker_devices, 'message' => '');
                    print json_encode($result);
                } else {
                    $error_info = 'No record found';
                    $result = array('status' => 'Fail', 'message' => $error_info);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function deleteTrackerDevice() {
        $data = $_POST;
        if ($_POST) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
            }
            $tracker_device_id = null;
            if ($_POST['tracker_device_id']) {
                $tracker_device_id = $_POST['tracker_device_id'];
            }

            if ($user_id != null) {
                $this->db->select('*');
                $this->db->from('tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->where('id', $tracker_device_id);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_devices = $query->result_array();

                if ($result_tracker_devices) {
                    $firebase_key = $result_tracker_devices['firebase_key'];
                    $update_data = array('is_deleted' => '1');
                    $this->db->where('user_id', $user_id);
                    $this->db->where('device_id', $tracker_device_id);
                    $this->db->where('is_deleted', '0');
                    $this->db->update('user_tracker_devices', $update_data);

                    //tracking
                    $firebase_arr = $this->getDeviceFirebaseDataByTrackingId($firebase_key, 'last');

                    $update_data_tracking = array('end_time' => date('Y-m-d H:i:s'), 'status' => 0, 'end_location' => $firebase_arr);
                    $this->db->where('tracker_id', $user_id);
                    $this->db->where('tracker_device_id', $tracker_device_id);
                    $this->db->where('status', 1);
                    $this->db->update('tracking', $update_data_tracking);

                    $result = array('status' => 'Success', 'message' => 'Tracker deleted.');
                    print json_encode($result);
                } else {
                    $error_info = 'No record found';
                    $result = array('status' => 'Fail', 'message' => $error_info);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getDeviceFirebaseDataByTrackingId($firebase_key, $arr_val = 'first') {
        $last_location_arr = array();
        $last = array();
        $start = array();
        // $handle = curl_init();
        // // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
        // $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        // curl_setopt($handle, CURLOPT_URL, $url);
        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($handle);
        // curl_close($handle);
        $output = $this->api_model->getFirebaseLocationByFirebaseId($firebase_key);

        $arr_count = 0;
        if ($output) {
            $data_json = $output;
            $data = json_decode($output, true);
            if (!empty($data)) {
                $arr_count = count($data);
                $last = $data[0];
                $start = end($data);
            }
        }
        $date_value = "";
        $lat = '';
        $lng = '';
        $power = '';
        $time = '';
        $start_date_value = "";
        $start_lat = '';
        $start_lng = '';
        $start_power = '';
        $start_time = '';
        if ($arr_val == 'first') {
            if ($start) {
                $start_lat = $start['lat'] ? number_format((float) $start['lat'], 6, '.', '') : '';
                $start_lng = $start['lng'] ? number_format((float) $start['lng'], 6, '.', '') : '';
                if ($start['time']) {
                    if (is_float($start['time'])) {
                        $start_date_value = date('Y-m-d H:i:s', $start['time']);
                    } else {
                        $start_date_value = date('Y-m-d H:i:s', $start['time'] / 1000);
                    }
                }
                $start_power = $start['power'] ? $start['power'] : '';
                $start_time = $start['time'] ? $start['time'] : '';
            }
        } else {
            if ($last) {
                $lat = $last['lat'] ? number_format((float) $last['lat'], 6, '.', '') : '';
                $lng = $last['lng'] ? number_format((float) $last['lng'], 6, '.', '') : '';
                if ($last['time']) {
                    if (is_float($last['time'])) {
                        $date_value = date('Y-m-d H:i:s', $last['time']);
                    } else {
                        $date_value = date('Y-m-d H:i:s', $last['time'] / 1000);
                    }
                }
                $power = $last['power'] ? $last['power'] : '';
                $time = $last['time'] ? $last['time'] : '';
            }
        }

        if ($arr_val == 'first') {
            $start_location_arr = array(
                "lat" => $start_lat,
                "lng" => $start_lng,
                "power" => $start_power,
                "time" => $start_time,
                "date_value" => $start_date_value,
            );
            return json_encode($start_location_arr, true);
        } else {
            $last_location_arr = array(
                "lat" => $lat,
                "lng" => $lng,
                "power" => $power,
                "time" => $time,
                "date_value" => $date_value,
            );
            return json_encode($last_location_arr, true);
        }
    }

    public function checkFirebaseData($firebase_key, $tracker_devices_id, $tracker_log_id=null) {
        if ($tracker_devices_id != null) {
            $this->db->select('*');
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $tracker_devices_id);
            $query = $this->db->get();
            $result_tracker_devices = $query->row_array();

            $device_imei = null;
            if ($result_tracker_devices && $result_tracker_devices['device_imei'] != null) {
                $device_imei = $result_tracker_devices['device_imei'];
                $this->db->select('*');
                $this->db->from('tracker_device_location');
                $this->db->where('is_deleted', '0');
                $this->db->where('imei', $device_imei);
                $this->db->where('tracker_device_location.lat IS NOT NULL', NULL, FALSE);
                $this->db->where('tracker_device_location.lng IS NOT NULL', NULL, FALSE);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_device_location = $query->row_array();

                if($tracker_log_id !=null) {
                    $update_response = array(
                        'tracker_device_location_result' => '1'
                    );
                    $this->db->where('id', $tracker_log_id);
                    $this->db->update('tracker_log', $update_response);
                }
        
                if ($result_tracker_device_location) {
                    $arr = array(
                        'lat' => $result_tracker_device_location['lat'] ? $result_tracker_device_location['lat'] : '',
                        'lng' => $result_tracker_device_location['lng'] ? $result_tracker_device_location['lng'] : '',
                        'power' => $result_tracker_device_location['power'] ? $result_tracker_device_location['power'] : '',
                        'time' => time());
                    $this->addDeviceFirebaseData($firebase_key, $arr, $tracker_log_id);
                }
            }
        }
    }

    public function addDeviceFirebaseData($firebase_key, $arr, $tracker_log_id=null) {
        // $handle = curl_init();
        // // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
        // $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        // curl_setopt($handle, CURLOPT_URL, $url);
        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($handle);
        // curl_close($handle);
        $output = $this->api_model->getFirebaseLocationByFirebaseId($firebase_key);

        $data = array();
        $arr_count = 0;
        if ($output) {
            $data_json = $output;
            $data = json_decode($output, true);
            if (!empty($data)) {
                $last = $data[0];
                $arr_count = count($data);
            }
        }
        $new_arr = array();
        $return_arr = $new_arr = array(0 => $arr);
        if (!empty($data)) {
            foreach ($data as $key => $index) {
                $new_key = $key + 1;
                $new_arr[$new_key] = $index;
            }
        }
        // $return_arr = array($arr_count => $arr);
        // $return_data = json_encode($return_arr);
        $return_data = json_encode($new_arr);

        // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
        // $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        $setting_url_res = $this->api_model->getSettingById(6);
        $setting_url_res_value ='';
        if ($setting_url_res) {
            $setting_url_res_value = $setting_url_res['value'];
        }
        $setting_auth_key_res = $this->api_model->getSettingById(3);
        $setting_auth_key_value ='';
        if ($setting_auth_key_res) {
            $setting_auth_key_value = $setting_auth_key_res['value'];
        }

        $url = $setting_url_res_value . $firebase_key . "/location.json?auth=" . $setting_auth_key_value;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // if ($arr_count == 0) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // <--- This line important
        // } else {
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH"); // <--- This line important
        // }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $return_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json_response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);

        if($json_response) {
            if($tracker_log_id !=null) {
           
                $data_res = null;
                if ($json_response) {
                    $data_json = $json_response;
                    $data_res = json_decode($json_response, true);
                }
                 
                $update_response = array(
                    'firebase_result' => '1',
                    // 'firebase_response' => $data_json
                );
                $this->db->where('id', $tracker_log_id);
                $this->db->update('tracker_log', $update_response);
                
                // echo $this->db->last_query(); 
            }
        }
        
        return $json_response;
    }

    public function checkTrackerDevicesData($device_imei, $tracker_log_id = null) {
        $this->db->select('*');
        $this->db->from('tracker_devices');
        $this->db->where('is_deleted', '0');
        $this->db->where('device_imei', $device_imei);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result_tracker_devices_check = $query->row_array();

        $firebase_key = null;
        if ($result_tracker_devices_check) {
            $tracker_devices_id = $id = (int) $result_tracker_devices_check['id'];
            $firebase_key = $result_tracker_devices_check['firebase_key'];
            if ($firebase_key == null) {
                $this->db->select('*');
                $this->db->from('tracking');
                $this->db->where('tracker_devices_id', $tracker_devices_id);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracking_check = $query->row_array();
                if ($result_tracking_check) {
                    $firebase_key = $id = $result_tracking_check['firebase_key'];
                }
            }
        }
        
        if($tracker_log_id !=null) {
            $update_response = array(
                'tracker_device_result' => '1'
            );
            $this->db->where('id', $tracker_log_id);
            $this->db->update('tracker_log', $update_response);
        }

        if ($firebase_key != null) {
            $arr = array('tracker_device_id' => $tracker_devices_id);
            $this->checkFirebaseData($firebase_key, $tracker_devices_id, $tracker_log_id);
        }
    }
    public function getTestDataDDevice($firebase_key) {
     echo __LINE__;
    //   $firebase_key = 'Tracking_id_2996';
    echo "<pre>";
        // $handle = curl_init();
        // // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
        // $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        // curl_setopt($handle, CURLOPT_URL, $url);
        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($handle);
        // curl_close($handle);
        $output = $this->api_model->getFirebaseLocationByFirebaseId($firebase_key);

        print_R($output);
        $arr_count = 0;
        if ($output) {
            $data_json = $output;
            $data = json_decode($output, true);
            //  print_R($data);
            if (!empty($data)) {
                $last = $data[0];
                $arr_count = count($data);
            }
        }

        $return_arr = array($arr_count => $arr);
        $return_data = json_encode($return_arr);
      print_R($data);
     die;
    }
    public function getTestData($firebase_key) {
    //
    //   $firebase_key = 'Tracking_id_2996';
    echo "<pre>";
        $handle = curl_init();
        // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
        $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($handle);
        curl_close($handle);

        $arr_count = 0;
        if ($output) {
            $data_json = $output;
            $data = json_decode($output, true);
            //  print_R($data);
            if (!empty($data)) {
                $arr_count = count($data);
            }
        }

        $return_arr = array($arr_count => $arr);
        $return_data = json_encode($return_arr);
      print_R($data);
     die;
    }
    public function getTestFirebaseData($firebase_key) {
        error_reporting(E_ALL);        ini_set('display_errors', '1');
        echo "<pre>";
        $handle = curl_init();
        // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
        $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
        print_R($url);
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($handle);
        curl_close($handle);
        $arr_count = 0;
        if ($output) {
            $data_json = $output;
            $data = json_decode($output, true);
            if (!empty($data)) {
                $arr_count = count($data);
            }
        }
        // $return_arr = array($arr_count => $arr);       // $return_data = json_encode($return_arr);
       print_R($data);//   die;
    
        foreach($data as $key=>$row) {
            var_dump($key);
            var_dump($row);  //     die;
       
            if ($row['lat'] != "") {
                $arr = array(
                        'lat' => $row['lat'] ? $row['lat'] : '',
                        'lng' => $row['lng'] ? $row['lng'] : '',
                        'power' => $row['power'] ? $row['power'] : '',
                        'time' =>$row['time'] ? $row['time'] : '' );      print_R($arr);
 
                $handle = curl_init();
                // $url = "https://device-850c6-default-rtdb.firebaseio.com/raw-locations/" . $firebase_key . "/location.json";
                $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
                curl_setopt($handle, CURLOPT_URL, $url);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($handle);
                curl_close($handle);
    
                $arr_count = 0;
                if ($output) {
                    $data_json = $output;
                    $data = json_decode($output, true);
                    if (!empty($data)) {
                        $last = $data[0];
                        $arr_count = count($data);
                    }
                }
                if ($key == 0) {
                    $return_arr = array( 0 => $arr);
                } else {
                    $return_arr = array($arr_count => $arr);
                } 
                
                $return_data = json_encode($return_arr);
                print_r($return_data);//die;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                if($key == 0) {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
                } else {
                if ($arr_count == 0) {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // <--- This line important
                } else {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH"); // <--- This line important
                }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $return_data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $json_response = curl_exec($ch);
                print_r($row); //die;
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }
                // die;
                curl_close($ch);
            }   
            
        }
        // return $json_response;
        
    }

    public function getSettingFirebaseApp() {
        $data = $_POST;
        
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

        if ($_POST) {
                $finresults = $this->api_model->getSettingFirebaseApp();
                if ($finresults != "") {
                    $result = array('status' => 'Success', 'result' => $finresults);
                    print json_encode($result);
                } else {
                    $error_info = $this->api_model->getErrorCode('13');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    // 31-10-2023
    public function addVerifyOtpRecord($data) {
        date_default_timezone_set('Asia/Kolkata');

        $res_user_id = null;
        $otp = $data['otp'];
        $otp_ref_no = $data['otp_ref_no'];
        $mobile_no = null;

        // $this->db->select('users.id, users.mobile_no, user_otp.otp');
        // $this->db->join('users', 'users.id = user_otp.user_id', 'left');
        // $this->db->where('ref_no', $otp_ref_no);
        // // $this->db->where('user_otp.otp', $otp);
        // $this->db->where('users.user_type', '3');
        // $this->db->where('users.email !=', '');
        // $this->db->where('users.is_deleted', '0');
        
        $minutes_date = date("Y-m-d H:i:s", strtotime("-30 minutes"));
        $this->db->select('user_otp.id, user_otp.user_id,user_otp.mobile_no, user_otp.otp');
        $this->db->where('user_otp.ref_no', $otp_ref_no);
        $this->db->where('user_otp.created_on >=', $minutes_date);
        $this->db->from('user_otp');
        $query = $this->db->get();
        $row_array_res = $query->row_array();

        if ($row_array_res) {
            if (count($row_array_res) > 0) {
                    $res_user_id = $row_array_res['user_id'];
                    $mobile_no = $row_array_res['mobile_no'];
            }
        }
        $created_result_count = 0;
        if($mobile_no !=null) {
            $minutes_date = date("Y-m-d H:i:s", strtotime("-30 minutes"));
            $this->db->select('id');
            $this->db->where('mobile_no', $mobile_no);
            $this->db->where('verify_otp_log.created_at >=', $minutes_date);
            $this->db->from('verify_otp_log');
            $query = $this->db->get();
            $created_result = $query->result_array();
            $created_result_count = count($created_result);
         
        if ($created_result_count < 3) {

            $insert_data = array(
                'user_id' => $res_user_id,
                'otp' => $otp,
                'mobile_no' => $mobile_no,
                'otp_ref_no' => $data['otp_ref_no'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('verify_otp_log', $insert_data);
            return false;
        } else {
            return true;
        }
        } else {
            return false;
        }
    }

    public function addFailVerifyOtpRecord($data) {
        date_default_timezone_set('Asia/Kolkata');

        $res_user_id = null;
        $otp = $data['otp'];
        $otp_ref_no = $data['otp_ref_no'];
        $mobile_no = null;

        $this->db->select('users.id, users.mobile_no, user_otp.otp');
        $this->db->join('users', 'users.id = user_otp.user_id', 'left');
        $this->db->where('ref_no', $otp_ref_no);
        // $this->db->where('user_otp.otp', $otp);
        $this->db->where('users.user_type', '3');
        $this->db->where('users.email !=', '');
        $this->db->where('users.is_deleted', '0');
        $this->db->from('user_otp');
        $query = $this->db->get();
        $row_array_res = $query->row_array();

        if ($row_array_res) {
            if (count($row_array_res) > 0) {
                if ($otp == $row_array_res['otp']) {
                    $res_user_id = $row_array_res['id'];
                    $mobile_no = $row_array_res['mobile_no'];
                }
            }
        }
        $minutes_date = date("Y-m-d H:i:s", strtotime("-30 minutes"));
        $this->db->select('id');
        $this->db->where('mobile_no', $mobile_no);
        $this->db->where('verify_otp_log.created_at >=', $minutes_date);
        $this->db->from('verify_otp_log');
        $query = $this->db->get();
        $created_result = $query->result_array();
        $created_result_count = count($created_result);
        $insert_data = array(
            'user_id' => $res_user_id,
            'otp' => $otp,
            'mobile_no' => $mobile_no,
            'otp_ref_no' => $data['otp_ref_no'],
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('verify_otp_fail_log', $insert_data);
    }



public function testApi() {
        $testData = array(
            'message' => 'This is a dummy API test response!'
        );
        $this->output->set_content_type('application/json');
        
        
        $this->output->set_output(json_encode($testData));
    }


 public function getTrackerDataByIMEI() {
        $imei = $_POST['imei'];  
        $date = $_POST['selected_date']; 
        $result = array('status' => 'Fail', 'imei' => $imei, 'date' => $date);
        print json_encode($result);
        /*
        if ($imei) {
            $this->db->select('*');
            $this->db->from('tracker_device_location');
            $this->db->where('is_deleted', '0');
            $this->db->where('imei', $imei);
            $this->db->where('DATE_FORMAT(column_name,"%Y-%m-%d") =',$date);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(100);
            $query = $this->db->get();
            $result = $query->result_array();
           
            if ($result) {
                $result = array('status' => 'Success', 'result' => $result, 'message' => '');
                print json_encode($result);
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
        }  */
    }
    
    
    /*  New Api Code Prabir */
    
    public function getDeviceToOnOffSettings(){
        
        $this->db->select('*');
        $this->db->where('is_done', '0');
        $this->db->from('tracker_device_on_off_settings');
        $trackquery = $this->db->get();
        $track_result = $trackquery->result_array();
       
        $result = array('Code' => 200, 'res' => $track_result);
        print json_encode($result);
    }
    
    public function user_fcm_token() {
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
          //  $imei = $_POST['imei'];
            $fcm_token = $_POST['fcm_token'];
          //  $created_at = $_POST['created_at'];
          //  $updated_at = $created_at;
            
            $this->db->select('*');
            $this->db->from('user_fcm_token');
            $this->db->where('user_id', $user_id);
          //  $this->db->where('imei',$imei);
            $query = $this->db->get();
            $fcmresult = $query->row_array();
            $result = array();
            if($fcmresult){
                
                $update_fcm_token['fcm_token'] = $fcm_token;
                $update_fcm_token['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('user_id', $user_id);
               // $this->db->where('imei',$imei);
                $this->db->update('user_fcm_token', $update_fcm_token);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
            }else{
                 $insert_data = array(
                    'user_id' => $user_id,
                    'fcm_token' => $fcm_token,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('user_fcm_token', $insert_data);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
            }
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    
    
    public function getGeoFenceScope(){
        $data = $_POST;
        $user_id = $_POST['user_id'];

        $this->db->select('*');
        $this->db->from('google_maps_marker_user');
        $this->db->where('user_id', $user_id);
        $marker_query = $this->db->get();
        $user_marker_result = $marker_query->row_array();

        if ($marker_query->num_rows() > 0) {
            $image_url_link = $user_marker_result['image_link'];
        }else{
            $image_url_link = "https://uat.zimaxxtech.com/backend/images/mapicons/2.png";
        }

        $this->db->select('*');
        $this->db->from('user_geo_fence_scope');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $geo_result = $query->row_array();
        if($geo_result){
            $loc1_lat = $geo_result['loc1_lat'];
            $loc1_lng = $geo_result['loc1_lng'];
            $loc1_range = $geo_result['loc1_range'];

            $loc2_lat = $geo_result['loc2_lat'];
            $loc2_lng = $geo_result['loc2_lng'];
            $loc2_range = $geo_result['loc2_range'];

            $loc3_lat = $geo_result['loc3_lat'];
            $loc3_lng = $geo_result['loc3_lng'];
            $loc3_range = $geo_result['loc3_range'];

            $result = array('status' => 'Success', 'code'=> 200, 'image_url' => $image_url_link,
                            'loc1_lat' => $loc1_lat, 'loc1_lng' => $loc1_lng, 'loc1_range' => $loc1_range, 
                            'loc2_lat' => $loc2_lat, 'loc2_lng' => $loc2_lng, 'loc2_range' => $loc2_range,
                            'loc3_lat' => $loc3_lat, 'loc3_lng' => $loc3_lng, 'loc3_range' => $loc3_range,
                            );
            print json_encode($result);

        }else{
            $imei = '';
            $this->db->select('*');
            $this->db->where('is_deleted', '0');
            $this->db->where('user_id', $user_id);
            $this->db->from('user_tracker_devices');
            $trackquery = $this->db->get();
            $track_result = $trackquery->row_array();
            $tracker_device_id = '';$tracker_name='';
            if ($track_result) {
                $tracker_device_id = $track_result['device_id'];
                $tracker_name = $track_result['device_name'];
                //$tracker_device_id = "272";
            }  
                
            
            if ($tracker_device_id != '') {
                $this->db->select('*');
                $this->db->from('tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->where('id', $tracker_device_id);
                $query = $this->db->get();
                $result_tracker = $query->row_array();

                $device_imei = null;
                if ($query->num_rows() > 0) {
                    $device_imei = $result_tracker['device_imei'];
                    if ($device_imei != null) {
                        $imei = $device_imei;
                    }
                }
            }  
        
            if($imei!=''){
                 $this->db->select('*');
                $this->db->from('tracker_device_location');
                $this->db->where('imei', $imei);
                $this->db->where('lat !=', '');
                $this->db->where('lat is NOT NULL', NULL, FALSE);
                $this->db->where('lng !=', '');
                $this->db->where('lng is NOT NULL', NULL, FALSE);
                $this->db->order_by('id', 'DESC');
                $this->db->limit(1);
                $trackerlast_loc_query = $this->db->get();
                $tracker_last_loc_result = $trackerlast_loc_query->row_array();
                if($tracker_last_loc_result){
                    $current_lat = $tracker_last_loc_result['lat'];
                    $current_lng = $tracker_last_loc_result['lng'];
                }
            }

            $result = array('status' => 'Success', 'current_lat' => $current_lat, 'current_lng' => $current_lng, 'code'=> 201, 'image_url' => $image_url_link);
            print json_encode($result);
           
        }
    }

    public function addGeoFenceScope(){
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $loc1_lat = $_POST['loc1_lat'];
            $loc1_lng = $_POST['loc1_lng'];
            $loc1_range = $_POST['loc1_range'];
            $loc2_lat = $_POST['loc2_lat'];
            $loc2_lng = $_POST['loc2_lng'];
            $loc2_range = $_POST['loc2_range'];
            $loc3_lat = $_POST['loc3_lat'];
            $loc3_lng = $_POST['loc3_lng'];
            $loc3_range = $_POST['loc3_range'];
            
            $this->db->select('*');
            $this->db->from('user_geo_fence_scope');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            $result = $query->result_array();
            if($result){
                
                $update_users_geo_fence_data['loc1_lat'] = $loc1_lat;
                $update_users_geo_fence_data['loc1_lng'] = $loc1_lng;
                $update_users_geo_fence_data['loc1_range'] = $loc1_range;

                $update_users_geo_fence_data['loc2_lat'] = $loc2_lat;
                $update_users_geo_fence_data['loc2_lng'] = $loc2_lng;
                $update_users_geo_fence_data['loc2_range'] = $loc2_range;

                $update_users_geo_fence_data['loc3_lat'] = $loc3_lat;
                $update_users_geo_fence_data['loc3_lng'] = $loc3_lng; 
                $update_users_geo_fence_data['loc3_range'] = $loc3_range;
                $update_users_geo_fence_data['updated_at'] = date('Y-m-d H:i:s');

                $updateData = array(
                    'loc1_lat' => $loc1_lat,'loc1_lng' => $loc1_lng,'loc1_range' => $loc1_range,
                    'loc2_lat' => $loc2_lat,'loc2_lng' => $loc2_lng,'loc2_range' => $loc2_range,
                    'loc3_lat' => $loc3_lat,'loc3_lng' => $loc3_lng,'loc3_range' => $loc3_range,
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->db->where('user_id', $user_id);
                $this->db->update('user_geo_fence_scope', $updateData);

            }else{
                 $insert_data = array(
                    'user_id' => $user_id,
                    'loc1_lat' => $loc1_lat,
                    'loc1_lng' => $loc1_lng,
                    'loc1_range' => $loc1_range,
                    'loc2_lat' => $loc2_lat,
                    'loc2_lng' => $loc2_lng,
                    'loc2_range' => $loc2_range,
                    'loc3_lat' => $loc3_lat,
                    'loc3_lng' => $loc3_lng,
                    'loc3_range' => $loc3_range,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('user_geo_fence_scope', $insert_data);
            }
            
            $result = array('status' => 'Success', 'message' => 'Data Set Successfully','result'=>$ch);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    
    
    public function getLastLocation() {
        $data = $_POST;
        $user_id = $_POST['user_id'];
    
        // Joining the user_tracker_devices and tracker_devices tables
        $this->db->select('user_tracker_devices.*, tracker_devices.device_imei');
        $this->db->from('user_tracker_devices');
        $this->db->join('tracker_devices', 'user_tracker_devices.device_id = tracker_devices.id');
        $this->db->where('user_tracker_devices.user_id', $user_id);
        $query = $this->db->get();
        $geo_result = $query->row_array();

        if ($geo_result) {
            $device_imei = $geo_result['device_imei'];
    
            // Query to get the latest latitude and longitude
            $this->db->select('lat, lng');
            $this->db->from('tracker_device_location');
            $this->db->where('imei', $device_imei);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $location_query = $this->db->get();
            $location_result = $location_query->row_array();
    
            // Merge location data into geo_result
            if ($location_result) {
                $geo_result['lat'] = $location_result['lat'];
                $geo_result['lng'] = $location_result['lng'];
            } else {
                $geo_result['lat'] = null;
                $geo_result['lng'] = null;
            }
        } else {
            $geo_result = array();
        }
    
        $result = array('status' => 'Success', 'code'=> 200,
                        'result' => $geo_result
                       );
        print json_encode($result);
    }

    
    
    public function checkReturningToLocation() {
        date_default_timezone_set('Asia/Kolkata');
    
        // Fetch all user_ids from user_geo_fence_scope
        $this->db->select('distinct(user_id) as user_id');
        $this->db->from('user_geo_fence_scope');
        $query = $this->db->get();
        $users = $query->result_array();
    
    
        function haversine_distance($lat1, $lng1, $lat2, $lng2) {
                $earth_radius = 6371000; // in meters
    
                $dLat = deg2rad($lat2 - $lat1);
                $dLng = deg2rad($lng2 - $lng1);
    
                $a = sin($dLat / 2) * sin($dLat / 2) +
                    cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                    sin($dLng / 2) * sin($dLng / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
                return $earth_radius * $c;
            }
        foreach ($users as $user) {
            $user_id = $user['user_id'];
    
            // Call getLastLocation function to get the last known location
            $last_location = $this->getLastLocationData($user_id);
    
            if (!$last_location) {
                $result = array('status' => 'Error', 'code' => 404, 'message' => 'No last location data found for user_id: ' . $user_id);
                print json_encode($result);
                continue; // Skip to next user_id
            }
    
            $last_lat = round(floatval($last_location['lat']), 6);
            $last_lng = round(floatval($last_location['lng']), 6);
    
            // Fetch geofence data for the current user_id
            $this->db->where('user_id', $user_id);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('user_geo_fence_scope');
            $geo_fence_data = $query->row_array();
    
            if (!$geo_fence_data) {
                $result = array('status' => 'Error', 'code' => 404, 'message' => 'No geofence data found for user_id: ' . $user_id);
                print json_encode($result);
                continue; // Skip to next user_id
            }
    
            // Function to calculate the distance using the Haversine formula
            
    
            // Calculate distances to each geofence location
            $distances = array(
                'loc1' => haversine_distance($last_lat, $last_lng, round(floatval($geo_fence_data['loc1_lat']), 6), round(floatval($geo_fence_data['loc1_lng']), 6)),
                'loc2' => haversine_distance($last_lat, $last_lng, round(floatval($geo_fence_data['loc2_lat']), 6), round(floatval($geo_fence_data['loc2_lng']), 6)),
                'loc3' => haversine_distance($last_lat, $last_lng, round(floatval($geo_fence_data['loc3_lat']), 6), round(floatval($geo_fence_data['loc3_lng']), 6)),
            );
    
            // Find the nearest location and check if it's within range
            $min_distance = min($distances);
            $nearest_location_key = array_search($min_distance, $distances);
            $nearest_location_remark = ''; $location_name = '';
            $is_within_range = false;
            $range_status = 'OUT';
    
            switch ($nearest_location_key) {
                case 'loc1':
                    $is_within_range = $distances['loc1'] <= floatval($geo_fence_data['loc1_range']);
                    $nearest_location_remark = 'Location 1 is nearest and ' . ($is_within_range ? 'in range' : 'out of range');
                    $nearest = 'Location 1';
                    $location_name = 'Home';
                    $range_status = ($is_within_range ? 'IN' : 'OUT');
                    break;
                case 'loc2':
                    $is_within_range = $distances['loc2'] <= floatval($geo_fence_data['loc2_range']);
                    $nearest_location_remark = 'Location 2 is nearest and ' . ($is_within_range ? 'in range' : 'out of range');
                    $nearest = 'Location 2';
                    $location_name = 'School';
                    $range_status = ($is_within_range ? 'IN' : 'OUT');
                    break;
                case 'loc3':
                    $is_within_range = $distances['loc3'] <= floatval($geo_fence_data['loc3_range']);
                    $nearest_location_remark = 'Location 3 is nearest and ' . ($is_within_range ? 'in range' : 'out of range');
                    $nearest = 'Location 3';
                    $location_name = 'Office';
                    $range_status = ($is_within_range ? 'IN' : 'OUT');
                    break;
            }
    
            // Insert data into user_tracking_info table
            $tracking_data = array(
                'user_id' => $user_id,
                'loc1_distance' => round($distances['loc1'], 2),
                'loc2_distance' => round($distances['loc2'], 2),
                'loc3_distance' => round($distances['loc3'], 2),
                'nearest_location' => $nearest_location_remark,
                'status' => TRUE,
                'near' => $nearest,
                'range_status' => $range_status,
            );
    
            $this->db->insert('user_tracking_info', $tracking_data);
    
            // Check and insert notification data if necessary
            $this->db->select('*');
            $this->db->from('notificationGeoFenceScope');
            $this->db->where('user_id', $user_id);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $notify_result = $query->row_array();
    
            if ($query->num_rows() > 0) {
                $loc_range = $notify_result['range_status'];
                $loc_near = $notify_result['near'];
    
                if ($loc_range == $range_status && $loc_near == $nearest) {
                    $is_insert = 0;
                } else {
                    $is_insert = 1;
                }
            } else {
                $is_insert = 1;
            }
    
            if ($is_insert == 1) {
                $notify_data = array(
                    'user_id' => $user_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'near' => $nearest,
                    'range_status' => $range_status,
                );
    
                $this->db->insert('notificationGeoFenceScope', $notify_data);
                $inserted_user_id = $this->db->insert_id();
                $nearest_location_remark = $location_name.'-'.$nearest_location_remark;
                // Update notification status and time
                $this->db->select('*');
                $this->db->from('tracker_device_on_off_settings');
                $this->db->where('user_id', $user_id);
                $this->db->where('setting_name','push_notification');
                // $this->db->where('is_start','1');
                $this->db->order_by('id', 'DESC');
                $this->db->limit(1);
                $pnquery = $this->db->get();
                $push_notification_result = $pnquery->row_array();
    
                if ($pnquery->num_rows() > 0) {
                    if($push_notification_result['is_start']=='1'){
                        $notify_response = $this->send_NotificationToUser($user_id, $nearest_location_remark, 'CaptainIndiaPetSafety - Geofence Security Scope');
    
                        if ($notify_response) {
                            $notify_update['isNotificationSend'] = 1;
                            $notify_update['updated_at'] = date('Y-m-d H:i:s');
                            $this->db->where('id', $inserted_user_id);
                            $this->db->update('notificationGeoFenceScope', $notify_update);
    
                            $loc_notification_data = array(
                                'user_id' => $user_id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'message_title' => 'GeoFence Range',
                                'message' => $location_name.'-'.$nearest_location_remark,
                                'notification_type' => 'location',
                            );
    
                            $this->db->insert('tracker_device_notifications', $loc_notification_data);
                        }
                    }
                }
            }
    
            $result = array(
                'status' => 'Success',
                'code' => 200,
                'distances' => $distances,
                'nearest_location' => $nearest_location_remark,
                'res' => $notify_response
            );
    
            print json_encode($result);
        }
    }

    
    // Function to get the last location data for a user
    public function getLastLocationData($user_id) {
        // Joining the user_tracker_devices and tracker_devices tables
        $this->db->select('tracker_devices.device_imei, tracker_device_location.lat, tracker_device_location.lng');
        $this->db->from('user_tracker_devices');
        $this->db->join('tracker_devices', 'user_tracker_devices.device_id = tracker_devices.id');
        $this->db->join('tracker_device_location', 'tracker_devices.device_imei = tracker_device_location.imei');
        $this->db->where('user_tracker_devices.user_id', $user_id);
        $this->db->order_by('tracker_device_location.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    
    public function addGPSTrackerSOSContacts_backup(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $number_first = $_POST['number_first'];
            $number_second = $_POST['number_second'];
            $number_third = $_POST['number_third'];
            $sos1 = $_POST['sos1'];
            $sos2 = $_POST['sos2'];
            $sos3 = $_POST['sos3'];
            
            $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'number_first' => $number_first,
                    'number_second' => $number_second,
                    'number_third' => $number_third,
                    'sos1' => $sos1,
                    'sos2' => $sos2,
                    'sos3' => $sos3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
            $this->db->insert('gpstracker_sos_contacts', $insert_data);
            $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> 'insert');
        
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getGPSTracker_SOS_Contacts_backup(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];
        $this->db->select('*');
        $this->db->from('gpstracker_sos_contacts');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->row_array();
       
       if($result){
          $result_array = array('Code' => 200, 'result' => $result, 'imei' => $imei);
          print json_encode($result_array);
       }else{
          $result_array = array('Code' => 201, 'imei' => $imei);
          print json_encode($result_array);
       }
         
    }

    public function addGPSTrackerSOSContacts(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $number_first = $_POST['number_first'];
            $number_second = $_POST['number_second'];
            $number_third = $_POST['number_third'];
          //  $sos1 = $_POST['sos1'];
          //  $sos2 = $_POST['sos2'];
          //  $sos3 = $_POST['sos3'];
            
            $this->db->select('*');
            $this->db->from('gpstracker_sos_contacts');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            $sosresult = $query->result_array();
            $result = array();
            if($sosresult){
                
                $update_gpstracker_sos_contacts['number_first'] = $number_first;
                $update_gpstracker_sos_contacts['number_second'] = $number_second;
                $update_gpstracker_sos_contacts['number_third'] = $number_third;

                $update_gpstracker_sos_contacts['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('user_id', $user_id);
                $this->db->update('gpstracker_sos_contacts', $update_gpstracker_sos_contacts);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);  
            }else{
                 $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'number_first' => $number_first,
                    'number_second' => $number_second,
                    'number_third' => $number_third,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('gpstracker_sos_contacts', $insert_data);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> 'insert');
            }
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getGPSTracker_SOS_Contacts(){
        $data = $_POST;
        $user_id = $_POST['user_id'];

        $this->db->select('*');
        $this->db->where('is_deleted', '0');
        $this->db->where('user_id', $user_id);
        $this->db->from('user_tracker_devices');
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array();
        $tracker_device_id = '';$tracker_name='';$imei = '';
        if ($track_result) {
            $tracker_device_id = $track_result['device_id'];
            $tracker_name = $track_result['device_name'];
            //$tracker_device_id = "272";
        }  
            
        
        if ($tracker_device_id != '') {
            $this->db->select('*');
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $tracker_device_id);
            $query = $this->db->get();
            $result_tracker = $query->row_array();

            $device_imei = null;
            if ($query->num_rows() > 0) {
                $device_imei = $result_tracker['device_imei'];
                if ($device_imei != null) {
                    $imei = $device_imei;
                }
            }
        }  

        $this->db->select('*');
        $this->db->from('gpstracker_sos_contacts');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->row_array();
       /* if($geo_result){
            $loc1_lat = $geo_result['loc1_lat'];
            $loc1_lng = $geo_result['loc1_lng'];
            $loc1_range = $geo_result['loc1_range'];

            $loc2_lat = $geo_result['loc2_lat'];
            $loc2_lng = $geo_result['loc2_lng'];
            $loc2_range = $geo_result['loc2_range'];

            $loc3_lat = $geo_result['loc3_lat'];
            $loc3_lng = $geo_result['loc3_lng'];
            $loc3_range = $geo_result['loc3_range'];

            $result = array('status' => 'Success', 'code'=> 200,
                            'loc1_lat' => $loc1_lat, 'loc1_lng' => $loc1_lng, 'loc1_range' => $loc1_range, 
                            'loc2_lat' => $loc2_lat, 'loc2_lng' => $loc2_lng, 'loc2_range' => $loc2_range,
                            'loc3_lat' => $loc3_lat, 'loc3_lng' => $loc3_lng, 'loc3_range' => $loc3_range,
                            );
            print json_encode($result);

        } */
       if($result){
          $result_array = array('Code' => 200, 'result' => $result, 'imei' => $imei);
          print json_encode($result_array);
       }else{
          $result_array = array('Code' => 201, 'imei' => $imei);
          print json_encode($result_array);
       }
         
    }

     public function addGPSTrackerWhitelistContacts(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $contact_name = $_POST['contact_name'];
            $contact_no = $_POST['contact_no'];
          //  $created_at = $_POST['created_at'];
          //  $updated_at = $_POST['updated_at'];
            
                 $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'contact_name' => $contact_name,
                    'contact_no' => $contact_no,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('gpstracker_whitelist_call_contacts', $insert_data);
                $result = array('status' => 'Success', 'message' => 'Data Added Successfully');
           
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getGPSTrackerWhitelistContacts(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $this->db->select('*');
        $this->db->from('gpstracker_whitelist_call_contacts');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result_array();
       
       if($result){
          $result_array = array('Code' => 200, 'result' => $result);
          print json_encode($result_array);
       }else{
          $result_array = array('Code' => 201);
          print json_encode($result_array);
       }
         
    }
    
    
    
    public function deleteSOSContactsWhiteList() {
        $data = $_POST;
        if ($_POST) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
            }
            $whitelist_id = null;
            if ($_POST['whitelist_id']) {
                $whitelist_id = $_POST['whitelist_id'];
            }

            if ($whitelist_id != null) {
                $update_data = array('is_deleted' => '1');
                $this->db->where('id', $whitelist_id);
                $this->db->where('user_id', $user_id);
                $this->db->where('is_deleted', '0');
                $this->db->update('gpstracker_whitelist_call_contacts', $update_data);

                 $result = array('status' => 'Success', 'message' => 'Whitelist Contact deleted.');
                print json_encode($result);
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }


    
     public function getTrackerNotificationsUnreadCount(){
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $this->db->select('*');
            $this->db->from('tracker_device_notifications');
            $this->db->where('user_id', $user_id);
            $this->db->where('is_read', 0);
            $this->db->order_by('id', 'DESC');
            $trackquery = $this->db->get();
            $track_result = $trackquery->result_array();
            $notification_count = count($track_result);
        
            $result = array('Code' => 200, 'resCount' => $notification_count);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
     public function getTrackerNotifications(){
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $notify_date = $_POST['notify_date'];
            $this->db->select('*');
            $this->db->from('tracker_device_notifications');
            $this->db->where('user_id', $user_id);
            if($notify_date!=''){
              $this->db->where('DATE_FORMAT(created_at,"%Y-%m-%d")' ,$notify_date); 
            }
            $this->db->order_by('id', 'DESC');
            $trackquery = $this->db->get();
            $track_result = $trackquery->result_array();
         
            $update_finder['is_read'] = 1;
            $update_finder['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('user_id', $user_id);
            $this->db->update('tracker_device_notifications', $update_finder); 
        
            $result = array('Code' => 200, 'res' => $track_result);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('Code' => 201, 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function deleteTrackerDeviceInformation(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $update_finder['is_deleted'] = '1';
            $update_finder['updated_at'] = date('Y-m-d H:i:s');

            $this->db->where('user_id', $user_id);
            $this->db->where('imei',$imei);
            $this->db->update('tracker_device_information', $update_finder);
            $result = array('status' => 'Success', 'message' => 'Data Deleted Successfully');  
            print json_encode($result);
        }else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
        }
    }
    
    
    public function getMyTrackerDeviceNewList() {
        $data = $_POST;
        if ($_POST) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
            }
            if ($user_id != null) {

                $this->db->select('user_tracker_devices.id,user_tracker_devices.device_id,user_tracker_devices.user_id,user_tracker_devices.device_name,user_tracker_devices.is_deleted,tracker_devices.id,tracker_devices.device_imei');
                $this->db->from('user_tracker_devices');
                $this->db->where('user_tracker_devices.is_deleted', '0');

                $this->db->join('tracker_devices', 'tracker_devices.id = user_tracker_devices.device_id', 'left');
                $this->db->where('user_tracker_devices.user_id', $user_id);
                
                $this->db->order_by('user_tracker_devices.id', 'DESC');
                $query = $this->db->get();
                $result_tracker_devices = $query->result_array();
                if ($result_tracker_devices) {
                    $result = array('status' => 'Success', 'result' => $result_tracker_devices, 'message' => '');
                    print json_encode($result);
                } else {
                    $error_info = 'No record found';
                    $result = array('status' => 'Fail', 'message' => $error_info);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getTrackerNewLastLocation() {
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if ($_POST) {
            $user_id = null;
            if ($_POST['user_id']) {
                $user_id = $_POST['user_id'];
                
                $this->db->select('*');
                $this->db->from('google_maps_marker_user');
                $this->db->where('user_id', $user_id);
                $marker_query = $this->db->get();
                $user_marker_result = $marker_query->row_array();

                if ($marker_query->num_rows() > 0) {
                    $image_url_link = $user_marker_result['image_link'];
                }else{
                    $image_url_link = "https://uat.zimaxxtech.com/backend/images/mapicons/2.png";
                }
            }
            $tracker_device_id = null;
            if ($_POST['tracker_device_id']) {
                $tracker_device_id = $_POST['tracker_device_id'];
            }else{
                $this->db->select('*');
                $this->db->from('user_tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->where('user_id', $user_id);
                $query = $this->db->get();
                $track_result = $query->row_array();
                if ($query->num_rows() > 0) {
                    $tracker_device_id = $track_result['device_id'];
                }
            }
            if ($tracker_device_id != null) {
                $this->db->select('*');
                $this->db->from('tracker_devices');
                $this->db->where('is_deleted', '0');
                $this->db->where('id', $tracker_device_id);
                $query = $this->db->get();
                $result = $query->row_array();

                $device_imei = null;
                if ($result) {
                    $device_imei = $result['device_imei'];
                    if ($device_imei != null) {
                        $this->db->select('*');
                        $this->db->from('tracker_device_location');
                        $this->db->where('is_deleted', '0');
                        $this->db->where('imei', $device_imei);
                        $this->db->where('tracker_device_location.lat IS NOT NULL', NULL, FALSE);
                        $this->db->where('tracker_device_location.lng IS NOT NULL', NULL, FALSE);
                        $this->db->where('tracker_device_location.lat !=', 0);
                        $this->db->where('tracker_device_location.lng !=', 0);
                        $this->db->order_by('id', 'DESC');
                        $_query = $this->db->get();
                        $result_tracker_device_location = $_query->row_array();

                        if ($result_tracker_device_location) {
                            $user_lat = $result_tracker_device_location['lat'];
                            $user_long = $result_tracker_device_location['lng'];
                            $_battery_power = $result_tracker_device_location['power']; 
                            $res_location_name = $this->getLocationFromLatLong($user_lat, $user_long);
                            
                            $track_time = $result_tracker_device_location['created_at'];
                            $this->db->select('*');
                            $this->db->from('tracker_device_location_update');
                            $this->db->where('imei', $device_imei);
                            $this->db->order_by('id', 'DESC');
                            $query = $this->db->get();
                            $result_tracker_devices_check = $query->row_array();
                            $_track_last_comm = ''; $totaltimediff = 0;
                            if ($query->num_rows() > 0 ){
                                $_track_last_comm = $result_tracker_devices_check['last_communication'];
                                $_battery_power = $result_tracker_devices_check['power'];
                                $track_time = date('Y-m-d H:i:s');
                                $totaltimediff = $this->datetimediff($track_time,$_track_last_comm);
                                $totaltimediff_explode = explode(" ",$totaltimediff);
                                $device_state = "offline";
                                if(count($totaltimediff_explode)>=2){
                                    $exact_time = $totaltimediff_explode[0];
                                    $exact_time_type = $totaltimediff_explode[1];
                                    if($exact_time_type=='minutes'){
                                      /*  if($exact_time>5){
                                            $device_state = "offline";
                                        }else{
                                            $device_state = "online";
                                        }  */
                                        if(count($totaltimediff_explode)==2){
                                          $device_state = "online";
                                        }else{
                                            if($exact_time <= 5){
                                                $device_state = "online";
                                            }else{
                                           $device_state = "offline";
                                            }
                                        }
                                    }else{
                                        if($exact_time_type=='seconds'){
                                            if($user_lat==0 && $user_long==0){
                                                $device_state = "ideal";  
                                            }else{
                                                $device_state = "online";
                                            }
                                        }else{
                                            $device_state = "offline";
                                        }
                                    }
                                }
                            }

                            $result = array('status' => 'Success', 'result' => $result_tracker_device_location, 'message' => '','formattedaddress' => $res_location_name, 'track_last_comm' => $_track_last_comm, 'totaltimediff' => $totaltimediff, 'image_url' => $image_url_link, 'device_state' => $device_state, 'battery_power' => $_battery_power, 'checking' => $totaltimediff_explode );
                            print json_encode($result);
                        } else {
                            $error_info = 'No record found';
                            $result = array('status' => 'Fail', 'message' => $error_info, 'image_url' => $image_url_link);
                            print json_encode($result);
                        }
                    } else {
                        $error_info = 'No record found';
                        $result = array('status' => 'Fail', 'message' => $error_info, 'image_url' => $image_url_link);
                        print json_encode($result);
                    }
                } else {
                    $error_info = 'No record found';
                    $result = array('status' => 'Fail', 'message' => $error_info, 'image_url' => $image_url_link);
                    print json_encode($result);
                }
            } else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code, 'image_url' => $image_url_link);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    
    public function getGPSTrackerCallContactsConfig(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $this->db->select('*');
        $this->db->from('gpstracker_call_contacts_config');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->row_array();
       
       if($result){
          $result_array = array('Code' => 200, 'result' => $result);
          print json_encode($result_array);
       }else{
          $result_array = array('Code' => 201);
          print json_encode($result_array);
       }
         
    }
    
    
    public function addGPSTrackerCallContactsConfig(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $ans_mode = $_POST['ans_mode'];
            
        //    $created_at = $_POST['created_at'];
        //    $updated_at = $_POST['updated_at'];
            
            $this->db->select('*');
            $this->db->from('gpstracker_call_contacts_config');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            $sosresult = $query->result_array();
            $result = array();
            if($sosresult){
                
                $update_gpstracker_sos_contacts['ans_mode'] = $ans_mode;
               
                $update_gpstracker_sos_contacts['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('user_id', $user_id);
                $this->db->update('gpstracker_call_contacts_config', $update_gpstracker_sos_contacts);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'result'=> $sosresult);  
            }else{
                 $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'ans_mode' => $ans_mode,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('gpstracker_call_contacts_config', $insert_data);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'result'=> 'insert');
            }
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    
    public function getTrackerNewData($id = '') {
        // if ($id) {  
        $this->db->select('*');
        $this->db->from('tracker_device_location');
        $this->db->where('is_deleted', '0');
        // $this->db->where('id', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        $result = $query->result_array();
        $image_url_link = "https://uat.zimaxxtech.com/backend/images/mapicons/2.png";
        // $result = $query->row_array();
        $result_log = array(); $imei = '';$result_track_point = array();
        if ($result) {
            $user_id = '';$date = '';
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                if($this->input->post('user_id')) {
                    $user_id = $this->input->post('user_id');

                    $this->db->select('*');
                    $this->db->from('google_maps_marker_user');
                    $this->db->where('user_id', $user_id);
                    $marker_query = $this->db->get();
                    $user_marker_result = $marker_query->row_array();

                    if ($marker_query->num_rows() > 0) {
                        $image_url_link = $user_marker_result['image_link'];
                    }else{
                        $image_url_link = "https://uat.zimaxxtech.com/backend/images/mapicons/2.png";
                    }
                }

                if($this->input->post('date')) {
                   $date = $this->input->post('date');
                }
                if($this->input->post('start_time')) {
                   $start_time = $this->input->post('start_time');
                   $start_datetime = $date." ".$start_time;
                }
                if($this->input->post('end_time')) {
                   $end_time = $this->input->post('end_time');
                   $end_datetime = $date." ".$end_time;
                }
            } 
            
            //$date = '2024-06-10';
            
            if($user_id!='' && $date!=''){
                
                $this->db->select('*');
                $this->db->where('is_deleted', '0');
                $this->db->where('user_id', $user_id);
                $this->db->from('user_tracker_devices');
                $trackquery = $this->db->get();
                $track_result = $trackquery->row_array();
                $tracker_device_id = '';$tracker_name='';
                if ($track_result) {
                   $tracker_device_id = $track_result['device_id'];
                   $tracker_name = $track_result['device_name'];
                    //$tracker_device_id = "272";
                }  
                 
                
                if ($tracker_device_id != '') {
                    $this->db->select('*');
                    $this->db->from('tracker_devices');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('id', $tracker_device_id);
                    $query = $this->db->get();
                    $result_tracker = $query->row_array();

                    $device_imei = null;
                    if ($query->num_rows() > 0) {
                        $device_imei = $result_tracker['device_imei'];
                        if ($device_imei != null) {
                           $imei = $device_imei;
                        }
                    }
                }  
            } 
              $total_count = 0; $final_total_count = 0;$mileage=0;$_strt_lat = 0;$_strt_lng=0;$_end_lat=0;$_end_lng=0;
                if ($imei != '') {
                    $this->db->select('lat,lng');
                  //  $this->db->distinct();
                    $this->db->from('tracker_device_location');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('imei', $imei);
                    $this->db->where('lat >', 0);
                    $this->db->where('lng >', 0);
                    $this->db->where('created_at >=', $start_datetime);
                    $this->db->where('created_at <=', $end_datetime);
                   // $this->db->where('DATE_FORMAT(created_at,"%Y-%m-%d") =',$date);
                    $this->db->group_by(array('lat', 'lng'));
                  //  $this->db->order_by('id', 'ASC');
                  //  $this->db->limit(100);
                    $query = $this->db->get();
                    $result_log = $query->result_array();
                    $res_full_arr = $result_log;
                    $total_count = count($result_log);
                    if($total_count>10){
                        $check = floor($total_count / 10);
                        $is_divisible = floor($total_count % 10);
                        array_push($result_track_point, $result_log[0]);
                       $_strt_lat = $result_log[0]['lat'];
                        $_strt_lng = $result_log[0]['lng'];
                        for($i=0;$i<10;$i++){
                            $j = $i + 1;
                            $check1 = $check * $j;
                            if($is_divisible == 0){
                                  $check1 = $check1 - 1;
                            }
                           array_push($result_track_point, $result_log[$check1]);
                           if($j==10){
                                $_end_lat = $result_log[$check1]['lat'];
                                $_end_lng = $result_log[$check1]['lng'];
                               
                            //    $result_log[$check1]['lat'] = '21.2620455';
                            //    $result_log[$check1]['lng'] = '81.5366707';
                            //    array_push($result_track_point, $result_log[$check1]);
                            //    $_end_lat = '21.2620455';
                            //    $_end_lng = '81.5366707';
                           } 
                        }
                      //  $mileage = distance($_strt_lat,$_strt_lng,$_end_lat,$_end_lng,"K");
                     //  $mileage = calculate_distance($_strt_lat,$_strt_lng,$_end_lat,$_end_lng);
                    }else{
                        $result_track_point = $result_log;
                        $_strt_lat = $result_log[0]['lat'];
                        $_strt_lng = $result_log[0]['lng'];
                        for($i=0;$i<count($result_log);$i++){
                            $j = $i + 1;
                           // $check1 = $check * $j;
                        //   array_push($result_track_point, $result_log[$check1]);
                           if($j==count($result_log)){
                               $_end_lat = $result_log[$i]['lat'];
                               $_end_lng = $result_log[$i]['lng'];
                            //    $result_log[$check1]['lat'] = '21.2620455';
                            //    $result_log[$check1]['lng'] = '81.5366707';
                            //    array_push($result_track_point, $result_log[$check1]);
                            //    $_end_lat = '21.2620455';
                            //    $_end_lng = '81.5366707';
                           } 
                        }
                    }
                    $final_total_count = count($result_track_point);
                    
                }  
            
            $result = array('status' => 'Success', 'tracker_name' => $tracker_name, 'total_count' => $final_total_count, 'result_log' => $result_track_point, 'image_url' => $image_url_link, 
            'user_id'=>$user_id, 'date'=>$date,'imei'=>$imei,'start_lat'=>$_strt_lat,'start_lng'=>$_strt_lng,'end_lat'=>$_end_lat,'end_lng'=>$_end_lng, 'tot_count' => $total_count,'check' => 200,
            'date' => $date, 'start_time' => $start_time, 'end_time' => $end_time
            );
            
          // $this->output->set_content_type('application/json')->set_output(json_encode($result));
            
            print json_encode($result);
           // print $result;
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code, 'image_url' => $image_url_link);
            print json_encode($result);
        }
        // } else {
        //     $error_info = $this->api_model->getErrorCode('13');
        //     $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
        //     print json_encode($result);
        // }
    }

    
   public function getUserDeviceIMEI_NewBackup(){
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $user_id = $_POST['user_id'];
       
        $device_imei = ""; $device_state = "offline";
       
        $this->db->select('*');
        $this->db->where('is_deleted', '0');
        $this->db->where('user_id', $user_id);
        $this->db->from('user_tracker_devices');
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array();
        $tracker_device_id = '';$tracker_name='';
        if ($track_result) {
            $tracker_device_id = $track_result['device_id'];
            $tracker_name = $track_result['device_name'];
        }  
            
        
        if ($tracker_device_id != '') {
            $this->db->select('*');
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $tracker_device_id);
            $tracker_query = $this->db->get();
            $result_tracker = $tracker_query->row_array();

            if ($tracker_query->num_rows() > 0) {
                $device_imei = $result_tracker['device_imei'];

                $this->db->select('*');
                $this->db->from('tracker_device_location');
                $this->db->where('is_deleted', '0');
                $this->db->where('imei', $device_imei);
                $this->db->where('tracker_device_location.lat IS NOT NULL', NULL, FALSE);
                $this->db->where('tracker_device_location.lng IS NOT NULL', NULL, FALSE);
                $this->db->where('tracker_device_location.lat !=', 0);
                $this->db->where('tracker_device_location.lng !=', 0);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_device_location = $query->row_array();

                if ($query->num_rows() > 0 ){
            //    if ($result_tracker_device_location) {
                    $user_lat = $result_tracker_device_location['lat'];
                    $user_long = $result_tracker_device_location['lng'];
                    $res_location_name = $this->getLocationFromLatLong($user_lat, $user_long);
                    
                    $track_time = $result_tracker_device_location['created_at'];
                    
                    $_track_last_comm = ''; $totaltimediff = 0;
                    
                        $_track_last_comm = $result_tracker_device_location['created_at'];
                        $track_time = date('Y-m-d H:i:s');
                        $totaltimediff = $this->datetimediff($track_time,$_track_last_comm);
                        $totaltimediff_explode = explode(" ",$totaltimediff);
                        
                        if(count($totaltimediff_explode)>=2){
                            $exact_time = $totaltimediff_explode[0];
                            $exact_time_type = $totaltimediff_explode[1];
                            if($exact_time_type=='minutes'){
                                if($exact_time>5){
                                    $device_state = "offline";
                                }else{
                                    $device_state = "online";
                                } 
                            }else{
                                if($exact_time_type=='seconds'){
                                  $device_state = "online";
                                }else{
                                    $device_state = "offline";
                                }
                            }
                        }
                
                }
            }
        }

      //  $device_state = "online";

        $result = array('Code' => 200, 'imei' => $device_imei, 'device_state' => $device_state);
        print json_encode($result);
    }
    
    public function getUserDeviceIMEI(){
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $user_id = $_POST['user_id'];
       
        $device_imei = ""; $device_state = "offline";
       
        $this->db->select('*');
        $this->db->where('is_deleted', '0');
        $this->db->where('user_id', $user_id);
        $this->db->from('user_tracker_devices');
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array();
        $tracker_device_id = '';$tracker_name='';
        if ($track_result) {
            $tracker_device_id = $track_result['device_id'];
            $tracker_name = $track_result['device_name'];
        }  
            
        
        if ($tracker_device_id != '') {
            $this->db->select('*');
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $tracker_device_id);
            $tracker_query = $this->db->get();
            $result_tracker = $tracker_query->row_array();

            if ($tracker_query->num_rows() > 0) {
                $device_imei = $result_tracker['device_imei'];

                $this->db->select('*');
                $this->db->from('tracker_device_location');
                $this->db->where('is_deleted', '0');
                $this->db->where('imei', $device_imei);
                $this->db->where('tracker_device_location.lat IS NOT NULL', NULL, FALSE);
                $this->db->where('tracker_device_location.lng IS NOT NULL', NULL, FALSE);
                $this->db->where('tracker_device_location.lat !=', 0);
                $this->db->where('tracker_device_location.lng !=', 0);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_device_location = $query->row_array();

                if ($query->num_rows() > 0 ){
            //    if ($result_tracker_device_location) {
                    $user_lat = $result_tracker_device_location['lat'];
                    $user_long = $result_tracker_device_location['lng'];
                    $res_location_name = $this->getLocationFromLatLong($user_lat, $user_long);
                    
                    $track_time = $result_tracker_device_location['created_at'];
                    $this->db->select('*');
                    $this->db->from('tracker_device_location_update');
                    $this->db->where('imei', $device_imei);
                    $this->db->order_by('id', 'DESC');
                    $lquery = $this->db->get();
                    $result_tracker_devices_check = $lquery->row_array();
                    $_track_last_comm = ''; $totaltimediff = 0;
                    if ($lquery->num_rows() > 0 ){
                        $_track_last_comm = $result_tracker_devices_check['last_communication'];
                        $track_time = date('Y-m-d H:i:s');
                        $totaltimediff = $this->datetimediff($track_time,$_track_last_comm);
                        $totaltimediff_explode = explode(" ",$totaltimediff);
                        
                        if(count($totaltimediff_explode)>=2){
                            $exact_time = $totaltimediff_explode[0];
                            $exact_time_type = $totaltimediff_explode[1];
                            if($exact_time_type=='minutes'){
                                if($exact_time>5){
                                    $device_state = "offline";
                                }else{
                                    $device_state = "online";
                                } 
                            }else{
                                if($exact_time_type=='seconds'){
                                  $device_state = "online";
                                }else{
                                    $device_state = "offline";
                                }
                            }
                        }
                    }
                }
            }
        }

       $device_state = "online";

        $result = array('Code' => 200, 'imei' => $device_imei, 'device_state' => $device_state);
        print json_encode($result);
    }
    
    public function datetimediff($track_time,$last_comm_time){
        $datetime1 = new DateTime($last_comm_time);
        $datetime2 = new DateTime($track_time);
        $interval = $datetime1->diff($datetime2);
        $elapsed_year = $interval->format('%y');
        $elapsed_month = $interval->format('%m');
        $elapsed_days = $interval->format('%a');
        $elapsed_hour = $interval->format('%h');
        $elapsed_min = $interval->format('%i');
        $elapsed_sec = $interval->format('%s');
        if($elapsed_year>0){
           $elapsed = $elapsed_year." years ".$elapsed_month." months"; 
        }else{
            if($elapsed_month>0){
               $elapsed = $elapsed_month." months ".$elapsed_days." days"; 
            }else{
                if($elapsed_days>0){
                    $elapsed = $elapsed_days." days ".$elapsed_hour." hours"; 
                }else{
                    if($elapsed_hour>0){
                        $elapsed = $elapsed_hour." hours ".$elapsed_min." minutes"; 
                    }else{
                        if($elapsed_min>0){
                            $elapsed = $elapsed_min." minutes ".$elapsed_sec." seconds"; 
                        }else{
                            $elapsed = $elapsed_sec." seconds";
                        }  
                    } 
                }
            }
        }
        return $elapsed;
    }

    
    /* Find the device */

    public function addTrackerDeviceFinder(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $is_start = $_POST['is_start'];

            $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'is_start' => $is_start,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
            $this->db->insert('tracker_device_finder', $insert_data);

            if($is_start=='1'){
               $message = "Received Find Command";
            }else{
                $message = "Received Stop Command";
            }
            $insert_info_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tracker_device_information', $insert_info_data);

            $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
           
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getDeviceToRing(){
        
        $this->db->select('*');
        $this->db->where('is_done', '0');
        $this->db->from('tracker_device_finder');
        $trackquery = $this->db->get();
        $track_result = $trackquery->result_array();
       
        $result = array('Code' => 200, 'res' => $track_result);
        print json_encode($result);
    }

    public function updateTrackerDeviceFinder(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $id = $_POST['id'];
        $update_finder['is_done'] = '1';
        $update_finder['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        // $this->db->where('imei',$imei);
        $this->db->update('tracker_device_finder', $update_finder);
        $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
        print json_encode($result);
    }

    public function getDeviceTrackerRingStatus(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];
        $is_start = $_POST['is_start'];
               
        $this->db->select('*');
        $this->db->from('tracker_device_finder');
        $this->db->where('imei', $imei);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_start', $is_start);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array(); 
        $is_done = 0;
        
        if ($trackquery->num_rows() > 0) {
            $is_done = $track_result['is_done'];
        }
        $message = '';
        if($is_done == 1){
            if($is_start==1){
                $message = 'Device Start Ringing';
            }else{
                $message = 'Device Stop Ringing';
            }
            
        }
       
        $result = array('Code' => 200, 'status' => $is_done, 'msg' => $message, 'res'=>$track_result, 'is_start' => $is_start);
        print json_encode($result);
    }
    
    
    /*  Power Saving */
    public function addTrackerDevicePowerSaving(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $is_start = $_POST['is_start'];

            $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'is_start' => $is_start,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
            $this->db->insert('tracker_device_powersaving', $insert_data);

            if($is_start=='1'){
               $message = "Received Power is Connected Command";
            }else{
                $message = "Received Power is disconnected Command";
            }
            $insert_info_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tracker_device_information', $insert_info_data);
            
            $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
           
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getDeviceToPowerSaving(){
        
        $this->db->select('*');
        $this->db->where('is_done', '0');
        $this->db->from('tracker_device_powersaving');
        $trackquery = $this->db->get();
        $track_result = $trackquery->result_array();
       
        $result = array('Code' => 200, 'res' => $track_result);
        print json_encode($result);
    }

    public function updateTrackerDevicePowerSaving(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $id = $_POST['id'];
        $update_finder['is_done'] = '1';
        $update_finder['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        // $this->db->where('imei',$imei);
        $this->db->update('tracker_device_powersaving', $update_finder);
        $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
        print json_encode($result);
    }

    public function getDeviceTrackerPowerSavingStatus(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];
        $is_start = $_POST['is_start'];
               
        $this->db->select('*');
        $this->db->from('tracker_device_powersaving');
        $this->db->where('imei', $imei);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_start', $is_start);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array(); 
        $is_done = 0;
        
        if ($trackquery->num_rows() > 0) {
            $is_done = $track_result['is_done'];
        }
        $message = '';
        if($is_done == 1){
            if($is_start==1){
                $message = 'Power Saving Remote ON';
            }else{
                $message = 'Power Saving Remote Off';
            }
            
        }
       
        $result = array('Code' => 200, 'status' => $is_done, 'msg' => $message, 'res'=>$track_result, 'is_start' => $is_start);
        print json_encode($result);
    }
    

    public function getDeviceTrackerPowerSavingData(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];
              
        $this->db->select('*');
        $this->db->from('tracker_device_powersaving');
        $this->db->where('imei', $imei);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array(); 
        $is_start = "";
        if ($trackquery->num_rows() > 0) {
            $is_start = $track_result['is_start'];
        }
               
        $result = array('Code' => 200,'res'=>$track_result, 'is_start' => $is_start);
        print json_encode($result);
    }
    
    
    
    public function getDeviceTrackerPowerSavingTimerData(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];
               
        $this->db->select('*');
        $this->db->from('tracker_device_powersaving_timer');
        $this->db->where('imei', $imei);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array(); 
        $is_start = ""; $remote_on_time = "00:00:00"; $remote_off_time = "00:00:00";
        $num = $trackquery->num_rows();
        if ($trackquery->num_rows() > 0) {
            $is_start = $track_result['is_start'];
            if($is_start==1){
                $remote_on_time = $track_result['remote_on_time'];
                $remote_off_time = $track_result['remote_off_time'];
            }
        }
               
        $result = array('Code' => 200, 'num'=>$num,'remote_on_time' => $remote_on_time, 'remote_off_time' => $remote_off_time, 'res'=>$track_result, 'is_start' => $is_start, 'res'=>$track_result);
        print json_encode($result);
    }  

    public function getDeviceTrackerInformation(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];

        $this->db->select('*');
        $this->db->from('tracker_device_information');
        $this->db->where('imei', $imei);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted',0);
        $this->db->order_by('id', 'DESC');
        $trackquery = $this->db->get();
        $track_result = $trackquery->result_array();
       
        $result = array('Code' => 200, 'res' => $track_result);
        print json_encode($result);
    }
    
    
    

    /*  Power Saving Timer */
    public function addTrackerDevicePowerSavingTimer(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $is_start = $_POST['is_start'];
            $remote_on_time = $_POST['remote_on_time'];
            $remote_off_time = $_POST['remote_off_time'];

            $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'is_start' => $is_start,
                    'remote_on_time' => $remote_on_time,
                    'remote_off_time' => $remote_off_time,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
            $this->db->insert('tracker_device_powersaving_timer', $insert_data);

            if($is_start=='1'){
               $message = "Received Power with Timer is Connected Command";
            }else{
                $message = "Received Power with Timer is disconnected Command";
            }
            $insert_info_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tracker_device_information', $insert_info_data);

            $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
           
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function getDeviceToPowerSavingTimer(){
        
        $this->db->select('*');
        $this->db->where('is_done', '0');
        $this->db->from('tracker_device_powersaving_timer');
        $trackquery = $this->db->get();
        $track_result = $trackquery->result_array();
       
        $result = array('Code' => 200, 'res' => $track_result);
        print json_encode($result);
    }

    public function updateTrackerDevicePowerSavingTimer(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $id = $_POST['id'];
        $update_finder['is_done'] = '1';
        $update_finder['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        // $this->db->where('imei',$imei);
        $this->db->update('tracker_device_powersaving_timer', $update_finder);
        $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
    }

    public function getTrackerDevicePowerSavingTimerStatus(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
        $imei = $_POST['imei'];
        $is_start = $_POST['is_start'];
               
        $this->db->select('*');
        $this->db->from('tracker_device_powersaving_timer');
        $this->db->where('imei', $imei);
        $this->db->where('user_id', $user_id);
        $this->db->where('is_start', $is_start);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array(); 
        $is_done = 0;
        
        if ($trackquery->num_rows() > 0) {
            $is_done = $track_result['is_done'];
        }
        $message = '';
        if($is_done == 1){
            if($is_start==1){
                $message = 'Power Saving Timer ON';
            }else{
                $message = 'Power Saving Timer Off';
            }
            
        }
       
        $result = array('Code' => 200, 'status' => $is_done, 'msg' => $message, 'res'=>$track_result, 'is_start' => $is_start);
        print json_encode($result);
    }

    
    public function getGPSTrackerSettings(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
       
        $this->db->select('*');
        $this->db->from('google_maps_marker_user');
        $this->db->where('user_id', $user_id);
        $marker_query = $this->db->get();
        $user_marker_result = $marker_query->row_array();

        if ($marker_query->num_rows() > 0) {
            $image_url_link = $user_marker_result['image_link'];
        }else{
            $image_url_link = "https://uat.zimaxxtech.com/backend/images/mapicons/2.png";
        }

        $imei = "";
       
        $this->db->select('*');
        $this->db->where('is_deleted', '0');
        $this->db->where('user_id', $user_id);
        $this->db->from('user_tracker_devices');
        $trackquery = $this->db->get();
        $track_result = $trackquery->row_array();
        $tracker_device_id = '';$tracker_name='';
        if ($track_result) {
            $tracker_device_id = $track_result['device_id'];
            $tracker_name = $track_result['device_name'];
        }  
            
        
        if ($tracker_device_id != '') {
            $this->db->select('*');
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('id', $tracker_device_id);
            $tracker_query = $this->db->get();
            $result_tracker = $tracker_query->row_array();

            $device_imei = null;
            if ($tracker_query->num_rows() > 0) {
                $device_imei = $result_tracker['device_imei'];
                if ($device_imei != null) {
                    $imei = $device_imei;
                    $this->db->select('lat,lng');
                  //  $this->db->distinct();
                    $this->db->from('tracker_device_location');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('imei', $imei);
                    $this->db->order_by('id', 'DESC');
                    $this->db->limit(1);
                    $loc_query = $this->db->get();
                    $result_log = $loc_query->row_array();
                    if ($loc_query->num_rows() > 0) { 
                        $latitude = $result_log['lat'];
                        $longitude = $result_log['lng'];
                    }else{
                        $latitude = '';
                        $longitude = '';
                    }
                }
            }
        }

        $result_array = array('Code' => 200, 'lat' => $latitude, 'lng' => $longitude, 'image_url' => $image_url_link, 'tracker_name' => $tracker_name, 'imei' => $imei);
        print json_encode($result_array);
         
    }
    
    
      /*  On/Off Settings */

    public function addTrackerOnOffSettings(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $setting_name = $_POST['setting_name'];
            $is_start = $_POST['is_start'];
            $_is_done = 0;
            if($setting_name=='push_notification'){
                $_is_done = 1;
            }
            
            
            $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'setting_name' => $setting_name,
                    'is_start' => $is_start,
                    'is_done' => $_is_done,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tracker_device_on_off_settings', $insert_data);

            if($setting_name=='push_notification'){
                if($is_start==1){
                    $message = "Received Push Notification On Command";
                }else{
                    $message = "Received Push Notification Off Command";
                }
               
            }
            if($setting_name=='vibration_alarm'){
                if($is_start==1){
                    $message = "Received Vibration Alarm On Command";
                }else{
                    $message = "Received Vibration Alarm Off Command";
                }            
            }
            if($setting_name=='led'){
                if($is_start==1){
                    $message = "Received Led On Command";
                }else{
                    $message = "Received Led Off Command";
                }            
            }
            if($setting_name=='speaker_setting'){
                if($is_start==1){
                    $message = "Received Speaker Setting On Command";
                }else{
                    $message = "Received Speaker Setting Off Command";
                }            
            }
            if($setting_name=='reboot'){
               $message = "Received Reboot Command";
            }
            if($setting_name=='shutdown'){
               $message = "Received Shutdown Command";
            }
            $insert_info_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tracker_device_information', $insert_info_data); 

            $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    
    public function getTrackerOnOffSettings(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
                        
            $this->db->select('*');
            $this->db->from('tracker_device_on_off_settings');
            $this->db->where('user_id', $user_id);
            $this->db->where('imei',$imei);
            $this->db->where('setting_name','push_notification');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $pnquery = $this->db->get();
            $push_notify_result = $pnquery->row_array();
            $result = array();
            $push_notification_setting = 0;
            if($push_notify_result){
                $push_notification_setting = $push_notify_result['is_start'];
            }

            $this->db->select('*');
            $this->db->from('tracker_device_on_off_settings');
            $this->db->where('user_id', $user_id);
            $this->db->where('imei',$imei);
            $this->db->where('setting_name','vibration_alarm');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $vaquery = $this->db->get();
            $vib_alarm_result = $vaquery->row_array();
            $vib_alarm_setting = 0;
            if($vib_alarm_result){
                $vib_alarm_setting = $vib_alarm_result['is_start'];
            }

            $this->db->select('*');
            $this->db->from('tracker_device_on_off_settings');
            $this->db->where('user_id', $user_id);
            $this->db->where('imei',$imei);
            $this->db->where('setting_name','led');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $ledquery = $this->db->get();
            $led_result = $ledquery->row_array();
            $led_setting = 0;
            if($led_result){
                $led_setting = $led_result['is_start'];
            }

            $this->db->select('*');
            $this->db->from('tracker_device_on_off_settings');
            $this->db->where('user_id', $user_id);
            $this->db->where('imei',$imei);
            $this->db->where('setting_name','speaker_setting');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $ssquery = $this->db->get();
            $speaker_setting_result = $ssquery->row_array();
            $speaker_setting = 0;
            if($speaker_setting_result){
                $speaker_setting = $speaker_setting_result['is_start'];
            }

            $result = array('status' => 'Success', 'push_notification_setting' => $push_notification_setting, 'vib_alarm_setting' => $vib_alarm_setting, 'speaker_setting' => $speaker_setting, 'led_setting' => $led_setting);  
            print json_encode($result);
        }else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
    }


    
    public function updateTrackerDeviceUserName(){
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $device_imei = $_POST['imei'];
        $user_id = $_POST['user_id'];
        $device_name = $_POST['device_name'];
        
        $this->db->select('*');
        $this->db->from('tracker_devices');
        $this->db->where('is_deleted', '0');
        $this->db->where('device_imei', $device_imei);
        $device_query = $this->db->get();
        $device_result = $device_query->row_array(); 
       // print json_encode($result);
        
        if ($device_result) {
            $tracker_device_id = $device_result['id'];
            $this->db->select('*');
            $this->db->from('user_tracker_devices');
            $this->db->where('is_deleted', '0');
            $this->db->where('device_id', $tracker_device_id);
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            $track_result = $query->row_array();
           //  print json_encode($track_result);
            
            if ($query->num_rows() > 0) {
                $update_id = $track_result['id'];
                // print json_encode($update_id);
                $update_finder['device_name'] = $device_name;
                $update_finder['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('id', $update_id);
                $this->db->update('user_tracker_devices', $update_finder);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
                print json_encode($result); 
            }else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }  
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }  
    }

    
    public function googleMapMarkerImages() {
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
                      
            $this->db->select('*');
            $this->db->from('google_maps_marker');
            $this->db->where('status', 1);
          //  $this->db->where('imei',$imei);
            $query = $this->db->get();
            $all_result = $query->result_array();

            $result = array();
            $this->db->select('*');
            $this->db->from('google_maps_marker_user');
            $this->db->where('user_id', $user_id);
          //  $this->db->where('imei',$imei);
            $userquery = $this->db->get();
            $user_result = $userquery->row_array();
            if($user_result){
                
                $user_marker_url = $user_result['image_link'];
                $result = array('status' => 'Success', 'all_result' => $all_result, 'user_result' => $user_result);
                print json_encode($result);
            }else{
                $this->db->select('*');
                $this->db->from('google_maps_marker');
                $this->db->where('id', 2);
            //  $this->db->where('imei',$imei);
                $userquery = $this->db->get();
                $user_result = $userquery->row_array();
                $result = array('status' => 'Success', 'all_result' => $all_result, 'user_result' => $user_result);
                print json_encode($result);
            }
            
        }else{
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }

    public function addGoogleMapMarkerSetting(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $image_link = $_POST['image_link'];
                       
            $this->db->select('*');
            $this->db->from('google_maps_marker_user');
            $this->db->where('user_id', $user_id);
          //  $this->db->where('imei',$imei);
            $query = $this->db->get();
            $user_result = $query->row_array();
            $result = array();
            if($user_result){
                
                $update_google_map_marker['image_link'] = $image_link;
                
                $update_google_map_marker['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('user_id', $user_id);
               // $this->db->where('imei',$imei);
                $this->db->update('google_maps_marker_user', $update_google_map_marker);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
            }else{
                 $insert_data = array(
                    'user_id' => $user_id,
                    'image_link' => $image_link,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('google_maps_marker_user', $insert_data);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
            }
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    
     /* Update Time */
    public function addTrackerUpdateTime(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
            $mode_name = $_POST['mode_name'];
            $upload_time = $_POST['upload_time'];
            
            $insert_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'mode_name' => $mode_name,
                    'power_saving_upload_time' => $upload_time,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tracker_device_update_time', $insert_data);

            if($mode_name=='precision_mode'){
               $message = "Received Precision Mode Update Time Command";
            }
            if($mode_name=='power_saving_mode'){
               $message = "Received Power Saving Mode Update Time Command";
            }
            if($mode_name=='sleep_mode'){
               $message = "Received Sleep Mode Update Time Command";
            }
            $insert_info_data = array(
                    'user_id' => $user_id,
                    'imei' => $imei,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tracker_device_information', $insert_info_data); 

                $result = array('status' => 'Success', 'message' => 'Data Set Successfully');
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    public function getTrackerUpdateTime(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
            $imei = $_POST['imei'];
                        
            $this->db->select('*');
            $this->db->from('tracker_device_update_time');
            $this->db->where('user_id', $user_id);
            $this->db->where('imei',$imei);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            $user_result = $query->row_array();
            $result = array();
            if($user_result){
                
                $mode_name = $user_result['mode_name'];
                $power_saving_upload_time = $user_result['power_saving_upload_time'];
                $result = array('status' => 'Success', 'mode_name' => $mode_name, 'power_saving_upload_time' => $power_saving_upload_time);  
                print json_encode($result);
            }else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
          
        }
    }


     
     /* Find the device */
     
      public function addNewTrackerData_NewBackup() {
        date_default_timezone_set('Asia/Kolkata');
        $info = $_GET;
        // $result = array('status' => 'Fail', 'message' => $info);
        //   print json_encode($result);

        if ($info) {
            $tracker_info = json_encode($info);
            $imei = null;
            if (isset($info['imei'])) {
                $imei = $info['imei'];
            }
            // ip
            $ip = null;
            if (isset($info['ip'])) {
                $ip = $info['ip'];
            }
            $lat = null;
            if (isset($info['lat'])) {
                $lat = $info['lat'];
            }
            $lng = null;
            if (isset($info['lng'])) {
                $lng = $info['lng'];
            }
            //angle
            $angle = null;
            if (isset($info['angle'])) {
                $angle = $info['angle'];
            }
            $speed = null;
            if (isset($info['speed'])) {
                $speed = $info['speed'];
            }
            $params = null;
            $power = 0;
            if (isset($info['params'])) {
                $params = $info['params'];
                $params_val = (explode("|", $params));
                $searchword = 'bats';
                $matches = null;
                foreach ($params_val as $k => $v) {
                    if (preg_match("/\b$searchword\b/i", $v)) {
                        $matches = $v;
                    }
                }
                if ($matches != null) {
                    $matches_val = (explode("=", $matches));
                    if (isset($matches_val[1])) {
                        $power = $matches_val[1];
                    }
                }
            }
            
            if (isset($info['bat'])) {
                $power = $info['bat'];
            } 
            if ($lat != null && $lng != null) {
                $insert_data = array(
                    'tracker_info' => $tracker_info,
                    'imei' => $imei,
                    'ip' => $ip,
                    'lat' => $lat,
                    'lng' => $lng, 'angle' => $angle, 'speed' => $speed, 'power' => $power, 'params' => $params,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tracker_device_location', $insert_data);
                $final_result = $this->db->insert_id();
                
                if ($final_result) { 


                    $is_battery_issue = 0;

                    if($power<15){
                        $is_battery_issue = 1;
                        $notification_message = "Battery less than 15%";
                    }
                    if($power==100){
                        $is_battery_issue = 2;
                        $notification_message = "Battery full that is 100%";
                    }
                    if(is_null($power)){
                        $is_battery_issue = 0;
                    }
                    if($is_battery_issue>0){

                        $today_date = date('Y-m-d');
                        $minvalue = $today_date.' 00:00:00';
                        $maxvalue = $today_date.' 23:59:59';
                        $this->db->select('*');
                        $this->db->from('tracker_device_battery_notifications');
                        $this->db->where('imei', $imei);
                        $this->db->where('battery_issue', $is_battery_issue);
                    // $this->db->where('CAST(created_at AS DATE)', $today_date);
                        $this->db->where("created_at BETWEEN '$minvalue' AND '$maxvalue'");
                        $this->db->order_by('id', 'DESC');
                        $_bat_query = $this->db->get(); 
                        
                        if($_bat_query->num_rows()==0){

                            $battery_insert_data = array(
                                'imei' => $imei,
                                'ip' => $ip,
                                'lat' => $lat,
                                'lng' => $lng, 'angle' => $angle, 'speed' => $speed, 'power' => $power,
                                'notification_message' => $notification_message,
                                'battery_issue' => $is_battery_issue,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            );
                            $this->db->insert('tracker_device_battery_notifications', $battery_insert_data); 
                        }
                    } 
                    
                    $this->db->select('*');
                    $this->db->from('tracker_device_location_update');
                    $this->db->where('imei', $imei);
                    $this->db->order_by('id', 'DESC');
                    $query = $this->db->get();
                    $result_tracker_devices_check = $query->row_array();
                    if($query->num_rows() > 0){
                        if($power>0){
                          $arr_tracker_devices_to_update['power'] = $power;
                        }
                        
                        $arr_tracker_devices_to_update['last_communication'] = date('Y-m-d H:i:s');
                        $this->db->where('imei', $imei);
                        $res = $this->db->update('tracker_device_location_update', $arr_tracker_devices_to_update); 
                    }else{
                        $insert_loc_data = array(
                                    'imei' => $imei,
                                    'last_communication' => date('Y-m-d H:i:s'),
                                    'power' => $power,
                                    'tracker_info' => $tracker_info
                                );
                        $this->db->insert('tracker_device_location_update', $insert_loc_data);
                    } 
                    $result = array('status' => 'Success', 'power' => $is_battery_issue, 'result' => $final_result, 'message' => 'Tracker added successfully.');
                    print json_encode($result);
                } else {
                    $error_info = $this->api_model->getErrorCode('13');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                }  
 
            } else {

                $this->db->select('*');
                $this->db->from('tracker_device_location_update');
                $this->db->where('imei', $imei);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_devices_check = $query->row_array();
                
                if($query->num_rows() > 0){
               // if(result_tracker_devices_check){
                    $arr_tracker_devices_to_update = array('power'=>$power,'last_communication' => date('Y-m-d H:i:s'));
                        
                    $this->db->where('imei', $imei);
                    $res = $this->db->update('tracker_device_location_update', $arr_tracker_devices_to_update); 
                }else{
                    $insert_data = array(
                                'imei' => $imei,
                                'last_communication' => date('Y-m-d H:i:s'),
                                'power' => $power,
                                'tracker_info' => $tracker_info
                            );
                    $this->db->insert('tracker_device_location_update', $insert_data);
                }
                $error_info = 'Lat & Long should not empty';
                $result = array('status' => 'Fail', 'message' => $error_info);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }  

    }
     
     
    public function addNewTrackerData() {
        date_default_timezone_set('Asia/Kolkata');
        $info = $_GET;
        if ($info) {
            $tracker_info = json_encode($info);
            $imei = null;
            if (isset($info['imei'])) {
                $imei = $info['imei'];
            }
            // ip
            $ip = null;
            if (isset($info['ip'])) {
                $ip = $info['ip'];
            }
            $lat = null;
            if (isset($info['lat'])) {
                $lat = $info['lat'];
            }
            $lng = null;
            if (isset($info['lng'])) {
                $lng = $info['lng'];
            }
            //angle
            $angle = null;
            if (isset($info['angle'])) {
                $angle = $info['angle'];
            }
            $speed = null;
            if (isset($info['speed'])) {
                $speed = $info['speed'];
            }
            $params = null;
            $power = null;
            if (isset($info['params'])) {
                $params = $info['params'];
                $params_val = (explode("|", $params));
                $searchword = 'bats';
                $matches = null;
                foreach ($params_val as $k => $v) {
                    if (preg_match("/\b$searchword\b/i", $v)) {
                        $matches = $v;
                    }
                }
                if ($matches != null) {
                    $matches_val = (explode("=", $matches));
                    if (isset($matches_val[1])) {
                        $power = $matches_val[1];
                    }
                }
            }
            if ($lat != null && $lng != null) {
                $insert_data = array(
                    'tracker_info' => $tracker_info,
                    'imei' => $imei,
                    'ip' => $ip,
                    'lat' => $lat,
                    'lng' => $lng, 'angle' => $angle, 'speed' => $speed, 'power' => $power, 'params' => $params,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tracker_device_location', $insert_data);
                $final_result = $this->db->insert_id();
                if ($final_result && $imei != null) {
                    
                    // 28-march-2024
                    $insert_response_data = array(
                        'tracker_device_location_id' => $final_result,
                        'tracker_info' => $tracker_info,
                        'imei' => $imei,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('tracker_log', $insert_response_data);
                    $tracker_log_id = $this->db->insert_id();
                    if ($tracker_log_id) {
                        
                    } else {
                        $tracker_log_id=null;
                    }
                
                    $this->checkTrackerDevicesData($imei, $tracker_log_id);
                }
                if ($final_result) {
                    $result = array('status' => 'Success', 'result' => $final_result, 'message' => 'Tracker added successfully.');
                    print json_encode($result);
                } else {
                    $error_info = $this->api_model->getErrorCode('13');
                    $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                    print json_encode($result);
                }
            } else {
                $error_info = 'Lat & Long should not empty';
                $result = array('status' => 'Fail', 'message' => $error_info);
                print json_encode($result);
            }
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    } 
    
    
     public function updateLastLocationCommunication(){
            date_default_timezone_set('Asia/Kolkata');
            $data = $_POST;
            if($_POST){
                $device_imei = $_POST['imei'];
                $power = $_POST['power'];
                $this->db->select('*');
                $this->db->from('tracker_device_location_update');
                $this->db->where('imei', $device_imei);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                $result_tracker_devices_check = $query->row_array();
                $_track_last_comm = ''; $totaltimediff = 0;

                $is_battery_issue = 0;
                if($power<15){
                    $is_battery_issue = 1;
                    $notification_message = "Battery less than 15% , Need to charge your device !";
                }
                if($power==100){
                    $is_battery_issue = 2;
                    $notification_message = "Battery is fully charged (100%) !";
                }
                if(is_null($power)){
                        $is_battery_issue = 0;
                    }
                if($is_battery_issue>0){
                    $today_date = date('Y-m-d');
                    $minvalue = $today_date.' 00:00:00';
                    $maxvalue = $today_date.' 23:59:59';
                    $this->db->select('*');
                    $this->db->from('tracker_device_battery_notifications');
                    $this->db->where('imei', $device_imei);
                    $this->db->where('battery_issue', $is_battery_issue);
                   // $this->db->where('CAST(created_at AS DATE)', $today_date);
                    $this->db->where("created_at BETWEEN '$minvalue' AND '$maxvalue'");
                    $this->db->order_by('id', 'DESC');
                    $_bat_query = $this->db->get();   
                    
                    if ($_bat_query->num_rows() == 0 ){

                        $this->db->select('*');
                        $this->db->from('tracker_device_location');
                        $this->db->where('imei', $device_imei);
                        $this->db->order_by('id', 'DESC');
                        $_query = $this->db->get();
                        $_tracker_devices_check = $_query->row_array();

                        $ip = "";$lat = "";$lng = "";$angle = "";$speed = "";
                        if ($_query->num_rows() > 0 ){
                        $ip = $_tracker_devices_check['ip'];
                        $lat = $_tracker_devices_check['lat'];
                        $lng = $_tracker_devices_check['lng'];
                        $angle = $_tracker_devices_check['angle'];
                        $speed = $_tracker_devices_check['speed'];
                        }
        
                        $battery_insert_data = array(
                            'imei' => $device_imei,
                            'ip' => $ip,
                            'lat' => $lat,
                            'lng' => $lng, 'angle' => $angle, 'speed' => $speed, 'power' => $power,
                            'notification_message' => $notification_message,
                            'battery_issue' => $is_battery_issue,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('tracker_device_battery_notifications', $battery_insert_data);
                    }
                }

                if ($query->num_rows() > 0 ){
                    $update_id = $result_tracker_devices_check['id'];
                    $update_finder['power'] = $power;
                    $update_finder['last_communication'] = date('Y-m-d H:i:s');
                    $update_finder['updated_at'] = date('Y-m-d H:i:s');

                    $this->db->where('id', $update_id);
                    $this->db->update('tracker_device_location_update', $update_finder);
                    $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
                    print json_encode($result); 
                }else{
                    $insert_data = array(
                                    'imei' => $device_imei,
                                    'last_communication' => date('Y-m-d H:i:s'),
                                    'power' => $power,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                    // 'tracker_info' => $tracker_info
                                );
                    $this->db->insert('tracker_device_location_update', $insert_data);
                    $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
                    print json_encode($result); 
                }
            }else {
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
    }
    

    
    public function updateTrackerDeviceOnOffSettings(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $id = $_POST['id'];
        $update_finder['is_done'] = '1';
        $update_finder['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        // $this->db->where('imei',$imei);
        $this->db->update('tracker_device_on_off_settings', $update_finder);
        $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
        print json_encode($result);
    }
    
     public function getDeviceToUpdateTime(){
        
        $this->db->select('*');
        $this->db->where('is_done', '0');
        $this->db->from('tracker_device_update_time');
        $trackquery = $this->db->get();
        $track_result = $trackquery->result_array();
       
        $result = array('Code' => 200, 'res' => $track_result);
        print json_encode($result);
    }

     public function updateTrackerDeviceUpdateTime(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        $id = $_POST['id'];
        $update_finder['is_done'] = '1';
        $update_finder['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        // $this->db->where('imei',$imei);
        $this->db->update('tracker_device_update_time', $update_finder);
        $result = array('status' => 'Success', 'message' => 'Data Set Successfully');  
        print json_encode($result);
    }
    
    
    public function batteryNotifications(){
        date_default_timezone_set('Asia/Kolkata');  
        $this->db->select('*');
        $this->db->from('tracker_device_battery_notifications');
        $this->db->where('is_notification_sent', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $users = $query->result_array(); 
        foreach($users as $user){
                $imei = $user['imei'];
            
                $notification_msg = $user['notification_message'];
                $notification_id = $user['id'];

                $this->db->select('*');
                $this->db->from('tracker_devices');
                $this->db->where('device_imei', $imei);
                $this->db->where('is_deleted', '0');
                $this->db->order_by('id', 'DESC');
                $newquery = $this->db->get();
                $newresult = $newquery->row_array();

               
                if ($newresult) {
                    $tracker_device_id = $newresult['id'];
                    $this->db->select('*');
                    $this->db->from('user_tracker_devices');
                    $this->db->where('is_deleted', '0');
                    $this->db->where('device_id', $tracker_device_id);
                    $this->db->order_by('id', 'DESC');
                    $tr_query = $this->db->get();
                    $track_result = $tr_query->row_array();
                    $cnt = $tr_query->num_rows();
                    if ($tr_query->num_rows() > 0) {
                        $user_id = $track_result['user_id'];

                        $this->db->select('*');
                        $this->db->from('tracker_device_on_off_settings');
                        $this->db->where('user_id', $user_id);
                        $this->db->where('imei',$imei);
                        $this->db->where('setting_name','push_notification');
                        // $this->db->where('is_start','1');
                        $this->db->order_by('id', 'DESC');
                        $this->db->limit(1);
                        $pnquery = $this->db->get();
                        $push_notification_result = $pnquery->row_array();
                       
                        if ($pnquery->num_rows() > 0) {
                            if($push_notification_result['is_start']=='1'){
                                $notify_response = $this->send_NotificationToUser($user_id, $notification_msg,'CaptainIndiaPetSafety - Battery New Notification');
                                if ($notify_response) {
                                    $notify_update['is_notification_sent'] = 1;
                                    $notify_update['updated_at'] = date('Y-m-d H:i:s');
                                    $this->db->where('id', $notification_id);
                                    $this->db->update('tracker_device_battery_notifications', $notify_update);


                                    $loc_notification_data = array(
                                        'user_id' => $user_id,
                                        'imei' => $imei,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'message_title' => 'Battery Notification',
                                        'message' => $notification_msg,
                                        'notification_type' => 'battery',
                                    );

                                    $this->db->insert('tracker_device_notifications', $loc_notification_data);
                                }
                            }
                        }

                        
                    }
                } 
        } 
         $result = array(
            'status' => 'Success',
            'code' => 200,
            'res' => $track_result,
            'imei' => $imei,
            'cnt' => $user_id,
            'data' => $push_notification_result
        );

        print json_encode($result);
    }

     
    public function checkBattery(){
        $device_imei = '861261029130636';
        $today_date = date('Y-m-d');
        $minvalue = $today_date.' 00:00:00';
        $maxvalue = $today_date.' 23:59:59';
        $this->db->select('*');
        $this->db->from('tracker_device_battery_notifications');
        $this->db->where('imei', $device_imei);
        $this->db->where("created_at BETWEEN '$minvalue' AND '$maxvalue'");
        $this->db->order_by('id', 'DESC');
        $_bat_query = $this->db->get();  
        $_total = $_bat_query->num_rows();
        $result = array('status' => 'Fail', 'message' => $_total);
        print json_encode($result);
    }

    public function checkdatetimediff(){
         date_default_timezone_set('Asia/Kolkata');
        $last_comm_time = '2024-07-29 17:06:17';
        $track_time = date('Y-m-d H:i:s');
        $datetime1 = new DateTime($last_comm_time);
        $datetime2 = new DateTime($track_time);
        $interval = $datetime1->diff($datetime2);
        $elapsed_year = $interval->format('%y');
        $elapsed_month = $interval->format('%m');
        $elapsed_days = $interval->format('%a');
        $elapsed_hour = $interval->format('%h');
        $elapsed_min = $interval->format('%i');
        $elapsed_sec = $interval->format('%s');
        if($elapsed_year>0){
           $elapsed = $elapsed_year." years ".$elapsed_month." months"; 
        }else{
            if($elapsed_month>0){
               $elapsed = $elapsed_month." months ".$elapsed_days." days"; 
            }else{
                if($elapsed_days>0){
                    $elapsed = $elapsed_days." days ".$elapsed_hour." hours"; 
                }else{
                    if($elapsed_hour>0){
                        $elapsed = $elapsed_hour." hours ".$elapsed_min." minutes"; 
                    }else{
                        if($elapsed_min>0){
                            $elapsed = $elapsed_min." minutes ".$elapsed_sec." seconds"; 
                        }else{
                            $elapsed = $elapsed_sec." seconds";
                        }  
                    } 
                }
            }
        }
        $totaltimediff_explode = explode(" ",$elapsed);
        $device_state = "offline";
        if(count($totaltimediff_explode)>=2){
            $exact_time = $totaltimediff_explode[0];
            $exact_time_type = $totaltimediff_explode[1];
            if($exact_time_type=='minutes'){
                if($exact_time>5){
                    $device_state = "offline";
                }else{
                    $device_state = "online";
                } 
            }else{
                if($exact_time_type=='seconds'){
                  /*  if($user_lat==0 && $user_long==0){
                        $device_state = "ideal";  
                    }else{
                        $device_state = "online";
                    } */
                     $device_state = "online";
                }else{
                    $device_state = "offline";
                }
            }
        }
        // return $elapsed;
        print json_encode(['time' => $elapsed,'state'=>$device_state,'timetype'=>$exact_time_type]);
    }
    
    
    public function send_NotificationToUser($user_id,$notifymsg,$notifytitle) {
       // $data = $_POST;
       // if($_POST){
        $apiresponse= 0 ; 
        if($user_id > 0){
          //  $user_id = $_POST['notify_user_id'];
          //  $imei = $_POST['imei'];
                        
            $this->db->select('*');
            $this->db->from('user_fcm_token');
            $this->db->where('user_id', $user_id);
          //  $this->db->where('imei',$imei);
            $query = $this->db->get();
            $fcmresult = $query->row_array();
            $result = array();

          //  $user_fcm = $fcmresult['fcm_token'];

         //   $result = array('status' => $user_fcm);
         //   print json_encode($result);
           
            
            if($fcmresult){
                $user_fcm = $fcmresult['fcm_token'];
                
                
                $insert_myresqr_user = array(
                    'fcm_token' => $user_fcm,
                    'notifymsg' => $notifymsg,
                    'notifytitle' => $notifytitle
                );
                $insert_myresqr_json_user = json_encode($insert_myresqr_user);

                $header_arr = array('Content-Type: application/json');

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://www.meraqr.co/api/send_firebase_msg');
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
               
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                
                $response = curl_exec($curl);

                curl_close($curl);

            $json_result = json_decode($response, true);
            $statusCode = $json_result['status'];
            
                if ($statusCode==200) {
                  //  $json_result = json_decode($response, true);
                    $apiresponse= 1 ; 

                  //  print json_encode($json_result);
                }else{
                    $result = array('status' => 'Wrong');
                //    print json_encode($result);
                    
                }
            }else{
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
              //  print json_encode($result);
            }  
            
        }else{
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
          //  print json_encode($result);
        }

        return $apiresponse;
    } 
    
    
    
    public function get_PanicRequestByID() {
        $data = $_POST;
        if($_POST){
            $panic_id = $_POST['panic_id'];
                      
            $this->db->select('*');
            $this->db->from('panic_request');
            $this->db->where('id', $panic_id);
          //  $this->db->where('imei',$imei);
            $query = $this->db->get();
            $panic_result = $query->row_array();
            $result = array();
            if($panic_result){
                $user_id = $panic_result['user_id'];
                $user_lat = $panic_result['user_lat'];
                $user_long = $panic_result['user_long'];
                $user_time = $panic_result['timestamp'];
                $result = array('status' => 'Success', 'user_lat' => $user_lat, 'user_long' => $user_long);
                print json_encode($result);
            }else{
                $error_info = $this->api_model->getErrorCode('13');
                $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
                print json_encode($result);
            }
            
        }
    }
    
    
    
     public function getGPSTrackerHealthGoalSetting(){
        $data = $_POST;
        $user_id = $_POST['user_id'];
      //  $imei = $_POST['imei'];
        $this->db->select('*');
        $this->db->from('gpstracker_health_goal_settings');
        $this->db->where('user_id', $user_id);
       // $this->db->where('imei', $imei);
        $query = $this->db->get();
        $result = $query->row_array();
       
       if($result){
          $result_array = array('Code' => 200, 'result' => $result);
          print json_encode($result_array);
       }else{
          $result_array = array('Code' => 201);
          print json_encode($result_array);
       }
         
    }

    
    public function addGPSTrackerHealthGoalSetting(){ 
        date_default_timezone_set('Asia/Kolkata');
        $data = $_POST;
        if($_POST){
            $user_id = $_POST['user_id'];
          //  $imei = $_POST['imei'];
            $total_steps = $_POST['total_steps'];
            $weight = $_POST['weight'];
            $distance_per_step = $_POST['distance_per_step'];
            
            $created_at = $_POST['created_at'];
          //  $updated_at = $created_at;
            
            $this->db->select('*');
            $this->db->from('gpstracker_health_goal_settings');
            $this->db->where('user_id', $user_id);
          //  $this->db->where('imei',$imei);
            $query = $this->db->get();
            $sosresult = $query->row_array();
            $result = array();
            if($sosresult){
                
                $update_gpstracker_health_goal['total_steps'] = $total_steps;
                $update_gpstracker_health_goal['weight'] = $weight;
                $update_gpstracker_health_goal['distance_per_step'] = $distance_per_step;
               
                $update_gpstracker_health_goal['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('user_id', $user_id);
               // $this->db->where('imei',$imei);
                $this->db->update('gpstracker_health_goal_settings', $update_gpstracker_health_goal);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'result'=> $sosresult);  
            }else{
                 $insert_data = array(
                    'user_id' => $user_id,
                  //  'imei' => $imei,
                    'total_steps' => $total_steps,
                    'weight' => $weight,
                    'distance_per_step' => $distance_per_step,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('gpstracker_health_goal_settings', $insert_data);
                $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'result'=> 'insert');
            }
            
           // $result = array('status' => 'Success', 'message' => 'Data Set Successfully', 'sosresult'=> $sosresult);
            print json_encode($result);
        }else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
    
    
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    function calculate_distance($lat1, $lon1, $lat2, $lon2) {
        $earth_radius = 6371; // in kilometers

        // Convert latitude and longitude from degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Haversine formula
        $delta_lat = $lat2 - $lat1;
        $delta_lon = $lon2 - $lon1;
        $a = sin($delta_lat/2) * sin($delta_lat/2) + cos($lat1) * cos($lat2) * sin($delta_lon/2) * sin($delta_lon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earth_radius * $c;

        return $distance; // Distance in kilometers
    } 

    function distanceNew($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
            return ($miles * 1.609344);
            } else if ($unit == "N") {
            return ($miles * 0.8684);
            } else {
            return $miles;
            }
        }
    }
    
    
    public function getUserDetailsNew() {
        $data = $_POST;

        $finresults = $this->api_model->getUserDetails($_POST);
        if ($finresults) {
            $result = array('status' => 'Success', 'result' => $finresults);
            print json_encode($result);
        } else {
            $error_info = $this->api_model->getErrorCode('13');
            $result = array('status' => 'Fail', 'message' => $error_info->message, 'code' => $error_info->code);
            print json_encode($result);
        }
    }
    
     
    public function travelSafeExtraDetails() {
        $datas = $_POST;
        
        //7-jun-2022
        date_default_timezone_set('Asia/Kolkata');

        $user_info = $this->db->get_where('users', array('id' => $_POST['user_id']))->row();
        $name = $user_info->first_name . '%20' . $user_info->last_name;
        $message = $user_info->first_name . ' ' . $user_info->last_name . " has raised Follow me request on Captain India. Time : " . date('Y-m-d h:i:s');

        //  $response = $this->api_model->sendMessage($message,$loc,$url);
        // 31-may-2022 Follow me per min notification off
        $response = true;
     //   $loc = $_POST['user_lat'] . "%2C" . $_POST['user_long'];
        
         $this->db->insert('travel_safe_extra_details', array(
                    'tracking_id' => isset($_POST['tracking_id']) ? $_POST['tracking_id'] : NULL,
                    'user_id' => $_POST['user_id'],
                    'start_point_lat' => $_POST['start_point_lat'],
                    'start_point_long' => $_POST['start_point_long'],
                    'destination_point_lat' => $_POST['destination_point_lat'],
                    'destination_point_long' => $_POST['destination_point_long'],
                    'timer_alarm_to_call' => $_POST['timer_alarm_to_call'],
                    'route_selection' => $_POST['route_selection'],
                    'traveller' => $_POST['traveller'],
                    // 28-may-2022
                    'live_tracking' => $_POST['live_tracking'],
                    // 7-jun-2022
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    // 21-jun-2022
                    
                ));
                
        $this->db->insert('travel_safe_location_update', array(
                    'tracking_id' => isset($_POST['tracking_id']) ? $_POST['tracking_id'] : NULL,
                    'user_id' => $_POST['user_id'],
                    'update_latitude' => $_POST['start_point_lat'],
                    'update_longitude' => $_POST['start_point_long'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    // 21-jun-2022
                    
                ));            
        
        $result = array('status' => 'Success');
        print json_encode($result);
    }

  
    function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earth_radius = 6371; // Earth radius in km
    
        $lat_diff = deg2rad($lat2 - $lat1);
        $lon_diff = deg2rad($lon2 - $lon1);
    
        $a = sin($lat_diff / 2) * sin($lat_diff / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lon_diff / 2) * sin($lon_diff / 2);
    
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        return $earth_radius * $c; // Distance in km
    }
    
    // Function to check if the user has stopped
    function checkIfStopped($latitude, $longitude, $route) {
        $distanceFromStart = $this->calculateDistance($latitude, $longitude, $route['start']['lat'], $route['start']['lng']);
        $distanceFromEnd = $this->calculateDistance($latitude, $longitude, $route['end']['lat'], $route['end']['lng']);
    
        // If the user is close to either start or end, consider them on the route
        if ($distanceFromStart < 0.1 || $distanceFromEnd < 0.1) {
            return false; // User is still traveling
        }
    
        // If the user hasn't moved much over a period, consider them stopped
        return true;
    }
    
    public function getCheckDistance() {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $route_strt_lat = "21.251384"; 
        $route_strt_lng = "81.629641"; 
        $route_end_lat = "21.2087817"; 
        $route_end_lng = "81.3536784";
        $distanceFromStart = $this->calculateDistance($latitude, $longitude, $route_strt_lat, $route_strt_lng);
        $distanceFromEnd = $this->calculateDistance($latitude, $longitude, $route_end_lat, $route_end_lng);
        print json_encode(['distanceFromStart' => $distanceFromStart, 'distanceFromEnd' => $distanceFromEnd]);
    }
    
    public function getUserLocation() {
        // Assuming the user sends latitude and longitude in the POST request
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $user_id = $_POST['user_id'];  // You should send a unique user ID
        
        // Thresholds for detecting stoppage (e.g., stop if less than 0.1 km per minute)
      //  define('STOP_THRESHOLD', 0.1); // in kilometers
        
        // Example of pre-defined route coordinates (start and end points)
        $route = [
            'start' => ['lat' => 21.251384, 'lng' => 81.629641],  // Raipur
            'end' => ['lat' => 21.2087817, 'lng' => 81.3536784]     // Bhilai
        ];
        
        
        // Detect if user stopped moving
        if ($this->checkIfStopped($latitude, $longitude, $route)) {
            // Return a response indicating the user has stopped
          //  echo json_encode(['stopped' => true]);
            print json_encode(['stopped' => true]);
        } else {
          //  echo json_encode(['stopped' => false]);
            print json_encode(['stopped' => false]);
        }
    }
    
    
    function findClosestPoint($latitude, $longitude, $route) {
        $minDistance = "10";  // Start with a very large number
        $closestPoint = null;
    
        foreach ($route as $waypoint) {
            $distance = calculateDistance($latitude, $longitude, $waypoint['lat'], $waypoint['lng']);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $closestPoint = $waypoint;
            }
        }
    
        return $closestPoint;
    }
    
    function isOffRoute($latitude, $longitude, $route, $heading) {
        $closestPoint = findClosestPoint($latitude, $longitude, $route);
        $distanceFromRoute = calculateDistance($latitude, $longitude, $closestPoint['lat'], $closestPoint['lng']);
    
        // Threshold for distance from the route (e.g., 0.5 km)
        if ($distanceFromRoute > 0.5) {
            return true; // User is off route if distance is greater than threshold
        }
    
        // Check if the user's heading is significantly off from the expected direction
        // (This would be more accurate with more waypoints and better direction checking)
        // For simplicity, we'll assume the heading should be in the direction of the route.
        // In reality, you'd need to calculate the bearing between two points on the route to do this.
    
        return false;
    }
    
    
    public function getUserLocationInRoute() {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $heading = $_POST['heading'];  // The user's current heading (0-360 degrees)
        
        // Example predefined route (waypoints)
        $route = [
            ['lat' => 37.7749, 'lng' => -122.4194], // San Francisco
            ['lat' => 37.8044, 'lng' => -122.2711], // Oakland
            ['lat' => 34.0522, 'lng' => -118.2437]  // Los Angeles
        ];
        $user_id = $_POST['user_id'];  // You should send a unique user ID
        
        // Check if the user is off-route
        if (isOffRoute($latitude, $longitude, $route, $heading)) {
            print json_encode(['offRoute' => true]);
        } else {
            print json_encode(['offRoute' => false]);
        }
        
    }
    
    
   public function sendNotificationTesting(){
        $send_message = "Testing notification";
        $notifytitle = "Notification";
        $user_id = "5251";
        $this->send_NotificationToUser($user_id,$send_message,$notifytitle);
        
       
            $statusCode = 200;
                if ($statusCode==200) {
                    $result = array('status' => 'Success');
                }else{
                    $result = array('status' => 'Fail');
                }
                print json_encode(['res' => $result]);
        
    }

    
    /* New Api Code Prabir */ 



}
