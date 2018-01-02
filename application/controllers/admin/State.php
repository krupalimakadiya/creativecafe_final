<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class State extends MY_Controller {

   public function __construct() {
        parent::__construct();
        $this->load->model('country_model');
        $this->load->model('state_model');
    }

    public function view_state() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $this->load->view('v_state_view', $data);
    }

    public function add_state() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $this->load->view('v_state_form', $data);
    }
    public function index() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $this->load->view('v_state_view', $data);
    }
    
      public function addp() {
        $state_data = $this->state_model->check_data($_POST['country_id'],$_POST['state_name']);
        if (isset($state_data)) {
            $this->session->set_flashdata('message','record already exists...');            
            redirect('state/index');
        } else {
            $this->state_model->insert($_POST['country_id'],$_POST['state_name']);
             $this->session->set_flashdata('message','insert successfully...');
            redirect('state/index');
        }
    }
    
    public function edit_data($state_id) {
        $data['update_data'] = $this->state_model->edit_data($state_id);
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $this->load->view('v_state_form', $data);
    }

    public function editp() {
        $this->state_model->update_data($_POST['state_id'], $_POST['country_id'], $_POST['state_name']);
        $this->session->set_flashdata('message','update succesfully');
        redirect("state/index");
    }

    public function delete($state_id) {
        $this->state_model->delete($state_id);
          $this->session->set_flashdata('message','record deleted successfully...');            
        redirect("state/index");
    }

   public function update_status_active($state_id) {
        $status = $this->input->get('status');
        $this->state_model->update_active($state_id, $status);
        redirect('state/index');
    }

    public function update_status_deactive($state_id) {
        $status = $this->input->get('status');
        $this->state_model->update_deactive($state_id, $status);
        redirect('state/index');
    }
     public function deletemultiple() 
    { 
      
        $state_id = $_POST['state_id']; 
        $i = 0; 
        while($i<count($state_id)) 
        { 
            if(isset($_POST['submit'])) 
            { 
                
                if($this->state_model->delete($state_id[$i])) 
                { 
                    $this->session->set_flashdata('success', 'State Detail Is Delete Successfully..'); 
                     } 
                else 
                { 
                    $this->session->set_flashdata('fail', 'State Detail Is Not Delete. Please Try Again.'); 
                     } 
            } 
            if(isset($_POST['submit1'])) 
            { 
                if($this->state_model->update_active($state_id[$i])) 
                {             
                    $this->session->set_flashdata('success', 'State Detail Is Deactivated Successfully..'); 
                     } 
                else 
                { 
                    $this->session->set_flashdata('fail', 'State Detail Is Not Deactivated.. Please Try Again.'); 
                     } 
            } 
            if(isset($_POST['submit2'])) 
            { 
                if($this->state_model->update_deactive($state_id[$i])) 
                {             
                    $this->session->set_flashdata('success', 'State Detail Is Activated Successfully..'); 
                     } 
                else 
                { 
                    $this->session->set_flashdata('fail', 'State Detail Is Not Activated.. Please Try Again.'); 
                } 
            } 
            $i++; 
        } 
        redirect("state/index"); 
    }

  
}
