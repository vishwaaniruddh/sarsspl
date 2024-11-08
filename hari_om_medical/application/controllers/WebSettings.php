<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebSettings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->checkLogin();
        $this->load->model('Account_M');
        $this->load->model('Customers_M');
        $this->load->model('Payment_M');
        $this->load->model('Settings_M');
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

    public function ManageScheme()
    {

        $data['Schemes'] = $this->Settings_M->getSchemedetails();
        $data['title']    = "Home :Web Settings";
        $data['connect']  = "Settings/ManageScheme";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function AddScheme()
    {
	   if (isset($_POST['addScheme'])) {
	   	$SchemeName=$this->input->post('SchemeName',TRUE);
	   	$buy=$this->input->post('buy',TRUE);
	   	$free=$this->input->post('free',TRUE);

	   	$Scheme = array(
	   		'SchemeName' => $SchemeName,
	   		'buy' => $buy,
	   		'free' => $free,
	   		'SchemeName' => $SchemeName,
	   		 );
	   	$this->db->insert('Scheme',$Scheme);
	   	$stflash = array(
                        'type'         => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-success">Scheme Added Successfully!</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Settings/ManageScheme'));
	      	
	       
	    }
	    else
	    {
	    	$data['Schemes'] = $this->Settings_M->getSchemedetails();
	        $data['title']    = "Home :Web Settings";
	        $data['connect']  = "Settings/AddScheme";
	        $this->load->view("partials/Dash_connect", $data);
	    }
    }

    public function ManageSettings()
    {

        $data['Settings'] = $this->Settings_M->getSettingdetails(1);
        $data['title']    = "Home :Web Settings";
        $data['connect']  = "Settings/ManageSettings";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function UpdateSettings()
    {
        if ($_POST['addsettings']) {
            // var_dump($_POST);
            $Company_name = $this->input->post('Company_name', true);
            $logo         = $this->input->post('logo', true);
            $email        = $this->input->post('email', true);
            $Phone_no     = $this->input->post('Phone_no', true);
            $GST          = $this->input->post('GST', true);
            $PAN          = $this->input->post('PAN', true);
            $user_name    = $this->input->post('user_name', true);
            $Licence_no   = $this->input->post('Licence_no', true);
            $Address      = $this->input->post('Address', true);
            $setting_id   = $this->input->post('setting_id', true);
            $accountNumber   = $this->input->post('accountNumber', true);
            $BankName   = $this->input->post('BankName', true);
            $IFSCCode   = $this->input->post('IFSCCode', true);
            $slogan   = $this->input->post('slogan', true);
            $Jurisdiction   = $this->input->post('Jurisdiction', true);

            $oldlogo      = $this->input->post('oldlogo', true);

            if ($_FILES['logo']['size'] != 0 && $_FILES['logo']['error'] != 0) {

                $tempFile = $_FILES['logo']['tmp_name'];

                $allowed_image_extension = array(
                    "png",
                    "jpg",
                    "jpeg",
                );

                // Get image file extension
                $file_extension = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

                if (!in_array($file_extension, $allowed_image_extension)) {

                    $stflash = array(
                        'type'         => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-danger">Upload valiid images. Only PNG and JPEG are allowed.!</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Settings/ManageSettings'));

                } else {
                    $temp       = $_FILES["logo"]["name"];
                    $path_parts = pathinfo($temp);
                    $fileName   = 'logo.' . $path_parts['extension'];
                    $targetPath = 'assets/images/';
                    $targetFile = $targetPath . $fileName;

                    move_uploaded_file($tempFile, $targetFile);
                   

                }

            } else {
                $targetFile = $oldlogo;
            }

            $cdate = array(
                'Company_name'  => $Company_name,
                'logo'          => $targetFile,
                'email'         => $email,
                'Phone_no'      => $Phone_no,
                'GST'           => $GST,
                'PAN'           => $PAN,
                'user_name'     => $user_name,
                'Licence_no'    => $Licence_no,
                'Address'       => $Address,
                'accountNumber' => $accountNumber,
                'BankName'      => $BankName,
                'IFSCCode'      => $IFSCCode,
                'slogan'        => $slogan,
                'Jurisdiction'  => $Jurisdiction,
            );
            $this->db->where('setting_id', $setting_id);
            $this->db->update('web_setting', $cdate);

            $stflash = array(
                'type'         => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-success">Settings Updated Successfully !</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Settings/ManageSettings'));

            // $data['Settings']=$this->Settings_M->getSettingdetails(1);
            // $data['title']="Home :Web Settings";
            // $data['connect']="Settings/ManageSettings";
            // $this->load->view("partials/Dash_connect",$data);
        }
    }

}
