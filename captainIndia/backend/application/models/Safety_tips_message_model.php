<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Safety_tips_message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSafetyTips($uid = '') {
        $this->db->select('safety_tips_message.id,safety_tips_message.message_date,safety_tips_message.title,safety_tips_message.message, safety_tips_message.created_at');
        $this->db->from('safety_tips_message');
        $this->db->where('is_deleted', '0');
        
        // 14-jul-2022
        if($uid !="" && $uid != 1 ) {
            $this->db->where('tenant_id', $uid);
        }
        
        $this->db->order_by('message_date', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getSafetyTipsMessageById($id = '') {
        $this->db->where('safety_tips_message.id', $id);
        $this->db->from('safety_tips_message');
        return $q = $this->db->get()->row();
    }

    public function deleteSafetyTips($id) {
        $this->db->where('id', $id);
        return $this->db->update('safety_tips_message', array('is_deleted' => '1'));
    }

    public function checkDateSafetyTips($data, $id = "") {
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        if ($id) {
            $data = $this->array_flatten($res);
            $message_date = $data['message_date'];
            $this->db->where('safety_tips_message.message_date', $message_date);
            $this->db->where('safety_tips_message.id !=', $id);
            $this->db->where('safety_tips_message.is_deleted', "0");
            $this->db->from('safety_tips_message');
            $q = $this->db->get();
        } else {
            $data = $this->array_flatten($res);
            $message_date = $data['message_date'];
            $this->db->where('safety_tips_message.message_date', $message_date);
            $this->db->where('safety_tips_message.is_deleted', "0");
            $this->db->from('safety_tips_message');
            $q = $this->db->get();
        }
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function AddSafetyTipsInfo($data) {
        // 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        if ($data) {
            $insert_data = array(
                'message_date' => $data['message_date'],
                'message' => $data['message'],
                'title' => $data['title'],
                //'days' => $data['days'],
                
                // 8-jun-2022
                'created_at' => date('Y-m-d H:i:s'),
                
                //17-jun-2022
                'tenant_id' => $data['tenant_id'] ? $data['tenant_id'] : 1 ,
            );
            $this->db->insert('safety_tips_message', $insert_data);
            // echo $this->db->last_query();exit;
            return true;
        }
    }

    public function array_flatten($array) {

        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function UpdateSafetyTipsInfo($data, $id) {
        // 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        if ($id) {
            $update_data = array(
                'message_date' => $data['message_date'],
                'title' => $data['title'],
                'message' => $data['message'],
                'updated_at ' => date('Y-m-d H:i:s'),
                
                 //17-jun-2022
                'tenant_id' => $data['tenant_id'] ? $data['tenant_id'] : 1 ,
            );
            $this->db->where('id', $id);
            $this->db->update('safety_tips_message', $update_data);
            return true;
        } else {
            return false;
        }
    }

    public function getSafetyTipsByDate($message_date) {
        $this->db->where('safety_tips_message.message_date', $message_date);
        $this->db->where('safety_tips_message.is_deleted', "0");
        $this->db->from('safety_tips_message');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function addSafetyTipsMsg($insert_data) {
        $this->db->insert('safety_tips_message', $insert_data);
        return $this->db->insert_id();
    }

}

?>