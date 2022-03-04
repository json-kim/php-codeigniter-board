<?php

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Board_model');
    }

    public function index() {
    }

    public function board_insert() {

        // post방식으로 전달된 title, content값 받아오기
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        // 모델에 title, content값을 전달하며 쿼리 수행
        $this->Board_model->board_insert($title, $content);

        // 쿼리 수행하고 나서 list페이지로 이동
        header("Location: http://127.0.0.1:9001/index.php/board/list");
    }

    public function board_update() {

        // post방식으로 전달된 _id, title, content 가져오기
        $_id = $this->input->post('_id');
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        // _id, title, content값으로 모델에 전달하여 업데이트 쿼리 수행
        $this->Board_model->board_update($_id, $title, $content);

        // 쿼리 수행 완료 후 상세보기 화면으로 이동 (_id 방식으로 전달)
        header("Location: http://127.0.0.1:9001/index.php/board/view?id=".$_id);

    }
}

?>