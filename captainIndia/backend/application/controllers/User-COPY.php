<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller {

	/**getUserImages
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {

	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');  // cache for 1 day
		
	    $method = $_SERVER['REQUEST_METHOD'];
	    if($method == "OPTIONS") {
	        die();
	    }
	    parent::__construct();

	    $this->load->model('User_model','login'); // Loading model 
	    $this->load->library('zip');
        $this->load->helper('custom_helper');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add($id='')
	{
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->add($datas,$id);
			
		echo json_encode($result);
	}
	
	public function add_admin($id='')
	{
	    //	error_reporting(E_ALL); ini_set('display_errors', '1');
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->add_admin($datas,$id);
			
		echo json_encode($result);
	}
	
	public function addLocation($id='')
	{
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->addLocation($datas,$id);
			
		echo json_encode($result);
	}
	
	public function getUsersCSV(){
	    
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUsersCSV();
			//echo "<pre>";print_r($result);exit;
		
			echo json_encode($result);
			break;

		}
	}
	
	
	public function addGroupLocation($id='')
	{
		$datas = json_decode(file_get_contents("php://input"));
	//	echo "<pre>";print_r($datas);exit;
		$result = $this->login->addGroupLocation($datas,$id);
			
		echo json_encode($result);
	}
	

	public function getUsers($status = '',$plan='', $tid='',$selected_tenant='')
	{
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUsers($status,$plan, $tid,$selected_tenant);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
		//	$columns[] = array('label'=>'Designation');
			//$columns[] = array('label'=>'Branch');
			//$columns[] = array('label'=>'Department');
		//	$columns[] = array('label'=>'Vertical');
			$columns[] = array('label'=>'Gender');
			$columns[] = array('label'=>'DOB');
			//$columns[] = array('label'=>'Age');
			$columns[] = array('label'=>'Status');
			$columns[] = array('label'=>'Action');
			$i=1;
			foreach ($result as $key => $value) {
				# code...
		    
			 $result[$key]['first_name']=$value['first_name' ].' '.$value['middle_name' ].' '.$value['last_name' ];
			// $result[$key]['user_type']=($value['user_type' ]== 2 ) ? 'Admin':'Employee';
			 $result[$key]['gender']=($value['gender' ]== 1 ) ? 'Male':'Female';
			 if($value['status' ]== '1' ){
			     $result[$key]['status']='Active';
			 }
			 if($value['status' ]== '2' ){
			     $result[$key]['status']='In-Active';
			 }
			 if($value['status' ]== '3' ){
			     $result[$key]['status']='Suspended';
			 }
			 if(is_numeric($value['branch_name'])){
			     $result[$key]['branch_name']=$this->db->get_where('user_locations',array('id'=>$value['branch_name']))->row()->branch_name;
			 }
			 
			 //$result[$key]['status']=($value['status' ]== '1' ) ? 'Active':($value['status' ]== '2' ) ? 'In-active' : 'Suspended';
			 $result[$key]['email']=mb_substr($value['email' ], 0, 10).'...';
			 //$result[$key]['action']="<i className='fa fa-remove ptr_css' onClick=this.remove()></i>&nbsp;&nbsp;<i className='fa fa-edit ptr_css'></i>&nbsp;&nbsp;<i className='fa fa-eye ptr_css'></i>";
			 ///$result[$key]['id']=$i;
			 unset($result[$key]['middle_name']);
			 unset($result[$key]['last_name']);
			 $plan_details = $this->login->getPlanDetails($value['id']);
			
	        $now = strtotime(date('Y-m-d')); // or your date as well
            $your_date = strtotime($plan_details['end_date']);
            
            $datediff = $now - $your_date;
            $plan_details['active_days'] = abs(round($datediff / 86400));
                   
		     $result[$key]['plan']=$plan_details;
		 		     $result[$key]['licence'] = $result[$key]['tenant_licence_id'] != null ?  "Licensed" :  "Unlicensed" ;

			// $result[$key]['type_id']=$this->db->get_where('product_type',array('id'=>$value['type_id']))->row()->title;
			// $result[$key]['image_name']=$this->db->get_where('product_images',array('id'=>$value['id']))->row()->image_name;
		  
			 $i++;
			 }
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
		
	}
	
// 	public function getUsersEncode($status = '',$plan='')	{
	public function getUsersEncode($tid = '' , $status = '',$plan='')	{
		switch($_SERVER['REQUEST_METHOD']) {
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
// 			$result = $this->login->getUsers($status,$plan);
			$result = $this->login->getUsersEncode($status, $tid);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
			$columns[] = array('label'=>'Gender');
			$columns[] = array('label'=>'DOB');
			$columns[] = array('label'=>'Status');
			$columns[] = array('label'=>'Action');
			$i=1;
			foreach ($result as $key => $value) {
			 $result[$key]['first_name']=$value['first_name' ].' '.$value['middle_name' ].' '.$value['last_name' ];
			 $result[$key]['gender']=($value['gender' ]== 1 ) ? 'Male':'Female';
			 if($value['status'] == '1' ){
			     $result[$key]['status']='Active';
			 }
			 if($value['status'] == '2' ){
			     $result[$key]['status']='In-Active';
			 }
			 if($value['status'] == '3' ){
			     $result[$key]['status']='Suspended';
			 }
			 //if(is_numeric($value['branch_name'])){
			 //    $result[$key]['branch_name']=$this->db->get_where('user_locations',array('id'=>$value['branch_name']))->row()->branch_name;
			 //}
			 $result[$key]['email']=mb_substr($value['email'], 0, 10).'...';
			 unset($result[$key]['middle_name']);
			 unset($result[$key]['last_name']);
			 //$plan_details = $this->login->getPlanDetails($value['uid']);
			
	       //  $now = strtotime(date('Y-m-d')); // or your date as well
        //      $your_date = strtotime($plan_details['end_date']);
            
        //     $datediff = $now - $your_date;
        //     $plan_details['active_days'] = abs(round($datediff / 86400));
                   
		  //   $result[$key]['plan'] = $plan_details;

                $result[$key]['uid'] = base64_encode($result[$key]['uid']);
                $result[$key]['first_name'] = base64_encode($result[$key]['first_name']);
                $result[$key]['email'] = base64_encode($result[$key]['email']);
                $result[$key]['mobile_no'] = base64_encode($result[$key]['mobile_no']);
                $result[$key]['gender'] = base64_encode($result[$key]['gender']);
                $result[$key]['date_of_birth'] = base64_encode($result[$key]['date_of_birth']);
                $result[$key]['status'] = base64_encode($result[$key]['status']);
                $result[$key]['licence'] = $result[$key]['tenant_licence_id'] != null ? base64_encode("Licensed") : base64_encode("Unlicensed");
                $plan_title = "";
                if($value['plan_id'] !=null) {
    				$plan_res = $this->login->getPlanDetailById($value['plan_id']);
    				if (!empty($plan_res )) {
    					$plan_title = "Plan Name - ".$plan_res['title'];
    				}
    		    }
			    $result[$key]['licence_info'] = $plan_title;
		 
    			 $licence_key = "";
    			 if($value['tenant_licence_id'] !=null) {
    				$tenant_licence_res = $this->login->getLicenceDetailById($value['tenant_licence_id']);
    				if (!empty($tenant_licence_res )) {
    					$licence_key = "Licence Key - " . $tenant_licence_res['licence_key'];
    					$start_date = "Start date - " . $tenant_licence_res['start_date'];
    					$end_date = "End date - " . $tenant_licence_res['end_date'];
    				}
    			 }
			    $result[$key]['licence_info'] = base64_encode($licence_key . $plan_title);
    			$result[$key]['licence_key'] = base64_encode($licence_key  );
    			$result[$key]['start_date'] = base64_encode($start_date  );
    			$result[$key]['end_date'] = base64_encode($end_date  );
    			$plan_id_val = "";
    			if($value['plan_id'] != null) {
    		        $plan_id_val = "Plan Id - " . $value['plan_id'];
    			}
    	        $result[$key]['plan_title'] = base64_encode($plan_title  );
    	        $result[$key]['plan_id_val'] = base64_encode($plan_id_val  );

		        $i++;
		    }
			echo json_encode($result);
			break;
		}
	}
	
	public function getAdmin()
	{
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getAdmin();
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
			// $columns[] = array('label'=>'Designation');
			// $columns[] = array('label'=>'Branch');
			// $columns[] = array('label'=>'Department');
		//	$columns[] = array('label'=>'Vertical');
			$columns[] = array('label'=>'Gender');
			$columns[] = array('label'=>'Age');
			$columns[] = array('label'=>'Blood Group');
			$columns[] = array('label'=>'DOB');
			$columns[] = array('label'=>'Status');
			$columns[] = array('label'=>'Panic Evidences');
			$i=1;
			foreach ($result as $key => $value) {
				# code...
			 //$result[$key]['id']=$i;
			// $result[$key]['first_name']=$value['first_name' ].' '.$value['middle_name' ].' '.$value['last_name' ];
			 if($value['status' ]== '1' ){
			     $result[$key]['status']='Active';
			 }
			 if($value['status' ]== '2' ){
			     $result[$key]['status']='In-Active';
			 }
			 if($value['status' ]== '3' ){
			     $result[$key]['status']='Suspended';
			 }
			 $result[$key]['gender']=($value['gender' ]== 1 ) ? 'Male':'Female';
			 $blood_group ="";
			 if($result[$key]['blood_group'] == '1'){
			     $blood_group='A+';
			 }else if($result[$key]['blood_group'] == '2'){
			    $blood_group='B+';
			 }else if($result[$key]['blood_group'] == '3'){
			    $blood_group='O+';
			 }else if($result[$key]['blood_group'] == '4'){
			    $blood_group='AB+';
			 }else if($result[$key]['blood_group'] == '5'){
			    $blood_group='A-';
			 }else if($result[$key]['blood_group'] == '6'){
			    $blood_group='B-';
			 }else if($result[$key]['blood_group'] == '7'){
			    $blood_group='O-';
			 }else if($result[$key]['blood_group'] == '8'){
			     $blood_group='AB-';
			 }
			 $result[$key]['blood_group']=$blood_group;
			 $result[$key]['email']=mb_substr($value['email' ], 0, 10).'...';
			 $i++;
			 unset($result[$key]['middle_name']);
			 unset($result[$key]['last_name']);
			// $result[$key]['type_id']=$this->db->get_where('product_type',array('id'=>$value['type_id']))->row()->title;
			// $result[$key]['image_name']=$this->db->get_where('product_images',array('id'=>$value['id']))->row()->image_name;
			}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
		
	}
	
	public function getUserEvidence_bk_9_sep_2022($tid = '')	{
  //error_reporting(E_ALL); ini_set('display_errors', '1');
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserEvidence($tid);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
			$columns[] = array('label'=>'Latitude');
			$columns[] = array('label'=>'Longitude');
			$columns[] = array('label'=>'Date/Time');
			$columns[] = array('label'=>'Panic Evidences');
			$i = 1;
			$followme_id_arr = array();
			$result_arr = array();
			foreach ($result as $key => $value) {
			    $arr = explode(' ',$result[$key]['timestamp']);
    			//$result[$key]['idd']=$i;
    			//$result[$key]['date']=$arr['0'];
    			//$result[$key]['time']=$arr['1'];
    			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'].'    ';
    			unset($result[$key]['middle_name']);
    			unset($result[$key]['last_name']);
			 
    		    //19-jul-2022
    			$panic_type_value ="-";
    			$followme_safe_status_value ="";
    			
    			if( $value['followme_safe_status'] =='1' ) {
    			    $followme_safe_status_value="-NO";
    			} else if( $value['followme_safe_status'] =='2' ) {
    		        $followme_safe_status_value = "-NA";
    		    }
    		    if( $value['content_type'] =='4' && $value['module_type'] =='4' ) {
    		        $panic_type_value="Follow me".$followme_safe_status_value;
    		    } else {
    		        $panic_type_value = "Panic";
    		    }
		    
		    	// 2-aug-2022
    			// get tenant name
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
        			        $result[$key]['tenant_name'] = $tenant_user_name ;
     			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
			
                $result[$key]['panic_type_value'] = $panic_type_value;
                $result[$key]['followme_id'] =  $value['followme_id'] !=null ? $value['followme_id'] :""  ;
                $result[$key]['followme_id_arr'] =  $followme_id_arr ;
                
                if( $result[$key]['followme_id'] != "" ) {
    			    if (in_array( $result[$key]['followme_id'] , $followme_id_arr)) {
    			        //unset($result[$key]);
    			    } else {
    			        $result_arr[] = $result[$key];
    			         $followme_id_arr[] =   $result[$key]['followme_id'] ;
    			    }
    	 	       
    			} else {
    		        $result_arr[] = $result[$key];
    			}
    			
			    $i++;
			}
			
			// $res=array('columns'=>$columns,'rows'=>$result);
		//	echo json_encode($result);
			echo json_encode($result_arr);
			break;
		}
	}
		
	public function getUserEvidence_OLD($tid = '')	{
        error_reporting(E_ALL); ini_set('display_errors', '1');
		switch($_SERVER['REQUEST_METHOD']){

			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserPanicEvidence($tid);

			$i = 1;
			$followme_id_arr = array();
			$result_arr = array();
			foreach ($result as $key => $value) {
			    $arr = explode(' ',$result[$key]['timestamp']);

			    $result_multimedia = $this->login->getUserMultimediaByPanicId($value['id']);

    			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'];
    			unset($result[$key]['middle_name']);
    			unset($result[$key]['last_name']);

    			$panic_type_value ="-";
    			$followme_safe_status_value ="";
    			$content_type_value ="";
    			$module_type_value ="";
    			if($result_multimedia) {
        			if( $result_multimedia['followme_safe_status'] =='1' ) {
        			    $followme_safe_status_value="-NO";
        			} else if( $result_multimedia['followme_safe_status'] =='2' ) {
        		        $followme_safe_status_value = "-NA";
        		    }
        		    if( $result_multimedia['content_type'] =='4' && $result_multimedia['module_type'] =='4' ) {
        		        $panic_type_value="Follow me".$followme_safe_status_value;
        		    } else {
        		        $panic_type_value = "Panic";
        		    }
        		    $content_type_value = $result_multimedia['content_type'] ;
        		    $module_type_value = $result_multimedia['module_type'] ;
    			}

			    if( $result[$key]['module_type'] =='1'   ) {
        		    $panic_type_value = "Panic";
        	    } else if($result[$key]['module_type'] =='4') {
        	        $panic_type_value="Follow me".$followme_safe_status_value;
        	    }
		        $result[$key]['panic_type_value'] = $panic_type_value;
		        $result[$key]['content_type'] = $content_type_value;
		        $result[$key]['module_type'] = $module_type_value;

    			// get tenant name
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
        			        $result[$key]['tenant_name'] = $tenant_user_name ;
     			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
                if($result_multimedia) {
                    $result[$key]['followme_id'] =   $result_multimedia['followme_id'] !=null ? $result_multimedia['followme_id'] :""  ;
                    $result[$key]['followme_safe_status'] =   $result_multimedia['followme_safe_status'] !=null ? $result_multimedia['followme_safe_status'] :""  ;
                } else {
                    $result[$key]['followme_id'] = ""  ;
                    $result[$key]['followme_safe_status'] = ""  ;
                }
                if ($result[$key]['followme_id'] !="") {
            	    $panic_type_value = "Follow me" . $followme_safe_status_value;
            	    $result[$key]['panic_type_value'] = $panic_type_value;
                }
                $result[$key]['followme_id_arr'] =  $followme_id_arr ;
                if( $result[$key]['followme_id'] != "" ) {
    			    if (in_array( $result[$key]['followme_id'] , $followme_id_arr)) {

    			    } else {
    			        $result_arr[] = $result[$key];
    			         $followme_id_arr[] =   $result[$key]['followme_id'] ;
    			    }
    			} else {
    		        $result_arr[] = $result[$key];
    			}
			    $i++;
			}

			echo json_encode($result_arr);
			break;
		}
	}

	public function getUserCopEvidence()
	{
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserCopEvidence();
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
		//	$columns[] = array('label'=>'SAP Code');
			$columns[] = array('label'=>'Mobile No.');
			$columns[] = array('label'=>'Email');
			// $columns[] = array('label'=>'Designation');
			// $columns[] = array('label'=>'Branch');
			// $columns[] = array('label'=>'Department');
		//	$columns[] = array('label'=>'Vertical');
			$columns[] = array('label'=>'Latitude');
			$columns[] = array('label'=>'Longitude');
			$columns[] = array('label'=>'Date/Time');
			$columns[] = array('label'=>'Action');
			$i = 1;
			foreach ($result as $key => $value) {
			# code...
			$arr = explode(' ',$result[$key]['created_at']);
			//$result[$key]['idd']=$i;
			// $result[$key]['date']=$arr['0'];
			// $result[$key]['time']=$arr['1'];
			$info=$this->db->get_where('users',array('id'=>$value['first_name']));//$value['first_name'].' '.$value['last_name'].'    ';
			$result[$key]['first_name']=$info->row()->first_name.' '.$info->row()->last_name;
			$result[$key]['sap_code']=$info->row()->sap_code;
			unset($result[$key]['middle_name']);
			 unset($result[$key]['last_name']);
			$i++;
			}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
		
	}
	public function getNotifications($tid =''){
	    
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getNotifications($tid);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Type');
			$columns[] = array('label'=>'Location');
			$columns[] = array('label'=>'Title');
			$columns[] = array('label'=>'Message');
			
		
			$i = 1;
			foreach ($result as $key => $value) {
			# code...
// 			$arr = explode(' ',$result[$key]['created_at']);
// 			//$result[$key]['idd']=$i;
// 			// $result[$key]['date']=$arr['0'];
            if($result[$key]['type'] == '1'){
                $result[$key]['type'] = 'All';
                $result[$key]['locations'] = '-';
            }
            if($result[$key]['type'] == '2'){
                $result[$key]['type'] = 'Group Location';
                $result[$key]['locations'] = $this->db->get_where('user_group_locations',array('id'=>$result[$key]['locations']))->row()->title;
            }
            if($result[$key]['type'] == '3'){
                $result[$key]['type'] = 'Location';
                $info = $this->db->get_where('user_locations',array('id'=>$result[$key]['locations']));
                $result[$key]['locations']=$info->row()->branch_code.'-'.$info->row()->branch_name;
            }
            $result[$key]['message'] = strip_tags($result[$key]['message']);
            
            if ($result[$key]['message'] != null || $result[$key]['message'] != "") {
                if (strlen($result[$key]['message']) > 30) {
                    $message_string = mb_substr($result[$key]['message'], 0, 30) . "...";
                } else {
                    $message_string = $result[$key]['message'];
                }
                $result[$key]['message_short'] = $message_string;
            }
// 			$info=$this->db->get_where('users',array('id'=>$value['first_name']));//$value['first_name'].' '.$value['last_name'].'    ';
// 			$result[$key]['first_name']=$info->row()->first_name.' '.$info->row()->last_name;
// 			$result[$key]['sap_code']=$info->row()->sap_code;
// 			unset($result[$key]['middle_name']);
 			// unset($result[$key]['descriprion']);
// 			$i++;
			}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
	    
	}
	
	public function getPreTriggerNotifications_old($tid=''){
	        error_reporting(E_ALL); ini_set('display_errors', '1');
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getPreTriggerNotifications($tid);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'Latitude');
			$columns[] = array('label'=>'Longitude');
			$columns[] = array('label'=>'Date/Time');
			
			$i = 1;
			foreach ($result as $key => $value) {
            
                $info = $this->db->get_where('users',array('id'=>$result[$key]['user_id']))->row();
                $first_name = "";
                $last_name = "";
                $mobile_no = "";
                if(isset($info->first_name)) {
                    $first_name = $info->first_name;
                }
                if(isset($info->last_name)) {
                    $last_name = $info->last_name;
                }
                if(isset($info->mobile_no)) {
                    $mobile_no = $info->mobile_no;
                }
                $result[$key]['user_id_value']=$result[$key]['user_id'];
                // $result[$key]['user_id']=$info->row()->first_name.'-'.$info->row()->last_name;
                $result[$key]['user_id']=$first_name.'-'.$last_name;
                $result[$key]['status_start_date']=$result[$key]['status_start_date']? $result[$key]['status_start_date']: "-";
                $result[$key]['status_stop_date']=$result[$key]['status_stop_date']? $result[$key]['status_stop_date']: "-";
                $result[$key]['vehicle_number']=$result[$key]['vehicle_number']? $result[$key]['vehicle_number']: "-";
                // $result[$key]['mobile_no']=$info->row()->mobile_no ? $info->row()->mobile_no : "-";
                $result[$key]['mobile_no']=$mobile_no ? $mobile_no : "-";
                
                $last_status = "-";
                if($result[$key]['tracking_id']!="") {
                    $res_status = $this->login->getFollowMeSafeRequestLastStatus($result[$key]['tracking_id']);
                    if($res_status == '0') {
                        $last_status = "Safe";
                    } else  if($res_status == "1") {
			             $last_status = "Unsafe";
			        } else  if($res_status == "2") {
			             $last_status = "No Action";
			        }
                }
                $result[$key]['last_status'] = $last_status;
                
                
                // 2-aug-2022
    			// get tenant name
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    		   $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result[$key]['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
			
           	}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
	}
    // rewrite new - getPreTriggerNotifications
    // added on 11-oct-2022
    public function getPreTriggerNotifications($tid = '', $page = '') {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->login->getPreTriggerNotifications($tid, $page);
                if ($page == 1) {
                    $prv_page_id = 0;
                    $curr_page_id = 1;
                } else {
                    $result_next_record = $this->login->getPreTriggerNotificationsNextRecord($tid, $page - 1);
                    $prv_page_id = $page;
                    if (!empty($result_next_record)) {
                        $prv_page_id--;
                    }
                    $curr_page_id = $page;
                }
                $result_next_record = $this->login->getPreTriggerNotificationsNextRecord($tid, $page + 1);
                $next_page_id = $page;
                if (!empty($result_next_record)) {
                    $next_page_id++;
                } else {
                    $next_page_id = 0;
                }
                $range1 = $page * 10;
                $range2 = $range1 - 10;

                $i = 1;
                foreach ($result as $key => $value) {
                    if ($value['pre_trigger_id'] != "") {
                        if ((isset($value['tracking_id']) ) || ($value['tracking_id'] != "")) {
                            $this->db->select('tracking.start_time as tracking_start_time, tracking.end_time as tracking_end_time');
                            $this->db->from('tracking');
                            $this->db->where('tracking.id', $value['tracking_id']);
                            $q = $this->db->get();
                            $res_tracking = $q->row_array();
                        }
                        $result[$key]['tracking_start_time'] = isset($res_tracking['tracking_start_time']) ? $res_tracking['tracking_start_time'] : '';
                        $result[$key]['tracking_end_time'] = isset($res_tracking['tracking_end_time']) ? $res_tracking['tracking_end_time'] : '';
                    }

                    $info = $this->db->get_where('users', array('id' => $result[$key]['user_id']))->row();
                    $first_name = "";
                    $last_name = "";
                    $mobile_no = "";
                    if (isset($info->first_name)) {
                        $first_name = $info->first_name;
                    }
                    if (isset($info->last_name)) {
                        $last_name = $info->last_name;
                    }
                    if (isset($info->mobile_no)) {
                        $mobile_no = $info->mobile_no;
                    }
                    $result[$key]['user_id_value'] = $result[$key]['user_id'];
                    $result[$key]['user_id'] = $first_name . '-' . $last_name;
                    $result[$key]['vehicle_number'] = $result[$key]['vehicle_number'] ? $result[$key]['vehicle_number'] : "-";
                    $result[$key]['mobile_no'] = $mobile_no ? $mobile_no : "-";
                    $last_status = "-";
                    if ($result[$key]['tracking_id'] != "") {
                        $res_status = $this->login->getFollowMeSafeRequestLastStatus($result[$key]['tracking_id']);
                        if ($res_status == '0') {
                            $last_status = "Safe";
                        } else if ($res_status == "1") {
                            $last_status = "Unsafe";
                        } else if ($res_status == "2") {
                            $last_status = "No Action";
                        }
                    }
                    $result[$key]['last_status'] = $last_status;
                    if ($result[$key]['tenant_id'] != null) {
                        $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id']);
                        if ($res_arr) {
                            $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
                            $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
                            $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
                            $result[$key]['tenant_name'] = $tenant_user_name;
                        } else {
                            $result[$key]['tenant_name'] = "";
                        }
                    } else {
                        $result[$key]['tenant_name'] = "";
                    }
                    $result[$key]['curr_page_id'] = $curr_page_id;
                    $result[$key]['prv_page_id'] = $prv_page_id;
                    $result[$key]['nxt_page_id'] = $next_page_id;
                    if($prv_page_id == 0 ) {
                        $sr_no =  $i;
                    } else {
                        $sr_no = ($prv_page_id*10)+$i;
                    }
                    $result[$key]['sr_no'] =$sr_no;
                    $i++;
                }
                echo json_encode($result);
                break;
        }
    }
	public function getFollowMe(){
	    error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getFollowMe();
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Trackee');
			$columns[] = array('label'=>'Tracker');
			$columns[] = array('label'=>'Start Time');
			$columns[] = array('label'=>'End Time');
			$columns[] = array('label'=>'Share Time');
			$columns[] = array('label'=>'Status');
			$columns[] = array('label'=>'Action');
		
			$i = 1;
		
			foreach ($result as $key => $value) {
			    
		        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));//$value['first_name'].' '.$value['last_name'].'    ';
			    $result[$key]['trackee_id']=$info->row()->first_name.' '.$info->row()->last_name;
			    
			    $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));//$value['first_name'].' '.$value['last_name'].'    ';
			    $result[$key]['tracker_id']=$info->row()->first_name.' '.$info->row()->last_name;
			    
			    if($result[$key]['status'] == '1')
		        $result[$key]['status'] ='Open';
		        if($result[$key]['status'] == '0')
		        $result[$key]['status'] ='Close';
			 
			    unset($result[$key]['firebase_key']);
			    unset($result[$key]['tracking_type']);
			}
			//	echo "<pre>";print_r($result);exit;
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
	}
	
		public function getTracking($tid=''){
	    error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getTracking($tid);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Trackee');
			$columns[] = array('label'=>'Tracker');
			$columns[] = array('label'=>'Start Time');
			$columns[] = array('label'=>'End Time');
			$columns[] = array('label'=>'Share Time');
			$columns[] = array('label'=>'Status');
			$columns[] = array('label'=>'Action');
		
			$i = 1;
		
			foreach ($result as $key => $value) {
			    
		        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));//$value['first_name'].' '.$value['last_name'].'    ';
			    $result[$key]['trackee_id']=$info->row()->first_name.' '.$info->row()->last_name;
			    
			    $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));//$value['first_name'].' '.$value['last_name'].'    ';
			    $result[$key]['tracker_id']=$info->row()->first_name.' '.$info->row()->last_name;
			    
			    if($result[$key]['status'] == '1')
		        $result[$key]['status'] ='Open';
		        if($result[$key]['status'] == '0')
		        $result[$key]['status'] ='Close';
			 
			 	// 2-aug-2022
    			// get tenant name
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result[$key]['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
			
			    unset($result[$key]['firebase_key']);
			    unset($result[$key]['tracking_type']);
			}
			//	echo "<pre>";print_r($result);exit;
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
	}

	public function getDeclinedUser(){
	    //error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//	echo "<pre>";print_r($_POST['session_id']);exit;
			$result = $this->login->getDeclinedUser($_POST['session_id']);
			foreach ($result as $key => $value) {
			
			unset($result[$key]['is_declined']);
			unset($result[$key]['session_id']);
			unset($result[$key]['cost_center_text']);
 		
			}
			echo json_encode($result);
			break;
	    }
	}
	
	public function getPlans(){
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			//	echo "<pre>";print_r($_POST['session_id']);exit;
			$result = $this->login->getPlans();
		    if(!empty($result)) {
				foreach ($result as $key => $value) {
					$used_res = $this->login->getTenantLicenceUsedByPlansId($value['id']);
					$result[$key]['licence_used'] = $used_res;
					$total_res = $this->login->getTenantLicenceTotalByPlansId($value['id']);
					$result[$key]['licence_total'] = $total_res;
				}
			}
			echo json_encode($result);
			break;
	    }
	}
	
	public function getLocationDeclinedUser(){
	    //error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//	echo "<pre>";print_r($_POST['session_id']);exit;
			$result = $this->login->getLocationDeclinedUser($_POST['session_id']);
			foreach ($result as $key => $value) {
			
			unset($result[$key]['is_declined']);
			unset($result[$key]['session_id']);
			unset($result[$key]['cost_center_text']);
 		
			}
			echo json_encode($result);
			break;
	    }
	}
	
	public function getLocationTracking($id){
	    $start = '';$end='';
	    //echo $id;exit;
	    if($id){
	          
	        $info=$this->db->get_where('tracking',array('id'=>$id));
		    $firebase_key=$info->row()->firebase_key;
	       // echo $firebase_key;
            $handle = curl_init();
             
            $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
            
             
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
             
            $output = curl_exec($handle);
             
            curl_close($handle);
            if($output){
              
               $output_array = json_decode($output,true); //echo "<pre>";print_r($output_array);
               $output_array = array_reverse($output_array);
               $tot_cnt = count($output_array);//echo $tot_cnt;exit;
               foreach($output_array as $k=>$v){
                    // $output_array[$k]['timestamp'] = date("Y-m-d H:i:s", $v['time']/1000);
                    // $output_array[$k]['addr'] = '';
                    // if($k=='0'){
                    //   $start = $v['lat'].','.$v['lng'];
                    // }
                    // if($k == ($tot_cnt-1)){
                    //   $end = $v['lat'].','.$v['lng'];
                    // }
                   
                   // echo $v['lat'].','.$v['lng'];exit;
                 
                //  $handle1 = curl_init();
                //  $url1 = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$v['lat'].','.$v['lng'].'&key=AIzaSyAmW78ILd6zQ5wR5t7xYzQaJctup2Bqft0&sensor=false';
                 
                // // Set the url
                // curl_setopt($handle1, CURLOPT_URL, $url1);
                // // Set the result output to be a string.
                // curl_setopt($handle1, CURLOPT_RETURNTRANSFER, true);
                 
                // $output1 = curl_exec($handle1);
                // // echo "<pre>";print_r($output1);exit;
                // curl_close($handle1);
            
                //  //$json = file_get_contents($url);
                //  $data1=json_decode($output1);
                //  $status = $data1->status;
                //  if($status=="OK")
                //  {
                //     $output_array[$k]['addr'] = $data1->results[0]->formatted_address.',';
                //  }else{
                //      $output_array[$k]['addr'] = '';
                //  }
                
               }
               $output_array = array_slice($output_array, 1, -1);
                //echo json_encode(array('origin'=>$start,'end'=>$end,'result'=>$output_array));
                echo json_encode($output_array);
            }
         

	    }
	    
	}
	
	public function getQueries()
	{
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getQueries();
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			//$columns[] = array('label'=>'SAP Code');
			$columns[] = array('label'=>'Date');
			$columns[] = array('label'=>'Description');
			$columns[] = array('label'=>'Action');
			$i = 1;
			foreach ($result as $key => $value) {
			# code...
			$arr = explode(' ',$result[$key]['created_at']);
			//$result[$key]['idd']=$i;
			// $result[$key]['date']=$arr['0'];
			// $result[$key]['time']=$arr['1'];
			$info=$this->db->get_where('users',array('id'=>$value['first_name']));//$value['first_name'].' '.$value['last_name'].'    ';
			$result[$key]['first_name']=$info->row()->first_name.' '.$info->row()->last_name;
			$result[$key]['sap_code']=$info->row()->sap_code;
			//$result[$key]['description']=mb_substr($result[$key]['description'], 0, 15);
			unset($result[$key]['middle_name']);
			 unset($result[$key]['last_name']);
			$i++;
			}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;

		}
		
	}

	public function getUserLocations()
	{
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserLocations();
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Branch Code');
			$columns[] = array('label'=>'Branch Name');
			$columns[] = array('label'=>'District');
			$columns[] = array('label'=>'State');
			$columns[] = array('label'=>'Country');
			$columns[] = array('label'=>'Action');
			$i = 1;
			foreach ($result as $key => $value) {
			# code...			
			//$result[$key]['id']=$i;
			if($value['state_name']){
			      $result[$key]['state_name'] = $this->db->get_where('countries',array('id'=>$value['state_name']))->row()->country_name;
			  } 
			  if($value['zone_name']){
			      $result[$key]['zone_name'] = $this->db->get_where('states',array('StateID'=>$value['zone_name']))->row()->StateName;
			  } 
			  if($value['region_name']){
			      $result[$key]['region_name'] = $this->db->get_where('district',array('id'=>$value['region_name']))->row()->name;
			  } 
			
			$i++;
			}
			$res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($res);
			break;

		}
		
	}
    
    public function getUserGroupLocations()
	{
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserGroupLocations();
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Title');
			$columns[] = array('label'=>'Branch Name');
			$columns[] = array('label'=>'Action');
			$i = 1;
		   
			foreach ($result as $key => $value) {
			     $html=' ';
			# code...			
			//$result[$key]['id']=$i;
 			 	$result[$key]['group_location_id'] = '';
			  if($value['id']){
			      $info = $this->db->get_where('user_group_branch',array('group_location_id'=>$value['id']))->result_array();
			      
			      foreach($info as $k=>$v){
			          $info1 = $this->db->get_where('user_locations',array('id'=>$v['location_id']))->row();
			          //$html = $info1->branch_code.'-'.$info1->branch_name.',';
			          $result[$key]['group_location_id'] .= $info1->branch_code.'-'.$info1->branch_name.',';
			      }
			      //echo "<pre>".$html;print_r($result[$key]['group_location_id']);exit;
			  }
			  $i++;
			
			}
			$res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($res);
			break;

		}
		
	}
	
	public function getUserInfo($id)
	{

		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
		    $update_read_record = $this->login->updatePanicRequestReadRecord($id);
			$result = $this->login->getUserInfo($id);
			$gender = '--';
            if ($result->gender == '1') {
                $gender = 'Male';
            } else if ($result->gender == '2') {
                $gender = 'Female';
            }
            $result->gender_value = $gender;
            $blood_group = '--';
            if ($result->blood_group == '1') {
                $blood_group = 'A+';
            } else if ($result->blood_group == '2') {
                $blood_group = 'B+';
            } else if ($result->blood_group == '3') {
                $blood_group = 'O+';
            } else if ($result->blood_group == '4') {
                $blood_group = 'AB+';
            } else if ($result->blood_group == '5') {
                $blood_group = 'A-';
            } else if ($result->blood_group == '6') {
                $blood_group = 'B-';
            } else if ($result->blood_group == '7') {
                $blood_group = 'O-';
            } else if ($result->blood_group == '8') {
                $blood_group = 'AB-';
            }
            $result->blood_group_value = $blood_group;
            
            $user_critical_illness_detail = $this->login->getUserCriticalIllnessByUserId($result->id);  
            //			print_R($user_critical_illness_detail);die;

            $critical_illness_name_arr = array();
            if (count($user_critical_illness_detail) ) {
                $critical_illness_arr=  $critical_illness_id_array = array_column($user_critical_illness_detail, 'critical_illness_id');
                foreach ($user_critical_illness_detail as $key => $value) {
                    if($value['critical_illness_id'] !=6) {
                        $critical_illness_name = $this->login->getCriticalIllnessById($value['critical_illness_id']);
                        array_push($critical_illness_name_arr, $critical_illness_name['critical_illness_name']);
                    } else {
                        array_push($critical_illness_name_arr, $value['critical_illness_name']);
                    }
                }                        
            }
            $result->critical_illness_value = implode(", ", $critical_illness_name_arr);
            //$user_evidence_result = $this->login->getUserEvidenceById($id, $result->id );
            
            $user_evidence_result = $this->login->getUserEvidenceByPanicId($id);
            $result->user_lat = $user_evidence_result['user_lat'];
            $result->user_long = $user_evidence_result['user_long'];
            $result->date_time = $user_evidence_result['created_at'];
            
            // 19-jul-2022
            $user_multimedia_followme_type_result = $this->login->getUserMultimediaFollowmeTypeById($id);
            $result->content_type = $user_multimedia_followme_type_result->content_type;
            $result->module_type = $user_multimedia_followme_type_result->module_type;
			
			echo json_encode($result);
			break;

		}
		
	}

	public function getUserEmergencynfo($id)
	{

		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserEmergencynfo($id);
			echo json_encode($result);
			break;

		}
		
	}


	public function getUpdateUserInfo($id){
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUpdateUserInfo($id);
			//echo "<pre>";print_r($result);exit;
			if($result){
			    // 7-feb-2023
			    if ($result->profile_image != null || $result->profile_image != "") {
                    $result->profile_image = GetProfileImagePath($result->profile_image);
                } else {
                    $result->profile_image = DefaultProfileImage();
                }
			    if ($result->profile_image_thumb != null || $result->profile_image_thumb != "") {
                    $result->profile_image_thumb = GetProfileImagePath($result->profile_image_thumb);
                } else {
                    $result->profile_image_thumb = DefaultProfileImage();
                }

				// $result->sapcode = $result->sap_code;
				$result->firstname = $result->first_name;
				$result->middlename = $result->middle_name;
				$result->lastname = $result->last_name;
				
				//11-oct-022
			    $result->licence_key = "";
				if( $result->tenant_licence_id !=null){
				    $this->db->select('tenant_licence.licence_key');
                    $this->db->from('tenant_licence');
                    $this->db->where('tenant_licence.id',$result->tenant_licence_id);
                    $q = $this->db->get();  
                    $result_tenant_licence = $q->row();
                    if ($result_tenant_licence) {
                        $result->licence_key = $result_tenant_licence->licence_key;
                    }
				}
				
				$info = $this->db->get_where('emergency_contacts',array('user_id'=>$result->id , 'is_deleted' => 0))->result_array();
				if($info){
				    $i=1;
				    foreach($info as $k=>$v){
				        $result_info = $this->db->get_where('users',array('id'=>$v['emergency_user_id']));
				        if($result_info){
				            if($v['serial_no']=='1')
				                $result->reporting_manager_sap_code = $result_info->row()->mobile_no.'-'.$result_info->row()->first_name.' '.$result_info->row()->last_name;
				            if($v['serial_no']=='2')
				                $result->reviewing_manager_sap_code = $result_info->row()->mobile_no.'-'.$result_info->row()->first_name.' '.$result_info->row()->last_name;
				            if($v['serial_no']=='3')
				                $result->ho_poc_sap_code = $result_info->row()->mobile_no.'-'.$result_info->row()->first_name.' '.$result_info->row()->last_name;
				            if($v['serial_no']=='4')
				                $result->department_head_sap_code = $result_info->row()->mobile_no.'-'.$result_info->row()->first_name.' '.$result_info->row()->last_name;
				            
				        }
				        $i++;
				    }
				}
			}
		    // 9-dec-2022 - plan_id
            $this->db->select('user_plan.user_id, user_plan.plan_id, plan_master.title,  user_plan.start_date, user_plan.end_date');
            $this->db->from('user_plan');
            $this->db->where('user_plan.user_id', $id);
            $this->db->join('plan_master', 'plan_master.id = user_plan.plan_id', 'left');
            $q = $this->db->get();
            $result_user_plan = $q->row();
            if ($result_user_plan) {
                $result->plan_id = $result_user_plan->plan_id;
                $result->plan_title = $result_user_plan->title;
                $result->start_date = $result_user_plan->start_date;
                $result->end_date = $result_user_plan->end_date;
            } else {
                $result->plan_id = "";
                $result->plan_title = "";
                $result->start_date = "";
                $result->end_date = "";
            }

            // 4-jan-2022
            $res_user_plan  = $this->login->getUserPlanDetail($id);
            $result->sos_remaining_count = $res_user_plan['sos_remaining_count'];
            $result->follow_me_remaining_count = $res_user_plan['follow_me_remaining_count'];
            $result->posh_remaining_count = $res_user_plan['posh_remaining_count'];
            $result->ambulance_remaining_count = $res_user_plan['ambulance_remaining_count'];
            $result->road_side_assistance_remaining_count = $res_user_plan['road_side_assistance_remaining_count'];
            $result->accidental_insurance_remaining_count = $res_user_plan['accidental_insurance_remaining_count'];
			echo json_encode($result);
			break;
		}
	}
	
	public function getUpdateAdminInfo($id){
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUpdateAdminInfo($id);
			//echo "<pre>";print_r($result);exit;
			if($result){
			//	$result->sapcode = $result->sap_code;
				$result->firstname = $result->first_name;
				$result->middlename = $result->middle_name;
				$result->lastname = $result->last_name;
				
				
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getUpdateUserLocationInfo($id){
	    	switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUpdateUserLocationInfo($id);
			//echo "<pre>";print_r($result);exit;
			if($result){
				$result->branchcode = $result->branch_code;
				$result->branchname = $result->branch_name;
				$result->country = $result->state_name;
				$result->states = $result->zone_name;
				$result->district = $result->region_name;
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getUserGroupLocationInfo($id){
	    	switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserGroupLocationInfo($id);
			//echo "<pre>";print_r($result);exit;
			if($result){
				$result->title = $result->title;
				$info = $this->db->get_where('user_group_branch',array('group_location_id'=>$id))->result_array();
				if($info){
				   // echo "<pre>";print_r($info);exit;
				    for($i=0;$i<count($info);$i++){
				        $location_id = $this->db->get_where('user_locations',array('id'=>$info[$i]['location_id']))->row();
				        $branch[] = $location_id->branch_code.'-'.$location_id->branch_name;
				    }
				}
				$result->locations = $branch;
			
			}
			echo json_encode($result);
			break;

		}
	}

	
	public function getUserImages($id){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserImages($id);
			foreach($result as $k=>$v){

			    if ($v['file_path'] != null || $v['file_path'] != "") {
                    $result[$k]['file_path'] = GetProfileImagePath($v['file_path']);
			    }
			    $result[$k]['src'] = $v['file_path'];
			    $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			    $result[$k]['thumbnailWidth'] = '320';
			    $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getUserVideos($id){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserVideos($id);
			foreach($result as $k=>$v){
			    if ($v['file_path'] != null || $v['file_path'] != "") {
                    $result[$k]['file_path'] = GetProfileImagePath($v['file_path']);
			    }
			    $result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getUserCopVideos($id){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserCopVideos($id);
			foreach($result as $k=>$v){
			    $result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}
	
	
	public function getUserAudios($id){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserAudios($id);
			foreach($result as $k=>$v){
			    if ($v['file_path'] != null || $v['file_path'] != "") {
                    $result[$k]['file_path'] = GetProfileImagePath($v['file_path']);
			    }
			    $result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getCountries(){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getCountries();
			foreach($result as $k=>$v){
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getStates($id = ''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getStates($id);
			if($result == []){
			    $result[0]['StateID'] = 0;
			    $result[0]['StateName'] = 'No Data Available.';
			}
			foreach($result as $k=>$v){
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getAllSAPCode($id = ''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getAllSAPCode($id);
			if($result == []){
			  //  $result[0]['StateID'] = 0;
			    $result[0] = 'No Data Available.';
			}
			foreach($result as $k=>$v){
			    $res[] = $v['mobile_no'].'-'.$v['first_name'].' '.$v['last_name'];
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($res);
			break;

		}
	}

    public function getAllBranchCode($id = ''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getAllBranchCode($id);
			if($result == []){
			  //  $result[0]['StateID'] = 0;
			    $result[0] = 'No Data Available.';
			}
			foreach($result as $k=>$v){
			    $res[] = $v['branch_code'].'-'.$v['branch_name'];
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($res);
			break;

		}
	}
	
	public function getGLocations($id = ''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getGLocations($id);
			if($result == []){
			  //  $result[0]['StateID'] = 0;
			    $result[0] = 'No Data Available.';
			}
			foreach($result as $k=>$v){
			    $res[] = $v['title'];
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($res);
			break;

		}
	}
	
    public function getDistrict($id =''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getDistrict($id);
			if($result == []){
			    $result[0]['id'] = 0;
			    $result[0]['name'] = 'No Data Available.';
			}
			foreach($result as $k=>$v){
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}

    public function getBranch(){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getBranch();
			foreach($result as $k=>$v){
			    //$result[$k]['src'] = (string)$v['file_path'];
			 //   $result[$k]['thumbnail'] = $v['thumbnail_file_path'];
			 //   $result[$k]['thumbnailWidth'] = '320';
			 //   $result[$k]['thumbnailHeight'] = '212';
			}
			echo json_encode($result);
			break;

		}
	}

	public function deleteUser()
	{
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//echo $datas;exit;
			$result = $this->login->deleteUser($datas);
			echo json_encode($result);
			break;

		}
		
	}
	
	public function deleteLocation($id =''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//echo 'gjhg'.$datas;exit;
			$result = $this->login->deleteLocation($id);
			echo json_encode($result);
			break;

		}
	}
	
	public function deleteGroupLocation($id =''){
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//echo 'gjhg'.$datas;exit;
			$result = $this->login->deleteGroupLocation($id);
			echo json_encode($result);
			break;

		}
	}
	
	public function deleteAdmin()
	{
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//echo $datas;exit;
			$result = $this->login->deleteAdmin($datas);
			echo json_encode($result);
			break;

		}
		
	}
	
	public function import(){
	    error_reporting(0);
	    $icnt = 0;$ucnt = 0;$ecnt = 0;
	    switch($_SERVER['REQUEST_METHOD']){ 
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));

			//echo "<pre>";print_r($_POST['session_id']);exit;
			if ($_FILES['file']['name'] != '') { 
			    
                $temp = explode(".", $_FILES['file']['name']);
                $target_path = './uploads/documents/';
                $time = mt_rand(10,100).time().round('2');
                $newfilename = 'sample_csv.' . end($temp);
                $target_path_new = $target_path . $newfilename;
                $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path_new);
                
                if($result){
                    
                    $row = 0;
                    if (($handle = fopen("./uploads/documents/sample_csv.csv", "r")) !== FALSE) {
                      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                           $row++;
                        if($row == 1){
                            continue;
                        }
                        $num = count($data);
                       // echo "<p> $num fields in line $row: <br /></p>\n";
                       $insert_data = array();
                        for ($c=0; $c < $num; $c++) {
                           // echo $data[$c] . "<br />\n";
                        	
                            $insert_data[] = $data[$c];
                        }
                        $this->login->addTempData($insert_data,$_POST['session_id']);
                      }
                      fclose($handle);
                    }  
                    
                    
                    	$result = $this->login->getTmpUsers($_POST['session_id']);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'SAP Code');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
			$columns[] = array('label'=>'Designation');
			$columns[] = array('label'=>'Department');
		//	$columns[] = array('label'=>'Cost Center Text');
			$columns[] = array('label'=>'Gender');
			$columns[] = array('label'=>'DOB');
			$columns[] = array('label'=>'Branch');
			$columns[] = array('label'=>'Age');
			$columns[] = array('label'=>'Status');
			$columns[] = array('label'=>'Action');
			$columns[] = array('label'=>'Error');
		
			$i=1;
			foreach ($result as $key => $value) {
				# code...
		
 			 $result[$key]['first_name']=$value['first_name' ].' '.$value['middle_name' ].' '.$value['last_name' ];
// 			// $result[$key]['user_type']=($value['user_type' ]== 2 ) ? 'Admin':'Employee';
// 			 $result[$key]['gender']=($value['gender' ]== 1 ) ? 'Male':'Female';
// 			 $result[$key]['status']=($value['status' ]== 1 ) ? 'Active':'In-active';
 			 $result[$key]['email']=mb_substr($value['email' ], 0, 10).'...';
			 //$result[$key]['action']="<i className='fa fa-remove ptr_css' onClick=this.remove()></i>&nbsp;&nbsp;<i className='fa fa-edit ptr_css'></i>&nbsp;&nbsp;<i className='fa fa-eye ptr_css'></i>";
		//	 $result[$key]['id']=$i;
			 
			 if($value['sap_code']){
			     
			     $ec1_info = $this->db->get_where('users',array('sap_code'=>trim($value['sap_code'])))->row();
                 $ec1 = $ec1_info->id;
                 if($ec1){
                     $ucnt++;
                     $result[$key]['action']='Update';
                 }else{
                     $icnt++;
                     $result[$key]['action']='Insert';
                 }
			 }
			 if($value['sap_code'] && $value['first_name'] && $value['last_name'] && $value['contact_1'] && $value['contact_2'] && $value['contact_3'] && $value['contact_4'] && $value['mobile']){
			     
			    $result[$key]['error']='-';
            }else{
                $ecnt++;
                $result[$key]['error']='Insufficient Data';
                
                $this->db->where('id',$result[$key]['id']);
                $this->db->update('tmp_employees',array('is_declined'=>'1'));
            }
			unset($result[$key]['middle_name']);
			unset($result[$key]['last_name']); 
			unset($result[$key]['contact_1']); 
			unset($result[$key]['contact_2']); 
			unset($result[$key]['contact_3']); 
			unset($result[$key]['contact_4']); 
			// $result[$key]['type_id']=$this->db->get_where('product_type',array('id'=>$value['type_id']))->row()->title;
			// $result[$key]['image_name']=$this->db->get_where('product_images',array('id'=>$value['id']))->row()->image_name;
			//$i++;
			}
			$res=array('columns'=>$columns,'rows'=>$result,'icnt'=>$icnt,'ucnt'=>$ucnt,'ecnt'=>$ecnt);
			echo json_encode($res);
            break;      
                }
                
			   // echo json_encode($result);
			    
			}

		}
	}

	public function location_import(){
	    error_reporting(0);
	    $icnt = 0;$ucnt = 0;$ecnt = 0;
	    switch($_SERVER['REQUEST_METHOD']){ 
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));

			//echo "<pre>";print_r($_POST['session_id']);exit;
			if ($_FILES['file']['name'] != '') { 
			    
                $temp = explode(".", $_FILES['file']['name']);
                $target_path = './uploads/documents/';
                $time = mt_rand(10,100).time().round('2');
                $newfilename = 'location_sample_csv.' . end($temp);
                $target_path_new = $target_path . $newfilename;
                $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path_new);
                
                if($result){
                    
                    $row = 0;
                    if (($handle = fopen("./uploads/documents/location_sample_csv.csv", "r")) !== FALSE) {
                      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                           $row++;
                        if($row == 1){
                            continue;
                        }
                        $num = count($data);
                       // echo "<p> $num fields in line $row: <br /></p>\n";
                       $insert_data = array();
                        for ($c=0; $c < $num; $c++) {
                           // echo $data[$c] . "<br />\n";
                            $insert_data[] = $data[$c];
                        }
                        $this->login->addLocationTempData($insert_data,$_POST['session_id']);
                      }
                      fclose($handle);
                    }  
                    
                    
                    $result = $this->login->getLocationTmpUsers($_POST['session_id']);
					$columns[] = array('label'=>'#');
					$columns[] = array('label'=>'Branch Code');
					$columns[] = array('label'=>'Branch Name');
					$columns[] = array('label'=>'District');
			        $columns[] = array('label'=>'State');
			        $columns[] = array('label'=>'Country');
					$columns[] = array('label'=>'Action');
			        $columns[] = array('label'=>'Error');
					
				
			$i=1;
			foreach ($result as $key => $value) { 	
			  if($value['state_name']){
			      $result[$key]['state_name'] = $this->db->get_where('countries',array('id'=>$value['state_name']))->row()->country_name;
			  } 
			  if($value['zone_name']){
			      $result[$key]['zone_name'] = $this->db->get_where('states',array('StateID'=>$value['zone_name']))->row()->StateName;
			  } 
			  if($value['region_name']){
			      $result[$key]['region_name'] = $this->db->get_where('district',array('id'=>$value['region_name']))->row()->name;
			  } 
			 $result[$key]['id']=$i;			
				$i++;
				 if($value['branch_code']){
			     
			     $ec1_info = $this->db->get_where('user_locations',array('branch_code'=>trim($value['branch_code']),'is_deleted'=>'0'))->row();
			     //echo $this->db->last_query();exit;
                 $ec1 = $ec1_info->id;
                 if($ec1){
                     $ucnt++;
                     $result[$key]['action']='Update';
                 }else{
                     $icnt++;
                     $result[$key]['action']='Insert';
                 }
			 }else{
			     $result[$key]['action']='-';
			 }
			 if($value['branch_code'] && $value['branch_name']){
			     
			    $result[$key]['error']='-';
            }else{
                $ecnt++;
                $result[$key]['error']='Insufficient Data';
                $this->db->where('id',$result[$key]['id']);
                $this->db->update('tmp_location',array('is_declined'=>'1'));
            }
			}
			$res=array('columns'=>$columns,'rows'=>$result,'icnt'=>$icnt,'ucnt'=>$ucnt,'ecnt'=>$ecnt);
			echo json_encode($res);
            break;      
                }
                
			   // echo json_encode($result);
			    
			}

		}
	}
	
	public function about_us(){
	    
	    $datas = json_decode(file_get_contents("php://input"));
	    $result = $this->login->about_us($datas);
		echo json_encode($result);
	}
	
	public function terms(){
	    
	    $datas = json_decode(file_get_contents("php://input"));
	    $result = $this->login->terms($datas);
		echo json_encode($result);
	}
	
	public function privacy_policy(){
	    
	    $datas = json_decode(file_get_contents("php://input"));
	    $result = $this->login->privacy_policy($datas);
		echo json_encode($result);
	}
	
	public function help(){
	    
	    $datas = json_decode(file_get_contents("php://input"));
	    $result = $this->login->help($datas);
		echo json_encode($result);
	}
	
	public function tutorial(){
	    
	    $datas = json_decode(file_get_contents("php://input"));
	    $result = $this->login->tutorial($datas);
		echo json_encode($result);
	}
	
	public function getInfo($id){
	   
	   // $datas = json_decode(file_get_contents("php://input"));
	    $result = $this->login->getInfo($id);
	    echo json_encode($result);
	}

	public function save_import_data(){
		
	    $result = $this->login->saveImportData($_POST['session_id']);
	    $res = $this->login->removeTempData($_POST['session_id']);
	    echo $res;
	}

	public function save_Location_import_data(){
		
	    $result = $this->login->saveLocationImportData($_POST['session_id']);
	    $res = $this->login->removeLocationTempData($_POST['session_id']);
	    echo $res;
	}
	
	public function sendNotification(){
	    $datas = json_decode(file_get_contents("php://input"));
		// echo "<pre>";print_r($datas);exit;
		$res = $this->login->sendNotification($datas);
	    echo $res;
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
        $res1 = array();
        $a1 = array();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $res[$key][] = (float) $value['user_lat'];
                $res[$key][] = (float) $value['user_long'];
                $res1[$key]['lat'] = (float) $value['user_lat'];
                $res1[$key]['lng'] = (float) $value['user_long'];
            }
            $res_center_lat = $res[0][0];
            $res_center_long = $res[0][1];
             $res_center_lat = $res1[0]['lat'];
            $res_center_long = $res1[0]['lng'];
            $data['map_center_point_lat'] = $res_center_lat;
            $data['map_center_point_long'] = $res_center_long;
            
            
            $data['map_point'] = json_encode($res);
            $data['map_point1'] = json_encode($res1);
            if($res) {
                $a1=array('type'=>"FeatureCollection");
                $kk=1;
                foreach($res as $k =>$r) {
                    $a1['features'][$k]["type"]="Feature";
                    $a1['features'][$k]["properties"]= array("htmlPopup"=> (string)$kk);
                //    $a1['features'][$k]["geometry"]= array("type"=> "Point", "coordinates" => [28.55108, 77.26913] );
                    $a1['features'][$k]["geometry"]= array("type"=> "Point", "coordinates" => [$r[0], $r[1]] );
                    $kk++;
                }
            }
            $data['geo_point'] = json_encode($a1);
        } else {
            $data['map_center_point_lat'] = null;
            $data['map_center_point_long'] = null;
            $data['map_point'] = json_encode($res);
            $data['geo_point'] = json_encode($a1);
        }
      //  print_r($data);
     
     // echo "<pre>";
       //     print_r(json_encode($a1)); 
     // print_r($a1); 
//      die;
        $this->load->view('map', $data);
    }
      public function downloadpdf() {
         //error_reporting(E_ALL);
        //  ini_set('display_errors', '1');
        require 'vendor/autoload.php';

        $e_id = $_POST['e_id'];
        $content_type = "";
        if(isset($_POST['content_type'])) {
            $content_type= $_POST['content_type'];
        }
        $resultUserEvidence = $this->login->getUserEvidenceById($e_id);
        // print_R($resultUserEvidence);
        // die;
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
        
        if($content_type !=4) {
            $result = $this->login->getUserImages($e_id);
            $img_result = array();
            foreach ($result as $k => $v) {
                // $img_result[$k]['src'] = $v['file_path'];
                // $img_result[$k]['thumbnail'] = $v['thumbnail_file_path'];
                // 10-feb-2023
                $file_path = "";
                if ($v['file_path'] != null || $v['file_path'] != "") {
                    $file_path = GetProfileImagePath($v['file_path']);
                }
                $img_result[$k]['src'] = $file_path;
                $thumbnail_file_path = "";
                if ($v['thumbnail_file_path'] != null || $v['thumbnail_file_path'] != "") {
                    $thumbnail_file_path = GetProfileImagePath($v['thumbnail_file_path']);
                }
                $img_result[$k]['thumbnail'] = $thumbnail_file_path;
                 $img_result[$k]['thumbnailWidth'] = '320';
                $img_result[$k]['thumbnailHeight'] = '212';
            }
            $video_result = array();
            $result = $this->login->getUserVideos($e_id);
            foreach ($result as $k => $v) {
                // $video_result[$k]['src'] = (string) $v['file_path'];
                $file_path = "";
                if ($v['file_path'] != null || $v['file_path'] != "") {
                    $file_path = GetProfileImagePath($v['file_path']);
                }
                $video_result[$k]['src'] = $file_path;
            }
            $audio_result = array();
            $result = $this->login->getUserAudios($e_id);
            foreach ($result as $k => $v) {
                // $audio_result[$k]['src'] = (string) $v['file_path'];
                $file_path = "";
                if ($v['file_path'] != null || $v['file_path'] != "") {
                    $file_path = GetProfileImagePath($v['file_path']);
                }
                $audio_result[$k]['src'] = $file_path;
            }
        }
        $contact_result = $this->login->getUserEmergencynfo($e_id);
        /* added line below */
        $mpdf = new \Mpdf\Mpdf();
        $view_result['user_evidence'] = $resultUserEvidence;
        $view_result['img_result'] = $img_result;
        $view_result['video_result'] = $video_result;
        $view_result['audio_result'] = $audio_result;
        $view_result['contact_result'] = $contact_result;
        $view_result['content_type'] = $content_type;
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

    public function getTrackingById($id = null) {
	    if($id){
	        $info=$this->db->get_where('tracking',array('id'=>$id));
		    $firebase_key=$info->row()->firebase_key;
            $handle = curl_init();
            // $firebase_key="Tracking_id_336";
            $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
            if($output){
                $output_array = json_decode($output,true);
                $output_array = array_reverse($output_array);
                $tot_cnt = count($output_array);
                $res = array();
                $res1 = array();
                $a1 = array(); //        print_R($output_array);//die;
               foreach($output_array as $key=>$value){
                    $res[$key][] = (float) $value['lat'];
                    $res[$key][] = (float) $value['lng'];
                    $res1[$key]['lat'] = (float) $value['lat'];
                    $res1[$key]['lng'] = (float) $value['lng'];
                }
                $res_center_lat = $res[0][0];
                $res_center_long = $res[0][1];
                $res_center_lat = $res1[0]['lat'];
                $res_center_long = $res1[0]['lng'];
                $data['map_center_point_lat'] = $res_center_lat;
                $data['map_center_point_long'] = $res_center_long;
                $data['map_point'] = json_encode($res);
                $data['map_point1'] = json_encode($res1);
                
                if($res) {
                    $a1=array('type'=>"FeatureCollection");
                    $kk=1;
                    foreach($res as $k =>$r) {
                       //print_r($r); 
                        $a1['features'][$k]["type"]="Feature";
                        $a1['features'][$k]["properties"]= array("htmlPopup"=> (string)$kk);
                        // $a1['features'][$k]["geometry"]= array("type"=> "Point", "coordinates" => [28.55108, 77.26913] );
                        $a1['features'][$k]["geometry"]= array("type"=> "Point", "coordinates" => [$r[0], $r[1]] );
                        $kk++;
                    }
                }
               
                $data['geo_point'] = json_encode($a1);
       //         echo json_encode($output_array);
	        }
	    }
	   //  echo "<pre>";
	   //  print_R($res);
	   //  print_R($a1);
	   //  print_R( $data['geo_point'] );
    //             print_R($data);
    //             die;
	    if($data) {
	        $this->load->view('tracking_map', $data);
	    } else {
	        echo "No record found.";
	    }
    }
    
    /**
    * @function: userBulkUpload
    * @description: user Bulk Upload
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
    */
    public function userBulkUpload_OLD() {
    
        error_reporting(0);
	    $icnt = 0;$ucnt = 0;$ecnt = 0;
	    switch($_SERVER['REQUEST_METHOD']){ 
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			$admin_select = null;
		    $total_tenant_licence = 0;

			if($_POST['admin_select']) {
                $admin_select = $_POST['admin_select'];
                $total_tenant_licence  = $this->login->getTenantLicence( $admin_select );
			}

			if ($_FILES['file']['name'] != '') { 
			    
                $temp = explode(".", $_FILES['file']['name']);
                $target_path = './uploads/documents/';
                $time = mt_rand(10,100).time().round('2');
                $newfilename = 'sample_csv.' . end($temp);
                $target_path_new = $target_path . $newfilename;
                $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path_new);
                
                if($result){
                    $row = 0;
                    if (($handle = fopen("./uploads/documents/sample_csv.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $row++;
                            if($row == 1){
                                continue;
                            }
                            $num = count($data);
                            // echo "<p> $num fields in line $row: <br /></p>\n";
                            $insert_data = array();
                            for ($c=0; $c < $num; $c++) {
                                // echo $data[$c] . "<br />\n";
                                $insert_data[] = $data[$c];
                            }
                            $this->login->addUserTempData($insert_data,$_POST['session_id'], $admin_select);
                        }
                        fclose($handle);
                    }
                    $result = $this->login->getBulkTempUsers($_POST['session_id']);
                    
                    
        			$columns[] = array('label'=>'#');
        			$columns[] = array('label'=>'Name');
        		 
        			$columns[] = array('label'=>'Email');
        			$columns[] = array('label'=>'Mobile No.');
        		//	$columns[] = array('label'=>'Cost Center Text');
        			$columns[] = array('label'=>'Gender');
        			$columns[] = array('label'=>'DOB');
        			$columns[] = array('label'=>'Age');
        			$columns[] = array('label'=>'Status');
        		 	$columns[] = array('label'=>'Action');
        			$columns[] = array('label'=>'Error');
		
			        $i=1;
			        $row_licence = 0;
        			foreach ($result as $key => $value) {
         			 $result[$key]['first_name']=$value['first_name' ].' '.$value['middle_name' ].' '.$value['last_name' ];
        // 			// $result[$key]['user_type']=($value['user_type' ]== 2 ) ? 'Admin':'Employee';
        // 			 $result[$key]['gender']=($value['gender' ]== 1 ) ? 'Male':'Female';
        // 			 $result[$key]['status']=($value['status' ]== 1 ) ? 'Active':'In-active';
         			 $result[$key]['email']=mb_substr($value['email' ], 0, 10).'...';
        			 //$result[$key]['action']="<i className='fa fa-remove ptr_css' onClick=this.remove()></i>&nbsp;&nbsp;<i className='fa fa-edit ptr_css'></i>&nbsp;&nbsp;<i className='fa fa-eye ptr_css'></i>";
        		//	 $result[$key]['id']=$i;
                        $result[$key]['sr_no'] = $key+1;

                        if ($value['mobile'] && $admin_select   ) {
                            $ec1 = null;
                            $ec1_info = $this->db->get_where('users', array(
                                'mobile_no' => trim($value['mobile']), 
                                'tenant_id' =>  $admin_select , 
                                'is_deleted' => '0'))->row();
                           
                            if($ec1_info) {

								$ec1 = $ec1_info->id;
							}
                            if($ec1 == null) {
                                //  $ec1_info = $this->db->get_where('users', array(
                                // 'mobile_no' => trim($value['mobile']), 
                                // 'tenant_id' =>   null , 
                                // 'is_deleted' => '0'))->row();
                                //  $ec1 = $ec1_info->id;
                                
                                
                            }
                            
                            // echo $this->db->last_query();//exit;
                            // print_r($ec1);
                            // die;
                            if ($ec1) {
                                $ucnt++;
                                $result[$key]['action'] = 'Update';
            
                                $this->db->where('id', $result[$key]['id']);
                                $this->db->update('tmp_bulk_user', array('is_updated' => '1' ,   'user_id' =>$ec1 ));
                            } else {
                                $row_licence_id =null;
								if(!empty($total_tenant_licence  )) {
									if( isset($total_tenant_licence[$row_licence])) {
										$row_licence_id=  $total_tenant_licence[$row_licence];
										$row_licence++;
									} else {
										 
									}
								}
								$this->db->where('id', $result[$key]['id']);
                                $this->db->update('tmp_bulk_user', array('tenant_licence_id' => $row_licence_id   ));
								$value['tenant_licence_id'] =  $row_licence_id;
								
                                $icnt++;
                                $result[$key]['action'] = 'Insert';
                            }
                        }

            		  //  if (  $value['first_name'] &&  $value['middle_name'] &&  $value['last_name'] &&  $value['mobile'] &&  $value['email'] && $value['contact_1'] && $value['contact_name_1'] && $value['contact_2'] && $value['contact_name_2'] && $value['contact_3'] && $value['contact_name_3'] && $value['contact_4'] && $value['contact_name_4'] ){
            		  //  if (  $value['first_name'] &&  $value['middle_name'] &&  $value['last_name'] &&  $value['mobile'] &&  $value['email'] ){
						if (  $value['first_name'] &&  $value['middle_name'] &&  $value['last_name'] &&  $value['mobile'] &&  $value['email'] && $value['tenant_licence_id'] ){

            			    $result[$key]['error']='-';
                        }else{
                            $ecnt++;
                            $field_err ='0';
							$licence_err_msg ='';
							$insufficient_err_msg ='';
							
							if( $value['first_name']  ==null || $value['middle_name']  ==null || $value['last_name']  ==null || $value['mobile']  ==null  ||  $value['email']  ==null  ) { 
							$field_err = '1';
							$insufficient_err_msg ='Insufficient Data';
							}
							if(   $value['is_updated'] == "0" && $value['tenant_licence_id'] == null) {
								$licence_err_msg  = 'Licence not available. ';
							} 
							
							$result[$key]['error'] =$licence_err_msg.$insufficient_err_msg;
								
                            // $result[$key]['error'] = 'Insufficient Data';
                            $this->db->where('id',$result[$key]['id']);
                            $this->db->update('tmp_bulk_user',array('is_declined'=>'1'));
                        }
            			unset($result[$key]['middle_name']);
            			unset($result[$key]['last_name']); 
            			unset($result[$key]['contact_1']);
            			unset($result[$key]['contact_name_1']);
            			unset($result[$key]['contact_2']); 
            		    unset($result[$key]['contact_name_2']);
            			unset($result[$key]['contact_3']);
            			unset($result[$key]['contact_name_3']);
            			unset($result[$key]['contact_4']);
            			unset($result[$key]['contact_name_4']);
            			//$i++;
        			}
        			$res=array('columns'=>$columns,'rows'=>$result,'icnt'=>$icnt,'ucnt'=>$ucnt,'ecnt'=>$ecnt);
        			echo json_encode($res);
                    break;      
                }
			   // echo json_encode($result);
			}
		}
    }
    
    
      public function userBulkUpload() {
    
        error_reporting(1);   error_reporting(E_ALL);
        ini_set('display_errors', '1');
	    $icnt = 0;$ucnt = 0;$ecnt = 0;
	    switch($_SERVER['REQUEST_METHOD']){ 
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			$admin_select = null;
			$total_tenant_licence = 0;
			if($_POST['admin_select']) {
                $admin_select = $_POST['admin_select'];
				$total_tenant_licence  = $this->login->getTenantLicence( $admin_select );
			}
			$licence_days = null;

			if($_POST['licence_days']) {
                $licence_days = $_POST['licence_days']; 
			}
            $plan_id = null;

			if ($_POST['plan_id']) {
                $plan_id = $_POST['plan_id']; 
			}
			$start_date =null;
			$end_date =null;
			if(isset($_POST['start_date']) &&   $_POST['start_date'] !=null ) {
               // $start_date = $_POST['start_date']; 
					 
			    	$start_date = date('Y-m-d',strtotime($_POST['start_date']))  ;
					 
					if ($licence_days !=null ) {
					   $licence_days_count = $licence_days;
					   $licence_days_count = $licence_days_count -1;
					$end_date = date('Y-m-d', strtotime($start_date . ' +'.$licence_days_count.' day'));
					}
			}

			if ($_FILES['file']['name'] != '') { 
			    
                $temp = explode(".", $_FILES['file']['name']);
                $target_path = './uploads/documents/';
                $time = mt_rand(10,100).time().round('2');
                $newfilename = 'sample_csv.' . end($temp);
                $target_path_new = $target_path . $newfilename;
                $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path_new);
                
                if($result){
                    $row = 0;
                    
                    if (($handle = fopen("./uploads/documents/sample_csv.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $row++;
                            if($row == 1){
                                continue;
                            }
                            $num = count($data);
                            // echo "<p> $num fields in line $row: <br /></p>\n";
                            $insert_data = array();
						
							
                            for ($c=0; $c < $num; $c++) {
                                // echo $data[$c] . "<br />\n";
                                $insert_data[] = $data[$c];
                            }
                            $this->login->addUserTempData($insert_data, $_POST['session_id'], $admin_select, $start_date, $end_date, $licence_days, $plan_id);
							
                        }
                        fclose($handle);
                    }
                    $result = $this->login->getBulkTempUsers($_POST['session_id']);
                    
                  //  print_r($result);die;
        			$columns[] = array('label'=>'#');
        			$columns[] = array('label'=>'Name');
        		 
        			$columns[] = array('label'=>'Email');
        			$columns[] = array('label'=>'Mobile No.');
        		//	$columns[] = array('label'=>'Cost Center Text');
        			$columns[] = array('label'=>'Gender');
        			$columns[] = array('label'=>'DOB');
        			$columns[] = array('label'=>'Age');
        			$columns[] = array('label'=>'Status');
        		 	$columns[] = array('label'=>'Action');
        			$columns[] = array('label'=>'Error');
		
			        $i=1;
					$row_licence = 0;
        			foreach ($result as $key => $value) {
         			 $result[$key]['first_name']=$value['first_name' ].' '.$value['middle_name' ].' '.$value['last_name' ];
        // 			// $result[$key]['user_type']=($value['user_type' ]== 2 ) ? 'Admin':'Employee';
        // 			 $result[$key]['gender']=($value['gender' ]== 1 ) ? 'Male':'Female';
        // 			 $result[$key]['status']=($value['status' ]== 1 ) ? 'Active':'In-active';
         			 $result[$key]['email']=mb_substr($value['email' ], 0, 10).'...';
        			 //$result[$key]['action']="<i className='fa fa-remove ptr_css' onClick=this.remove()></i>&nbsp;&nbsp;<i className='fa fa-edit ptr_css'></i>&nbsp;&nbsp;<i className='fa fa-eye ptr_css'></i>";
        		//	 $result[$key]['id']=$i;
                        $result[$key]['sr_no'] = $key+1;

                        if ($value['mobile'] && $admin_select   ) {
                            $ec1 = null;
                            $ec1_info = $this->db->get_where('users', array(
                                'mobile_no' => trim($value['mobile']), 
                                'tenant_id' =>  $admin_select , 
                                'is_deleted' => '0'))->row();
							if($ec1_info) {

								$ec1 = $ec1_info->id;
							}
                            
                            if($ec1 == null) {
                                //  $ec1_info = $this->db->get_where('users', array(
                                // 'mobile_no' => trim($value['mobile']), 
                                // 'tenant_id' =>   null , 
                                // 'is_deleted' => '0'))->row();
                                //  $ec1 = $ec1_info->id;
                                
                                
                            }
                            
                            // echo $this->db->last_query();//exit;
                            // print_r($ec1);
                            // die;
                            if ($ec1) {
                                $ucnt++;
                                $result[$key]['action'] = 'Update';
 
								
								
                                $this->db->where('id', $result[$key]['id']);
                                $this->db->update('tmp_bulk_user', array('is_updated' => '1' ,   'user_id' =>$ec1 ));
								$value['is_updated'] = '1';
							} else {
                                $icnt++;

								// $row_licence_id =null;
								// if(!empty($total_tenant_licence  )) {
								// 	if( isset($total_tenant_licence[$row_licence])) {
								// 		$row_licence_id=  $total_tenant_licence[$row_licence];
								// 		$row_licence++;
								// 	} else {
										 
								// 	}
								// }
								 

                                $result[$key]['action'] = 'Insert';

								// $this->db->where('id', $result[$key]['id']);
                                // $this->db->update('tmp_bulk_user', array('tenant_licence_id' => $row_licence_id   ));
								// $value['tenant_licence_id'] =  $row_licence_id;
								
                            }
                       
//print_r( $value);
//die;
						//  if (  $value['first_name'] &&  $value['middle_name'] &&  $value['last_name'] &&  $value['mobile'] &&  $value['email'] && $value['contact_1'] && $value['contact_name_1'] && $value['contact_2'] && $value['contact_name_2'] && $value['contact_3'] && $value['contact_name_3'] && $value['contact_4'] && $value['contact_name_4'] ){
							if (  $value['first_name'] &&  $value['middle_name'] &&  $value['last_name'] &&  $value['mobile'] &&  $value['email']  ){
								$result[$key]['error']='-';
							}else{
								$ecnt++;
							//	print_r($value   );
								//print_r(    $value['tenant_licence_id']);
								$field_err ='0';
								$licence_err_msg ='';
								$insufficient_err_msg ='';
								// if( $value['first_name']  ==null || $value['middle_name']  ==null || $value['last_name']  ==null || $value['mobile']  ==null  ||  $value['email']  ==null  ) { 
								// $field_err = '1';
								// $insufficient_err_msg ='Insufficient Data';
								// }
								// if(   $value['is_updated'] == "0" && $value['tenant_licence_id'] == null) {
								// 	$licence_err_msg  = 'Licence not available. ';
								// } 
								
								 	$result[$key]['error'] = $licence_err_msg.'Insufficient Data';
								//$result[$key]['error'] =$licence_err_msg.$insufficient_err_msg;
								
								$this->db->where('id',$result[$key]['id']);
								$this->db->update('tmp_bulk_user',array('is_declined'=>'1'));
							}
						}
            			unset($result[$key]['middle_name']);
            			unset($result[$key]['last_name']); 
            			unset($result[$key]['contact_1']);
            			unset($result[$key]['contact_name_1']);
            			unset($result[$key]['contact_2']); 
            		    unset($result[$key]['contact_name_2']);
            			unset($result[$key]['contact_3']);
            			unset($result[$key]['contact_name_3']);
            			unset($result[$key]['contact_4']);
            			unset($result[$key]['contact_name_4']);
            			//$i++;
        			}
        			$res=array('columns'=>$columns,'rows'=>$result,'icnt'=>$icnt,'ucnt'=>$ucnt,'ecnt'=>$ecnt);
        			echo json_encode($res);
                    break;      
                }
			   // echo json_encode($result);
			}
		}
    }
        	
    /**
    * @function: getDeclinedBulkUser 
    * @description: 
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
    */
    public function getDeclinedBulkUser(){
	    //error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//	echo "<pre>";print_r($_POST['session_id']);exit;
			$result = $this->login->getDeclinedBulkUser($_POST['session_id']);
			foreach ($result as $key => $value) {
			    $result[$key]['first_name']= $value['first_name'] !=null ? $value['first_name'] : "";
                $result[$key]['middle_name']= $value['middle_name']  !=null ? $value['middle_name'] : "";
                $result[$key]['last_name']= $value['last_name']  !=null ? $value['last_name'] : "";
                $result[$key]['mobile']= $value['mobile']  !=null ? $value['mobile'] : "";
                $result[$key]['email']= $value['email']  !=null ? $value['email'] : "";
                $result[$key]['gender'] = ($value['gender'] != null ) ? $value['gender'] : '';
                $result[$key]['age']=($value['age'] != null) ? $value['age'] :'';
                $result[$key]['blood_group']=($value['blood_group'] != null) ? $value['blood_group'] :'';
                $result[$key]['dob']=($value['dob'] != null) ? $value['dob'] :'';
                $result[$key]['status']=($value['status'] != null) ? $value['status'] :'';
                $action = "";
                $error = "";
                if($value['is_declined'] == 1 ) {
                    $error = "Insufficient Data";
                    $action = "Declined User";
                }
                $result[$key]['action']=$action;
                $result[$key]['error']=$error;
    			unset($result[$key]['is_declined']);
    			unset($result[$key]['session_id']);
    			unset($result[$key]['cost_center_text']);
 		
			}
			echo json_encode($result);
			break;
	    }
	}
	
 /**
    * @function: getUpdatedBulkUser 
    * @description: 
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
    */
    public function getUpdatedBulkUser(){
	   error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			//	echo "<pre>";print_r($_POST['session_id']);exit;
			$result = $this->login->getUpdatedBulkUser($_POST['session_id']);

			foreach ($result as $key => $value) {
			
			unset($result[$key]['is_declined']);
			unset($result[$key]['session_id']);
			unset($result[$key]['cost_center_text']);
 		
			}
			echo json_encode($result);
			break;
	    }
	}
	
	 /**
    * @function: saveBulkImportData 
    * @description: 
    * @param  
    * @return 
    * @date 06-may-2022 added by Manisha
    */
    public function saveBulkImportData(){
	    $result = $this->login->saveBulkUserImportData($_POST['session_id']);
	    $res = $this->login->removeBulkUserTempData($_POST['session_id']);
	    // 6-jun-2022
		$res = $this->login->clearBulkUserTempData($_POST['session_id']);
	  
	    echo $res;
	}
	
	
    /**
    * @function: getUserPoshEvidence 
    * @description: 
    * @param  
    * @return 
    * @date 27-may-2022 added by Manisha
    */
    public function getUserPoshEvidence($tid = '') {
 
		switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserPoshEvidence($tid);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
			$columns[] = array('label'=>'Latitude');
			$columns[] = array('label'=>'Longitude');
			$columns[] = array('label'=>'Date/Time');
			$columns[] = array('label'=>'Panic Evidences');
			$i = 1;
			foreach ($result as $key => $value) {
    			$arr = explode(' ',$result[$key]['timestamp']);
    			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'].'    ';
    			$result[$key]['sr_no'] = $i;
    			
    		    // 2-aug-2022
    			// get tenant name
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			          $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result[$key]['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
			
                unset($result[$key]['middle_name']);
                unset($result[$key]['last_name']);
    			$i++;
			}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;
		}
	}
	
	
	/**
     * @function: getTrackingMapById
     * @description: get Tracking Map By Id
     * @param  
     * @return map view
     * @date 22-jun-2022 added by Manisha
     */
    public function getTrackingMapById($id = null, $updated =null  ) {
         $data = array();
		if($id){
			$info=$this->db->get_where('tracking',array('id'=>$id));
		    $firebase_key=$info->row()->firebase_key;
		   
            $handle = curl_init();
            $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
            if($output){
                if( empty($output_array)) {
                $output_array = json_decode($output,true);
              //  $output_array = array_reverse($output_array);
              //  $tot_cnt = count($output_array);
                $first_arr = $output_array[0];
                $data['tracking_id'] = $id;
                $data['first_arr'] = $first_arr ;
                $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 15, '.', ''); //$first_arr['lat'];
                $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 15, '.', '');//$first_arr['lng'];
	        }
	        }
		}
		if($data) {
		    if($updated == "updated") {
	            echo json_encode($data);
		        die;
	        } else {
	        $this->load->view('google_map', $data);
	        }
	    } else {
	        echo "No record found.";
	    }
    }
    
    // 22-jun-2022
    public function getFollowMeSafeRequest ($followme_id = null  ) {
         switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
		
			$result = array();
			if($followme_id !=null && $followme_id != "null") {
    			if($followme_id) {
    			    $result  = $this->login->getFollowMeSafeRequest($followme_id);
    			    $i = 1;
    			    foreach ($result as $key => $value) {
    			        
    			        $status_value = "";
    			        if($result[$key]['status'] == "0") {
    			            $status_value = "Safe";
    			        } else  if($result[$key]['status'] == "1") {
    			             $status_value = "Unsafe";
    			        } else  if($result[$key]['status'] == "2") {
    			             $status_value = "No Action";
    			        }
    			        
    			        $result[$key]['status_title'] = $status_value;
    			    }
    			}
			}
			echo json_encode($result);
			break;

		}
	}
	
	public function getPreTriggerNotificationsMapByUser_OLD($user_id = null, $pre_trigger_id = null) {
        $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            $first_arr = $result[0];

            $data['first_arr'] = $first_arr ;
            $data['first_arr_lat'] = $first_arr['user_lat']; //number_format((float)$first_arr['user_lat'], 15, '.', '');
            $data['first_arr_lng'] = $first_arr['user_long']; //number_format((float)$first_arr['user_long'], 15, '.', '');
            
            $last_arr = end($result);
            $data['last_arr'] = $last_arr ;
            $data['last_arr_lat'] = $last_arr['user_lat'];// user_lat number_format((float)$last_arr['lat'], 15, '.', '');
            $data['last_arr_lng'] = $last_arr['user_long'];// number_format((float)$last_arr['lng'], 15, '.', '');
            
            $map_arr = [];
            $num_items = count($result);
            if(!empty($result )) {
                $result = array_reverse($result);
                foreach($result  as $k=> $row) {
                    if($k == 0) {
                        $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['user_lat'] ;
                        $map_arr[$k]['lng'] = $row['user_long'] ;
                        $map_arr[$k]['description'] =  "";
                    $map_arr[$k]['icon'] =  'https://captainindia.anekalabs.com/backend/images/start.png';
                    } else {
                         $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['user_lat'] ;
                        $map_arr[$k]['lng'] = $row['user_long'] ;
                        $map_arr[$k]['description'] =  "";
                   //     $map_arr[$k]['icon'] =  "";
                    }
                     if(++$k === $num_items) {
                         $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['user_lat'] ;
                        $map_arr[$k]['lng'] = $row['user_long'] ;
                        $map_arr[$k]['description'] =  "";
                       $map_arr[$k]['icon'] =  'https://captainindia.anekalabs.com/backend/images/stop.png';
                      }
                }
            }
            $data['map_arr']=json_encode($map_arr);

            $this->load->view('google_map_followme', $data);
	    } else {
	        echo "No record found.";
	        die;
	    }
	}
	public function getPreTriggerNotificationsMapByUsermap($user_id = null, $pre_trigger_id = null) {
      
 //error_reporting(E_ALL);
   ///      ini_set('display_errors', '1');
         $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            
            $tracking_id_arr = $result[0]['tracking_id'] ;
            
            $firebase_key = "Tracking_id_". $tracking_id_arr;
            $handle = curl_init();
             $firebase_key = "Tracking_id_438";
            $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
             
            if($output){
                if( empty($output_array)) {
                    $output_array = json_decode($output,true);
              
                    $first_arr = $output_array[0];
                 //  $data['tracking_id'] = $id;
                    $data['first_arr'] = $first_arr ;
                    $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 6, '.', ''); //$first_arr['lat'];
                    $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 6, '.', '');//$first_arr['lng'];
	            }
	        }
	     
	        
	         $map_arr = [];
	         if(!empty($output_array )) {
	           
                foreach($output_array  as $k=> $row) {
                 
                        $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['lat'] ;
                        $map_arr[$k]['lng'] = $row['lng'] ;
                        $map_arr[$k]['description'] =  "";
                
                }
            }
             $data['map_arr']=json_encode($map_arr);
            $this->load->view('google_map_followme_map', $data);
  
	}
	}
		
	public function getPreTriggerNotificationsMapByUsertest($user_id = null, $pre_trigger_id = null) {

	    $firebase_key = "Tracking_id_438";
	    $data = array();
		if($firebase_key){
			$info=$this->db->get_where('tracking',array('id'=>$id));
		    $firebase_key=$info->row()->firebase_key;
		   
            $handle = curl_init();
             $firebase_key = "Tracking_id_438";
            $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
             
            if($output){
                if( empty($output_array)) {
                $output_array = json_decode($output,true);
              //  $output_array = array_reverse($output_array);
              //  $tot_cnt = count($output_array);
                $first_arr = $output_array[0];
                $data['tracking_id'] = $id;
                $data['first_arr'] = $first_arr ;
                $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 15, '.', ''); //$first_arr['lat'];
                $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 15, '.', '');//$first_arr['lng'];
	        }
	        }
	      //  echo "<pre>";
	     //  // print_r($output_array);
	        
	         $map_arr = [];
	         if(!empty($output_array )) {
	            // echo __LINE__;
                foreach($output_array  as $k=> $row) {
                   // print_r($row);
                 //   die;
                 
                        $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['lat'] ;
                        $map_arr[$k]['lng'] = $row['lng'] ;
                        $map_arr[$k]['description'] =  "";
                
                }
            }
          
		}
 	if($data) {
	             $data['map_arr']=json_encode($map_arr);
	           //   print_r($data);
            //  die;
	        $this->load->view('google_map_followme_test', $data);
	    } else {
	        echo "No record found.";
	    }
	    die;
	    //////////
        $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            $first_arr = $result[0];

            $data['first_arr'] = $first_arr ;
            $data['first_arr_lat'] = $first_arr['user_lat']; //number_format((float)$first_arr['user_lat'], 15, '.', '');
            $data['first_arr_lng'] = $first_arr['user_long']; //number_format((float)$first_arr['user_long'], 15, '.', '');
            
            $last_arr = end($result);
            $data['last_arr'] = $last_arr ;
            $data['last_arr_lat'] = $last_arr['user_lat'];// user_lat number_format((float)$last_arr['lat'], 15, '.', '');
            $data['last_arr_lng'] = $last_arr['user_long'];// number_format((float)$last_arr['lng'], 15, '.', '');
           
            $map_arr = [];
            $num_items = count($result);
            
            if(!empty($result )) {
                foreach($result  as $k=> $row) {
                    if($k == 0) {
                        $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['user_lat'] ;
                        $map_arr[$k]['lng'] = $row['user_long'] ;
                        $map_arr[$k]['description'] =  "";
                   //     $map_arr[$k]['icon'] =  'https://captainindia.anekalabs.com/backend/images/start.png';
                    } else {
                         $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['user_lat'] ;
                        $map_arr[$k]['lng'] = $row['user_long'] ;
                        $map_arr[$k]['description'] =  "";
                   //     $map_arr[$k]['icon'] =  "";
                    }
                     if(++$k === $num_items) {
                         $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   "";
                        $map_arr[$k]['lat'] = $row['user_lat'] ;
                        $map_arr[$k]['lng'] = $row['user_long'] ;
                        $map_arr[$k]['description'] =  "";
                      //  $map_arr[$k]['icon'] =  'https://captainindia.anekalabs.com/backend/images/stop.png';
                      }
                }
            }
             $data['map_arr']=json_encode($map_arr);
             $data['res']=$result; 
          //  echo "<pre>";          //  print_r($map_arr);          //  print_r($data);          //  die;
            $this->load->view('google_map_followme_test', $data);
	    } else {
	        echo "No record found.";
	        die;
	    }
	}
	
	public function getPreTriggerNotificationsMapByUser_POINTER($user_id  , $pre_trigger_id  ) {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
	   
	    $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            $tracking_id_arr = $result[0]['tracking_id'] ;
            $firebase_key = "Tracking_id_". $tracking_id_arr;
		    if($firebase_key){
                $handle = curl_init();

                $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                // Set the url
                curl_setopt($handle, CURLOPT_URL, $url);
                // Set the result output to be a string.
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($handle);
                curl_close($handle);
             
                if($output){
                    if( empty($output_array)) {
                        $output_array = json_decode($output,true);
                   $output_array = array_reverse($output_array);
                      //  $tot_cnt = count($output_array);
                      $first_arr = $output_array[0];
                     //   $data['tracking_id'] = $id;
                        $data['first_arr'] = $first_arr ;
                        $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 6, '.', ''); //$first_arr['lat'];
                         $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 6, '.', '');//$first_arr['lng'];
        	       }
    	        }
    	         $map_arr = [];
    	         $map_array = [];
    	        if(!empty($output_array )) {
                    foreach($output_array  as $k=> $row) {
                        $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   $row['time'] ;
                        $map_arr[$k]['lat'] = (string) $row['lat'] ;
                        $map_arr[$k]['lng'] = (string) $row['lng'] ;
                        $map_arr[$k]['description'] =  $row['time'] ;
                        $ulat =   number_format((float)$row['lat'], 6, '.', '');
                        $ulng =   number_format((float)$row['lng'], 6, '.', '');
                  	    date_default_timezone_set('Asia/Kolkata');
                        $date_value =	date('Y-m-d H:i:s',  $row['time']/1000);
                        $aaa = array( 
                            $date_value ,  $ulat,  $ulng, $k+1);
                        $map_array[$k]  =$aaa ;
                    }
                }
		    }

     	    if($map_arr) {
    	        $data['map_arr']=json_encode($map_arr);
    	        $data['map_array']=json_encode($map_array);
    	        $this->load->view('google_map_followme_view', $data);
    	    } else {
    	        echo "No record found.";
    	    }
        }
	}
	
 	public function getPreTriggerNotificationsMapByUser_bk_31_aug_2022($user_id  , $pre_trigger_id  ) {
        // error_reporting(E_ALL);
       //ini_set('display_errors', '1');
	   
	    $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            $result_end_array =   end($result) ;
            $tracking_status_stop_date = $result[0]['status_stop_date'] ;
            $tracking_id_arr = $result[0]['tracking_id'] ;
            $firebase_key = "Tracking_id_". $tracking_id_arr;
            $res_location_log = "";
            if( $firebase_key ) {
                $res_location_log= $this->login->getLocationLog($firebase_key );
            }
		    if($firebase_key){
                if( $res_location_log == "") {
                    $handle = curl_init();
                    // $firebase_key = "Tracking_id_438";
                    $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                    //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                    curl_setopt($handle, CURLOPT_URL, $url);
                    // Set the result output to be a string.
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($handle);
                    curl_close($handle);
                } else {
                    $output = $res_location_log;
                }
                if($output){
                    if(  $output !="null") {
                        $output_array = json_decode($output,true);
                   $output_array = array_reverse($output_array);
                      //  $tot_cnt = count($output_array);
                      $first_arr = $output_array[0];
                     //   $data['tracking_id'] = $id;
                        $data['first_arr'] = $first_arr ;
                        $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 6, '.', ''); //$first_arr['lat'];
                         $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 6, '.', '');//$first_arr['lng'];
        	       }
    	        }
    	        
    	         $map_arr = [];
    	         $map_array = [];
    	          $iteration_ct = 0;
    	           $last_val = 0;
    	        if(!empty($output_array )) {
    	            $num_items = count($output_array);
                    foreach($output_array  as $k=> $row) {
                        $key = $k;
                        $last_val=$k;
                //       if ($iteration_ct ==  $k || ++$last_val == $num_items ) {
                            $result[$k]['title'] =   "";
                            $map_arr[$k]['title'] =   $row['time'] ;
                            $map_arr[$k]['lat'] = (string) $row['lat'] ;
                            $map_arr[$k]['lng'] = (string) $row['lng'] ;
                            $map_arr[$k]['description'] =  $row['time'] ;
                            $ulat =   number_format((float)$row['lat'], 6, '.', '');
                            $ulng =   number_format((float)$row['lng'], 6, '.', '');
                      	    date_default_timezone_set('Asia/Kolkata');
                      	    
                      	    if(is_float($row['time'])) {
                                $date_value = date('Y-m-d H:i:s',  $row['time']);
                      	    } else {
                                $date_value = date('Y-m-d H:i:s',  $row['time']/1000);
                      	    }
                      	    
                            if($k==0) {
                                $aaa = array( $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/start.png');
                            } else    if(++$key == $num_items &&   $tracking_status_stop_date !=null  ) {
                                if($tracking_status_stop_date !=null ) {
                                    $aaa = array( $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/end.png');
                                }
                            } else {
                                $aaa = array( 
                                $date_value ,  $ulat,  $ulng, $k+1, '');
                            }
                   //     }
                        // if($k == $iteration_ct){
                        //     $iteration_ct = $iteration_ct +10;
                        // }
                        $map_array[$k]  =$aaa ;
                    }
                }
		    }
           
     	    if($map_arr) {
    	        $data['map_arr']=json_encode($map_arr);
    	        $data['map_array']=json_encode($map_array);
    	        $this->load->view('google_map_followme_view_point', $data);
    	    } else {
    	        echo "No record found.";
    	    }
        }
	}
	
	// 4-jul-2022 get posh
	public function getUserPoshDetail  ($id){
	 //   error_reporting(E_ALL);  
	 //	 ini_set('display_errors', '1');
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserPoshDetail($id);
			echo json_encode($result);
			break;
		}
	}
	public function getPreTriggerNotificationsMapByUser($user_id  , $pre_trigger_id  ) {
      
        // error_reporting(E_ALL);
       //ini_set('display_errors', '1');
	   
	    $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            $result_end_array =   end($result) ;
            $tracking_status_stop_date = $result[0]['status_stop_date'] ;
            $tracking_id_arr = $result[0]['tracking_id'] ;
            $firebase_key = "Tracking_id_". $tracking_id_arr;
            $res_location_log = "";
            if( $firebase_key ) {
                $res_location_log= $this->login->getLocationLog($firebase_key );
            }
		    if($firebase_key){
                if( $res_location_log == "") {
                    $handle = curl_init();
                    $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                    //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                    curl_setopt($handle, CURLOPT_URL, $url);
                    // Set the result output to be a string.
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($handle);
                    curl_close($handle);
                } else {
                    $output = $res_location_log;
                }
                if($output){
                    if(  $output !="null") {
                        $output_array = json_decode($output,true);
                   $output_array = array_reverse($output_array);
                      //  $tot_cnt = count($output_array);
                      $first_arr = $output_array[0];
                     //   $data['tracking_id'] = $id;
                        $data['first_arr'] = $first_arr ;
                        $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 6, '.', ''); //$first_arr['lat'];
                         $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 6, '.', '');//$first_arr['lng'];
        	        }
    	        }
    	        
    	         $map_arr = [];
    	         $map_array = [];
    	          $iteration_ct = 0;
    	           $last_val = 0;
    	        if(!empty($output_array )) {
    	            $num_items = count($output_array);
                    foreach($output_array  as $k=> $row) {
                        $key = $k;
                        $last_val=$k;
                //       if ($iteration_ct ==  $k || ++$last_val == $num_items ) {
                            $result[$k]['title'] =   "";
                            // $map_arr[$k]['title'] =   $row['time'] ;
                          
                            $map_arr[$k]['lat'] = (string) $row['lat'] ;
                            $map_arr[$k]['lng'] = (string) $row['lng'] ;
                            $map_arr[$k]['description'] =  $row['time'] ;
                            $ulat =   number_format((float)$row['lat'], 6, '.', '');
                            $ulng =   number_format((float)$row['lng'], 6, '.', '');
                      	    date_default_timezone_set('Asia/Kolkata');
                      	    
                      	    if(is_float($row['time'])) {
                                $date_value = date('Y-m-d H:i:s',  $row['time']);
                      	    } else {
                                $date_value = date('Y-m-d H:i:s',  $row['time']/1000);
                      	    }
                      	      $map_arr[$k]['title'] =   $date_value;
                      	      $icon = " ";
                            if($k==0) {
                                $aaa = array( $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/start.png');
                                $icon = 'https://captainindia.anekalabs.com/backend/images/start.png';
                            } else    if(++$key == $num_items &&   $tracking_status_stop_date !=null  ) {
                                if($tracking_status_stop_date !=null ) {
                                    $aaa = array( $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/end.png');
                                     $icon =  'https://captainindia.anekalabs.com/backend/images/end.png';
                                }
                            } else {
                                $aaa = array( 
                                $date_value ,  $ulat,  $ulng, $k+1, '');
                            }
                            
                             $map_arr[$k]['icon'] =   $icon;
                   //     }
                        // if($k == $iteration_ct){
                        //     $iteration_ct = $iteration_ct +10;
                        // }
                        $map_array[$k]  =$aaa ;
                    }
                }
		    }
           
     	    if($map_arr) {
    	      //  $data['map_arr']= ($map_arr);
    	        $data['map_arr']=json_encode($map_arr);
    	        $data['map_array']=json_encode($map_array);

    	        $this->load->view('google_map_followme_line', $data);
    	    } else {
    	        echo "No record found.";
    	    }
        }
	}
	public function testfunctionTwentyiteration () {
        $colors = array(1, 2, 3, 4, 5,6,7,8,9,10,11,12, 13,14,15,16,17,18,19,20,21,22,23 ,24,25,26 ); 
        $iteration_ct = 0; $last_val = 0;
        
        $ct =count( $colors);
        foreach ($colors as $k=> $value) {
            $last_val=$k;
            // echo " a = $iteration_ct <br>";
            if($k==$iteration_ct || ++$last_val == $ct ){
                echo "$value <br>";
            }
            if($k == $iteration_ct){
                $iteration_ct = $iteration_ct +10;
            }
            
        }
 
	 }
	 
    public function track($id = null, $updated =null  ) {
         $data = array();
		if($id){
			$info=$this->db->get_where('tracking',array('id'=>$id));
		    $firebase_key=$info->row()->firebase_key;
		   
            $handle = curl_init();
            $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
            // Set the url
            curl_setopt($handle, CURLOPT_URL, $url);
            // Set the result output to be a string.
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
            if($output){
                if( empty($output_array)) {
                $output_array = json_decode($output,true);
               $output_array = array_reverse($output_array);
              //  $tot_cnt = count($output_array);
                $first_arr = $output_array[0];
                $data['tracking_id'] = $id;
                $data['first_arr'] = $first_arr ;
                $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 6, '.', ''); //$first_arr['lat'];
                $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 6, '.', '');//$first_arr['lng'];
	        }
	        }
	        echo "<pre>";
            		print_r($output_array);
            // // 		print_r($map_arr);
            		die;
            $map_arr = [];
             $map_array = [];
              $num_items = count($output_array);
              $iteration_ct = 0;
            $last_val = 0;
            if(!empty($output_array )) {
                foreach($output_array  as $k=> $row) {
                    $key = $k;
                    $last_val=$k;
                    
            //       if ($iteration_ct ==  $k || ++$last_val == $num_items ) {
                        $result[$k]['title'] =   "";
                        $map_arr[$k]['title'] =   $row['time'] ;
                        $map_arr[$k]['lat'] = (string) $row['lat'] ;
                        $map_arr[$k]['lng'] = (string) $row['lng'] ;
                        $map_arr[$k]['description'] =  $row['time'] ;
                        $ulat =   number_format((float)$row['lat'], 6, '.', '');
                        $ulng =   number_format((float)$row['lng'], 6, '.', '');
                  	    date_default_timezone_set('Asia/Kolkata');
                        $date_value =	date('Y-m-d H:i:s',  $row['time']/1000);
                        
                        $date_value = $row['time'];
                        if($k==0) {
                        $aaa = array( 
                            $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/start.png');
                        } else    if(++$key == $num_items) {
                             $aaa = array( 
                            $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/end.png');
                        } else {
                            $aaa = array( 
                            $date_value ,  $ulat,  $ulng, $k+1, '');
                        }
               //     }
                    // if($k == $iteration_ct){
                    //     $iteration_ct = $iteration_ct +10;
                    // }
                    $map_array[$k]  =$aaa ;
                }
            }
		}
		if($map_arr) {
	 
	        
    	        $data['map_arr']=json_encode($map_arr);
    	        $data['map_array']=json_encode($map_array);
    	 
    	     
	        $this->load->view('google_map_tracking_view_point', $data);
	        //}
	    } else {
	        echo "No record found.";
	    }
    }
    
    public function testfollowme($user_id  , $pre_trigger_id  ) {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
	    $result = $this->login->getPreTriggerNotificationsByUserId($user_id, $pre_trigger_id);
        $data = array();
        if (!empty($result)) {
            $tracking_id_arr = $result[0]['tracking_id'] ;
            $firebase_key = "Tracking_id_". $tracking_id_arr;
		    if($firebase_key){
                $handle = curl_init();
                // $firebase_key = "Tracking_id_438";
                //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
                 $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                // Set the url
                curl_setopt($handle, CURLOPT_URL, $url);
                // Set the result output to be a string.
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($handle);
                curl_close($handle);
             
                if($output){
                    if( empty($output_array)) {
                        $output_array = json_decode($output,true);
                   $output_array = array_reverse($output_array);
                      //  $tot_cnt = count($output_array);
                      $first_arr = $output_array[0];
                     //   $data['tracking_id'] = $id;
                        $data['first_arr'] = $first_arr ;
                        $data['first_arr_lat'] = number_format((float)$first_arr['lat'], 6, '.', ''); //$first_arr['lat'];
                         $data['first_arr_lng'] = number_format((float)$first_arr['lng'], 6, '.', '');//$first_arr['lng'];
        	       }
    	        }
    	         $map_arr = [];
    	         $map_array = [];
    	          $num_items = count($output_array);
    	          $iteration_ct = 0;
    	           $last_val = 0;
    	        if(!empty($output_array )) {
                    foreach($output_array  as $k=> $row) {
                        $key = $k;
                        $last_val=$k;
                     if ($iteration_ct ==  $k || ++$last_val == $num_items ) {
                            $result[$k]['title'] =   "";
                            $map_arr[$k]['title'] =   $row['time'] ;
                            $map_arr[$k]['lat'] = (string) $row['lat'] ;
                            $map_arr[$k]['lng'] = (string) $row['lng'] ;
                            $map_arr[$k]['description'] =  $row['time'] ;
                            $ulat =   number_format((float)$row['lat'], 6, '.', '');
                            $ulng =   number_format((float)$row['lng'], 6, '.', '');
                      	    date_default_timezone_set('Asia/Kolkata');
                            $date_value =	date('Y-m-d H:i:s',  $row['time']/1000);
                            if($k==0) {
                            $aaa = array( 
                                $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/start.png');
                            } else    if(++$key == $num_items) {
                                 $aaa = array( 
                                $date_value,  $ulat,  $ulng, $k+1, 'https://captainindia.anekalabs.com/backend/images/end.png');
                            } else {
                                $aaa = array( 
                                $date_value ,  $ulat,  $ulng, $k+1, '');
                            }
                      }
                         if($k == $iteration_ct){
                              $iteration_ct = $iteration_ct +1;
                        }
                        $map_array[$k]  =$aaa ;
                    }
                }
		    }
     	    if($map_arr) {
    	        $data['map_arr']=json_encode($map_arr);
    	        $data['map_array']=json_encode($map_array);
    	        $this->load->view('followme_map', $data);
    	    } else {
    	        echo "No record found.";
    	    }
        }
	}

 
	public function registerCall() {
	     error_reporting(E_ALL);        ini_set('display_errors', '1');
	     $this->load->view('register_call');
	    // $this->load->view('ambulance_call');
	}
	
	public function addUserMyresqr () {
	    error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
	    if($input_data) {
	        $data = $input_data;
	        $insert_data= array(
    		//	'user_type'=>$data['user_type'],
    		 	'user_name'=>$data['user_name'],
    			'first_name'=>$data['firstname'],
    			'middle_name'=>$data['middlename'],
    			'last_name'=>$data['lastname'],
    			'email'=>$data['email'],
    			'address'=>$data['address'],
    			'city'=>$data['city'],
    			'state'=>$data['state'],
    			'pincode'=>$data['pincode'],
    			'age'=>$data['age'],
    			'gender'=>$data['gender'],
    			'mobile_no'=>$data['mobile_no'],
    			'blood_group'=>$data['blood_group'],
    			'date_of_birth'=>date('Y-m-d',strtotime($data['date_of_birth'])),
    			'status'=>$data['status'],
    			'govt_id_image_url'=>$data['govt_id_image_url'],
    			'govt_id_number'=>$data['govt_id_number'],
    			'govt_id_type'=>$data['govt_id_type'],
    			'myresqr_status'=> '1',
		    );
    		$this->db->insert('users',$insert_data);
    		
    		$user_id= $this->db->insert_id();
    		 $user_detail = array();
    	    if ($user_id) {
    	          //  $user_unique_id= "capind_".$user_detail->id;
    		    $unique_id= "tst_".$user_id;
    		        
    	        $update_data['unique_id'] = $unique_id;
            	$this->db->where('id',$user_id);
        		$this->db->update('users',$update_data);

        	    $this->db->where('id',$user_id);
    		    $user_detail = $this->db->get('users')->row();
            }
    		 
            if(!empty($user_detail)) {
    	        //$user_id = 209;
        	    $this->db->where('id',$user_id);
    		    $user_detail = $this->db->get('users')->row();
    		    if($user_detail) {
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
        		    $govt_id_image_url= "";
        		    $govt_id_number = "";
        		    $govt_id_type = "";
		    
    		        $user_id = $user_detail->id;
    		        $unique_id = $user_detail->unique_id;
    		        $first_name = $user_detail->first_name;
    		        $middle_name = $user_detail->middle_name;
    		        $last_name = $user_detail->last_name;
    		        $email = $user_detail->email;
    		        $mobile_no = $user_detail->mobile_no;
    		        $gender = $user_detail->gender ?  "Male" : "Female";
    		        $address = $user_detail->address;
    		        $date_of_birth = $user_detail->date_of_birth;
    		        $city = $user_detail->city;
    		        $state = $user_detail->state;
    		        $pincode = $user_detail->pincode;
    		        $govt_id_image_url = $user_detail->govt_id_image_url;
    		        $govt_id_number = $user_detail->govt_id_number;
    		        $govt_id_type = $user_detail->govt_id_type;
    		   
        		    $insert_myresqr_user=array(
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
        		    $insert_myresqr_json_user =  json_encode($insert_myresqr_user);
        		    
        		    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
        		    $php_utcNow =date("D, d M Y h:i:s ").date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/register/" . "\n" .$php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials."&Signature=" . $sig;
                
                    $header_arr= array(
                        'x-myresqr-date: '.$php_utcNow,
                        'Authorization: '.$newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );
                
                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL , 'https://api.myresqr.life/tps/v1/register/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
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
                    //echo "\n";
                   // print_r(json_encode($insert_myresqr_user));
        		   
                    //{"uniqueId":"tst209","success":true}
        	      //  print_r($user_detail);
        	 
        	    }else{
        			  $result = array('status'  => 'Fail','message' => "No record found." ,  );
        	   		  print json_encode( $result );
        		}
	        }
        }
	}
	
	public function updateUserMyresqr () {
	    error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
	    if($input_data && isset($input_data['user_id'] ) ) {
	        $data = $input_data;
	        if($data['user_id'] ) {
	            $user_id = $data['user_id'] ;
	        }
	        $update_data= array();
    	 
    	    if(isset($data['user_name'])) {
    			$update_data['user_name'] = $data['user_name'];
    	    }
    	    if(isset($data['firstname'])) {
    			$update_data['first_name'] = $data['firstname'];
    	    }
    	    if(isset($data['middlename'])) {
    			$update_data['middle_name'] = $data['middlename'];
    	    }
    	    if(isset($data['lastname'])) {
    			$update_data['last_name'] = $data['lastname'];
    	    }
    	    if(isset($data['email'])) {
    			$update_data['email'] = $data['email'];
    	    }
    	    if(isset($data['address'])) {
    			$update_data['address'] = $data['address'];
    	    }
    	    if(isset($data['city'])) {
    			$update_data['city'] = $data['city'];
    	    }
    	    if(isset($data['state'])) {
    			$update_data['state'] = $data['state'];
    	    }
    	    if(isset($data['pincode'])) {
    			$update_data['pincode'] = $data['pincode'];
    	    }
    	    if(isset($data['age'])) {
    			$update_data['age'] = $data['age'];
    	    }
    	    if(isset($data['gender'])) {
    			$update_data['gender'] = $data['gender'];
    	    }
    	    if(isset($data['mobile_no'])) {
    			$update_data['mobile_no'] = $data['mobile_no'];
    	    }
    	    if(isset($data['blood_group'])) {
    			$update_data['blood_group'] = $data['blood_group'];
    	    }
    	    if(isset($data['date_of_birth'])) {
    			$update_data['date_of_birth'] = $data['date_of_birth'];
    	    }
    	    if(isset($data['status'])) {
    			$update_data['status'] = $data['status'];
    	    }
    	    if(isset($data['govt_id_image_url'])) {
    			$update_data['govt_id_image_url'] = $data['govt_id_image_url'];
    	    }
    	    if(isset($data['govt_id_number'])) {
    			$update_data['govt_id_number'] = $data['govt_id_number'];
    	    }
    	    if(isset($data['govt_id_type'])) {
    			$update_data['govt_id_type'] = $data['govt_id_type'];
    	    }
    			 
        	$this->db->where('id',$user_id);
    		$this->db->update('users',$update_data);
    		 $user_detail = array();
    	    if ($user_id) {
        	    $this->db->where('id',$user_id);
    		    $user_detail = $this->db->get('users')->row();
            }
    		 
            if(!empty($user_detail)) {
        	    $this->db->where('id',$user_id);
    		    $user_detail = $this->db->get('users')->row();
    		    if($user_detail) {
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
        		    $govt_id_image_url= "";
        		    $govt_id_number = "";
        		    $govt_id_type = "";
    
    		        $user_id = $user_detail->id;
    		        $unique_id = $user_detail->unique_id;
    		        $first_name = $user_detail->first_name;
    		        $middle_name = $user_detail->middle_name;
    		        $last_name = $user_detail->last_name;
    		        $email = $user_detail->email;
    		        $mobile_no = $user_detail->mobile_no;
    		        $gender = $user_detail->gender ?  "Male" : "Female";
    		        $address = $user_detail->address;
    		        $date_of_birth = $user_detail->date_of_birth;
    		        $city = $user_detail->city;
    		        $state = $user_detail->state;
    		        $pincode = $user_detail->pincode;
    		        $govt_id_image_url = $user_detail->govt_id_image_url;
    		        $govt_id_number = $user_detail->govt_id_number;
    		        $govt_id_type = $user_detail->govt_id_type;
    		   
        		    $insert_myresqr_user=array();
        		    
        		    $insert_myresqr_user['uniqueId'] = $unique_id;
        		   
        		    if(isset($data['firstname'])) {
        		        $insert_myresqr_user['firstname'] = $first_name;
        		    }
        		    if(isset($data['lastname'])) {
        		        $insert_myresqr_user['lastname'] = $last_name;
        		    }
        		    if(isset($data['mobile_no'])) {
        		        $insert_myresqr_user['mobile'] = $mobile_no;
        		    }
        		    if(isset($data['email'])) {
        		        $insert_myresqr_user['email'] = $email;
        		    }
        		    if(isset($data['gender'])) {
        		        $insert_myresqr_user['gender'] = $gender;
        		    }
        		    if(isset($data['address'])) {
        		        $insert_myresqr_user['address'] = $address;
        		    }
        		    if(isset($data['date_of_birth'])) {
        		        $insert_myresqr_user['dob'] = $date_of_birth;
        		    }
        		    if(isset($data['city'])) {
        		        $insert_myresqr_user['city'] = $city;
        		    }
        		    if(isset($data['state'])) {
        		        $insert_myresqr_user['state'] = $state;
        		    }
        		    if(isset($data['pincode'])) {
        		        $insert_myresqr_user['pincode'] = $pincode;
        		    }
        		    if(isset($data['govt_id_image_url'])) {
        		        $insert_myresqr_user['govtIdImageUrl'] = $govt_id_image_url;
        		    }
        		    if(isset($data['govt_id_number'])) {
        		        $insert_myresqr_user['govtIdNumber'] = $govt_id_number;
        		    }
        		    if(isset($data['govt_id_type'])) {
        		        $insert_myresqr_user['govtIdType'] = $govt_id_type;
        		    }

        		    $insert_myresqr_json_user =  json_encode($insert_myresqr_user);
        		    
        		    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
        		    $php_utcNow =date("D, d M Y h:i:s ").date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/update/" . "\n" .$php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials."&Signature=" . $sig;
                
                    $header_arr= array(
                        'x-myresqr-date: '.$php_utcNow,
                        'Authorization: '.$newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );
                
                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL , 'https://api.myresqr.life/tps/v1/update/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                   // curl_setopt($curl, CURLOPT_HEADER, true);
                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                    //curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
                    $response = curl_exec($curl);
                    curl_close($curl);
                   // print_r($response);
                    if($response) {
                        $json_result = json_decode($response, true);
                        //print_R($json_result);
                       // echo $json_result['uniqueId'];
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
        	 
        	    }else{
        			  $result = array('status'  => 'Fail','message' => "No record found."   );
        	   		  print json_encode( $result );
        		}
	        }
        }
	}
	
	public function unregisterUserMyresqr() {
	    error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
	    if($input_data && isset($input_data['user_id'] ) ) {
	        $data = $input_data;
	        if($data['user_id'] ) {
	            $user_id = $data['user_id'] ;
	        }
	        $update_data= array();
    	 
    	    if(isset($data['user_id'])) {
    			$update_data['myresqr_status'] = '2';
    	    }
        	$this->db->where('id',$user_id);
    		$this->db->update('users',$update_data);

    		 $user_detail = array();
    	    if ($user_id) {
        	    $this->db->where('id',$user_id);
    		    $user_detail = $this->db->get('users')->row();
            }
    		 
            if(!empty($user_detail)) {
        	    $this->db->where('id',$user_id);
    		    $user_detail = $this->db->get('users')->row();
    		    if($user_detail) {
        		    $unique_id = "";

    		        $user_id = $user_detail->id;
    
    		      //  $user_unique_id= "capind_".$user_detail->id;
    		        $unique_id= $user_detail->unique_id;
    		        $user_id = $user_detail->id;
        		    $insert_myresqr_user=array(
        		       'uniqueId' => $unique_id,
        		    );
        		    $insert_myresqr_json_user =  json_encode($insert_myresqr_user);
        		    
        		    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
        		    $php_utcNow =date("D, d M Y h:i:s ").date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/unregister/" . "\n" .$php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials."&Signature=" . $sig;
                
                    $header_arr= array(
                        'x-myresqr-date: '.$php_utcNow,
                        'Authorization: '.$newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );
                
                    // START - curl
                    $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL , 'https://api.myresqr.life/tps/v1/unregister/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
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
                    //echo "\n";
                   // print_r(json_encode($insert_myresqr_user));
        		   
                    //{"uniqueId":"tst209","success":true}
        	      //  print_r($user_detail);
        	 
        	    }else{
        			  $result = array('status'  => 'Fail','message' => "No record found." ,  );
        	   		  print json_encode( $result );
        		}
	        }
        }
	}
	
	public function userCallAmbulanceMyresqr() {
	    error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
	    if($input_data && isset($input_data['user_id'] ) ) {
	        $data = $input_data;
	        $user_detail = array();
	        $unique_id = "";
	        $user_id = "";
	        $device_id ="";
	        $latitude ="";
	        $longitude ="";
	        if(isset($data['device_id'])) {
	            $device_id = $data['device_id'];
	        }
	        if(isset($data['latitude'])) {
	            $latitude = $data['latitude'];
	        }
	        if(isset($data['longitude'])) {
	            $longitude = $data['longitude'];
	        }
	        if($data['user_id']) {
	            $user_id = $data['user_id'] ;
	            if ($user_id) {
            	    $this->db->where('id',$user_id);
        		    $user_detail = $this->db->get('users')->row();
    		        $unique_id= $user_detail->unique_id;
                }
	        }

    	    $data = $input_data;
	        $insert_data= array(
    		 	'user_id'=>$data['user_id'],
    		 	'unique_id'=>$unique_id,
    			'device_id'=>$data['device_id'],
    			'latitude'=>$data['latitude'],
    			'longitude'=>$data['longitude'],
		    );
    		$this->db->insert('call_ambulance',$insert_data);
    		
    		$call_ambulance_id= $this->db->insert_id();
    // 	    if(isset($data['user_id'])) {
    // 			$update_data['myresqr_status'] = '2';
    // 	    }
    //     	$this->db->where('id',$user_id);
    // 		$this->db->update('users',$update_data);
    	  //print_r($update_data);   	 die;
    		 
            if(!empty($user_detail)) {
    		    if($user_detail) {
    		   
        		    $insert_myresqr_user=array(
        		       'uniqueId' => $unique_id,
        		       'location' => [$latitude , $longitude],
        		       'deviceId' => $device_id,
        		    );
        		    $insert_myresqr_json_user =  json_encode($insert_myresqr_user);
        		    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
        		    $php_utcNow =date("D, d M Y h:i:s ").date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/call-ambulance/" . "\n" .$php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials."&Signature=" . $sig;
                
                    $header_arr= array(
                        'x-myresqr-date: '.$php_utcNow,
                        'Authorization: '.$newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );
                
                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL , 'https://api.myresqr.life/tps/v1/call-ambulance/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
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
                   if($response) {
                        $json_result = json_decode($response, true);
                        //print_R($json_result);
                        if($json_result['requestId']) {
                            $update_call_ambulance_data = array();
                            
                    	    $update_call_ambulance_data['request_id'] = $json_result['requestId'];
                    	    $update_call_ambulance_data['request_result'] = $response;
                    	    
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
        	 
        	    }else{
        			  $result = array('status'  => 'Fail','message' => "No record found." ,  );
        	   		  print json_encode( $result );
        		}
	        }
        }
	}
	
    public function userGetAmbulanceDetailsMyresqr() {
	    error_reporting(E_ALL); ini_set('display_errors', '1');
        date_default_timezone_set('GMT');

        $input_data = $_POST;
	    if($input_data && isset($input_data['request_id'] ) ) {
	        $data = $input_data;
	        $user_detail = array();
	        $unique_id = "";
	      
	       // if(isset($data['device_id'])) {
	       //     $device_id = $data['device_id'];
	       // }
	       
	       // if($data['user_id']) {
	       //     $user_id = $data['user_id'] ;
	       //     if ($user_id) {
        //     	    $this->db->where('id',$user_id);
        // 		    $user_detail = $this->db->get('users')->row();
    		  //      $unique_id= $user_detail->unique_id;
        //         }
	       // }
    // 	    $data = $input_data;
	   //     $insert_data= array(
    // 		 	'user_id'=>$data['user_id'],
    // 		 	'unique_id'=>$unique_id,
    // 			'device_id'=>$data['device_id'],
    // 			'latitude'=>$data['latitude'],
    // 			'longitude'=>$data['longitude'],
		  //  );
    // 		$this->db->insert('call_ambulance',$insert_data);
    		
    // 		$call_ambulance_id= $this->db->insert_id();
    // 	    if(isset($data['user_id'])) {
    // 			$update_data['myresqr_status'] = '2';
    // 	    }
    //     	$this->db->where('id',$user_id);
    // 		$this->db->update('users',$update_data);

    		$request_id = $data['request_id'];
    		$ambulance_service_id = "";
    		$user_id = "";
            if(isset($input_data['ambulance_service_id'] ) ) {
                $ambulance_service_id = $input_data['ambulance_service_id'];
            }
            if(isset($input_data['user_id'] ) ) {
                $user_id = $input_data['user_id'];
            }
            if($ambulance_service_id == 2) {
                $this->userGetAmbulanceDetailsZimaxDial($request_id, $user_id);
            } else {
            
            if(!empty($request_id)) {
    		    if($request_id) {
        		    $insert_myresqr_user=array(
        		       'requestId' => $request_id,
        		    );
        		    $insert_myresqr_json_user =  json_encode($insert_myresqr_user);
        		    
        		    $content_hash = base64_encode(hash("sha256", $insert_myresqr_json_user, true));
        		    $php_utcNow =date("D, d M Y h:i:s ").date_default_timezone_get();
                    $string_to_sign = "POST" . "\n" . "/tps/v1/get-ambulance-details/" . "\n" .$php_utcNow . ";" . "api.myresqr.life" . ";" . $content_hash;
                    $sig = base64_encode(hash_hmac('sha256', $string_to_sign, "zD077AOGlzJEmKyJC0c0lYofgQaGIaTI", true));
                    $HMAccredentials = "20394hjendicaw08g212w";
                    $newsign = "HMAC-SHA256 Credential=" . $HMAccredentials."&Signature=" . $sig;
                
                    $header_arr= array(
                        'x-myresqr-date: '.$php_utcNow,
                        'Authorization: '.$newsign,
                        'Content-Type: application/json',
                        'Host: api.myresqr.life',
                    );
                
                    // START - curl
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL , 'https://api.myresqr.life/tps/v1/get-ambulance-details/');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_ENCODING, '');
                    curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                    curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                    curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                    curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_json_user);
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
        	       // print_r($json_result);
        	        $ambulance_status_detail_data = $this->saveAmbulanceStatusDetail($response, $request_id);
                    //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    // if (curl_errno($curl)) {
                    //  echo 'Error:' . curl_error($curl);
                    // }
                    // $info = curl_getinfo($curl);
                    //echo "\n";
                   // print_r(json_encode($insert_myresqr_user));
        		   
                    //{"uniqueId":"tst209","success":true}
        	        print json_encode($ambulance_status_detail_data);
        	 
        	    }else{
        			  $result = array('status'  => 'Fail','message' => "No record found." ,  );
        	   		  print json_encode( $result );
        		}
	        }
            }
        }
	}
	
	public function saveAmbulanceStatusDetail ($response, $request_id) {
	    $json_result = json_decode($response, true);
	    $vehicle_no = null;
	    $vehicle_driver_phone = null;
	    $last_status = null;
	    $success = null;
	    $last_status_time = null;
        if (isset($json_result['vehicleNo'])) {
            $vehicle_no = $json_result['vehicleNo'];
        }
        if (isset($json_result['vehicleDriverPhone'])) {
            $vehicle_driver_phone = $json_result['vehicleDriverPhone'];
        }
        if (isset($json_result['lastStatus'])) {
            $last_status = $json_result['lastStatus'];
        }
        if (isset($json_result['success'])) {
            $success = $json_result['success'] == 1 ? '1' : '2';
        }
        if (isset($json_result['lastStatusTime'])) {
            $origina_last_status_time = $json_result['lastStatusTime'];
            $last_status_time = date("Y-m-d H:i:s", strtotime($origina_last_status_time));
        }
	    $insert_data = array(
            'request_id' => $request_id,
            'vehicle_no' => $vehicle_no,
            'vehicle_driver_phone' => $vehicle_driver_phone,
            'last_status' => $last_status,
            'last_status_time' => $last_status_time,
            'success' => $success,
            'request_result' => $response,
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('ambulance_status_detail', $insert_data);
        if ($success == '1') {
            return $insert_data;
        } else {
            $this->db->from('ambulance_status_detail');
            $this->db->where('ambulance_status_detail.success', '1');
            $this->db->order_by('ambulance_status_detail.id', 'desc');
            $q = $this->db->get();
            $res_row_array = $q->row_array();
            if ($res_row_array) {
                return $res_row_array;
            } else {
                $empty_data = array(
                    'request_id' => $request_id,
                    'vehicle_no' => '',
                    'vehicle_driver_phone' => '',
                    'last_status' => '',
                    'last_status_time' => '',
                    'success' => '2',
                    'request_result' => '',
                    'created_at' => ''
                );
                return $empty_data;
            }
        }
	}
	
    public function getUserFollowmeEvidence($panic_request_id = '') {
 	    error_reporting(E_ALL); ini_set('display_errors', '1');

		switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserFollowmeEvidence($panic_request_id);
			$columns[] = array('label'=>'#');
			$columns[] = array('label'=>'Name');
		//	$columns[] = array('label'=>'SAP Code');
			$columns[] = array('label'=>'Email');
			$columns[] = array('label'=>'Mobile No.');
		 
			$columns[] = array('label'=>'Latitude');
			$columns[] = array('label'=>'Longitude');
			$columns[] = array('label'=>'Date/Time');
			$columns[] = array('label'=>'Panic Evidences');
			$i = 1;
			foreach ($result as $key => $value) {
			# code...
			$arr = explode(' ',$result[$key]['timestamp']);
			//$result[$key]['idd']=$i;
			//$result[$key]['date']=$arr['0'];
			//$result[$key]['time']=$arr['1'];
			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'].'    ';
			 unset($result[$key]['middle_name']);
			 unset($result[$key]['last_name']);
			 
		    //19-jul-2022
			$panic_type_value ="-";
		    $followme_safe_status_value ="";
			
			if( $value['followme_safe_status'] =='1' ) {
			    $followme_safe_status_value="-NO";
			} else if( $value['followme_safe_status'] =='2' ) {
		        $followme_safe_status_value = "-NA";
		    }
		    if( $value['content_type'] =='4' && $value['module_type'] =='4' ) {
		        $panic_type_value="Follow me".$followme_safe_status_value;
		    } else {
		        $panic_type_value = "Panic".$followme_safe_status_value;
		    }
            $result[$key]['panic_type_value'] = $panic_type_value;
			$i++;
			}
			// $res=array('columns'=>$columns,'rows'=>$result);
			echo json_encode($result);
			break;
		}
	}
	
	//30-jul-2022
	public function add_user( ) {
	      error_reporting(E_ALL); ini_set('display_errors', '1');
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->add_user($datas);
		echo json_encode($result);
	}
	
	public function check_add_user_mobile_number ($id = "") {
        $datas = json_decode(file_get_contents("php://input"));
        $result = $this->login->check_add_user_mobile_number($datas, $id);
        echo json_encode($result);
        
	}
	
	public function getAdminLicence($id){
		error_reporting(E_ALL); ini_set('display_errors', '1');
			switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getAdminLicence($id);
			
			if(!empty($result)) {
				foreach($result as $k=> $row) {
					if($row['user_id'] !=null) {
						$result[$k]['user_name'] =  $row['first_name'] ." ". $row['last_name']  ."(".$row['mobile_no']  .")";
					} else {
						$result[$k]['user_name'] = "";
					}
				}
			}
			echo json_encode($result );
			break;
		}
	}
    public function addAdminLicence($id){
		error_reporting(E_ALL); ini_set('display_errors', '1');
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->addAdminLicence($datas, $id);
		echo json_encode($result);
	}
	
	public function getCallAmbulance($tid = '') {
		switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getCallAmbulance($tid);
			$i = 1;
			foreach ($result as $key => $value) {
     			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'].'    ';
    			$result[$key]['sr_no'] = $i;
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			          $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result[$key]['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
    			//2-feb-2023
    			if ($value['ambulance_service_id'] == 2) {
    			    $result[$key]['latitude'] = $value['dest_lat'];
    			    $result[$key]['longitude'] = $value['dest_long'];
    			    $result[$key]['request_id'] = $value['crn'];
    			}
                unset($result[$key]['middle_name']);
                unset($result[$key]['last_name']);
    			$i++;
			}
			echo json_encode($result);
			break;
		}
	}
	public function getCallRsa($tid = '') {
		error_reporting(E_ALL); ini_set('display_errors', '1');
		switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getCallRsa($tid);
			$i = 1;
			foreach ($result as $key => $value) {
     			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'].'    ';
    			$result[$key]['sr_no'] = $i;
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			          $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result[$key]['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
     			$result[$key]['cancel_status']= $value['cancel_status'] =="1" ? "Cancelled": 'N/A';
                unset($result[$key]['middle_name']);
                unset($result[$key]['last_name']);
    			$i++;
			}
			echo json_encode($result);
			break;
		}
	}
    public function getPaymentDetail($tid = '') {
		error_reporting(E_ALL); ini_set('display_errors', '1');
		switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getPaymentDetail($tid);
			$i = 1;
			foreach ($result as $key => $value) {
			    $is_deleted = "";
			    if ($value['is_deleted'] =="1") {
			        $is_deleted = " (User Deleted)";
			    }
     			$result[$key]['user_id_deleted_status']=$value['user_id'].$is_deleted;
     			$result[$key]['deleted_status'] = $is_deleted;
     			$result[$key]['first_name']=$value['first_name'].' '.$value['last_name'].'    ';
    			$result[$key]['sr_no'] = $i;
    			if($result[$key]['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
    			    if($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			          $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result[$key]['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result[$key]['tenant_name'] = "";
    			    }
    			} else {
    			    $result[$key]['tenant_name'] = "";
    			}
     			if($result[$key]['payment_for'] == "1") {
     			    $result[$key]['payment_for'] = "License";
     			} else if($result[$key]['payment_for'] == "2") {
     			    $result[$key]['payment_for'] = "Ambulance Top-up";
     			} else {
     			    $result[$key]['payment_for'] = "";
     			}
                unset($result[$key]['middle_name']);
                unset($result[$key]['last_name']);
    			$i++;
			}
			echo json_encode($result);
			break;
		}
	}
	
    // 16-aug-2022
	public function getPlanDetailById($id='') {
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->getPlanDetailById( $id);
		$used_res = $this->login->getTenantLicenceUsedByPlansId($id);
		$result['licence_used'] = $used_res;
		$total_res = $this->login->getTenantLicenceTotalByPlansId($id);
		$result['licence_total'] = $total_res;
		echo json_encode($result);
	}

	public function updatePlan ($id){
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->updatePlan($datas,$id);
		echo json_encode($result);
	}
	public function deletePlan ($id){
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->deletePlan($datas,$id);
		echo json_encode($result);
	}
	public function addPlan (){
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->addPlan($datas);
		echo json_encode($result);
	}
	
	// 18-aug-2022
    public function getTodayTracking_bk_29_aug($tid=''){
	    error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getTodayTracking($tid);
		    $lat_long_arr = array();
			$i = 1;
			$open_request =0;
			$close_request =0;
		    $center_arr = array();
    		if($result) {
    			foreach ($result as $key => $value) {
    			    if($result[$key]['status'] == 0) {
    			        $close_request++;
    			    }
    			     if($result[$key]['status'] == 1) {
    			        $open_request++;
    			    }
    			    if(isset($result[$key]['firebase_key']) && $result[$key]['firebase_key'] !=null){
    			        $firebase_key = $result[$key]['firebase_key'];
    			         
                        $handle = curl_init();
                        // $firebase_key = "Tracking_id_438";
                         $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
                         //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                        // Set the url
                        curl_setopt($handle, CURLOPT_URL, $url);
                        // Set the result output to be a string.
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                        $output = curl_exec($handle);
                        curl_close($handle);
                        if($output) {
                         
                            $data = json_decode($output, true);
                          //  $last = end($data);
                              $last = $data[0];
                            if($last) {
                                $ulat =   number_format((float)$last['lat'], 6, '.', '');
                                $ulng =   number_format((float)$last['lng'], 6, '.', '');
                                $date_value = "";
                                date_default_timezone_set('Asia/Kolkata');
                                   
                          	    if(is_float($last['time'])) {
                                    $date_value = date('Y-m-d H:i:s',  $last['time']);
                          	    } else {
                                    $date_value = date('Y-m-d H:i:s',  $last['time']/1000);
                          	    }
                                $icon_value ="";
                                // if($result[$key]['end_time'] != null  ){
                                if( $result[$key]['end_time'] !="0000-00-00 00:00:00"){
                                   $icon_value= "/img/red_icon.png";
                                } else {
                                   $icon_value= "/img/green_icon.png";
                                }
                                $last_arr = array("lat" => $ulat,
                                "lng"=>$ulng,
                                "power"=> $last['power'] ,
                                "time"=>$last['time'],
                                "date_value"=>$date_value,
                                "icon_value" => $icon_value
                                );
                    
                            }
                        }
    	            }
    		        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));//$value['first_name'].' '.$value['last_name'].'    ';
    			    $result[$key]['trackee_id']=$info->row()->first_name.' '.$info->row()->last_name;
    			    $last_arr['name'] = $info->row()->first_name.' '.$info->row()->last_name;
    			    
    			    $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));//$value['first_name'].' '.$value['last_name'].'    ';
    			    $result[$key]['tracker_id']=$info->row()->first_name.' '.$info->row()->last_name;
    			    
    			    if($result[$key]['status'] == '1')
    		        $result[$key]['status'] ='Open';
    		        if($result[$key]['status'] == '0')
    		        $result[$key]['status'] ='Close';
    			 
        			if($result[$key]['tenant_id'] !=null) {
        			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
        			    if($res_arr) {
        			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
        			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
        			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
        			        $result[$key]['tenant_name'] = $tenant_user_name ;
        			    } else {
        			        $result[$key]['tenant_name'] = "";
        			    }
        			} else {
        			    $result[$key]['tenant_name'] = "";
        			}

    			    unset($result[$key]['firebase_key']);
    			    unset($result[$key]['tracking_type']);
			        $lat_long_arr[]=$last_arr;
    			}
                $result = $lat_long_arr;
                $center_arr = array();
                if(!empty($result)) {
                    $center_arr=$result[0];
                }
                $return_arr = array("data_array" =>$result , "close_request" => $close_request, "open_request"=>$open_request, "center_arr" =>$center_arr);
    			echo json_encode($return_arr);
    			break;

		    } else {
		        $return_arr = array("data_array" =>$result , "close_request" => $close_request, "open_request"=>$open_request, "center_arr" =>$center_arr);
    			echo json_encode($return_arr);
    			break;
		    }
		}
	}
	
	public function getTodayTracking ($tid=''){
	   	error_reporting(E_ALL); ini_set('display_errors', '1');
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getTodayTracking($tid);
		    $lat_long_arr = array();
			$i = 1;
			$open_request =0;
			$close_request =0;
		    $center_arr = array();
		    //echo "<pre>";
		   // print_r($result);
		    
    		if($result) {
    			foreach ($result as $key => $value) {
    			    if($result[$key]['status'] == 0) {
    			        $close_request++;
    			    }
    			    if($result[$key]['status'] == 1) {
    			        $open_request++;
    			    }
    			    if($result[$key]['status'] == 1) {
        			    if(isset($result[$key]['firebase_key']) && $result[$key]['firebase_key'] !=null){
        			        $firebase_key = $result[$key]['firebase_key'];
        			         
                            $handle = curl_init();
                             $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
                             //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                            // Set the url
                            curl_setopt($handle, CURLOPT_URL, $url);
                            // Set the result output to be a string.
                            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                            $output = curl_exec($handle);
                            curl_close($handle);
                            if($output) {
                             
                                $data = json_decode($output, true);
                              //  $last = end($data);
                                  $last = $data[0];
                                if($last) {
                                    $ulat =   number_format((float)$last['lat'], 6, '.', '');
                                    $ulng =   number_format((float)$last['lng'], 6, '.', '');
                                    $date_value = "";
                                    date_default_timezone_set('Asia/Kolkata');
                                       
                              	    if(is_float($last['time'])) {
                                        $date_value = date('Y-m-d H:i:s',  $last['time']);
                              	    } else {
                                        $date_value = date('Y-m-d H:i:s',  $last['time']/1000);
                              	    }
                                    $icon_value ="";
                                    // if($result[$key]['end_time'] != null  ){
                                    if( $result[$key]['end_time'] !="0000-00-00 00:00:00"){
                                       $icon_value= "/img/red_icon.png";
                                    } else {
                                       $icon_value= "/img/green_icon.png";
                                    }
                                    $last_arr = array(
                                        "firebase_key" => $result[$key]['firebase_key'],
                                        "lat" => $ulat,
                                        "lng" => $ulng,
                                        "power" => $last['power'] ,
                                        "time" => $last['time'],
                                        "date_value" => $date_value,
                                        "icon_value" => $icon_value
                                    );
                                }
                            }
        	            }
        		        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));//$value['first_name'].' '.$value['last_name'].'    ';
        			    $result[$key]['trackee_id']=$info->row()->first_name.' '.$info->row()->last_name;
        			    $last_arr['name'] = $info->row()->first_name.' '.$info->row()->last_name;
        			    
        			    $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));//$value['first_name'].' '.$value['last_name'].'    ';
        			    $result[$key]['tracker_id']=$info->row()->first_name.' '.$info->row()->last_name;
        			    
        			    if($result[$key]['status'] == '1')
        		        $result[$key]['status'] ='Open';
        		        if($result[$key]['status'] == '0')
        		        $result[$key]['status'] ='Close';
        			 
            			if($result[$key]['tenant_id'] !=null) {
            			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
            			    if($res_arr) {
            			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
            			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
            			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
            			        $result[$key]['tenant_name'] = $tenant_user_name ;
            			    } else {
            			        $result[$key]['tenant_name'] = "";
            			    }
            			} else {
            			    $result[$key]['tenant_name'] = "";
            			}
    
        			    unset($result[$key]['firebase_key']);
        			    unset($result[$key]['tracking_type']);
    			        $lat_long_arr[]=$last_arr;
    			    } else {
    			        if($result[$key]['tenant_id'] !=null) {
        			    
            			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
            			    if($res_arr) {
            			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
            			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
            			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
            			        $result[$key]['tenant_name'] = $tenant_user_name ;
            			    } else {
            			        $result[$key]['tenant_name'] = "";
            			    }
            			} else {
            			    $result[$key]['tenant_name'] = "";
            			}
            			$end_location_arr = array() ;
            			$end_location_lat = "" ;
            			$end_location_lng = "" ;
            			$end_location_power= "" ;
            			$end_location_time= "" ;
            			$end_location_date_value = "" ;
            			if($value['end_location'] !=null) {
            			    $end_location_arr = json_decode($value['end_location'] , true) ;
    			      
            			    if(!empty($end_location_arr) ) {
            			        $end_location_lat =$end_location_arr['lat'] ;
            			        $end_location_lng =$end_location_arr['lng'] ;
            			        $end_location_power =$end_location_arr['power'] ;
            			        $end_location_date_value =$end_location_arr['date_value'] ;
            			        $end_location_time =$end_location_arr['time'] ;
            			    }
            			}
            			
            			  $last_arr = array(
                                         "firebase_key" => $result[$key]['firebase_key'],
                                        "lat" => $end_location_lat,
                                        "lng" => $end_location_lng,
                                        "power" =>$end_location_power,
                                        "time" => $end_location_time,
                                        "date_value" => $end_location_date_value,
                                        "icon_value" =>  "/img/red_icon.png"
                                    );
                                    
                        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));//$value['first_name'].' '.$value['last_name'].'    ';
                			    $result[$key]['trackee_id']=$info->row()->first_name.' '.$info->row()->last_name;
                			    $last_arr['name'] = $info->row()->first_name.' '.$info->row()->last_name;
            			$lat_long_arr[]=$last_arr;
    			    }
    			}
                $result = $lat_long_arr;
                $center_arr = array();
                if(!empty($result)) {
                    $center_arr=$result[0];
                }
                $return_arr = array("data_array" =>$result , "close_request" => $close_request, "open_request"=>$open_request, "center_arr" =>$center_arr);
    			echo json_encode($return_arr);
    			break;

		    } else {
		        $return_arr = array("data_array" =>$result , "close_request" => $close_request, "open_request"=>$open_request, "center_arr" =>$center_arr);
    			echo json_encode($return_arr);
    			break;
		    }
		}
	}
	
	public function getTripTracking($tid=''){
	    error_reporting(0);
	    switch($_SERVER['REQUEST_METHOD']){
			
			case 'GET':
			    $id_arr=array();
			    $return_array =array();
    			$datas = json_decode(file_get_contents("php://input"));
    			$result = $this->login->getTripTracking($tid);
    			$i = 1;
    			foreach ($result as $key => $value) {
    			    if(!in_array($result[$key]['trackee_id'], $id_arr)) {
        			    $result[$key]['trackee_id_count'] = $this->login->getTripCountById($result[$key]['trackee_id'] );
        			    
        		        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));//$value['first_name'].' '.$value['last_name'].'    ';
        			    $result[$key]['trackee_id_name']=$info->row()->first_name.' '.$info->row()->last_name;
        			    
        			    $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));//$value['first_name'].' '.$value['last_name'].'    ';
        			    $result[$key]['tracker_id']=$info->row()->first_name.' '.$info->row()->last_name;
        			    
        			    if($result[$key]['status'] == '1')
        		        $result[$key]['status'] ='Open';
        		        if($result[$key]['status'] == '0')
        		        $result[$key]['status'] ='Close';
            			if($result[$key]['tenant_id'] !=null) {
            			    $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id'] );
            			    if($res_arr) {
            			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
            			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
            			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
            			        $result[$key]['tenant_name'] = $tenant_user_name ;
            			    } else {
            			        $result[$key]['tenant_name'] = "";
            			    }
            			} else {
            			    $result[$key]['tenant_name'] = "";
            			}
        			    unset($result[$key]['firebase_key']);
        			    unset($result[$key]['tracking_type']);
        			    
        			    $id_arr[] = $result[$key]['trackee_id'];
        			    $row_array = array(
                            "id" => $value['id'] ,
                            "trackee_id" => $value['trackee_id'] ,
                            "tracker_id" => $result[$key]['tracker_id'] ,
                            "start_time" => $value['start_time'] ,
                            "end_time" => $value['end_time'] ,
                            "share_time" => $value['share_time'] ,
                            "mode" => $value['mode'] ,
                            "mode_backend" => $value['mode_backend'] ,
                            "status" => $result[$key]['status'] ,
                            "tenant_id" => $value['tenant_id'] ,
                            "trackee_id_count" => $result[$key]['trackee_id_count'],
                            "trackee_id_name" =>  $result[$key]['trackee_id_name'],
                            "tenant_name" =>  $result[$key]['tenant_name'] ,
                        );
                        $return_array[]  =$row_array ;
			        }
			    }
			echo json_encode($return_array);
			break;
		}
	}
	
	public function getUserTripDetail_bk_29_aug($user_id=''){
	    error_reporting(0); //		error_reporting(E_ALL); ini_set('display_errors', '1');

	    if($user_id != "") {
    	    switch($_SERVER['REQUEST_METHOD']){
    			case 'GET':
        			$datas = json_decode(file_get_contents("php://input"));
        			$result = $this->login->getUserTripDetail($user_id);
        			$i = 1;
        			$trackee_id_name = "";
        			$ulat = "";
        			$ulng = "";
        			$utime = "";
         			$first_record_firebase_center =array();
         			 $id_arr=array();
         			 $return_array=array();
         			 $first_record_tracking_id = "";
         			 $tracker_id_name = "";
         			 $current_firebase_id ="";
    			    foreach ($result as $key => $value) {

                        if($current_firebase_id == $result[$key]['firebase_key']) {
                            $current_firebase_id = $result[$key]['firebase_key'];
                            if($result[$key]['tracker_id']) {
                	            $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));
                			   $tracker_id_name.=$info->row()->first_name.' '.$info->row()->last_name;
                            }
                        } else {
                            $current_firebase_id = $result[$key]['firebase_key'];
                        }
                        $result[$key]['tracker_id_names'] = $tracker_id_name;
    
            			if (isset($result[$key]['firebase_key']) && $result[$key]['firebase_key'] !=null){
            			    if(!in_array($result[$key]['firebase_key'], $id_arr)) {
                			    $firebase_key = $result[$key]['firebase_key'];
                                $handle = curl_init();
                                $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
                                //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                                // Set the url
                                curl_setopt($handle, CURLOPT_URL, $url);
                                // Set the result output to be a string.
                                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                                $output = curl_exec($handle);
                                curl_close($handle);
                                if($output) {

                                    $data = json_decode($output, true);

                                    // $last = end($data);
                                    $last = $data[0];
                                    if($last) {
                                        $ulat =   number_format((float)$last['lat'], 6, '.', '');
                                        $ulng =   number_format((float)$last['lng'], 6, '.', '');
                                        $date_value = "";
                                        date_default_timezone_set('Asia/Kolkata');
                                        if($last['time']) {
                                            $date_value = $utime = date('Y-m-d H:i:s',  $last['time']/1000);
                                        }
                                        $icon_value ="";
                                        // if($result[$key]['end_time'] != null  ){
                                        if( $result[$key]['end_time'] !="0000-00-00 00:00:00"){
                                           $icon_value= "/img/red_icon.png";
                                        } else {
                                           $icon_value= "/img/green_icon.png";
                                        }
                                        $last_arr = array("lat" => $ulat,
                                            "lng"=>$ulng,
                                            "power"=> $last['power'] ,
                                            "time"=>$last['time'],
                                            "date_value"=>$date_value,
                                            "icon_value" => $icon_value
                                        );
                                    }

                                    if( $key  ==0) {
                                        $firebase_arr = $data ;
                                        if (!empty($firebase_arr)) {
                                            $arr_status = 0;
                                            if($result[$key]['status']) {
                                                $arr_status =$result[$key]['status'];
                                            }
                                            $iteration_ct = 0;
                                            $last_val = 0;
                                            $tracking_status_stop_date =  "" ;
                                            $map_array = [];
                                            $key_add = $arr_add= [];
                                            $num_items = count($firebase_arr);
        
                                            foreach ($firebase_arr as $key_val => $row) {
                                                if($key_val == 0) {
                                                    $first_record_firebase_center = $firebase_arr[0];
                                                }
                                                if (!in_array( $key_val, $key_add)) {
                                             
                                                    $key_key = $key_val;
                                                    $last_val=$key_val;
                                                    if ($iteration_ct ==  $key_val || ++$last_val == $num_items ) {

                                                        $lat = number_format((float) $row['lat'], 6, '.', '');
                                                        $lng = number_format((float) $row['lng'], 6, '.', '');
                                                        $date_value = "";
                                                        if(is_float($row['time'])) {
                                                            $date_value = date('Y-m-d H:i:s',  $row['time']);
                                                  	    } else {
                                                            $date_value = $utime = date('Y-m-d H:i:s', $row['time'] / 1000);
                                                        }
                                                        if($key_val==0) {
                                                           $aaa = array(
                                                                "index" =>$key_val+1,
                                                                "lat"=>$lat,
                                                                "lng" =>$lng,
                                                                "date_value"=> $date_value,
                                                                "icon"=>"/img/map_start.png",
                                                                "time" =>   $row['time'],
                                                                "power" => $row['power'],
                                                                'firebase_key'=>$result[$key]['firebase_key']
                                                            );
                                                        } else if(++$key_key == $num_items &&   $arr_status ==0  ) {
                                                            if($arr_status ==0 ) {
                                                                $aaa = array(
                                                                    "index" =>$key_val+1,
                                                                    "lat"=>$ulat,
                                                                    "lng" =>$ulng,
                                                                    "date_value"=> $date_value,
                                                                    "icon"=>"/img/map_end.png",
                                                                    "time" =>   $row['time'],
                                                                    "power" => $row['power']
                                                                );
                                                            }
                                                        } else {
                                                           $aaa = array(
                                                                "index" =>$key_val+1,
                                                                "lat"=>$ulat,
                                                                "lng" =>$ulng,
                                                                "date_value"=> $date_value,
                                                                "icon"=>" ", //"/img/red_icon.png",
                                                                "time" =>   $row['time'],
                                                                "power" => $row['power']
                                                            );
                                                        }  
                                                        $map_array[]  =$aaa ;
                                                        $key_add[] = $key_val;
                                                    }
                                                    if($key_val == $iteration_ct){
                                                        $iteration_ct = $iteration_ct +20;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
    	            
                			    $result[$key]['trackee_lat'] = $ulat;
                			    $result[$key]['trackee_lng'] = $ulng;
                			    $result[$key]['trackee_time'] = $utime;
                 			    $result[$key]['trackee_id_count'] = $this->login->getTripCountById($result[$key]['trackee_id'] );
                			    
                		        $info=$this->db->get_where('users',array('id'=>$result[$key]['trackee_id']));
                			    $result[$key]['trackee_id_name'] = $trackee_id_name =$info->row()->first_name.' '.$info->row()->last_name;
                			    
                			    $info=$this->db->get_where('users',array('id'=>$result[$key]['tracker_id']));
                			    $result[$key]['tracker_id']=$info->row()->first_name.' '.$info->row()->last_name;
                			    
                			    if($result[$key]['status'] == '1')
                		        $result[$key]['status'] ='Open';
                		        if($result[$key]['status'] == '0')
                		        $result[$key]['status'] ='Close';
                			    $id_arr[] = $result[$key]['firebase_key'];
                			    $tracker_id_share_names ="";
                			    if($result[$key]['firebase_key'] !=null) {
                			        $tracker_id_share_names = $this->login->getTrackingIdShareName($result[$key]['firebase_key'] );
                			    }
    			                $row_array = array(
                                        "id" => $value['id'] ,
                                        "trackee_id" => $value['trackee_id'] ,
                                        // "tracker_id" => $result[$key]['tracker_id'] ,
                                        "tracker_id" => $tracker_id_share_names ,
                                        "start_time" => $value['start_time'] ,
                                        "end_time" => $value['end_time'] ,
                                        "share_time" => $value['share_time'] ,
                                        "mode" => $value['mode'] ,
                                        "mode_backend" => $value['mode_backend'] ,
                                        "status" => $result[$key]['status'] ,
                                        "trackee_lat" =>  $result[$key]['trackee_lat'] ,
                                        "trackee_lng" =>  $result[$key]['trackee_lng'] ,
                                        "trackee_time" =>  $result[$key]['trackee_time'] ,
                                        "trackee_id_count" => $result[$key]['trackee_id_count'],
                                  //      "trackee_id_name" =>  $result[$key]['trackee_id_name'],
                                        "trackee_id_name" => $tracker_id_share_names,
                                    );
                                    $return_array[]  =$row_array ;
                    			    unset($result[$key]['firebase_key']);
                    			    unset($result[$key]['tracking_type']);
    			 
    			            }
    			        }
    			    }
        			if(!empty($return_array)) {
        			   $return_array = array_reverse($return_array) ;
        			   $first_record_tracking_id = $return_array[0]['id'];
        			}
    		    $return_arr = array("data_array" =>$return_array,"first_record_tracking_id"=>$first_record_tracking_id , "trackee_id_name"=>$trackee_id_name ,  "first_record_firebase_center" => $first_record_firebase_center,
    		  //  "first_record_map_array" => $map_array 
    		    "first_record_map_array" => array()
    		    );
        	    echo json_encode($return_arr);
    			break;
		    }
		}
	}
	
	
		
	public function getUserTripDetail($user_id=''){
	    error_reporting(0);
	    error_reporting(E_ALL); ini_set('display_errors', '1');

	    if($user_id != "") {
    	    switch($_SERVER['REQUEST_METHOD']){
    			case 'GET':
        			$datas = json_decode(file_get_contents("php://input"));
        			$result = $this->login->getUserTripDetail($user_id);
        			$i = 1;
        			$trackee_id_name = "";
        			$ulat = "";
        			$ulng = "";
        			$utime = "";
         			$first_record_firebase_center =array();
         		    $id_arr=array();
         			$return_array=array();
         		    $first_record_tracking_id = "";
         		 
    			    foreach ($result as $key => $value) {
 
            			    if(!in_array($result[$key]['firebase_key'], $id_arr)) {
            			if (isset($result[$key]['firebase_key']) && $result[$key]['firebase_key'] !=null){
            			    
            			        if( $key  ==0) {
            			        
                			    $firebase_key = $result[$key]['firebase_key'];
                                $handle = curl_init();
                                
                                $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/location.json";
                                //$url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/".$firebase_key."/everyMinute.json";
                                // Set the url
                                curl_setopt($handle, CURLOPT_URL, $url);
                                // Set the result output to be a string.
                                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                                $output = curl_exec($handle);
                                curl_close($handle);
                                if($output) {

                                    $data = json_decode($output, true);

                                    // $last = end($data);
                                    $last = $data[0];
                                    if($last) {
                                        $ulat =   number_format((float)$last['lat'], 6, '.', '');
                                        $ulng =   number_format((float)$last['lng'], 6, '.', '');
                                        $date_value = "";
                                        date_default_timezone_set('Asia/Kolkata');
                                        if($last['time']) {
                                            $date_value = $utime = date('Y-m-d H:i:s',  $last['time']/1000);
                                        }
                                        $icon_value ="";
                                        // if($result[$key]['end_time'] != null  ){
                                        if( $result[$key]['end_time'] !="0000-00-00 00:00:00"){
                                           $icon_value= "/img/red_icon.png";
                                        } else {
                                           $icon_value= "/img/green_icon.png";
                                        }
                                        $last_arr = array("lat" => $ulat,
                                            "lng"=>$ulng,
                                            "power"=> $last['power'] ,
                                            "time"=>$last['time'],
                                            "date_value"=>$date_value,
                                            "icon_value" => $icon_value
                                        );
                                    }

                                 
                                        $firebase_arr = $data ;
                                        if (!empty($firebase_arr)) {
                                            $arr_status = 0;
                                            if($result[$key]['status']) {
                                                $arr_status =$result[$key]['status'];
                                            }
                                            $iteration_ct = 0;
                                            $last_val = 0;
                                            $tracking_status_stop_date =  "" ;
                                            $map_array = [];
                                            $key_add = $arr_add= [];
                                            $num_items = count($firebase_arr);
        
                                            foreach ($firebase_arr as $key_val => $row) {
                                                if($key_val == 0) {
                                                    $first_record_firebase_center = $firebase_arr[0];
                                                }
                                                if (!in_array( $key_val, $key_add)) {
                                             
                                                    $key_key = $key_val;
                                                    $last_val=$key_val;
                                                    if ($iteration_ct ==  $key_val || ++$last_val == $num_items ) {

                                                        $lat = number_format((float) $row['lat'], 6, '.', '');
                                                        $lng = number_format((float) $row['lng'], 6, '.', '');
                                                        $date_value = "";
                                                        if(is_float($row['time'])) {
                                                            $date_value = date('Y-m-d H:i:s',  $row['time']);
                                                  	    } else {
                                                            $date_value = $utime = date('Y-m-d H:i:s', $row['time'] / 1000);
                                                        }
                                                        if($key_val==0) {
                                                           $aaa = array(
                                                                "index" =>$key_val+1,
                                                                "lat"=>$lat,
                                                                "lng" =>$lng,
                                                                "date_value"=> $date_value,
                                                                "icon"=>"/img/map_start.png",
                                                                "time" =>   $row['time'],
                                                                "power" => $row['power'],
                                                                'firebase_key'=>$result[$key]['firebase_key']
                                                            );
                                                        } else if(++$key_key == $num_items &&   $arr_status ==0  ) {
                                                            if($arr_status ==0 ) {
                                                                $aaa = array(
                                                                    "index" =>$key_val+1,
                                                                    "lat"=>$ulat,
                                                                    "lng" =>$ulng,
                                                                    "date_value"=> $date_value,
                                                                    "icon"=>"/img/map_end.png",
                                                                    "time" =>   $row['time'],
                                                                    "power" => $row['power']
                                                                );
                                                            }
                                                        } else {
                                                           $aaa = array(
                                                                "index" =>$key_val+1,
                                                                "lat"=>$ulat,
                                                                "lng" =>$ulng,
                                                                "date_value"=> $date_value,
                                                                "icon"=>" ", //"/img/red_icon.png",
                                                                "time" =>   $row['time'],
                                                                "power" => $row['power']
                                                            );
                                                        }  
                                                        $map_array[]  =$aaa ;
                                                        $key_add[] = $key_val;
                                                    }
                                                    if($key_val == $iteration_ct){
                                                        $iteration_ct = $iteration_ct +20;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
    			 
    			            }
    			            
    			             $result[$key]['trackee_lat'] = $ulat;
                			    $result[$key]['trackee_lng'] = $ulng;
                			    $result[$key]['trackee_time'] = $utime;
                 			    $result[$key]['trackee_id_count'] = $this->login->getTripCountById($result[$key]['trackee_id'] );
                			    
                		      
                			   
                			    $this->db->select('users.first_name, users.last_name');
                			    $this->db->where('users.id', $result[$key]['trackee_id'] );
                                $this->db->from('users');
                                $q = $this->db->get();
                                $res_user_trackee_id = $q->row();
                             
                                if($res_user_trackee_id) {
                                     $result[$key]['trackee_id_name'] = $trackee_id_name = $res_user_trackee_id->first_name. " " . $res_user_trackee_id->last_name;
                                }
                                
                			    $this->db->select('users.first_name, users.last_name');
                			    $this->db->where('users.id', $result[$key]['tracker_id'] );
                                $this->db->from('users');
                                $q = $this->db->get();
                                $res_user_tracker_id = $q->row();
                                if($res_user_tracker_id) {
                                    $result[$key]['tracker_id'] = $res_user_tracker_id->first_name. " " . $res_user_tracker_id->last_name;
                                }
                			    
                			    if($result[$key]['status'] == '1')
                		        $result[$key]['status'] ='Open';
                		        if($result[$key]['status'] == '0')
                		        $result[$key]['status'] ='Close';
                			    $id_arr[] = $result[$key]['firebase_key'];
                			    $tracker_id_share_names ="";
                			    if($result[$key]['firebase_key'] !=null) {
                			        $tracker_id_share_names = $this->login->getTrackingIdShareName($result[$key]['firebase_key'] );
                			    }
    			             $row_array = array(
                                        "id" => $value['id'] ,
                                        "trackee_id" => $value['trackee_id'] ,
                                        // "tracker_id" => $result[$key]['tracker_id'] ,
                                        "tracker_id" => $tracker_id_share_names ,
                                        "start_time" => $value['start_time'] ,
                                        "end_time" => $value['end_time'] ,
                                    //    "share_time" => $value['share_time'] ,
                                        // "mode" => $value['mode'] ,
                                        // "mode_backend" => $value['mode_backend'] ,
                                     //   "status" => $result[$key]['status'] ,
                                        // "trackee_lat" =>  $result[$key]['trackee_lat'] ,
                                        // "trackee_lng" =>  $result[$key]['trackee_lng'] ,
                                        // "trackee_time" =>  $result[$key]['trackee_time'] ,
                                        "trackee_id_count" => $result[$key]['trackee_id_count'],
                                  //      "trackee_id_name" =>  $result[$key]['trackee_id_name'],
                                        "trackee_id_name" => $tracker_id_share_names,
                                    );
                                    $return_array[]  =$row_array ;
                    			    unset($result[$key]['firebase_key']);
                    			    unset($result[$key]['tracking_type']);
    			        }
    			    }
        			if(!empty($return_array)) {
        			   $return_array = array_reverse($return_array) ;
        			   $first_record_tracking_id = $return_array[0]['id'];
        			}
    		    $return_arr = array(
    		        "data_array" => $return_array,
    		    "first_record_tracking_id"=>$first_record_tracking_id ,
    		    "trackee_id_name"=>$trackee_id_name ,  "first_record_firebase_center" => $first_record_firebase_center,
    		  //  "first_record_map_array" => $map_array 
    		    "first_record_map_array" => array(),
    		  //  "id_arr" =>$id_arr
    		    );
        	    echo json_encode($return_arr);
    			break;
		    }
		}
	}
	
	public function getUserFirebaseArray($id = '') {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
     
	    switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $map_array =array();
                $map_center_lat = "";
                $map_center_lng = "";
                $map_center_time = "";
                $status = 0;
                $res_arr = $this->login->getTrackingById($id );
                if($res_arr) {
                    $status = $res_arr['status'];
                }
                $result = array();
                $i = 1;
                $ulat = "";
                $ulng = "";
                $utime = "";
                $trackee_time ="";
                $firebase_arr = array();
                $triangle_coords = array();
                $res_location_log = "";
                
                $firebase_key = "Tracking_id_" . $id;
                if( $status == 0 ) {
                    $res_location_log= $this->login->getLocationLog($firebase_key );
               
                }
                 
                 
                if( $res_location_log == "") {
                    
                $handle = curl_init();
                $firebase_key = "Tracking_id_" . $id;
                $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
                curl_setopt($handle, CURLOPT_URL, $url);
                // Set the result output to be a string.
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($handle);
                curl_close($handle);
                } else {
                    $output = $res_location_log;
                }

                if ($output) {
                    $data = $firebase_arr = json_decode($output, true);
                    if(!empty($data)) {
                        $last = $data[0];
                        if ($last) {
                            $ulat = $map_center_lat = number_format((float) $last['lat'], 6, '.', '');
                            $ulng = $map_center_lng = number_format((float) $last['lng'], 6, '.', '');
                            $trackee_time = "";
                            
                            if ($last['time']) {
                                if(is_float($last['time'])) {
                                    $trackee_time = date('Y-m-d H:i:s',  $last['time']);
                          	    } else {
                                    $trackee_time = date('Y-m-d H:i:s', $last['time'] / 1000);
                                }
                            }
                        }
                        $map_center_time = $trackee_time;
    
                        $iteration_ct = 0;
                        $last_val = 0;
                        $tracking_status_stop_date =  "" ;
                        $map_array = [];
                        $key_add = $arr_add= [];
                        if (!empty($firebase_arr)) {
                            $num_items = count($firebase_arr);
    
                            foreach ($firebase_arr as $k => $row) {
    
                                if (!in_array( $k, $key_add)) {
                                    $key = $k;
                                    $last_val=$k;
                                    if ($iteration_ct ==  $k || ++$last_val == $num_items ) {
    
                                        $ulat = number_format((float) $row['lat'], 6, '.', '');
                                        $ulng = number_format((float) $row['lng'], 6, '.', '');
                                        $date_value = "";
                                         date_default_timezone_set('Asia/Kolkata'); 
                                        if(is_float($row['time'])) {
                                            $date_value = date('Y-m-d H:i:s',  $row['time']);
                                  	    } else {
                                            $date_value = $utime = date('Y-m-d H:i:s', $row['time'] / 1000);
                                        }
                                        $firebase_arr[$k]['lat'] = $ulat;
                                        $firebase_arr[$k]['lng'] = $ulng;
                                        $firebase_arr[$k]['date_value'] = $date_value;
                                        $triangle_coords[] = array('lat'=> (float) $ulat, 'lng' => (float) $ulng);
                                     
                                    
                                        if($k==0) {
                                            $icon_end = "/img/map_end.png";
                                            if ($status == 1)  {
                                                $icon_end = " ";
                                            }
                                                $aaa = array(
                                                    "index" =>$k+1,
                                                    "lat"=>$ulat,
                                                    "lng" =>$ulng,
                                                    "date_value"=> $date_value,
                                                //    "icon"=>"/img/map_end.png",
                                                    "icon"=>$icon_end,
                                                    "time" =>   $row['time'],
                                                    "power" => $row['power']
                                                );
                                          
                                        // } else if(++$key == $num_items &&   $status == 0  ) {
                                        } else if(++$key == $num_items       ) {
                                            // if($status ==0 ) {
                                                $aaa = array(
                                                    "index" =>$k+1,
                                                    "lat"=>$ulat,
                                                    "lng" =>$ulng,
                                                    "date_value"=> $date_value,
                                                    "icon"=>"/img/map_start.png",
                                                    "time" =>   $row['time'],
                                                    "power" => $row['power']
                                                );
                                            // }
                                        } else {
                                           $aaa = array(
                                                "index" =>$k+1,
                                                "lat"=>$ulat,
                                                "lng" =>$ulng,
                                                "date_value"=> $date_value,
                                                "icon"=>" ",//"/img/red_icon.png"
                                                "time" =>   $row['time'],
                                                "power" => $row['power']
                                            );
                                        }  
                                        $map_array[]  =$aaa ;
                                        $key_add[] = $k;
                                    }
                                    if($k == $iteration_ct){
                                        $iteration_ct = $iteration_ct +10;
                                    }
                                }
                            }
                        }
                    }
                }
                $result['trackee_lat'] = $ulat;
                $result['trackee_lng'] = $ulng;
                $result['trackee_time'] = $trackee_time;
                $result['firebase_arr'] = $firebase_arr;
                $return_arr = array( 
                    //"firebase_arr" => $result['firebase_arr'] ,
                    "map_array" => $map_array,
                    "map_center_lat" => $map_center_lat,
                    "map_center_lng" => $map_center_lng,
                    "map_center_time" => $map_center_time,
                    "triangle_coords" => $triangle_coords
                    );
            echo json_encode($return_arr);
            break;
	    }
	}
	
		// 22-aug-2022
    public function deleteRegularNotifications() {
		switch($_SERVER['REQUEST_METHOD']){
			case 'POST':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->deleteRegularNotifications($datas);
			echo json_encode($result);
			break;
		}
	}
	
	public function updateColLienceRef() {
	      error_reporting(E_ALL);
        ini_set('display_errors', '1');
	    $this->db->select('tenant_licence_reference.*');
		$res  = $this->db->get('tenant_licence_reference')->result_array();
		if($res) {
		    foreach($res as $row) {
		        $tenant_licence_key = $row['tenant_licence_key'];
		        if($row['tenant_licence_key']) {
		           $tenant_licence_key= trim($row['tenant_licence_key']);
		        }
		          $licence_reference = $row['licence_reference'];
		        if($row['licence_reference']) {
		            $licence_reference = trim($row['licence_reference']);
		        }
		        $update_data= array(			
        			'tenant_licence_key'=>$tenant_licence_key,
        			'licence_reference'=>$licence_reference
        		);
        		echo "<pre>";
        		echo $row['id'] ;
        		print_r($update_data);
        // 		$this->db->where('id',$row['id']);
        // 		$this->db->update('tenant_licence_reference',$update_data);
		      //  echo $this->db->last_query();
		      
		    }
		}
	} 


    public function updateLocationLogTEST( $page = null) {
        
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        echo "<pre>";
         $per_page =10;
         if($page == null) {
         $page=$page*1;

         } else {
         $page=$page*10;

         }
         $this->db->distinct('tracking.firebase_key');
        $this->db->select('tracking.firebase_key');
		$this->db->from('tracking');
		//$this->db->where('tracking.mode_backend','1');
	 
	    $this->db->order_by('tracking.id','asc');
	   // $this->db->limit('10');
	    $this->db->limit($per_page,$page );

		$q = $this->db->get();
	    $res = $q->result_array();
	    echo $this->db->last_query();

        $data_json = "";
        date_default_timezone_set('Asia/Kolkata');
        
		if(!empty ($res)) {
		    foreach($res as $row) {
		       $firebase_key = $row['firebase_key'] ;
 	
		        $this->db->select("*");
        	    $this->db->where('location_log.firebase_key',$firebase_key);
        	    $query  = $this->db->get('location_log');
        	    
        	     $handle = curl_init();
                $url = "https://captain-india-1fd08-default-rtdb.asia-southeast1.firebasedatabase.app/raw-locations/" . $firebase_key . "/location.json";
                curl_setopt($handle, CURLOPT_URL, $url);
                // Set the result output to be a string.
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($handle);
                curl_close($handle);

                if ($output) {
                    $data = $firebase_arr = json_decode($output, true);
                   if(!empty($data)) {
                        $data_json=$output;
                   }
                }
                echo "<br><br>";

                if( ($data_json != "")) {
        	    	if($query->num_rows() > 0){
        	    	    $update_data_location_log = array (
                    		'location_json' =>$data_json,
                    		'updated_at' => date('Y-m-d H:i:s'),
                        );
            		 	$this->db->where('firebase_key', $firebase_key);
    		            $this->db->update('location_log',$update_data_location_log);
    		             echo $this->db->last_query();
        	    	} else {
        	    	    $insert_data_location_log = array (
                    		'firebase_key' =>$firebase_key,
                    		'location_json' =>$data_json,
                    		'created_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('location_log', $insert_data_location_log);
                        echo $this->db->last_query();
        	    	}
    	    	} else {
    	    	    $insert_data_location_log = array (
    	    	        'firebase_key' =>$firebase_key,
    	    	        'created_at' => date('Y-m-d H:i:s'),
    	    	        );
    	    	        $this->db->insert('location_log', $insert_data_location_log);
    	    	        echo $this->db->last_query();
    	    	}
		    }
		}
	die;
    }
    
    //14-sep-2022
 	public function updatePanicRequestRecord() {
	    error_reporting(E_ALL);
        ini_set('display_errors', '1');
        echo "<pre>";
        
        $this->db->distinct();
        $this->db->select('user_multimedia.panic_id ');
        //	$this->db->limit('2');
		$res  = $this->db->get('user_multimedia')->result_array();
		print_r($res);
		if($res) {
		    foreach($res as $row) {
		      
                $this->db->select('user_multimedia.panic_id , user_multimedia.created_at');
                $this->db->where('user_multimedia.panic_id', $row['panic_id']);
        		$res_row  = $this->db->get('user_multimedia')->row_array();
		
		        $this->db->select('panic_request.id ');
                $this->db->where('panic_request.id', $res_row['panic_id']);
        		$res_panic_request = $this->db->get('panic_request')->row_array();
        		
		        //print_r($res_row);
		        print_r($res_panic_request);
                if ($res_panic_request) {
                    $update_data= array(			
            			'timestamp'=>$res_row['created_at'],
            		);
    		  		print_r($update_data);
            // 	    $this->db->where('panic_request.id', $res_row['panic_id']);
        		  //  $this->db->update('panic_request',$update_data);
		            echo $this->db->last_query();
                }
		    }
		}
	}
	
    //14-sep-2022
 	public function createDatebaseBackup() {
		$this->load->helper('file');
	    error_reporting(E_ALL);
        ini_set('display_errors', '1');
        date_default_timezone_set('Asia/Kolkata');
       	$this->load->dbutil();
		$prefs = array('format' => 'zip', 'filename' => 'Database_backup_' . date('Y-m-d_H-i-s'));
		$backup = $this->dbutil->backup($prefs);
		if (!write_file(FCPATH .'./uploads/database_backup/DB_backup_' . date('Y-m-d_H-i-s') . '.zip', $backup)) {
			echo json_encode(array("status" => false, "message"=> "Error while creating auto database backup!"));
		} else {
		    echo json_encode(array("status" => true, "message"=> "Database backup has been successfully Created"));
		}
		die;
	}

    public function registerUserHealthysureDigitgrp() {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $this->db->from('users');
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		$this->db->where('created_at >=', date('Y-m-d 00:00:00'));
		$this->db->where('auth_key !=', "");
	    $q = $this->db->get();
	    $finresults = $q->result_array();
	   // echo $this->db->last_query();
	   // die;
	   // print json_encode( $finresults );
	   // die;
		if ($finresults) {

		    foreach ($finresults as $row) {
		        
		        //28-march-2023 // user_plan
		        $user_id = $row['id'];
		        $this->db->from('user_plan');
		        $this->db->where('user_plan.user_id', $user_id);
		         $this->db->join('plan_master','plan_master.id = user_plan.plan_id','left');
        	    $q = $this->db->get();
        	    $result_user_plan = $q->row_array();
        	   
        	    if ($result_user_plan) {
        	        if ($result_user_plan['price'] != '0') {

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
    		        echo "<br>";
    		        $user_id = $row['id'];
    		        $register_data = array(
                        'user_id' =>  $row['id'],
                        'member_id' => 'CI' . $row['id'],
                        'name' => $first_name . " " . $last_name,
                        'gender' => $gender,
                        'email' => $email,
                        'date_of_birth' => $date_of_birth,
                        'plan_type' => 'A'
    		        );
    		      //  print_R($register_data);
    		        $this->sendHealthysureUserRegister($register_data, $user_id);
    		      //  die;
		        }
	        }
        	    }
        	    }
            // $result = array('status'  => 'Success','result' => $finresults);
            // print json_encode( $result );
		}else{
			  $error_info = $this->api_model->getErrorCode('13');
			  $result = array('status' => 'Fail','message' => $error_info->message, 'code' => $error_info->code);
	   		  print json_encode($result);
		}
    }
    
    public function sendHealthysureUserRegister($data, $user_id) {
        // error_reporting(E_ALL); ini_set('display_errors', '1');
        if($data) {
			if(isset($data['member_id']) ) {
                $member_id = $data['member_id'];

                $header_arr= array(  'client-id: LUiJTTNpwVECS3EaRCWXDdq11U7e1tXilvgn6vBc' );
                // $post_fields = array('member_id' => '12','name' => 'manish12 ','gender' => 'Male','email' => 'manish12@gmail.com','date_of_birth' => '2010-10-19','plan_type' => 'C');
                $post_fields = $data;
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL , 'https://api.healthysure.co/product_integration/digit_grp/digit_grp' );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS , $post_fields);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
                $response = curl_exec($curl);
                echo "  ". $user_id ." => ";
                if($response) {
                    $json_result = json_decode($response, true);
                    if($json_result) {
                        if(isset($json_result['data']  )) {
                	        $user_update_data['member_id'] = $json_result['data']['member_id'];
                	        $user_update_data['sum_insured'] = $json_result['data']['sum_insured'];
                	        $user_update_data['plan_type'] = $json_result['data']['plan_type'];
                        	$this->db->where('id', $user_id);
                    		$this->db->update('users', $user_update_data);
                        }
                        $insert_log = array(
                            'user_id' => $user_id,
                            'request_result' => $response,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        if (isset($json_result['data'])) {
                            $insert_log['member_id'] = $json_result['data']['member_id'];
                        }
                        $this->db->insert('user_digit_grp_log', $insert_log);
                    }
                }
                if($response) {
                    print  ( $response );
                    //  die;
                } else {
                    
                }
			}
        }
    }

    // 21-nov-2022
    public function getDashboardMenu($tenant_id = '') {
        $result = $this->login->getDashboardMenu($tenant_id);
        echo json_encode($result);
    }

    public function getAllPlans() {
        switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getAllPlans();
			echo json_encode($result);
			break;
	    }
	}
	
	public function getOtp(){
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getOtp();
 			echo json_encode($result);
			break;
	    }
	}
	
	public function getUserOtp($id='', $user_id ='') {
	    switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getUserOtp($id, $user_id);
			$first_name = "";
			$last_name = "";
			$mobile_no = "";
			$user_id = "";
			if (!empty($result)) {
			    if (isset($result[0])) {
			        $first_name = $result[0]['first_name'];
			        $last_name = $result[0]['last_name'];
			        $mobile_no = $result[0]['mobile_no'];
			        $user_id = $result[0]['user_id'];
			    }
			}
			$return_result['first_name'] = $first_name;
			$return_result['last_name'] = $last_name;
			$return_result['mobile_no'] = $mobile_no;
			$return_result['user_id'] = $user_id;
			$return_result['result'] = $result;
 			echo json_encode($return_result);
			break;
	    }
	}
	
	public function getCallAmbulanceById($id = '') {
		switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			    $result = array();
    			$datas = json_decode(file_get_contents("php://input"));
    			if ($id) {
        			$result = $this->login->getCallAmbulanceById($id);
        			if ($result) {
             			$result['first_name'] = $result['first_name'].' '.$result['last_name'].'    ';
            			if ($result['tenant_id'] !=null) {
            			    $res_arr = $this->login->getAdminDetailById($result['tenant_id'] );
            			    if ($res_arr) {
            			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
            			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
            			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
            			        $result['tenant_name'] = $tenant_user_name ;
            			    } else {
            			        $result['tenant_name'] = "";
            			    }
            			} else {
            			    $result['tenant_name'] = "";
            			}
            		    //2-feb-2023
            			if ($result['ambulance_service_id'] == 2) {
            			    $result['latitude'] = $result['dest_lat'];
            			    $result['longitude'] = $result['dest_long'];
            			    $result['request_id'] = $result['crn'];
            			}
                        unset($result['middle_name']);
                        unset($result['last_name']);
        			}
    			}
    			echo json_encode($result);
			break;
		}
	}

	public function getCallRsaById($id = '') {
	   	switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result = $this->login->getCallRsaById($id);
			if ($result) {
     			$result['first_name'] = $result['first_name'].' '.$result['last_name'].'    ';
    			if ($result['tenant_id'] !=null) {
    			    $res_arr = $this->login->getAdminDetailById($result['tenant_id'] );
    			    if ($res_arr) {
    			        $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
    			        $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
    			        $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
    			        $result['tenant_name'] = $tenant_user_name ;
    			    } else {
    			        $result['tenant_name'] = "";
    			    }
    			} else {
    			    $result['tenant_name'] = "";
    			}
                unset($result['middle_name']);
                unset($result['last_name']);
			}
			echo json_encode($result);
			break;
		}
	}
	
	public function getTenantLicenceCount(){
		 error_reporting(1);   error_reporting(E_ALL);
        switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
			$datas = json_decode(file_get_contents("php://input"));
			$result_admin = $this->login->getAdmin();
			$admin_detail_arr = array();
            if (!empty($result_admin)) {
                foreach ($result_admin as $key => $row) {
                    $admin_detail_arr[$key]['admin_id'] = $row['uid'];
                    $admin_detail_arr[$key]['admin_name'] = $row['first_name'] . " " . $row['last_name'];
                    $admin_detail_arr[$key]['licence_total_count'] = $this->login->getTenantLicenceCount($row['uid']);
                    $admin_detail_arr[$key]['licence_total_count_title'] = "Total - ".  $this->login->getTenantLicenceCount($row['uid']);
                    $admin_detail_arr[$key]['licence_used_count'] =  $this->login->getTenantLicenceUsedCount($row['uid']);
                    $admin_detail_arr[$key]['licence_used_count_title'] = "Used - ". $this->login->getTenantLicenceUsedCount($row['uid']);
                }
            }
// 			print_r($admin_detail_arr);
// 			die;
 			echo json_encode($admin_detail_arr);
			break;
	    }
	}
	
	public function getUserRecordAndUpdateTable() {
	    error_reporting(E_ALL);     ini_set('display_errors', '1');
        echo "<pre>";
        
       // $this->db->distinct();
        $this->db->select('users.id ');
       	$this->db->limit('10');
        $this->db->from('users');
	    $q = $this->db->get();
       	$this->db->where('is_deleted', '1');
        $result_users_array = $q->result_array();
                        
		echo $this->db->last_query();
// 		print_r($result_users_array);
		      echo "<br>";
		if ($result_users_array) {
		    foreach($result_users_array as $row) {
		        $user_id = $row['id'];
                echo "user_id => ". $user_id;
                echo "<br>";
 die;
                // call_ambulance
                $tables = array('call_ambulance', 'call_rsa', 'emergency_contacts', 'emergency_map_user_request', 'followme_safe', 'panic_request', 'posh_request', 
                'pre_trigger_notifications', 'queries', 'user_critical_illness', 'user_multimedia', 'user_otp', 'user_payment', 'user_plan');
                $this->db->where('user_id', $user_id);
                $this->db->delete($tables);
echo $this->db->last_query();
                
                // call_health_insurance
                $tables = array('call_health_insurance' );
                $this->db->where('member_id', $user_id);
                $this->db->delete($tables);
echo $this->db->last_query();
                
                //trackee_id
                $tables = array('tracking' );
                $this->db->where('trackee_id', $user_id);
                $this->db->delete($tables);
echo $this->db->last_query();


            //     $this->db->select('call_ambulance.id, call_ambulance.user_id');
            //     $this->db->where('call_ambulance.user_id', $user_id);
            //     $this->db->from('call_ambulance');
	           // $q = $this->db->get();
            //     $result_call_ambulance_array = $q->result_array();
            //     $count_result_call_ambulance_array = count($result_call_ambulance_array);
            //     if (!empty($result_call_ambulance_array)) {
            //         foreach ($result_call_ambulance_array as $row_call_ambulance) {
            //             echo " <b>call_ambulance =></b> count - ". $count_result_call_ambulance_array . ", user_id => " . $user_id;
            //             echo "<br>";
            //             $user_id = $row['id'];
            //             // echo "id => " .$row_call_ambulance['id']. ", user_id => " . $user_id;
            //         }
            //     }
		    }
		}
	}
	public function getUserRecordAndUpdateLicence() {
	    error_reporting(E_ALL);
        ini_set('display_errors', '1');
echo "<pre>";
        $this->db->select('users.id ');
       	$this->db->limit('10');
       	$this->db->where('is_deleted', '1');
        $this->db->from('users');
	    $q = $this->db->get();
        $result_users_array = $q->result_array();
		echo $this->db->last_query();
// 		print_r($result_users_array);

		if($result_users_array) {
		    foreach($result_users_array as $row) {
		        $user_id = $row['id'];
                echo "user_id => ". $user_id;
                echo "<br>";
 
                // tenant_licence
                $this->db->select('tenant_licence.id, tenant_licence.licence_key, tenant_licence.user_id');
                $this->db->from('tenant_licence');
                $this->db->where('user_id', $user_id);
        	    $q = $this->db->get();
                $result_tenant_licence_array = $q->row_array();
        		echo $this->db->last_query();
        		
        		if ($result_tenant_licence_array) {
        		     $update_data = array(			
            			'start_date' => null,
            			'end_date' => null,
            			'user_id' => null,
            			'licence_days' => null,
            			'plan_id' => null,
            			'is_use' => '0',
            			'is_deleted' => '0',
            			'updated_at' => date('Y-m-d H:i:s'),
            		);
            		
            		echo $row['id'] ;
            		print_r($update_data);
            		$this->db->where('user_id', $user_id);
            		$this->db->update('tenant_licence',$update_data);
            		
            		$tenant_licence_key = $result_tenant_licence_array->licence_key;
            		$update_data_tenant_licence_reference = array(			
            			'is_use' => '0',
            			'updated_at' => date('Y-m-d H:i:s'),
            		);
            		
            		echo $row['id'] ;
            		print_r($update_data);
            		$this->db->where('tenant_licence_key', $tenant_licence_key);
            		$this->db->update('$update_data_tenant_licence_reference', $update_data_tenant_licence_reference);
        		}
		    }
		}
	}
	
	public function userGetAmbulanceDetailsZimaxDial($request_id, $user_id) {
        if ($request_id !="") {
		    if ($request_id) {
    		    $insert_myresqr_user = array('crn' => $request_id);
    		    $authtoken ="";
    		    $ziman_dial_id="";
    		    $user_ambulance_service_detail = $this->login->getUserAmbulanceServiceByUserId($request_id, $user_id);
	            if ($user_ambulance_service_detail  ) {
	                $mobile_no = $user_ambulance_service_detail['mobile_no'];
	                $ziman_dial_id = $user_ambulance_service_detail['ziman_dial_id'];
                    $authtoken = $user_ambulance_service_detail['authtoken'];
		        }
                $header_arr= array(
                    // 'authtoken: e09611bb6f8296e53c87d23f97aee2:1063',
                    'authtoken: '.$authtoken.':'.$ziman_dial_id
                );
                // START - curl
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL , 'http://15.206.99.54/ambulance/api/journey/getdriverdetails');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_ENCODING, '');
                curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
                curl_setopt($curl, CURLOPT_TIMEOUT ,  0);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
                curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST , 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS,  $insert_myresqr_user);
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
                if (!empty($json_result) ) {
                    if(isset($json_result['data']) && $json_result['data'] !="") {
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
                    'request_id' => $request_id,
                    'vehicle_no' => "",
                    'vehicle_driver_phone'=> $driver_mobile_number,
                    'last_status' => $trip_status,
                    'last_status_time' => $last_status_time,
                    'success' => true,
                    'tracking_url' => $tracking_url
                    );
    	   	    print json_encode( $result );
    	    } else {
    			  $result = array('status'  => 'Fail','message' => "No record found." ,  );
    	   		  print json_encode( $result );
    		}
        }
    }
    public function getUserImageUpdateRecord() {
        //  update users
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        echo "<pre>";
        $this->db->select('*');
        $this->db->from('users');
    //  $this->db->where('id', 2);
            $this->db->like('profile_image', 'anekalabs.com');
            $this->db->or_like('profile_image_thumb', 'anekalabs.com');
            $this->db->or_like('govt_id_image_url', 'anekalabs.com');
            $this->db->or_like('govt_id_image_url_thumb', 'anekalabs.com');
        $this->db->limit(100  );
        $this->db->order_by('id', 'ASC');
        $q = $this->db->get();
        $result_update_users = $q->result_array();
        // print_r($result_update_users);
    //   echo $this->db->last_query();   //       die;
        if($result_update_users) {
            foreach($result_update_users as $row) {
                print_r("user id => ".$row['id']."<br>");

                if ($row['profile_image'] !=null || $row['profile_image'] !="") {
                    $image_str = $row['profile_image'];
                    $word = "anekalabs.com";
                    // print_R($image_str);
                    if (strpos($image_str, $word) !== false) {
                        $first_word = "https://captainindia.anekalabs.com/backend/uploads";
                        $second_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        $search_word ="";
                        if (strpos($image_str, $first_word) !== false) {
                            $search_word = "https://captainindia.anekalabs.com/backend/uploads";
                        } else if (strpos($image_str, $second_word) !== false) {
                            $search_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        }
                        if ($search_word !="") {
                            $replace_word = "";
                            $new_file_path = str_replace($search_word, $replace_word, $image_str);
                            $this->db->where('id', $row['id']);
                            $this->db->update('users', array('profile_image'=> $new_file_path));
                    	   // $affected_rows = $this->db->affected_rows();
                	       // echo $this->db->last_query();
                        }
                    }
                }
                if ($row['profile_image_thumb'] !=null || $row['profile_image_thumb'] !="") {
                    $image_str = $row['profile_image_thumb'];
                    $word = "anekalabs.com";
                    if (strpos($image_str, $word) !== false) {
                        $first_word = "https://captainindia.anekalabs.com/backend/uploads";
                        $second_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        $search_word ="";
                        if (strpos($image_str, $first_word) !== false) {
                            $search_word = "https://captainindia.anekalabs.com/backend/uploads";
                        } else if (strpos($image_str, $second_word) !== false) {
                            $search_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        }
                        if ($search_word !="") {
                            $replace_word = "";
                            $new_file_path = str_replace($search_word, $replace_word, $image_str);
                            $this->db->where('id', $row['id']);
                            $this->db->update('users', array('profile_image_thumb'=> $new_file_path));
                    	   // $affected_rows = $this->db->affected_rows();
                	       // echo $this->db->last_query();
                        }
                    }
                }
                if ($row['govt_id_image_url'] !=null || $row['govt_id_image_url'] !="") {
                    $image_str = $row['govt_id_image_url'];
                    $word = "anekalabs.com";
                    if (strpos($image_str, $word) !== false) {
                        $first_word = "https://captainindia.anekalabs.com/backend/uploads";
                        $second_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        $search_word ="";
                        if (strpos($image_str, $first_word) !== false) {
                            $search_word = "https://captainindia.anekalabs.com/backend/uploads";
                        } else if (strpos($image_str, $second_word) !== false) {
                            $search_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        }
                        if ($search_word !="") {
                            $replace_word = "";
                            $new_file_path = str_replace($search_word, $replace_word, $image_str);
                            $this->db->where('id', $row['id']);
                            $this->db->update('users', array('govt_id_image_url'=> $new_file_path));
                    	   // $affected_rows = $this->db->affected_rows();
                	       // echo $this->db->last_query();
                        }
                    }
                }
                if ($row['govt_id_image_url_thumb'] !=null || $row['govt_id_image_url_thumb'] !="") {
                    $image_str = $row['govt_id_image_url_thumb'];
                    $word = "anekalabs.com";
                    if (strpos($image_str, $word) !== false) {
                        $first_word = "https://captainindia.anekalabs.com/backend/uploads";
                        $second_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        $search_word ="";
                        if (strpos($image_str, $first_word) !== false) {
                            $search_word = "https://captainindia.anekalabs.com/backend/uploads";
                        } else if (strpos($image_str, $second_word) !== false) {
                            $search_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        }
                        if ($search_word !="") {
                            $replace_word = "";
                            $new_file_path = str_replace($search_word, $replace_word, $image_str);
                            $this->db->where('id', $row['id']);
                            $this->db->update('users', array('govt_id_image_url_thumb'=> $new_file_path));
                    	   // $affected_rows = $this->db->affected_rows();
                	       // echo $this->db->last_query();
                        }
                    }
                }
                //  die;
            }
        }
             // die;
        echo "Done";
    }
    
    public function getUsermultimediaUpdatePath() {
        //  updateuser_multimedia
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $this->db->select('id, user_id, panic_id, user_lat, user_long, content_type, module_type, file_path, thumbnail_file_path, notes, type, created_at');
        $this->db->from('user_multimedia');
        // $this->db->where('id', 2);
        $this->db->like('file_path', 'anekalabs.com');
        $this->db->or_like('thumbnail_file_path', 'anekalabs.com');
        $this->db->limit(100 );
        $this->db->order_by('id', 'ASC');
        $q = $this->db->get();
    //  echo $this->db->last_query();//die;
        $result_updateuser_multimedia = $q->result_array();
        // print_r($result_updateuser_multimedia);
        // die;
        if($result_updateuser_multimedia) {
            foreach($result_updateuser_multimedia as $row) {
                print_r("id => ".$row['id']."<br>");

                if ($row['file_path'] !=null || $row['file_path'] !="") {
                    $image_str = $row['file_path'];
                    $word = "anekalabs.com";
                    if (strpos($image_str, $word) !== false) {
                        $first_word = "https://captainindia.anekalabs.com/backend/uploads";
                        $second_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        $search_word ="";
                        if (strpos($image_str, $first_word) !== false) {
                            $search_word = "https://captainindia.anekalabs.com/backend/uploads";
                        } else if (strpos($image_str, $second_word) !== false) {
                            $search_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        }
                        if ($search_word !="") {
                            $replace_word = "";
                            $new_file_path = str_replace($search_word, $replace_word, $image_str);
                            $this->db->where('id', $row['id']);
                            $this->db->update('user_multimedia', array('file_path'=> $new_file_path));
                    	   // $affected_rows = $this->db->affected_rows();
                	       // echo $this->db->last_query();
                        }
                    }
                }
                if ($row['thumbnail_file_path'] !=null || $row['thumbnail_file_path'] !="") {
                    $image_str = $row['thumbnail_file_path'];
                    $word = "anekalabs.com";
                    if (strpos($image_str, $word) !== false) {
                        $first_word = "https://captainindia.anekalabs.com/backend/uploads";
                        $second_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        $search_word ="";
                        if (strpos($image_str, $first_word) !== false) {
                            $search_word = "https://captainindia.anekalabs.com/backend/uploads";
                        } else if (strpos($image_str, $second_word) !== false) {
                            $search_word = "https://captainindiatest2.anekalabs.com/backend/uploads";
                        }
                        if ($search_word !="") {
                            $replace_word = "";
                            $new_file_path = str_replace($search_word, $replace_word, $image_str);
                            $this->db->where('id', $row['id']);
                            $this->db->update('user_multimedia', array('thumbnail_file_path'=> $new_file_path));
                    	   // $affected_rows = $this->db->affected_rows();
                	       // echo $this->db->last_query();
                        }
                    }
                }
            }
                // die;
        }
        echo "Done";
    }

