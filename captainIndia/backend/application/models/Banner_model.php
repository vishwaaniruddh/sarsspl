<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getBanner($tid = '') {
        $this->db->select('banners.id, banners.title, banners.image_url, banners.redirection_url, banners.created_at');
        $this->db->from('banners');
        $this->db->where('banners.is_deleted', '0');
        if ($tid != "" && $tid != 1) {
            $this->db->where('banners.tenant_id', $tid);
        }
        $this->db->order_by('banners.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function AddBanner($data) {
        date_default_timezone_set('Asia/Kolkata');
        if ($data) {
            if ($data['image_name'] != null) {
                $insert_data = array(
                    'title' => $data['title'],
                    'redirection_url' => $data['redirection_url'],
                    'image_name' => $data['image_name'],
                    'image_url' => $data['image_url'],
                    'tenant_id' => $data['tenant_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                );
            } else {
                $insert_data = array(
                    'title' => $data['title'],
                    'redirection_url' => $data['redirection_url'],
                    'tenant_id' => $data['tenant_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                );
            }
            $this->db->insert('banners', $insert_data);
            return $this->db->insert_id();
        }
    }

    public function deleteBanner($id) {
        $this->db->where('id', $id);
        $query = $this->db->update('banners', array('is_deleted' => '1'));
        return $query;
    }

    public function getBannerById($id = '') {
        $this->db->where('banners.id', $id);
        $this->db->from('banners');
        $this->db->where('is_deleted', '0');
        return $q = $this->db->get()->row();
    }

    public function UpdateBanner($data, $id, $image_name = null) {
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            if ($image_name != null) {
                $update_data = array(
                    'title' => $data['title'],
                    'redirection_url' => $data['redirection_url'],
                    'image_name' => $data['image_name'],
                    'image_url' => $data['image_url'],
                    'updated_at ' => date('Y-m-d H:i:s')
                );
            } else {
                $update_data = array(
                    'title' => $data['title'],
                    'redirection_url' => $data['redirection_url'],
                    'updated_at ' => date('Y-m-d H:i:s')
                );
            }
            $this->db->where('id', $id);
            $this->db->update('banners', $update_data);
            return true;
        } else {
            return false;
        }
    }

}

?>