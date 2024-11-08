<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('AuthLog_M');
    }

    public function index()
    {
        $User_Id = $this->session->LoggedUserId;
        if ($User_Id) {
            redirect(base_url());
        } else {
            $data['title'] = "Login Page";
            // $data['connect']="Auth/Login";
            $this->load->view("Auth/Login", $data);
        }
    }

    public function LoginAuth()
    {
        $Method = $this->input->method(true);
        if ($Method === 'POST') {
            $data['title'] = "Login Page";
            $UserName = $this->input->post('userName', true);
            $password = $this->input->post('password', true);
            $redircturl = $this->input->post('redircturl', true);
            $CheckUsename = $this->AuthLog_M->CheckUser($UserName);
            if ($CheckUsename) {
                $verify_login = $this->AuthLog_M->getuserDetails($UserName);
                if ($verify_login->status) {

                    $hash_password = $verify_login->password;
                    $hash_password = password_hash($hash_password, PASSWORD_DEFAULT);
                    // var_dump($hash_password)
                    $hash = password_verify($password, $hash_password);

                    if ($hash) {
                        $userdata = array(
                            'LoggedUserName' => "$verify_login->customer_name",
                            'LoggedUserId' => "$verify_login->customer_id",
                            'Loggeduserroll' => "$verify_login->status",
                            'Loggeduser' => true,
                        );
                        $this->session->set_userdata($userdata);
                        $stflash = array(
                            'type' => 'success', //error : success
                            'FlashMassage' => '<div class="alert alert-success">Welcome ' . $verify_login->customer_name . ' !</div>',
                            'Show' => 'Welcome ' . $verify_login->customer_name . ' !',
                        );
                        $this->session->set_flashdata($stflash);
                        // $this->AuthLog_M->User_act("Welcome ".$verify_login->emp_name." !");

                        //     check user session
                        $userid = $verify_login->customer_id;
                        $getsession = $this->AuthLog_M->getsessionDetails($userid);
                        $getsessioncount = $this->AuthLog_M->getsessioncount($userid);
                        if ($getsessioncount) {
                            $todatdate = date("Y-m-d");
                            $updateddate = $getsession->updated_date;
                            $ses_id = $getsession->id;

                            $activedays = $getsession->activedays;

                            if ($todatdate != $updateddate) {
                                $newactivedays = $activedays + 1;

                                $usesdata = array(
                                    'activedays' => $newactivedays,
                                    'updated_date' => $todatdate,
                                );
                                $this->db->where('id', $ses_id);
                                $this->db->update('customer_promotion_session', $usesdata);

                            }

                        } else {
                            $todatdate = date("Y-m-d");
                            $newactivedays = 1;

                            $usesdata = array(
                                'user_id' => $userid,
                                'activedays' => $newactivedays,
                                'updated_date' => $todatdate,
                            );
                            $this->db->insert('customer_promotion_session', $usesdata);
                        }

                        if ($redircturl != '') {
                            redirect($redircturl);
                        } else {
                            redirect(base_url());
                        }
                    } else {
                        $this->session->set_flashdata('FlashMassage', '<div class="alert alert-danger">Incorrect Login Name -' . $UserName . ' </div>');
                        // redirect(base_url('Login'));
                        redirect(base_url('Login?redirecturl=' . urlencode($redircturl)));
                    }

                } else {
                    $this->session->set_flashdata('FlashMassage', '<div class="alert alert-danger">Account Not Active ('. $UserName . ') ! Please Contact to Support Team </div>');
                    // redirect(base_url('Login'));
                    redirect(base_url('Login?redirecturl=' . urlencode($redircturl)));
                }

            } else {
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">User Not Found</div>',
                    'Show' => 'User Not Found',
                );
                $this->session->set_flashdata($stflash);
                // redirect(base_url('Login'));
                redirect(base_url('Login?redirecturl=' . urlencode($redircturl)));
            }
        } else {
            $stflash = array(
                'type' => 'error', //error : success
                'FlashMassage' => '<div class="alert alert-danger">Please Login First</div>',
                'Show' => 'Please Login First',
            );
            $this->session->set_flashdata($stflash);
            // redirect(base_url('Login'));
            redirect(base_url('Login?redirecturl=' . urlencode($redircturl)));
        }

    }

    public function Logout()
    {
        // $this->AuthLog_M->User_act("Logout Successfully");
        $data = array('LoggedUserId', 'Loggeduserroll', 'Loggeduser', 'LoggedUserName');
        $this->session->unset_userdata($data);
        $this->session->set_flashdata('successMessage', '<div class="alert alert-success">Logout Successfully</div>');
        redirect(base_url('Login'));
    }
}
