<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Challenge extends CI_Controller {

	public function index()
	{
		$this->load->model('challenge_model', 'challenge');
		$challenge_list = $this->challenge->get_list();
		$break_list = $this->challenge->break_list();
		load_view('challenge', ['list' => $challenge_list, 'break_list' => $break_list]);
	}

	public function detail_info($challenge_name = '')
	{
		$this->load->model('challenge_model', 'challenge');
		$result = $this->challenge->detail_info($challenge_name);
		json_output($result);
	}

	public function auth($challenge_idx = 0)
	{
		$this->load->model('challenge_model', 'challenge');
		$result = $this->challenge->auth($challenge_idx);
		json_output($result);
	}

}

/* End of file challenge.php */
/* Location: ./application/controllers/challenge.php */
