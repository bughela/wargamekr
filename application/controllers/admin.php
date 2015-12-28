<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		if (is_admin() == false) return;
		load_view('admin');
	}

	public function add_challenge()
	{
		if (is_admin() == false) return;
		$this->_admin();
		$this->load->model('challenge_model', 'challenge');
		$info = $this->input->post(NULL);
		$result = $this->challenge->add_challenge($info);
		if ($result !== true) {
			//load_view('admin', ['msg' => 'fail']);
		}
		//load_view('admin', ['msg' => 'success']);
		redirect('/admin');
	}

	public function _admin()
	{
		if (is_admin()) return;
		load_view('admin');
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
