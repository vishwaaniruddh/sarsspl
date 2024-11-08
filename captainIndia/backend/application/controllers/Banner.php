<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');  // cache for 1 day
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('Banner_model', 'banner'); // Loading model
    }

    // get Banner
    public function getBanner($uid = '') {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $result = $this->banner->getBanner($uid);
                $i = 1;
                foreach ($result as $key => $value) {
                    $result[$key]['sr_no'] = $i;
                    if ($value['title'] != null) {
                        $title_value = $value['title'];
                        if (strlen($title_value) > 30) {
                            $title_string = mb_substr($title_value, 0, 30) . "...";
                        } else {
                            $title_string = $title_value;
                        }
                        $result[$key]['title'] = $title_string;
                    }
                    if ($value['redirection_url'] != null) {
                        $redirection_url_value = $value['redirection_url'];
                        if (strlen($redirection_url_value) > 30) {
                            $redirection_url_string = mb_substr($redirection_url_value, 0, 30) . "...";
                        } else {
                            $redirection_url_string = $redirection_url_value;
                        }
                        $result[$key]['redirection_url'] = $redirection_url_string;
                    }
                    $i++;
                }
                echo json_encode($result);
                break;
        }
    }

    // Add Banner
    public function AddBanner() {
        $result = false;
        if ($this->input->post('title')) {
            $image_name = null;
            // if ($_FILES['image']['name']) {
            if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
                $image_info = getimagesize($_FILES['image']['tmp_name']);
                if ($image_info != FALSE) {
                    $path = $_FILES['image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                        $ext = "jpg";
                    } else if (in_array($ext, array('gif', 'GIF'))) {
                        $ext = "gif";
                    } else if (in_array($ext, array('png', 'PNG'))) {
                        $ext = "png";
                    }
                    $image_name = "banner_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/banner/";
                    $target_file = $target_dir . basename($image_name);
                    $image_name = basename($image_name);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        
                    } else {
                        
                    }
                }
            }
            if ($image_name != null) {
                $datas = array(
                    'title' => $this->input->post('title'),
                    'image_name' => $image_name ? $image_name : null,
                    'image_url' => $image_name ? "/banner/" . $image_name : null,
                    'redirection_url' => $this->input->post('redirection_url'),
                    'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
                );
            } else {
                $datas = array(
                    'title' => $this->input->post('title'),
                    'redirection_url' => $this->input->post('redirection_url'),
                    'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
                );
            }

            $result_id = $this->banner->AddBanner($datas);
            if ($result_id) {
                $result = true;
            }
        }
        echo json_encode($result);
    }

    // delete Banner
    public function deleteBanner() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->banner->deleteBanner($datas);
                echo json_encode($result);
                break;
        }
    }

    // get Banner View
    public function getBannerView($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->banner->getBannerById($id);
                if ($result) {
                    $base_url = str_replace("/index.php/", "", base_url());
                    $result->image_url = $result->image_url != null ? $base_url . '/uploads' . $result->image_url : "";
                }
                echo json_encode($result);
                break;
        }
    }

    // Update Banner
    public function UpdateBanner($id = '') {
        $image_name = null;
        if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
            $image_info = getimagesize($_FILES['image']['tmp_name']);
            if ($image_info != FALSE) {
                if ($_FILES['image']['name']) {
                    $path = $_FILES['image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                        $ext = "jpg";
                    } else if (in_array($ext, array('gif', 'GIF'))) {
                        $ext = "gif";
                    } else if (in_array($ext, array('png', 'PNG'))) {
                        $ext = "png";
                    }
                    $image_name = "banner_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/banner/";
                    $target_file = $target_dir . basename($image_name);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        
                    }
                }
            }
        }
        if ($image_name != null) {
            $datas = array(
                'title' => $this->input->post('title'),
                'redirection_url' => $this->input->post('redirection_url'),
                'image_name' => basename($image_name),
                'image_url' => "/banner/" . basename($image_name),
            );
        } else {
            $datas = array(
                'title' => $this->input->post('title'),
                'redirection_url' => $this->input->post('redirection_url'),
                'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
            );
        }
        $result = $this->banner->UpdateBanner($datas, $id, $image_name);
        echo json_encode($result);
    }

}
