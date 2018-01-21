<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model {

   

    public function getcommentlist() {
        $query = $this->db->query("select * from comment_master");
        return $query->result();
    }

    
    public function delete($comment_id) {
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('comment_master');
    }

    public function update_active($comment_id, $status) {
        $data = array(
            'comment_id' => $comment_id,
            'status' => 1
        );
        $this->db->where('comment_id', $comment_id);
        $this->db->update('comment_master', $data);
    }

    public function update_deactive($comment_id, $status) {
        $data = array(
            'comment_id' => $comment_id,
            'status' => 0
        );
        $this->db->where('comment_id', $comment_id);
        $this->db->update('comment_master', $data);
    }

}
