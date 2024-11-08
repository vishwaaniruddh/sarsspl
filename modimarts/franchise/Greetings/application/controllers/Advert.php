<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Advert extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('AuthLog_M');
        $this->load->model('Promotion_M');
        $this->load->model('Register_M');
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

     public function AddNew()
     {

        if (isset($_POST['RegisterForm'])) {
            

        
                    $insert_id = $this->session->LoggedUserId; 

                        $client_name = $this->input->post('Adsname', true);
                        $upload_type = $this->input->post('uploadtype', true);
                        $upload_category = $this->input->post('advttype', true);
                        $bottom_percentage = $this->input->post('bottomportion', true);
                        $give_advertisement = $this->input->post('giveadvt', true);
                        $total_person = $this->input->post('namberofperson', true);
                        $total_days = $this->input->post('namberofdays', true);
                        $total_advertisement = $this->input->post('totaladvertisement', true);
                        $gender = $this->input->post('gender', true);
                        $age = $this->input->post('age', true);
                        $visible_location = $this->input->post('fullname', true);
                        $min_income = $this->input->post('minimunIncome', true);
                        $max_income = $this->input->post('maximumIncome', true);
                        $mobile_no = $this->input->post('phoneno', true);
                        $password = $this->input->post('Password', true);
            
                        if (isset($_FILES['image']["name"])) {
                            $tempFile = $_FILES['image']['tmp_name'];
                            $temp = $_FILES["image"]["name"];
                            $ext = pathinfo($temp, PATHINFO_EXTENSION);
                            $t = md5(time());
                            $fileName = $t . '.' . $ext;
                            $targetPath1 = "assets/upload/";
                            $targetPath = "assets/upload/";
                            $upload_design = $targetPath . $fileName;
                            $targetFile1 = $targetPath1 . $fileName;
                            move_uploaded_file($tempFile, $targetFile1);
                        } else {
                            $upload_design = '';
                        }
            
            
                        $country = $this->input->post('country', true);
                        $zone = $this->input->post('zone', true);
                        $State = $this->input->post('State', true);
                        $Division = $this->input->post('Division', true);
                        $district = $this->input->post('district', true);
                        $taluka = $this->input->post('taluka', true);
                        $pincode = $this->input->post('pincode', true);
            
            
                        if ($country != '') {
                            $level = $this->country_name($country);
                            $ap = $country;
                            if ($zone != '') {
                                $level = $this->zone_name($zone);
                                $ap = $zone;
                                if ($State != '') {
                                    $level = $this->state_name($State);
                                    $ap = $State;
                                    if ($Division != '') {
                                        $level = $this->division_name($Division); 
                                        $ap = $Division;
                                        if ($district != '') {
                                            $level = $this->district_name($district);
                                            $ap = $district;
                                            if ($taluka != '') {
                                                $level = $this->taluka_name($taluka);
                                                $ap = $taluka;
                                                if ($pincode != '') {
                                                    $level = $this->pincode_name($pincode);
                                                    $ap = $pincode;
                                                    if ($village != '') {
                                                        $level = $this->village_name($village);
                                                        $ap = $village;}
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            $level = '';
                            $ap = '';
                        }
            
            
            
                        $advetazing = array(
                            'client_name' => $client_name, 
                            'upload_type' => $upload_type, 
                            'upload_design' => $upload_design, 
                            'upload_category' => $upload_category, 
                            'bottom_percentage' => $bottom_percentage, 
                            'give_advertisement' => $give_advertisement, 
                            'total_person' => $total_person, 
                            'total_days' => $total_days, 
                            'total_advertisement' => $total_advertisement, 
                            'gender' => $gender, 
                            'visible_location' => $ap, 
                            'location_name' => $level, 
                            'min_income' => $min_income, 
                            'mobile_no' => $mobile_no, 
                            'max_income' => $max_income, 
                            'password' => $password, 
                            'age' => $age, 
                            'greeting_id' => $insert_id, 
                        );
             
                       $indata= $this->db->insert('greetings_advertiser_list',$advetazing);

                        if($indata)
                        {
                            $stflash = array(
                                'type' => 'error', //error : success
                                'FlashMassage' => '<div class="alert alert-success">Advertisement Added Successfully</div>',
                                'Show' => 'Advertisement Added Successfully!',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Advt/AddNew'));

                        }
                        else
                        {
                            $stflash = array(
                                'type' => 'error', //error : success
                                'FlashMassage' => '<div class="alert alert-danger">Something Went to Wrong ! Please Try again</div>',
                                'Show' => 'Something Went to Wrong',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Advt/AddNew'));
                        }
            
                    
              

          
        } else {
                     
        $data['pagename']="Advert/AddNew";
        $this->load->view('Layout/connect',$data);
        }

        
        
     }


     
   public function country_name($id)
   {
    
   
       $sql        = $this->db->query("select * from new_country where id = '" . $id . "'");
       $sql_result = $sql->row();
   
       return $sql_result->country;
   }
   
   public function zone_name($id)
   {
   
       
   
       $sql        = $this->db->query("select * from new_zone where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->zone;
   }
   
   public function state_name($id)
   {
   
       
   
       $sql        = $this->db->query("select * from new_state where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->state;
   }
   
   public function division_name($id)
   {
   
       
   
       $sql        = $this->db->query("select * from new_division where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->division;
   }
   
   public function district_name($id)
   {
   
       
   
       $sql        = $this->db->query("select * from new_district where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->district;
   }
   
   public function taluka_name($id)
   {
   
       
   
       $sql        = $this->db->query("select * from new_taluka where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->taluka;
   }
   
   public function pincode_name($id)
   {
   
       
   
       $sql        = $this->db->query("select * from new_pincode where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->pincode;
   }
   
   public function village_name($id)
   {
   
       $sql        = $this->db->query("select * from new_village where id = '" . $id . "'");
       $sql_result = $sql->row();
       return $sql_result->village;
   }
    
    
}
