<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Achievement extends CI_Controller {

	public function index()
	{
		if (!is_logged_in()){
			redirect('main');
		}
		$this->load->model('achievement_model', 'achievement');
		$list = $this->achievement->get_list();
		$list = array_chunk($list, ceil(count($list)/3));
		load_view('achievement', ['list' => $list]);
	}

	public function set($name)
	{
		if (!is_logged_in()){
			redirect('main');
		}
		$this->load->model('achievement_model', 'achievement');
		if ($this->achievement->set($name)) {
			$result = true;
		} else {
			$result = false;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}
/* End of file achievement.php */
/* Location: ./application/controllers/achievement.php */
