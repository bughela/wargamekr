<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		load_view('main');
	}

	public function chat_last_idx()
	{
		$this->load->model('main_model', 'main');
		$idx = $this->main->last_idx();
		json_output($idx);
	}

	public function load_chat($idx = 0)
	{
		$idx = intval($idx);
		$this->load->model('main_model', 'main');
		$chat = $this->main->load_chat($idx);
		$this->main->logged_in_update();
		$online_users = $this->main->online_users();
		json_output([$chat, $online_users]);
	}

	public function chat()
	{
		$chat = $this->input->post('chat');
		$this->load->model('main_model', 'main');
		$this->main->chat($chat);
	}

	public function get_treasure(){
		if (!is_logged_in()) return false;
		$this->load->model('achievement_model', 'achievement');
		$this->achievement->take("indiana jones");
		redirect('achievement');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
