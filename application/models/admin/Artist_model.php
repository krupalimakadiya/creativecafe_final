<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_model extends CI_model {

    public function getartistlist() {
        $query = $this->db->query("select * from artist_master  as a, country_master as c, state_master as s, city_master as city , art_category_master as ac where a.country_id=c.country_id and a.state_id=s.state_id and a.city_id=city.city_id and a.art_category_id=ac.art_category_id");
        return $query->result();
    }

    public function insert($first_name, $last_name, $art_category_id, $mobile, $email, $password, $country_id, $state_id, $city_id, $pincode) {
        $data = array('first_name' => $first_name,
            'last_name' => $last_name,
            'art_category_id' => $art_category_id,
            'mobile' => $mobile,
            'email' => $email,
            'password' => $password,
            'country_id' => $country_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
        );
        $this->db->insert('artist_master', $data);
    }

    //chk if record exists in database  or not 
    public function check_data($first_name, $last_name, $art_category_id, $mobile, $email, $password, $country_id, $state_id, $city_id, $pincode) {
        $query = $this->db->query("select * from artist_master where first_name='$first_name' AND  last_name='$last_name' AND
                                                      mobile='$mobile'    AND
                                                          email='$email'  AND
                                                             password='$password'   AND
                                                                country_id='$country_id' AND 
                                                                 state_id='$state_id' AND
                                                                      city_id='$city_id' AND
                                                                          pincode = '$pincode' 
                                                                             
                                                                                   ");
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

    public function edit_data($artist_id) {
        $query = $this->db->query("select * from  artist_master  where artist_id='$artist_id' ");
        return $query->row_array();
    }

    public function update_data($user_id, $first_name, $last_name, $art_category_id, $mobile, $email, $password, $country_id, $state_id, $city_id, $pincode) {

        $data = array(
            'artist_id' => $artist_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'art_category_id' => $art_category_id,
            'mobile' => $mobile,
            'email' => $email,
            'passord' => $password,
            'country_id' => $country_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'pincode' => $pincode,
        );
        $this->db->where('artist_id', $artist_id);
        $this->db->update('artist_master', $data);
    }

    public function delete($artist_id) {
        $this->db->where('artist_id', $artist_id);
        $this->db->delete('artist_master');
    }

    public function update_active($artist_id, $status) {
        $data = array(
            'user_id' => $artist_id,
            'status' => 1
        );
        $this->db->where('artist_id', $artist_id);
        $this->db->update('artist_master', $data);
    }

    public function update_deactive($artist_id, $status) {
        $data = array(
            'artist_id' => $artist_id,
            'status' => 0
        );
        $this->db->where('artist_id', $artist_id);
        $this->db->update('artist_master', $data);
    }

}
