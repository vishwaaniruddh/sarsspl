<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulletin_news_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getBulletinNews($tid = '') {
        // $this->db->select('bulletin_news.id,bulletin_news.title,bulletin_news.description,bulletin_news.created_at, users.first_name as tenant_first_name, users.last_name as tenant_last_name');
        $this->db->select('bulletin_news.id,bulletin_news.title,bulletin_news.description,bulletin_news.created_at, user_admin.first_name as tenant_first_name, user_admin.last_name as tenant_last_name');
        $this->db->from('bulletin_news');
        // $this->db->join('users', 'users.id = bulletin_news.tenant_id', 'left');
        $this->db->join('user_admin', 'user_admin.id = bulletin_news.tenant_id', 'left');

        $this->db->where('bulletin_news.is_deleted', '0');

        // 14-jul-2022
        if ($tid != "" && $tid != 1) {
            $this->db->where('bulletin_news.tenant_id', $tid);
        }

        $this->db->order_by('bulletin_news.id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function deleteBulletinNews($id) {
        $this->db->where('id', $id);
        return $this->db->update('bulletin_news', array('is_deleted' => '1'));
    }

    public function getBulletinNewsById($id = '') {
        $this->db->where('bulletin_news.id', $id);
        $this->db->from('bulletin_news');
        $this->db->where('is_deleted', '0');
        return $q = $this->db->get()->row();
    }

    public function UpdateBulletinNewsInfo($data, $id, $image_name) {
//        foreach ($data as $key => $value) {
//            $res[] = array($value->name => $value->value);
//        }
//        $data = $this->array_flatten($res);
        // START - 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');

        if ($id) {
            if ($image_name != null) {
                $update_data = array(
                    'title' => $data['title'],
                    // 'description' => $data['description'],
                    'description' => unhtmlspecialchars($data['description']),
                    'editor_description' => $data['editor_description'],
                    'news_date' => $data['news_date'],
                    'news_source' => $data['news_source'],
                    'image' => $data['image'],
                    'image_path' => $data['image_path'],
                    'updated_at ' => date('Y-m-d H:i:s')
                );
            } else {
                $update_data = array(
                    'title' => $data['title'],
                    // 'description' => $data['description'],
                    'description' => unhtmlspecialchars($data['description']),
                    'editor_description' => $data['editor_description'],
                    'news_date' => $data['news_date'],
                    'news_source' => $data['news_source'],
                    'updated_at ' => date('Y-m-d H:i:s')
                );
            }
            if (isset($data['video']) && $data['video'] != null) {
                $update_data['video'] = $data['video'];
                $update_data['video_path'] = $data['video_path'];
            }
            if (isset($data['audio']) && $data['audio'] != null) {
                $update_data['audio'] = $data['audio'];
                $update_data['audio_path'] = $data['audio_path'];
            }
            if (isset($data['video_thumbnail_image']) && $data['video_thumbnail_image'] != null) {
                $update_data['video_thumbnail_image'] = $data['video_thumbnail_image'];
                $update_data['video_thumbnail_image_path'] = $data['video_thumbnail_image_path'];
            }
            if (isset($data['audio_thumbnail_image']) && $data['audio_thumbnail_image'] != null) {
                $update_data['audio_thumbnail_image'] = $data['audio_thumbnail_image'];
                $update_data['audio_thumbnail_image_path'] = $data['audio_thumbnail_image_path'];
            }
            $this->db->where('id', $id);
            $this->db->update('bulletin_news', $update_data);
//            echo $this->db->last_query();
            return true;
        } else {
            return false;
        }
    }

    public function AddBulletinNewsInfo($data) {
//        foreach ($data as $key => $value) {
//            $res[] = array($value->name => $value->value);
//        }
//        $data = $this->array_flatten($res);
        // START - 8-jun-2022
        date_default_timezone_set('Asia/Kolkata');
        if ($data) {
            $insert_data = array(
                'type' => $data['type'],
                'title' => $data['title'],
                // 'description' => $data['description'],
                'description' => unhtmlspecialchars($data['description']),
                'editor_description' => $data['editor_description'],
                'news_date' => $data['news_date'],
                'news_source' => $data['news_source'],
                'image' => $data['image'],
                'image_path' => $data['image_path'],
                'video' => $data['video'],
                'video_path' => $data['video_path'],
                //24-jun-2022
                'audio' => $data['audio'],
                'audio_path' => $data['audio_path'],
                //14-jul-2022
                'tenant_id' => $data['tenant_id'],
                'video_thumbnail_image' => $data['video_thumbnail_image'],
                'video_thumbnail_image_path' => $data['video_thumbnail_image_path'],
                'audio_thumbnail_image' => $data['audio_thumbnail_image'],
                'audio_thumbnail_image_path' => $data['audio_thumbnail_image_path'],
                // START - 8-jun-2022
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('bulletin_news', $insert_data);
            if ($this->db->insert_id()) {
                $bulletin_news_id = $this->db->insert_id();
                if ($data['bulletin_tag'] != "") {
                    $bulletin_tag = $data['bulletin_tag'];
                    $bulletin_tag_arr = explode(',', $bulletin_tag);
                    if (!empty($bulletin_tag_arr)) {
                        foreach ($bulletin_tag_arr as $row) {
                            $insert_data = array(
                                'bulletin_news_id' => $bulletin_news_id,
                                'bulletin_tag_id' => $row,
                                'tenant_id' => $data['tenant_id'],
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->db->insert('bulletin_news_tag', $insert_data);
                        }
                    }
                }
            }
            return $bulletin_news_id;
            // return true;
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

    // 16-nov-2022
    public function getBulletinTag($tenant_id = null) {
        $this->db->select('bulletin_tag.id, bulletin_tag.title, bulletin_tag.status, bulletin_tag.created_at');
        $this->db->from('bulletin_tag');
        $this->db->where('is_deleted', '0');
        if ($tenant_id != null && $tenant_id != 1) {
            $this->db->where('tenant_id', $tenant_id);
        }
        $this->db->order_by('id', 'desc');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function getBulletinTagById($id = '') {
        $this->db->where('bulletin_tag.id', $id);
        $this->db->from('bulletin_tag');
        $this->db->where('is_deleted', '0');
        return $q = $this->db->get()->row();
    }

    public function deleteBulletinTag($id) {
        $this->db->where('id', $id);
        $query = $this->db->update('bulletin_tag', array('is_deleted' => '1'));
        return $query;
    }

    public function UpdateBulletinTag($data, $id) {
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            $update_data = array(
                'title' => $data['title'],
                'status' => $data['status'],
                'updated_at ' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $id);
            $this->db->update('bulletin_tag', $update_data);
            return true;
        } else {
            return false;
        }
    }

    public function AddBulletinTag($data) {
        date_default_timezone_set('Asia/Kolkata');
        if ($data) {
            $insert_data = array(
                'title' => $data['title'],
                'status' => $data['status'],
                'tenant_id' => $data['tenant_id'],
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('bulletin_tag', $insert_data);
            return $this->db->insert_id();
        }
    }

    public function UpdateBulletinNewsTag($id, $bulletin_tag_arr, $tenant_id) {
        date_default_timezone_set('Asia/Kolkata');
        $this->db->select('bulletin_news_tag.bulletin_news_id, bulletin_news_tag.bulletin_tag_id, bulletin_news_tag.is_deleted');
        $this->db->from('bulletin_news_tag');
        $this->db->where('bulletin_news_tag.bulletin_news_id', $id);
        $this->db->where('bulletin_news_tag.is_deleted', '0');
        $q = $this->db->get();
        $bulletin_news_tag_res = $q->result_array();
        $add_id_arr = $bulletin_tag_arr;
        $delete_id_arr = array();
        if ($bulletin_news_tag_res) {
            $bulletin_news_tag_res_arr = array_column($bulletin_news_tag_res, 'bulletin_tag_id');
            $delete_id_arr = array_diff($bulletin_news_tag_res_arr, $bulletin_tag_arr);
            $add_id_arr = array_diff($bulletin_tag_arr, $bulletin_news_tag_res_arr);
        }

        if ($delete_id_arr) {
            foreach ($delete_id_arr as $row) {
                $update_data = array(
                    'is_deleted' => '1',
                    'updated_at ' => date('Y-m-d H:i:s')
                );
                $this->db->where('bulletin_news_id', $id);
                $this->db->where('bulletin_tag_id', $row);
                $this->db->update('bulletin_news_tag', $update_data);
            }
        }
        if ($add_id_arr) {
            foreach ($add_id_arr as $row) {
                $insert_data = array(
                    'bulletin_news_id' => $id,
                    'bulletin_tag_id' => $row,
                    'tenant_id' => $tenant_id,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('bulletin_news_tag', $insert_data);
            }
        }
    }

    public function getBulletinNewsTagById($id) {
        $this->db->select('bulletin_news_tag.bulletin_news_id, bulletin_news_tag.bulletin_tag_id, bulletin_news_tag.is_deleted, bulletin_tag.title');
        $this->db->from('bulletin_news_tag');
        $this->db->join('bulletin_tag', 'bulletin_tag.id = bulletin_news_tag.bulletin_tag_id', 'left');
        $this->db->where('bulletin_news_tag.bulletin_news_id', $id);
        $this->db->where('bulletin_news_tag.is_deleted', '0');
        $q = $this->db->get();
        $bulletin_news_tag_res = $q->result_array();
        return $bulletin_news_tag_res;
    }

    public function checkBulletinTagTitle($title = "", $tenant_id, $id = null) {
        if ($id != null) {
            $this->db->where('bulletin_tag.tenant_id', $tenant_id);
            $this->db->where('bulletin_tag.title', $title);
            $this->db->where('bulletin_tag.id !=', $id);
            $this->db->where('bulletin_tag.is_deleted', "0");
            $this->db->from('bulletin_tag');
            $q = $this->db->get();
        } else {
            $this->db->where('bulletin_tag.tenant_id', $tenant_id);
            $this->db->where('bulletin_tag.title', $title);
            $this->db->where('bulletin_tag.is_deleted', "0");
            $this->db->from('bulletin_tag');
            $q = $this->db->get();
        }
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return 0;
        }
    }

    public function changeStatusBulletinTag($id, $status) {
        $this->db->where('id', $id);
        $query = $this->db->update('bulletin_tag', array('status' => $status));
        return $query;
    }

}

?>