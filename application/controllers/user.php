<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index(){
		$this->login();
	}

	public function login(){
		$this->load->view('user/login');
	}

	public function join()
	{
		$this->load->view('user/join');
	}

	public function login_action(){
		$member = $this->input->post(NULL);
		$result = $this->user_model->login_member($member);
		if ($result === false){
			json_output(false);
		}else{
			json_output(true);
		}
	}

	public function join_action(){
		$member = $this->input->post(NULL);
		$result = $this->user_model->join_member($member);
		if ($result === true){
			json_output([true]);
		}else{
			json_output($result);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
