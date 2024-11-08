<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');    
    $this->load->model('AuthLog_M');    
    $this->load->model('Promotion_M');    
    $this->checkLogin();    
  } 

  public function checkLogin()
  {
    $User_Id = $this->session->LoggedUserId;
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
      // echo "Not Login";           
    }
  }

  
  public function index()
  {

    $this->load->model('Promotion_M');
    $data['promotion']=$this->Promotion_M->getallgreetings();
    $totaldownloadcount = 0;
    $download_image_count=$this->Promotion_M->getdownloadimagecountbyUserid($this->session->LoggedUserId);
    foreach($download_image_count as $image_count){
        $count = $image_count->download_count;
        $totaldownloadcount = $totaldownloadcount + $count;
    }
    $data['download_image_count'] = $totaldownloadcount;

    $data['pagename']="Layout/index";
    $this->load->view('Layout/connect',$data);
  }

  public function EditProfile()
  {

    $userid= $this->session->LoggedUserId;
    $userData= $this->AuthLog_M->getuserDeta($this->session->LoggedUserId);;

    if(isset($_POST['ChangePass']))
    {

      $currentPass=$this->input->post('oldpassword');
      $newPass=$this->input->post('password');
      $confirmPass=$this->input->post('con-password');

      $oldpass=$userData->password;

      if($oldpass==$currentPass)
      {
        if ($newPass==$confirmPass) {

          $uppass = array(
            'password' => $newPass,
             );
          $this->db->where('customer_id',$userid);
          $updata=$this->db->update('customer_promotion',$uppass);
          if ($updata) {
            $this->session->set_flashdata('FlashMassage','<div class="alert alert-success alert-dismissible">Password Updated successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button></div>');
          redirect(base_url('User/EditProfile')); 
          }
          else
          {
            $this->session->set_flashdata('FlashMassage','<div class="alert alert-danger alert-dismissible">Password Not Updated<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button></div>');
          redirect(base_url('User/EditProfile')); 

          }
          
        }
        else
        {
          $this->session->set_flashdata('FlashMassage','<div class="alert alert-danger alert-dismissible">New & Confirm  Password Enter by You Not Match<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button></div>');
          redirect(base_url('User/EditProfile')); 
        }

      }
      
      else
      {

        $this->session->set_flashdata('FlashMassage','<div class="alert alert-danger alert-dismissible">You Enter Current Password Wronged<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button></div>');
          redirect(base_url('User/EditProfile'));  
      } 
    }
    else if(isset($_POST['UpdateData']))
      {
      

        $email=$this->input->post('email');
        $content=$this->input->post('content');
        $content1=$this->input->post('content1');
        $content2=$this->input->post('content2');
        $content3=$this->input->post('content3');
        
        $website=$this->input->post('website');
        $designation=$this->input->post('designation');
        
        $mobile=$this->input->post('mobile');

        if (isset($_FILES['image']["name"])) {

        $tempFile = $_FILES['image']['tmp_name'];

        $temp = $_FILES["image"]["name"];
          $ext =  pathinfo($temp, PATHINFO_EXTENSION);
          $t =md5(time());
          $fileName =  $t . '.' . $ext;
          $targetPath1 = "/home/allmart/public_html/franchise/promotions_cms/customer_promotion/upload/";
          $targetPath = "/upload/";
          $targetFile = $targetPath . $fileName ;
          $targetFile1 = $targetPath1 . $fileName ;


        move_uploaded_file($tempFile, $targetFile1);
      }
      else
      {
        $targetFile=$this->input->post('oldimg');
      }
      
      
       if ($_FILES['logo']["name"]!='') {
     

        $tempFile1 = $_FILES['logo']['tmp_name'];

        $temp1 = $_FILES["logo"]["name"];
          $ext1 =  pathinfo($temp1, PATHINFO_EXTENSION);
          $t =md5(time());
          $fileName1 =  $t . '.' . $ext1;
          $targetPath22 = "/home/allmart/public_html/franchise/promotions_cms/customer_promotion/logo/";
          $targetPath2 = "/logo/";
          $targetFile2 = $targetPath2 . $fileName1 ;
          $targetFile22 = $targetPath22 . $fileName1 ;


        move_uploaded_file($tempFile1, $targetFile22);
      }
      else
      {
        $targetFile2=$_POST['oldlogo'];
      }
      
      
       if ($_FILES['footer_image']["name"]!='') {
     

           $tempFile3 = $_FILES['footer_image']['tmp_name'];

          $temp3 = $_FILES["logo"]["name"];
          $ext3 =  pathinfo($temp3, PATHINFO_EXTENSION);
          $t =md5(time());
          $fileName3 =  $t . '.' . $ext3;
          $targetPath33 = "/home/allmart/public_html/franchise/promotions_cms/customer_promotion/footer_image/";
          $targetPath3 = "/footer_image/";
          $targetFile3 = $targetPath3 . $fileName3 ;
          $targetFile33 = $targetPath33 . $fileName3 ;


        move_uploaded_file($tempFile3, $targetFile33);
      }
      else
      {
        $targetFile3=$_POST['oldfooter_image'];
      }
      
 

        $userdata = array(
          
          'email' =>$email ,
          'website' =>$website ,
          'designation' =>$designation ,
          'content' =>$content ,
          'content1' =>$content1 ,
          'content2' =>$content2 ,
          'content3' =>$content3 ,
          'image' =>$targetFile ,
          'logo' =>$targetFile2 ,
          'footer_image' =>$targetFile3 ,
           );

        $this->db->where('customer_id',$userid);
        $updata=$this->db->update('customer_promotion',$userdata);

        $this->session->set_flashdata('FlashMassage','<div class="alert alert-success alert-dismissible">User Deatils Updated successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button></div>');
          redirect(base_url('User/EditProfile')); 

      }

    else{
        $this->load->model('AuthLog_M');;
        $data['userData']= $this->AuthLog_M->getuserDeta($this->session->LoggedUserId);;
        $data['pagename']="Users/EditProfile";
        $this->load->view('Layout/connect',$data);
  }
  }
  
  public function RegisterUser()
  {
    //   if(isset($_POST))
    //   {
          
    //   }
    //   else
    //   {
        // $data['Country'] = $this->AuthLog_M->getCountry();
        // $data['Zone']    = $this->AuthLog_M->getZone();
        // $data['State']   = $this->AuthLog_M->getstate();
        // $data['Division']= $this->AuthLog_M->getdivision();
        // $data['District']= $this->AuthLog_M->getdistrict();
        // $data['Taluka']  = $this->AuthLog_M->gettaluka();
        // $data['Pincode'] = $this->AuthLog_M->getpincode();
        // $data['Village'] = $this->AuthLog_M->getvillage();
        
        $data['Pagename']="Register";
        $this->load->view('Users/Register',$data);
          
    //   }
  }


}
