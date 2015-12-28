<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller {

	public function index()
	{
		$this->get_list(1);
	}

	public function get_list($page = 1)
	{
		$page = $page = (intval($page));
		if ($page<1) $page = 1;
		$this->load->model("board_model", "board");
		$list = $this->board->get_list($page);
		$pagination = $this->board->get_page($page);
		$nowpage = $page;
		if ($nowpage < 5) $nowpage = 5;
		load_view('board/list', ['list' => $list, 'pagination' => $pagination, 'basepage' => $nowpage, 'realpage' => $page]);
	}

	public function write()
	{
		if (!is_logged_in()) {
			redirect("/board");
			return false;
		}
		load_view("board/write");
	}

	public function write_action()
	{
		$data = [
			'title' => $this->input->POST('title'),
			'secret' => $this->input->POST('secret'),
			'contents' => $this->input->POST('contents')
			];
		$this->load->model("board_model", "board");
		$this->board->write($data);
		redirect("/board");
	}

	public function write_reply($idx = 0)
	{
		$idx = intval($idx);
		$contents = $this->input->POST('contents');
		$this->load->model("board_model", "board");
		$this->board->write_reply($contents, $idx);
		redirect("/board/read/".$idx);
	}

	public function read($idx = 0)
	{
		$idx = intval($idx);
		$this->load->model("board_model", "board");
		$data = $this->board->read($idx);
		if ($data == false) {
			load_view("board/secret");
		} else {
			load_view("board/read", ['main' => $data['main'], 'reply_list' => $data['reply']]);
		}
	}

}

/* End of file board.php */
/* Location: ./application/controllers/board.php */
