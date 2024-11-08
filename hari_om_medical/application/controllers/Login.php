<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->load->model('AuthLog_M');
	} 

	public function index()
	{
		$User_Id = $this->session->LogAdminId;
		if ($User_Id) 
		{
			redirect(base_url());	       	
		}
		else
		{
		$data['title']="Login Page";
		$data['connect']="Auth/Login";
		$this->load->view("partials/Connect",$data);
	   }
	}


	public function LoginAuth()
	{
		$Method=$this->input->method(TRUE);
		if($Method==='POST')
		 {
		   $data['title']="Login Page";
		   $UserName=$this->input->post('userName',TRUE);
		   $password=$this->input->post('password',TRUE);
		   $redircturl=urldecode($this->input->post('redirecturl',TRUE));	
		   $CheckUsename=$this->AuthLog_M->CheckUser($UserName);
			if($CheckUsename)
			{
				$verify_login=$this->AuthLog_M->getuserDetails($UserName);

				$hash_password = $verify_login->password;
				$hash_password = password_hash($hash_password, PASSWORD_DEFAULT);
				// var_dump($hash_password)
				$hash = password_verify($password,$hash_password);
			
				if($hash)
				{
					$userdata = array( 
						'LogAdminId' => "$verify_login->person_id",
						'LogAdminUN' => "$verify_login->username",
						'LoginAdmin' => true
						);
					$this->session->set_userdata($userdata);
					$stflash = array(
						'type' => 'success', //error : success
						'FlashMassage' => '<div class="alert alert-success">Welcome '.$verify_login->username.' !</div>',
						'Show' => 'Welcome '.$verify_login->username.' !',
						 );
					$this->session->set_flashdata($stflash);
					// $this->AuthLog_M->User_act("Welcome ".$verify_login->emp_name." !");
					
					if ($redircturl!='') 
					{
				     redirect($redircturl);	
				    }
				    else
				    {
				    	redirect(base_url('Account/Home'));
				    } 
				}
				else
				{						 
					$this->session->set_flashdata('FlashMassage','<div class="alert alert-danger">Incorrect Login Name -'.$UserName.' </div>');
					// redirect(base_url('Login'));
					redirect(base_url('Login?redirecturl='.urlencode($redircturl)));            
				}


			} 
			else
			{
				$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-danger">User Not Found</div>',
				'Show' => 'User Not Found',
				 );
			$this->session->set_flashdata($stflash);  
			// redirect(base_url('Login'));
			redirect(base_url('Login?redirecturl='.urlencode($redircturl)));             
			}
		 }
		 else
		 {
		 	$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
				'Show' => 'Please Login First',
				 );
			$this->session->set_flashdata($stflash);    
			// redirect(base_url('Login'));
			redirect(base_url('Login?redirecturl='.urlencode($redircturl)));             
		}

	}

	public function AdminLogout()
	{
		// $this->AuthLog_M->User_act("Logout Successfully");     

		$data = array('LogAdminId','LogAdminUN','LoginAdmin');
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('successMessage','<div class="alert alert-success">Logout Successfully</div>');
		redirect(base_url('Login'));
    }
}
