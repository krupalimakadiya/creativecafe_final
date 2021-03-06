<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class comment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/comment_model');
    }

    public function index() {
        $data['comment_list'] = $this->comment_model->getcommentlist();
        $this->templets('admin/comment/comment_view', $data);
    }


/*    public function addp() {
        $category_data = $this->category_model->check_data($_POST['art_category_name']);
        if (isset($category_data)) {
            $this->session->set_flashdata('message', 'record already exists..');
            $this->index();
        } else {
            $this->category_model->insert($_POST['art_category_name']);
            $this->session->set_flashdata('message', 'insert successfully...');
            $this->index();
        }
    }


    public function edit_data($art_category_id) {
        $data['update_data'] = $this->category_model->edit_data($art_category_id);
        $data['category_list'] = $this->category_model->getcategorylist();
        $this->templets('admin/art_category/art_category_form', $data);
    }

    public function editp() {
        $data["update"] = $this->category_model->update_data($_POST['art_category_id'], $_POST['art_category_name']);
        $this->index();
    }
*/
    public function delete($comment_id) {
        $this->comment_model->delete($comment_id);
        $this->session->set_flashdata('message', 'record deleted successfully...');
        $this->index();
    }

    public function update_status_active($comment_id) {
        $this->load->model('comment_model');
        $status = $this->input->get('status');
        $this->comment_model->update_active($comment_id, $status);
        $this->index();
    }

    public function update_status_deactive($comment_id) {
        $this->load->model('comment_model');
        $status = $this->input->get('status');
        $this->comment_model->update_deactive($comment_id, $status);
        $this->index();
    }
    
  /*  public function importp() {
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
            $art_category_name = trim($filesop[0]);
            if (strlen($art_category_name) < 2) {
                continue;
            }
            $country_data = $this->category_model->check_data($art_category_name);
            if (isset($category_data['art_category_id'])) {
                continue;
            }
            try {
                $this->category_model->insert($art_category_name);
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
        $filename = "art_category_master.csv"; 
        $query = "select art_category_name as 'Art Category Name' 
                from art_category_master";
                 $result = $this->db->query($query); 
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline); 
        force_download($filename, $data);

    }
*/
    public function deletemultiple() {

        $comment_id = $_POST['comment_id'];
        $i = 0;
        while ($i < count($comment_id)) {
            if (isset($_POST['submit'])) {

                if ($this->comment_model->delete($comment_id[$i])) {
                    $this->session->set_flashdata('success', 'Category Detail Is Delete Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'Category Detail Is Not Delete. Please Try Again.');
                }
            }
            if (isset($_POST['submit1'])) {
                if ($this->comment_model->update_active($comment_id[$i])) {
                    $this->session->set_flashdata('success', 'Category Detail Is Deactivated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'Category Detail Is Not Deactivated.. Please Try Again.');
                }
            }
            if (isset($_POST['submit2'])) {
                if ($this->comment_model->update_deactive($comment_id[$i])) {
                    $this->session->set_flashdata('success', 'Category Detail Is Activated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'Category Detail Is Not Activated.. Please Try Again.');
                }
            }
            $i++;
        }
        $this->index();
    }

}
