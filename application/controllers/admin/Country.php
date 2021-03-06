<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends My_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = $this->_get_country_data();
        $this->templets('admin/country/country_view', $data);
    }

    public function add_country() {
        $data = $this->_get_country_data();
        $this->templets('admin/country/country_form', $data);
    }

    public function import() {
        $this->templets('admin/country/import_country');
    }

    public function addp() {
        $country_data = $this->country_model->check_data($_POST['country_name']);
        if (isset($country_data)) {
            $this->session->set_flashdata('message', 'record already exists...');
            $this->index();
        } else {
            $this->country_model->insert($_POST['country_name']);
            $this->session->set_flashdata('message', 'insert successfully...');
            $this->index();
        }
    }

    public function edit_data($country_id) {
        $data['update_data'] = $this->country_model->edit_data($country_id);
        $data['country_list'] = $this->country_model->getcountrylist();
        $this->templets('admin/country/country_form', $data);
    }

    public function editp() {
        $this->country_model->update_data($_POST['country_id'], $_POST['country_name']);
        $this->session->set_flashdata('message', 'record updated successfully...');
        $this->index();
    }

    public function delete($country_id) {
        $this->country_model->delete($country_id);
        $this->session->set_flashdata('message', 'record deleted successfully...');
        $this->index();
    }

    public function update_status_active($country_id) {
        $status = $this->input->get('status');
        $this->country_model->update_active($country_id, $status);
        $this->index();
    }

    public function update_status_deactive($country_id) {
        $status = $this->input->get('status');
        $this->country_model->update_deactive($country_id, $status);
        $this->index();
    }

    public function importp() {
        $file = $_FILES['upload']['tmp_name'];
        $handle = fopen($file, "r");
        $c = 0;
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
            $country_data = $this->country_model->check_data($country_name);
            if (isset($country_data['country_id'])) {
                continue;
            }
            try {
                $this->country_model->insert($country_name);
                $counter++;
            } catch (Exception $ex) {
                
            }
        }
        $total = ($records - 1);
        $this->session->set_flashdata('message', $counter . " record(s) out of " . ($total == -1 ? 0 : $total) . " successfully imported.");
        $this->index();
    }

     public function export()
    {
        $this->load->dbutil(); 
        $this->load->helper('file'); 
        $this->load->helper('download'); 
        $delimiter = ","; 
        $newline = "\r\n"; 
        $filename = "country_master.csv"; 
     //   $query = "SELECT course_master_name as 'Course Name',book_name as 'Book Name',author_name as 'Author Name',publication_name as 'Publication Name',book_edition as 'Book Edition',book_quantity as 'Book Quantity' FROM college_master cm,college_course_master ccm,course_master com,book_master as b WHERE b.college_course_master_id = ccm.college_course_master_id and ccm.college_master_id = cm.college_master_id and ccm.course_master_id = com.course_master_id and ccm.college_master_id = $college_master_id"; 
        $query = "select country_name as 'Country Name' from country_master ";
        $result = $this->db->query($query); 
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline); 
        force_download($filename, $data);

    }
    
    public function deletemultiple() {

        $country_id = $_POST['country_id'];
        $i = 0;
        while ($i < count($country_id)) {
            if (isset($_POST['submit'])) {

                if ($this->country_model->delete($country_id[$i])) {
                    $this->session->set_flashdata('success', 'Country Detail Is Delete Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'Country Detail Is Not Delete. Please Try Again.');
                }
            }
            if (isset($_POST['submit1'])) {
                if ($this->country_model->update_active($country_id[$i])) {
                    $this->session->set_flashdata('success', 'Country Detail Is Deactivated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'Country Detail Is Not Deactivated.. Please Try Again.');
                }
            }
            if (isset($_POST['submit2'])) {
                if ($this->country_model->update_deactive($country_id[$i])) {
                    $this->session->set_flashdata('success', 'Country Detail Is Activated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'Country Detail Is Not Activated.. Please Try Again.');
                }
            }
            $i++;
        }
        $this->index();
    }

    function _get_country_data() {
        $data['country_list'] = $this->country_model->getcountrylist();
        return $data;
    }

}
