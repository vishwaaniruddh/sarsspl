<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('AuthLog_M');
        $this->load->model('Promotion_M');
        $this->load->model('Register_M');
    }

    public function RegisterUser()
    {

        if (isset($_POST['RegisterForm'])) {

            $ReffralCode = $this->input->post('ReffralCode', true);
            $mobilenumber = $this->input->post('phoneno', true);
            $CheckNo = $this->Register_M->CheckUser($mobilenumber);
            if ($CheckNo == 0) {

                $fullname = $this->input->post('fullname', true);
                $Password = $this->input->post('Password', true);
                $emailid = $this->input->post('emailid', true);
                $ReffralCode = $this->input->post('ReffralCode', true);

                if ($ReffralCode !== '') {

                    $Checknoofref = $this->Register_M->Checknoofref($ReffralCode);
                    $refdata = $this->Register_M->refdetails($ReffralCode);

                    if (isset($refdata->limit)) {
                        $limit = $refdata->limit;
                        $free_limit = $refdata->free_limit;
                        $free_limit = $free_limit;
                    } else {
                        $free_limit = 0;
                        $limit = 1;

                    }
                } else {
                    $free_limit = 0;
                    $Checknoofref = 1;
                    $limit = 1;
                }

                if ($Checknoofref <= $limit) {

                    $userData = array(
                        'customer_name' => $fullname,
                        'email' => $emailid,
                        'password' => $Password,
                        'refcode' => $ReffralCode,
                        'mobile_number' => $mobilenumber,
                        'valid_for' => $free_limit,
                    );

                    $success = $this->db->insert('customer_promotion', $userData);

                    if ($success) {
                        $stflash = array(
                            'type' => 'error', //error : success
                            'FlashMassage' => '<div class="alert alert-success">Welcome ' . $fullname . ' ! Please Login Again</div>',
                            'Show' => 'First Login!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Login'));
                    } else {
                        $stflash = array(
                            'type' => 'error', //error : success
                            'FlashMassage' => '<div class="alert alert-danger">Something Went to Wrong ! Please Try again</div>',
                            'Show' => 'Something Went to Wrong',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Register/RegisterFranchise?refcode=' . $ReffralCode));

                    }
                } else {
                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-danger">Invalid Reffral Code !</div>',
                        'Show' => 'Invalid Reffral Code!',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Login'));
                }

            } else {
                // User Alraedy Esits
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Mobile Number Already Registred!  Please Change And Register Again</div>',
                    'Show' => 'Something Went to Wrong',
                );
                $this->session->set_flashdata($stflash);

                redirect(base_url('Register/RegisterFranchise?refcode=' . urlencode($ReffralCode)));
            }
        } else {
            $data['Pagename'] = "Register";
            $this->load->view('Users/Register', $data);

        }

    }

    public function RegisterFranchise()
    {

        if (isset($_POST['RegisterForm'])) {

            $ReffralCode = $this->input->post('ReffralCode', true);
            $mobilenumber = $this->input->post('phoneno', true);
            $CheckNo = $this->Register_M->CheckUser($mobilenumber);
            if ($CheckNo == 0) {

                $fullname = $this->input->post('fullname', true);
                $Password = $this->input->post('Password', true);
                $emailid = $this->input->post('emailid', true);
                $ReffralCode = $this->input->post('ReffralCode', true);
                $address = $this->input->post('address', true);
                $country = $this->input->post('country', true);
                $zone = $this->input->post('zone', true);
                $State = $this->input->post('State', true);
                $Division = $this->input->post('Division', true);
                $district = $this->input->post('district', true);
                $taluka = $this->input->post('taluka', true);
                $pincode = $this->input->post('pincode', true);
                $village = $this->input->post('village', true);

                $getpincode = $this->db->query("SELECT id FROM new_pincode WHERE pincode ='" . $pincode . "' and status=1");
                $pincodedata = $getpincode->row();
                $pincode = $pincodedata->id;

                if ($ReffralCode !== '') {

                    $Checknoofref = $this->Register_M->Checknoofref($ReffralCode);
                    $refdata = $this->Register_M->refdetails($ReffralCode);

                    if (isset($refdata->user_id)) {
                        $limit = $refdata->limit;
                        $free_limit = $refdata->free_limit;
                        $user_id = $refdata->user_id;
                        $created_by = $refdata->created_by;
                        $free_limit = $refdata->free_limit;

                        $free_limit = $free_limit;
                        // } else {
                        //     $free_limit = 0;
                        //     $limit      = 1;

                        // }

                        if ($Checknoofref <= $limit) {

                            if (isset($_FILES['image']["name"])) {

                                $tempFile = $_FILES['image']['tmp_name'];

                                $temp = $_FILES["image"]["name"];
                                $ext = pathinfo($temp, PATHINFO_EXTENSION);
                                $t = md5(time());
                                $fileName = $t . '.' . $ext;
                                $targetPath1 = "/home/allmart/public_html/franchise/promotions_cms/customer_promotion/upload/";
                                $targetPath = "/upload/";
                                $targetFile = $targetPath . $fileName;
                                $targetFile1 = $targetPath1 . $fileName;

                                move_uploaded_file($tempFile, $targetFile1);
                            } else {
                                $targetFile = '';
                            }

                            $userData = array(
                                'customer_name' => $fullname,
                                'email' => $emailid,
                                'password' => $Password,
                                'refcode' => $ReffralCode,
                                'mobile_number' => $mobilenumber,
                                'valid_for' => $free_limit,
                                'image' => $targetFile,
                                'is_franchisee' => '1',
                            );

                            $success = $this->db->insert('customer_promotion', $userData);
                            $insert_id = $this->db->insert_id();
                            if ($success) {
                                if ($country != '') {
                                    $level = 1;
                                    $ap = "country";
                                    if ($zone != '') {
                                        $level = 2;
                                        $ap = "zone";
                                        if ($State != '') {
                                            $level = 3;
                                            $ap = "state";
                                            if ($Division != '') {
                                                $level = 4;
                                                $ap = "division";
                                                if ($district != '') {
                                                    $level = 5;
                                                    $ap = "district";
                                                    if ($taluka != '') {
                                                        $level = 6;
                                                        $ap = "taluka";
                                                        if ($pincode != '') {
                                                            $level = 7;
                                                            $ap = "pincode";
                                                            if ($village != '') {
                                                                $level = 8;
                                                                $ap = "village";}
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                                $franchise = array(
                                    'name' => $fullname,
                                    'password' => $Password,
                                    'mobile' => $mobilenumber,
                                    'intro_id' => $user_id,
                                    'introducer_name' => $created_by,
                                    'star' => $level,
                                    'position_name' => $ap,
                                    'email' => $emailid,
                                    'greeting_id' => $insert_id,
                                    'country' => $country,
                                    'zone' => $zone,
                                    'state' => $State,
                                    'division' => $Division,
                                    'district' => $district,
                                    'taluka' => $taluka,
                                    'village' => $village,
                                    'pincode' => $pincode,
                                    'location' => $address,
                                    'status' => '1',
                                );

                                $success1 = $this->db->insert('greetings_member', $franchise);
                                if ($success1) {
                                    $stflash = array(
                                        'type' => 'error', //error : success
                                        'FlashMassage' => '<div class="alert alert-success">Welcome ' . $fullname . ' ! Please Login Again</div>',
                                        'Show' => 'First Login!',
                                    );
                                    $this->session->set_flashdata($stflash);
                                    redirect(base_url('Login'));
                                } else {
                                    $stflash = array(
                                        'type' => 'error', //error : success
                                        'FlashMassage' => '<div class="alert alert-danger">Something Went to Wrong ! Please Try again</div>',
                                        'Show' => 'Something Went to Wrong',
                                    );
                                    $this->session->set_flashdata($stflash);
                                    redirect(base_url('User/Register?refcode=' . $ReffralCode));

                                }

                            } else {
                                $stflash = array(
                                    'type' => 'error', //error : success
                                    'FlashMassage' => '<div class="alert alert-danger">Something Went to Wrong ! Please Try again</div>',
                                    'Show' => 'Something Went to Wrong',
                                );
                                $this->session->set_flashdata($stflash);
                                redirect(base_url('User/Register?refcode=' . $ReffralCode));

                            }

                        } else {
                            $stflash = array(
                                'type' => 'error', //error : success
                                'FlashMassage' => '<div class="alert alert-danger">Invalid Reffral Code !</div>',
                                'Show' => 'Invalid Reffral Code!',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Login'));
                        }
                    } else {
                        $stflash = array(
                            'type' => 'error', //error : success
                            'FlashMassage' => '<div class="alert alert-danger">Invalid Reffral Code !</div>',
                            'Show' => 'Invalid Reffral Code!',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Login'));
                    }
                } else {
                    // $free_limit   = 0;
                    // $Checknoofref = 1;
                    // $limit        = 1;

                    $stflash = array(
                        'type' => 'error', //error : success
                        'FlashMassage' => '<div class="alert alert-danger">Please Enter Reffral Code !</div>',
                        'Show' => 'Invalid Reffral Code!',
                    );
                    $this->session->set_flashdata($stflash);
                    redirect(base_url('Login'));
                }

            } else {
                // User Alraedy Esits
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Mobile Number Already Registred!  Please Change And Register Again</div>',
                    'Show' => 'Something Went to Wrong',
                );
                $this->session->set_flashdata($stflash);

                redirect(base_url('User/Register?refcode=' . urlencode($ReffralCode)));
            }
        } else {
            $data['Pagename'] = "Register";
            $this->load->view('Users/RegisterFranchise', $data);

        }
    }

    public function RegAdvertiser()
    {
        if (isset($_POST['RegisterForm'])) {
            


            $mobile_no = $this->input->post('phoneno', true);
            $CheckNo = $this->Register_M->CheckUser($mobile_no);
            if ($CheckNo == 0) {

                $fullname = $this->input->post('fullname', true);
                $Password = $this->input->post('Password', true);
                $emailid = $this->input->post('emailid', true);

                

               

                    $userData = array(
                        'customer_name' => $fullname,
                        'email' => $emailid,
                        'password' => $Password,
                        'mobile_number' => $mobile_no,
                        'is_franchisee' => '3',
                    );

                    $success = $this->db->insert('customer_promotion', $userData);
                    $insert_id = $this->db->insert_id();

                    if ($success) {


                        $client_name = $this->input->post('fullname', true);
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
                                'FlashMassage' => '<div class="alert alert-success">Welcome ' . $fullname . ' ! Please Login Again</div>',
                                'Show' => 'First Login!',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Login'));

                        }
                        else
                        {
                            $stflash = array(
                                'type' => 'error', //error : success
                                'FlashMassage' => '<div class="alert alert-danger">Something Went to Wrong ! Please Try again</div>',
                                'Show' => 'Something Went to Wrong',
                            );
                            $this->session->set_flashdata($stflash);
                            redirect(base_url('Advt/Register'));
                        }
            
                       
                    } else {
                        $stflash = array(
                            'type' => 'error', //error : success
                            'FlashMassage' => '<div class="alert alert-danger">Something Went to Wrong ! Please Try again</div>',
                            'Show' => 'Something Went to Wrong',
                        );
                        $this->session->set_flashdata($stflash);
                        redirect(base_url('Advt/Register'));

                    }
              

            } else {
                // User Alraedy Esits
                $stflash = array(
                    'type' => 'error', //error : success
                    'FlashMassage' => '<div class="alert alert-danger">Mobile Number Already Registred!  Please Change And Register Again</div>',
                    'Show' => 'Something Went to Wrong',
                );
                $this->session->set_flashdata($stflash);

                redirect(base_url('Advt/Register'));
             }
        } else {
            $data['Pagename'] = "Register";
            $this->load->view('Users/AdvertUser', $data);
        }

    }

    public function getpincode()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_pincode WHERE pincode like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->pincode;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }

    public function getvillage1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_pincode WHERE pincode like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->pincode;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }
    public function gettaluka1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_taluka WHERE taluka like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->taluka;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }

    public function getdistrict1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_district WHERE district like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->district;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }

    public function getdivision1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_division WHERE division like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->division;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }
    public function getState1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_state WHERE state like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->state;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }
    public function getZone1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_zone WHERE zone like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->zone;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }
    public function getCountry1()
    {
        $keyword = strval($_POST['query']);
        $search_param = "{$keyword}%";
        $getsql = $this->db->query("SELECT * FROM new_country WHERE country like '" . $search_param . "' and status=1");
        $result = $getsql->result();
        foreach ($result as $key => $value) {
            $id = $value->id;
            $pincode = $value->country;
            $countryResult[] = ['id' => $id, 'name' => $pincode];
        }
        echo json_encode($countryResult);
    }

    public function getvillage()
    {
        $pincode = trim($_POST['query']);
        $promotions = $this->db->query("SELECT village FROM greetings_member WHERE pincode = '" . $pincode . "' AND status='1'");
        $pindata = $promotions->result();
        $proids = array();
        array_push($proids, 0);
        foreach ($pindata as $key => $promo) {
            $promoid = $promo->village;
            array_push($proids, $promoid);
        }
        $List = implode(', ', $proids);
        $getsql = $this->db->query("SELECT * FROM new_village WHERE pincode = '" . $pincode . "'  AND id NOT IN ($List) AND status='1' LIMIT 0,1");
        $result = $getsql->row();
        $return = $result->id;
        echo json_encode($return);
    }

    public function getnoofvilage()
    {
        $pincode = trim($_POST['query']);
        $promotions = $this->db->query("SELECT village FROM greetings_member WHERE pincode = '" . $pincode . "' AND status='1'");
        $pindata = $promotions->result();
        $proids = array();
        array_push($proids, 0);
        foreach ($pindata as $key => $promo) {
            $promoid = $promo->village;
            array_push($proids, $promoid);
        }
        $List = implode(', ', $proids);
        $getsql = $this->db->query("SELECT * FROM new_village WHERE pincode = '" . $pincode . "' AND id NOT IN ($List) AND status='1'");
        $result = $getsql->num_rows();

        echo json_encode($result);
    }

    public function gettaluka()
    {
        $keyword = strval($_POST['query']);
        $getfirst = $this->db->query("SELECT * FROM new_pincode WHERE id = '" . $keyword . "' AND status='1'");
        $pincode = $getfirst->row();
        $data1 = $pincode->taluka;
        $getsql = $this->db->query("SELECT * FROM new_taluka WHERE id = '" . $data1 . "' AND status='1' ");
        $result = $getsql->result();
        $html = '<select class="form-control">';
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            $html .= "<option value='" . $value->id . "' " . $sel . " >" . $value->taluka . "</option>";
        }
        $html .= "</select>";
        echo json_encode($html);
    }

    public function getdistrict()
    {
        $keyword = strval($_POST['query']);

        $getfirst = $this->db->query("SELECT * FROM new_taluka WHERE id = '" . $keyword . "' AND status='1'");
        $pincode = $getfirst->row();
        $data1 = $pincode->district;
        $getsql = $this->db->query("SELECT * FROM new_district WHERE id = '" . $data1 . "' AND status='1'");
        $result = $getsql->result();
        $html = '<select class="form-control">';
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            $html .= "<option value='" . $value->id . "' " . $sel . " >" . $value->district . "</option>";
        }
        $html .= "</select>";
        echo json_encode($html);
    }

    public function getdivision()
    {
        $keyword = strval($_POST['query']);
        $getfirst = $this->db->query("SELECT * FROM new_district WHERE id = '" . $keyword . "' AND status='1'");
        $pincode = $getfirst->row();
        $data1 = $pincode->division;
        $getsql = $this->db->query("SELECT * FROM new_division WHERE id = '" . $data1 . "' AND status='1'");
        $result = $getsql->result();
        $html = '<select class="form-control">';
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            $html .= "<option value='" . $value->id . "' " . $sel . " >" . $value->division . "</option>";
        }
        $html .= "</select>";
        echo json_encode($html);
    }

    public function getState()
    {
        $keyword = strval($_POST['query']);
        $getfirst = $this->db->query("SELECT * FROM new_division WHERE id = '" . $keyword . "' AND status='1'");
        $pincode = $getfirst->row();
        $data1 = $pincode->state;
        $getsql = $this->db->query("SELECT * FROM new_state WHERE id = '" . $data1 . "' AND status='1'");
        $result = $getsql->result();
        $html = '<select class="form-control">';
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            $html .= "<option value='" . $value->id . "' " . $sel . " >" . $value->state . "</option>";
        }
        $html .= "</select>";
        echo json_encode($html);
    }

    public function getZone()
    {
        $keyword = strval($_POST['query']);
        $getfirst = $this->db->query("SELECT * FROM new_state WHERE id = '" . $keyword . "' AND status='1'");
        $pincode = $getfirst->row();
        $data1 = $pincode->zone;
        $getsql = $this->db->query("SELECT * FROM new_zone WHERE id = '" . $data1 . "' AND status='1'");
        $result = $getsql->result();
        $html = '<select class="form-control">';
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            $html .= "<option value='" . $value->id . "' " . $sel . " >" . $value->zone . "</option>";
        }
        $html .= "</select>";
        echo json_encode($html);
    }

    public function getCountry()
    {
        $keyword = strval($_POST['query']);
        $getfirst = $this->db->query("SELECT * FROM new_zone WHERE id = '" . $keyword . "' AND status='1'");
        $pincode = $getfirst->row();
        $data1 = $pincode->country;
        $getsql = $this->db->query("SELECT * FROM new_country WHERE id = '" . $data1 . "' AND status='1'");
        $result = $getsql->result();
        $html = '<select class="form-control">';
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            $html .= "<option value='" . $value->id . "' " . $sel . " >" . $value->country . "</option>";
        }
        $html .= "</select>";
        echo json_encode($html);
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
