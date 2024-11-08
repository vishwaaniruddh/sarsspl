<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tracker_device_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTrackerDevice() {
        $this->db->select('tracker_devices.id, tracker_devices.device_name, tracker_devices.device_imei, tracker_devices.created_at');
        $this->db->from('tracker_devices');
        $this->db->where('tracker_devices.is_deleted', '0');
        $this->db->order_by('tracker_devices.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function checkTrackerDeviceName($device_name = null, $device_imei = null, $id = null) {
        if ($id != null) {
            $this->db->where('tracker_devices.device_imei', $device_imei);
            // $this->db->where('tracker_devices.device_name', $device_name);
            $this->db->where('tracker_devices.id !=', $id);
            $this->db->where('tracker_devices.is_deleted', "0");
            $this->db->from('tracker_devices');
            $q = $this->db->get();
        } else {
            $this->db->where('tracker_devices.device_imei', $device_imei);
            // $this->db->where('tracker_devices.device_name', $device_name);
            $this->db->where('tracker_devices.is_deleted', "0");
            $this->db->from('tracker_devices');
            $q = $this->db->get();
        }
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function AddTrackerDevice($data) {
        date_default_timezone_set('Asia/Kolkata');
        if ($data) {
            $insert_data = array(
                'device_name' => $data['device_name'],
                'device_imei' => $data['device_imei'],
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tracker_devices', $insert_data);
            return $this->db->insert_id();
        }
    }

    public function getTrackerDeviceById($id = '') {
        if ($id) {
            $this->db->where('tracker_devices.id', $id);
            $this->db->from('tracker_devices');
            $this->db->where('is_deleted', '0');
            $q = $this->db->get();
            return $q->row_array();
        } else {
            return array();
        }
    }

    public function UpdateTrackerDevice($data, $id) {
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            $update_data = array(
                'device_name' => $data['device_name'],
                'device_imei' => $data['device_imei'],
                'updated_at ' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $id);
            $this->db->update('tracker_devices', $update_data);
            return true;
        } else {
            return false;
        }
    }

    public function deleteTrackerDevice($id) {
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->update('tracker_devices', array('is_deleted' => '1'));
            return $query;
        } else {
            return false;
        }
    }

}

?>