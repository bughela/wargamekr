<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rank extends CI_Controller {

	public function index($limit = 1000)
	{
		$this->load->model('rank_model', 'rank');
		$list = $this->rank->get_list($limit);
		if (count($list) == 0) return;
		$list = array_chunk($list, ceil(count($list)/2));
		load_view('rank', ['list' => $list]);
	}

	public function get_rank()
	{
		$user = $this->input->post('user');
		$result = $this->rank_model->get_rank($user);
		json_output($result);
	}
}

/* End of file rank.php */
/* Location: ./application/controllers/rank.php */
