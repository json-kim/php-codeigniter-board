<?php
// index.php통해서만 들어오게 하는 코드
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// 기본으로 들어오는 메서드
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function test() {
		echo "여기는 테스트 페이지 입니다.";
	}
}
