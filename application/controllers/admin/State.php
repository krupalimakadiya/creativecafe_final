<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class State extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = $this->_get_state_country_data();
        $this->templets('admin/state/state_view', $data);
    }

    public function add_state() {
        $data = $this->_get_state_country_data();
        $this->templets('admin/state/state_form', $data);
    }
    
    public function import()
    {
        $this->templets('admin/state/import_state');
    }

    public function addp() {
        $state_data = $this->state_model->check_data($_POST['country_id'], $_POST['state_name']);
        if (isset($state_data)) {
            $this->session->set_flashdata('message', 'record already exists...');
            $this->index();
        } else {
            $this->state_model->insert($_POST['country_id'], $_POST['state_name']);
            $this->session->set_flashdata('message', 'insert successfully...');
            $this->index();
        }
    }

    public function edit_data($state_id) {
        $data = $this->_get_state_country_data();
        $data['update_data'] = $this->state_model->edit_data($state_id);
        $this->templets('admin/state/state_form', $data);
    }

    public function editp() {
        $this->state_model->update_data($_POST['state_id'], $_POST['country_id'], $_POST['state_name']);
        $this->session->set_flashdata('message', 'update succesfully');
        $this->index();
    }

    public function delete($state_id) {
        $this->state_model->delete($state_id);
        $this->session->set_flashdata('message', 'record deleted successfully...');
        $this->index();
    }

    public function update_status_active($state_id) {
        $status = $this->input->get('status');
        $this->state_model->update_active($state_id, $status);
        $this->index();
    }

    public function update_status_deactive($state_id) {
        $status = $this->input->get('status');
        $this->state_model->update_deactive($state_id, $status);
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
            if (strlen($country_name) < 2) {
                continue;
            }
            $state_name = trim($filesop[1]);
            if (strlen($state_name) < 2) {
                continue;
            }
            $country_data = $this->state_model->getcountryid($country_name);
            $country_id = $country_data['country_id'];
            try {
                $param = array(
                    'country_id' => $country_id
                    , 'state_name' => $state_name
                    //, 'status' => 1
                );
           
                $this->state_model->insert($country_id,$state_name);
                $counter++;
            } catch (Exception $ex) {
                
            }
        }
        $total = ($records - 1);
        $this->session->set_flashdata('message', $counter . " record(s) out of " . ($total == -1 ? 0 : $total) . " successfully imported.");
        redirect("admin/state/index");
    }

    public function export()
    {
        $this->load->dbutil(); 
        $this->load->helper('file'); 
        $this->load->helper('download'); 
        $delimiter = ","; 
        $newline = "\r\n"; 
        $filename = "state_master.csv"; 
     //   $query = "SELECT course_master_name as 'Course Name',book_name as 'Book Name',author_name as 'Author Name',publication_name as 'Publication Name',book_edition as 'Book Edition',book_quantity as 'Book Quantity' 
     //   FROM college_master cm,college_course_master ccm,course_master com,book_master as b 
     //   WHERE b.college_course_master_id = ccm.college_course_master_id and ccm.college_master_id = cm.college_master_id and ccm.course_master_id = com.course_master_id and ccm.college_master_id = $college_master_id"; 
        $query = "select country_name as 'Country Name', state_name as 'State Name' 
                from country_master as c, state_master as s
                where c.country_id=s.country_id";
        $result = $this->db->query($query); 
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline); 
        force_download($filename, $data);

    }

    public function deletemultiple() {
        $state_id = $_POST['state_id'];
        $i = 0;
        while ($i < count($state_id)) {
            if (isset($_POST['submit'])) {

                if ($this->state_model->delete($state_id[$i])) {
                    $this->session->set_flashdata('success', 'State Detail Is Delete Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'State Detail Is Not Delete. Please Try Again.');
                }
            }
            if (isset($_POST['submit1'])) {
                if ($this->state_model->update_active($state_id[$i])) {
                    $this->session->set_flashdata('success', 'State Detail Is Deactivated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'State Detail Is Not Deactivated.. Please Try Again.');
                }
            }
            if (isset($_POST['submit2'])) {
                if ($this->state_model->update_deactive($state_id[$i])) {
                    $this->session->set_flashdata('success', 'State Detail Is Activated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'State Detail Is Not Activated.. Please Try Again.');
                }
            }
            $i++;
        }
        $this->index();
    }

    function _get_state_country_data() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        return $data;
    }

}
