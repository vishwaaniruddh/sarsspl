<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->checkLogin();
		$this->load->model('Account_M');
		$this->load->model('Supplier_M');
		$this->load->model('Settings_M');
		$this->load->model('Returns_M');
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

		$query=$this->db->query("SELECT sum(totalamt) as totalPurchase FROM `phppos_purchase_details`");
    	 $row=$query->row();
    	$data['totalPurchase']=$row->totalPurchase;

    	$suppquery=$this->db->query("SELECT * FROM `phppos_suppliers`");
    	$data['noofsupp']=$suppquery->num_rows();

    	$bank=$this->db->query("SELECT * FROM `banks`");
    	$data['nobank']=$bank->num_rows();

    	$banktx=$this->db->query("SELECT * FROM `bank_transaction`");
    	$data['nobanktx']=$banktx->num_rows();

		$data['connect']="Account/Home";
		$this->load->view("partials/Dash_connect",$data);
	}
	public function Bill_Entry()
	{
		$data['title']="Home :Account";
		$data['connect']="Account/Supplier_bill_entry";
		$data['supplier']=$this->Account_M->get_suppliers();
		$data['billno']=$this->Account_M->get_billno();
		$this->load->view("partials/Dash_connect",$data);
	}
	
	public function Bill_EntryTwo()
	{
		$data['title']="Home :Account";
		$data['connect']="Account/Supplier_bill_entryTwo";
		$data['supplier']=$this->Account_M->get_suppliers();
		$data['billno']=$this->Account_M->get_billno();
		$this->load->view("partials/Dash_connect",$data);
	}

	public function View_bill()
	{
		$all_bills = array();
		$all_billsdata=$this->Supplier_M->get_all_bills();

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
		$data['title']="Home :Account";
		$data['connect']="Account/Supplier_View_bill";
		$this->load->view("partials/Dash_connect",$data);
	}

	function Viwe_bill_details($billid)
	{		
		$data['Settings'] = $this->Settings_M->getSettingdetails(1);
		$bills_data= $this->Supplier_M->getbill_details($billid);
		$data['bills_data']= $bills_data;
		$this->load->library('billing');
        $data['amtwords']= $this->billing->getIndianCurrency($bills_data->payamt);
		$data['supplier_data']= $this->Supplier_M->getall_supplier_deatils($bills_data->supp_id);
		$data['getbill_product']=$this->Supplier_M->getbill_product($billid);

		$data['title']="Home :Account";
		// $data['connect']="Account/Viwe_bill_details";
		$data['connect']="Account/SupplierBillDetails";
		$this->load->view("partials/Dash_connect",$data);

	}

	public function Manage_Supplier()
	{
		$suppliers=array();
		$suppliersdata=$this->Account_M->get_suppliers();
		foreach ($suppliersdata as $key => $supp) {
			$supp->data=$this->Account_M->getsupplierdata($supp->person_id);
			array_push($suppliers, $supp);			
		}
		$data['suppliers']=$suppliers;
		$data['title']="Home :Account";
		$data['connect']="Supplier/Manage_Supplier";
		$this->load->view("partials/Dash_connect",$data);
	}

	public function Add_New_Supplier()
	{
		$data['supplier']=$this->Account_M->get_suppliers();
		$data['statelist']=$this->Account_M->getstatelist();
		$data['title']="Home :Account";
		$data['connect']="Supplier/Add_New_Supplier";
		$this->load->view("partials/Dash_connect",$data);
	}

	public function Create_New_Supplier()
	{
     $companyname = $this->input->post('companyname',true);
     $firstname = $this->input->post('firstname',true);
     $Lastname = $this->input->post('Lastname',true);
     $email = $this->input->post('email',true);
     $birthdate = $this->input->post('birthdate',true);
     $phonenumber = $this->input->post('phonenumber',true);
     $inputAddress = $this->input->post('inputAddress',true);
     $inputAddress2 = $this->input->post('inputAddress2',true);
     $inputCity = $this->input->post('inputCity',true);
     $state = $this->input->post('state',true);
     $inputZip = $this->input->post('inputZip',true);
     $country = $this->input->post('country',true);
     $accountno = $this->input->post('accountno',true);
     $ifsccode = $this->input->post('ifsccode',true);
     $pannumber = $this->input->post('pannumber',true);
     $gstno = $this->input->post('gstno',true);
     $comments = $this->input->post('comments',true);
     if($firstname!='' && $companyname!='')
     {
	       $person_data = array(
			'first_name'=>$firstname,
			'last_name'=>$Lastname,
			'email'=>$email,
			'phone_number'=>$phonenumber,
			'address_1'=>$inputAddress,
			'address_2'=>$inputAddress2,
			'city'=>$inputCity,
			'state'=>$state,
			'zip'=>$inputZip,
			'country'=>$country,
			'pannumber'=>$pannumber,
			'gstno'=>$gstno,
			'comments'=>$comments,
			'dob'=>date('Y-m-d',strtotime($birthdate)),
			);

			$supplier_data=array(
			'company_name'=>$companyname,
			'account_number'=>$accountno=='' ? null:$accountno,
			'ifsccode'=>$ifsccode=='' ? null:$ifsccode,
			);
			$addsupplier=$this->Supplier_M->Save($person_data,$supplier_data);
			if($addsupplier=='1')
			{
				$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-success">Add Supplier Details Successfully !</div>',
				 );
			$this->session->set_flashdata($stflash);    
			redirect(base_url('Supplier/Manage'));
			}
			else if($addsupplier=='0')
			{
				$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-danger">Supplier Details Not Addedd !</div>',
				 );
			$this->session->set_flashdata($stflash);    
			redirect(base_url('Supplier/New'));

			}
			else
			{
				$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-warning">Supplier Details Exist Already !</div>',
				 );
			$this->session->set_flashdata($stflash);    
			redirect(base_url('Supplier/New'));

			}
            
     }
     else
     {
     	$stflash = array(
				'type' => 'error', //error : success
				'FlashMassage' => '<div class="alert alert-danger">Please Fille company name And First name !</div>',
				 );
			$this->session->set_flashdata($stflash);    
			redirect(base_url('Supplier/New'));
     }
	}

	public function Edit_Supplier($person_id)
	{
		// $person_id=rawurldecode($desperson_id);
		// $person_id=$this->encryption->decrypt($person_id);
		
		$updatebtn=$this->input->post('updatebtn',true);
	 if(isset($updatebtn))
	 {
	     $person_id = $this->input->post('person_id',true);
	     $companyname = $this->input->post('companyname',true);
	     $firstname = $this->input->post('firstname',true);
	     $Lastname = $this->input->post('Lastname',true);
	     $email = $this->input->post('email',true);
	     $birthdate = $this->input->post('birthdate',true);
	     $phonenumber = $this->input->post('phonenumber',true);
	     $inputAddress = $this->input->post('inputAddress',true);
	     $inputAddress2 = $this->input->post('inputAddress2',true);
	     $inputCity = $this->input->post('inputCity',true);
	     $state = $this->input->post('state',true);
	     $inputZip = $this->input->post('inputZip',true);
	     $country = $this->input->post('country',true);
	     $accountno = $this->input->post('accountno',true);
	     $ifsccode = $this->input->post('ifsccode',true);
	     $pannumber = $this->input->post('pannumber',true);
	     $gstno = $this->input->post('gstno',true);
	     $comments = $this->input->post('comments',true);
	     $person_id = $this->input->post('person_id',true);
	     $birthdate = $this->input->post('birthdate',true);
	     $dob=date('Y-m-d',strtotime($birthdate));
	     if($firstname!='' && $companyname!='')
	     {
		       $person_data = array(
				'first_name'=>$firstname,
				'last_name'=>$Lastname,
				'email'=>$email,
				'phone_number'=>$phonenumber,
				'address_1'=>$inputAddress,
				'address_2'=>$inputAddress2,
				'city'=>$inputCity,
				'state'=>$state,
				'zip'=>$inputZip,
				'country'=>$country,
				'pannumber'=>$pannumber,
				'gstno'=>$gstno,
				'comments'=>$comments,
				'person_id'=>$person_id,
				'dob'=>$dob
				);

				$supplier_data=array(
				'company_name'=>$companyname,
				'account_number'=>$accountno=='' ? null:$accountno,
				'ifsccode'=>$ifsccode=='' ? null:$ifsccode,
				);
				$addsupplier=$this->Supplier_M->Update($person_data,$supplier_data);
				if($addsupplier)
				{
					$stflash = array(
					'type' => 'error', //error : success
					'FlashMassage' => '<div class="alert alert-success">Update Supplier Details Successfully !</div>',
					 );
				$this->session->set_flashdata($stflash);    
				redirect(base_url('Supplier/Manage'));
				}
				else 
				{
					$stflash = array(
					'type' => 'error', //error : success
					'FlashMassage' => '<div class="alert alert-danger">Supplier Details Not Updated !</div>',
					 );
				$this->session->set_flashdata($stflash);    
				redirect(base_url('Supplier/Edit/'.$person_id));

				}
				
	            
	     }
	     else
	     {
	     	$stflash = array(
					'type' => 'error', //error : success
					'FlashMassage' => '<div class="alert alert-danger">Please Fille company name And First name !</div>',
					 );
				$this->session->set_flashdata($stflash);    
				redirect(base_url('Supplier/New'));
	     }
	 }
	 else
	 {
	 	$data['supplier']=$this->Supplier_M->getall_supplier_deatils($person_id);
	 	// var_dump($data['supplier']);
	 	$data['statelist']=$this->Account_M->getstatelist();
		$data['title']="Home :Account";
		$data['connect']="Supplier/Update_Supplier";
		$this->load->view("partials/Dash_connect",$data);

	 }
	}
	public function View_Supplier($person_id)
	{
		// $person_id=rawurldecode($desperson_id);
		// $person_id=$this->encryption->decrypt($person_id);
		
		$updatebtn=$this->input->post('updatebtn',true);
	 if(isset($updatebtn))
	 {
	     $person_id = $this->input->post('person_id',true);
	     $companyname = $this->input->post('companyname',true);
	     $firstname = $this->input->post('firstname',true);
	     $Lastname = $this->input->post('Lastname',true);
	     $email = $this->input->post('email',true);
	     $birthdate = $this->input->post('birthdate',true);
	     $phonenumber = $this->input->post('phonenumber',true);
	     $inputAddress = $this->input->post('inputAddress',true);
	     $inputAddress2 = $this->input->post('inputAddress2',true);
	     $inputCity = $this->input->post('inputCity',true);
	     $state = $this->input->post('state',true);
	     $inputZip = $this->input->post('inputZip',true);
	     $country = $this->input->post('country',true);
	     $accountno = $this->input->post('accountno',true);
	     $ifsccode = $this->input->post('ifsccode',true);
	     $pannumber = $this->input->post('pannumber',true);
	     $gstno = $this->input->post('gstno',true);
	     $comments = $this->input->post('comments',true);
	     $person_id = $this->input->post('person_id',true);
	     if($firstname!='' && $companyname!='')
	     {
		       $person_data = array(
				'first_name'=>$firstname,
				'last_name'=>$Lastname,
				'email'=>$Lastname,
				'phone_number'=>$phonenumber,
				'address_1'=>$inputAddress,
				'address_2'=>$inputAddress2,
				'city'=>$inputCity,
				'state'=>$state,
				'zip'=>$inputZip,
				'country'=>$country,
				'pannumber'=>$pannumber,
				'gstno'=>$gstno,
				'comments'=>$comments,
				'person_id'=>$person_id
				);

				$supplier_data=array(
				'company_name'=>$companyname,
				'account_number'=>$accountno=='' ? null:$accountno,
				'ifsccode'=>$ifsccode=='' ? null:$ifsccode,
				);
				$addsupplier=$this->Supplier_M->Update($person_data,$supplier_data);
				if($addsupplier)
				{
					$stflash = array(
					'type' => 'error', //error : success
					'FlashMassage' => '<div class="alert alert-success">Update Supplier Details Successfully !</div>',
					 );
				$this->session->set_flashdata($stflash);    
				redirect(base_url('Supplier/Manage'));
				}
				else 
				{
					$stflash = array(
					'type' => 'error', //error : success
					'FlashMassage' => '<div class="alert alert-danger">Supplier Details Not Updated !</div>',
					 );
				$this->session->set_flashdata($stflash);    
				redirect(base_url('Supplier/Edit/'.$person_id));

				}       
	     }
	     else
	     {
	     	$stflash = array(
					'type' => 'error', //error : success
					'FlashMassage' => '<div class="alert alert-danger">Please Fille company name And First name !</div>',
					 );
				$this->session->set_flashdata($stflash);    
				redirect(base_url('Supplier/New'));
	     }
	 }
	 else
	 {
	 	$data['supplier']=$this->Supplier_M->getall_supplier_deatils($person_id);
	 	$data['statelist']=$this->Account_M->getstatelist();
	 	// var_dump($data['supplier']);
		$data['title']="Home :Account";
		$data['connect']="Supplier/View_Supplier";
		$this->load->view("partials/Dash_connect",$data);
	 }
	}

	public function create_bill()
	{
		$bill_id=$this->input->post('bill_id',TRUE);
		$bill_date=$this->input->post('bill_date',TRUE);
		$supp_id=$this->input->post('supp_id',TRUE);
		$myitemid=$this->input->post('myitemid',TRUE);
		$item_cat=$this->input->post('item_cat',TRUE);
		$item_no=$this->input->post('item_no',TRUE);
		$cprice=$this->input->post('cprice',TRUE);
		$crate=$this->input->post('crate',TRUE);
		$ptotalamt=$this->input->post('ptotalamt',TRUE);
		$uprice="0";
		$qty=$this->input->post('qty',TRUE);
		$scheme_qty=$this->input->post('scheme_qty',TRUE);
		$totalqty=$this->input->post('totalqty',TRUE);
		$totalamt=$this->input->post('totalamt',TRUE);
		$payamt=$this->input->post('payamt',TRUE);
		$distype="";
		$discount="";
		$disamt="";
		$hsn=$this->input->post('batchno',TRUE);
		$gsttype="";
		$gstper="";
		$addgst="";
		$GST=$this->input->post('GST',TRUE);
		$dis=$this->input->post('discount',TRUE);
		$expirydate=$this->input->post('expirydate',TRUE);
		$batchno=$this->input->post('batchno',TRUE);
		$date=date('Y-m-d',strtotime($bill_date));

		$instdata = array(
			'bill_id' =>$bill_id , 
			'supp_id' =>$supp_id , 
			'date' =>$date , 
			'totalqty' =>$totalqty , 
			'totalamt' =>$totalamt , 
			'outstanding' =>$payamt , 
			'discount' =>$discount , 
			'payamt' =>$payamt , 
			'dis_type' =>$distype , 
			'disamt' =>$disamt , 
			'gsttype' =>$gsttype , 
			'gstper' =>$gstper , 
			'addgst' =>$addgst ,  
		);

		$qrypur=$this->db->insert('phppos_purchase',$instdata);
		
		if($qrypur)
        {
        	$pur_id=$this->db->insert_id();

        	for($i=0;$i<count($myitemid);$i++)
				   {  
				        
				         $res=$this->db->query("select * from phppos_items where name='".$myitemid[$i]."'");
				         $row = $res->row(); 
				         
				    if($res->num_rows()>0)
				    {
				        
				        $orgqt=$row->quantity;
				        
				        $newqtry=$qty[$i]+$orgqt;
				        // $updata = array(
				        // 	'category' => $item_cat[$i],
				        // 	'supplier_id' => $supp_id,
				        // 	'description' => $bill_date,
				        // 	'cost_price' => $cprice[$i],
				        // 	'unit_price' => $cprice[$i],
				        // 	'quantity' => $newqtry,
				        // 	'cost_price' => $cprice[$i],
				        // 	'hsn' => $hsn[$i],			        	
				        // 	 );
				        
            //             $this->db->where('item_number', $item_no[$i]);
            //             $update = $this->db->update('phppos_items',$updata );
                        $myautoid=$row->item_id;
				   
				    }else{

				    	$newinst = array(
				    		'name' => $myitemid[$i],
				    		'category' => $item_cat[$i],
				    		'supplier_id' => $supp_id,
				    		'item_number' => $item_no[$i],
				    		'description' => $bill_date,
				    		'cost_price' => $cprice[$i],
				    		'unit_price' => $crate[$i],
				    		'quantity' => $qty[$i],
				    		'hsn' => $hsn[$i],				    				        	
				        	'batch_no' => $batchno[$i]
				    		 );
				    	$additem=$this->db->insert('phppos_items',$newinst);
				        $myautoid=$this->db->insert_id();
				  
				   }

				   $sql="SELECT * FROM `product_stock` WHERE cat_id ='".$item_cat[$i]."' AND pid='".$item_no[$i]."'";
				   $query=$this->db->query($sql);
				   $row=$query->row();
				   $count=$query->num_rows();
				   if ($count) {
                   $_whr= array('cat_id' => $item_cat[$i],
				   		'pid' => $item_no[$i] );

                   $qnty=$row->stock+$qty[$i]+$scheme_qty[$i];


				   	$data = array('stock' => $qnty,);
					$this->db->where($_whr);
					$this->db->update('product_stock', $data);
				   }
				   else
				   {
				       $new_stock = $scheme_qty[$i]+$qty[$i];
				   	$data = array(
				   		'cat_id' => $item_cat[$i],
				   		'pid' => $item_no[$i],
				   		'stock' => $new_stock,
				   		);
					$this->db->insert('product_stock', $data);
				   }

				  $datainsert = array(
				  	'pur_id' => $pur_id, 
				  	'item_id' => $myautoid, 
				  	'qty' => $qty[$i], 
				  	'scheme_qty' => $scheme_qty[$i],
				  	'price' => $cprice[$i], 
				  	'hsn' => $hsn[$i],
				  	'batch_no' => $batchno[$i],
				  	'gst' => $GST[$i],
				  	'gst_amount' => $GST[$i],
				  	'dis' => $dis[$i],
				  	'dis_amount' => $dis[$i],
				  	'expiry_date' => $expirydate[$i],
					  'rate' =>$crate[$i] ,  
					  'totalamt' =>$ptotalamt[$i] ,  
				  ); 
				  $this->db->insert('phppos_purchase_details',$datainsert);
        }

	}
	$stflash = array(
						'type' => 'success', //error : success
						'FlashMassage' => '<div class="alert alert-success">Supplier Bill Created Successfully</div>',
						'Show' => 'Supplier Bill Created Successfully!',
						 );
					$this->session->set_flashdata($stflash);
	redirect(base_url('Supplier/View_Bill'));
}


    public function create_billTwo()
	{
		$bill_id=$this->input->post('bill_id',TRUE);
		$bill_date=$this->input->post('bill_date',TRUE);
		$supp_id=$this->input->post('supp_id',TRUE);
		$myitemid=$this->input->post('myitemid',TRUE);
		$item_cat=$this->input->post('item_cat',TRUE);
		$item_no=$this->input->post('item_no',TRUE);
		$cprice=$this->input->post('cprice',TRUE);
		$crate=$this->input->post('crate',TRUE);
		$ptotalamt=$this->input->post('ptotalamt',TRUE);
		$uprice="0";
		$qty=$this->input->post('qty',TRUE);
		$scheme_qty=$this->input->post('scheme_qty',TRUE);
		$totalqty=$this->input->post('totalqty',TRUE);
		$totalamt=$this->input->post('totalamt',TRUE);
		$payamt=$this->input->post('payamt',TRUE);
		$distype="";
		$discount="";
		$disamt="";
		$hsn=$this->input->post('batchno',TRUE);
		$gsttype="";
		$gstper="";
		$addgst="";
		$GST=$this->input->post('GST',TRUE);
		$dis=$this->input->post('discount',TRUE);
		$expirydate=$this->input->post('expirydate',TRUE);
		$batchno=$this->input->post('batchno',TRUE);
		$date=date('Y-m-d',strtotime($bill_date));

		$instdata = array(
			'bill_id' =>$bill_id , 
			'supp_id' =>$supp_id , 
			'date' =>$date , 
			'totalqty' =>$totalqty , 
			'totalamt' =>$totalamt , 
			'outstanding' =>$payamt , 
			'discount' =>$discount , 
			'payamt' =>$payamt , 
			'dis_type' =>$distype , 
			'disamt' =>$disamt , 
			'gsttype' =>$gsttype , 
			'gstper' =>$gstper , 
			'addgst' =>$addgst ,  
		);

		$qrypur=$this->db->insert('phppos_purchase',$instdata);
		
		if($qrypur)
        {
        	$pur_id=$this->db->insert_id();

        	for($i=0;$i<count($myitemid);$i++)
				   {  
				        
				         $res=$this->db->query("select * from phppos_items where name='".$myitemid[$i]."'");
				         $row = $res->row(); 
				         
				    if($res->num_rows()>0)
				    {
				        
				        $orgqt=$row->quantity;
				        
				        $newqtry=$qty[$i]+$orgqt;
				        // $updata = array(
				        // 	'category' => $item_cat[$i],
				        // 	'supplier_id' => $supp_id,
				        // 	'description' => $bill_date,
				        // 	'cost_price' => $cprice[$i],
				        // 	'unit_price' => $cprice[$i],
				        // 	'quantity' => $newqtry,
				        // 	'cost_price' => $cprice[$i],
				        // 	'hsn' => $hsn[$i],			        	
				        // 	 );
				        
            //             $this->db->where('item_number', $item_no[$i]);
            //             $update = $this->db->update('phppos_items',$updata );
                        $myautoid=$row->item_id;
				   
				    }else{

				    	$newinst = array(
				    		'name' => $myitemid[$i],
				    		'category' => $item_cat[$i],
				    		'supplier_id' => $supp_id,
				    		'item_number' => $item_no[$i],
				    		'description' => $bill_date,
				    		'cost_price' => $cprice[$i],
				    		'unit_price' => $crate[$i],
				    		'quantity' => $qty[$i],
				    		'hsn' => $hsn[$i],				    				        	
				        	'batch_no' => $batchno[$i]
				    		 );
				    	$additem=$this->db->insert('phppos_items',$newinst);
				        $myautoid=$this->db->insert_id();
				  
				   }

				   $sql="SELECT * FROM `product_stock` WHERE cat_id ='".$item_cat[$i]."' AND pid='".$item_no[$i]."'";
				   $query=$this->db->query($sql);
				   $row=$query->row();
				   $count=$query->num_rows();
				   if ($count) {
                   $_whr= array('cat_id' => $item_cat[$i],
				   		'pid' => $item_no[$i] );

                   $qnty=$row->stock+$qty[$i]+$scheme_qty[$i];


				   	$data = array('stock' => $qnty,);
					$this->db->where($_whr);
					$this->db->update('product_stock', $data);
				   }
				   else
				   {
				       $new_stock = $scheme_qty[$i]+$qty[$i];
				   	$data = array(
				   		'cat_id' => $item_cat[$i],
				   		'pid' => $item_no[$i],
				   		'stock' => $new_stock,
				   		);
					$this->db->insert('product_stock', $data);
				   }

				  $datainsert = array(
				  	'pur_id' => $pur_id, 
				  	'item_id' => $myautoid, 
				  	'qty' => $qty[$i], 
				  	'scheme_qty' => $scheme_qty[$i],
				  	'price' => $cprice[$i], 
				  	'hsn' => $hsn[$i],
				  	'batch_no' => $batchno[$i],
				  	'gst' => $GST[$i],
				  	'gst_amount' => $GST[$i],
				  	'dis' => $dis[$i],
				  	'dis_amount' => $dis[$i],
				  	'expiry_date' => $expirydate[$i],
					  'rate' =>$crate[$i] ,  
					  'totalamt' =>$ptotalamt[$i] ,  
				  ); 
				  $this->db->insert('phppos_purchase_details',$datainsert);
        }

	}
	$stflash = array(
						'type' => 'success', //error : success
						'FlashMassage' => '<div class="alert alert-success">Supplier Bill Created Successfully</div>',
						'Show' => 'Supplier Bill Created Successfully!',
						 );
					$this->session->set_flashdata($stflash);
	redirect(base_url('Supplier/View_Bill'));
}

