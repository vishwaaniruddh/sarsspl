<?php
date_default_timezone_set('Asia/Kolkata');

defined('BASEPATH') or exit('No direct script access allowed');

class Doctors extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->checkLogin();
        $this->load->model('Account_M');
        // $this->load->model('Doctors_M');
        $this->load->model('Doctors_M');
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
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
                'Show' => 'Please Login First',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Login?redirecturl=' . urlencode($reffurl)));
        }
    }

    public function ManageDoctors()
    {
        $Doctors = array();
        $Doctorsdata = $this->Doctors_M->get_doctors();

        foreach ($Doctorsdata as $key => $doc) {
            $doc->data = $this->Doctors_M->getdoctorsdata($doc->person_id);
            array_push($Doctors, $doc);
        }
        $data['Doctors'] = $Doctors;
        $data['title'] = "Home :Doctors";
        $data['connect'] = "Doctors/ManageDoctors";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function AddNewDoctors()
    {
        $data['statelist'] = $this->Account_M->getstatelist();
        $data['title'] = "Home :Doctors";
        $data['connect'] = "Doctors/AddNewDoctors";
        $this->load->view("partials/Dash_connect", $data);
    }

    public function CreateNewDoctors()
    {
        $firstname = $this->input->post('firstname', true);
        $Lastname = $this->input->post('Lastname', true);
        $email = $this->input->post('email', true);
        $birthdate = $this->input->post('birthdate', true);
        // $dob = date('Y-m-d',strtotime($birthdate));
        $phonenumber = $this->input->post('phonenumber', true);
        $inputAddress = $this->input->post('inputAddress', true);
        $inputCity = $this->input->post('inputCity', true);
        $state = $this->input->post('state', true);
        $inputZip = $this->input->post('inputZip', true);
        $country = $this->input->post('country', true);

        // var_dump($_POST);
        // echo $dob;
        

        $pannumber = $this->input->post('pannumber', true);
        $gstno = $this->input->post('gstno', true);
        $comments = $this->input->post('comments', true);
        if ($firstname != '' && $phonenumber != '') {
            $person_data = array(
                'first_name' => $firstname,
                'last_name' => $Lastname,
                'email' => $email,
                'dob' => $birthdate,
                'phone_number' => $phonenumber,
                'address_1' => $inputAddress,
                'city' => $inputCity,
                'state' => $state,
                'zip' => $inputZip,
                'country' => $country,
                'pannumber' => $pannumber,
                'gstno' => $gstno,
                'comments' => $comments,
            );

            // var_dump($person_data); die;
            $addDoctors = $this->Doctors_M->Save($person_data);
            if ($addDoctors == '1') {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Add Doctor Details Successfully !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Doctors/Manage'));
            } else if ($addDoctors == '0') {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Doctor Details Not Addedd !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Doctors/New'));

            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-warning">Doctors Details Exist Already !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Doctors/New'));

            }

        } else {
            $stflash = array(
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Fill Phone Number And First name !</div>',
            );
            $this->session->set_flashdata($stflash);
            redirect(base_url('Doctors/New'));
        }
    }
    
    public function EditDoctors($person_id)
    {

        $updatebtn = $this->input->post('updatebtn', true);
        if (isset($updatebtn)) {
            $person_id = $this->input->post('person_id', true);
            $firstname = $this->input->post('firstname', true);
            $Lastname = $this->input->post('Lastname', true);
            $email = $this->input->post('email', true);
            // $birthdate = $this->input->post('birthdate', true);
            // $dob = date('Y/m/d',strtotime($birthdate));
            $phonenumber = $this->input->post('phonenumber', true);
            $inputAddress = $this->input->post('inputAddress', true);
            $inputAddress2 = $this->input->post('inputAddress2', true);
            $inputCity = $this->input->post('inputCity', true);
            $state = $this->input->post('state', true);
            $inputZip = $this->input->post('inputZip', true);
            $country = $this->input->post('country', true);
            
            $pannumber = $this->input->post('pannumber', true);
            $gstno = $this->input->post('gstno', true);
            $comments = $this->input->post('comments', true);
            $person_id = $this->input->post('person_id', true);
            $birthdate = $this->input->post('birthdate', true);
            // $dob = date('Y-m-d', strtotime($birthdate));
            if ($firstname != '' && $email != '') {
                $person_data = array(
                    'first_name' => $firstname,
                    'last_name' => $Lastname,
                    'email' => $email,
                    'phone_number' => $phonenumber,
                    'address_1' => $inputAddress,
                    'city' => $inputCity,
                    'state' => $state,
                    'zip' => $inputZip,
                    'country' => $country,
                    'pannumber' => $pannumber,
                    'gstno' => $gstno,
                    'comments' => $comments,
                    'person_id' => $person_id,
                    'dob' => $birthdate,
                );

                var_dump($person_data); die;
                $addDoctors = $this->Doctors_M->Update($person_data);
                if ($addDoctors) {
                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-success">Update Doctors Details Successfully !</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Doctors/Manage'));
                } else {
                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-danger">Doctors Details Not Updated !</div>',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Doctors/Edit/' . $person_id));

                }

            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Please Fille Email And Full name !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Doctors/New'));
            }
        } else {
            $data['Doctors'] = $this->Doctors_M->getall_doctors_deatils($person_id);
            $data['statelist'] = $this->Account_M->getstatelist();
            $data['title'] = "Home :Doctors";
            $data['connect'] = "Doctors/UpdateDoctors";
            $this->load->view("partials/Dash_connect", $data);

        }
    }
    public function ViewDoctors($person_id)
    {
        if (isset($person_id)) {
            $data['Doctors'] = $this->Doctors_M->getall_doctors_deatils($person_id);
            $data['statelist'] = $this->Account_M->getstatelist();
            $data['title'] = "Home :Doctors";
            $data['connect'] = "Doctors/ViewDoctors";
            $this->load->view("partials/Dash_connect", $data);

        } else {
            redirect(base_url('Doctors/Manage'));
        }
    }

    public function DeleteDoctors($person_id)
    {
        if (isset($person_id)) {
            $DeleteDoctors = $this->Doctors_M->DeleteDoctors($person_id);
            if ($DeleteDoctors) {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-success">Delete Doctors Details Successfully !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Doctors/Manage'));
            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Doctors Not Deleted !</div>',
                );
                $this->session->set_flashdata($stflash);
                redirect(base_url('Doctors/Edit/' . $person_id));

            }

        } else {
            redirect(base_url('Doctors/Manage'));
        }
    }
    
    
    
    
    
    
    
}
?>