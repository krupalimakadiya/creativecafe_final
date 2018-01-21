<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class city extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = $this->_get_city_stat_data();
        $this->templets('admin/city/city_view', $data);
    }

    public function add_city() {    //redirect on form
        $data = $this->_get_city_stat_data();
        $this->templets('admin/city/city_form', $data);
    }
    
    public function import() {
        
        $this->templets('admin/city/import_city');
    }

    public function addp() {
        $city_data = $this->city_model->check_data($_POST['country_id'], $_POST['state_id'], $_POST['city_name']);
        if (isset($city_data)) {
            $this->session->set_flashdata('message', 'record already exists...');
            $this->index();
        } else {
            $this->city_model->insert($_POST['country_id'], $_POST['state_id'], $_POST['city_name']);
            $this->session->set_flashdata('message', 'insert successfully...');
            $this->index();
        }
    }

    public function edit_data($city_id) {
        $data = $this->_get_city_stat_data();
        $data['update_data'] = $this->city_model->edit_data($city_id);
        $this->templets('admin/city/city_form', $data);
    }

    public function editp() {
        $this->city_model->update_data($_POST['city_id'], $_POST['country_id'], $_POST['state_id'], $_POST['city_name']);
        $this->index();
    }

    public function update_data($cityid) {
        $data = $this->_get_city_stat_data();
        $data['update_data'] = $this->city_model->edit_data($city_id);
        $this->templets('admin/city/city_view', $data);
    }

    public function delete($city_id) {
        $this->city_model->delete($city_id);
        $this->session->set_flashdata('message', 'record deleted successfully...');
        $this->index();
    }

    public function drop_state() {
        $data['update_data'] = $this->city_model->drop_state($_POST['country_id']);
        $this->load->view('admin/drop_state', $data);
        //     print_r( $data['update_data']);
    }

    public function update_status_active($city_id) {
        $status = $this->input->get('status');
        $this->city_model->update_active($city_id, $status);
        $this->index();
    }

    public function update_status_deactive($city_id) {
        $status = $this->input->get('status');
        $this->city_model->update_deactive($city_id, $status);
        $this->index();
    }

        public function importp() {
        $file = $_FILES['upload']['tmp_name'];
        $handle = fopen($file, "r");
        $row = 1;
        $counter = 0;
        $records = 0;
        while (($filesop = fgetcsv($handle, 100000, ",")) !== false) {
            $records++;
            if ($row == 1) {
                $row++;
                continue;
            }
            $country_name = trim($filesop[0]);
            if (strlen($country_name) < 0) {
                continue;
            }
            $state_name = trim($filesop[1]);
            if (strlen($state_name) < 0) {
                continue;
            }
            $city_name = trim($filesop[2]);
            if (strlen($city_name) < 0) {
                continue;
            }
            
           $country_data = $this->city_model->getcountryid($country_name);           
           $state_data = $this->city_model->getstateid($state_name);
           $country_id = $country_data['country_id'];
           $state_id = $state_data['state_id'];
            try {
                $param = array(
                    'country_id' => $country_id,
                    'state_id' => $state_id,
                    'city_name'=>$city_name
                    );
               
                $this->city_model->insert($country_id, $state_id, $city_name);
                $counter++;
            } catch (Exception $ex) {
                
            }
        }
        $total = ($records - 1);
        $this->session->set_flashdata('message', $counter . " record(s) out of " . ($total == -1 ? 0 : $total) . " successfully imported.");
        redirect("admin/city/index");
    }
    
    public function export()
    {
        $this->load->dbutil(); 
        $this->load->helper('file'); 
        $this->load->helper('download'); 
        $delimiter = ","; 
        $newline = "\r\n"; 
        $filename = "city_master.csv"; 
        $query = "select country_name as 'Country Name', state_name as 'State Name', city_name as 'City Name' 
                from country_master as c, state_master as s, city_master as city
                where city.country_id=c.country_id AND city.state_id=s.state_id";
        $result = $this->db->query($query); 
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline); 
        force_download($filename, $data);

    }

    public function deletemultiple() {

        $city_id = $_POST['city_id'];
        $i = 0;
        while ($i < count($city_id)) {
            if (isset($_POST['submit'])) {

                if ($this->city_model->delete($city_id[$i])) {
                    $this->session->set_flashdata('success', 'City Detail Is Delete Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'City Detail Is Not Delete. Please Try Again.');
                }
            }
            if (isset($_POST['submit1'])) {
                if ($this->city_model->update_active($city_id[$i])) {
                    $this->session->set_flashdata('success', 'City Detail Is Deactivated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'City Detail Is Not Deactivated.. Please Try Again.');
                }
            }
            if (isset($_POST['submit2'])) {
                if ($this->city_model->update_deactive($city_id[$i])) {
                    $this->session->set_flashdata('success', 'City Detail Is Activated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'City Detail Is Not Activated.. Please Try Again.');
                }
            }
            $i++;
        }
        $this->index();
    }

    function _get_city_stat_data() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $data['city_list'] = $this->city_model->getcitylist();
        return $data;
    }

}
