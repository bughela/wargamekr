<?php

	class Main_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
		}

		function last_idx()
		{
			$this->db->select_max('idx');
			$result = $this->db->get('chat_log');
			$row = $result->row();
			return (int)$row->idx;
		}

		function chat($chat = ''){
			$chat = trim($chat);
			if ($chat == '') return false;
			if (!is_logged_in()) return false;
			$name = $this->session->userdata('name');

			$chat = [
				'name' => $name,
				'chat' => $chat,
				'reg_date' => date('Y-m-d H:i:s', time()),
				'reg_ip' => $this->input->ip_address()];
			$this->db->insert('chat_log', $chat);

			$result = $this->db
				->where('name', $name)
				->from('chat_log')
				->count_all_results();

			if ($result > 100){
				$this->load->model("achievement_model", "achievement");
				$this->achievement->take("chatterbox");
			}
		}

		function load_chat($idx)
		{
			$idx = (int)$idx;
			if ($idx < $this->last_idx() - 100) {
				return false;
			}
			if ($idx == $this->last_idx()) {
				return [];
			}
			$result = $this->db
				->select('a.idx, b.achievement, a.name, chat, a.reg_date')
				->from('chat_log a')
				->join('users b', 'a.name=b.name')
				->where('a.idx >', $idx)
				->where('a.name !=', '[SYSTEM]')
				->order_by('idx', 'asc')
				->get('');
			$list = [];
			foreach ($result->result() as $row) {
				$row->chat = htmlspecialchars($row->chat);
				if ($row->name == "[SYSTEM]") $row->name = "<i>[SYSTEM]</i>";
				$list[] = $row;
			}
			return $list;
		}

		function logged_in_update(){
			if (is_logged_in()) {
				$user_name = $this->session->userdata('name');
			}else{
				$user_name = $this->input->ip_address();
			}
			$result = $this->db
				->select('name')
				->where('name', $user_name)
				->get('logged_in');
			if ($result->num_rows() == 0) {
				$this->db->insert('logged_in', [
					'name' => $user_name,
					'last_ping' => time()]);
			} else {
				$data = ['last_ping' => time()];
				$where = ['name' => $user_name];
				$this->db->update('logged_in', $data, $where);
			}
			return true;
		}

		function online_users(){
			$result = $this->db
				->select('name')
				->where('last_ping >', time() - 4)
				->get('logged_in');
			$list = [];
			foreach ( $result->result() as $row) {
				if ($this->input->valid_ip($row->name))
					$row->name = "Guest / " . preg_replace("/\d+\.(\d+)$/", '*.$1', $row->name); ;
				$list[] = $row->name;
			}
			return $list;
		}

	}
