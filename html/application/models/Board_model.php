<?php
class Board_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        // $this->db 사용 가능
    }

    public function list_select($now_page, $search) {

        // 현재 페이지를 입력받지 못했다면 기본값으로 0설정
        if ($now_page == '') {
            $now_page = 0;
        }

        // 페이지와 검색쿼리를 가지고 게시물을 가져오는 SELECT 쿼리문
        $data = $this->db->query('
        select 
            _id,
            title,
            (select email from ci_member where _id = ci_board.member_id) as name 
        from 
            ci_board as ci_board
        where
            status = 0
        and
            title like "%'.$search.'%"
        order by _id desc
        limit '.$now_page.',10
        ;
        ');

        // 쿼리의 결과를 배열 형식으로 변환하여 리턴
        $result = $data->result_array();
        return $result;
    }

    public function list_total($search) {

        // 검색쿼리를 가지고 조건에 해당(검색어 포함)하는 게시물의 개수를 가져오는 쿼리문
        $data = $this->db->query('
        select
            count(*) as cnt
        from
            ci_board
        where
            status = 0
        and
            title like "%'.$search.'%"
        ;
        ');

        // 게시물의 개수를 리턴
        return $data->row();
    }

    public function view_select($id) {

        // id를 가지고 게시물을 가져오는 쿼리문
        $data = $this->db->query('
        select 
            _id,
            title,
            content,
            (select email from ci_member where _id = ci_board.member_id) as name 
        from 
            ci_board as ci_board
        where
            _id = '.$id.'
        ;
        ');

        // 쿼리 결과 리턴
        return $data->row();
        
    }

    public function board_insert($title, $content) {

        // title과 content값을 받아 새로운 게시물을 db에 삽입하는 쿼리문
        $this->db->query('
        INSERT INTO ci_board
            (title, content)
        VALUES
            ("'.$title.'", "'.$content.'")
        ;
        ');

    }

    public function board_update($_id, $title, $content) {

        // _id, title, content값을 입력받아 기존의 게시물을 수정하는 쿼리
        $this->db->query("
        UPDATE
            ci_board
        SET
            title = '".$title."',
            content = '".$content."'
        WHERE
            _id = ".$_id."
        ;
        ");

    }

    public function board_delete($_id) {

        //_id값을 입력받아 게시물을 삭제하는 쿼리
        // status 컬럼을 1로 업데이트
        $this->db->query("
        UPDATE
            ci_board
        SET
            status = 1
        WHERE
            _id = ".$_id."
        ;
        ");

    }

    public function comment_list($board_id) {

        // board_id값을 입력받아 해당 게시물에 해당하는 댓글의 리스트를 불러오는 쿼리
        $data = $this->db->query("
        SELECT
            _id,
            content,
            (select email from ci_member where _id = ci_comment.member_id) as name
        FROM
            ci_comment as ci_comment
        WHERE
            status = 0
        AND
            board_id = ".$board_id."
        ;
        ");

        return $data->result_array();

    }

    public function comment_delete($comment_id) {

        // 댓글 id값을 받아 삭제하는 쿼리 수행
        // update쿼리를 통해 status 값을 1로 업데이트
        $this->db->query("
        UPDATE
            ci_comment
        SET
            status = 1
        WHERE
            _id = ".$comment_id."
        ;
        ");

    }

    public function comment_insert($board_id, $content) {

        // 게시물 id, content 값을 받아 댓글을 새로 삽입하는 쿼리 수행
        $this->db->query("
        INSERT INTO ci_comment
            (board_id, content)
        VALUES
            (".$board_id.", '".$content."')
        ;
        ");

    }
}