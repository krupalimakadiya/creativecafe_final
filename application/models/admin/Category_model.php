<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function insert($art_category_name) {
        $data = array('art_category_name' => $art_category_name);
        $this->db->insert('art_category_master', $data);
    }

    public function check_data($art_category_name) {
        $query = $this->db->query("select * from art_category_master where art_category_name='$art_category_name'");
        return $query->row_array();
    }

    public function getcategorylist() {
        $query = $this->db->query("select * from art_category_master");
        return $query->result();
    }

    public function edit_data($art_category_id) {
        $query = $this->db->query("select * from art_category_master where art_category_id='$art_category_id'");

        return $query->row_array();
    }

    public function update_data($art_category_id, $art_category_name) {
        $data = array(
            'art_category_name' => $art_category_name,
        );
        $this->db->where('art_category_id', $art_category_id);
        $this->db->update('art_category_master', $data);
    }

    public function delete($art_category_id) {
        $this->db->where('art_category_id', $art_category_id);
        $this->db->delete('art_category_master');
    }

    public function update_active($art_category_id, $status) {
        $data = array(
            'art_category_id' => $art_category_id,
            'status' => 1
        );
        $this->db->where('art_category_id', $art_category_id);
        $this->db->update('art_category_master', $data);
    }

    public function update_deactive($art_category_id, $status) {
        $data = array(
            'art_category_id' => $art_category_id,
            'status' => 0
        );
        $this->db->where('art_category_id', $art_category_id);
        $this->db->update('art_category_master', $data);
    }

}
