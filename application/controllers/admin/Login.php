<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index() {
        $this->load->view('login_frm');
    }
 public function checkdata() {
        $checkdata = $this->login_model->validate($_POST['email'], $_POST['password']);
        if (isset($checkdata['admin_id'])) {
            $userdata = $checkdata;
            $this->session->set_userdata('admin_id', $userdata['admin_id']);
            $this->session->set_userdata('email',$userdata['email']);
            $this->session->set_userdata('password', $userdata['password']);
            redirect('welcome/index');
        } else {
            $this->session->set_flashdata('message', 'Please Enter Correct User_Name And Password');
            redirect('login/index');
        }
    }

/*    public function checkdata() {
        $this->load->model('login_model');

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data = $this->login_model->validate($email, $password);

        if (isset($data["admin_id"])) {

            $this->session->set_userdata('admin_id', $data['admin_id']);
            $this->session->set_userdata('email', $data['email']);
            redirect("welcome/index");
        }

        $this->session->set_flashdata('message', $data['message']);
        redirect("login/index");
    }
*/
    public function logout() {

        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect("login/index");
    }

}
