<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Birthday_greetings_message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getBirthdayGreetings($uid = '') {
        $this->db->select('birthday_greetings_message.id,birthday_greetings_message.title,birthday_greetings_message.message,birthday_greetings_message.created_at');
        $this->db->from('birthday_greetings_message');
        $this->db->where('is_deleted', '0');
        // 14-jul-2022
        if($uid !="" && $uid != 1 ) {
            $this->db->where('tenant_id', $uid);
        }
        $this->db->order_by('id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function deleteBirthdayGreetings($id) {
        $this->db->where('id', $id);
        return $this->db->update('birthday_greetings_message', array('is_deleted' => '1'));
    }

    public function getBirthdayGreetingsById($id = '') {
        $this->db->where('birthday_greetings_message.id', $id);
        $this->db->from('birthday_greetings_message');
        return $q = $this->db->get()->row();
    }

    public function UpdateBirthdayGreetingsInfo($data, $id) {
         // 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        if ($id) {
            $update_data = array(
                'title' => $data['title'],
                'message' => $data['message'],
                'updated_at ' => date('Y-m-d H:i:s'),
                
                //16-jul-2022
                'tenant_id' => $data['tenant_id'] ? $data['tenant_id'] : 1 ,
            );
            $this->db->where('id', $id);
            $this->db->update('birthday_greetings_message', $update_data);
            return true;
        } else {
            return false;
        }
    }

    public function AddBirthdayGreetingsInfo($data) {
        // 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        
        foreach ($data as $key => $value) {
            $res[] = array($value->name => $value->value);
        }
        $data = $this->array_flatten($res);
        if ($data) {
            $insert_data = array(
                'message' => $data['message'],
                'title' => $data['title'],
                    //'days' => $data['days'],
                    
                // 8-jun-2022
                'created_at' => date('Y-m-d H:i:s'),
                
                //17-jun-2022
                'tenant_id' => $data['tenant_id'] ? $data['tenant_id'] : 1 ,
            );
            $this->db->insert('birthday_greetings_message', $insert_data);
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

    public function addBirthdayGreetingsMsg($insert_data) {
        $this->db->insert('birthday_greetings_message', $insert_data);
        return $this->db->insert_id();
    }

}

?>