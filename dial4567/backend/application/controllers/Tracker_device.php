<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tracker_device extends CI_Controller {

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
        $this->load->model('Tracker_device_model', 'tracker_device');
    }

    public function getTrackerDevice() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $result = $this->tracker_device->getTrackerDevice();
                $i = 1;
                foreach ($result as $key => $value) {
                    $result[$key]['sr_no'] = $i;
                    if ($value['device_name'] != null) {
                        $device_name_value = $value['device_name'];
                        if (strlen($device_name_value) > 30) {
                            $device_name_string = mb_substr($device_name_value, 0, 30) . "...";
                        } else {
                            $device_name_string = $device_name_value;
                        }
                        $result[$key]['device_name'] = $device_name_string;
                    }
                    $i++;
                }
                echo json_encode($result);
                break;
        }
    }

    public function checkTrackerDeviceName($id = null) {
        if ($this->input->post('device_name')) {
            $device_name = $this->input->post('device_name');
            $device_imei = $this->input->post('device_imei');
            $result = $this->tracker_device->checkTrackerDeviceName($device_name, $device_imei, $id);
            echo json_encode($result);
        }
    }

    public function AddTrackerDevice() {
        $result = false;

        if ($this->input->post('device_name')) {
            $datas = array(
                'device_name' => $this->input->post('device_name') ? $this->input->post('device_name') : null,
                'device_imei' => $this->input->post('device_imei') ? $this->input->post('device_imei') : null,
            );
            $result_id = $this->tracker_device->AddTrackerDevice($datas);
            if ($result_id) {
                $result = true;
            }
        }
        echo json_encode($result);
    }

    public function getTrackerDeviceById($id) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->tracker_device->getTrackerDeviceById($id);
                echo json_encode($result);
                break;
        }
    }

    public function UpdateTrackerDevice($id = '') {
        $datas = array(
            'device_name' => $this->input->post('device_name') ? $this->input->post('device_name') : null,
            'device_imei' => $this->input->post('device_imei') ? $this->input->post('device_imei') : null,
        );
        $result = $this->tracker_device->UpdateTrackerDevice($datas, $id);
        echo json_encode($result);
    }

    public function deleteTrackerDevice() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $datas = json_decode(file_get_contents("php://input"));
                $result = $this->tracker_device->deleteTrackerDevice($datas);
                echo json_encode($result);
                break;
        }
    }

}
