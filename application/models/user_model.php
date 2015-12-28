<?php

	class User_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
		}

		function login_member($m)
		{
			if (is_logged_in()) return false;

			$result = $this->db
				->select('name, email, lang, achievement')
				->where('email', $m['email'])
				->where('password', md5($m['password']))
				->get('users');

			if ($result->num_rows() == 1){
				$row = $result->row();
				$this->load->model('challenge_model', 'challenge');
				$this->load->model('achievement_model', 'achievement');

				$this->session->set_userdata($row);
				$this->session->set_userdata(['point' => $this->rank_model->get_point($this->session->userdata('name'))]);
				return true;
			}
			return false;
		}

		function join_member($member)
		{
			$this->load->helper('email');
			if ($member['email2'] != $member['email'])
				return ["error", "parameter err"];

			if ($member['password2'] != $member['password'])
				return ["error", "parameter err"];

			if (valid_email($member['email']) === false)
				return ["error", "email is not valid"];

			if (strlen(htmlspecialchars($member['name'])) > 64)
				return ["error", "name is too long"];

			if ($this->name_chk($member['name']) === false)
				return ["error", "name is duplicated"];

			if ($this->email_chk($member['email']) === false)
				return ["error", "email is duplicated"];
			if (!isset($member['lang']))
				return ["error", "language parameter error"];

			$m = [
				'email' => $member['email'],
				'name' => htmlspecialchars($member['name']),
				'password' => md5($member['password']),
				'reg_date' => date('Y-m-d H:i:s', time()),
				'reg_ip' => $this->input->ip_address(),
				'lang' => $member['lang']
			];

			if ($this->db->insert('users', $m) === false)
				return ["error", "unknown error"];

			$this->load->model('achievement_model', 'achievement');
			$this->achievement->take('default', $m['name']);

			return true;
		}

		function name_chk($name)
		{
			$result = $this->db
				->select('name')
				->where('name', $name)
				->get('users');
			$rows = $result->num_rows();
			if ($rows != 0) return false;
			return true;
		}

		function email_chk($email)
		{
			$result = $this->db
				->select('email')
				->where('email', $email)
				->get('users');
			$rows = $result->num_rows();
			if ($rows != 0) return false;
			return true;
		}

		function valid_user($name)
		{
			$result = $this->db
				->select('name')
				->where('name', $name)
				->get('users');
			if ($result->num_rows() == 1)
				return true;
			return false;
		}
	}
