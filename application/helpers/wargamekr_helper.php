<?php

	if(!function_exists('loadview')){
		function load_view($view, $vars = array(), $output = false){
			$CI = &get_instance();
			return $CI->load->view('module/container', ['page' => $view, 'vars' => $vars], $output);
		}
	}

	if(!function_exists('is_logged_in')){
		function is_logged_in(){
			$CI = &get_instance();
			if (!$CI->session->userdata('name')) return false;
			return true;
		}
	}

	if(!function_exists('is_admin')){
		function is_admin(){
			$admin_list = ['bughela'];
			$CI = &get_instance();
			if (!is_logged_in()) return false;
			if (!in_array($CI->session->userdata('name'), $admin_list)) return false;
			return true;
		}
	}

	if(!function_exists('json_output')){
		function json_output($result){
			$CI = &get_instance();
			$CI->output->set_content_type('application/json')->set_output(json_encode($result));
			return false;
		}
	}
