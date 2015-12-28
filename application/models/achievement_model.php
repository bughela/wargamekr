<?php

	class Achievement_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
		}

		function get_list(){
			$result = $this->db
				->select('*')
				->order_by('idx', 'asc')
				->get('achievement_list');
			$taked_list = $this->taked_list();
			$list = [];
			foreach ($result->result() as $row){
				if (in_array($row->name, $taked_list)){
					if ($row->name == $this->session->userdata('achievement'))
						$row->taked = "success";
					else
						$row->taked = "info";
				} else {
					$row->taked = "";
				}
				$list[] = $row;
			}
			return $list;
		}

		function taked_list(){
			$result = $this->db
				->select('achievement_name')
				->where('user_name', $this->session->userdata('name'))
				->get('achievement_acquired');
			$list = [];
			foreach ($result->result() as $row){
				$list[] = $row->achievement_name;
			}
			return $list;
		}

		function take($achievement_name, $user_name = ''){
			if ($user_name == '') {
				if (!is_logged_in()) return false;
				$user_name = $this->session->userdata('name');
			}
			$result = $this->db->get_where('achievement_acquired',
				['user_name' => $user_name, 'achievement_name' => $achievement_name]);
				
			if ($result->num_rows() > 0) {
				return false;
			}
			$result = $this->db->insert('achievement_acquired', [
				'user_name' => $user_name,
				'achievement_name' => $achievement_name
			]);

			return $result;
		}

		function set($name){
			$name = mysql_real_escape_string($name);
			$result = $this->db->get_where('achievement_acquired',
				['user_name' => $this->session->userdata('name'),
				'achievement_name' => $name]);
			if ($result->num_rows() == 0) return false;
			
			$data = ['achievement' => $name];
			$where = ['name' => $this->session->userdata('name')];
			$sql = $this->db->update_string('users', $data, $where);
			$this->db->query($sql);
			$this->session->set_userdata(['achievement' => $name]);
			return true;
		}
	}
