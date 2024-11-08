<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode extends CI_Controller {

    public function __construct() {
        error_reporting(1);
        error_reporting(E_ALL);
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
        $this->load->model('Qrcode_model', 'qrcode'); // Loading model
    }

    public function getQrCode() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getQrCode();
                echo json_encode($result);
                break;
        }
    }

    // 11-jan-2023
    public function getQrCodeById($id = '') {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getQrCodeById($id);
                $result['child_qr_code'] = $this->qrcode->getChildQrCodeNameById($id);
                echo json_encode($result);
                break;
        }
    }

    public function checkQrCode($id = null) {
        if ($this->input->post('code')) {
            $code = $this->input->post('code');
            $result = $this->qrcode->checkQrCode($code, $id);
            echo json_encode($result);
        }
    }

    // Add Qrcode
    public function AddQrcode() {
        $result = false;
        if ($this->input->post('code')) {
            $type_title = null;
            if (isset($_POST['type'])) {

                if ($_POST['type'] == 1) {
                    $type_title = 'Person';
                }
                if ($_POST['type'] == 2) {
                    $type_title = 'Animal';
                }
                if ($_POST['type'] == 3) {
                    $type_title = 'Things';
                }
                if ($_POST['type'] == 4) {
                    $type_title = 'Self';
                }
            }
            $code_for = null;
            if (isset($_POST['code_for'])) {
                $code_for = $_POST['code_for'];
            }
            $datas = array(
                'code' => $this->input->post('code'),
                'code_for' => $code_for,
                'type' => $this->input->post('type'),
                'type_title' => $type_title,
            );
            $result_id = $this->qrcode->AddQrcode($datas);
            if ($result_id) {
                $result = true;
            }
        }
        echo json_encode($result);
    }

    public function qrcodeBulkUpload_OLD() {
        error_reporting(1);
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $icnt = 0;
        $ucnt = 0;
        $ecnt = 0;
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $admin_select = null;

                if ($_FILES['file']['name'] != '') {
                    $temp = explode(".", $_FILES['file']['name']);
                    $target_path = './uploads/documents/';
                    $time = mt_rand(10, 100) . time() . round('2');
                    $newfilename = 'sample_csv.' . end($temp);
                    $target_path_new = $target_path . $newfilename;
                    $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path_new);
                    if ($result) {
                        $row = 0;
                        if (($handle = fopen("./uploads/documents/sample_csv.csv", "r")) !== FALSE) {
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                $row++;
                                if ($row == 1) {
                                    continue;
                                }
                                $num = count($data);
                                $insert_data = array();
                                for ($c = 0; $c < $num; $c++) {
                                    $insert_data[] = $data[$c];
                                }
                                $this->qrcode->addQrcodeTempData($insert_data, $_POST['session_id']);
                            }
                            fclose($handle);
                        }
                        $result = $this->qrcode->getBulkTempQrcode($_POST['session_id']);
                        $columns[] = array('label' => '#');
                        $columns[] = array('label' => 'Code');
                        $columns[] = array('label' => 'Type');
                        $columns[] = array('label' => 'Action');
                        $columns[] = array('label' => 'Error');

                        $i = 1;
                        foreach ($result as $key => $value) {
                            $result[$key]['code'] = $value['code'];
                            $type_val = "";
                            if ($value['type'] == '1') {
                                $type_val = "Person";
                            }
                            if ($value['type'] == '2') {
                                $type_val = "Animal";
                            }
                            if ($value['type'] == '3') {
                                $type_val = "Thing";
                            }
                            $result[$key]['type'] = $type_val;
                            $result[$key]['sr_no'] = $key + 1;

                            if ($value['code'] && $value['type']) {
                                $ec1 = null;

                                $this->db->where('qr_code.code', trim($value['code']));
                                $this->db->where('qr_code.user_id IS NULL', null, false);
                                $this->db->where('qr_code.is_deleted', "0");
                                $this->db->from('qr_code');
                                $q = $this->db->get();
                                $ec1_info = $q->row_array();
                                if ($ec1_info) {
                                    $ec1 = $ec1_info['id'];
                                }

                                $this->db->where('qr_code.code', trim($value['code']));
                                $this->db->where('qr_code.user_id IS NOT NULL', null, false);
                                $this->db->where('qr_code.is_deleted', "0");
                                $this->db->from('qr_code');
                                $q2 = $this->db->get();
                                $ec1_info_err = $q2->row_array();
                                $ec1_err_flag = "0";
                                if ($ec1_info_err) {
                                    $ec1_err = $ec1_info_err['id'];
                                    $ec1_err_flag = '1';
                                }

                                if ($ec1 == null) {
                                    
                                }
                                if ($ec1) {
                                    $ucnt++;
                                    $result[$key]['action'] = 'Update';
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_updated' => '1', 'qr_code_id' => $ec1));
                                    $value['is_updated'] = '1';
                                } else if ($ec1_err_flag == '1') {
                                    $result[$key]['error'] = 'Code Used';
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                } else {
                                    $icnt++;
                                    $result[$key]['action'] = 'Insert';
                                }
                                if ($value['code'] && $value['type'] && $ec1_err_flag == '0') {
                                    $result[$key]['error'] = '-';
                                } else {
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                }
                            } else {
                                if ($value['code'] == "") {
                                    $result[$key]['error'] = 'Code should not empty';
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                } else if ($value['type'] == "") {
                                    $result[$key]['error'] = 'Invalid type';
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                } else {
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                }
                            }
                        }
                        $res = array('columns' => $columns, 'rows' => $result, 'icnt' => $icnt, 'ucnt' => $ucnt, 'ecnt' => $ecnt);
                        echo json_encode($res);
                        break;
                    }
                }
        }
    }

    public function qrcodeBulkUpload() {
        error_reporting(1);
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $icnt = 0;
        $ucnt = 0;
        $ecnt = 0;
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $admin_select = null;

                if ($_FILES['file']['name'] != '') {
                    $temp = explode(".", $_FILES['file']['name']);
                    $target_path = './uploads/documents/';
                    $time = mt_rand(10, 100) . time() . round('2');
                    $newfilename = 'sample_csv.' . end($temp);
                    $target_path_new = $target_path . $newfilename;
                    $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path_new);
                    if ($result) {
                        $row = 0;
                        if (($handle = fopen("./uploads/documents/sample_csv.csv", "r")) !== FALSE) {
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                $row++;
                                if ($row == 1) {
                                    continue;
                                }
                                $num = count($data);
                                $insert_data = array();
                                for ($c = 0; $c < $num; $c++) {
                                    $insert_data[] = $data[$c];
                                }
                                $this->qrcode->addQrcodeTempData($insert_data, $_POST['session_id']);
                            }
                            fclose($handle);
                        }
                        $result = $this->qrcode->getBulkTempQrcode($_POST['session_id']);
                        $columns[] = array('label' => '#');
                        $columns[] = array('label' => 'Code');
                        $columns[] = array('label' => 'Type');
                        $columns[] = array('label' => 'Action');
                        $columns[] = array('label' => 'Error');

                        $i = 1;
                        foreach ($result as $key => $value) {
                            $result[$key]['code'] = $value['code'];
                            $type_val = "";
                            if ($value['type'] == '1') {
                                $type_val = "Person";
                            }
                            if ($value['type'] == '2') {
                                $type_val = "Animal";
                            }
                            if ($value['type'] == '3') {
                                $type_val = "Thing";
                            }
                            $result[$key]['type'] = $type_val;
                            $result[$key]['sr_no'] = $key + 1;

                            if ($value['code']) {
                                $ec1 = null;

                                $this->db->where('qr_code.code', trim($value['code']));
                                $this->db->where('qr_code.user_id IS NULL', null, false);
                                $this->db->where('qr_code.is_deleted', "0");
                                $this->db->from('qr_code');
                                $q = $this->db->get();
                                $ec1_info = $q->row_array();
                                if ($ec1_info) {
                                    $ec1 = $ec1_info['id'];
                                }

                                $this->db->where('qr_code.code', trim($value['code']));
                                $this->db->where('qr_code.user_id IS NOT NULL', null, false);
                                $this->db->where('qr_code.is_deleted', "0");
                                $this->db->from('qr_code');
                                $q2 = $this->db->get();
                                $ec1_info_err = $q2->row_array();
                                $ec1_err_flag = "0";
                                if ($ec1_info_err) {
                                    $ec1_err = $ec1_info_err['id'];
                                    $ec1_err_flag = '1';
                                }

                                if ($ec1 == null) {
                                    
                                }
                                if ($ec1) {
                                    $ucnt++;
                                    $result[$key]['action'] = 'Update';
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_updated' => '1', 'qr_code_id' => $ec1));
                                    $value['is_updated'] = '1';
                                } else if ($ec1_err_flag == '1') {
                                    $result[$key]['error'] = 'Code Used';
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                } else {
                                    $icnt++;
                                    $result[$key]['action'] = 'Insert';
                                }
                                if ($value['code'] && $ec1_err_flag == '0') {
                                    $result[$key]['error'] = '-';
                                } else {
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                }
                            } else {
                                if ($value['code'] == "") {
                                    $result[$key]['error'] = 'Code should not empty';
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                } else {
                                    $ecnt++;
                                    $this->db->where('id', $result[$key]['id']);
                                    $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
                                }
                            }
                        }
                        $res = array('columns' => $columns, 'rows' => $result, 'icnt' => $icnt, 'ucnt' => $ucnt, 'ecnt' => $ecnt);
                        echo json_encode($res);
                        break;
                    }
                }
        }
    }

    public function getDeclinedBulkQrcode() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getDeclinedBulkQrcode($_POST['session_id']);
                foreach ($result as $key => $value) {
                    $result[$key]['code'] = $value['code'] != null ? $value['code'] : "";
                    $type_val = "";
                    if ($value['type'] == '1') {
                        $type_val = "Person";
                    }
                    if ($value['type'] == '2') {
                        $type_val = "Animal";
                    }
                    if ($value['type'] == '3') {
                        $type_val = "Thing";
                    }
                    $result[$key]['type'] = $type_val;
                    $action = "";
                    $error = "";
                    if ($value['is_declined'] == 1) {

                        if ($value['code'] == "") {
                            $error = 'Code should not empty';
                        } else {
                            $error = "Code Used";
                        }
                        $action = "Declined User";
                    }
                    $result[$key]['action'] = $action;
                    $result[$key]['error'] = $error;
                    unset($result[$key]['is_declined']);
                    unset($result[$key]['session_id']);
                }
                echo json_encode($result);
                break;
        }
    }

    public function getUpdatedBulkQrcode() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getUpdatedBulkQrcode($_POST['session_id']);
                foreach ($result as $key => $value) {
                    unset($result[$key]['is_declined']);
                    unset($result[$key]['session_id']);
                }
                echo json_encode($result);
                break;
        }
    }

    public function saveQrcodeBulkImportData() {
        $result = $this->qrcode->saveBulkQrcodeImportData($_POST['session_id']);
        $res = $this->qrcode->removeBulkQrcodeTempData($_POST['session_id']);
        $res = $this->qrcode->clearBulkQrcodeTempData($_POST['session_id']);
        echo $res;
    }

    public function changeMissingStatus() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $id = $this->input->post('id');
                $missing_status = null;
                if (isset($_POST['missing_status'])) {
                    if ($this->input->post('missing_status') == "1") {
                        $missing_status = '2';
                    } else {
                        $missing_status = '1';
                    }
                }
                if ($missing_status != null) {
                    $result = $this->qrcode->changeMissingStatus($id, $missing_status);
                    // send notification
                    if ($missing_status == '2') {
                        $this->sendAdminNotificationQrCodeMissingAlert($id);
                    }
                    echo json_encode($result);
                    break;
                }
        }
    }

    public function getUnusedQrCode() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getUnusedQrCode();
                echo json_encode($result);
                break;
        }
    }

    public function getQrCodeImage() {
        $image_name = "";
        if (isset($_POST['qr_chl'])) {
            $data = $this->input->post('qr_chl');
            $data = "https://qr.zimaxxtech.com/code.php?uid=" . $data;
            $qr_id = $this->input->post('qr_id') ? $this->input->post('qr_id') : "";
//                 $data = isset($_GET['data']) ? $_GET['data'] : 'http://labs.nticompassinc.com';
            $size = isset($_GET['size']) ? $_GET['size'] : '200x200';
            $logo = isset($_GET['logo']) ? $_GET['logo'] : FALSE;

            //  header('Content-type: image/png');
// Get QR Code image from Google Chart API
// http://code.google.com/apis/chart/infographics/docs/qr_codes.html
            $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . '&chl=' . urlencode($data));
            if ($logo !== FALSE) {
                $logo = imagecreatefromstring(file_get_contents($logo));

                $QR_width = imagesx($QR);
                $QR_height = imagesy($QR);

                $logo_width = imagesx($logo);
                $logo_height = imagesy($logo);

                // Scale logo to fit in the QR Code
                $logo_qr_width = $QR_width / 3;
                $scale = $logo_width / $logo_qr_width;
                $logo_qr_height = $logo_height / $scale;

                $color_img = imagecreatetruecolor(400, 50);
                $text = "mmmm";
                $color = "black";
                $font_filename = 'C:\Users\ANEKA LABS\Downloads\short-baby-font.ttf';
                imagettftext($color_img, 20, 0, 10, 20, $color, $font_filename, $text);
                imagestring($color_img, $font_filename, 10, 20, $text, $color);
                imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            }
            $targetPath = "qrdone/";
            $targetPath = "uploads/qr_code_image/";
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $code_image = "qr" . $qr_id . time() . ".png";
            $target_name = $targetPath . $code_image;
            imagepng($QR, $target_name);
            $image_name = base_url() . $target_name;
//            imagepng($QR);
//            imagedestroy($QR);
//              readfile($target_name);
            if ($image_name != "") {
                $qr_id = $this->input->post('qr_id');
                $qr_chl = $this->input->post('qr_chl');
                if ($qr_id != "" && $qr_chl != "") {
                    $update_arr = array('code_image' => $code_image, 'code_image_path' => "/qr_code_image/" . $code_image, 'updated_at' => date('Y-m-d H:i:s'));
                    $this->db->where('is_deleted', '0');
                    $this->db->where('id', $qr_id);
                    $this->db->where('code', $qr_chl);
                    $this->db->update('qr_code', $update_arr);
                }
            }
        }
        $return_arr = array("image_name" => $image_name);
        echo json_encode($return_arr);
    }

    public function getQrCodeMissingAlertList() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getQrCodeMissingAlertList();
                echo json_encode($result);
                break;
        }
    }

    public function getQrCodeScanAlertList() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getQrCodeScanAlertList();
                echo json_encode($result);
                break;
        }
    }

    public function getMissingStatusQrCode() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getMissingStatusQrCode();
                echo json_encode($result);
                break;
        }
    }

    public function sendAdminNotificationQrCodeMissingAlert($id) {
        date_default_timezone_set('Asia/Kolkata');
        $qr_time = date('Y-m-d h:i:s');
        $qr_code = '';
        $qr_code_user_id = '';
        $qr_code_type = '';
        $type_val = '';
        $qr_type_name = '';
        if ($id != "") {
            $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.missing_status, qr_code.type');
            $this->db->from('qr_code');
            $this->db->where('qr_code.id', $id);
            $q = $this->db->get();
            $row_array_res = $q->row_array();
            if ($row_array_res) {
                $qr_code_id = $row_array_res['id'];
                $qr_code = $row_array_res['code'];
                $qr_code_user_id = $row_array_res['user_id'];
                $qr_code_type = $row_array_res['type'];
                if ($qr_code_type == '1') {
                    $type_val = "Person";
                    $this->db->select('qr_person.id, qr_person.user_id, qr_person.first_name, qr_person.last_name');
                    $this->db->from('qr_person');
                    $this->db->where('qr_person.is_deleted', '0');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_type_name = $row_array_qr_person_res['first_name'] . " " . $row_array_qr_person_res['last_name'];
                    }
                } else if ($qr_code_type == '2') {
                    $type_val = "Pet";
                    $this->db->select('qr_animal.id, qr_animal.name');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_type_name = $row_array_qr_person_res['name'];
                    }
                } else if ($qr_code_type == '3') {
                    $type_val = "Thing";
                    $this->db->select('qr_things.id, qr_things.name');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $qr_type_name = $row_array_qr_person_res['name'];
                    }
                }
                if ($row_array_res['type'] == "1" && $row_array_res['code_for'] == "1") {
                    $user_id = $row_array_res['user_id'];
                    $this->db->select('users.id, users.first_name, users.last_name, users.email, users.profile_image, users.profile_image_thumb, users.mobile_no,  users.blood_group, users.is_deleted, users.created_at  ,users.blood_group,  blood_group.title as blood_group ');
                    $this->db->from('users');
                    $this->db->join('blood_group', 'blood_group.id = users.blood_group', 'left');
                    $this->db->where('users.id', $user_id);
                    $q = $this->db->get();
                    $row_array_users_res = $q->row_array();
                    if ($row_array_users_res) {
                        $qr_type_name = $row_array_users_res['first_name'] . ' ' . $row_array_users_res['last_name'];
                    }
                }
            }
        }
        if ($qr_code != "" && $qr_code_user_id != "") {
            // $send_message = 'QR Code - ' . $qr_code . ' Missing Alert on Captain India. Time:' . $qr_time;
            $send_message = $type_val . ' - ' . $qr_type_name . ', QR-' . $qr_code . ' has been missing. Time: ' . $qr_time;
            $msg_response = $this->qrcode->sendNotificationMessageOnesignal($send_message);
            $save_notification_arr = array(
                'message_type' => '2',
                'qr_code_id' => $id,
                'qr_code' => $qr_code,
                'message' => $send_message,
                'message_response' => $msg_response,
                'created_at' => date('Y-m-d h:i:s')
            );
            $table_name = "qr_code_notification";
            $save_notification = $this->qrcode->saveNotificationMessage($save_notification_arr, $table_name);
        }
    }

    public function getMissingStatusNotification() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->qrcode->getMissingStatusNotification();
                echo json_encode($result);
                break;
        }
    }

}
