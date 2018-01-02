<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {

    public function getuserlist() {
        $query = $this->db->query("select * from user_master  as user, country_master as c, state_master as s, city_master as city where user.country_id=c.country_id and user.state_id=s.state_id and user.city_id=city.city_id ");
        return $query->result();
    }

    public function insert($first_name, $last_name, $country_id, $state_id, $city_id, $pincode, $email, $mobile) {
        $data = array('first_name' => $first_name,
            'last_name' => $last_name,
            'country_id' => $country_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
            'email' => $email,
            'mobile' => $mobile);
        $this->db->insert('user_master', $data);
    }

    //chk if record exists in database  or not 
    public function check_data($first_name, $last_name, $country_id, $state_id, $city_id, $pincode, $email, $mobile) {
        $query = $this->db->query("select * from user_master where first_name='$first_name' AND  last_name='$last_name' AND
                                                             country_id='$country_id' AND 
                                                                 state_id='$state_id' AND
                                                                      city_id='$city_id' AND
                                                                          pincode = '$pincode' AND
                                                                              email='$email'  AND
                                                                                    mobile='$mobile' ");
        return $query->row_array();
    }

    public function drop_state($country_id) {
        $query = $this->db->query("select * from  state_master where country_id='$country_id' ");
        return $query->result();
    }

    public function drop_city($state_id) {
        $query = $this->db->query("select * from  city_master where state_id='$state_id' ");
        return $query->result();
    }

    public function edit_data($user_id) {
        $query = $this->db->query("select * from  user_master  where user_id='$user_id' ");
        return $query->row_array();
    }

    public function update_data($user_id, $first_name, $last_name, $country_id, $state_id, $city_id, $pincode, $email, $mobile) {
        $data = array(
            'user_id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'country_id' => $country_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
            'email' => $email,
            'mobile' => $mobile
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('user_master', $data);
    }

    public function delete($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_master');
    }

    public function update_active($user_id, $status) {
        $data = array(
            'user_id' => $user_id,
            'status' => 1
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('user_master', $data);
    }

    public function update_deactive($user_id, $status) {
        $data = array(
            'user_id' => $user_id,
            'status' => 0
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('user_master', $data);
    }

}
