<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
   
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {

		parent::__construct();
	}
	
	public function getExpiredUser(){
        $user_info = $this->db->get_where('user_plan',array('end_date <'=>date('Y-m-d')))->result_array();
        foreach($user_info as $k=>$v){
              
              $tracker_info = $this->db->get_where('users',array('id'=>$v['user_id']))->row();
              $device_token = $tracker_info->device_token;
		      //echo $device_token;
		      $this->load->library('firebase');
		      $result = $this->firebase->send_notification($tracker_info->first_name.' '.$tracker_info->last_name.' trial period has been expired.',$device_token,'Captain India');
		      echo "<pre>";print_r($result);
        }
    }
    
    public function getMorningMessage() {
        $this->db->select('morning_greetings_message.id,morning_greetings_message.message_date,morning_greetings_message.title ,morning_greetings_message.message, morning_greetings_message.tenant_id , morning_greetings_message.created_at ');
        $this->db->from('morning_greetings_message');
        $this->db->where('is_deleted', '0');
        $this->db->where('message_date', date('Y-m-d'));
        $this->db->order_by('message_date', 'desc');
        $query_result = $this->db->get();
        $morning_greetings_message_result = $query_result->row_array();
       // echo $this->db->last_query();exit;
        // print_r($morning_greetings_message_result);
        // die;
        if (count($morning_greetings_message_result)) {
            
            if($morning_greetings_message_result['tenant_id'])
            	
    	
            
            $title = $morning_greetings_message_result['title'];
            $message = $morning_greetings_message_result['message'];
            $this->db->select('device_token');
            
            // 16-jul-2022
            if($morning_greetings_message_result['tenant_id'] !=""   ) {
                $this->db->where('users.tenant_id', $morning_greetings_message_result['tenant_id']);
            }
            $this->db->from('users');
            /////////////////////
        //   $this->db->where('id', 357); //1101 //1142 //357
            $q = $this->db->get();
            $user_info = $q->result_array();
            //echo $this->db->last_query();exit;
            if($user_info) {
                foreach ($user_info as $k => $v) {
                    if($v['device_token']) {
                        $device_token[] = $v['device_token'];
                    }
                }
            }
           // print_r($user_info);
            $this->load->library('firebase');
          $output = $this->firebase->send_notification_to_all_message($message, $device_token, $title);
            print_r($output);
        } else {
            
        }
        die;
    }

    public function getSafetyTips() {
        $this->db->select('safety_tips_message.id,safety_tips_message.message_date,safety_tips_message.title ,safety_tips_message.message , safety_tips_message.tenant_id, safety_tips_message.created_at ');
        $this->db->from('safety_tips_message');
        $this->db->where('is_deleted', '0');
        $this->db->where('message_date', date('Y-m-d'));
        $this->db->order_by('message_date', 'desc');
        $query_result = $this->db->get();
        $morning_greetings_message_result = $query_result->row_array();
    //   print_r($morning_greetings_message_result);
    //     die;
        if (count($morning_greetings_message_result)) {
            $title = $morning_greetings_message_result['title'];
            $message = $morning_greetings_message_result['message'];
            $this->db->select('device_token');
            
              // 16-jul-2022
            if($morning_greetings_message_result['tenant_id'] !=""  ) {
                $this->db->where('users.tenant_id', $morning_greetings_message_result['tenant_id']);
            }
            
            $this->db->from('users');
            /////////////////////////////
            // $this->db->where('id', 1101);
            $q = $this->db->get();
            $user_info = $q->result_array();
            if(count($user_info)) {
                foreach ($user_info as $k => $v) {
                    if( $v['device_token']) {
                        $device_token[] = $v['device_token'];
                    }
                }
            }
        //  print_r($device_token);
            //die;
            $this->load->library('firebase');
             $output = $this->firebase->send_notification_to_all_message($message, $device_token, $title);
            print_r($output);
        }
        die;
    }

    public function getBirthdayGreetings() {
        $this->db->select('device_token, tenant_id');
        $this->db->from('users');
        $this->db->where('month(date_of_birth)', date('m'));
        $this->db->where('day(date_of_birth)', date('d'));
        /////////////////////
        //$this->db->where('id', 1101);
        $q = $this->db->get();
        $user_info = $q->result_array();
        if ($user_info) {
            foreach ($user_info as $row) {
                if( $row['device_token']) {
                    $device_token = $row['device_token'];
                    $this->db->select('*');
                    $this->db->from('birthday_greetings_message');
                    $this->db->where('is_deleted', '0');
                 //   $this->db->order_by("id", "random");
                    $birthday_greetings_message_result = $this->db->get()->row();
                    $title = $birthday_greetings_message_result->title;
                    $message = $birthday_greetings_message_result->message;
                    if ($birthday_greetings_message_result) {
            
          
                        $check_tenant = '0';
                        if($birthday_greetings_message_result->tenant_id !=""  ) {
                            $check_tenant = '1';
                        }
                        
                        if($check_tenant == '1') {
                            if($row['device_token'] == $birthday_greetings_message_result->tenant_id ) {
                                $this->load->library('firebase');
                            $output = $this->firebase->send_notification($message, $device_token, $title);
                            }
                        } else {
                            $this->load->library('firebase');
                            $output = $this->firebase->send_notification($message, $device_token, $title);
                         
                        }
                    }
                }
            }
        }
        die;
    }


    public function getBulletinNews() {
       $this->db->select('bulletin_news.*');
        $this->db->from('bulletin_news');
        $this->db->where('is_deleted', '0');
        $this->db->where('news_date', date('Y-m-d'));
        $this->db->order_by('news_date', 'desc');
        $query_result = $this->db->get();
        $bulletin_news_result = $query_result->row_array();
    //   print_r($bulletin_news_result);
    //     die;
        if (count($bulletin_news_result)) {
            $title = $bulletin_news_result['title'];
            $message = $bulletin_news_result['description'];
           $image_path = $bulletin_news_result['image_path'];

            $this->db->select('device_token');
            // $this->db->select('*');
            $this->db->from('users');
            /////////////////////////////
            // $this->db->where('id', 1101);
            $q = $this->db->get();
            $user_info = $q->result_array();
            // echo '<pre>';
            // print_R($user_info);
            // die;
            if(count($user_info)) {
                foreach ($user_info as $k => $v) {
                    if( $v['device_token']) {
                        $device_token[] = $v['device_token'];
                    }
                }
            }
          //  print_r($title);
            //die;
            $this->load->library('firebase');
            $output = $this->firebase->send_bulletin_news_notification_to_all($message, $device_token, $title, $image_path);
            print_r($output);
        }
        die;
    }
    
    // 10-dec-2021
    // delete bulletin news notification older that 20 days
    public function checkBulletinNotificationOldDelete() {
        $this->db->select('bulletin_news.*');
        $this->db->from('bulletin_news');
        $this->db->where('is_deleted', '0');
        $query_result = $this->db->get();
        $bulletin_news_result = $query_result->result_array();
        $i =1;
        if($bulletin_news_result){
            foreach($bulletin_news_result as $row) {
                $date1 = $row['created_at'];
        		$date2 = date('Y-m-d H:i:s');
                $diff = strtotime($date2) - strtotime($date1);
                $diff_days  = abs(round($diff / 86400));
                if($diff_days >= 20) {
                    $this->db->where('id', $row['id']);
                    $result_update = $this->db->update('bulletin_news', array('is_deleted' => '1'));
                    if($result_update) {
                        echo "$i. Deleted Id => " . $row['id'] .", Created Date => " .$row['created_at']. ", Title => ".$row['title']."\n";
                        $i++;
                    }
                }
            }
        }
        die;
    }

    // 10-dec-2021
    // delete regular notifications older that 20 days
    public function checRegularNotificationOldDelete() {
        $this->db->select('notifications.*');
        $this->db->from('notifications');
        $this->db->where('is_deleted', '0');
        $query_result = $this->db->get();
        $bulletin_news_result = $query_result->result_array();
        $i =1;
        if($bulletin_news_result){
            foreach($bulletin_news_result as $row) {
                $date1 = $row['created_at'];
        		$date2 = date('Y-m-d H:i:s');
                $diff = strtotime($date2) - strtotime($date1);
                $diff_days  = abs(round($diff / 86400));
                if($diff_days >= 20) {
                    $this->db->where('id', $row['id']);
                    $result_update = $this->db->update('notifications', array('is_deleted' => '1'));
                    if($result_update) {
                        echo "$i. Deleted Id => " . $row['id'] .", Created Date => " .$row['created_at']. ", Title => ".$row['title']."\n";
                        $i++;
                    }
                } else {
                    
                }
            }
        }
        die;
    }

}
?>