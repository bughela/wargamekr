<?php

	class Board_model extends CI_Model {
		
		var $page_limit = 15;

		function __construct()
		{
			$this->load->model("achievement_model", "achievement");
			parent::__construct();
		}

		function get_list($page = 1){
			$page = (intval($page)-1) * $this->page_limit;
			if ($page < 0) $page = 0;
			$result = $this->db
				->select('*')
				->order_by('idx','desc')
				->limit($this->page_limit, $page)
				->get('board');
			$list = [];
			foreach ($result->result() as $row) {
				$row->reply_count = $this->get_reply_count($row->idx);
				$list[] = $row;
			}
			return $list;
		}

		function get_reply_count($pidx = 0){
			$result = $this->db
				->where('pidx', $pidx)
				->from('board_reply')
				->count_all_results();
			return $result;
		}

		function get_page($page){
			$total = $this->get_total_count();
			return ceil($total / $this->page_limit);
		}

		function get_total_count(){
			$result = $this->db->count_all('board');
			return $result;
		}

		function write($input){
			if (!is_logged_in()) return false;
			$data = [
				'title' => htmlspecialchars($input['title']),
				'secret' => $input['secret'],
				'contents' => htmlspecialchars($input['contents']),
				'writer' => $this->session->userdata('name'),
				'reg_date' => date('Y-m-d H:i:s', time()),
				'reg_ip' => $this->input->ip_address()
			];
			$result = $this->db->insert('board', $data);
			$name = $this->session->userdata('name');
			$result = $this->db
				->where('writer', $name)
				->from('board')
				->count_all_results();
			if ($result == 10) {
				$this->achievement->take("BBS mania");
			}
		}

		function read($idx = 0){
			$idx = intval($idx);
			$data = [];
			$result = $this->db
				->select('*')
				->where('idx', $idx)
				->get('board');
			$data['main'] = $result->row();
			$data['main']->contents = "<pre>". ($data['main']->contents). "</pre>";
			if (($data['main']->secret == 1) &&
				($data['main']->writer != $this->session->userdata('name')) &&
				(!is_admin())) {
					return false;
			}
			$result = $this->db
				->select('*')
				->where('pidx', $idx)
				->order_by('idx', 'asc')
				->get('board_reply');
			$list = [];
			foreach ($result->result() as $row){
				$list[] = $row;
			}
			$data['reply'] = $list;
			return $data;
		}
		
		function write_reply($contents, $idx = 0){
			if (!is_logged_in()) return false;
			$contents = trim($contents);
			if ($contents == "") return false;
			$idx = intval($idx);
			$result = $this->db
				->select('idx')
				->where('secret', 0)
				->or_where('writer', $this->session->userdata('name'))
				->where('idx', $idx)
				->get('board');
			if ($result->row()->idx != 1) return false;
			$data = [
				'contents' => htmlspecialchars($contents),
				'pidx' => $idx,
				'writer' => $this->session->userdata('name'),
				'reg_date' => date("Y-m-d H:i:s"),
				'reg_ip' => $this->input->ip_address()
			];
			$this->db->insert('board_reply', $data);
			$name = $this->session->userdata('name');
			$result = $this->db
				->where('writer', $name)
				->from('board_reply')
				->count_all_results();
			if ($result == 50) {
				//$this->achievement->take($name, "");
			}
		}
	}
