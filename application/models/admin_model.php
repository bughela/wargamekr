<?php

	class Admin_model extends CI_Model {
		function __construct()
		{
			parent::__construct();
		}

		function add_challenge($info){
			$chall_info = [
				'name' => $info['name'],
				'summary' => $info['summary'],
				'description' => preg_replace('/\n/i','', nl2br($info['description'])),
				'url' => $info['url'],
				'author' => $info['author'],
				'point' => $info['point'],
				'reg_date' => date('Y-m-d H:i:s')
			];
			return $this->db->insert('challenge_list', $chall_info);
		}

	}
