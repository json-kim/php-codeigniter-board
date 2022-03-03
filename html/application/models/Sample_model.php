<?php
class Sample_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        // $this->db 사용 가능
    }

    public function get_select()
    { 

        $query = $this->db->get_where('ci_sample');
        return $query->row_array();
    }
}