<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_model {

    public function getcitylist() {
        $query = $this->db->query("select * from country_master as c, state_master as s, city_master as city where city.country_id=c.country_id and city.state_id=s.state_id ");
        return $query->result();
    }

    public function insert($country_id, $state_id, $city_name) {
        $data = array('country_id' => $country_id,
            'state_id' => $state_id,
            'city_name' => $city_name);
        $this->db->insert('city_master', $data);
    }

    //chk if record exists or not
    public function check_data($country_id, $state_id, $city_name) {
        $query = $this->db->query("select * from city_master where country_id='$country_id' AND state_id='$state_id' AND city_name='$city_name' ");
        return $query->row_array();
    }

    public function edit_data($city_id) {
        $query = $this->db->query("select * from  city_master  where city_id='$city_id' ");
        return $query->row_array();
    }

    public function update_data($city_id, $country_id, $state_id, $city_name) {
        $data = array(
            'city_id' => $city_id,
            'country_id' => $country_id,
            'state_id' => $state_id,
            'city_name' => $city_name,
        );
        $this->db->where('city_id', $city_id);
        $this->db->update('city_master', $data);
    }

    public function delete($city_id) {
        $this->db->where('city_id', $city_id);
        $this->db->delete('city_master');
    }

    public function drop_state($country_id) {
        $query = $this->db->query("select * from  state_master where country_id='$country_id' ");
        return $query->result();
    }

    public function update_active($city_id, $status) {
        $data = array(
            'city_id' => $city_id,
            'status' => 1
        );
        $this->db->where('city_id', $city_id);
        $this->db->update('city_master', $data);
    }

    public function update_deactive($city_id, $status) {
        $data = array(
            'city_id' => $city_id,
            'status' => 0
        );
        $this->db->where('city_id', $city_id);
        $this->db->update('city_master', $data);
    }

}
