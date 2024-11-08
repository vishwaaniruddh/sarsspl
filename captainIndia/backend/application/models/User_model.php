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
            if(isset( $data['admin_select']) &&  $data['admin_select'] !=""){
            $admin_select = $data['admin_select'];
            $mobile_no= $data['mobile_no'];
            $this->db->where('users.id', $id);
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
            $res_users = $q->row_array();
            if($res_users) {
    	        if  ($res_users['tenant_id'] != $data['admin_select']) {
    	            $this->db->where('id', $id);
            		$this->db->update('users',array('is_deleted'=>'1', 'status' => '2') );
            		$insert_data= array(
            	 	    'user_type'=>"3",
            			'first_name'=>$data['firstname'],
            			'middle_name'=>$data['middlename'],
            			'last_name'=>$data['lastname'],
            			'email'=>$data['email'],
            			'age'=>$data['age'],
            			'gender'=>$data['gender'],
            			'mobile_no'=>$data['mobile_no'],
            			'blood_group'=>$data['blood_group'],
            			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
            			'status'=>$data['status'],
            		    'city'=>$data['city'],
            			'from_bulk' => '3',
            			'tenant_id'=>$data['admin_select'],
            			
            			// 14-sep-2022
            		    'govt_id_image_url' => $res_users['govt_id_image_url'] ? $res_users['govt_id_image_url'] : null,
            		    'govt_id_image_url_thumb' => $res_users['govt_id_image_url_thumb'] ? $res_users['govt_id_image_url_thumb'] : null,
            		    'govt_id_number' => $res_users['govt_id_number'] ? $res_users['govt_id_number'] : null,
            		    'govt_id_type' => $res_users['govt_id_type'] ? $res_users['govt_id_type'] : null,
            		    'unique_id' => $res_users['unique_id'] ? $res_users['unique_id'] : null,
            		    'myresqr_status' => $res_users['myresqr_status'] ? $res_users['myresqr_status'] : '0',
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
    	        } else {
    	             $update_data= array(
 
            			'first_name'=>$data['firstname'],
            			'middle_name'=>$data['middlename'],
            			'last_name'=>$data['lastname'],
            			'email'=>$data['email'],
            			'age'=>$data['age'],
            			'gender'=>$data['gender'],
            			'mobile_no'=>$data['mobile_no'],
            			'blood_group'=>$data['blood_group'],
            			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
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
    	        }
    	         // plan
                    $this->db->where('users.id', $id);
                    $this->db->where('users.is_deleted', "0");
                    $this->db->from('users');
                    $q = $this->db->get();
                    $res_users = $q->row_array();
                    if ($res_users['tenant_id'] == 1) {
                        $this->db->select('id, title, duration, price, status, is_deleted');
                        $this->db->from('plan_master');
                        $this->db->where('id', $data['plan_id']);
                        $this->db->where('is_deleted', '0');
                        $q = $this->db->get();
                        $result_plan_master = $q->row_array();
                        if ($q->num_rows() > 0) {
                            $duration = "";
                            $start_date = "";
                            $end_date = "";
                            if ($result_plan_master['duration'] != "") {
                                $duration = $result_plan_master['duration'];
                            }
                            if ($result_plan_master['duration'] != "") {
                                $start_date = date('Y-m-d H:i:s');
                                $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $duration . ' days'));
                            }
                            if ($start_date != "") {
                                $this->db->select('id, user_id, plan_id, start_date, end_date, transaction_id, status');
                                $this->db->from('user_plan');
                                $this->db->where('user_id', $id);
                                $q = $this->db->get();
                                $result_user_plan = $q->row_array();
                                if ($q->num_rows() > 0) {
                                    if ($result_user_plan['id'] != $data['plan_id']) {
                                        $update_user_plan_data = array(
                                            'plan_id' => $data['plan_id'],
                                            'start_date' => $start_date,
                                            'end_date' => $end_date,
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->where('user_id', $id);
                                        $this->db->update('user_plan', $update_user_plan_data);
                                    }
                                } else {
                                    $insert_data = array(
                                        'user_id' => $id,
                                        'plan_id' => $data['plan_id'],
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'status' => '1',
                                        'created_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('user_plan', $insert_data);
                                }
                            }
                        }
                    }
    	        
                } else {
            
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
        }
            } else {
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
            }
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
		
                // plan
                $this->db->where('users.id', $uid);
                $this->db->where('users.is_deleted', "0");
                $this->db->from('users');
                $q = $this->db->get();
                $res_users = $q->row_array();
                if ($res_users['tenant_id'] == 1) {
                    $this->db->select('id, title, duration, price, status, is_deleted');
                    $this->db->from('plan_master');
                    $this->db->where('id', $data['plan_id']);
                    $this->db->where('is_deleted', '0');
                    $q = $this->db->get();
                    $result_plan_master = $q->row_array();
                    if ($q->num_rows() > 0) {
                        $duration = "";
                        $start_date = "";
                        $end_date = "";
                        if ($result_plan_master['duration'] != "") {
                            $duration = $result_plan_master['duration'];
                        }
                        if ($result_plan_master['duration'] != "") {
                            $start_date = date('Y-m-d H:i:s');
                            $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $duration . ' days'));
                        }
                        if ($start_date != "") {
                            $this->db->select('id, user_id, plan_id, start_date, end_date, transaction_id, status');
                            $this->db->from('user_plan');
                            $this->db->where('user_id', $uid);
                            $q = $this->db->get();
                            $result_user_plan = $q->row_array();
                            if ($q->num_rows() > 0) {
                                if ($result_user_plan['id'] != $data['plan_id']) {
                                    $update_user_plan_data = array(
                                        'plan_id' => $data['plan_id'],
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->where('user_id', $uid);
                                    $this->db->update('user_plan', $update_user_plan_data);
                                }
                            } else {
                                $insert_data = array(
                                    'user_id' => $uid,
                                    'plan_id' => $data['plan_id'],
                                    'start_date' => $start_date,
                                    'end_date' => $end_date,
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s')
                                );
                                $this->db->insert('user_plan', $insert_data);
                            }
                        }
                    }
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
    			'age'=> isset($data['age']) ? $data['age'] : 0 ,
    			'gender'=> isset($data['gender']) ? $data['gender'] : 0 ,
    			'mobile_no'=>$data['mobile_no'],
    			'user_name'=>$data['username'],
    			'password'=>$data['password'],
    			'blood_group'=> isset($data['blood_group']) ? $data['blood_group'] : 0 ,
    // 			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    		    'date_of_birth'=> isset($data['date_of_birth']) ? date('Y-m-d',strtotime($data['date_of_birth'])) : null ,
    			'status'=>$data['status'],
    			'tenant_code'=>$data['tenant_code'],
    			
    			//14-jul-2022
			    'address'=>$data['address'],

		        // 28-march-2023
			    'chatbot_url' => $data['chatbot_url'],
    		    //	START - 8-jun-2022
    		    'modified_at'=>date('Y-m-d H:i:s')
    		);
    		$this->db->where('id',$id);
    		$this->db->update('user_admin',$update_data);
    		
            // checked_menu - tenant_privileges
//            if (isset($data['checked_menu']) && $data['checked_menu'] != "") {
                $rand_letter = $this->addTenantPrivilege($id, $data['checked_menu']);
//            }
            //3-aug-2022
			if(isset($data['licence']) && $data['licence'] >=1) {
				if($data['licence'] >= 1) {
					if($id) {
						$this->db->select('user_admin.id , user_admin.total_licence  ');
						$this->db->where('user_admin.is_deleted','0');
						$this->db->where('user_admin.id', $id);
						$res_user_admin = $this->db->get('user_admin')->row();
						if($res_user_admin ) {
							$total_licence = (int) $res_user_admin->total_licence +  (int) $data['licence'];
							$update_user_admin = array('total_licence' => $total_licence  );
							$this->db->where('user_admin.id',  $id);
							$this->db->update('user_admin', $update_user_admin  );
						}
					}	
					$start_code = 1 ;
					$licence= $data['licence'] ;
					$start_date = date('Y-m-d',strtotime($data['start_date']))  ;
 
					while($start_code <= $licence) {
						$rand_letter = $this->getRandomLetter(2);
						$end_date = date('Y-m-d', strtotime($start_date . ' +364 day'));
						$insert_data_tenant_licence= array(
							'licence_key' =>  time().$rand_letter .$id.$start_code,
							'tenant_id' => $id,
							'start_date' => $start_date,
							'end_date' => $end_date,
						);
						$this->db->insert('tenant_licence',$insert_data_tenant_licence);
						$start_code++;
					}
				}
			}
			
    		if($change_password == "1") {
        		$this->addTenantEmail($id, 'Password Changed');
    		}
        }else{
    		$insert_data= array(			
    			'first_name'=>$data['firstname'],
    			'middle_name'=>$data['middlename'],
    			'last_name'=>$data['lastname'],
    			'email'=>$data['email'],
    			'age'=> isset($data['age']) ? $data['age'] : 0 ,
    			'gender'=> isset($data['gender']) ? $data['gender'] : 0 ,
    			'mobile_no'=>$data['mobile_no'],
    			'user_name'=>$data['username'],
    			'password'=>$data['password'],
    			'blood_group'=> isset($data['blood_group']) ? $data['blood_group'] : 0 ,
    // 			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
       			'date_of_birth'=> isset($data['date_of_birth']) ? date('Y-m-d',strtotime($data['date_of_birth'])) : null ,

    			'status'=>$data['status'],
    			'tenant_code'=>$data['tenant_code'],
    			
    			//14-jul-2022
    			'user_type' => '2',
			    'address'=>$data['address'],
			
		        // 28-march-2023
			    'chatbot_url' => $data['chatbot_url'],

    			//	START - 8-jun-2022
    			'created_at'=>date('Y-m-d H:i:s'),
    			'modified_at'=>date('Y-m-d H:i:s')
    		);
    		$this->db->insert('user_admin',$insert_data);
    		
    		// email when add tenant
    		if($this->db->insert_id()) {
        		$inserted_user_id = $this->db->insert_id();
                // checked_menu - tenant_privileges
//                if (isset($data['checked_menu']) && $data['checked_menu'] != "") {
                $rand_letter = $this->addTenantPrivilege($inserted_user_id, $data['checked_menu']);
//                }
                // 9-aur-2022
        		if(isset($data['licence']) && $data['licence'] >=1) {
					if($data['licence'] >= 1) {

						if($inserted_user_id) {
							$this->db->select('user_admin.id , user_admin.total_licence  ');
							$this->db->where('user_admin.is_deleted','0');
							$this->db->where('user_admin.id', $inserted_user_id);
							$res_user_admin = $this->db->get('user_admin')->row();
							if($res_user_admin ) {
								$total_licence = (int) $res_user_admin->total_licence +  (int) $data['licence'];
								$update_user_admin = array('total_licence' => $total_licence  );
								$this->db->where('user_admin.id',  $inserted_user_id);
								$this->db->update('user_admin', $update_user_admin  );
							}
						}
						$start_code = 1 ;
						$licence= $data['licence'] ;
						$start_date = date('Y-m-d',strtotime($data['start_date']))  ;
						while($start_code <= $licence) {
							$rand_letter = $this->getRandomLetter(2);
							$end_date = date('Y-m-d', strtotime($start_date . ' +364 day'));
							$insert_data_tenant_licence= array(
								'licence_key' =>  time().$rand_letter.$inserted_user_id.$start_code,
								'tenant_id' => $inserted_user_id,
								'start_date' => $start_date,
								'end_date' => $end_date,
							);
							$this->db->insert('tenant_licence',$insert_data_tenant_licence);
							$start_code++;
						}
					}
				}
				
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
	public function getAdmin($id = null)
	{	
		$this->db->select('id as uid,first_name,middle_name,last_name,email,mobile_no,gender,age,blood_group,date_of_birth,status');
		$this->db->where('is_deleted','0');
		//$this->db->group_by('type_id');
		if ($id != null && $id != '1') {
            $this->db->where('id', $id);
        }
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
		$this->db->select('id,type,locations,title,message, created_at');
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
	
	public function getPreTriggerNotifications_old($tid='')
	{
		$this->db->select('pre_trigger_notifications.* ,users.tenant_id');
		$this->db->from('pre_trigger_notifications');
	
		$this->db->order_by('pre_trigger_notifications.id','desc');
	//	$this->db->group_by('panic_request.id');
		$this->db->group_by('pre_trigger_notifications.user_id'); // added 3-7-2021
		$this->db->group_by('pre_trigger_notifications.pre_trigger_id'); // added 3-7-2021
		
		     		$this->db->where('pre_trigger_notifications.user_id !=','0');

	    // 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            		$this->db->select('users.tenant_id');

            $this->db->where('users.tenant_id', $tid);
        $this->db->join('users','users.id = pre_trigger_notifications.user_id','left');
        } else {
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
    // rewrite new - getPreTriggerNotifications
    // added on 11-oct-2022
    public function getPreTriggerNotifications($tid = '', $page) {
        $range1 = $page;
        $range2 = $range1 - 1;
        if ($page == 1) {
            $range_limit = 0;
        } else {
            $range3 = $range2 * 10;
            $range_limit = $range3;
        }
        $this->db->select('pre_trigger_notifications.id, pre_trigger_notifications.user_id, pre_trigger_notifications.pre_trigger_id, pre_trigger_notifications.status, pre_trigger_notifications.vehicle_number ,pre_trigger_notifications.tracking_id ,users.tenant_id');
        $this->db->from('pre_trigger_notifications');

        $this->db->order_by('pre_trigger_notifications.id', 'desc');
        $this->db->group_by('pre_trigger_notifications.user_id'); // added 3-7-2021
        $this->db->group_by('pre_trigger_notifications.pre_trigger_id'); // added 3-7-2021
        $this->db->where('pre_trigger_notifications.user_id !=', '0');
        if ($tid != "" && $tid != 1) {
            $this->db->select('users.tenant_id');
            $this->db->where('users.tenant_id', $tid);
            $this->db->join('users', 'users.id = pre_trigger_notifications.user_id', 'left');
        } else {
            $this->db->join('users', 'users.id = pre_trigger_notifications.user_id', 'left');
        }
        $this->db->limit(10, $range_limit);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }

    // added on 11-oct-2022
    public function getPreTriggerNotificationsNextRecord($tid, $page) {
        $range1 = $page;
        $range2 = $range1 - 1;
        if ($page == 1) {
            $range_limit = 0;
        } else {
            $range3 = $range2 * 10;
            $range_limit = $range3;
        }
        $this->db->select('pre_trigger_notifications.id, pre_trigger_notifications.user_id, pre_trigger_notifications.pre_trigger_id, pre_trigger_notifications.status, pre_trigger_notifications.vehicle_number ,pre_trigger_notifications.tracking_id ,users.tenant_id');
        $this->db->from('pre_trigger_notifications');
        $this->db->order_by('pre_trigger_notifications.id', 'desc');
        $this->db->group_by('pre_trigger_notifications.user_id');
        $this->db->group_by('pre_trigger_notifications.pre_trigger_id');
        $this->db->where('pre_trigger_notifications.user_id !=', '0');
        if ($tid != "" && $tid != 1) {
            $this->db->select('users.tenant_id');
            $this->db->where('users.tenant_id', $tid);
            $this->db->join('users', 'users.id = pre_trigger_notifications.user_id', 'left');
        } else {
            $this->db->join('users', 'users.id = pre_trigger_notifications.user_id', 'left');
        }
        $this->db->limit(10, $range_limit);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }
	
	public function getTracking($tid)
	{
		$this->db->select('tracking.*, users.tenant_id');
		$this->db->from('tracking');
		$this->db->where('tracking.mode_backend','1');
	
	// 14-jul-2022
        if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->join('users','users.id = tracking.trackee_id','left');
        
        
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
// 		$this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp, user_multimedia.content_type, user_multimedia.module_type, user_multimedia.followme_id, user_multimedia.followme_safe_status, users.tenant_id');
		$this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,panic_request.user_lat,panic_request.user_long,panic_request.timestamp, user_multimedia.content_type, user_multimedia.module_type, user_multimedia.followme_id, user_multimedia.followme_safe_status, users.tenant_id');
		$this->db->from('panic_request');
		$this->db->join('user_multimedia','user_multimedia.panic_id = panic_request.id','left');
// 		$this->db->join('users','users.id = user_multimedia.user_id','left');
		$this->db->join('users','users.id = panic_request.user_id','left');
		
	    // 14-jul-2022
       if($tid !="" && $tid != 1 ) {
            $this->db->where('users.tenant_id', $tid);
        }
       
 		$this->db->where('users.is_deleted','0');
		
		
	//	$this->db->where('user_multimedia.module_type','1');
		//$this->db->where('user_multimedia.content_type','3');
	//	$this->db->or_where('user_multimedia.module_type','4');

        // $where = '   (user_multimedia.module_type="1" or user_multimedia.module_type = "4")';
        $where = '  (user_multimedia.module_type="1" or user_multimedia.module_type = "4")';
        $this->db->where($where);
       
        
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
		$this->db->select('users.id as uid,users.first_name,users.middle_name,users.last_name,users.email,users.mobile_no,users.gender,users.date_of_birth,users.status, users.tenant_licence_id');
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
		
		    if($status == 4) {
		        $this->db->where('users.tenant_licence_id IS NOT NULL', NULL, FALSE);
		    } else  if($status == 5) {
		        $this->db->where('users.tenant_licence_id IS NULL', null, false);
		    } else {
			$this->db->where('users.status',$status);
		    }
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
	
        public function getPlans($tid = '') {
        if ($tid != null && $tid != 1) {
            $this->db->select('plan_master.id, plan_master.title, plan_master.duration, plan_master.price, plan_master.status, plan_master.sos, plan_master.sos_description, plan_master.follow_me, plan_master.follow_me_description, plan_master.posh, plan_master.posh_description, plan_master.ambulance, plan_master.ambulance_description, plan_master.road_side_assistance, plan_master.road_side_assistance_description, plan_master.accidental_insurance, plan_master.accidental_insurance_description, plan_master.is_changed, plan_master.old_id, plan_master.updated_field, plan_master.is_deleted, plan_master.created_at, plan_master.tenant_id');
            $this->db->from('plan_master');
            $this->db->where('plan_master.is_deleted', '0');
            $this->db->where('plan_master.is_changed', '0');
            $this->db->where('plan_master.tenant_id', $tid);
            $q = $this->db->get();
            return $q->result_array();
        } else {
            $this->db->select('plan_master.id, plan_master.title, plan_master.duration, plan_master.price, plan_master.status, plan_master.sos, plan_master.sos_description, plan_master.follow_me, plan_master.follow_me_description, plan_master.posh, plan_master.posh_description, plan_master.ambulance, plan_master.ambulance_description, plan_master.road_side_assistance, plan_master.road_side_assistance_description, plan_master.accidental_insurance, plan_master.accidental_insurance_description, plan_master.is_changed, plan_master.old_id, plan_master.updated_field, plan_master.is_deleted, plan_master.created_at, plan_master.tenant_id');
            $this->db->from('plan_master');
            $this->db->where('plan_master.is_deleted', '0');
            $this->db->where('plan_master.is_changed', '0');
            $q = $this->db->get();
            return $q->result_array();
        }
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
		return $this->db->update('users',array('is_deleted'=>'1',  'status'=>'2'));
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
        
        // print_r($data->type);
        // die;
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
            
            $title_value = unhtmlspecialchars($data->title);
            $res = $this->firebase->send_notification_to_all($data->title,$loc,$data->notice_title);
            //echo "<pre>";print_r($res);exit;

            $title_value = unhtmlspecialchars($data->title);
            $this->db->insert('notifications',array('type'=>'1','locations'=>'0','message'=>$title_value,'title'=>$data->notice_title,'description'=>$data->api_content,
            'tenant_id'=> $tenant_id,
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
                                $title_value = unhtmlspecialchars($data->title);
                                $this->firebase->send_notification($title_value,$v->device_token,$data->notice_title);
                            }
                        }
                        
                    }//exit;
                }
                                $title_value = unhtmlspecialchars($data->title);
                $this->db->insert('notifications',array('type'=>'2','locations'=>$lid,'message'=>$title_value,'title'=>$data->notice_title,'description'=>$data->api_content,
                'tenant_id'=> $tenant_id,
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
                                $title_value = unhtmlspecialchars($data->title);
                                $this->firebase->send_notification($title_value,$v->device_token,$data->notice_title);
                            }
                        }
                                $title_value = unhtmlspecialchars($data->title);
                         $this->db->insert('notifications',array('type'=>'3','locations'=>$loc_id,'message'=>$title_value,'title'=>$data->notice_title,'description'=>$data->api_content,
                      'tenant_id'=> $tenant_id,   'created_at' => date('Y-m-d H:i:s')
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
        // $this->db->where('user_multimedia.module_type', '1');
        // $this->db->or_where('user_multimedia.module_type', '4');
        $where = '  (user_multimedia.module_type="1" or user_multimedia.module_type = "4")';
        $this->db->where($where);
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
    public function addUserTempData($insert_data,$session_id, $admin_select, $start_date=null, $end_date=null, $licence_days=null, $plan_id = null){
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
	        
	        'start_date'=>$start_date,
			'end_date'=>$end_date,
			'licence_days'=>$licence_days,
			'plan_id'=> $plan_id,
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
		$this->db->select('id,first_name,middle_name,last_name, email,mobile,   gender,dob,  age,status,contact_1,contact_name_1,contact_2,contact_name_2,contact_3,contact_name_3,contact_4, contact_name_4 , tenant_licence_id, is_updated');
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
                                
                                
                             	$this->db->select('id');
								$this->db->from('tenant_licence');
								$this->db->order_by('id', 'desc');
								$q_tenant_licence = $this->db->get()->row();
								if($q_tenant_licence) {
									$tenant_licence_last_id = $q_tenant_licence->id+1;
								} else {
									$tenant_licence_last_id = 1;
								}
									
								    	$rand_letter = $this->getRandomLetter(2);
								$insert_data_tenant_licence= array(
									'licence_key' => time().$rand_letter .  '1'.$tenant_licence_last_id,
									'tenant_id' => $v['tenant_id'],
									 'start_date' => $v['start_date'] ,
								 'end_date' => $v['end_date'] ,
									//'user_id' => $datas['user_id'],
									'licence_days' => $v['licence_days'] ,
									'plan_id' => $v['plan_id'] ,
								//	'is_use' =>  '1',
								);
								$this->db->insert('tenant_licence',$insert_data_tenant_licence);
								$inserted_tenant_licence = $this->db->insert_id();

        	    
        	    
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
        		      //          		        'tenant_licence_id' => $v['tenant_licence_id'],
        		        'tenant_licence_id' => $inserted_tenant_licence,

        	        );
	        
        	        $this->db->insert('users',$insert_data);
        	        $inserted_user_id = $this->db->insert_id();
        	        
        	        // START - 6-aug-2022 // change auth_key
    				$where_data = array(
    					'id' =>  $inserted_user_id
    				);
    				$token = AUTHORIZATION::generateToken($where_data);
    				//update Acess Token
    				$this->db->where('id',$inserted_user_id);
    				$this->db->update('users',array('auth_key'=>$token));
    				// END - 6-aug-2022 
				
					if( $inserted_tenant_licence !=null) {

							// update licence
							$update_data_tenant_licence= array(
								'user_id' => $inserted_user_id,
								'is_use' =>  '1',
						);
					    $this->db->where('id',  $inserted_tenant_licence);

				// 		$this->db->where('id',  $v['tenant_licence_id']);
				// 		$this->db->where('tenant_id', $v['tenant_id']);
						$this->db->update('tenant_licence',$update_data_tenant_licence);
						//echo $this->db->last_query();//  die;
					}
				
        	        // 11-jun-2022
        	        // add user plan
        	        if ($inserted_user_id) {
        	            $insert_data_user_plan = array(
            	            'user_id'=> $inserted_user_id,
            		        // 'plan_id'=> 1,
            		        'plan_id'=> $v['plan_id'],
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
		
	public function getBulkUserTempData($session_id) {	
		//$this->db->select('id,tenant_id, first_name,middle_name,last_name, email,mobile,    gender,dob, age,status,contact_1,contact_2,contact_3,contact_4');
		//$this->db->where('is_deleted','0');
		 
		 		$this->db->where('is_declined','0');
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
		$this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,user_multimedia.user_lat,user_multimedia.user_long,panic_request.timestamp, users.tenant_id');
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
	   // echo $this->db->last_query();
	   // var_dump($res);
	   // die;
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
    			'city'=>$data['city'],
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
    	//	if($this->db->affected_rows() > 0){
    		if($uid){
    			return true;
    		}else{
    			return false;
    		}
	        }
	    } else {
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
    			'city'=>$data['city'],
    			'status'=>$data['status'],
    			'tenant_id'=>$data['admin_select']
    
    		);
    		$this->db->insert('users',$insert_data);
    		$uid= $this->db->insert_id();
    		if($uid){
    		    
    		    $this->db->select('id');
				$this->db->from('tenant_licence');
				$this->db->order_by('id', 'desc');
				$q_tenant_licence = $this->db->get()->row();
				
				if($q_tenant_licence) {
					$tenant_licence_last_id = $q_tenant_licence->id+1;
				} else {
					$tenant_licence_last_id = 1;
				}
				//$start_date = date('Y-m-d' )  ;
				if(isset($data['licence_days'])  && $data['licence_days'] !=null ) {
					$licence_days = $data['licence_days'];
					$licence_days_count = $licence_days;
					$licence_days_count = $licence_days_count-1;
				
				if($data['start_date'] =="") {
					$start_date = date('Y-m-d')  ;
				} else {
					$start_date = date('Y-m-d', strtotime($data['start_date']))  ;
				}
			    $end_date = date('Y-m-d', strtotime($start_date . ' +'.$licence_days_count.' day'));

				//$end_date = date('Y-m-d', strtotime($start_date . ' +364 day'));
				$rand_letter = $this->getRandomLetter(2);
				$insert_data_tenant_licence= array(
					'licence_key' => time().$rand_letter .  '1'.$tenant_licence_last_id,
					'tenant_id' =>  1,
					'start_date' => $start_date ,
				 	'end_date' => $end_date ,
					'user_id' => $uid,
				// 	'licence_days' => 364 ,
					'licence_days' => $licence_days ,
				 	'is_use' => '1',
				);
				$this->db->insert('tenant_licence',$insert_data_tenant_licence);
				$inserted_tenant_licence = $this->db->insert_id();

				$update_users_detail = array('tenant_licence_id' => $inserted_tenant_licence  );
				$this->db->where('users.id', $uid);
				$this->db->update('users', $update_users_detail  );
				}
				
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
            $mobile_no = $data['mobile_no'];
            $this->db->where('users.tenant_id', $admin_select);
            $this->db->where('users.mobile_no', $mobile_no);
            $this->db->where('users.id !=', $id);
            $this->db->where('users.is_deleted', "0");
            $this->db->from('users');
            $q = $this->db->get();
        } else {
            $data = $this->array_flatten($res);
            $admin_select = $data['admin_select'];
            $mobile_no = $data['mobile_no'];
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

    public function getAdminDetailById($id = '') {
        if ($id) {
            $this->db->select('user_admin.id , user_admin.user_name, user_admin.first_name,user_admin.middle_name,user_admin.last_name,user_admin.email,user_admin.mobile_no  ');
            $this->db->where('user_admin.is_deleted', '0');
            $this->db->where('user_admin.id', $id);
            $res = $this->db->get('user_admin')->row();
            return $res;
        } else {
            return false;
        }
    }

    public function getUserEvidenceByPanicId($e_id) {
        $this->db->select('panic_request.id,users.first_name,users.last_name,users.email,users.mobile_no,users.blood_group,users.gender,panic_request.user_lat,panic_request.user_long,panic_request.user_id,panic_request.timestamp as created_at');
        $this->db->from('panic_request');
        // $this->db->join('user_multimedia', 'user_multimedia.panic_id = panic_request.id', 'left');
        $this->db->join('users', 'users.id = panic_request.user_id', 'left');
        $this->db->where('users.is_deleted', '0');
        $this->db->where('panic_request.id', $e_id);

        $this->db->group_by('panic_request.id');
        $this->db->order_by('timestamp', 'desc');
        $q = $this->db->get();

        return $q->row_array();
    }

    public function getAdminLicence($id = '') {
        if ($id) {
            $this->db->select('tenant_licence.id , tenant_licence.licence_key, tenant_licence.tenant_id,tenant_licence.start_date,tenant_licence.end_date,tenant_licence.user_id,tenant_licence.is_use ,users.first_name, users.last_name, users.mobile_no ');
            $this->db->where('tenant_licence.is_deleted', '0');
            $this->db->where('tenant_licence.tenant_id', $id);

            $this->db->join('users', 'tenant_licence.user_id = users.id', 'left');

            $this->db->order_by('tenant_licence.id', 'desc');
            $res = $this->db->get('tenant_licence')->result_array();
            return $res;
        } else {
            return false;
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

    public function addAdminLicence($input_data, $id) {
	
		foreach ($input_data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }	
		$data = $this->array_flatten($res);
		if (isset($data['licence']) && $data['licence'] >= 1) {
			if ($data['licence'] >= 1) {

				if ($id) {
					$this->db->select('user_admin.id , user_admin.total_licence  ');
					$this->db->where('user_admin.is_deleted', '0');
					$this->db->where('user_admin.id', $id);
					$res_user_admin = $this->db->get('user_admin')->row();
					if ($res_user_admin) {
						$total_licence = (int) $res_user_admin->total_licence + (int) $data['licence'];
						$update_user_admin = array('total_licence' => $total_licence);
						$this->db->where('user_admin.id', $id);
                		$this->db->update('user_admin', $update_user_admin);
					}
				}	
				$start_code = 1;
				$licence = $data['licence'];
				$start_date = null;
				if (isset($data['start_date']) && $data['start_date'] != null) {
			    	$start_date = date('Y-m-d', strtotime($data['start_date']));
				}
			//	$start_date = date('Y-m-d',strtotime($data['start_date']))  ;


                $this->db->select('id');
				$this->db->from('tenant_licence');
				$this->db->order_by('id', 'desc');
				$q_tenant_licence = $this->db->get()->row();
				if ($q_tenant_licence) {
					$tenant_licence_last_id = $q_tenant_licence->id + 1;
				} else {
					$tenant_licence_last_id = 1;
				}
				
				while ($start_code <= $licence) {
					$rand_letter = $this->getRandomLetter(2);
					
			        $end_date = null;
					$licence_days = null;
					if (isset($data['licence_days']) && $data['licence_days'] != null) {
						$licence_days = $data['licence_days'] - 1;
						if ($start_date != null) {

							$end_date = date('Y-m-d', strtotime($start_date . ' +' . $licence_days . ' day'));
						}
					}
					//$end_date = date('Y-m-d', strtotime($start_date . ' +364 day'));
					$insert_data_tenant_licence = array(
						'licence_key' => time() . $rand_letter . $id . $tenant_licence_last_id,
						'tenant_id' => $id,
						'start_date' => $start_date,
						'end_date' => $end_date,
				        'licence_days' => $licence_days,
				        'plan_id' => $data['plan_id'],
					);
					$this->db->insert('tenant_licence', $insert_data_tenant_licence);
				    $tenant_licence_last_id = $this->db->insert_id() + 1;

					$start_code++;
				}
			}
		}
		return true;
	}

    //4-aug-2022
    public function getTenantLicence($id) {
        $this->db->select('tenant_licence.id , tenant_licence.licence_key, tenant_licence.tenant_id  ');
        $this->db->where('tenant_licence.is_deleted', '0');
        $this->db->where('tenant_licence.is_use', '0');
        $this->db->where('tenant_licence.start_date <=', date('Y-m-d'));
        //$this->db->where('tenant_licence.end_date >=',  date('Y-m-d'));

        $this->db->where('tenant_licence.tenant_id', $id);
        $res_user_admin = $this->db->get('tenant_licence')->result_array();

        $licence_id_arr = array();
        if ($res_user_admin) {
            $licence_id_arr = array_column($res_user_admin, 'id');
        }
        return $licence_id_arr;
    }

    public function getCallAmbulance($tid = '') {
        $this->db->select('call_ambulance.id,call_ambulance.user_id,call_ambulance.latitude,call_ambulance.longitude,call_ambulance.device_id,call_ambulance.request_id,call_ambulance.created_at, users.first_name, users.last_name, users.tenant_id, call_ambulance.ambulance_service_id, call_ambulance.dest_lat, call_ambulance.dest_long, call_ambulance.crn');
        $this->db->from('call_ambulance');
        $this->db->join('users', 'users.id = call_ambulance.user_id', 'left');
        $this->db->where('users.is_deleted', '0');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->order_by('call_ambulance.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getCallRsa($tid = '') {
        $this->db->select('call_rsa.id,call_rsa.user_id,call_rsa.client,call_rsa.contact_name,call_rsa.bdlatitude,call_rsa.bdlongitude,call_rsa.caseid,call_rsa.cancel_status,call_rsa.created_at, users.first_name, users.last_name, users.tenant_id');
        $this->db->from('call_rsa');
        $this->db->join('users', 'users.id = call_rsa.user_id', 'left');
        // $this->db->where('users.is_deleted', '0');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->order_by('call_rsa.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getPaymentDetail($tid = '') {
        $this->db->select('user_payment.id,user_payment.user_id,user_payment.transaction_id,user_payment.transaction_amount,user_payment.plan_id,user_payment.payment_for, user_payment.licence_days, user_payment.created_at, user_payment.licence_key_id, users.first_name, users.last_name, users.tenant_id, users.is_deleted, plan_master.title, tenant_licence.licence_key');
        $this->db->from('user_payment');
        $this->db->join('users', 'users.id = user_payment.user_id', 'left');
        $this->db->join('plan_master', 'plan_master.id = user_payment.plan_id', 'left');
        $this->db->join('tenant_licence', 'tenant_licence.id = user_payment.licence_key_id', 'left');
        // $this->db->where('users.is_deleted', '0');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->order_by('user_payment.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getPlanDetailById($id = '') {
        if ($id) {
            $this->db->where('plan_master.id', $id);
            // $this->db->where('plan_master.is_deleted', "0");
            $this->db->from('plan_master');
            $q = $this->db->get();
            $res = $q->row_array();
            return $res;
        } else {
            return array();
        }
    }

    public function updatePlan($data, $id) {
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            $old_id = $id;
            $insert_flag = "0";
            $update_field = array();
            $plan_res = $this->getPlanDetailById($id);
            if ($plan_res) {
                $plan_res_title = $plan_res['title'];
                $plan_res_duration = $plan_res['duration'];
                $plan_res_price = $plan_res['price'];
                $plan_res_status = $plan_res['status'];
                $plan_res_sos = $plan_res['sos'];
                $plan_res_follow_me = $plan_res['follow_me'];
                $plan_res_posh = $plan_res['posh'];
                $plan_res_ambulance = $plan_res['ambulance'];
                $plan_res_road_side_assistance = $plan_res['road_side_assistance'];
                $plan_res_accidental_insurance = $plan_res['accidental_insurance'];
                $plan_res_tenant_id = $plan_res['tenant_id'];
                // title
                if ($plan_res_title != $data['title']) {
                    $insert_flag = "1";
                    $update_field[] = "title";
                }
                // duration
                if ($plan_res_duration != $data['duration']) {
                    $insert_flag = "1";
                    $update_field[] = "duration";
                }
                // price
                if ($plan_res_price != $data['price']) {
                    $insert_flag = "1";
                    $update_field[] = "price";
                }
                // status
                if ($plan_res_status != $data['status']) {
                    $insert_flag = "1";
                    $update_field[] = "status";
                }
                // sos
                if ($plan_res_sos != $data['sos']) {
                    $insert_flag = "1";
                    $update_field[] = "sos";
                }
                // sos_description
                if ($plan_res_sos != $data['sos_description']) {
                    $update_field[] = "sos_description";
                }
                // follow_me
                if ($plan_res_follow_me != $data['follow_me']) {
                    $insert_flag = "1";
                    $update_field[] = "follow_me";
                }
                // posh
                if ($plan_res_posh != $data['posh']) {
                    $insert_flag = "1";
                    $update_field[] = "posh";
                }
                // ambulance
                if ($plan_res_ambulance != $data['ambulance']) {
                    $insert_flag = "1";
                    $update_field[] = "ambulance";
                }
                // road_side_assistance
                if ($plan_res_road_side_assistance != $data['road_side_assistance']) {
                    $insert_flag = "1";
                    $update_field[] = "road_side_assistance";
                }
                // accidental_insurance
                if ($plan_res_accidental_insurance != $data['accidental_insurance']) {
                    $insert_flag = "1";
                    $update_field[] = "accidental_insurance";
                }
                $curr_tenant_id = (isset($data['tenant_id']) && $data['tenant_id'] != "" ) ? $data['tenant_id'] : null;
                $ins_tenant_id = null;
                if ($plan_res_tenant_id != 1 && $curr_tenant_id == 1) {
                    $ins_tenant_id = $plan_res_tenant_id;
                } else {
                    $ins_tenant_id = $curr_tenant_id;
                }
            }
            $update_field_json = json_encode($update_field);

            if ($insert_flag == "1") {
                $update_data = array(
                    'is_changed' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $id);
                $this->db->update('plan_master', $update_data);

                $insert_data = array(
                    'title' => $data['title'],
                    'duration' => $data['duration'],
                    'price' => $data['price'],
                    'status' => $data['status'],
                    'plan_description' => $data['plan_description'],
                    'sos' => $data['sos'],
                    'follow_me' => $data['follow_me'],
                    'posh' => $data['posh'],
                    'ambulance' => $data['ambulance'],
                    'road_side_assistance' => $data['road_side_assistance'],
                    'accidental_insurance' => $data['accidental_insurance'],
                    'sos_description' => $data['sos_description'],
                    'follow_me_description' => $data['follow_me_description'],
                    'posh_description' => $data['posh_description'],
                    'ambulance_description' => $data['ambulance_description'],
                    'road_side_assistance_description' => $data['road_side_assistance_description'],
                    'accidental_insurance_description' => $data['accidental_insurance_description'],
                    'is_changed' => '0',
                    'old_id' => $old_id,
                    'updated_field' => $update_field_json,
                    'created_at' => date('Y-m-d H:i:s'),
                    // 'tenant_id' => (isset($data['tenant_id']) && $data['tenant_id'] != "" ) ? $data['tenant_id'] : null,
                    'tenant_id' => $ins_tenant_id,
                );
                $this->db->insert('plan_master', $insert_data);
            } else {
                $update_data = array(
                    'title' => $data['title'],
                    'duration' => $data['duration'],
                    'price' => $data['price'],
                    'status' => $data['status'],
                    'plan_description' => $data['plan_description'],
                    'sos' => $data['sos'],
                    'follow_me' => $data['follow_me'],
                    'posh' => $data['posh'],
                    'ambulance' => $data['ambulance'],
                    'road_side_assistance' => $data['road_side_assistance'],
                    'accidental_insurance' => $data['accidental_insurance'],
                    'sos_description' => $data['sos_description'],
                    'follow_me_description' => $data['follow_me_description'],
                    'posh_description' => $data['posh_description'],
                    'ambulance_description' => $data['ambulance_description'],
                    'road_side_assistance_description' => $data['road_side_assistance_description'],
                    'accidental_insurance_description' => $data['accidental_insurance_description'],
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $id);
                $this->db->update('plan_master', $update_data);
            }
        }
        return true;
    }

    public function deletePlan($id) {
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            $update_data = array(
                'is_deleted' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $id);
            $this->db->update('plan_master', $update_data);
        }
        return true;
    }

    public function addPlan($data) {
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        date_default_timezone_set('Asia/Kolkata');
        $data = array(
            'title' => $data['title'],
            'duration' => $data['duration'],
            'price' => $data['price'],
            'status' => $data['status'],
            'plan_description' => $data['plan_description'],
            'sos' => $data['sos'],
            'follow_me' => $data['follow_me'],
            'posh' => $data['posh'],
            'ambulance' => $data['ambulance'],
            'road_side_assistance' => $data['road_side_assistance'],
            'accidental_insurance' => $data['accidental_insurance'],
            'sos_description' => $data['sos_description'],
            'follow_me_description' => $data['follow_me_description'],
            'posh_description' => $data['posh_description'],
            'ambulance_description' => $data['ambulance_description'],
            'road_side_assistance_description' => $data['road_side_assistance_description'],
            'accidental_insurance_description' => $data['accidental_insurance_description'],
            'created_at' => date('Y-m-d H:i:s'),
            'tenant_id' => (isset($data['tenant_id']) && $data['tenant_id'] != "" ) ? $data['tenant_id'] : null,
       );
        $this->db->insert('plan_master', $data);
        // return $this->db->insert_id();
        return true;
    }

    public function getTodayTracking($tid) {
        $this->db->select('tracking.*, users.tenant_id');
        $this->db->from('tracking');
        $this->db->where('tracking.mode_backend', '1');

        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->join('users', 'users.id = tracking.trackee_id', 'left');

        $this->db->where('tracking.start_time >=', date("Y-m-d 00:00:00"));
        $this->db->where('tracking.start_time <=', date("Y-m-d 23:23:59"));
        // $this->db->where('tracking.start_time >=', date("Y-m-19 00:00:00"));
        // $this->db->where('tracking.start_time <=', date("Y-m-19 23:23:59"));

        $this->db->order_by('tracking.id', 'desc');
        $this->db->group_by('tracking.firebase_key');

        $q = $this->db->get();
        return $q->result_array();
    }

    public function getTripTracking($tid) {
        $this->db->select('tracking.*, users.tenant_id');
        $this->db->from('tracking');
        $this->db->where('tracking.mode_backend', '1');

        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->join('users', 'users.id = tracking.trackee_id', 'left');

        $this->db->order_by('tracking.id', 'desc');
        //	$this->db->group_by('users.id');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getTripCountById($trackee_id) {
        $this->db->select('tracking.* ');
        $this->db->from('tracking');
        $this->db->where('tracking.mode_backend', '1');
        $this->db->where('tracking.trackee_id', $trackee_id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function getUserTripDetail($user_id) {
        $this->db->select('tracking.* ');
        $this->db->from('tracking');
        $this->db->where('tracking.mode_backend', '1');
        $this->db->where('tracking.trackee_id', $user_id);
        $this->db->order_by('tracking.id', 'asc');
        $q = $this->db->get();
        return $q->result_array();
    }

    // 22-aug-2022
    public function deleteRegularNotifications($id) {
        $this->db->where('id', $id);
        return $this->db->update('notifications', array('is_deleted' => '1'));
    }

    public function getTrackingById($id = '') {
        if ($id) {
            $this->db->where('tracking.id', $id);
            $this->db->from('tracking');
            $q = $this->db->get();
            $res = $q->row_array();
            return $res;
        } else {
            return array();
        }
    }

    public function getTrackingIdShareName($firebase_key) {
        $name_arr_str = "";
        if ($firebase_key) {
            $this->db->select('tracking.tracker_id');
            $this->db->where('tracking.firebase_key', $firebase_key);
            $this->db->from('tracking');
            $q = $this->db->get();
            $res = $q->result_array();
            if ($res) {
                $tracker_id = array_column($res, 'tracker_id');
                if ($tracker_id) {
                    $this->db->select('users.first_name, users.last_name');
                    $this->db->where_in('users.id', $tracker_id);
                    $this->db->from('users');
                    $q = $this->db->get();
                    $res_users = $q->result_array();
                    if ($res_users) {
                        $name = "";
                        $name_arr = array();
                        foreach ($res_users as $row) {
                            $name_arr[] = $row['first_name'] . " " . $row['last_name'];
                        }
                        if (!empty($name_arr)) {
                            $name_arr_str = implode(', ', $name_arr);
                        }
                    }
                }
            }
        }
        return $name_arr_str;
    }

    public function getLocationLog($firebase_key) {
        $return = "";
        if ($firebase_key) {
            $this->db->select('location_log.id, location_log.firebase_key, location_log.location_json');
            $this->db->where('location_log.firebase_key', $firebase_key);
            $this->db->from('location_log');
            $q = $this->db->get();
            $res = $q->row_array();
            if ($res) {
                $return = $res['location_json'];
            }
        }
        return $return;
    }

    // 1-sep-2022
    public function getUserPanicEvidence_OLD($tid = '') {
        $this->db->select('panic_request.id, panic_request.module_type, users.first_name,users.last_name,users.email,users.mobile_no,panic_request.user_lat,panic_request.user_long,panic_request.timestamp,  users.tenant_id, panic_request.is_read');
        $this->db->from('panic_request');
        $this->db->join('users', 'users.id = panic_request.user_id', 'left');
        $this->db->where('panic_request.module_type', '1');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->where('users.is_deleted', '0');
        $this->db->group_by('panic_request.id');
        $this->db->order_by('timestamp', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getUserMultimediaByPanicId($panic_id) {
        $this->db->select('   user_multimedia.content_type, user_multimedia.module_type, user_multimedia.followme_id, user_multimedia.followme_safe_status ');
        $this->db->from('user_multimedia');
        $this->db->where('user_multimedia.panic_id', $panic_id);
        $where = '  (user_multimedia.module_type="1" or user_multimedia.module_type = "4")';
        $this->db->where($where);
        $q = $this->db->get();
        return $q->row_array();
    }

    // 12-sep-2022
    public function updatePanicRequestReadRecord($id) {
        $this->db->where('panic_request.is_read', '1');
        $this->db->where('panic_request.id', $id);
        $this->db->from('panic_request');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $update_data = array(
                'is_read' => '2',
            );
            $this->db->where('panic_request.is_read', '1');
            $this->db->where('panic_request.id', $id);
            $this->db->update('panic_request', $update_data);
        }
        return true;
    }

    // 21-npv-2022
    public function getDashboardMenu($tenant_id = '') {
        if ($tenant_id) {
            $this->db->select('tenant_privileges.id, tenant_privileges.dashboard_menu_id, tenant_privileges.sequence,tenant_privileges.tenant_id,tenant_privileges.is_checked, default_dashboard_menu.id as default_dashboard_menu_id, default_dashboard_menu.menu_name, default_dashboard_menu.password_check');
            $this->db->where('tenant_privileges.tenant_id', $tenant_id);
            $this->db->from('tenant_privileges');
            $this->db->join('default_dashboard_menu', 'default_dashboard_menu.id = tenant_privileges.dashboard_menu_id', 'left');
            $query = $this->db->get();
            $res = $query->result_array();
            if ($query->num_rows() > 0) {
                
            } else {
                $this->db->select('default_dashboard_menu.id as default_dashboard_menu_id, default_dashboard_menu.menu_name');
                $this->db->from('default_dashboard_menu');
                $q = $this->db->get();
                $res = $q->result_array();
            }
            return $res;
        } else {
            $this->db->select('default_dashboard_menu.id as default_dashboard_menu_id, default_dashboard_menu.menu_name');
            $this->db->from('default_dashboard_menu');
            $q = $this->db->get();
            $res = $q->result_array();
            return $res;
        }
    }

    // 21-nov-2022
    public function addTenantPrivilege($tenant_id, $checked_menu) {
        $checked_menu_arr = explode(',', $checked_menu);
        if (!empty($checked_menu_arr)) {
            
        }
        if ($tenant_id) {
            $this->db->select('tenant_privileges.id, tenant_privileges.dashboard_menu_id ');
            $this->db->from('tenant_privileges');
            $this->db->where('tenant_privileges.tenant_id', $tenant_id);
            $this->db->order_by('tenant_privileges.id', 'desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $tenant_privileges_result = $query->result();
                if ($tenant_privileges_result) {
                    foreach ($tenant_privileges_result as $row) {
                        $tenant_privileges_id = $row->id;
                        $menu_id = $row->dashboard_menu_id;
                        $is_checked = "0";
                        if (in_array($menu_id, $checked_menu_arr)) {
                            $is_checked = "1";
                        }
                        $update_data = array(
                            'is_checked' => $is_checked,
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->where('tenant_privileges.id', $tenant_privileges_id);
                        $this->db->where('tenant_privileges.tenant_id', $tenant_id);
                        $this->db->update('tenant_privileges', $update_data);
                    }
                }
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
                        $is_checked = "0";
                        if (in_array($menu_id, $checked_menu_arr)) {
                            $is_checked = "1";
                        }
                        $insert_data = array(
                            'dashboard_menu_id' => $menu_id,
                            'sequence' => $default_sequence,
                            'tenant_id' => $tenant_id,
                            'is_checked' => $is_checked
                        );
                        $this->db->insert('tenant_privileges', $insert_data);
                    }
                }
            }
            return true;
        }
    }

    public function getUsersEncode($status = '', $tid, $selected_tenant = '') {
        $this->db->select('users.id as uid,users.first_name,users.middle_name,users.last_name,users.email,users.mobile_no,users.gender,users.date_of_birth,users.status, users.tenant_licence_id, user_plan.plan_id, users.tenant_id, users.address, B.first_name as tenant_first_name, B.last_name as tenant_last_name');
        $this->db->join('user_plan', 'user_plan.user_id = users.id', 'left');
        $this->db->join('user_admin as B', 'users.tenant_id = B.id', 'left');
        $this->db->where('users.is_deleted', '0');
        $this->db->where('users.user_type', '3');
        $this->db->where('users.email !=', '');
        $this->db->where('users.tenant_id is NOT NULL', NULL, FALSE);
        $this->db->where('user_plan.is_deleted', '0');
        $this->db->where('user_plan.status', '1');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        if ($selected_tenant != "") {
            $this->db->where('users.tenant_id', $selected_tenant);
        }
        if ($status) {
            if ($status == 4) {
                $this->db->where('users.tenant_licence_id IS NOT NULL', NULL, FALSE);
            } else if ($status == 5) {
                $this->db->where('users.tenant_licence_id IS NULL', null, false);
            } else {
                $this->db->where('users.status', $status);
            }
        }
        $this->db->order_by('users.id', 'desc');
        $res = $this->db->get('users')->result_array();
        return $res;
    }

    public function getLicenceDetailById($id = '') {
        if ($id != '') {
            $this->db->select('tenant_licence.id, tenant_licence.licence_key, tenant_licence.start_date, tenant_licence.end_date');
            $this->db->where('tenant_licence.is_deleted', '0');
            $this->db->where('tenant_licence.id', $id);
            $this->db->from('tenant_licence');
            $q = $this->db->get();
            $res = $q->row_array();
            return $res;
        } else {
            return array();
        }
    }

    public function getAllPlans($tenant_id = '') {
        if ($tenant_id != null && $tenant_id != 1) {
            $this->db->select('plan_master.id, plan_master.title, plan_master.duration, plan_master.price, plan_master.status, plan_master.plan_description, plan_master.sos, plan_master.sos_description, plan_master.follow_me, plan_master.follow_me_description, plan_master.posh, plan_master.posh_description, plan_master.ambulance, plan_master.ambulance_description, plan_master.road_side_assistance, plan_master.road_side_assistance_description, plan_master.accidental_insurance, plan_master.accidental_insurance_description, plan_master.is_changed, plan_master.old_id, plan_master.updated_field, plan_master.tenant_id, plan_master.is_deleted, plan_master.created_at');
            $this->db->from('plan_master');
//            $this->db->where('plan_master.is_deleted', '0');
//            $this->db->where('plan_master.is_changed', '0');
            $this->db->where('plan_master.tenant_id', $tenant_id);
            $q = $this->db->get();
            return $q->result_array();
        } else {
            $this->db->from('plan_master');
            // $this->db->where('is_deleted', '0');
            // $this->db->where('is_changed', '0');
            $q = $this->db->get();
            return $q->result_array();
        }
    }

    public function getTenantLicenceUsedByPlansId($id = '') {
        if ($id) {
            $this->db->from('tenant_licence');
			$this->db->where('plan_id', $id);
			$this->db->where('is_deleted', '0');
			$this->db->where('is_use', '1');
			$q = $this->db->get();
			return $q->num_rows();
		} else {
			return 0;
		}
    }

	public function getTenantLicenceTotalByPlansId($id = '') {
		if ($id) {
			$this->db->from('tenant_licence');
			$this->db->where('plan_id', $id);
			$this->db->where('is_deleted', '0');
			$q = $this->db->get();
			return $q->num_rows();
		} else {
			return 0;
		}
    }
    
    // 4-jan-2023 - panic_request table
    public function getSosCount($user_id) {
		$this->db->select('panic_request.id');
		$this->db->from('panic_request');
		$this->db->where('panic_request.module_type', '1');
		$this->db->where('panic_request.user_id', $user_id);
        $result = $this->db->get();
		return $result->num_rows();
    }
    
       // 4-jan-2023 - panic_request table
    public function getFollowMeCount_OLD($user_id) {
		$this->db->select('panic_request.id');
		$this->db->from('panic_request');
		$this->db->where('panic_request.module_type', '4');
		$this->db->where('panic_request.user_id', $user_id);
        $result = $this->db->get();
		return $result->num_rows();
    }

    // 4-jan-2023 - panic_request table
    public function getFollowMeCount($user_id) {
        $this->db->select('tracking.id');
        $this->db->from('tracking');
        $this->db->where('tracking.tracking_type', '2');
        $this->db->where('tracking.trackee_id', $user_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
       
    // 4-jan-2023 - call_ambulance table
    public function getAmbulanceCount($user_id) {
		$this->db->select('call_ambulance.id');
		$this->db->from('call_ambulance');
		$this->db->where('call_ambulance.user_id', $user_id);
 		$this->db->where('call_ambulance.status', '1');
        $result = $this->db->get();
		return $result->num_rows();
    }
        
    // 4-jan-2023 - call_rsa table
    public function getRoadSideAssistanceCount($user_id) {
		$this->db->select('call_rsa.id');
		$this->db->from('call_rsa');
		$this->db->where('call_rsa.user_id', $user_id);
		$this->db->where('call_rsa.status', '1');
        $result = $this->db->get();
		return $result->num_rows();
    }

    // 4-jan-2023 - call_health_insurance table
    public function getAccidentalInsuranceCount($user_id) {
		$this->db->select('call_health_insurance.id');
		$this->db->from('call_health_insurance');
		$this->db->where('call_health_insurance.member_id', $user_id);
   		$this->db->where('call_health_insurance.status', '1');
        $result = $this->db->get();
		return $result->num_rows();
    }

    // 4-jan-2023 - panic_request table
    public function getPoshCount($user_id) {
		$this->db->select('panic_request.id');
		$this->db->from('panic_request');
		$this->db->where('panic_request.module_type', '3');
		$this->db->where('panic_request.user_id', $user_id);
        $result = $this->db->get();
		return $result->num_rows();
    }

    public function getUserPlanDetail($user_id) {
        $this->db->from('user_plan');
        $this->db->join('plan_master', 'plan_master.id = user_plan.plan_id', 'left');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_plan.is_deleted', '0');
        $this->db->order_by('user_plan.id', 'DESC');
        $result = $this->db->get()->row_array();
        if (!empty($result)) {
            $sos_count = $this->getSosCount($user_id);
	        $follow_me_count = $this->getFollowMeCount($user_id);
            $posh_count = $this->getPoshCount($user_id);
		    $ambulance_count = $this->getAmbulanceCount($user_id);
		    $road_side_assistance_count = $this->getRoadSideAssistanceCount($user_id);
		    $accidental_insurance_count = $this->getAccidentalInsuranceCount($user_id);
		    $result['sos_remaining_count'] = $result['sos'] - $sos_count >=0 ? $result['sos'] - $sos_count : 0;
		    $result['follow_me_remaining_count'] = $result['follow_me'] - $follow_me_count >=0 ? $result['follow_me'] - $follow_me_count : 0;
		    $result['posh_remaining_count'] = $result['posh'] - $posh_count >=0 ? $result['posh'] - $posh_count : 0;
		    $result['ambulance_remaining_count'] = $result['ambulance'] - $ambulance_count >=0 ? $result['ambulance'] - $ambulance_count : 0;
		    $result['road_side_assistance_remaining_count'] = $result['road_side_assistance'] - $road_side_assistance_count >=0 ? $result['road_side_assistance'] - $road_side_assistance_count : 0;
		    $result['accidental_insurance_remaining_count'] = $result['accidental_insurance'] - $accidental_insurance_count >=0 ? $result['accidental_insurance'] - $accidental_insurance_count : 0;
		    return $result;
		} else {
			return false;
		}
    }

    public function getOtp() {
        $this->db->select('user_otp.id, user_otp.user_id, user_otp.mobile_no, user_otp.ref_no, user_otp.otp, user_otp.purpose, user_otp.active_platform, user_otp.created_on, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = user_otp.user_id', 'left');
        $this->db->from('user_otp');
        $this->db->order_by('user_otp.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }
    
    public function getUserOtp($id = '', $user_id = '') {
        if ($id) {
            if ($user_id != '') {
                if ($user_id == "0") {
                    $this->db->select('user_otp.id, user_otp.user_id, user_otp.mobile_no, user_otp.ref_no, user_otp.otp, user_otp.purpose, user_otp.active_platform, user_otp.created_on');
                    $this->db->from('user_otp');
        			$this->db->where('user_otp.id', $id);
                    $q = $this->db->get();
                    $res = $q->row_array();
                    if ($res) {
                        $mobile_no = $res['mobile_no'];
                        $this->db->select('user_otp.id, user_otp.user_id, user_otp.mobile_no, user_otp.ref_no, user_otp.otp, user_otp.purpose, user_otp.active_platform, user_otp.created_on, users.first_name, users.last_name');
                        $this->db->join('users', 'users.id = user_otp.user_id', 'left');
                        $this->db->from('user_otp');
            			$this->db->where('user_otp.mobile_no', $mobile_no);
                        $this->db->order_by('user_otp.id', 'desc');
                        $q = $this->db->get();
                        return $q->result_array();
                    }
                } else {
                    $this->db->select('user_otp.id, user_otp.user_id, user_otp.mobile_no, user_otp.ref_no, user_otp.otp, user_otp.purpose, user_otp.active_platform, user_otp.created_on, users.first_name, users.last_name');
                    $this->db->join('users', 'users.id = user_otp.user_id', 'left');
                    $this->db->from('user_otp');
        			$this->db->where('user_otp.user_id', $user_id);
                    $this->db->order_by('user_otp.id', 'desc');
                    $q = $this->db->get();
                    return $q->result_array();
                }
            }
		} else {
			return array();
		}
    }

    public function getCallAmbulanceById($id = '') {
        if ($id != "") {
            $this->db->select('call_ambulance.id, call_ambulance.user_id, call_ambulance.latitude, call_ambulance.longitude, call_ambulance.device_id, call_ambulance.request_id, call_ambulance.status, call_ambulance.created_at, users.first_name, users.last_name, users.tenant_id, call_ambulance.ambulance_service_id, call_ambulance.dest_lat, call_ambulance.dest_long, call_ambulance.crn');
            $this->db->from('call_ambulance');
            $this->db->join('users', 'users.id = call_ambulance.user_id', 'left');
            // $this->db->where('users.is_deleted', '0');
            $this->db->where('call_ambulance.id', $id);
            $q = $this->db->get();
            return $q->row_array();
        } else {
            return array();
        }
    }

    public function getCallRsaById($id = '') {
        if ($id != "") {
            $this->db->select('call_rsa.id, call_rsa.user_id, call_rsa.client, call_rsa.contact_name, call_rsa.mobile_no, call_rsa.pincode, call_rsa.bdlatitude, call_rsa.bdlongitude, call_rsa.bdlocation, call_rsa.state, call_rsa.subject, call_rsa.service, call_rsa.subservice, call_rsa.fuel, call_rsa.vehicleno, call_rsa.vinn, call_rsa.manufacturer, call_rsa.model, call_rsa.runningkm, call_rsa.serviceeligibility, call_rsa.policyno, call_rsa.warrplcystartdate, call_rsa.warrplcyenddate, call_rsa.policytype, call_rsa.voiceofcustomer,  call_rsa.caseid, call_rsa.vehiclecondition, call_rsa.saledate, call_rsa.accidenttype, call_rsa.vehicletype, call_rsa.vehicleloaded, call_rsa.extrafittings, call_rsa.drploctype, call_rsa.dealer, call_rsa.custpreftype, call_rsa.custdrploc, call_rsa.custdrplat, call_rsa.custdrplong, call_rsa.requestedby, call_rsa.cancel_status, call_rsa.status, call_rsa.cancel_status, call_rsa.created_at, users.first_name, users.last_name, users.tenant_id');
            $this->db->from('call_rsa');
            $this->db->join('users', 'users.id = call_rsa.user_id', 'left');
            // $this->db->where('users.is_deleted', '0');
            $this->db->where('call_rsa.id', $id);
            $q = $this->db->get();
            return $q->row_array();
        } else {
            return array();
        }
    }
    
    // 10-jan-2023
    public function getTenantLicenceCount($tenant_id = '') {
        if ($tenant_id != "") {
            $this->db->select('tenant_licence.id, tenant_licence.licence_key, tenant_licence.tenant_id, tenant_licence.is_use');
            $this->db->from('tenant_licence');
            $this->db->where('tenant_licence.tenant_id', $tenant_id);
            $q = $this->db->get();
            return $q->num_rows();
        } else {
            return array();
        }
    }

    // 10-jan-2023
    public function getTenantLicenceUsedCount($tenant_id = '') {
        if ($tenant_id != "") {
            $this->db->select('tenant_licence.id, tenant_licence.licence_key, tenant_licence.tenant_id, tenant_licence.is_use,       ');
            $this->db->from('tenant_licence');
            $this->db->where('tenant_licence.tenant_id', $tenant_id);
            $this->db->where('tenant_licence.is_use', '1');
            $q = $this->db->get();
            return $q->num_rows();
        } else {
            return array();
        }
    }

    public function getUserAmbulanceServiceByUserId($request_id = '', $user_id = '') {
        if ($request_id != "" && $user_id != "") {
            $this->db->select('user_ambulance_service.id, user_ambulance_service.mobile_no, user_ambulance_service.ziman_dial_id, user_ambulance_service.authtoken  ');
            $this->db->from('user_ambulance_service');
            $this->db->where('user_ambulance_service.user_id', $user_id);
            $q = $this->db->get();
            $res = $q->row_array();
            return $res;
        } else {
            return array();
        }
    }

    // 25-feb-2023
    public function getSettingById($id, $encode = '') {
        $this->db->from('settings');
        $this->db->where('settings.id', $id);
        $q = $this->db->get();
        $row_arr = $q->row_array();
        if (!empty($row_arr)) {
            if($encode == '1') {
                $ftr_psd = $row_arr['value'];
                return base64_encode($ftr_psd);
            } else {
                return $row_arr;
            }
        } else {
            return "";
        }
    }

    // 15-march-2023
    public function getUserPanicEvidence($tid = '', $page) {
        $range1 = $page;
        $range2 = $range1 - 1;
        if ($page == 1) {
            $range_limit = 0;
        } else {
            $range3 = $range2 * 10;
            $range_limit = $range3;
        }
        $this->db->select('panic_request.id, panic_request.module_type, users.first_name,users.last_name,users.email,users.mobile_no,panic_request.user_lat,panic_request.user_long,panic_request.timestamp,  users.tenant_id, panic_request.is_read');
        $this->db->from('panic_request');
        $this->db->join('users', 'users.id = panic_request.user_id', 'left');
        $this->db->where('panic_request.module_type', '1');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->where('users.is_deleted', '0');
        $this->db->group_by('panic_request.id');
        $this->db->order_by('timestamp', 'desc');
        $this->db->limit(10, $range_limit);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }

    public function getUserPanicEvidenceNextRecord($tid, $page) {
        $range1 = $page;
        $range2 = $range1 - 1;
        if ($page == 1) {
            $range_limit = 0;
        } else {
            $range3 = $range2 * 10;
            $range_limit = $range3;
        }
        $this->db->select('panic_request.id, panic_request.module_type, users.first_name,users.last_name,users.email,users.mobile_no,panic_request.user_lat,panic_request.user_long,panic_request.timestamp,  users.tenant_id, panic_request.is_read');
        $this->db->from('panic_request');
        $this->db->join('users', 'users.id = panic_request.user_id', 'left');
        $this->db->where('panic_request.module_type', '1');
        if ($tid != "" && $tid != 1) {
            $this->db->where('users.tenant_id', $tid);
        }
        $this->db->where('users.is_deleted', '0');
        $this->db->group_by('panic_request.id');
//		$this->db->order_by('timestamp','desc');
        $this->db->limit(10, $range_limit);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }

    public function addTenantKeyword($data) {
        date_default_timezone_set('Asia/Kolkata');
        if ($data) {
            if (!empty($data['keyword'])) {
                $keyword = $data['keyword'];
            }
            if ($keyword) {
                $tenant_id = $data['tenant_id'];
                $this->db->select('tenant_keyword.id, tenant_keyword.keyword');
                $this->db->from('tenant_keyword');
                $this->db->where('tenant_keyword.is_deleted', '0');
                $this->db->where('tenant_keyword.tenant_id', $tenant_id);
                $this->db->where('tenant_keyword.keyword', $keyword);
                $q = $this->db->get();
                $res = $q->row_array();
                if (!$res) {
                    $insert_data = array(
                        'tenant_id' => $tenant_id,
                        'keyword' => $keyword,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('tenant_keyword', $insert_data);
                }
            }
            return true;
        }
    }

    public function getTenantKeyword($tenant_id = null) {
        $this->db->select('tenant_keyword.id, tenant_keyword.keyword, tenant_keyword.tenant_id, tenant_keyword.created_at');
        $this->db->from('tenant_keyword');
        $this->db->where('tenant_keyword.is_deleted', '0');
        if ($tenant_id != null) {
            $this->db->where('tenant_keyword.tenant_id', $tenant_id);
        }
        $this->db->order_by('tenant_keyword.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getTenantKeywordAdmin() {
        $this->db->select('id as uid,first_name,middle_name,last_name,email,mobile_no,gender,age,blood_group,date_of_birth,status');
        $this->db->where('is_deleted', '0');
        $this->db->join('users', 'users.id = panic_request.user_id', 'left');
        return $this->db->get('user_admin')->result_array();
    }

    public function checkTenantKeyword($data) {
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        $keyword = $data['keyword'];
        $this->db->where('tenant_keyword.keyword', $keyword);
        $this->db->where('tenant_keyword.is_deleted', "0");
        $this->db->from('tenant_keyword');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function deleteTenantKeyword($id) {
        $this->db->where('id', $id);
        $query = $this->db->update('tenant_keyword', array('is_deleted' => '1'));
        return $query;
    }

    public function getErrorCode($id) {
        $select_data = "*";
        $table = "error_codes";
        $this->db->select($select_data);
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $result = $query->result();
        if (count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }
    }
    
    public function getUserDeviceByUserId($user_id = null) {
        if ($user_id != null) {
            $this->db->select('user_tracker_devices.id, user_tracker_devices.user_id, user_tracker_devices.device_id, user_tracker_devices.device_name, user_tracker_devices.created_at, tracker_devices.device_name as tracker_device_name, tracker_devices.device_imei ');
            $this->db->join('tracker_devices', 'tracker_devices.id = user_tracker_devices.device_id', 'left');
            $this->db->from('user_tracker_devices');
            $this->db->where('user_tracker_devices.is_deleted', '0');
            $this->db->where('user_tracker_devices.user_id', $user_id);
            $this->db->order_by('user_tracker_devices.id', 'desc');
            $q = $this->db->get();
            return $q->result_array();
        } else {
            return array();
        }
    }

    public function getTrackerDeviceNameById($tracker_device_id = null) {
        if ($tracker_device_id != null) {
            $this->db->select('  user_tracker_devices.device_name, tracker_devices.device_name as tracker_device_name, tracker_devices.device_imei ');
            $this->db->join('tracker_devices', 'tracker_devices.id = user_tracker_devices.device_id', 'left');
            $this->db->from('user_tracker_devices');
            $this->db->where('user_tracker_devices.is_deleted', '0');
            $this->db->where('user_tracker_devices.device_id', $tracker_device_id);
            $this->db->order_by('user_tracker_devices.id', 'desc');
            $q = $this->db->get();
            return $q->row_array();
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

    public function getEmergencyContact($user_id) {
        $this->db->select('first_name,last_name,mobile_no');
        $this->db->from('emergency_contacts');
        $this->db->join('users', 'emergency_contacts.emergency_user_id= users.id', 'left');
        $this->db->where('emergency_contacts.user_id', $user_id);
        $this->db->where('emergency_contacts.is_deleted', 0);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }

}

?>