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
            $price=$this->input->post('price',TRUE);
            $Batchno=$this->input->post('Batchno',TRUE);
            $expirydate=$this->input->post('expirydate',TRUE);
            $expirydate=date('Y-m-d H:s:a',strtotime($expirydate));
            $items = array(
                'name' => $productname, 
                'category' =>  $category, 
                'unit_price' => $price, 
                'batch_no' => $Batchno, 
                'expiry_date' => $expirydate, 
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

    public function Manage()
    {

        $prolits=$this->db->query("SELECT * FROM `phppos_items`");
        $data['Prolist']=$prolits->result();
        $data['Payment_details'] = $this->Payment_M->getpurchasepayment();
        $data['title']           = "Home :Account";
        $data['connect']         = "Product/ManageProduct";
        $this->load->view("partials/Dash_connect", $data);
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

   

  


}
