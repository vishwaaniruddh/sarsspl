<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Referral extends CI_Controller
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

     public function index()
     {

        $userid= $this->session->LoggedUserId;
        $getdata=$this->db->query("SELECT * FROM `greetings_referral_code` WHERE user_id='".$userid."' AND user_type='3' AND status='1'");
        $data['Refdata']=$getdata->row();
           
        $data['pagename']="Referral/SetReffralCode";
        $this->load->view('Layout/connect',$data);
        
     }
     public function CreateReferralCode()
     {
            $userid= $this->session->LoggedUserId;
            $userData= $this->AuthLog_M->getuserDeta($userid);
            $user_type="3";
            $free_limit="3";
            $limit="100";
            $reffral_code=$this->unique_code(8);
            $date=date('Y-m-d');

            $craetedby=$_SESSION['LoggedUserName'];

            $userData = array(
                        'code' => $reffral_code,
                        'limit'         => $limit,
                        'user_id'      => $userid,
                        'user_type'       => $user_type,
                        'created_at'     => $date,
                        'created_by'     => $craetedby,
                        'free_limit'     => $free_limit,
                    );

                    $success = $this->db->insert('greetings_referral_code', $userData);
                    if ($success) {
                         $stflash = array(
                            'type'         => 'error', //error : success
                            'FlashMassage' => '<div class="alert alert-success">Referral Code Created Successfully</div>',
                            'Show'         => 'First Login!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Referral'));
                    }
                    else
                    {

                    $stflash = array(
                            'type'         => 'error', //error : success
                            'FlashMassage' => '<div class="alert alert-danger">Something went To Wrong</div>',
                            'Show'         => 'First Login!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Referral'));
                    }
        
     }

     function unique_code($limit)
        {
          return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        }
    
}
