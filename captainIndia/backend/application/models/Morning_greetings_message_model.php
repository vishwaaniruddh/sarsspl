<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Morning_greetings_message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getMorningGreetings($uid = '') {
        $this->db->select('morning_greetings_message.id,morning_greetings_message.message_date,morning_greetings_message.title ,morning_greetings_message.message , morning_greetings_message.created_at ');
//        $this->db->select('morning_greetings_message.*');
        $this->db->from('morning_greetings_message');
        $this->db->where('is_deleted', '0');
        
         // 14-jul-2022
        if($uid !="" && $uid != 1 ) {
            $this->db->where('tenant_id', $uid);
        }
        
        $this->db->order_by('message_date', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function addMorningMsg($insert_data) {
        $this->db->insert('morning_greetings_message', $insert_data);
        return $this->db->insert_id();
    }

    public function getMorningGreetingsById($id = '') {
        $this->db->where('morning_greetings_message.id', $id);
        $this->db->from('morning_greetings_message');
        return $q = $this->db->get()->row();
    }

    public function deleteMorningGreetings($id) {
        $this->db->where('id', $id);
        return $this->db->update('morning_greetings_message', array('is_deleted' => '1'));
    }

    public function UpdateMorningGreetingsInfo($data, $id) {
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
                
                 //16-jul-2022
                'tenant_id' => $data['tenant_id'] ? $data['tenant_id'] : 1 ,
            );
            $this->db->where('id', $id);
            $this->db->update('morning_greetings_message', $update_data);
            return true;
        } else {
            return false;
        }
    }

    public function AddMorningGreetingsInfo($data) {
        // 8-jun-2022
			date_default_timezone_set('Asia/Kolkata');
			
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        if ($data) {
            $insert_data = array(
                'message_date' => $data['message_date'],
                'title' => $data['title'],
                'message' => $data['message'],
                
                //// 8-jun-2022
                'created_at' => date('Y-m-d H:i:s'),
                
                //16-jul-2022
                'tenant_id' => $data['tenant_id'] ? $data['tenant_id'] : 1 ,
            );
            $this->db->insert('morning_greetings_message', $insert_data);
            return true;
        }
    }

    public function checkDateMorningGreetings($data, $id = "") {
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        if ($id) {
            $data = $this->array_flatten($res);
            $message_date = $data['message_date'];
            $this->db->where('morning_greetings_message.message_date', $message_date);
            $this->db->where('morning_greetings_message.id !=', $id);
            $this->db->where('morning_greetings_message.is_deleted', "0");
            $this->db->from('morning_greetings_message');
            $q = $this->db->get();
        } else {
            $data = $this->array_flatten($res);
            $message_date = $data['message_date'];
            $this->db->where('morning_greetings_message.message_date', $message_date);
            $this->db->where('morning_greetings_message.is_deleted', "0");
            $this->db->from('morning_greetings_message');
            $q = $this->db->get();
        }
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function getMorningGreetingsByDate($message_date) {
        $this->db->where('morning_greetings_message.message_date', $message_date);
        $this->db->where('morning_greetings_message.is_deleted', "0");
        $this->db->from('morning_greetings_message');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
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

}

?>