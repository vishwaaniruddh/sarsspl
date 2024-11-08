<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bulletin_news extends CI_Controller {

    public function __construct() {
//        error_reporting(E_ALL);
//        ini_set('display_errors', '1');
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
        $this->load->model('User_model', 'login'); // Loading model 
        $this->load->model('api_model'); // Loading model 
        $this->load->model('Bulletin_news_model', 'bulletin_news'); // Loading model 
        $this->load->helper('custom_helper');
    }

    public function getBulletinNews($uid = '') {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $result = $this->bulletin_news->getBulletinNews($uid);
                $i = 1;
                foreach ($result as $key => $value) {
                    if ($value['title'] != null) {
                        $title_value = $value['title'];
                        if (strlen($title_value) > 30) {
                            $title_string = mb_substr($title_value, 0, 30) . "...";
                        } else {
                            $title_string = $title_value;
                        }
                        $result[$key]['title'] = $title_string;
                    }
                    if ($value['description'] != null) {
                        $description_value = strip_tags($value['description']);
                        $description_value = preg_replace("/&#?[a-z0-9]+;/i", "", $description_value);
                        //
                        if (strlen($description_value) > 30) {
                            $description_string = mb_substr($description_value, 0, 30) . "...";
                        } else {
                            $description_string = $description_value;
                        }
                        $result[$key]['description'] = $description_string;
                    }
                    $result[$key]['tenant_name'] = $value['tenant_first_name'] . " " . $value['tenant_last_name'];
                    $i++;
                }
                echo json_encode($result);
                break;
        }
    }

    public function deleteBulletinNews() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->bulletin_news->deleteBulletinNews($datas);
                echo json_encode($result);
                break;
        }
    }

    public function getBulletinNewsView($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->bulletin_news->getBulletinNewsById($id);
                $result->description_value = strip_tags($result->description);
                $result->description_value = preg_replace("/&#?[a-z0-9]+;/i", "", $result->description_value);

                $bulletin_tag_title = "";
                $bulletin_news_tag_result = $this->bulletin_news->getBulletinNewsTagById($id);
                if ($bulletin_news_tag_result) {
                    $bulletin_news_tag_title_arr = array_column($bulletin_news_tag_result, 'title');
                    $bulletin_tag_title = implode(", ", $bulletin_news_tag_title_arr);
                }
                $result->bulletin_tag_title = $bulletin_tag_title;

                echo json_encode($result);
                break;
        }
    }

    public function getUpdateBulletinNewsInfo($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->bulletin_news->getBulletinNewsById($id);

                // 5-may-2022
                if ($result) {
                    if ($result->description == null) {
                        $result->description = "";
                    }
                    if ($result->editor_description == null) {
                        $result->editor_description = "";
                    }
                    if ($result->video == null) {
                        $result->video = "";
                    }
                    if ($result->video_path == null) {
                        $result->video_path = "";
                    }
                    if ($result->updated_at == null) {
                        $result->updated_at = "";
                    }

                    $bulletin_news_tag_result = $this->bulletin_news->getBulletinNewsTagById($id);
                    $bulletin_news_tag_arr = array();
                    if ($bulletin_news_tag_result) {
                        $bulletin_news_tag_arr = array_column($bulletin_news_tag_result, 'bulletin_tag_id');
                    }
                    $result->bulletin_tag = $bulletin_news_tag_arr;
                }
                echo json_encode($result);
                break;
        }
    }

    public function UpdateBulletinNewsInfo($id = '') {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
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
                    $image_name = "news_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/bulletin_news/";
                    $target_file = $target_dir . basename($image_name);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        
                    }
                }
            }
        }
        $video_name = null;
        $audio_name = null;
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != "") {
            $path = $_FILES['video']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $video_name = "news_" . time() . '.' . $ext;
            $target_dir = "../backend/uploads/bulletin_news/";
            $target_file = $target_dir . basename($video_name);
            $video_name = basename($video_name);
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
                
            }
        }
        if (isset($_FILES['audio']['name']) && $_FILES['audio']['name'] != "") {
            $path = $_FILES['audio']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $audio_name = "news_" . time() . '.' . $ext;
            $target_dir = "../backend/uploads/bulletin_news/";
            $target_file = $target_dir . basename($audio_name);
            $audio_name = basename($audio_name);
            if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
                
            }
        }
        $audio_thumbnail_image_name = null;
        if (isset($_FILES['audio_thumbnail_image']['tmp_name']) && $_FILES['audio_thumbnail_image']['tmp_name'] != "") {
            $image_info = getimagesize($_FILES['audio_thumbnail_image']['tmp_name']);
            if ($image_info != FALSE) {
                if ($_FILES['audio_thumbnail_image']['name']) {
                    $path = $_FILES['audio_thumbnail_image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                        $ext = "jpg";
                    } else if (in_array($ext, array('gif', 'GIF'))) {
                        $ext = "gif";
                    } else if (in_array($ext, array('png', 'PNG'))) {
                        $ext = "png";
                    }
                    $audio_thumbnail_image_name = "news_audio_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/bulletin_news/";
                    $target_file = $target_dir . basename($audio_thumbnail_image_name);
                    if (move_uploaded_file($_FILES["audio_thumbnail_image"]["tmp_name"], $target_file)) {
                        
                    }
                }
            }
        }
        $video_thumbnail_image_name = null;
        if (isset($_FILES['video_thumbnail_image']['tmp_name']) && $_FILES['video_thumbnail_image']['tmp_name'] != "") {
            $image_info = getimagesize($_FILES['video_thumbnail_image']['tmp_name']);
            if ($image_info != FALSE) {
                if ($_FILES['video_thumbnail_image']['name']) {
                    $path = $_FILES['video_thumbnail_image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                        $ext = "jpg";
                    } else if (in_array($ext, array('gif', 'GIF'))) {
                        $ext = "gif";
                    } else if (in_array($ext, array('png', 'PNG'))) {
                        $ext = "png";
                    }
                    $video_thumbnail_image_name = "news_video_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/bulletin_news/";
                    $target_file = $target_dir . basename($video_thumbnail_image_name);
                    if (move_uploaded_file($_FILES["video_thumbnail_image"]["tmp_name"], $target_file)) {
                        
                    }
                }
            }
        }
        if (isset($_POST['video_path'])) {
            $video_url = $_POST['video_path'];
            $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
            $match;
            $video_id;
            if (preg_match($regex_pattern, $video_url, $match)) {
                $video_id = $match[4];
                if ($video_id) {

                } else {
                    // return redirect('add-content')->with('failed', "Invalid URL");
                }
            } else {
                // return redirect('add-content')->with('failed', "Invalid URL");
            }
            $type = '0';
            $ch = curl_init();
            $youtube_thumb_url = 'http://img.youtube.com/vi/' . $video_id . '/' . $type . '.jpg';
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_URL, $youtube_thumb_url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $image = curl_exec($ch);
            $info = curl_getinfo($ch);
            // If image is found than save it to a file.
            if ($info['http_code'] == 200) {
                $video_thumbnail_image_name = "video_image_" . $type . time() . '.jpg';
                $target_dir = "../backend/uploads/bulletin_news/";
                $target_file = $target_dir . basename($video_thumbnail_image_name);
                $video_url_link_thumbnail_image = $video_thumbnail_image_name;
                $video_url_link_thumbnail_image_path = "bulletin_news/" . $video_thumbnail_image_name;
                $ch = curl_init('http://img.youtube.com/vi/' . $video_id . '/' . $type . '.jpg');
                $fp = fopen('../backend/uploads/bulletin_news/' . $video_thumbnail_image_name, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            }
            curl_close($ch);
        }
        $base_url = str_replace("/index.php/", "", base_url());
        if ($image_name != null) {
            $datas = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'editor_description' => $this->input->post('editor_description'),
                'news_date' => $this->input->post('news_date'),
                'news_source' => $this->input->post('news_source'),
                'image' => basename($image_name),
//                'image_path' => "http://captainindia.anekalabs.com/backend/uploads/bulletin_news/" . basename($image_name),
                'image_path' => $image_name ? $base_url . '/uploads/bulletin_news/' . $image_name : null,
                'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
            );
        } else {
            $datas = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'editor_description' => $this->input->post('editor_description'),
                'news_date' => $this->input->post('news_date'),
                'news_source' => $this->input->post('news_source'),
                'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
            );
        }

        if ($video_name != null) {
            if ($datas) {
                $datas['video'] = $video_name;
                $datas['video_path'] = $video_name ? $base_url . '/uploads/bulletin_news/' . $video_name : null;
            }
        }
        if ($audio_name != null) {
            if ($datas) {
                $datas['audio'] = $audio_name;
                $datas['audio_path'] = $audio_name ? $base_url . '/uploads/bulletin_news/' . $audio_name : null;
            }
        }
        if ($audio_thumbnail_image_name != null) {
            if ($datas) {
                $datas['audio_thumbnail_image'] = $audio_thumbnail_image_name;
                $datas['audio_thumbnail_image_path'] = $audio_thumbnail_image_name ? $base_url . '/uploads/bulletin_news/' . $audio_thumbnail_image_name : null;
            }
        }
