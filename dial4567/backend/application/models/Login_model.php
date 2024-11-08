<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//$this->load->library('session');
		
	}

	public function verifyLogin($data)
	{	
		foreach ($data as $key => $value) {
			# code...
			$res[] = array($value->name=>$value->value); 
		}

		$result = $this->array_flatten($res);
		//	echo "<pre>";print_r($result);exit;
		/*
// 		if($result['username'] == 'admin' && $result['password'] =='123456'){
		if($result['username'] == 'admin' && $result['password'] =='Captainindia@135'){
		    $user_type = '1';
		    $this->db->where('user_name',$result['username']);
		    $this->db->where('password',$result['password']);
		    $this->db->where('status','1');
		    $this->db->where('user_type','1');
		    $data = $this->db->get('users');
		  
		}else{
		    $user_type = '2';
		    $this->db->where('user_name',$result['username']);
		    $this->db->where('password',$result['password']);
		    $this->db->where('is_deleted','0');
		    //$this->db->where('status','1');
		    $data = $this->db->get('user_admin');
		    
		   // die;
		    // 7-may-2022
		    //return $res=array('status' => false, 'message' => "Invalid user" );
           // return "status-false-message-Invalid User";
		    //echo $this->db->last_query();exit;
		}
		*/
		// 14-jul-2022
		if($result['username'] && $result['password']) {
		    $this->db->where('user_name',$result['username']);
		    $this->db->where('password',$result['password']);
		    $this->db->where('is_deleted','0');
		    //$this->db->where('status','1');
		    $data = $this->db->get('user_admin');
		    
		    if($data->row()->status == "1") {
		        
		    } else if($data->row()->status == "2") {
		        return "status-false-message-Inactive User";
		    } else if($data->row()->status == "3") {
		        return "status-false-message-Suspended User";
		    }
		}
		    
		if($data->num_rows() > 0){

			$this->session->set_userdata('session_id',$data->row()->id.time());
			//echo ;exit;
// 			return $this->session->userdata('session_id').'-'.$user_type.'-'.$data->row()->first_name.' '.$data->row()->last_name;
			return $this->session->userdata('session_id').'-'.$data->row()->user_type.'-'.$data->row()->first_name.' '.$data->row()->last_name. "-".$data->row()->id;
			//return $data->row();
		}else{
			return false;
		}
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
	

	
}
?>