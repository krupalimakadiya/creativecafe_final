<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_model {

    public function getcountrylist() {
        $query = $this->db->query("select * from country_master");
        return $query->result();
    }

    public function getstatelist() {
        $query = $this->db->query("select * from country_master as c,state_master as s where s.country_id=c.country_id");
        return $query->result();
    }

    /* public function getcountryid($country_name) {
      $query = $this->db->query("select * from country_master where country_name='$country_name'");
      return $query->row_array();
      } */

    public function insert($country_id, $state_name) {
        $data = array('country_id' => $country_id,
            'state_name' => $state_name);
        $this->db->insert('state_master', $data);
    }

    public function check_data($country_id, $state_name) {
        $query = $this->db->query("select * from state_master where country_id='$country_id' AND state_name='$state_name' ");
        return $query->row_array();
    }

    public function edit_data($state_id) {
        $query = $this->db->query("select * from country_master as c, state_master as s where state_id='$state_id'");
        return $query->row_array();
    }

    public function update_data($state_id, $country_id, $state_name) {
        $data = array(
            'country_id' => $country_id,
            'state_name' => $state_name,
        );
        $this->db->where('state_id', $state_id);
        $this->db->update('state_master', $data);
    }

    public function delete($state_id) {
        $this->db->where('state_id', $state_id);
        $this->db->delete('state_master');
    }

    public function update_active($state_id, $status) {
        $data = array(
            'state_id' => $state_id,
            'status' => 1
        );
        $this->db->where('state_id', $state_id);
        $this->db->update('state_master', $data);
    }

    public function update_deactive($state_id, $status) {
        $data = array(
            'state_id' => $state_id,
            'status' => 0
        );
        $this->db->where('state_id', $state_id);
        $this->db->update('state_master', $data);
    }

}