public function getTenantLicenceUpdatePlanId() {
        //  tenant_licence
        error_reporting(E_ALL);
        ini_set('display_errors', '1');echo "<pre>";

                $this->db->select('id, user_id, plan_id, status, is_deleted, created_at');
                $this->db->from('user_plan');
                // $this->db->where('user_id',  50);
                $this->db->where('is_deleted', '0');
                $this->db->where('licence_key_id', null);
                $this->db->limit(1200);
                $this->db->order_by('id', 'ASC');
                $query = $this->db->get();
    // echo $this->db->last_query();      echo "<br>";
        $result_user_plan = $query->result_array();
        // print_r($result_user_plan);        // die;
        if($result_user_plan) {
            foreach($result_user_plan as $row) {
                print_r("id => ".$row['id']. " user id => ".$row['user_id'] . "<br>");

                $user_id = $row['user_id'];
                $this->db->select('id, licence_key, tenant_id, start_date, end_date, user_id, licence_days, plan_id, is_use, is_deleted, created_at');
                $this->db->from('tenant_licence');
                $this->db->where('user_id', $user_id);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                //echo $this->db->last_query();
              //  print_R($query->num_rows());echo "<br>";
                if($query->num_rows() == 1) {
                     $result_update_user_plan = $query->row_array();
                    $licence_key_id = $result_update_user_plan['id'];
                        // print_R( $result_update_user_plan);echo "<br>"; 
                        print_R( " licence_key_id => ".$licence_key_id);echo "<br>";//die;
        		    $this->db->where('id', $row['id'] );
        		    $this->db->where('user_id', $user_id);
                    $this->db->update('user_plan', array('licence_key_id'=> $licence_key_id));
                    // echo $this->db->last_query();echo "<br>";
                    // die;
        		}else{
        		 
        		}
            }
        }
    }

   public function getUserPlanUpdateLicenceKeyId() {
        //  tenant_licence
        error_reporting(E_ALL);
        ini_set('display_errors', '1');echo "<pre>";

                $this->db->select('id, user_id, plan_id, status, is_deleted, created_at');
                $this->db->from('user_plan');
                // $this->db->where('user_id',  104);
                $this->db->where('is_deleted', '0');
                $this->db->where('licence_key_id', null);
                $this->db->limit(1000);
                $this->db->order_by('id', 'ASC');
                $query = $this->db->get();
    // echo $this->db->last_query();      echo "<br>";
        $result_user_plan = $query->result_array();
        // print_r($result_user_plan);        // die;
        if ($result_user_plan) {
            foreach ($result_user_plan as $row) {
                print_r("id => " . $row['id'] . " user id => " . $row['user_id'] . "<br>");

                $user_id = $row['user_id'];
                $this->db->select('id, tenant_licence_id, is_deleted, created_at');
                $this->db->from('users');
                $this->db->where('is_deleted', 0);
                $this->db->where('id', $user_id);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get();
                //  echo $this->db->last_query();
                //  print_R($query->num_rows());echo "<br>";
                if ($query->num_rows() == 1) {
                     $result_update_users = $query->row_array();
                    $tenant_licence_id = $result_update_users['tenant_licence_id'];
                    // print_R( $result_update_user_plan);echo "<br>"; 
                    print_R(" licence_key_id => " . $tenant_licence_id);
                    echo "<br>"; // die;
                    if ($tenant_licence_id != null) {
            		    $this->db->where('id', $row['id']);
            		    $this->db->where('user_id', $user_id);
                        $this->db->update('user_plan', array('licence_key_id' => $tenant_licence_id));
                        echo $this->db->last_query();
                        echo "<br>";
                    }
                    //  die;
        		}else{
        		 
        		}
            }
        }
    }
    
    // 25-feb-2023
    public function getSettingById($id) {
        if ($id) {
            $finresults = $this->login->getSettingById($id);
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

    // 15-march-2023
    public function getUserEvidence($tid = '', $page = '') {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->login->getUserPanicEvidence($tid, $page);
                if ($page == 1) {
                    $prv_page_id = 0;
                    $curr_page_id = 1;
                } else {
                    $result_next_record = $this->login->getUserPanicEvidenceNextRecord($tid, $page - 1);
                    $prv_page_id = $page;
                    if (!empty($result_next_record)) {
                        $prv_page_id--;
                    }
                    $curr_page_id = $page;
                }
                $result_next_record = $this->login->getUserPanicEvidenceNextRecord($tid, $page + 1);
                $next_page_id = $page;
                if (!empty($result_next_record)) {
                    $next_page_id++;
                } else {
                    $next_page_id = 0;
                }
                $range1 = $page * 10;
                $range2 = $range1 - 10;
                $i = 1;
                $followme_id_arr = array();
                $result_arr = array();
                foreach ($result as $key => $value) {
                    $arr = explode(' ', $result[$key]['timestamp']);
                    $result_multimedia = $this->login->getUserMultimediaByPanicId($value['id']);

                    $result[$key]['first_name'] = $value['first_name'] . ' ' . $value['last_name'];
                    unset($result[$key]['middle_name']);
                    unset($result[$key]['last_name']);

                    $panic_type_value = "-";
                    $followme_safe_status_value = "";
                    $content_type_value = "";
                    $module_type_value = "";
                    if ($result_multimedia) {
                        if ($result_multimedia['followme_safe_status'] == '1') {
                            $followme_safe_status_value = "-NO";
                        } else if ($result_multimedia['followme_safe_status'] == '2') {
                            $followme_safe_status_value = "-NA";
                        }
                        if ($result_multimedia['content_type'] == '4' && $result_multimedia['module_type'] == '4') {
                            $panic_type_value = "Follow me" . $followme_safe_status_value;
                        } else {
                            $panic_type_value = "Panic";
                        }
                        $content_type_value = $result_multimedia['content_type'];
                        $module_type_value = $result_multimedia['module_type'];
                    }

                    if ($result[$key]['module_type'] == '1') {
                        $panic_type_value = "Panic";
                    } else if ($result[$key]['module_type'] == '4') {
                        $panic_type_value = "Follow me" . $followme_safe_status_value;
                    }
                    $result[$key]['panic_type_value'] = $panic_type_value;
                    $result[$key]['content_type'] = $content_type_value;
                    $result[$key]['module_type'] = $module_type_value;

                    // get tenant name
                    if ($result[$key]['tenant_id'] != null) {
                        $res_arr = $this->login->getAdminDetailById($result[$key]['tenant_id']);
                        if ($res_arr) {
                            $tenant_first_name = $res_arr->first_name ? $res_arr->first_name : "";
                            $tenant_last_name = $res_arr->last_name ? $res_arr->last_name : "";
                            $tenant_user_name = $res_arr->user_name ? $res_arr->user_name : "";
                            $result[$key]['tenant_name'] = $tenant_user_name;
                        } else {
                            $result[$key]['tenant_name'] = "";
                        }
                    } else {
                        $result[$key]['tenant_name'] = "";
                    }
                    if ($result_multimedia) {
                        $result[$key]['followme_id'] = $result_multimedia['followme_id'] != null ? $result_multimedia['followme_id'] : "";
                        $result[$key]['followme_safe_status'] = $result_multimedia['followme_safe_status'] != null ? $result_multimedia['followme_safe_status'] : "";
                    } else {
                        $result[$key]['followme_id'] = "";
                        $result[$key]['followme_safe_status'] = "";
                    }
                    if ($result[$key]['followme_id'] != "") {
                        $panic_type_value = "Follow me" . $followme_safe_status_value;
                        $result[$key]['panic_type_value'] = $panic_type_value;
                    }
                    $result[$key]['followme_id_arr'] = $followme_id_arr;
                    $result[$key]['curr_page_id'] = $curr_page_id;
                    $result[$key]['prv_page_id'] = $prv_page_id;
                    $result[$key]['nxt_page_id'] = $next_page_id;
                    if ($prv_page_id == 0) {
                        $sr_no = $i;
                    } else {
                        $sr_no = ($prv_page_id * 10) + $i;
                    }
                    $result[$key]['sr_no'] = $sr_no;
                    if ($result[$key]['followme_id'] != "") {
                        if (!in_array($result[$key]['followme_id'], $followme_id_arr)) {
                            $result_arr[] = $result[$key];
                            $followme_id_arr[] = $result[$key]['followme_id'];
                        }
                    } else {
                        $result_arr[] = $result[$key];
                    }
                    $i++;
                }
                echo json_encode($result_arr);
                break;
        }
    }

}
