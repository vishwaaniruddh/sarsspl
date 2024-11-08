<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function add($data,$id)
	{	
		
		foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$data = $this->array_flatten($res);
		//echo "<pre>";print_r($data);exit;
        if($id){
            
            //30-jul-2022
            $admin_select= $data['admin_select'];
            $mobile_no= $data['mobile_no'];
            $this->db->where('users.id', $id);
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
            $res_users = $q->row_array();
                // var_dump($res_users['tenant_id']);
                // print_r($res_users);
                // die;
    	   // if($res_users) {
    	      
    	   //     if  ($res_users['tenant_id'] != $data['tenant_id']) {
    	   //         $this->db->where('id', $id);
        //     		$this->db->update('users',array('is_deleted'=>'1') );
            		
        //     		$insert_data= array(
        //     	 	    'user_type'=>"3",
        //     			'first_name'=>$data['firstname'],
        //     			'middle_name'=>$data['middlename'],
        //     			'last_name'=>$data['lastname'],
        //     			'email'=>$data['email'],
        //     			'age'=>$data['age'],
        //     			'gender'=>$data['gender'],
        //     			'mobile_no'=>$data['mobile_no'],
        //     			'blood_group'=>$data['blood_group'],
        //     			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
        //     			'status'=>$data['status'],
        //     		    'city'=>$data['city'],
        //     			'tenant_id'=>$data['admin_select'],
        // 		    );
        // 		    $this->db->insert('users',$insert_data);
        //     		$uid= $this->db->insert_id();
        //     		if($uid){
        //     		    if($data['reporting_manager_sap_code']){
        //     		        $array = explode('-',$data['reporting_manager_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'1'));
        //     		    }
        //     		    if($data['reviewing_manager_sap_code']){
        //     		        $array = explode('-',$data['reviewing_manager_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'2'));
        //     		    }
        //     		    if($data['ho_poc_sap_code']){
        //     		        $array = explode('-',$data['ho_poc_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'3'));
        //     		    }
        //     		    if($data['department_head_sap_code']){
        //     		        $array = explode('-',$data['department_head_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'4'));
        //     		    }
        //     		}
    	   //     } else {
    	   //          $update_data= array(
 
        //     			'first_name'=>$data['firstname'],
        //     			'middle_name'=>$data['middlename'],
        //     			'last_name'=>$data['lastname'],
        //     			'email'=>$data['email'],
        //     			'age'=>$data['age'],
        //     			'gender'=>$data['gender'],
            	 
        //     			'mobile_no'=>$data['mobile_no'],
            	 
        //     			'blood_group'=>$data['blood_group'],
            	 
        //     			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
        //     			'status'=>$data['status'],
        //     			'city'=>$data['city'],
            
        //     		);
        //     		$this->db->where('id',$id);
        //     		$this->db->update('users',$update_data);//echo $this->db->last_query();exit;
        //     		if($id){
        //     		    $this->db->where('user_id',$id);
        //     		    $this->db->delete('emergency_contacts');
            		
        //     		   if($data['reporting_manager_sap_code']){
        //     		        $array = explode('-',$data['reporting_manager_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'1'));
            		    
        //     		    }
        //     		    if($data['reviewing_manager_sap_code']){
        //     		        $array = explode('-',$data['reviewing_manager_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'2'));
            		    
        //     		    }
        //     		    if($data['ho_poc_sap_code']){
        //     		        $array = explode('-',$data['ho_poc_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'3'));
            		    
        //     		    }
        //     		    if($data['department_head_sap_code']){
        //     		        $array = explode('-',$data['department_head_sap_code']);
        //     		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        //     		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'4'));
            		    
        //     		    }
        //     		}
    	   //     }
    	        
    	   // } else {
            $update_data= array(

		//	'user_type'=>$data['user_type'],
		//	'sap_code'=>$data['sapcode'],
			'first_name'=>$data['firstname'],
			'middle_name'=>$data['middlename'],
			'last_name'=>$data['lastname'],
			'email'=>$data['email'],
			'age'=>$data['age'],
			'gender'=>$data['gender'],
		//	'branch_name'=>$data['branch_name'],
		//	'department'=>$data['department'],
		//	'designation'=>$data['designation'],
			'mobile_no'=>$data['mobile_no'],
		//	'vertical'=>$data['vertical'],
			'blood_group'=>$data['blood_group'],
		//	'mpin'=>$data['mpin'],
			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
// 			'reporting_manager_sap_code'=>$data['reporting_manager_sap_code'],
// 			'reporting_manager_name'=>$data['reporting_manager_name'],
// 			'reviewing_manager_sap_code'=>$data['reviewing_manager_sap_code'],
// 			'reviewing_manager_name'=>$data['reviewing_manager_name'],
// 			'ho_poc_sap_code'=>$data['ho_poc_sap_code'],
// 			'ho_poc_name'=>$data['ho_poc_name'],
// 			'department_head_sap_code'=>$data['department_head_sap_code'],
// 			'department_head_name'=>$data['department_head_name'],
			'status'=>$data['status'],
			'city'=>$data['city'],

		);
		$this->db->where('id',$id);
		$this->db->update('users',$update_data);//echo $this->db->last_query();exit;
		if($id){
		    $this->db->where('user_id',$id);
		    $this->db->delete('emergency_contacts');
		
		   if($data['reporting_manager_sap_code']){
		        $array = explode('-',$data['reporting_manager_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'1'));
		    
		    }
		    if($data['reviewing_manager_sap_code']){
		        $array = explode('-',$data['reviewing_manager_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'2'));
		    
		    }
		    if($data['ho_poc_sap_code']){
		        $array = explode('-',$data['ho_poc_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'3'));
		    
		    }
		    if($data['department_head_sap_code']){
		        $array = explode('-',$data['department_head_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'4'));
		    
		    }
		}
    	   // }
        }else{
		$insert_data= array(

		//	'user_type'=>$data['user_type'],
		//	'sap_code'=>$data['sapcode'],
			'first_name'=>$data['firstname'],
			'middle_name'=>$data['middlename'],
			'last_name'=>$data['lastname'],
			'email'=>$data['email'],
			'age'=>$data['age'],
			'gender'=>$data['gender'],
// 			'branch_name'=>$data['branch_name'],
// 			'department'=>$data['department'],
// 			'designation'=>$data['designation'],
			'mobile_no'=>$data['mobile_no'],
		//	'vertical'=>$data['vertical'],
			'blood_group'=>$data['blood_group'],
			//'mpin'=>$data['mpin'],
			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
// 			'reporting_manager_sap_code'=>$data['reporting_manager_sap_code'],
// 			'reporting_manager_name'=>$data['reporting_manager_name'],
// 			'reviewing_manager_sap_code'=>$data['reviewing_manager_sap_code'],
// 			'reviewing_manager_name'=>$data['reviewing_manager_name'],
// 			'ho_poc_sap_code'=>$data['ho_poc_sap_code'],
// 			'ho_poc_name'=>$data['ho_poc_name'],
// 			'department_head_sap_code'=>$data['department_head_sap_code'],
// 			'department_head_name'=>$data['department_head_name'],
			'status'=>$data['status']

		);
		$this->db->insert('users',$insert_data);
		$uid= $this->db->insert_id();
		if($uid){
		    if($data['reporting_manager_sap_code']){
		        $array = explode('-',$data['reporting_manager_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'1'));
		    
		    }
		    if($data['reviewing_manager_sap_code']){
		        $array = explode('-',$data['reviewing_manager_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'2'));
		    
		    }
		    if($data['ho_poc_sap_code']){
		        $array = explode('-',$data['ho_poc_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'3'));
		    
		    }
		    if($data['department_head_sap_code']){
		        $array = explode('-',$data['department_head_sap_code']);
		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'4'));
		    
		    }
		
		}
        }
		//echo $this->db->last_query();exit;
	//	if($this->db->affected_rows() > 0){
		if($id || $uid){
			return true;
		}else{
			return false;
		}
	}
	
	public function getUsersCSV()
	{	
		$this->db->select("m.id as uid,CONCAT(first_name, ' ', last_name) AS name,m.email,m.mobile_no,m.date_of_birth as dob,m.status,m.gender,m.first_name,m.last_name");
		$this->db->from('users as m');
		$this->db->where('m.is_deleted','0');
		$this->db->where('m.user_type','3');
		$this->db->where('m.email !=','');
// 		if($page && $per_page){
// 		    if($page =='1')
// 		    $this->db->limit($per_page,$page-1);
// 		    else
// 		    $this->db->limit($per_page,($page-1)*$per_page);
		    
// 		}
// 		if($filter){
//             $this->db->like('m.title', $filter, 'both'); 
//         }
		$this->db->order_by('m.id','desc');
		$this->db->group_by('m.id');
		$q = $this->db->get()->result();
		foreach($q as $k=>$v){
		    if($q[$k]->name==''){
		    $q[$k]->name = $q[$k]->first_name;
		    }
		    $q[$k]->gender = $v->gender=='1' ? 'Male' : 'Female';
		    if($v->status =='1' ){
		        $q[$k]->status = 'Active';
		    }else if($v->status =='2' ){
		        $q[$k]->status = 'In-Active';
		    }else{
		        $q[$k]->status ='Suspended';
		    }
		    
		}
		return $q;
	}

	
	public function addLocation($data,$id)
	{	
		
		foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$data = $this->array_flatten($res);
		//echo "<pre>";print_r($data);exit;
		
        //7-jun-2022
	    date_default_timezone_set('Asia/Kolkata');

        if($id){
            $update_data= array(

		//	'user_type'=>$data['user_type'],
			'branch_code'=>$data['branchcode'],
			'branch_name'=>$data['branchname'],
			'region_name'=>$data['district'],
			'state_name'=>$data['country'],
			'zone_name'=>$data['states'],
			//'created_at' => date('Y-m-d H:i:s'),// 7-jun-2022

		);
		$this->db->where('id',$id);
		$this->db->update('user_locations',$update_data);
        }else{
		$insert_data= array(

		//	'user_type'=>$data['user_type'],
			'branch_code'=>$data['branchcode'],
			'branch_name'=>$data['branchname'],
			'region_name'=>$data['district'],
			'state_name'=>$data['country'],
			'zone_name'=>$data['states'],
			

		);
		$this->db->insert('user_locations',$insert_data);
        }
		//echo $this->db->last_query();exit;
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	public function addGroupLocation($data,$uid)
	{	
		if($uid){
		    $update_data= array(
    		//	'user_type'=>$data['user_type'],
    			'title'=>$data->title
    		);
    		$this->db->where('id',$uid);
    		$this->db->update('user_group_locations',$update_data);
    		if($uid){
    		    $this->db->where('group_location_id',$uid);
    		    $this->db->delete('user_group_branch');
    		
    		    $locations = $data->locations;
    		    for($i=0;$i<count($locations);$i++){
    		        $codes = explode('-',$locations[$i]);
    		        $lid = $this->db->get_where('user_locations',array('branch_code'=>$codes['0']))->row()->id;
        		    $insert_data= array(
        	   			'group_location_id'=>$uid,
        	   			'location_id'=>$lid
        		    );
        		    $this->db->insert('user_group_branch',$insert_data);
        		    
    		    }
    		}
		}else{
    		$insert_data= array(
    		//	'user_type'=>$data['user_type'],
    			'title'=>$data->title
    		);
    		$this->db->insert('user_group_locations',$insert_data);
    		$id = $this->db->insert_id();
    		if($id){
    		    $locations = $data->locations;
    		    for($i=0;$i<count($locations);$i++){
    		        $codes = explode('-',$locations[$i]);
    		        $lid = $this->db->get_where('user_locations',array('branch_code'=>$codes['0']))->row()->id;
        		    $insert_data= array(
        	   			'group_location_id'=>$id,
        	   			'location_id'=>$lid
        		    );
        		    $this->db->insert('user_group_branch',$insert_data);
        		    
    		    }
    		}
		}
		//echo $this->db->last_query();exit;
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	
	}
	
	public function add_admin($data,$id)
	{	
		
		foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$data = $this->array_flatten($res);
		//echo "<pre>";print_r($data);exit;
		
		// START - 8-jun-2022
    		date_default_timezone_set('Asia/Kolkata');
    	
    	
        if($id){
            
            //   if change password
            $change_password = "0";
            $res_admin = $this->getUpdateAdminInfo($id);
            if($res_admin->password != $data['password'] ) {
                $change_password = "1";
            }
            $update_data= array(			
    			'first_name'=>$data['firstname'],
    			'middle_name'=>$data['middlename'],
    			'last_name'=>$data['lastname'],
    			'email'=>$data['email'],
    			'age'=>$data['age'],
    			'gender'=>$data['gender'],
    			'mobile_no'=>$data['mobile_no'],
    			'user_name'=>$data['username'],
    			'password'=>$data['password'],
    			'blood_group'=>$data['blood_group'],
    			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    			'status'=>$data['status'],
    			'tenant_code'=>$data['tenant_code'],
    			
    			//14-jul-2022
			    'address'=>$data['address'],
			
    		    //	START - 8-jun-2022
    		    'modified_at'=>date('Y-m-d H:i:s')
    		);
    		$this->db->where('id',$id);
    		$this->db->update('user_admin',$update_data);
    		
    		if($change_password == "1") {
        		$this->addTenantEmail($id, 'Password Changed');
    		}
        }else{
    		$insert_data= array(			
    			'first_name'=>$data['firstname'],
    			'middle_name'=>$data['middlename'],
    			'last_name'=>$data['lastname'],
    			'email'=>$data['email'],
    			'age'=>$data['age'],
    			'gender'=>$data['gender'],
    			'mobile_no'=>$data['mobile_no'],
    			'user_name'=>$data['username'],
    			'password'=>$data['password'],
    			'blood_group'=>$data['blood_group'],
    			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    			'status'=>$data['status'],
    			'tenant_code'=>$data['tenant_code'],
    			
    			//14-jul-2022
    			'user_type' => '2',
			    'address'=>$data['address'],
			
    			//	START - 8-jun-2022
    			'created_at'=>date('Y-m-d H:i:s'),
    			'modified_at'=>date('Y-m-d H:i:s')
    		);
    		$this->db->insert('user_admin',$insert_data);
    		
    		// email when add tenant
    		if($this->db->insert_id()) {
        		$inserted_user_id = $this->db->insert_id();
        		$this->addTenantEmail($inserted_user_id, 'Registration');
    		}
        }
		
		//echo $this->db->last_query();exit;
		//if($this->db->affected_rows() > 0){
		if(1){
			return true;
		}else{
			return false;
		}
	}

    // 14-jil-2022
    // send mail to user tenant admin
    public function addTenantEmail($inserted_user_id, $mail_subject ="") {
        $user_admin_res = $this->db->get_where('user_admin', array('id' => $inserted_user_id))->row();
        if ($user_admin_res->email != null || $user_admin_res->email !="") {
            if($user_admin_res->blood_group) {
                if($user_admin_res->blood_group == 1  ) {
                    $blood_group = 'A+';
                } else if ( $user_admin_res->blood_group == 2 ){
                    $blood_group = 'B+';
                } else if ( $user_admin_res->blood_group == 3 ){
                    $blood_group = 'O+';
                } else if( $user_admin_res->blood_group  == 4 ){
                    $blood_group='AB+';
                } else if( $user_admin_res->blood_group == 5 ){
                    $blood_group='A-';
                } else if( $user_admin_res->blood_group == 6 ){
                    $blood_group='B-';
                } else if( $user_admin_res->blood_group == 7 ){
                    $blood_group='O-';
                } else if( $user_admin_res->blood_group == 8 ){
                    $blood_group='AB-';
                } else {
                    $blood_group=''; 
                }
            }
            $status = '';
            if($user_admin_res->status) {
                if(  $user_admin_res->status  ==1){
    	            $status = 'Active';
    	        } else if ($user_admin_res->status ==2){
    	            $status ='Inactive';
    	        } else if ($user_admin_res->status ==3){
    	            $status ='Suspended';
    	        }
            }
            $gender = $user_admin_res->gender == 1 ? 'Male' : 'Female';
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
            $subject = $mail_subject ? $mail_subject : 'Registration';
            $message = "Hello ". $user_admin_res->first_name." ". $user_admin_res->last_name.",<br>" . "<br>"  ;
            $message .=  'This is login details and login URL.';
            $message .= "<br>" . "<br>". 'Username: '. $user_admin_res->user_name;
            $message .= "<br>" . "<br>". 'Password: '. $user_admin_res->password;
            // $message .= "<br>" . "<br>". 'First Name: '. $user_admin_res->first_name;
            // $message .= "<br>" . "<br>". 'Middle Name: '. $user_admin_res->middle_name;
            // $message .= "<br>" . "<br>". 'Last Name: '. $user_admin_res->last_name;
            // $message .= "<br>" . "<br>". 'Email: '. $user_admin_res->email;
            // $message .= "<br>" . "<br>". 'Mobile No.: '. $user_admin_res->mobile_no;
            // $message .= "<br>" . "<br>". 'Age: '. $user_admin_res->age;
            // $message .= "<br>" . "<br>". 'Gender: '. $gender;
            // $message .= "<br>" . "<br>". 'Blood Group: '. $blood_group;
            // $message .= "<br>" . "<br>". 'Date Of Birth: '. $user_admin_res->date_of_birth;
            // $message .= "<br>" . "<br>". 'Tenant code: '. $user_admin_res->tenant_code;
            // $message .= "<br>" . "<br>". 'Address: '. $user_admin_res->address;
            // $message .= "<br>" . "<br>". 'Status: '. $status;
            $message .= "<br>" . "<br>".'This is login URL'."<br>";
            $base_url_value = rtrim(base_url(),"/backend/");
            $message .= "<br>" . 'Click for login <a href="'.$base_url_value.'" target="_blank">'.$base_url_value.'</a>'."<br>";
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
	public function getAdmin()
	{	
		$this->db->select('id as uid,first_name,middle_name,last_name,email,mobile_no,gender,age,blood_group,date_of_birth,status');
		$this->db->where('is_deleted','0');
		//$this->db->group_by('type_id');
		return $this->db->get('user_admin')->result_array();
	}
	
	public function getDeclinedUser($session_id)
	{	
	    
		$this->db->where('session_id',$session_id);
		$this->db->where('is_declined','1');
		return $this->db->get('tmp_employees')->result_array();
	}
	
	public function getLocationDeclinedUser($session_id)
	{	
	    
		$this->db->where('session_id',$session_id);
		$this->db->where('is_declined','1');
		return $this->db->get('tmp_location')->result_array();
	}
	
	public function getUserCopEvidence()
	{
		$this->db->select('panic_request.id,panic_request.user_id as first_name,users.last_name,users.mobile_no,users.email,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp as created_at');
		$this->db->from('panic_request');
		$this->db->join('user_multimedia','panic_request.id = user_multimedia.panic_id','left');
		$this->db->join('users','users.id = user_multimedia.user_id','left');
		$this->db->where('users.is_deleted','0');
		$this->db->where('user_multimedia.module_type','2');
		$this->db->where('user_multimedia.content_type','3');
		$this->db->order_by('timestamp','desc');
		$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getNotifications($tid = '')
	{
		$this->db->select('id,type,locations,title,message');
		$this->db->from('notifications');
		$this->db->where('is_deleted','0');
		
		 // 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            $this->db->where('tenant_id', $tid);
        }
		$this->db->order_by('id','desc');
	//	$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getPreTriggerNotifications($tid='')
	{
		$this->db->select('*');
		$this->db->from('pre_trigger_notifications');
	
		$this->db->order_by('pre_trigger_notifications.id','desc');
	//	$this->db->group_by('panic_request.id');
		$this->db->group_by('pre_trigger_notifications.user_id'); // added 3-7-2021
		$this->db->group_by('pre_trigger_notifications.pre_trigger_id'); // added 3-7-2021
		
		     		$this->db->where('pre_trigger_notifications.user_id !=','0');

	    // 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
        $this->db->join('users','users.id = pre_trigger_notifications.user_id','left');
        }
        
		$q = $this->db->get();
        //echo $this->db->last_query();exit;
		 $res =  $q->result_array();
		 
            foreach($res as $key =>  $row) {
                 if($row['pre_trigger_id'] !="") {
                     $this->db->select('pre_trigger_notifications.status_stop_date');
                    $this->db->from('pre_trigger_notifications');
                     if ((isset($row['pre_trigger_id'] ) ) || ($row['pre_trigger_id']  != "")) {
                        $this->db->where('pre_trigger_notifications.pre_trigger_id', $row['pre_trigger_id']);
                        $this->db->where('pre_trigger_notifications.status',"1");

                    }
                     $q = $this->db->get();
                    $res2 =  $q->row_array();
                    
                    // 7-jul-2022
                     if ((isset($row['tracking_id'] ) ) || ($row['tracking_id']  != "")) {
                        $this->db->select('tracking.start_time as tracking_start_time, tracking.end_time as tracking_end_time');
                        $this->db->from('tracking');
                        $this->db->where('tracking.id', $row['tracking_id']);
                        $q = $this->db->get();
                        $res_tracking =  $q->row_array();
                    }
                     
                    
                }
                    $res[$key]['status_stop_date']=isset($res2['status_stop_date']) ?  ($res2['status_stop_date']) : "" ;
                    
                     $res[$key]['tracking_start_time']=isset($res_tracking['tracking_start_time']) ? $res_tracking['tracking_start_time'] : '';
                     $res[$key]['tracking_end_time']=isset($res_tracking['tracking_end_time']) ? $res_tracking['tracking_end_time'] : '';

            }
		return $res;
	}
	
	
	public function getTracking($tid)
	{
		$this->db->select('*');
		$this->db->from('tracking');
		$this->db->where('tracking.mode_backend','1');
	
	// 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
        $this->db->join('users','users.id = tracking.trackee_id','left');
        }
        
        
		$this->db->order_by('tracking.id','desc');
	//	$this->db->group_by('panic_request.id');
		$q = $this->db->get(); //echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	// added on - 22-07-2021
	public function getFollowMe() {
		$this->db->select('*');
		$this->db->from('tracking');
		//$this->db->where('mode','2');
	    $this->db->where('mode_backend','2');
		$this->db->order_by('id','desc');
	//	$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	
	public function getQueries(){
	    
	    $this->db->select('queries.id,queries.user_id as first_name,users.last_name,queries.created_at,queries.description,query_type.title as type');
		$this->db->from('queries');
		$this->db->join('users','users.id = queries.user_id','left');
		$this->db->join('query_type','query_type.id = queries.type','left');
		$this->db->where('users.is_deleted','0');
		$this->db->order_by('created_at','desc');
		$this->db->group_by('queries.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array(); 
		
	}

	public function getUserLocations()
	{
		//$this->db->select('panic_request.id,users.first_name,users.last_name,sap_code,users.mobile_no,users.email,user_multimedia.user_lat,user_multimedia.user_long,timestamp as created_at');
		$this->db->select('id,branch_code,branch_name,region_name,zone_name,state_name');
		$this->db->from('user_locations');
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','desc');
		//$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getUserGroupLocations(){
	    //$this->db->select('panic_request.id,users.first_name,users.last_name,sap_code,users.mobile_no,users.email,user_multimedia.user_lat,user_multimedia.user_long,timestamp as created_at');
		$this->db->select('gl.id,gl.title');
		$this->db->from('user_group_locations as gl');
		//$this->db->join('user_group_branch as gb','gl.id=gb.location_id','left');
		$this->db->where('is_deleted','0');
		$this->db->order_by('gl.id','desc');
		$this->db->group_by('gl.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getCountries(){
	    $this->db->select('id,country_name');
		$this->db->from('countries');
	//	$this->db->where('is_deleted','0');
	//	$this->db->order_by('id','desc');
		//$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getStates($id){
	    $this->db->select('StateID,StateName');
		$this->db->from('states');
	//	if($id){
		    $this->db->where('CountryID',$id);
	//	}
	//	$this->db->order_by('id','desc');
		//$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getAllSAPCode(){
	    $this->db->select('mobile_no,first_name,last_name');
		$this->db->from('users');
		$this->db->where('users.is_deleted','0');

		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getGLocations(){
	    //$this->db->select('sap_code,first_name,last_name');
		$this->db->from('user_group_locations');
		$this->db->where('is_deleted','0');
	
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getAllBranchCode(){
	    $this->db->select('branch_code,branch_name');
		$this->db->from('user_locations');
		$this->db->where('is_deleted','0');
	
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getDistrict($id){
	    $this->db->select('id,name');
		$this->db->from('district');
	//	if($id){
		    $this->db->where('region_id',$id);
	//	}
	//	$this->db->where('is_deleted','0');
	//	$this->db->order_by('id','desc');
		//$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getBranch(){
	    $this->db->select('id,branch_name as name');
		$this->db->from('user_locations');
	//	$this->db->where('is_deleted','0');
	//	$this->db->order_by('id','desc');
		//$this->db->group_by('panic_request.id');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function getUserEvidence($tid='')
	{
		$this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp, user_multimedia.content_type, user_multimedia.module_type, user_multimedia.followme_id, user_multimedia.followme_safe_status');
		$this->db->from('panic_request');
		$this->db->join('user_multimedia','user_multimedia.panic_id = panic_request.id','left');
		$this->db->join('users','users.id = user_multimedia.user_id','left');
		
	    // 14-jul-2022
       if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
        }
       
		$this->db->where('users.is_deleted','0');
		
		
		$this->db->where('user_multimedia.module_type','1');
		//$this->db->where('user_multimedia.content_type','3');
		

		$this->db->or_where('user_multimedia.module_type','4');

        
		$this->db->group_by('panic_request.id');
		$this->db->order_by('timestamp','desc');
		$q = $this->db->get(); //echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	
	public function getUserImages($id){
	    
	    $this->db->where('content_type','1');
	    $this->db->where('module_type','1');
	    
		$this->db->where('panic_id',$id);
	//	$this->db->limit('1');
		return $this->db->get('user_multimedia')->result_array();
	}
	
	public function getUserVideos($id){
	    
	    $this->db->where('content_type','3');
	    $this->db->where('module_type','1');
		$this->db->where('panic_id',$id);
	//	$this->db->limit('1');
		return $this->db->get('user_multimedia')->result_array();
	}
	
	public function getUserAudios($id){
	    
	    $this->db->where('content_type','2');
	    $this->db->where('module_type','1');
		$this->db->where('panic_id',$id);
	//	$this->db->limit('1');
		return $this->db->get('user_multimedia')->result_array();
	}
	
	public function getUserCopVideos($id){
	    
	    $this->db->select('user_multimedia.*,query_type.title as type');
	    $this->db->from('user_multimedia');
	    $this->db->join('query_type','query_type.id = user_multimedia.type','left');
	    $this->db->where('content_type','3');
	    $this->db->where('module_type','2');
		$this->db->where('panic_id',$id);
	//	$this->db->limit('1');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	public function addTempData($insert_data,$session_id){
		//echo session_id();exit;
		//$session_id = $this->session->userdata('session_id');
		
	    $data = array(
	        'sap_code'=>$insert_data['0'],
	        'first_name'=>$insert_data['1'],
	        'middle_name'=>$insert_data['2'],
	        'last_name'=>$insert_data['3'],
	        'mobile'=>$insert_data['4'],
	        'email'=>$insert_data['5'],
	        'designation'=>$insert_data['6'],
	        'department'=>$insert_data['7'],
	        //'cost_center_text'=>$insert_data['8'],
	        'gender'=>$insert_data['8'],
	        'blood_group'=>$insert_data['9'],
	        'age'=>$insert_data['10'],
	        'dob'=>date('Y-m-d',strtotime($insert_data['11'])),
	        'branch_name'=>$insert_data['12'],
	        'contact_1'=>$insert_data['13'],
	        'contact_2'=>$insert_data['14'],
	        'contact_3'=>$insert_data['15'],
	        'contact_4'=>$insert_data['16'],
	        'status'=>$insert_data['17'],
	       // 'contact_5'=>$insert_data['18'],
	        //'contact_6'=>$insert_data['19'],
	        'session_id'=>$session_id,
	    );
	    $this->db->insert('tmp_employees',$data);
	  
	    return $this->db->insert_id();
	}

	public function addLocationTempData($insert_data,$session_id){
		//echo session_id();exit;
		//$session_id = $this->session->userdata('session_id');
		
	    $data = array(
	        'branch_code'=>$insert_data['0'],
	        'branch_name'=>$insert_data['1'],
	        'region_name'=>$insert_data['2'],
	        'zone_name'=>$insert_data['3'],
	        'state_name'=>$insert_data['4'],
	        'session_id'=>$session_id,
	    );
	    $this->db->insert('tmp_location',$data);
	  
	    return $this->db->insert_id();
	}

	public function removeTempData($session_id){

		$this->db->where('is_declined','0');
		$this->db->where('session_id',$session_id);
		$this->db->delete('tmp_employees');//echo $this->db->last_query();exit;
	    return true;
	}

	public function removeLocationTempData($session_id){

		$this->db->where('session_id',$session_id);
		$this->db->truncate('tmp_location');
	    return true;
	}
	
	public function getUsers($status='',$plan='',$tid,$selected_tenant='')
	{	
		$this->db->select('users.id as uid,users.first_name,users.middle_name,users.last_name,users.email,users.mobile_no,users.gender,users.date_of_birth,users.status');
		if($plan){
		    $this->db->join('user_plan','user_plan.user_id = users.id','left');
		    $this->db->where('plan_id',$plan);
		}
		$this->db->where('users.is_deleted','0');
		$this->db->where('users.user_type','3');
		$this->db->where('users.email !=','');
		
		
		$this->db->where('users.tenant_id is NOT NULL', NULL, FALSE);
		// 14-jul-2022
      if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
      }
        // 16-jul-2022
        if($selected_tenant !=""  ) {
            $this->db->where('users.tenant_id', $selected_tenant);
        }
        
        
		if($status){
		//	if($status =='1')
			$this->db->where('users.status',$status);
// 		else
// 			$this->db->where('status','0');
		}
		$this->db->order_by('users.id','desc');
		//$this->db->group_by('type_id');
	    $res = $this->db->get('users')->result_array();
	   // echo $this->db->last_query();exit;
	    return $res;
	}
	
	public function getTmpUsers($session_id)
	{	
		$this->db->select('id,first_name,middle_name,last_name,sap_code,email,mobile,designation,department,gender,dob,branch_name,age,status,contact_1,contact_2,contact_3,contact_4');
		//$this->db->where('is_deleted','0');
		//$this->db->group_by('type_id');
		$this->db->where('session_id',$session_id);
		return $this->db->get('tmp_employees')->result_array();
	}
	
	public function getPlanDetails($id){
	    
	    $this->db->from('user_plan');
	    $this->db->join('plan_master','plan_master.id = user_plan.plan_id','left');
	    $q = $this->db->get();
	    return $q->row_array();
	    
	}
	
	public function getPlans(){
	    
	    $this->db->from('plan_master');
	    $q = $this->db->get();
	    return $q->result_array();
	    
	}
	
	public function getAllTmpUsers($session_id)
	{	
		//$this->db->select('id,first_name,middle_name,last_name,email,mobile,designation,sap_code,department,gender,dob,branch_name,age,blood_group,cost_center_text');
		//$this->db->where('is_deleted','0');
		//$this->db->group_by('type_id');
		$this->db->where('session_id',$session_id);
		return $this->db->get('tmp_employees')->result_array();
	}

	public function getLocationTmpUsers($session_id)
	{	
		$this->db->select('id,branch_code,branch_name,region_name,zone_name,state_name');
		//$this->db->where('is_deleted','0');
		//$this->db->group_by('type_id');
		$this->db->where('session_id',$session_id);
		return $this->db->get('tmp_location')->result_array();
	}
	
	public function saveImportData($session_id){
	    error_reporting(0);

		// if($v['branch_name']){
  //   		$v['branch_name'] = $this->db->get_where('user_locations',array('branch_code'=>$v['branch_name']))->row()->id;
  //   	}

	    $data= $this->getAllTmpUsers($session_id);
	 // echo "<pre>";print_r($data);
	    foreach($data as $k=>$v){
	       // echo 'hjhkj : '.strtolower(trim($v['status']));//exit;
	        if(strtolower(trim($v['status'])) =='active'){
	            $status = '1';
	        }else if(strtolower(trim($v['status'])) =='inactive'){
	            $status ='2';
	        }else if(strtolower(trim($v['status'])) =='suspended'){
	            $status ='3';
	        }
	        //echo $status;exit;
	     if($v['blood_group'] == 'A+'){
		     $blood_group='1';
		 }else if($v['blood_group'] == 'B+'){
		    $blood_group='2';
		 }else if($v['blood_group'] == 'O+'){
		    $blood_group='3';
		 }else if($v['blood_group'] == 'AB+'){
		    $blood_group='4';
		 }else if($v['blood_group'] == 'A-'){
		    $blood_group='5';
		 }else if($v['blood_group'] == 'B-'){
		    $blood_group='6';
		 }else if($v['blood_group'] == 'O-'){
		    $blood_group='7';
		 }else if($v['blood_group'] == 'AB-'){
		     $blood_group='8';
		 }
            $ec1_info = $this->db->get_where('users',array('sap_code'=>trim($v['contact_1'])))->row();
            $ec1 = $ec1_info->id;//echo "<pre>";print_r($ec1);exit;
            $ec2_info = $this->db->get_where('users',array('sap_code'=>trim($v['contact_2'])))->row();
            $ec2 = $ec2_info->id;
            $ec3_info = $this->db->get_where('users',array('sap_code'=>trim($v['contact_3'])))->row();
            $ec3 = $ec3_info->id;
            $ec4_info = $this->db->get_where('users',array('sap_code'=>trim($v['contact_4'])))->row();
            $ec4 = $ec4_info->id;
            if($v['sap_code'] && $v['first_name'] && $v['last_name'] && $v['contact_1'] && $v['contact_2'] && $v['contact_3'] && $v['contact_4'] && $v['mobile']){
			
	    	$search = $this->searchData($v['sap_code']);
	    	if($search){
	    	    
	    		$update_data = array(
		            'sap_code'=>$v['sap_code'],
			        'first_name'=>$v['first_name'],
			        'middle_name'=>$v['middle_name'],
			        'last_name'=>$v['last_name'],
			        'mobile_no'=>$v['mobile'],
			        'designation'=>$v['designation'],
			        'department'=>$v['department'],
			        //'cost_center_text'=>$v['cost_center_text'],
			        'gender'=>$v['gender'],
			        'date_of_birth'=>$v['dob'],
			        'age'=>$v['age'],
			        'blood_group'=>$blood_group,
			        'reporting_manager_sap_code'=>$v['contact_1'],
			        'reviewing_manager_sap_code'=>$v['contact_2'],
			        'ho_poc_sap_code'=>$v['contact_3'],
			        'department_head_sap_code'=>$v['contact_4'],
			        'branch_name'=>$v['branch_name'],
			        'status'=>$status,
			        'email'=>$v['email']
					        );
					        
	    		$this->db->where('id',$search);
	        	$this->db->update('users',$update_data);
	        	 //echo $this->db->last_query();exit;
	        	$this->db->where('user_id',$search);
	        	$this->db->delete('emergency_contacts');
	        	for($i=1;$i<=4;$i++){
	                $var = 'ec'.$i;
	                if(${$var})
	                $this->db->insert('emergency_contacts',array('user_id'=>$search,'emergency_user_id'=>${$var},'serial_no'=>$i));
	               
	            }
	        
	    	}else{
	        
	        $insert_data = array(
	            'sap_code'=>$v['sap_code'],
		        'first_name'=>$v['first_name'],
		        'middle_name'=>$v['middle_name'],
		        'last_name'=>$v['last_name'],
		        'mobile_no'=>$v['mobile'],
		        'designation'=>$v['designation'],
		        'date_of_birth'=>$v['dob'],
		        'department'=>$v['department'],
		       // 'cost_center_text'=>$v['cost_center_text'],
		        'gender'=>$v['gender'],
		        'age'=>$v['age'],
		        'blood_group'=>$blood_group,
		        'branch_name'=>$v['branch_name'],
		        'reporting_manager_sap_code'=>$v['contact_1'],
			    'reviewing_manager_sap_code'=>$v['contact_2'],
			    'ho_poc_sap_code'=>$v['contact_3'],
			    'department_head_sap_code'=>$v['contact_4'],
		        'email'=>$v['email'],
		        'status'=>$status
	        );
	        
	        $this->db->insert('users',$insert_data);
	        $id = $this->db->insert_id();
	        for($i=1;$i<=4;$i++){
	            $var = 'ec'.$i;
	            $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$var,'serial_no'=>$i));
	        }
	    }
            
                
            }else{
                $this->db->where('id',$v['id']);
                $this->db->update('tmp_employees',array('is_declined'=>'1'));
            }
	       // echo $this->db->last_query();exit;
	    }
	    return $this->db->affected_rows();
	}

	public function saveLocationImportData($session_id){

	    $data= $this->getLocationTmpUsers($session_id);
	  
	    foreach($data as $k=>$v){

	    	$search = $this->searchLocationData($v['branch_code']);
	    	if($search){
	    		$update_data = array('branch_code'=>$v['branch_code'],
					        'branch_name'=>$v['branch_name'],
					        'region_name'=>$v['region_name'],
					        'zone_name'=>$v['zone_name'],
					        'state_name'=>$v['state_name']);
	    		$this->db->where('id',$search);
	        	$this->db->update('user_locations',$update_data);
	    	}else{
	        
	        $insert_data = array('branch_code'=>$v['branch_code'],
	        'branch_name'=>$v['branch_name'],
	        'region_name'=>$v['region_name'],
	        'zone_name'=>$v['zone_name'],
	        'state_name'=>$v['state_name']);
	        $this->db->insert('user_locations',$insert_data);
	    }
	       // echo $this->db->last_query();exit;
	    }
	    return $this->db->affected_rows();
	}


	public function searchData($code){

		$this->db->from('users');
		$this->db->where('sap_code',$code);

		$q = $this->db->get();
		if($q->num_rows() > 0){

			return $q->row()->id;
		
		}else{

			return 0;

		}


	}

	public function searchLocationData($code){

		$this->db->from('user_locations');
		$this->db->where('branch_code',$code);
		$this->db->where('is_deleted','0');

		$q = $this->db->get();
		if($q->num_rows() > 0){

			return $q->row()->id;
		
		}else{

			return 0;

		}


	}

	public function deleteUser($id)
	{	
		$this->db->where('id',$id);
		return $this->db->update('users',array('is_deleted'=>'1'));
	}
	
	public function deleteLocation($id)
	{	
		$this->db->where('id',$id);
		return $this->db->update('user_locations',array('is_deleted'=>'1'));
	}
	
	public function deleteGroupLocation($id)
	{	
		$this->db->where('id',$id);
		return $this->db->update('user_group_locations',array('is_deleted'=>'1'));
	}
	
	public function deleteAdmin($id)
	{	
		$this->db->where('id',$id);
		return $this->db->update('user_admin',array('is_deleted'=>'1'));
	}


	public function getUserInfo($id = '')
	{
		//$this->db->where('is_deleted','0');
		$this->db->where('panic_request.id',$id);
		$this->db->from('panic_request');
		$q = $this->db->get();
		if($q->num_rows() > 0){
		    $info = $q->row();
		    $this->db->where('id',$info->user_id);
		    return $this->db->get('users')->row();
		}
	}

	public function getUserEmergencynfo($id = '')
	{
		//$this->db->where('is_deleted','0');
		$this->db->where('panic_request.id',$id);
		$this->db->from('panic_request');
		$q = $this->db->get();
		if($q->num_rows() > 0){
		    $info = $q->row();

		    $this->db->select('first_name,last_name,mobile_no');		   
		    $this->db->from('emergency_contacts');
		    $this->db->join('users','emergency_contacts.emergency_user_id= users.id','left');
		    $this->db->where('emergency_contacts.user_id',$info->user_id);
		    $this->db->where('emergency_contacts.is_deleted', 0);
		    $q = $this->db->get();//echo $this->db->last_query();exit;
		    $res = $q->result_array();
		    
		    //2-jun-2022
		    if(!empty($res)) {
		        foreach($res as $k=> $row) {
		            $res[$k]['first_name'] = $row['first_name'] ? $row['first_name'] : '';
		            $res[$k]['last_name'] = $row['last_name'] ? $row['last_name'] : '';
		            $res[$k]['mobile_no'] = $row['mobile_no'] ? $row['mobile_no'] : '';
		        }
		    }
		    
		    return $res ;
		}
	}
	
	public function getUpdateUserInfo($id = ''){

		$this->db->where('id',$id);
		return $this->db->get('users')->row();
	}
	
	public function getUserGroupLocationInfo($id = ''){

		$this->db->where('id',$id);
		return $this->db->get('user_group_locations')->row();
	}
	
	public function getUpdateAdminInfo($id = ''){

		$this->db->select('*,user_admin.user_name as username');
		$this->db->where('id',$id);
		return $this->db->get('user_admin')->row();
	}
    
    public function getUpdateUserLocationInfo($id = ''){

		$this->db->where('id',$id);
		return $this->db->get('user_locations')->row();
	}

	public function array_flatten($array) {

	  if (!is_array($array)) { 
	    return false; 
	  } 
	  $result = array(); 
	  foreach ($array as $key => $value) { 
	    if (is_array($value)) { 
	      $result = array_merge($result, $this->array_flatten($value)); 
	    } else { 
	      $result[$key] = $value; 
	    } 
	  } 
	  return $result; 

	}
	
	public function about_us($data){
	    
	    foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$result = $this->array_flatten($res);
	    file_put_contents('uploads/CMS/about_us.html', $result['api_content']);
	    $this->db->where('id','1');
	    $this->db->update('pages',array('about_us'=>$result['content'],'api_about_us'=>base_url().'uploads/CMS/about_us.html'));
	    return true;
	    
	}
	
	public function terms($data){
	    
	    foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$result = $this->array_flatten($res);
	    file_put_contents('uploads/CMS/terms.html', $result['api_content']);
	    $this->db->where('id','1');
	    $this->db->update('pages',array('terms'=>$result['content'],'api_terms'=>base_url().'uploads/CMS/terms.html'));
	    return true;
	    
	}
	
	public function help($data){
	    
	    foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$result = $this->array_flatten($res);
	    file_put_contents('uploads/CMS/help.html', $result['api_content']);
	    $this->db->where('id','1');
	    $this->db->update('pages',array('help'=>$result['content'],'api_help'=>base_url().'uploads/CMS/help.html'));
	    return true;
	    
	}
	
	
	public function tutorial($data){
	    
	    foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$result = $this->array_flatten($res);
		//echo "<pre>";print_r($result);exit;
	    file_put_contents('uploads/CMS/tutorial.html', $result['api_content']);
	    $this->db->where('id','1');
	    $this->db->update('pages',array('tutorial'=>$result['content'],'api_tutorial'=>base_url().'uploads/CMS/tutorial.html'));
	    return true;
	    
	}
	
	
	
	public function privacy_policy($data){
	    foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$result = $this->array_flatten($res);
	    file_put_contents('uploads/CMS/privacy_policy.html', $result['api_content']);
	    $this->db->where('id','1');
	    $this->db->update('pages',array('privacy_policy'=>$result['content'],'api_privacy_policy'=>base_url().'uploads/CMS/privacy_policy.html'));
	    return true;
	}
	
	public function getInfo($id){
	    $q = $this->db->get('pages');//echo $this->db->last_query();
	    if($q->num_rows() > 0){
	        if($id == '1')
	        return $about_us = $q->row()->about_us;
	        else if($id == '2')
	        return $privacy_policy = $q->row()->privacy_policy;
	        else if($id == '3')
	        return $terms = $q->row()->terms;
	        else if($id == '4')
	        return $terms = $q->row()->help;
	        else if($id == '5')
	        return $terms = $q->row()->tutorial;
	    }
	}
	
    public function sendNotification($data){
        error_reporting(0);
        
        // 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        
        $locations = $data->locations;
        $branches = $data->branches;
        $tenant_id = $data->tenant_id ? $data->tenant_id : 1; 
        if($data->type == '1'){
            
            $this->load->library('firebase');
            
            $this->db->select('device_token');
            $this->db->from('users');
            //$this->db->where('users.id', 357); //357   //1142   //1101

            //15-jul-2022
            if($tenant_id !="" && $tenant_id != 1 ) {
                $this->db->where('users.tenant_id', $tenant_id);
            }

            $q = $this->db->get();
            $user_info = $q->result_array();
            foreach($user_info as $k=>$v){
                if($v['device_token']) {
                    $loc[] = $v['device_token'];
                }
            }
            //echo "<pre>";print_r($loc); exit;
            
            $res = $this->firebase->send_notification_to_all($data->title,$loc,$data->notice_title);
            //echo "<pre>";print_r($res);exit;

            $this->db->insert('notifications',array('type'=>'1','locations'=>'0','message'=>$data->title,'title'=>$data->notice_title,'description'=>$data->api_content,
            'created_at' => date('Y-m-d H:i:s')
            ));
        }
        
        if($data->type == '2'){
            for($i=0;$i<count($locations);$i++){
                $title = $locations[$i];
                $lid = $this->db->get_where('user_group_locations',array('title'=>$title))->row()->id;
                if($lid){
                    $loc_ids = $this->db->get_where('user_group_branch',array('group_location_id'=>$lid))->result_array();
                    //echo '<pre>';print_r($loc_ids);exit;
                    for($j=0;$j<count($loc_ids);$j++){
                        $location_id = $loc_ids[$j]['location_id'];
                       // $code = $this->db->get_where('user_locations',array('id'=>$location_id))->row()->branch_code;
                       
                        if($tenant_id !="" && $tenant_id != 1 ) {
                            $user_info = $this->db->get_where('users',array('branch_name'=>$location_id, 'tenant_id', $tenant_id ))->result();
                        } else {
                        $user_info = $this->db->get_where('users',array('branch_name'=>$location_id))->result();
                        }
                       //echo "<pre>";print_r($user_info);
                        if($user_info){
                            foreach($user_info as $k=>$v){
                               // echo $data->title.'(((('.$v->device_token;
                                //load firebase library
                                $this->load->library('firebase');
                                $this->firebase->send_notification($data->title,$v->device_token,$data->notice_title);
                            }
                        }
                        
                    }//exit;
                }
                $this->db->insert('notifications',array('type'=>'2','locations'=>$lid,'message'=>$data->title,'title'=>$data->notice_title,'description'=>$data->api_content,
                'created_at' => date('Y-m-d H:i:s')
                ));
            }
        }
        if($data->type == '3'){
            //echo "<pre>";print_r($data);exit;
            for($i=0;$i<count($branches);$i++){
                $arr = explode('-',$branches[$i]);
                $loc_id = $this->db->get_where('user_locations',array('branch_code'=>$arr['0']))->row()->id;
                    //echo '<pre>';print_r($loc_ids);exit;
                    if($loc_id){
                        //$location_id = $loc_ids[$j]['location_id'];
                       // $code = $this->db->get_where('user_locations',array('id'=>$location_id))->row()->branch_code;
                       
                       if($tenant_id !="" && $tenant_id != 1 ) {
                            $user_info = $this->db->get_where('users',array('branch_name'=>$loc_id, 'tenant_id', $tenant_id ))->result();
                        } else {
                        $user_info = $this->db->get_where('users',array('branch_name'=>$loc_id))->result();
                        }
                       //echo "<pre>";print_r($user_info);
                        if($user_info){
                            foreach($user_info as $k=>$v){
                               // echo $data->title.'(((('.$v->device_token;
                                //load firebase library
                                $this->load->library('firebase');
                                $this->firebase->send_notification($data->title,$v->device_token,$data->notice_title);
                            }
                        }
                         $this->db->insert('notifications',array('type'=>'3','locations'=>$loc_id,'message'=>$data->title,'title'=>$data->notice_title,'description'=>$data->api_content,
                         'created_at' => date('Y-m-d H:i:s')
                         ));
                    }//exit;
            }
        }
        return true;
        
    }
    public function getUserEvidenceById($e_id) {
        $this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,users.blood_group,users.gender,user_multimedia.user_lat,user_multimedia.user_long,panic_request.user_id,panic_request.timestamp as created_at');
        $this->db->from('panic_request');
        $this->db->join('user_multimedia', 'user_multimedia.panic_id = panic_request.id', 'left');
        $this->db->join('users', 'users.id = user_multimedia.user_id', 'left');
        $this->db->where('users.is_deleted', '0');
        $this->db->where('panic_request.id', $e_id);
        $this->db->where('user_multimedia.module_type', '1');
        $this->db->or_where('user_multimedia.module_type', '4');
        $this->db->group_by('panic_request.id');
        $this->db->order_by('timestamp', 'desc');
        $q = $this->db->get();
        return $q->row_array();
    }
    
      public function getUserCriticalIllnessByUserId($user_id) {
        $this->db->select('user_critical_illness.id,user_critical_illness.critical_illness_id,user_critical_illness.critical_illness_name');
        $this->db->from('user_critical_illness');
        $this->db->where('user_critical_illness.user_id',$user_id);
        $this->db->order_by('user_critical_illness.critical_illness_id');
        $q = $this->db->get();
        return $q->result_array();
    }
    
        public function getCriticalIllnessById($critical_illness_id) {
        $this->db->select('critical_illness.critical_illness_name');
        $this->db->from('critical_illness');
        $this->db->where('critical_illness.id',$critical_illness_id);
        $q = $this->db->get();  
        return $q->row_array();
    }
    /**
     * @function: getPreTriggerNotificationsByUserId
     * @description: get Pre Trigger Notifications By User
     * @param $user_id - int, $pre_trigger_id - int
     * @return array result
     * @date 02-june-2021 added by Manisha
     */
    public function getPreTriggerNotificationsByUserId($user_id = null, $pre_trigger_id = null) {
        if ($user_id != null) {
            $this->db->select('pre_trigger_notifications.user_lat, pre_trigger_notifications.user_long, pre_trigger_notifications.tracking_id, pre_trigger_notifications.status_stop_date');
            $this->db->from('pre_trigger_notifications');
            $this->db->where('pre_trigger_notifications.user_id', $user_id);
            if ((!isset($pre_trigger_id) ) || ($pre_trigger_id !== "null")) {
                $this->db->where('pre_trigger_notifications.pre_trigger_id', $pre_trigger_id);
            }
            $this->db->order_by('id', 'desc');
            $q = $this->db->get();
            return $q->result_array();
        }
    }
	
	
	/**
	* @function: addUserTempData
	* @description: add User Temp Data
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
	*/
    public function addUserTempData($insert_data,$session_id, $admin_select){
        // START - 8-jun-2022
    		date_default_timezone_set('Asia/Kolkata');
	    $data = array(
	       'tenant_id'=>$admin_select,
	        'first_name'=> isset($insert_data['0']) ? $insert_data['0'] : null,
	        'middle_name'=> isset($insert_data['1']) ? $insert_data['1'] : null,
	        'last_name'=> isset($insert_data['2']) ? $insert_data['2'] : null,
	        'mobile'=> isset($insert_data['3']) ? $insert_data['3'] : null,
	        'email'=> isset($insert_data['4']) ? $insert_data['4'] : null,
	        'gender'=> isset($insert_data['5']) ? $insert_data['5'] : null,
	        'blood_group'=> isset($insert_data['6']) ? $insert_data['6'] : null,
	        'age'=> isset($insert_data['7']) ? $insert_data['7'] : null,
	        'dob'=> isset($insert_data['8']) ? date('Y-m-d',strtotime($insert_data['8'])) : null,
	        
    		'status'=> isset($insert_data['9']) ? $insert_data['9'] : null,

	        'contact_1'=> isset($insert_data['10']) && $insert_data['10'] != "" ? $insert_data['10'] : null,
	        'contact_name_1'=> isset($insert_data['11']) && $insert_data['11'] != "" ? $insert_data['11'] : null,
	        'contact_2'=> isset($insert_data['12']) && $insert_data['12'] != "" ? $insert_data['12'] : null,
	        'contact_name_2'=> isset($insert_data['13']) && $insert_data['13'] != "" ? $insert_data['13'] : null,
	        'contact_3'=> isset($insert_data['14']) && $insert_data['14'] != "" ? $insert_data['14'] : null,
	        'contact_name_3'=> isset($insert_data['15']) && $insert_data['15'] != "" ? $insert_data['15'] : null,
	        'contact_4'=> isset($insert_data['16']) && $insert_data['16'] != "" ? $insert_data['16'] : null,
	        'contact_name_4'=> isset($insert_data['17']) && $insert_data['17'] != ""  ? $insert_data['17'] : null,
	        
	        'session_id'=>$session_id,
	        // 8-jun-2022
	        'created_at'=>date('Y-m-d H:i:s'),
	    );
	    $this->db->insert('tmp_bulk_user',$data);
	    // echo $this->db->last_query();exit;
	    return $this->db->insert_id();
	}
	
	/**
	* @function: getBulkTempUsers
	* @description: add User Temp Data
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
	*/
	public function getBulkTempUsers($session_id) {	
		$this->db->select('id,first_name,middle_name,last_name, email,mobile,   gender,dob,  age,status,contact_1,contact_name_1,contact_2,contact_name_2,contact_3,contact_name_3,contact_4, contact_name_4');
		//$this->db->where('is_deleted','0');
		//$this->db->group_by('type_id');
		$this->db->where('session_id',$session_id);
		return $this->db->get('tmp_bulk_user')->result_array();
	}
	
		
    /**
	* @function: getBulkTmpUsers
	* @description:  
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
	*/
    public function getDeclinedBulkUser($session_id) {
		$this->db->where('session_id',$session_id);
		$this->db->where('is_declined','1');
		return $this->db->get('tmp_bulk_user')->result_array();
	}
    /**
	* @function: getUpdatedBulkUser
	* @description:  
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
	*/
	public function getUpdatedBulkUser($session_id) {
	   // echo $session_id;die;
		$this->db->where('session_id',$session_id);
		$this->db->where('is_updated','1');
        $result = $this->db->get('tmp_bulk_user')->result_array();

        foreach ($result as $key => $value) {
            $action = "";
            if($value['is_updated'] == 1 ) {
                $action = "Update";
            }
            if($value['is_updated'] == 0 ) {
                $action = "Insert";
            }
            $result[$key]['action'] = $action;
            $result[$key]['sr_no'] = $key+1;
        }
	    return $result;
	}
	
	public function saveBulkUserImportData($session_id){
	    error_reporting(0);
	    // 9-jun-2022
	    date_default_timezone_set('Asia/Kolkata');
			
	    $data= $this->getBulkUserTempData($session_id);
//	 echo "<pre>";print_r($data);
	    foreach($data as $k=>$v){
	        if(strtolower(trim($v['status'])) =='active'){
	            $status = '1';
	        }else if(strtolower(trim($v['status'])) =='inactive'){
	            $status ='2';
	        }else if(strtolower(trim($v['status'])) =='suspended'){
	            $status ='3';
	        } else {
	            $status =''; 
	        }
	        
	        if(strtolower(trim($v['gender'])) =='male' || strtolower(trim($v['gender'])) =='m'){
	            $gender='1';
	        }else if(strtolower(trim($v['gender'])) =='female' || strtolower(trim($v['gender'])) =='f'){
	            $gender='2';
	        }
	        
            if($v['blood_group'] == 'A+' || $v['blood_group'] == 'a+') {
                $blood_group='1';
            }else if($v['blood_group'] == 'B+' || $v['blood_group'] == 'b+'){
                $blood_group='2';
            }else if($v['blood_group'] == 'O+' || $v['blood_group'] == 'o+'){
                $blood_group='3';
            }else if($v['blood_group'] == 'AB+'){
                $blood_group='4';
            }else if($v['blood_group'] == 'A-'){
                $blood_group='5';
            }else if($v['blood_group'] == 'B-'){
                $blood_group='6';
            }else if($v['blood_group'] == 'O-'){
                $blood_group='7';
            }else if($v['blood_group'] == 'AB-'){
                $blood_group='8';
            } else {
                $blood_group=''; 
            }
            
            $ec1_info = array();
            $ec2_info = array();
            $ec3_info = array();
            $ec4_info = array();
            
            if ($v['contact_1'] != null || $v['contact_1'] != "") {
                $ec1_info = $this->db->get_where('users',array('mobile_no'=>trim($v['contact_1']) , 'is_deleted'=>0))->row();
                if($ec1_info ) {
                    $ec1 = $ec1_info->id;
                     $ecn1 = $ec1_info->first_name. " ". $ec1_info->last_name;
                } else {
                    $insert_contact_data =  array(
        	           // 'tenant_id'=>$v['tenant_id'],
        		        'first_name'=>$v['contact_name_1'],
        		         'email'   =>$v['contact_name_1'].'@email.com' ,
        		        'mobile_no'=>$v['contact_1'],
        		        'status'=>1,
        		        'from_bulk'=> NULL,
                    );
                    $this->db->insert('users',$insert_contact_data);
                    $ec1 = $this->db->insert_id();
                     $ecn1 = $v['contact_name_1'];
                }
            }
            if ($v['contact_1'] != null || $v['contact_1'] != "") {
                $ec2_info = $this->db->get_where('users',array('mobile_no'=>trim($v['contact_2']) ,   'is_deleted'=>0))->row();
                if($ec2_info){
                    $ec2 = $ec2_info->id;
                    $ecn2 = $ec2_info->first_name. " ". $ec2_info->last_name;
                } else {
                    $insert_contact_data =  array(
        	          //  'tenant_id'=>$v['tenant_id'],
        		        'first_name'=>$v['contact_name_2'],
        		       'email'   =>$v['contact_name_2'].'@email.com' ,
        		        'mobile_no'=>$v['contact_2'],
        		        'status'=>1,
        		        'from_bulk'=> NULL,
                    );
                    $this->db->insert('users',$insert_contact_data);
                    $ec2 = $this->db->insert_id();
                      $ecn2 = $v['contact_name_2'];
                }
            }
            if ($v['contact_1'] != null || $v['contact_1'] != "") {
                $ec3_info = $this->db->get_where('users',array('mobile_no'=>trim($v['contact_3']) , 'is_deleted'=>0 ))->row();
                if($ec3_info){
                    $ec3 = $ec3_info->id;
                    $ecn3 = $ec3_info->first_name. " ". $ec3_info->last_name;
                } else {
                    
                    
                    $insert_contact_data =  array(
        	           // 'tenant_id'=>$v['tenant_id'],
        		        'first_name'=>$v['contact_name_3'],
        		         'email'   =>$v['contact_name_3'].'@email.com' ,
        		        'mobile_no'=>$v['contact_3'],
        		        'status'=>1,
        		        'from_bulk'=> NULL,
                    );
                    $this->db->insert('users',$insert_contact_data);
                    $ec3 = $this->db->insert_id();
                    $ecn3 = $v['contact_name_3'];
                }
            }
            
            if ($v['contact_1'] != null || $v['contact_1'] != "") {
                $ec4_info = $this->db->get_where('users',array('mobile_no'=>trim($v['contact_4']) , 'is_deleted'=>0))->row();
                if($ec4_info){
                    $ec4 = $ec4_info->id;$ecn4 = $ec4_info->first_name. " ". $ec4_info->last_name;
                } else {
                    $insert_contact_data =  array(
        	           // 'tenant_id'=>$v['tenant_id'],
        		        'first_name'=>$v['contact_name_4'],
        		          'email'   =>$v['contact_name_4'].'@email.com' ,
        		        'mobile_no'=>$v['contact_4'],
        		        'status'=>1,
        		       'from_bulk'=> NULL,
                    );
                    $this->db->insert('users',$insert_contact_data);
                    $ec4 = $this->db->insert_id();
                    $ecn4 = $v['contact_name_4'];
                }
            }
            
            // print_r($ec1_info);
            // print_r($v);
           // die;
            if( $v['first_name'] && $v['last_name'] && $v['gender']  && $v['mobile']){
                if( $v['user_id'] != null &&  $v['is_updated'] == 1  ){
    	    	   if( $v['user_id']){
    	    		    $update_data = array(
    	    		          'tenant_id'=>$v['tenant_id'],
        			        'first_name'=>$v['first_name'],
        			        'middle_name'=>$v['middle_name'],
        			        'last_name'=>$v['last_name'],
        			        //'cost_center_text'=>$v['cost_center_text'],
        			        'gender'=>$gender,
        			        'date_of_birth'=>$v['dob'],
        			        'age'=>$v['age'],
        			        'blood_group'=>$blood_group,
        			        'status'=>$status,
        			        'email'=>$v['email'],
        			        'from_bulk'=> "2",
        			        'modified_at' => date('Y-m-d H:i:s'),
        			        'bulk_update_on' => date('Y-m-d H:i:s'),
    		            );
        	    		$this->db->where('id', $v['user_id']);
        	        	$this->db->update('users',$update_data);

        	            $update_emergency_contacts_data = array ( 'is_deleted' => 1 );
        	        	$this->db->where('user_id', $v['user_id']);
        	        //	$this->db->where('tenant_id', $v['tenant_id']);
        	            $this->db->update('emergency_contacts',$update_emergency_contacts_data);
        	         	for($i=0;$i<=4;$i++){
        	                 $var = 'ec'.$i;
        	                 $var_name = 'ecn'.$i;
        	                if (isset($var) && isset($var_name)) {
            	                if(${$var}) {
                	                $this->db->insert('emergency_contacts',array('user_id'=> $v['user_id'],'emergency_user_id'=>${$var}, 'name'=> ${$var_name},'serial_no'=>$i));
                	         	}
            	         	}
        	         	}
    	    	   }
    	    	}else{
    	    	     
    	    	    $check_current_user_info = $this->db->get_where('users', array(
                                'mobile_no' => trim($v['mobile']), 
                                'is_deleted' => '0'))->row();
                            // echo $this->db->last_query(); //exit;
                // print_r($check_current_user_info);
                // die;
                
                                if($check_current_user_info) {
                                    $this->db->where('is_deleted','0');
                            		$this->db->where('mobile_no', trim($v['mobile']));
		                            $this->db->update('users',array('is_deleted'=>'1', 'modified_at ' => date('Y-m-d H:i:s')));
                                }
                                
        	        $insert_data = array(
        	            'tenant_id'=>$v['tenant_id'],
        		        'first_name'=>$v['first_name'],
        		        'middle_name'=>$v['middle_name'],
        		        'last_name'=>$v['last_name'],
        		        'mobile_no'=>$v['mobile'],
        		        'date_of_birth'=>$v['dob'],
        		       // 'cost_center_text'=>$v['cost_center_text'],
        		        'gender'=>$gender,
        		        'age'=>$v['age'],
        		        'blood_group'=>$blood_group,
        		        'email'=>$v['email'],
        		        'status'=>$status,
        		        'from_bulk'=> "2",
        		        'created_at' => date('Y-m-d H:i:s'),
        		        'modified_at' => date('Y-m-d H:i:s'),
        		        'bulk_update_on' => date('Y-m-d H:i:s'),
        	        );
	        
        	        $this->db->insert('users',$insert_data);
        	        $inserted_user_id = $this->db->insert_id();
        	        
        	        // 11-jun-2022
        	        // add user plan
        	        if ($inserted_user_id) {
        	            $insert_data_user_plan = array(
            	            'user_id'=> $inserted_user_id,
            		        'plan_id'=> 1,
            		        'start_date'=> date('Y-m-d'),
            		        'end_date'=> '2050-01-01',
            		        'transaction_id' => NULL,
            		        'status'=> '1',
            		        'created_at' => date('Y-m-d H:i:s')
            	        );
            	        $this->db->insert('user_plan',$insert_data_user_plan);
            	        $inserted_user_plan_id = $this->db->insert_id();
        	        }

    	         	for($i=0;$i<=4;$i++){
    	                 $var = 'ec'.$i;
    	                 $var_name = 'ecn'.$i;
    	               //  print_r($var_name);
    	               //  print_r(${$var});
    	               //  print_r(${$var_name});
    	                 if (isset($var) && isset($var_name)) {
        	                if(${$var}) {
            	                $this->db->insert('emergency_contacts',array('user_id'=> $inserted_user_id,'emergency_user_id'=>${$var}, 'name'=> ${$var_name},'serial_no'=>$i));
            	         	}
        	         	}
    	         	}
                }
            }else{
                $this->db->where('id',$v['id']);
                $this->db->update('tmp_bulk_user',array('is_declined'=>'1'));
            }
	       // echo $this->db->last_query();exit;
	    }
	    //die;
	    return $this->db->affected_rows();
	}
	
    public function removeBulkUserTempData($session_id){
		$this->db->where('is_declined','0');
		$this->db->where('session_id',$session_id);
		$this->db->delete('tmp_bulk_user');//echo $this->db->last_query();exit;
	    return true;
	}
		public function getBulkUserTempData($session_id)
	{	
		//$this->db->select('id,tenant_id, first_name,middle_name,last_name, email,mobile,    gender,dob, age,status,contact_1,contact_2,contact_3,contact_4');
		//$this->db->where('is_deleted','0');
		 
		$this->db->where('session_id',$session_id);
		return $this->db->get('tmp_bulk_user')->result_array();
	}
	
	
		
    /**
    * @function: getUserPoshEvidence 
    * @description: 
    * @param  
    * @return 
    * @date 27-may-2022 added by Manisha
    */
		public function getUserPoshEvidence($tid = '')
	{
		$this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp');
		$this->db->from('panic_request');
		$this->db->join('user_multimedia','user_multimedia.panic_id = panic_request.id','left');
		$this->db->join('users','users.id = user_multimedia.user_id','left');
		$this->db->where('users.is_deleted','0');
		$this->db->where('user_multimedia.module_type','3');
		
		// 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
        }
        
        
		$this->db->group_by('panic_request.id');
		$this->db->order_by('timestamp','desc');
		$q = $this->db->get();
	//	echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	/**
	* @function: clearBulkUserTempData 
    * @description: 
    * @param  
    * @return 
    * @date 6-jun-2022 added by Manisha
	 */
	public function clearBulkUserTempData($session_id) {
		$this->db->where('session_id',$session_id);
		$this->db->delete('tmp_bulk_user');
	    return true;
	}
	
	// 22-jun-2022
	public function getFollowMeSafeRequest($followme_id){
        $this->db->select('id, user_id, followme_id, status, user_lat, user_long, created_at, updated_at');
		$this->db->from('followme_safe');
        if($followme_id){
		    $this->db->where('followme_id', $followme_id);
        }
    	$this->db->order_by('id','desc');
		$q = $this->db->get();//echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	/**
	* @function: getUserPoshDetail 
    * @description: 
    * @param  
    * @return 
    * @date 4-jul-2022 added by Manisha
	 */
	public function getUserPoshDetail($id){
		$this->db->where('panic_id',$id);
	 	$this->db->limit('1');
	    $q = $this->db->get('posh_request');
	    $res = $q->row_array();
		if($q->num_rows() > 0){
		    $user_id = $res['user_id'];
		    $res['date_value'] = date("Y-m-d", strtotime($res['date']) ); //date_format(,"Y/m/d");
		    $info = $q->row();
		    $this->db->where('id',$user_id);
		    $users_res = $this->db->get('users')->row();
		    $res['first_name'] = $users_res->first_name;
		    $res['last_name'] = $users_res->last_name;
		    $res['mobile_no'] = $users_res->mobile_no;
		}
		return $res;
	}
	
		
	// 18-jul-2022
	public function getFollowMeSafeRequestLastStatus($followme_id){
        $this->db->select('id, user_id, followme_id, status, user_lat, user_long, created_at, updated_at');
		$this->db->from('followme_safe');
        if($followme_id){
		    $this->db->where('followme_id', $followme_id);
        }
    	$this->db->order_by('id','desc');
			$res = $this->db->get()->row();//echo $this->db->last_query();exit;
	  
		if($res) {
		    return $res->status;
		} else {
		    return "";
		}
	}
	public function getUserMultimediaFollowmeTypeById($id = '') {
	    if($id) {
    		$this->db->where('user_multimedia.panic_id',$id);
    		$this->db->from('user_multimedia');
    		$this->db->order_by('id','desc');
    	    $res = $this->db->get()->row();
    	    return $res;
	    } else {
	        return false;
	    }
	}
	
	public function getUserFollowmeEvidence($followme_id, $tid= '') {
	    $this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp, user_multimedia.content_type, user_multimedia.module_type, user_multimedia.followme_id , user_multimedia.followme_safe_status');
		$this->db->from('panic_request');
		$this->db->join('user_multimedia','user_multimedia.panic_id = panic_request.id','left');
		$this->db->join('users','users.id = user_multimedia.user_id','left');
		$this->db->where('users.is_deleted','0');

		$this->db->where('user_multimedia.module_type','4');

	    // 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $panic_request_id);
        }
        $this->db->where('user_multimedia.followme_id', $followme_id);

		$this->db->group_by('panic_request.id');
		$this->db->order_by('timestamp','desc');
		$q = $this->db->get(); //echo $this->db->last_query();exit;
		return $q->result_array();
	}
	
	//30-jul-2022
	public function add_user($data) {
	   	foreach ($data as $key => $value) {
			$res[] = array($value->name=>$value->value); 
		}
		$data = $this->array_flatten($res);
	    
        // check mobile number already exists.
        $admin_select= $data['admin_select'];
        $mobile_no= $data['mobile_no'];
      //  $this->db->where('users.tenant_id', $admin_select);
        $this->db->where('users.mobile_no', $mobile_no);
        $this->db->where('users.is_deleted', "0");
        $this->db->from('users');
        $q = $this->db->get();
        $res_users = $q->row_array();
            // var_dump($res_users['tenant_id']);
            // print_r($res_users);
            // die;
	    if($res_users) {
	        $id = $res_users['id'];
	        if($res_users['tenant_id'] ==null) {
         	    $update_data= array(
        		//	'user_type'=>$data['user_type'],
        		//	'sap_code'=>$data['sapcode'],
        			'first_name'=>$data['firstname'],
        			'middle_name'=>$data['middlename'],
        			'last_name'=>$data['lastname'],
        			'email'=>$data['email'],
        			'age'=>$data['age'],
        			'gender'=>$data['gender'],
        		//	'branch_name'=>$data['branch_name'],
        		//	'department'=>$data['department'],
        		//	'designation'=>$data['designation'],
        		//	'mobile_no'=>$data['mobile_no'],
        		//	'vertical'=>$data['vertical'],
        			'blood_group'=>$data['blood_group'],
        		//	'mpin'=>$data['mpin'],
        			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
        // 			'reporting_manager_sap_code'=>$data['reporting_manager_sap_code'],
        // 			'reporting_manager_name'=>$data['reporting_manager_name'],
        // 			'reviewing_manager_sap_code'=>$data['reviewing_manager_sap_code'],
        // 			'reviewing_manager_name'=>$data['reviewing_manager_name'],
        // 			'ho_poc_sap_code'=>$data['ho_poc_sap_code'],
        // 			'ho_poc_name'=>$data['ho_poc_name'],
        // 			'department_head_sap_code'=>$data['department_head_sap_code'],
        // 			'department_head_name'=>$data['department_head_name'],
        			'status'=>$data['status'],
        			'city'=>$data['city'],
        		    'tenant_id'=>$data['admin_select']

        		);
        		$this->db->where('id',$id);
        		$this->db->update('users',$update_data);//echo $this->db->last_query();exit;
        		if($id){
        		    $this->db->where('user_id',$id);
        		    $this->db->delete('emergency_contacts');
        		   if($data['reporting_manager_sap_code']){
        		        $array = explode('-',$data['reporting_manager_sap_code']);
        		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'1'));
        		    }
        		    if($data['reviewing_manager_sap_code']){
        		        $array = explode('-',$data['reviewing_manager_sap_code']);
        		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'2'));
        		    }
        		    if($data['ho_poc_sap_code']){
        		        $array = explode('-',$data['ho_poc_sap_code']);
        		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'3'));
        		    }
        		    if($data['department_head_sap_code']){
        		        $array = explode('-',$data['department_head_sap_code']);
        		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
        		        $this->db->insert('emergency_contacts',array('user_id'=>$id,'emergency_user_id'=>$eid,'serial_no'=>'4'));
        		    }
        		}
        		
        		if($id){
        			return true;
        		}else{
        			return false;
        		}
	        } else {
	            $this->db->where('id', $id);
        		$this->db->update('users',array('is_deleted'=>'1') );
        		
        		$insert_data= array(
    	 	    'user_type'=>"3",
    			'first_name'=>$data['firstname'],
    			'middle_name'=>$data['middlename'],
    			'last_name'=>$data['lastname'],
    			'email'=>$data['email'],
    			'age'=>$data['age'],
    			'gender'=>$data['gender'],
    // 			'branch_name'=>$data['branch_name'],
    // 			'department'=>$data['department'],
    // 			'designation'=>$data['designation'],
    			'mobile_no'=>$data['mobile_no'],
    			'blood_group'=>$data['blood_group'],
    			//'mpin'=>$data['mpin'],
    			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    // 			'reporting_manager_sap_code'=>$data['reporting_manager_sap_code'],
    // 			'reporting_manager_name'=>$data['reporting_manager_name'],
    // 			'reviewing_manager_sap_code'=>$data['reviewing_manager_sap_code'],
    // 			'reviewing_manager_name'=>$data['reviewing_manager_name'],
    // 			'ho_poc_sap_code'=>$data['ho_poc_sap_code'],
    // 			'ho_poc_name'=>$data['ho_poc_name'],
    // 			'department_head_sap_code'=>$data['department_head_sap_code'],
    // 			'department_head_name'=>$data['department_head_name'],
    			'status'=>$data['status'],
    			'tenant_id'=>$data['admin_select']
    
    		);
    		$this->db->insert('users',$insert_data);
    		$uid= $this->db->insert_id();
    		if($uid){
    		    if($data['reporting_manager_sap_code']){
    		        $array = explode('-',$data['reporting_manager_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'1'));
    		    }
    		    if($data['reviewing_manager_sap_code']){
    		        $array = explode('-',$data['reviewing_manager_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'2'));
    		    }
    		    if($data['ho_poc_sap_code']){
    		        $array = explode('-',$data['ho_poc_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'3'));
    		    }
    		    if($data['department_head_sap_code']){
    		        $array = explode('-',$data['department_head_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'4'));
    		    }
    		
    		}
            
    		//echo $this->db->last_query();exit;
    	//	if($this->db->affected_rows() > 0){
    		if($uid){
    			return true;
    		}else{
    			return false;
    		}
	        }
	    } else {
	    
	
	 //   echo "<pre>";print_r($data);exit;
   
    		$insert_data= array(
    	 	    'user_type'=>"3",
    			'first_name'=>$data['firstname'],
    			'middle_name'=>$data['middlename'],
    			'last_name'=>$data['lastname'],
    			'email'=>$data['email'],
    			'age'=>$data['age'],
    			'gender'=>$data['gender'],
    // 			'branch_name'=>$data['branch_name'],
    // 			'department'=>$data['department'],
    // 			'designation'=>$data['designation'],
    			'mobile_no'=>$data['mobile_no'],
    			'blood_group'=>$data['blood_group'],
    			//'mpin'=>$data['mpin'],
    			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    // 			'reporting_manager_sap_code'=>$data['reporting_manager_sap_code'],
    // 			'reporting_manager_name'=>$data['reporting_manager_name'],
    // 			'reviewing_manager_sap_code'=>$data['reviewing_manager_sap_code'],
    // 			'reviewing_manager_name'=>$data['reviewing_manager_name'],
    // 			'ho_poc_sap_code'=>$data['ho_poc_sap_code'],
    // 			'ho_poc_name'=>$data['ho_poc_name'],
    // 			'department_head_sap_code'=>$data['department_head_sap_code'],
    // 			'department_head_name'=>$data['department_head_name'],
    			'status'=>$data['status'],
    			'tenant_id'=>$data['admin_select']
    
    		);
    		$this->db->insert('users',$insert_data);
    		$uid= $this->db->insert_id();
    		if($uid){
    		    if($data['reporting_manager_sap_code']){
    		        $array = explode('-',$data['reporting_manager_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'1'));
    		    }
    		    if($data['reviewing_manager_sap_code']){
    		        $array = explode('-',$data['reviewing_manager_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'2'));
    		    
    		    }
    		    if($data['ho_poc_sap_code']){
    		        $array = explode('-',$data['ho_poc_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'3'));
    		    
    		    }
    		    if($data['department_head_sap_code']){
    		        $array = explode('-',$data['department_head_sap_code']);
    		        $eid = $this->db->get_where('users',array('mobile_no'=>$array['0']))->row()->id;
    		        $this->db->insert('emergency_contacts',array('user_id'=>$uid,'emergency_user_id'=>$eid,'serial_no'=>'4'));
    		    
    		    }
    		
    		}
            
    		//echo $this->db->last_query();exit;
    	//	if($this->db->affected_rows() > 0){
    		if($uid){
    			return true;
    		}else{
    			return false;
    		}
	    }
	}
	
    public function check_add_user_mobile_number($data, $id = "") {
        // $this->db->where('field is NOT NULL', NULL, FALSE);
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        if ($id) {
            $data = $this->array_flatten($res);
            $admin_select = $data['admin_select'];
            $mobile_no= $data['mobile_no'];
            $this->db->where('users.tenant_id', $admin_select);
            $this->db->where('users.mobile_no', $mobile_no);
            $this->db->where('users.id !=', $id);
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
        } else {
            $data = $this->array_flatten($res);
            $admin_select= $data['admin_select'];
            $mobile_no= $data['mobile_no'];
            $this->db->where('users.tenant_id', $admin_select);
            $this->db->where('users.mobile_no', $mobile_no);
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
        }
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }
}
?>