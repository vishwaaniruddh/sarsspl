<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Greetings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Promotion_M');
        $this->load->model('AuthLog_M');
        $this->checkLogin();
        $this->load->library('encryption');
        $this->load->library('encrypt');

    }

    public function checkLogin()
    {
        $User_Id = $this->session->LoggedUserId;
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
            // echo "Not Login";
        }
    }

    public function Manage()
    {

        $this->load->model('Promotion_M');
        // $data['getlanguage']=$this->Promotion_M->getlanguage();
        $data['promotion'] = $this->Promotion_M->CheckPromotion();

        $data['pagename'] = "Greetings/Manage";
        $this->load->view('Layout/connect', $data);
    }

    public function TodayImages()
    {

        $User_Id = $this->session->LoggedUserId;
        $data['usersactivity'] = $this->AuthLog_M->getsessionDetails($User_Id);
        $usersactivity = $this->AuthLog_M->getsessionDetails($User_Id);
        $activedays = $usersactivity->activedays;
        $date = date('Y-m-d');

        $promotions = $this->db->query("SELECT * FROM `promotions` WHERE subtype IN ('6','7','8','9','10','11','12','13','14','15','16','17','18','20','21') AND `status` = '1'");
        $data['promotions'] = $promotions->result();
        $proids = array();
        foreach ($data['promotions'] as $key => $promo) {

            $imglink = $this->Promotion_M->getdaysimg($promo->id, $activedays);
            if (count($imglink) > 0) {
                $promo->imglink = $imglink[0]->image;
                $promo->imgid = $imglink[0]->id;
                array_push($proids, $promo);
            }
        }

        $nextdate = date('Y-m-d', strtotime('+1 day', strtotime($date)));

        $get_occes = $this->db->query("SELECT * FROM `promotions` where subtype IN ('3','4','5','19') AND created_at='$nextdate' ");
        $result = $get_occes->result();
        //echo $this->db->last_query();
        foreach ($result as $key => $res) {

            $imglink = $this->Promotion_M->getdaysimg($res->id, 1);

            if (count($imglink) > 0) {
                $res->imglink = $imglink[0]->image;
                $res->imgid = $imglink[0]->id;
                array_push($proids, $res);
            }

        }

        $promotions = $this->db->query("SELECT * FROM `promotions` WHERE subtype IN ('22','23') AND `status` = '1'");
        $data['promotions'] = $promotions->result();
//         $count=0;
        $templateids = array();
        $greetingids = array();

        foreach ($data['promotions'] as $key => $promo) {
            //   $count = $count+1;

            $imglink = $this->Promotion_M->getdaysimg($promo->id, 1);
            // var_dump($imglink);
            // echo "<br/>";
            if (count($imglink) > 0) {
                $promo->imglink = $imglink[0]->image;
                $promo->imgid = $imglink[0]->id;
                array_push($proids, $promo);
            }

        }

        $data['userData'] = $this->AuthLog_M->getuserDeta($this->session->LoggedUserId);
        $data['promotionsimage'] = $proids;
        $data['pagename'] = "Greetings/TodayImages";
        $this->load->view('Layout/connect', $data);
    }

    public function Test()
    {
        $User_Id = $this->session->LoggedUserId;
		$getadvitizment=$this->db->query("SELECT * FROM `greetings_advertiser_list` WHERE is_complete='0' ORDER BY `greetings_advertiser_list`.`admin_priority` ASC ");
		$advertresult=$getadvitizment->result();

		echo "<pre>";
		print_r($advertresult);
		echo "</pre>";

    }

	public function Check_conditions($ads_id)
	{
		$ads_id='20';
		$User_Id = $this->session->LoggedUserId;
		$getadvitizment=$this->db->query("SELECT * FROM `greetings_advertiser_list` WHERE is_complete='0' AND='".$ads_id."' ORDER BY `greetings_advertiser_list`.`admin_priority` ASC ");
		$advertresult=$getadvitizment->row();		
	}

    public function NumberofDownloads()
    {
        $User_Id = $this->session->LoggedUserId;
        //var_dump($User_Id);

        $downloadimages1 = $this->db->query("SELECT * FROM `greeting_download_count`WHERE user_id='$User_Id'");
        $downloadimages = $downloadimages1->result();
        $imgids = array();
        $tempids = array();
        $greetids = array();

        foreach ($downloadimages as $key => $value) {
            $temp_count = json_decode($value->template_type);
            $greet_count = json_decode($value->greeting_type);

            // echo count($temp_count); echo "<br>";
            for ($i = 0; $i < count($temp_count); $i++) {
                $greet_array = $greet_count[$i]; // image id
                $temp_array = $temp_count[$i]; // promotion id

                $greet_array = $this->db->query("SELECT * from `promotions` where id='$greet_array'");
                $greet_array = $greet_array->row();
                $greet_array = $greet_array->promotions;

                echo "<br>";

                $temp_array1 = $this->db->query("SELECT * from `total_promotions` where id='$temp_array'");
                $temp_a1 = $temp_array1->row();
                $temp_array = $temp_a1->image;

                echo "<br>";

                //   var_dump($greet_array);  echo "<br>";
                array_push($tempids, $temp_array);
                array_push($greetids, $greet_array);
            }

        }
        $data['greet_count'] = $greetids;
        $data['temp_count'] = $tempids;

        // $totalCount=  $data['temp_count']->download_count;
        // var_dump($data['greet_count']); echo "<br>";
        // var_dump($data['temp_count']);
        $data['pagename'] = "Greetings/DownloadImages";
        $this->load->view('Layout/connect', $data);

//         print all array push data
// var_dump($greetids); echo "<br>";  echo "<br>";
// var_dump($tempids);

    }

    public function Send()
    {

        $data['pagename'] = "Greetings/Send";
        $this->load->view('Layout/connect', $data);
    }

    public function View($view_id)
    {
        $userid = $this->session->LoggedUserId;
        $userData = $this->AuthLog_M->getuserDeta($this->session->LoggedUserId);

        $allpromo = array();
        $this->load->model('Promotion_M');
        $promotion = $this->Promotion_M->CheckPromotion($view_id);
        $promotion_img = $this->Promotion_M->promotion_images($view_id);
        // var_dump($promotion);
        foreach ($promotion_img as $key => $images) {
            $getlang = $this->Promotion_M->getlanguage($images->language);
            $images->laung = $getlang->language;
            $images->promotions = $promotion[0]->promotions;
            array_push($allpromo, $images);
        }

        $usersactivity = $this->AuthLog_M->getsessionDetails($userid);
        $activedays = $usersactivity->activedays;

        $data['activedays'] = $activedays;
        $data['allpromo'] = $allpromo;
        $data['userdata'] = $userData;

        $data['pagename'] = "Greetings/view_Promo";
        $this->load->view('Layout/connect', $data);

    }

    public function MultiView($template)
    {

        $User_Id = $this->session->LoggedUserId;
        $data['usersactivity'] = $this->AuthLog_M->getsessionDetails($User_Id);
        $usersactivity = $this->AuthLog_M->getsessionDetails($User_Id);
        $activedays = $usersactivity->activedays;
        $date = date('Y-m-d');

        $promotions = $this->db->query("SELECT * FROM `promotions` WHERE subtype IN ('6','7','8','9','10','11','12','13','14','15','16','17','18','20','21','22','23') AND `status` = '1'");
        $data['promotions'] = $promotions->result();
        $proids = array();
        $templateids = array();
        $greetingids = array();
        foreach ($data['promotions'] as $key => $promo) {

            $imglink = $this->Promotion_M->getdaysimg($promo->id, $activedays);
            // var_dump($imglink);
            // echo "<br/>";
            if (count($imglink) > 0) {
                $imgid = $imglink[0]->id;
                array_push($proids, $imgid);

                array_push($greetingids, $promo->id);
                array_push($templateids, $imgid);
            }
            $count = $key + 1;
        }

        $templateids = json_encode($templateids);

        $greetingids = json_encode($greetingids);
        $downCount = array(
            'user_id' => $User_Id,
            'greeting_type' => $greetingids,
            'template_type' => $templateids,
            'date' => date('Y-m-d'),
            'download_count' => $count,
        );
        $this->db->insert('greeting_download_count', $downCount);

        $nextdate = date('Y-m-d', strtotime('+1 day', strtotime($date)));
        // $nextdate =date('Y-m-d',strtotime("2021-10-02"));
        // get the occestionally greetings

        $get_occes = $this->db->query("SELECT * FROM `promotions` where subtype IN ('3','4','5','19') AND created_at='$nextdate' ");
        $result = $get_occes->result();
        //echo $this->db->last_query();
        foreach ($result as $key => $res) {

            $imglink = $this->Promotion_M->getdaysimg($res->id, 1);

            if (count($imglink) > 0) {
                $imgid1 = $imglink[0]->id;
                array_push($proids, $imgid1);
            }

        }

        $promoom = $this->db->query("SELECT * FROM `promotions` WHERE subtype IN ('22','23') AND `status` = '1'");
        $promoomdata = $promoom->result();
        foreach ($promoomdata as $key => $res) {

            $imglink = $this->Promotion_M->getdaysimg($res->id, 1);

            if (count($imglink) > 0) {
                $imgid1 = $imglink[0]->id;
                array_push($proids, $imgid1);
            }

        }

// echo $data;
        $myArray = explode(',', $_POST['promo']);
// var_dump($_POST['promo']);
        if ($_POST['promo'] !== "") {
            $select_types = array('select_types' => json_encode($myArray));
            $this->db->where('customer_id', $User_Id);
            $this->db->update('customer_promotion', $select_types);

        }

        // $proids=array_diff($proids,$myArray);

        $List = implode(',', $myArray);
        // var_dump($List);
        if ($List != '') {
            $query = $this->db->query("SELECT * FROM `total_promotions` WHERE id IN ($List) ");
            $data['greetings'] = $query->result();
        } else {

            $data['greetings'] = '';
        }

        $data['template'] = $template;
        $data['pagename'] = "Greetings/MultiView";
        $this->load->view('Layout/connect', $data);

    }

    public function Download($imageid, $numbering = null)
    {

        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
        $data['No'] = $numbering;

//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/Download', $data);

    }

    public function Download1($imageid)
    {

        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);

//     $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/Download1', $data);

    }

    public function Download2($imageid)
    {

        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);

//     $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template2', $data);

    }

    public function Download3($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//     $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template3', $data);

    }

    public function Download4($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template4', $data);

    }

    public function Download5($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//     $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template5', $data);

    }
    public function Download7($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template7', $data);

    }
    public function Download6($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template6', $data);

    }

    public function Download8($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template8', $data);

    }

    public function Download9($imageid, $numbering = null)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);
        $data['No'] = $numbering;
        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template9', $data);

    }

    public function Download10($imageid)
    {
        $User_Id = $this->session->LoggedUserId;
        // echo $User_Id;
        $data['user_Data'] = $this->AuthLog_M->getuserDeta($User_Id);
//         $view_id=urldecode($view_id);
//         $this->load->library('encryption');
//         $imageid=  $this->encrypt->decode($view_id);

        $data['proimgdata'] = $this->Promotion_M->getImgId($imageid);

        $this->load->view('Greetings/template10', $data);

    }
}
