<?php

	class Challenge_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
		}

		function get_list()
		{
			$result = $this->db
				->select('idx, name, point, author')
				->order_by('point', 'asc')
				->get('challenge_list');
			$list = [];
			foreach ($result->result() as $row) {
				$list[] = $row;
			}
			return $list;
		}

		function detail_info($idx = 0)
		{
			$idx = intval($idx);
			$result = $this->db
				->select('idx, name, description, url, point, author')
				->where('idx', $idx)
				->get('challenge_list');
			$rows = $result->num_rows();
			if ($rows == 1) {
				return $result->row();
			} else {
				return false;
			}
		}

		function get_total_point(){
			$result = $this->db
				->select_sum('point')
				->get('challenge_list');
			$row = $result->row();
			return $row->point;
		}

		function get_chall_name($idx = 0) {
			$idx = intval($idx);
			$result = $this->db
				->select('name')
				->where('idx', $idx)
				->get('challenge_list');
			if ($result->num_rows() == 0) return false;
			$row = $result->row();
			return $row->name;
		}

		function auth($chall_idx = 0)
		{
			if (is_logged_in() == false) return false;

			if (!$this->session->userdata('last_auth_time')) {
				$this->session->set_userdata(['last_auth_time' => time()]);
			} else if ($this->session->userdata('last_auth_time') > time()-5) {
				return "so fast! calm down..";
			}

			$this->session->set_userdata(['last_auth_time' => time()]);

			// a valid idx?
			$chall_name = $this->get_chall_name(intval($chall_idx));
			if ($chall_name === false) return "idx error";
			
			$flag = $this->input->post('flag');
			if ($flag === false) return "param error";

			if (strtolower($this->GEN_FLAG($chall_name)) == (string)strtolower($flag)){
				
				$result = $this->db
					->select('idx')
					->where('user_name', $this->session->userdata('name'))
					->where('chall_name', $chall_name)
					->get('challenge_solved');
					
				if ($result->num_rows() > 0) {
					return "Already solved!";
				}

				$auth = [
					'user_name'=> $this->session->userdata('name'),
					'chall_name' => $chall_name,
					'reg_date' => date('Y-m-d H:i:s',time()),
					'reg_ip' => $this->input->ip_address()
				];

				$result = $this->db->insert('challenge_solved', $auth);
				$name = $this->session->userdata('name');
				$point = $this->rank_model->get_point($name);
				$this->session->set_userdata(['point' => $point]);
				$total_point = $this->get_total_point();
				$this->load->model("achievement_model", "achievement");
				if ($total_point/100 * 10 < $point) $this->achievement->take("over 10");
				if ($total_point/100 * 20 < $point) $this->achievement->take("over 20");
				if ($total_point/100 * 30 < $point) $this->achievement->take("over 30");
				if ($total_point/100 * 40 < $point) $this->achievement->take("over 40");
				if ($total_point/100 * 50 < $point) $this->achievement->take("over 50");
				if ($total_point/100 * 60 < $point) $this->achievement->take("over 60");
				if ($total_point/100 * 70 < $point) $this->achievement->take("over 70");
				if ($total_point/100 * 80 < $point) $this->achievement->take("over 80");
				if ($total_point/100 * 90 < $point) $this->achievement->take("over 90");
				if ($total_point == $point) $this->achievement->take("master");

				$chat = [
					'name' => "[SYSTEM]",
					'chat' => "SOLVED '$chall_name' by {$name}",
					'reg_date' => date('Y-m-d H:i:s', time()),
					'reg_ip' => $this->input->ip_address()];
				$this->db->insert('chat_log', $chat);
				
				return true;
			}
			return "wrong flag..";
		}

		function break_list()
		{
			if (!is_logged_in()) return [];
			$result = $this->db
				->select('chall_name')
				->where('user_name', $this->session->userdata('name'))
				->get('challenge_solved');
			$list = [];
			//foreach ($result->result() as $row){
			foreach ($result->result() as $row){
				$list[] = $row->chall_name;
			}
			return $list;
		}

		function GEN_FLAG($chall_name)
		{
			$str = $chall_name."-".date("Y_m_d")."_Bughela_".$this->input->ip_address().md5(file_get_contents("/etc/gen_flag_salt"));
			return sha1($str);
		}

		function add_challenge($info){
			$chall_info = [
				'name' => $info['name'],
				'description' => preg_replace('/\n/i','', nl2br($info['description'])),
				'url' => $info['url'],
				'author' => $info['author'],
				'point' => $info['point'],
				'reg_date' => date('Y-m-d H:i:s')
			];
			return $this->db->insert('challenge_list', $chall_info);
		}

		function last_auth_time($user){
			$result = $this->db
				->select('update_date')
				->where('user_name', $user)
				->order_by('update_date', 'desc')
				->get('score_v');
			return $result->row()->update_date;
		}
	}
