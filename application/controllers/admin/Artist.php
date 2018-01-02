<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('country_model');
        $this->load->model('state_model');
        $this->load->model('city_model');
        $this->load->model('user_model');
        $this->load->model('artist_model');
    }

    public function index() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $data['city_list'] = $this->city_model->getcitylist();
        $data['artist_list'] = $this->artist_model->getartistlist();
        $this->load->view('v_artist_view', $data);
    }

    public function view_artist() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $data['city_list'] = $this->city_model->getcitylist();
        $data['artist_list'] = $this->artist_model->getartistlist();
        $this->load->view('v_artist_view', $data);
    }

    public function add_artist() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $data['city_list'] = $this->city_model->getcitylist();
        $data['artist_list'] = $this->artist_model->getartistlist();
        $this->load->view('v_artist_form', $data);
    }

    public function addp() {
        $artist_data = $this->artist_model->check_data($_POST['first_name'], $_POST['last_name'], $_POST['art_category_id'], $_POST['mobile'], $_POST['email'], $_POST['password'], $_POST['country_id'], $_POST['state_id'], $_POST['city_id'], $_POST['pincode']);
        if (isset($artist_data)) {
            $this->session->set_flashdata('message', 'record already exists...');
            redirect('artist/index');
        } else {
            $this->artist_model->insert($_POST['first_name'], $_POST['last_name'], $_POST['art_category_id'], $_POST['mobile'], $_POST['email'], $_POST['password'], $_POST['country_id'], $_POST['state_id'], $_POST['city_id'], $_POST['pincode']);
            $this->session->set_flashdata('message', 'insert successfully...');
            redirect('artist/index');
        }
    }

    public function drop_state() {
        $data['update_data'] = $this->artist_model->drop_state($_POST['country_id']);
        $this->load->view('drop_state', $data);
    }

    public function drop_city() {
        $data['update_data'] = $this->artist_model->drop_city($_POST['state_id']);
        $this->load->view('drop_city', $data);
    }

    public function edit_data($artist_id) {
        $data['update_data'] = $this->artist_model->edit_data($artist_id);
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $data['city_list'] = $this->city_model->getcitylist();
        $data['artist_list'] = $this->artist_model->getartistlist();

        $this->load->view('v_artist_form', $data);
    }

    public function editp() {
        $this->artist_model->update_data($_POST['artist_id'], $_POST['first_name'], $_POST['last_name'], $_POST['art_category_id'], $_POST['mobile'], $_POST['email'], $_POST['password'], $_POST['country_id'], $_POST['state_id'], $_POST['city_id'], $_POST['pincode']);
        redirect("artist/index");
    }

    public function update_data($user_id) {
        $data['artist_list'] = $this->artist_model->getartistlist();
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['update_data'] = $this->state_model->getstatelist();
        $data['update_data'] = $this->city_model->getcitylist();
        $data['artist_data'] = $this->artist_model->edit_data($artist_id);
        $data['artist_list'] = $this->artist_model->getartistlist();
        $this->load->view('v_artist_view', $data);
    }

    public function delete($artist_id) {
        $this->artist_model->delete($artist_id);
        $this->session->set_flashdata('message', 'record deleted successfully...');

        redirect("artist/index");
    }

    public function update_status_active($artist_id) {
        $status = $this->input->get('status');
        $this->artist_model->update_active($artist_id, $status);
        redirect('artist/index');
    }

    public function update_status_deactive($artist_id) {
        $status = $this->input->get('status');
        $this->artist_model->update_deactive($artist_id, $status);
        redirect('artist/index');
    }

    public function deletemultiple() {

        $artist_id = $_POST['artist_id'];
        $i = 0;
        while ($i < count($artist_id)) {
            if (isset($_POST['submit'])) {

                if ($this->artist_model->delete($artist_id[$i])) {
                    $this->session->set_flashdata('success', 'artist Detail Is Delete Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'artist Detail Is Not Delete. Please Try Again.');
                }
            }
            if (isset($_POST['submit1'])) {
                if ($this->artist_model->update_active($artist_id[$i])) {
                    $this->session->set_flashdata('success', 'artist Detail Is Deactivated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'artist Detail Is Not Deactivated.. Please Try Again.');
                }
            }
            if (isset($_POST['submit2'])) {
                if ($this->artist_model->update_deactive($artist_id[$i])) {
                    $this->session->set_flashdata('success', 'artist Detail Is Activated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'artist Detail Is Not Activated.. Please Try Again.');
                }
            }
            $i++;
        }
        redirect("artist/index");
    }

}
