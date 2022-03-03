<?php
// index.php통해서만 들어오게 하는 코드
defined('BASEPATH') OR exit('No direct script access allowed');

class My extends CI_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('Sample_model');
        // $this->Sample_model
	}

	// 기본으로 들어오는 메서드
	public function index()
	{
        $data['news'] = $this->Sample_model->get_select();

        print_r($data);
	}
}
