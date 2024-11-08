<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->checkLogin();
		$this->load->model('Account_M');
		$this->load->model('Supplier_M');
		$this->load->model('Inventory_M');
	} 

	public function checkLogin()
	{
		$User_Id = $this->session->LogAdminId;
		if ($User_Id) 
		{
			echo "";		       	
		}
		else
		{
			if ($this->uri->uri_string())
			{
			        $reffurl= base_url($this->uri->uri_string());
			}
			else
			{
			 $reffurl= base_url();
			}
			
			$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
				'Show' => 'Please Login First',
				 );
			$this->session->set_flashdata($stflash);    
			redirect(base_url('Login?redirecturl='.urlencode($reffurl)));            
		}
	}

	public function index()
	{

        $Stocks=$this->Inventory_M->getproductStock();
        $stockarr=array();
        foreach ($Stocks as $key => $value) {
        	$getaldata=$this->Inventory_M->getproductname($value->pid);
        	$getcat=$this->Inventory_M->getproductcat($value->cat_id);
        	$value->productname=$getaldata->name;
        	$value->catname=$getcat->name;
        	array_push($stockarr, $value);
        }
        $data['Stocks']=$stockarr;
		$data['title']="Home :Account";
		$data['connect']="Inventory/productstock";
		$this->load->view("partials/Dash_connect",$data);
	}

}