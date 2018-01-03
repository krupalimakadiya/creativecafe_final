<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/country_model');
        $this->load->model('admin/state_model');
        $this->load->model('admin/city_model');
        $this->load->model('admin/user_model');
        $admin_id = intval($this->session->userdata('admin_id'));
        if ($admin_id === 0) {
            $this->session->set_flashdata('message', 'session destroy !!!!');
            header("Location:" . base_url() . "admin/login");
        }
    }

    public function templets($view, $data = '') {
        $this->load->view('admin/common/header');
        $this->load->view($view, $data);
        $this->load->view('admin/common/footer');
    }

}