//        if ($video_thumbnail_image_name != null) {
//            if ($datas) {
//                $datas['video_thumbnail_image'] = $video_thumbnail_image_name;
//                $datas['video_thumbnail_image_path'] = $video_thumbnail_image_name ? $base_url . '/uploads/bulletin_news/' . $video_thumbnail_image_name : null;
//            }
//        }
        if ($video_id != null) {
            if ($datas) {
                $datas['video'] = $video_id;
                $datas['video_path'] = $video_url;
                $datas['video_thumbnail_image'] = $video_url_link_thumbnail_image;
                $datas['video_thumbnail_image_path'] = $video_url_link_thumbnail_image_path;
            }
        }
        $tenant_id = $this->input->post('user_id') ? $this->input->post('user_id') : 1;

        if (isset($_POST['bulletin_tag'])) {
            $bulletin_tag = $_POST['bulletin_tag'];
            $bulletin_tag_arr = explode(',', $bulletin_tag);
            if (!empty($bulletin_tag_arr)) {
                $this->bulletin_news->UpdateBulletinNewsTag($id, $bulletin_tag_arr, $tenant_id);
            }
        }

//        $datas = json_decode(file_get_contents("php://input"));
        $result = $this->bulletin_news->UpdateBulletinNewsInfo($datas, $id, $image_name);

        $result_send_bulletin_news = $this->sendBulletinNews($id, $tenant_id);
        echo json_encode($result);
    }

    public function AddBulletinNewsInfo() {
        $image_name = null;
        $video_name = null;
        $audio_name = null;
        if (isset($_FILES['image']['name'])) {
            $path = $_FILES['image']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                $ext = "jpg";
            } else if (in_array($ext, array('gif', 'GIF'))) {
                $ext = "gif";
            } else if (in_array($ext, array('png', 'PNG'))) {
                $ext = "png";
            }
            $image_name = "news_" . time() . '.' . $ext;
            $target_dir = "../backend/uploads/bulletin_news/";
            $target_file = $target_dir . basename($image_name);
            $image_name = basename($image_name);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
            } else {
                
            }
        }
        if (isset($_FILES['video']['name'])) {
            $path = $_FILES['video']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                $ext = "jpg";
            } else if (in_array($ext, array('gif', 'GIF'))) {
                $ext = "gif";
            } else if (in_array($ext, array('png', 'PNG'))) {
                $ext = "png";
            } else {
                
            }
            $video_name = "news_" . time() . '.' . $ext;
            $target_dir = "../backend/uploads/bulletin_news/";
            $target_file = $target_dir . basename($video_name);
            $video_name = basename($video_name);
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
                
            } else {
                
            }
        }
        if (isset($_FILES['audio']['name'])) {
            $path = $_FILES['audio']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                $ext = "jpg";
            } else if (in_array($ext, array('gif', 'GIF'))) {
                $ext = "gif";
            } else if (in_array($ext, array('png', 'PNG'))) {
                $ext = "png";
            } else {
                
            }
            $audio_name = "news_" . time() . '.' . $ext;
            $target_dir = "../backend/uploads/bulletin_news/";
            $target_file = $target_dir . basename($audio_name);
            $audio_name = basename($audio_name);
            if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
                
            } else {
                
            }
        }
        $audio_thumbnail_image_name = null;
        if (isset($_FILES['audio_thumbnail_image']['tmp_name']) && $_FILES['audio_thumbnail_image']['tmp_name'] != "") {
            $image_info = getimagesize($_FILES['audio_thumbnail_image']['tmp_name']);
            if ($image_info != FALSE) {
                if ($_FILES['audio_thumbnail_image']['name']) {
                    $path = $_FILES['audio_thumbnail_image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                        $ext = "jpg";
                    } else if (in_array($ext, array('gif', 'GIF'))) {
                        $ext = "gif";
                    } else if (in_array($ext, array('png', 'PNG'))) {
                        $ext = "png";
                    }
                    $audio_thumbnail_image_name = "news_audio_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/bulletin_news/";
                    $target_file = $target_dir . basename($audio_thumbnail_image_name);
                    if (move_uploaded_file($_FILES["audio_thumbnail_image"]["tmp_name"], $target_file)) {
                        
                    }
                }
            }
        }
        $video_thumbnail_image_name = null;
        if (isset($_FILES['video_thumbnail_image']['tmp_name']) && $_FILES['video_thumbnail_image']['tmp_name'] != "") {
            $image_info = getimagesize($_FILES['video_thumbnail_image']['tmp_name']);
            if ($image_info != FALSE) {
                if ($_FILES['video_thumbnail_image']['name']) {
                    $path = $_FILES['video_thumbnail_image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if (in_array($ext, array('jpeg', 'jpg', 'JPG', 'JPEG'))) {
                        $ext = "jpg";
                    } else if (in_array($ext, array('gif', 'GIF'))) {
                        $ext = "gif";
                    } else if (in_array($ext, array('png', 'PNG'))) {
                        $ext = "png";
                    }
                    $video_thumbnail_image_name = "news_video_" . time() . '.' . $ext;
                    $target_dir = "../backend/uploads/bulletin_news/";
                    $target_file = $target_dir . basename($video_thumbnail_image_name);
                    if (move_uploaded_file($_FILES["video_thumbnail_image"]["tmp_name"], $target_file)) {
                        
                    }
                }
            }
        }
        if (isset($_POST['video_path'])) {
            $video_url = $_POST['video_path'];
            $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
            $match;
            $video_id;
            if (preg_match($regex_pattern, $video_url, $match)) {
                $video_id = $match[4];
                if ($video_id) {

                } else {
                    // return redirect('add-content')->with('failed', "Invalid URL");
                }
            } else {
                // return redirect('add-content')->with('failed', "Invalid URL");
            }
            $type = '0';
            $ch = curl_init();
            $youtube_thumb_url = 'http://img.youtube.com/vi/' . $video_id . '/' . $type . '.jpg';
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_URL, $youtube_thumb_url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $image = curl_exec($ch);
            $info = curl_getinfo($ch);
            // If image is found than save it to a file.
            if ($info['http_code'] == 200) {
                $video_thumbnail_image_name = "video_image_" . $type . time() . '.jpg';
                $target_dir = "../backend/uploads/bulletin_news/";
                $target_file = $target_dir . basename($video_thumbnail_image_name);
                $video_url_link_thumbnail_image = $video_thumbnail_image_name;
                $video_url_link_thumbnail_image_path = "bulletin_news/" . $video_thumbnail_image_name;
                $ch = curl_init('http://img.youtube.com/vi/' . $video_id . '/' . $type . '.jpg');
                $fp = fopen('../backend/uploads/bulletin_news/' . $video_thumbnail_image_name, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            }
            curl_close($ch);
        }

        $base_url = str_replace("/index.php/", "", base_url());
        $datas = array(
            'type' => $this->input->post('type') ? $this->input->post('type') : 1,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description') ? $this->input->post('description') : null,
            'editor_description' => $this->input->post('editor_description') ? $this->input->post('editor_description') : null,
            'news_date' => $this->input->post('news_date'),
            'news_source' => $this->input->post('news_source'),
            // 'image' => basename($image_name),
            // 'image_path' => "http://captainindia.anekalabs.com/uploads/bulletin_news/" . basename($image_name),
            'image' => $image_name,
//            'image_path' => $image_name ? "http://captainindia.anekalabs.com/backend/uploads/bulletin_news/" . $image_name : null,
            'image_path' => $image_name ? $base_url . '/uploads/bulletin_news/' . $image_name : null,
//            'video' => $video_name,
//            'video_path' => $video_name ? "http://captainindia.anekalabs.com/backend/uploads/bulletin_news/" . $video_name : null,
//            'video_path' => $video_name ? $base_url . '/uploads/bulletin_news/' . $video_name : null,
   // 28-nov-2022
            'video' => $video_id,
            'video_path' => $video_url,
            'video_thumbnail_image' => $video_url_link_thumbnail_image,
            'video_thumbnail_image_path' => $video_url_link_thumbnail_image_path,
            'audio' => $audio_name,
//            'audio_path' => $audio_name ? "http://captainindia.anekalabs.com/backend/uploads/bulletin_news/" . $audio_name : null,
            'audio_path' => $audio_name ? $base_url . '/uploads/bulletin_news/' . $audio_name : null,
            // 21-nov-2022
            'audio_thumbnail_image' => $audio_thumbnail_image_name,
            'audio_thumbnail_image_path' => $audio_thumbnail_image_name ? $base_url . '/uploads/bulletin_news/' . $audio_thumbnail_image_name : null,
//            'video_thumbnail_image' => $video_thumbnail_image_name,
//            'video_thumbnail_image_path' => $video_thumbnail_image_name ? $base_url . '/uploads/bulletin_news/' . $video_thumbnail_image_name : null,
            // 14-jul-2022
            'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
            'bulletin_tag' => $this->input->post('bulletin_tag') ? $this->input->post('bulletin_tag') : "",
        );

        $tenant_id = $this->input->post('user_id') ? $this->input->post('user_id') : 1;
        $result_id = $this->bulletin_news->AddBulletinNewsInfo($datas);
        //print_r($tenant_id);
        //  die;
        // comment for testing
        $result_send_bulletin_news = $this->sendBulletinNews($result_id, $tenant_id);
        if ($result_id) {
            $result = true;
        }
        echo json_encode($result);
    }

    public function sendBulletinNews($result_id, $tenant_id = '') {
        $resultBulletinResult = $this->bulletin_news->getBulletinNewsById($result_id);
        if (isset($resultBulletinResult)) {
            $title = $resultBulletinResult->title;
            $description = $resultBulletinResult->description;
            $image_path = $resultBulletinResult->image_path;

            $this->db->select('device_token');
            $this->db->from('users');
            // $this->db->where('id', 357); //1101 //1142
            // 14-jul-2022
            if ($tenant_id != "") {
                $this->db->where('users.tenant_id', $tenant_id);
            }
            $q = $this->db->get();
            $user_info = $q->result_array();
            //echo $this->db->last_query();exit;
            //print_r($user_info);
            foreach ($user_info as $k => $row) {
                if ($row['device_token']) {
                    $device_token[] = $row['device_token'];
                }
            }
            $this->load->library('firebase');
            $output = $this->firebase->send_bulletin_news_notification_to_all($description, $device_token, $title, $image_path);
            //print_r($output);
        } else {
            
        }
//        die;
    }

    // get Bulletin Tag
    public function getBulletinTag($uid = '') {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $result = $this->bulletin_news->getBulletinTag($uid);
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
                    $status_value = "";
                    if ($value['status'] == '1') {
                        $status_value = "Active";
                    } else if ($value['status'] == '2') {
                        $status_value = "Inactive";
                    }
                    $result[$key]['status_value'] = $status_value;
                    $i++;
                }
                echo json_encode($result);
                break;
        }
    }

    // get Bulletin Tag View
    public function getBulletinTagView($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->bulletin_news->getBulletinTagById($id);
                if ($result) {
                    if ($result->status == '1') {
                        $result->status_checked_val = true;
                    } else {
                        $result->status_checked_val = false;
                    }
                }
                echo json_encode($result);
                break;
        }
    }

    // delete Bulletin Tag
    public function deleteBulletinTag() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->bulletin_news->deleteBulletinTag($datas);
                echo json_encode($result);
                break;
        }
    }

    // Update Bulletin Tag
    public function UpdateBulletinTag($id = '') {
        $status = '2';
        if (isset($_POST['status'])) {
            if ($this->input->post('status') == "on") {
                $status = '1';
            }
        }
        $datas = array(
            'title' => $this->input->post('title'),
            'status' => $status,
            'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
        );
        $result = $this->bulletin_news->UpdateBulletinTag($datas, $id);
        echo json_encode($result);
    }

    // Add Bulletin Tag
    public function AddBulletinTag() {
        $result = false;
        $status = '2';
        if (isset($_POST['status'])) {
            if ($this->input->post('status') == "on") {
                $status = '1';
            }
        }
        if ($this->input->post('title')) {
            $datas = array(
                'title' => $this->input->post('title'),
                'status' => $status,
                'tenant_id' => $this->input->post('user_id') ? $this->input->post('user_id') : 1,
            );
            $result_id = $this->bulletin_news->AddBulletinTag($datas);
            if ($result_id) {
                $result = true;
            }
        }
        echo json_encode($result);
    }

    // get All Bulletin Tag Title
    public function getAllBulletinTagTitle($tenant_id = null) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $result = $this->bulletin_news->getBulletinTag($tenant_id);
                $i = 1;
                $return_arr = array();
                if (!empty($result)) {
                    foreach ($result as $key => $value) {
                        $return_arr[] = array('value' => $value['id'], 'label' => $value['title']);
                        $i++;
                    }
                }
                echo json_encode($return_arr);
                break;
        }
    }

    public function checkBulletinTagTitle($id = null) {
        if ($this->input->post('title')) {
            $title = $this->input->post('title');
            $tenant_id = $this->input->post('user_id');
            $result = $this->bulletin_news->checkBulletinTagTitle($title, $tenant_id, $id);
            echo json_encode($result);
        }
    }

    // change Status Bulletin Tag
    public function changeStatusBulletinTag() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $id = $this->input->post('id');
                $status = null;
                if (isset($_POST['status'])) {
                    if ($this->input->post('status') == "1") {
                        $status = '2';
                    } else {
                        $status = '1';
                    }
                }
                if ($status != null) {
                    $result = $this->bulletin_news->changeStatusBulletinTag($id, $status);
                    echo json_encode($result);
                    break;
                }
        }
    }

}
