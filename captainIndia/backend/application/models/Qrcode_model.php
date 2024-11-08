<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qrcode_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getQrCode() {
        $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.type, qr_code.type_title, qr_code.code_for, qr_code.missing_status, qr_code.is_deleted, qr_code.created_at, users.first_name, users.last_name, users.mobile_no');
        $this->db->join('users', 'users.id = qr_code.user_id', 'left');
        $this->db->where('qr_code.is_deleted', '0');
        $this->db->from('qr_code');
        $this->db->order_by('qr_code.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getQrCodeById($id = '') {
        $base_url = str_replace("/index.php/", "", base_url());
        if ($id != "") {
            $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.type, qr_code.type_title, qr_code.code_for, qr_code.missing_status, qr_code.code_image, qr_code.code_image_path, qr_code.is_deleted, qr_code.created_at, users.first_name, users.last_name, users.mobile_no, users.email, blood_group.title as blood_group ');
            $this->db->join('users', 'users.id = qr_code.user_id', 'left');
            $this->db->join('blood_group', 'blood_group.id = users.blood_group', 'left');
            $this->db->from('qr_code');
            $this->db->where('qr_code.id', $id);
            $q = $this->db->get();
            $row_array_res = $q->row_array();

            if ($row_array_res) {

                if ($row_array_res['code_image_path'] != "") {
                    $row_array_res['code_image_path'] = base_url() . 'uploads/' . $row_array_res['code_image_path'];
                }
                $qr_code_type = $row_array_res['type'];
                $qr_code_id = $row_array_res['id'];
                if ($row_array_res['type'] == '1' && $row_array_res['code_for'] == "2") {
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_person.id, qr_person.qr_code_id, qr_person.user_id, qr_person.first_name, qr_person.last_name, qr_person.image, qr_person.image_path, qr_person.mobile_no, qr_person.email, qr_person.blood_group_id, qr_person.is_deleted, qr_person.created_at, blood_group.title as blood_group, qr_person.location, qr_person.lat, qr_person.long');
                    $this->db->from('qr_person');
                    $this->db->join('blood_group', 'blood_group.id = qr_person.blood_group_id', 'left');
                    $this->db->where('qr_person.qr_code_id', $qr_code_id);
                    $this->db->order_by('qr_person.id', 'DESC');
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    $row_array_res['emergency_contacts'] = array();

                    if ($row_array_qr_person_res) {
                        $row_array_res['first_name'] = $row_array_qr_person_res['first_name'];
                        $row_array_res['last_name'] = $row_array_qr_person_res['last_name'];
                        $row_array_res['email'] = $row_array_qr_person_res['email'];
                        $row_array_res['mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $row_array_res['blood_group'] = $row_array_qr_person_res['blood_group'];
                        $row_array_res['image'] = $row_array_qr_person_res['image'];
                        $row_array_res['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $row_array_res['location'] = $row_array_qr_person_res['location'];
                        $row_array_res['lat'] = $row_array_qr_person_res['lat'];
                        $row_array_res['long'] = $row_array_qr_person_res['long'];
                        $row_array_res[$k]['created_at'] = $row_array_qr_person_res['created_at'];

                        $user_id = $row_array_qr_person_res['user_id'];

                        // $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted, users.mobile_no ');
                        // $this->db->from('emergency_contacts');
                        // $this->db->join('users', 'users.id = emergency_contacts.emergency_user_id', 'left');
                        // $this->db->where('emergency_contacts.user_id', $user_id);
                        // $this->db->order_by('emergency_contacts.serial_no', 'ASC');
                        // $q = $this->db->get();

                        // $result_array_emergency_contacts = $q->result_array();
                        // $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                        
                          $this->db->select('qr_emergency_contacts.id, qr_emergency_contacts.qr_code_id, qr_emergency_contacts.qr_type, qr_emergency_contacts.serial_no, qr_emergency_contacts.mobile_no, qr_emergency_contacts.name, qr_emergency_contacts.is_deleted ');
                        $this->db->from('qr_emergency_contacts');
                        $this->db->where('qr_emergency_contacts.qr_code_id', $qr_code_id);
                        $this->db->where('qr_emergency_contacts.qr_type', $qr_code_type);
                        $this->db->where('qr_emergency_contacts.is_deleted', '0');
                        $this->db->order_by('qr_emergency_contacts.serial_no', 'ASC');
                        $q = $this->db->get();

                        $result_array_emergency_contacts = $q->result_array();
                        $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                    }
                }

                if ($row_array_res['type'] == '2') {
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_animal.id, qr_animal.qr_code_id, qr_animal.name, qr_animal.image, qr_animal.image_path, qr_animal.color, qr_animal.description, qr_animal.mobile_no, qr_animal.is_deleted, qr_animal.created_at, qr_animal.date_of_birth, qr_animal.age, qr_animal.identification_mark, qr_animal.vaccination_name, qr_animal.vaccination_date, qr_animal.allergy, qr_animal.surgery, qr_animal.medication, qr_animal.medical_condition, qr_animal.mating_cycle, qr_animal.location, qr_animal.lat, qr_animal.long');
                    $this->db->from('qr_animal');
                    $this->db->where('qr_animal.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $row_array_res['name'] = $row_array_qr_person_res['name'];
                        $row_array_res['image'] = $row_array_qr_person_res['image'];
                        $row_array_res['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $row_array_res['color'] = $row_array_qr_person_res['color'];
                        $row_array_res['description'] = $row_array_qr_person_res['description'];
                        $row_array_res['animal_mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $row_array_res['date_of_birth'] = $row_array_qr_person_res['date_of_birth'];
                        $row_array_res['age'] = $row_array_qr_person_res['age'];
                        $row_array_res['identification_mark'] = $row_array_qr_person_res['identification_mark'];
                        $row_array_res['vaccination_name'] = $row_array_qr_person_res['vaccination_name'];
                        $row_array_res['vaccination_date'] = $row_array_qr_person_res['vaccination_date'];
                        $row_array_res['allergy'] = $row_array_qr_person_res['allergy'];
                        $row_array_res['surgery'] = $row_array_qr_person_res['surgery'];
                        $row_array_res['medication'] = $row_array_qr_person_res['medication'];
                        $row_array_res['medical_condition'] = $row_array_qr_person_res['medical_condition'];
                        $row_array_res['mating_cycle'] = $row_array_qr_person_res['mating_cycle'];
                        $row_array_res['location'] = $row_array_qr_person_res['location'];
                        $row_array_res['lat'] = $row_array_qr_person_res['lat'];
                        $row_array_res['long'] = $row_array_qr_person_res['long'];
                        $row_array_res['created_at'] = $row_array_qr_person_res['created_at'];
                    }
                }

                if ($row_array_res['type'] == '3') {
                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_things.id, qr_things.qr_code_id, qr_things.name, qr_things.device_name, qr_things.model_number, qr_things.serial_number, qr_things.color, qr_things.description, qr_things.mobile_no, qr_things.image, qr_things.image_path, qr_things.is_deleted, qr_things.created_at, qr_things.location, qr_things.lat, qr_things.long');
                    $this->db->from('qr_things');
                    $this->db->where('qr_things.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_person_res = $q->row_array();
                    if ($row_array_qr_person_res) {
                        $row_array_res['name'] = $row_array_qr_person_res['name'];
                        $row_array_res['device_name'] = $row_array_qr_person_res['device_name'];
                        $row_array_res['model_number'] = $row_array_qr_person_res['model_number'];
                        $row_array_res['serial_number'] = $row_array_qr_person_res['serial_number'];
                        $row_array_res['color'] = $row_array_qr_person_res['color'];
                        $row_array_res['image'] = $row_array_qr_person_res['image'];
                        $row_array_res['image_path'] = $row_array_qr_person_res['image_path'] != null ? $base_url . '/uploads' . $row_array_qr_person_res['image_path'] : null;
                        $row_array_res['description'] = $row_array_qr_person_res['description'];
                        $row_array_res['things_mobile_no'] = $row_array_qr_person_res['mobile_no'];
                        $row_array_res['location'] = $row_array_qr_person_res['location'];
                        $row_array_res['lat'] = $row_array_qr_person_res['lat'];
                        $row_array_res['long'] = $row_array_qr_person_res['long'];                    }
                        $row_array_res['created_at'] = $row_array_qr_person_res['created_at'];
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
                        $qr_code_result['first_name'] = $row_array_users_res['first_name'];
                        $qr_code_result['last_name'] = $row_array_users_res['last_name'];
                        $qr_code_result['email'] = $row_array_users_res['email'];
                        $qr_code_result['blood_group'] = $row_array_users_res['blood_group'];
                        $qr_code_result['mobile_no'] = $row_array_users_res['mobile_no'];
                        $qr_code_result['profile_image'] = $row_array_users_res['profile_image'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image'] : null;
                        $qr_code_result['profile_image_thumb'] = $row_array_users_res['profile_image_thumb'] != null ? $base_url . 'uploads' . $row_array_users_res['profile_image_thumb'] : null;
                    }
                    $this->db->select('emergency_contacts.id, emergency_contacts.user_id, emergency_contacts.emergency_user_id, emergency_contacts.serial_no, emergency_contacts.name, emergency_contacts.is_deleted, users.mobile_no ');
                    $this->db->from('emergency_contacts');
                    $this->db->join('users', 'users.id = emergency_contacts.emergency_user_id', 'left');
                    $this->db->where('emergency_contacts.user_id', $user_id);
                    $this->db->where('emergency_contacts.is_deleted', 0);
                    $this->db->order_by('emergency_contacts.serial_no', 'ASC');
                    $q = $this->db->get();

                    $qr_code_id = $row_array_res['id'];
                    $this->db->select('qr_self.id, qr_self.qr_code_id, qr_self.user_id, qr_self.is_deleted, qr_self.created_at, qr_self.location, qr_self.lat, qr_self.long ');
                    $this->db->from('qr_self');
                    $this->db->where('qr_self.user_id', $user_id);
                    $this->db->where('qr_self.qr_code_id', $qr_code_id);
                    $q = $this->db->get();
                    $row_array_qr_self_res = $q->row_array();
                    if ($row_array_qr_self_res) {
                        $row_array_res['location'] = $row_array_qr_self_res['location'];
                        $row_array_res['lat'] = $row_array_qr_self_res['lat'];
                        $row_array_res['long'] = $row_array_qr_self_res['long'];
                        $row_array_res['created_at'] = $row_array_qr_person_res['created_at'];
                    } else {
                        $row_array_res['location'] = '';
                        $row_array_res['lat'] ='';
                        $row_array_res['long'] ='';
                        $row_array_res['created_at'] = '';
                    }
                    
                    $result_array_emergency_contacts = $q->result_array();
                    $row_array_res['emergency_contacts'] = $result_array_emergency_contacts;
                }
            }
            return $row_array_res;
        } else {
            return array();
        }
    }

    public function checkQrCode($code = "", $id = null) {
        if ($id != null) {
            $this->db->where('qr_code.code', $code);
            $this->db->where('qr_code.id !=', $id);
            $this->db->where('qr_code.is_deleted', "0");
            $this->db->from('qr_code');
            $q = $this->db->get();
        } else {
            $this->db->where('qr_code.code', $code);
            $this->db->where('qr_code.is_deleted', "0");
            $this->db->from('qr_code');
            $q = $this->db->get();
        }
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function AddQrcode($data) {
        date_default_timezone_set('Asia/Kolkata');
        if ($data) {
            $insert_data = array(
                'code' => $data['code'],
                'code_for' => $data['code_for'],
                'type' => $data['type'],
                'type_title' => $data['type_title'],
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('qr_code', $insert_data);
            return $this->db->insert_id();
        }
    }

    public function addQrcodeTempData($insert_data, $session_id) {
        date_default_timezone_set('Asia/Kolkata');
        $data = array(
            'code' => isset($insert_data['0']) ? $insert_data['0'] : null,
            'type' => isset($insert_data['1']) ? $insert_data['1'] : null,
            'qr_code_id' => isset($insert_data['2']) ? $insert_data['2'] : null,
            'session_id' => $session_id,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('tmp_bulk_qr_code', $data);
        return $this->db->insert_id();
    }

    public function getBulkTempQrcode($session_id) {
        $this->db->select('id, qr_code_id, code, type, is_declined,is_updated, session_id, created_at');
        $this->db->where('session_id', $session_id);
        $this->db->from('tmp_bulk_qr_code');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getDeclinedBulkQrcode($session_id) {
        $this->db->where('session_id', $session_id);
        $this->db->where('is_declined', '1');
        $this->db->from('tmp_bulk_qr_code');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getUpdatedBulkQrcode($session_id) {
        $this->db->where('session_id', $session_id);
        $this->db->where('is_updated', '1');
        $this->db->from('tmp_bulk_qr_code');
        $q = $this->db->get();
        $result = $q->result_array();
        foreach ($result as $key => $value) {
            $type_val = "";
            if ($value['type'] == '1') {
                $type_val = "Person";
            }
            if ($value['type'] == '2') {
                $type_val = "Pet";
            }
            if ($value['type'] == '3') {
                $type_val = "Thing";
            }
            $result[$key]['type'] = $type_val;

            $action = "";
            if ($value['is_updated'] == 1) {
                $action = "Update";
            }
            if ($value['is_updated'] == 0) {
                $action = "Insert";
            }
            $result[$key]['action'] = $action;
            $result[$key]['sr_no'] = $key + 1;
        }
        return $result;
    }

    public function saveBulkQrcodeImportData($session_id) {
        date_default_timezone_set('Asia/Kolkata');
        $data = $this->getBulkQrcodeTempData($session_id);
        foreach ($data as $k => $v) {
            if ($v['code']) {

                if ($v['code'] != null && $v['is_updated'] == '1') {
                    if ($v['qr_code_id']) {
                        $type = NULL;
                        $type_title_val = NULL;
                        $code_for = NULL;
                        if ($v['type'] == '1') {
                            $type_title_val = "Person";
                            $type = '1';
                            $code_for = '1';
                        }
                        if ($v['type'] == '2') {
                            $type_title_val = "Pet";
                            $type = '2';
                            $code_for = '2';
                        }
                        if ($v['type'] == '3') {
                            $type_title_val = "Thing";
                            $type = '3';
                            $code_for = '2';
                        }

                        $update_data = array(
                            'type' => $type,
                            'type_title' => $type_title_val,
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        $this->db->where('id', $v['qr_code_id']);
                        $this->db->update('qr_code', $update_data);
                    }
                } else {
                    $check_current_info = $this->db->get_where('qr_code', array(
                                'code' => trim($v['code']),
                                'is_deleted' => '0'))->row();
                    if ($check_current_info) {
                        $this->db->where('is_deleted', '0');
                        $this->db->where('code', trim($v['code']));
                        $this->db->update('qr_code',
                                array('is_deleted' => '1', 'updated_at' => date('Y-m-d H:i:s'))
                        );
                    }
                    $type = NULL;
                    $type_val = NULL;
                    $code_for = NULL;
                    if ($v['type'] == '1') {
                        $type_val = "Person";
                        $code_for = '2';
                        $type = '1';
                    }
                    if ($v['type'] == '2') {
                        $type_val = "Pet";
                        $code_for = '2';
                        $type = '2';
                    }
                    if ($v['type'] == '3') {
                        $type_val = "Thing";
                        $code_for = '2';
                        $type = '3';
                    }
                    $insert_data = array(
                        'code' => $v['code'],
                        'code_for' => $code_for,
                        'type' => $type,
                        'type_title' => $type_val,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $this->db->insert('qr_code', $insert_data);
                    $inserted_user_id = $this->db->insert_id();
                }
            } else {
                $this->db->where('id', $v['id']);
                $this->db->update('tmp_bulk_qr_code', array('is_declined' => '1'));
            }
        }
        return $this->db->affected_rows();
    }

    public function getBulkQrcodeTempData($session_id) {
        $this->db->where('is_declined', '0');
        $this->db->where('session_id', $session_id);
        $this->db->from('tmp_bulk_qr_code');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function removeBulkQrcodeTempData($session_id) {
        $this->db->where('is_declined', '0');
        $this->db->where('session_id', $session_id);
        $this->db->delete('tmp_bulk_qr_code');
        return true;
    }

    public function clearBulkQrcodeTempData($session_id) {
        $this->db->where('session_id', $session_id);
        $this->db->delete('tmp_bulk_qr_code');
        return true;
    }

    public function changeMissingStatus($id, $missing_status) {
        date_default_timezone_set('Asia/Kolkata');
        $update_data = array(
            'missing_status' => $missing_status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $query = $this->db->update('qr_code', $update_data);
        return $query;
    }

    public function getUnusedQrCode() {
        $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.type, qr_code.type_title, qr_code.code_for, qr_code.missing_status, qr_code.is_deleted, qr_code.created_at');
        $this->db->from('qr_code');
        $this->db->where('qr_code.user_id IS NULL', NULL, FALSE);
        $this->db->order_by('qr_code.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getQrCodeMissingAlertList() {
        $this->db->select('qr_code_missing_alert.id, qr_code_missing_alert.qr_code_id, qr_code_missing_alert.first_name, qr_code_missing_alert.last_name, qr_code_missing_alert.mobile_no, qr_code_missing_alert.latitude, qr_code_missing_alert.longitude, qr_code_missing_alert.created_at, qr_code.code');
        $this->db->join('qr_code', 'qr_code.id = qr_code_missing_alert.qr_code_id', 'left');
        $this->db->from('qr_code_missing_alert');
        $this->db->order_by('qr_code_missing_alert.id', 'desc');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function getQrCodeScanAlertList() {
        $this->db->select('qr_code_scan_alert.id, qr_code_scan_alert.qr_code_id, qr_code_scan_alert.latitude, qr_code_scan_alert.longitude, qr_code_scan_alert.created_at, qr_code.code');
        $this->db->join('qr_code', 'qr_code.id = qr_code_scan_alert.qr_code_id', 'left');
        $this->db->from('qr_code_scan_alert');
        $this->db->order_by('qr_code_scan_alert.id', 'desc');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function getChildQrCodeNameById($post_qr_code_id) {
        $this->db->select('id, user_id, code, type, type_title, code_for, missing_status, is_deleted, created_at');
        $this->db->where('is_deleted', '0');
        $this->db->where('qr_code.parent_qr_id', $post_qr_code_id);
        $this->db->order_by('qr_code.id', 'desc');
        $this->db->from('qr_code');
        $res = $this->db->get();
        $qr_code_result = $res->result_array();
        return $qr_code_result;
    }

    public function getMissingStatusQrCode() {
        $this->db->select('qr_code.id, qr_code.user_id, qr_code.code, qr_code.type, qr_code.type_title, qr_code.code_for, qr_code.missing_status, qr_code.is_deleted, qr_code.created_at, qr_code.updated_at, users.first_name, users.last_name, users.mobile_no');
        $this->db->join('users', 'users.id = qr_code.user_id', 'left');
        $this->db->where('qr_code.is_deleted', '0');
        $this->db->where('qr_code.missing_status', '2');
        $this->db->from('qr_code');
        $this->db->order_by('qr_code.updated_at', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function sendNotificationMessageOnesignal($message) {
        $msg = $message;
        $content = array(
            "en" => $msg
        );
        $headings = array(
            "en" => "Captain INDIA",
        );
        $hashes_array = array();
        $fields = array(
            // 'app_id' => "67ec0441-3085-4e29-8f11-ebc163cf0cc2", //live
            // 'app_id' => "72acf895-0883-4691-90c4-a235689129bb",
            'app_id' => "8ad390eb-06a8-4c5b-857a-be72e9e8f1f7",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'headings' => $headings,
            'contents' => $content,
            "url" => $url,
        );
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            // 'Authorization: Basic ZjNkY2M5YjktOTllNC00ZTdkLWFlY2MtYzAxYTdmMGY4MGFl' //live
            // 'Authorization: Basic ZTYxMzMzYTItYTM1OS00Y2EyLTk5NWUtM2RkNDAxODcwNjU0'
            'Authorization: Basic MjI3YmI3NTEtOWRjNy00OWIwLWEyZTItNTNmZDc1NmRjMzNk' // uat
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function saveNotificationMessage($save_notification_arr, $table_name) {
        $this->db->insert($table_name, $save_notification_arr);
        return $this->db->insert_id();
    }

    public function getMissingStatusNotification() {
        $this->db->select('qr_code_notification.id, qr_code_notification.message_type, qr_code_notification.qr_code_id, qr_code_notification.qr_code, qr_code_notification.device_token, qr_code_notification.message, qr_code_notification.message_response, qr_code_notification.is_deleted, qr_code_notification.created_at, qr_code_notification.updated_at ');
        $this->db->where('qr_code_notification.is_deleted', '0');
        $this->db->where('qr_code_notification.message_type', '2');
        $this->db->from('qr_code_notification');
        $this->db->order_by('qr_code_notification.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

}

?>