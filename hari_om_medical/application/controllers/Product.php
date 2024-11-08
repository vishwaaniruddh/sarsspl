<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->checkLogin();
        $this->load->model('Account_M');
        $this->load->model('Supplier_M');
        $this->load->model('Payment_M');
        $this->load->model('Product_M');
    }

    public function checkLogin()
    {
        $User_Id = $this->session->LogAdminId;
        if ($User_Id) {
            echo "";
        } else {
            if ($this->uri->uri_string()) {
                $reffurl = base_url($this->uri->uri_string());
            } else {
                $reffurl = base_url();
            }

            $stflash = array(
                'type'         => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
                'Show'         => 'Please Login First',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Login?redirecturl=' . urlencode($reffurl)));
        }
    }

    public function AddItem()
    {

        if(isset($_POST['addproduct']))
        {
            $productname=$this->input->post('productname',TRUE);
            $category=$this->input->post('category',TRUE);
            $desc=$this->input->post('description',TRUE);
            $hsn=$this->input->post('hsn',TRUE);
            $unit=$this->input->post('unit',TRUE);
            $rack=$this->input->post('rack',TRUE);
            $GST=$this->input->post('GST',TRUE);
            $items = array(
                'name' => $productname, 
                'category' =>  $category, 
                'description' => $desc, 
                'hsn' => $hsn, 
                'unit' => $unit, 
                'rack' => $rack, 
                'GST' => $GST, 
            );
            $this->db->insert('phppos_items', $items);
             $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Item Added Successfully!</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Product/Manage'));
        }
        else
        {
         $data['catlist'] = $this->Product_M->getcategory();
        $data['title']           = "Home :Account";
        $data['connect']         = "Product/AddItem";
        $this->load->view("partials/Dash_connect", $data);
    }
}
    public function ProductEdit($pro_id)
    {

        if(isset($_POST['Editproduct']))
        {
            $item_id=$this->input->post('item_id',TRUE);
            $productname=$this->input->post('productname',TRUE);
            $category=$this->input->post('category',TRUE);
            $desc=$this->input->post('description',TRUE);
            $hsn=$this->input->post('hsn',TRUE);
            $unit=$this->input->post('unit',TRUE);
            $qty=$this->input->post('qty',TRUE);
            $GST=$this->input->post('GST',TRUE);
            $items = array(
                'name' => $productname, 
                'category' =>  $category, 
                'description' => $desc, 
                'hsn' => $hsn, 
                'unit' => $unit, 
                'quantity' => $qty, 
                'GST' => $GST, 
            );
            $this->db->where('item_id', $item_id);
            $this->db->update('phppos_items', $items);
             $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Item Updated Successfully!</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Product/Manage'));
        }
        else
        {
         $data['product'] = $this->Product_M->getproduct($pro_id);
        $data['catlist'] = $this->Product_M->getcategory();
        $data['title']           = "Home :Account";
        $data['connect']         = "Product/Editproduct";
        $this->load->view("partials/Dash_connect", $data);;
        }
}

    public function Manage()
    {

        $prolits=$this->db->query("SELECT * FROM `phppos_items`");
        $data['Prolist']=$prolits->result();
        
        $data['Payment_details'] = $this->Payment_M->getpurchasepayment();
        $data['title']           = "Manage Product";
        $data['connect']         = "Product/ManageProduct";
        $this->load->view("partials/Dash_connect", $data);
    }
    
        public function ProductExpiry()
    {

        $prolits=$this->db->query("SELECT * FROM `phppos_items` order by item_id asc");
        $data['Prolist']=$prolits->result();
        // $itemid = $prolits->item_id;
        $data['Payment_details'] = $this->Payment_M->getpurchasepayment();
        // $data['Expiry_details'] = $this->Product_M->getallproductdetails($itemid);
        $data['title']           = "pRODUCT eXPIRY rEPORT";
        $data['connect']         = "Product/ProductExpiry";
        $this->load->view("partials/Dash_connect", $data);
    }
    
    public function ProductPurchaseDetail($itemid){
        
        if (isset($itemid)) {
            $data['Products'] = $this->Product_M->getproduct_details($itemid);
            // $data['statelist'] = $this->Product_M->get();
            $data['title'] = "Product Expiry details";
            $data['connect'] = "Product/ProductExpiryDetail";
            $this->load->view("partials/Dash_connect", $data);
        } else {
            redirect(base_url('Product/ProductExpiry'));
        }
    }

    public function ManageCategory()
    {

        $data['catlist'] = $this->Product_M->getcategory();
        $data['title']           = "Home :Account";
        $data['connect']         = "Product/ManageCategory";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function AddCategory()
    {

        if (isset($_POST['addcat'])) {
            $categoryname=$this->input->post("categoryname",TRUE);
            $item = array('category' => $categoryname,'typ'=>'1' );
            $this->db->insert('categories',$item);
            $stflash = array(
                    'type'         => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">category Added Successfully!</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Product/Category'));

        }
        else
        { 

        $data['catlist'] = $this->Product_M->getcategory();
        $data['title']           = "Home :Account";
        $data['connect']         = "Product/AddCategory";
        $this->load->view("partials/Dash_connect", $data);
      }
    }
    
    public function ProductExpiryDetail($pro_id)
    {
        
        $data['product'] = $this->Product_M->getproduct($pro_id);
        $data['catlist'] = $this->Product_M->getcategory();
        
        $purchasedet=$this->db->query("SELECT * FROM `phppos_purchase_details` where item_id = '".$pro_id."' order by expiry_date asc");
        $data['PurchaseDetails']=$purchasedet->result();
        
        // $data['purchase'] = $this->Product_M->getproduct_details($pro_id);
        $data['title']           = "Product Expiry Details";
        $data['connect']         = "Product/ProductExpiryDetail";
        $this->load->view("partials/Dash_connect", $data);;
        
    }

   

  


}
