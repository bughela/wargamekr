<?php

	class Rank_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
		}

		function get_list($limit){
			$limit = intval($limit);
			$list = [];
			$result = $this->db
				->select('*')
				->order_by('point', 'desc')
				->order_by('update_date', 'asc')
				->limit($limit)
				->get('score_v');
			foreach ($result->result() as $row){
				$list[] = $row;
			}
			return $list;
		}

		function get_rank($user){
			$this->load->model('challenge_model', 'challenge');
			$point = $this->get_point($user);
			if ($point == 0) return 9999;
			$last_update = $this->challenge->last_auth_time($user);
			
			$result = $this->db
				->where('point >', $point)
				->or_where('point', $point)
				->where('update_date <=', $last_update)
				->from('score_v')
				->count_all_results();
			return $result;
		}

		function get_point($user){
			$result = $this->db
				->select('point')
				->where('user_name', $user)
				->get('score_v');
			if ($result->num_rows() != 1) return 0;
			return $result->row()->point;
		}
	}
