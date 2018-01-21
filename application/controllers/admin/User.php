<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = $this->_get_city_stat_data();
        $this->templets('admin/user/user_view', $data);
    }

    public function add_user() {
        $data = $this->_get_city_stat_data();
        $this->templets('admin/user/user_form', $data);
    }
    
     public function import()
    {
        $this->templets('admin/user/import_user');
    }

    public function addp() {
        //to do you use $this->input_post(''); remove all plase to $_post plase
        $user_data = $this->user_model->check_data($_POST['first_name'], $_POST['last_name'], $_POST['country_id'], $_POST['state_id'], $_POST['city_id'], $_POST['pincode'], $_POST['email'], $_POST['mobile']);
        if (isset($user_data)) {
            $this->session->set_flashdata('message', 'record already exists...');
            redirect('admin/user');
        } else {
            $this->user_model->insert($_POST['first_name'], $_POST['last_name'], $_POST['country_id'], $_POST['state_id'], $_POST['city_id'], $_POST['pincode'], $_POST['email'], $_POST['mobile']);
            $this->session->set_flashdata('message', 'insert successfully...');
            redirect('admin/user');
        }
    }

    public function drop_state() {
        $data['update_data'] = $this->user_model->drop_state($_POST['country_id']);
        $this->load->view('admin/drop_state', $data);
        //     print_r( $data['update_data']);
    }

    public function drop_city() {
        $data['update_data'] = $this->user_model->drop_city($_POST['state_id']);
        $this->load->view('admin/drop_city', $data);
    }

    public function edit_data($user_id) {
        $data = $this->_get_city_stat_data();
        $data['update_data'] = $this->user_model->edit_data($user_id);
        $this->templets('admin/user/user_form', $data);
    }

    public function editp() {
        $this->user_model->update_data($_POST['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['country_id'], $_POST['state_id'], $_POST['city_id'], $_POST['pincode'], $_POST['email'], $_POST['mobile']);
        redirect("admin/user");
    }

    public function update_data($user_id) {
        $data = $this->_get_city_stat_data();
        $data['update_data'] = $this->user_model->edit_data($user_id);
        $this->templets('admin/user/user_view', $data);
    }

    public function delete($user_id) {
        $this->user_model->delete($user_id);
        $this->session->set_flashdata('message', 'record deleted successfully...');
        redirect("admin/user");
    }

    public function update_status_active($user_id) {
        $user_status = $this->input->get('user_status');
        $this->user_model->update_active($user_id, $user_status);
        redirect('admin/user');
    }

    public function update_status_deactive($user_id) {
        $user_status = $this->input->get('user_status');
        $this->user_model->update_deactive($user_id, $user_status);
        redirect('admin/user');
    }

    public function deletemultiple() {
        $user_id = $_POST['user_id'];
        $i = 0;
        while ($i < count($user_id)) {
            if (isset($_POST['submit'])) {

                if ($this->user_model->delete($user_id[$i])) {
                    $this->session->set_flashdata('success', 'User Detail Is Delete Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'User Detail Is Not Delete. Please Try Again.');
                }
            }
            if (isset($_POST['submit1'])) {
                if ($this->user_model->update_active($user_id[$i])) {
                    $this->session->set_flashdata('success', 'User Detail Is Deactivated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'User Detail Is Not Deactivated.. Please Try Again.');
                }
            }
            if (isset($_POST['submit2'])) {
                if ($this->user_model->update_deactive($user_id[$i])) {
                    $this->session->set_flashdata('success', 'User Detail Is Activated Successfully..');
                } else {
                    $this->session->set_flashdata('fail', 'User Detail Is Not Activated.. Please Try Again.');
                }
            }
            $i++;
        }
        redirect("admin/user");
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
            $first_name = trim($filesop[0]);
            if (strlen($first_name) < 2) {
                continue;
            }
            $last_name = trim($filesop[1]);
            if (strlen($last_name) < 2) {
                continue;
            }
            $country_name = trim($filesop[2]);
            if (strlen($country_name) < 0) {
                continue;
            }
            $state_name = trim($filesop[3]);
            if (strlen($state_name) < 0) {
                continue;
            }
            $city_name = trim($filesop[4]);
            if (strlen($city_name) < 0) {
                continue;
            }
            $pincode = trim($filesop[5]);
            if (strlen($pincode) < 2) {
                continue;
            }
            $email = trim($filesop[6]);
            if (strlen($email) < 2) {
                continue;
            }
            $mobile = trim($filesop[7]);
            if (strlen($mobile) < 2) {
                continue;
            }
            $password = trim($filesop[8]);
            if (strlen($password) < 2) {
                continue;
            }
            
           $country_data = $this->user_model->getcountryid($country_name);           
            $state_data = $this->user_model->getstateid($state_name);
            $city_data = $this->user_model->getcityid($city_name);            
             $country_id = $country_data['country_id'];
             $state_id = $state_data['state_id'];
            $city_id = $city_data['city_id'];            
            
            try {
                $param = array(
                    'first_name'=>$first_name,
                    'last_name'=>$last_name,        
                    'country_id' => $country_id,
                    'state_id' => $state_id,
                    'city_id'=>$city_id,
                    'pincode'=>$pincode,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'password'=>$password                   
                    //, 'status' => 1
                );
               
                $this->user_model->insert($first_name, $last_name, $country_id, $state_id, $city_id, $pincode, $email, $mobile,$password);
                $counter++;
            } catch (Exception $ex) {
                
            }
        }
        $total = ($records - 1);
        $this->session->set_flashdata('message', $counter . " record(s) out of " . ($total == -1 ? 0 : $total) . " successfully imported.");
        redirect("admin/user");
    }
    public function export()
    {
        $this->load->dbutil(); 
        $this->load->helper('file'); 
        $this->load->helper('download'); 
        $delimiter = ","; 
        $newline = "\r\n"; 
        $filename = "user_master.csv"; 
        $query = "select first_name as 'First Name', last_name as 'Last Name',country_name as 'Country Name', state_name as 'State Name', city_name as 'City Name' , pincode as 'Pincode', email as 'Email ID' ,password as 'Password'
                from country_master as c, state_master as s, city_master as city, user_master as user
                where user.country_id=c.country_id AND user.state_id=s.state_id AND user.city_id=city.city_id";
        $result = $this->db->query($query); 
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline); 
        force_download($filename, $data);

    }

    function _get_city_stat_data() {
        $data['country_list'] = $this->country_model->getcountrylist();
        $data['state_list'] = $this->state_model->getstatelist();
        $data['city_list'] = $this->city_model->getcitylist();
        $data['user_list'] = $this->user_model->getuserlist();
        return $data;
    }

}
