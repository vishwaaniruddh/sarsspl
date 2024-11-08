<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {

	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->checkLogin();
		$this->load->model('Account_M');
		$this->load->model('Supplier_M');
		$this->load->model('Settings_M');
		$this->load->model('Returns_M');
		$this->load->model('Customers_M');
		$this->load->library('billing');
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
		$data['title']="Home :Account";		
		$data['supplier']=$this->Account_M->get_suppliers();
		$data['billno']=$this->Account_M->get_billno();
		$data['connect']="Returns/home";
		$this->load->view("partials/Dash_connect",$data);
	}



	public function getInvoice()
	{
		$invoiceno=$this->input->post('invoiceno',True);
		$data['title']="Home :Returns";		
		$data['invoice']=$this->Returns_M->get_invoice($invoiceno);
		$this->load->view("Returns/getInvoice",$data);
	}

	public function getsupplier()
	{
		$supp_name=$this->input->post('supp_name',True);
		$data['title']="Home :Returns";		
		$data['supplier']=$this->Returns_M->get_suppliers($supp_name);
		$this->load->view("Returns/getsupplier",$data);
	}

	public function supplierReturn($supp_id)
	{
		$data['title']="Home :Returns";
		$data['Settings'] = $this->Settings_M->getSettingdetails(1);
		$all_bills = array();
		$all_billsdata= $this->Returns_M->getSUpplierbill_details($supp_id);

		foreach ($all_billsdata as $key => $bills) {
			$supplier=$this->Account_M->getsupplier($bills->supp_id);
			if(isset($supplier->company_name)){
            $bills->supplier_name=$supplier->company_name;
			array_push($all_bills, $bills);
		   }
		   else
		   {
		   	$bills->supplier_name="NA";
			array_push($all_bills, $bills);

		   }
		}
		$data['all_bills']= $all_bills;
		$data['connect']="Returns/supplierReturn";
		$this->load->view("partials/Dash_connect",$data);
	}

	public function InvoiceReturn($bill_id)
	{
		$data['title']="Home :Returns";
		$bills_data= $this->Customers_M->getbill_details($bill_id);
		$data['Settings'] = $this->Settings_M->getSettingdetails(1);
		$data['bills_data']= $bills_data;
		$this->load->library('billing');
        $data['amtwords']= $this->billing->getIndianCurrency($bills_data->payamt);
		$data['customer_data']= $this->Customers_M->getall_customers_deatils($bills_data->cust_id);
		$data['getbill_product']=$this->Customers_M->getbill_product($bill_id);
		$data['connect']="Returns/InvoiceReturn";
		$this->load->view("partials/Dash_connect",$data);
	}
	
	public function ProductSupplier($bill_id)
	{
		$data['title']="Home :Returns";
		$bills_data= $this->Customers_M->getbill_details($bill_id);
		$data['Settings'] = $this->Settings_M->getSettingdetails(1);
		$data['bills_data']= $bills_data;
		$this->load->library('billing');
        $data['amtwords']= $this->billing->getIndianCurrency($bills_data->payamt);
		$data['customer_data']= $this->Customers_M->getall_customers_deatils($bills_data->cust_id);
		$data['getbill_product']=$this->Customers_M->getbill_product($bill_id);
		$data['connect']="Returns/ProductSupplier";
		$this->load->view("partials/Dash_connect",$data);
	}
}