public function Edit_SupplierBill($billid)
{

	if (isset($_POST['updtbtn'])) {

		$bill_id=$_POST['bill_id']; 
		$pur_id=$_POST['pur_id']; 
		//echo $bill_id."<br>";
		$bill_date=$_POST['bill_date'];
		$supp_id=$_POST['supp_id'];
		//echo $supp_id."<br>";

		$myitemid=$_POST['myitemid']; //name of item
		//print_r($myitemid);
		$item_cat=$_POST['item_cat'];
		//echo $item_cat."<br>"; //cat of item
		$item_no=$_POST['item_no']; 
		//echo $item_no."<br>";//Number of item
		$cprice=$_POST['cprice'];
		//print_r($cprice)."<br>";
		$uprice="0";
		//echo $uprice."<br>";
		$qty=$_POST['qty'];
		$totalqty=$_POST['totalqty'];
		$totalamt=$_POST['totalamt'];
		$payamt=$_POST['payamt'];
		$distype=$_POST['distype'];
		$discount=$_POST['per'];
		$disamt=$_POST['disamt'];
		$hsn=$_POST['hsn'];
		$itemname=$_POST['itemname'];

		$gsttype=$_POST['gsttype'];
		$gstper=$_POST['gstper'];
		$addgst=$_POST['addgst'];
		$date=date('Y-m-d');
		 $pay_status = $_POST['pay_status'];

		$getbill="SELECT amt FROM `phppos_purchase_payments` WHERE bill_no='".$pur_id."'";
		$gquery=$this->db->query($getbill);
		$aResult=$gquery->result();
		$outst=0;
		foreach ($aResult as $key => $res) {
			$outst=$outst+$res->amt;
		}

		$outstanding=$payamt-$outst;


		$instdata = array(
			'bill_id' =>$bill_id , 
			'supp_id' =>$supp_id , 
			'date' =>$date , 
			'totalqty' =>$totalqty , 
			'totalamt' =>$totalamt , 
			'outstanding' =>$outstanding , 
			'discount' =>$discount , 
			'payamt' =>$payamt , 
			'dis_type' =>$distype , 
			'disamt' =>$disamt , 
			'gsttype' =>$gsttype , 
			'gstper' =>$gstper , 
			'addgst' =>$addgst ,  
			'pay_status' => $pay_status,
		);

		$this->db->where('pur_id',$pur_id);
		$qrypur=$this->db->update('phppos_purchase',$instdata);
		
		if($qrypur)
        {
        	// $pur_id=$this->db->insert_id();

        	for($i=0;$i<count($myitemid);$i++)
				   {  
				        
				         $res=$this->db->query("select * from phppos_items where item_id='".$myitemid[$i]."'");
				         $row = $res->row(); 
				         
				    if($res->num_rows()>0)
				    {
				        
				        $orgqt=$row->quantity;
				        
				        $newqtry=$qty[$i]+$orgqt;
				        $updata = array(
				        	'category' => $item_cat[$i],
				        	'supplier_id' => $supp_id,
				        	'description' => $bill_date,
				        	'cost_price' => $cprice[$i],
				        	'unit_price' => $cprice[$i],
				        	'quantity' => $newqtry,
				        	'cost_price' => $cprice[$i],
				        	
				        	 );
				        
                        $this->db->where('item_id', $myitemid[$i]);
                        $update = $this->db->update('phppos_items',$updata );
                        $myautoid=$row->item_id;
				   
				    }else{

				    	$newinst = array(
				    		'name' => $itemname[$i],
				    		'category' => $item_cat[$i],
				    		'supplier_id' => $supp_id,
				    		'item_number' => $item_no[$i],
				    		'description' => $bill_date,
				    		'cost_price' => $cprice[$i],
				    		'unit_price' => $cprice[$i],
				    		'quantity' => $qty[$i],
				    		'hsn' => $hsn[$i],
				    		 );
				    	$additem=$this->db->insert('phppos_items',$newinst);
				        $myautoid=$this->db->insert_id();
				  
				   }

				   $prqty="SELECT qty FROM `phppos_purchase_details` WHERE item_id='".$myautoid."'";
					$qty_query=$this->db->query($prqty);
					$aResult=$qty_query->row();
					$prevqty=$aResult->qty;
					$newquntity=$prevqty-$qty[$i];

					 $sql="SELECT * FROM `product_stock` WHERE cat_id ='".$item_cat[$i]."' AND pid='".$item_no[$i]."'";
				   $query=$this->db->query($sql);
				   $row=$query->row();
				   $count=$query->num_rows();
				   if ($count) {
                   $_whr= array('cat_id' => $item_cat[$i],
				   		'pid' => $item_no[$i] );

                   $qnty=$row->stock-$newquntity;


				   	$data = array('stock' => $qnty,);
					$this->db->where($_whr);
					$this->db->update('product_stock', $data);
				   }


                   $deltedata = array('pur_id' => $pur_id, 
				  	'item_id' => $myautoid );
				  $this ->db->where($deltedata);
                  $this ->db->delete('phppos_purchase_details');

				  $datainsert = array(
				  	'pur_id' => $pur_id, 
				  	'item_id' => $myautoid, 
				  	'qty' => $qty[$i], 
				  	'price' => $cprice[$i], 
				  	'hsn' => $hsn[$i],
				  ); 
				  // $this->db->where('item_id',$myautoid);
				  $this->db->insert('phppos_purchase_details',$datainsert);
        }

	}
	$stflash = array(
						'type' => 'success', //error : success
						'FlashMassage' => '<div class="alert alert-success">Supplier Bill Edited Successfully</div>',
						'Show' => 'Supplier Bill Created Successfully!',
						 );
					$this->session->set_flashdata($stflash);
	             redirect(base_url('Supplier/Bill_Edit/'.$pur_id));
		
	}
	else
	{

		$data['supplier']=$this->Account_M->get_suppliers();
        $bills_data= $this->Supplier_M->getbill_details($billid);
		$data['bills_data']= $bills_data;
		$data['supplier_data']= $this->Supplier_M->getall_supplier_deatils($bills_data->supp_id);
		$data['getbill_product']=$this->Supplier_M->getbill_product($billid);

		$data['title']="Home :Account";
		$data['connect']="Account/Edit_SupplierBill";
		$this->load->view("partials/Dash_connect",$data);
		

	}
}
public function Bill_SupplierDelete($billid)
{

if(isset($billid)){
	               $deltedata = array('pur_id' => $billid );
				  $this ->db->where($deltedata);
                 $res= $this ->db->delete('phppos_purchase');
				 if($res)
				 {

					$delopt = array('pur_id' => $billid );
				    $this ->db->where($delopt);
                    $res1= $this ->db->delete('phppos_purchase_details');

					if($res1)
					{

						$stflash = array(
							'type' => 'error', //error : success
							'FlashMassage' => '<div class="alert alert-danger">Supplier Bill Deleted Successfully</div>',
							'Show' => 'Supplier Bill Deleted Successfully !',
							 );
						$this->session->set_flashdata($stflash);
					 redirect(base_url('Supplier/View_Bill'));

					}

					$stflash = array(
						'type' => 'error', //error : success
						'FlashMassage' => '<div class="alert alert-danger">Supplier Bill Deleted Successfully</div>',
						'Show' => 'Supplier Bill Deleted Successfully !',
						 );
					$this->session->set_flashdata($stflash);
	             redirect(base_url('Supplier/View_Bill'));

				 }
				 else{
					$stflash = array(
						'type' => 'error', //error : success
						'FlashMassage' => '<div class="alert alert-danger">Supplier Bill Not Deleted</div>',
						'Show' => 'Supplier Bill Not Deleted !',
						 );
					$this->session->set_flashdata($stflash);
	             redirect(base_url('Supplier/View_Bill'));
				 }
				}
				else
				{
					$stflash = array(
						'type' => 'error', //error : success
						'FlashMassage' => '<div class="alert alert-danger">Supplier Bill Not Selected</div>',
						'Show' => 'Supplier Bill Not Deleted !',
						 );
					$this->session->set_flashdata($stflash);
	             redirect(base_url('Supplier/View_Bill'));

				}
}

	public function productsearch()
	{
		$this->load->model('Account_M');
		$proname=$this->input->post('proname',true);
		$data['prodata']=$this->Account_M->productsearch($proname);		
		$this->load->view('purchase/pro_search',$data);
    }
	public function productdetails()
	{
		$this->load->model('Account_M');
		$proname=$this->input->post('proname',true);
		$prodata=$this->Account_M->productdetails($proname);

		// $this->load->view('purchase/pro_search_details',$data);
		echo json_encode($prodata);
    }

    public function Summary()
    {

    	$query=$this->db->query("SELECT sum(amt) as totalPurchase FROM `phppos_purchase_payments`");
    	 $row=$query->row();
    	echo $row->totalPurchase;

    	$suppquery=$this->db->query("SELECT * FROM `phppos_suppliers");
    	 $noofsupp=$suppquery->num_rows();
    	echo $noofsupp;

    	$bank=$this->db->query("SELECT * FROM `banks`");
    	 $nobank=$bank->num_rows();
    	echo $nobank;

    	$banktx=$this->db->query("SELECT * FROM `bank_transaction`");
    	 $nobanktx=$banktx->num_rows();
    	echo $nobanktx;

    	
    }
}
