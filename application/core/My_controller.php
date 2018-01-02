<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $admin_id = intval($this->session->userdata('admin_id'));
        if ($admin_id === 0) {
            $this->session->set_flashdata('message', 'session destroy !!!!');
            redirect('login/index');
        }
    }

    public function templets($view, $data = '') {
        $this->load->view('admin/common/header');
        $this->load->view($view, $data);
        $this->load->view('admin/common/footer');
    }

}
