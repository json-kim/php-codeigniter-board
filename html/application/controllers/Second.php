<?php
// index.php통해서만 들어오게 하는 코드
defined('BASEPATH') OR exit('No direct script access allowed');

class Second extends CI_Controller {

	// 기본으로 들어오는 메서드
	public function index()
	{
		echo "내가 만든 두번째 컨트롤러";
	}

	public function my() {
		echo "내꺼야";
	}
}
