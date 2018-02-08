<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller {
	
	protected $csrf;

    function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('previllage_model', 'previllage');
		//$this->lang->load('login', 'english');
        if(!$this->session->userdata('loggedIn')){
            redirect('login');
		}
		$this->csrf = array(
			'name' => $this->security->get_csrf_token_name(),
        	'hash' => $this->security->get_csrf_hash()
		);
	}

	function normalize_text($input){
        return ucwords(strtolower($input));
	}
	
	function to_mysql_date($date){
		return date("Y-m-d H:m:s", strtotime($date));
	}

	function mysql_time_now(){
		return date("Y-m-d H:m:s");
	}

	function add_adding_detail($data){
		$data['created_at'] = $this->mysql_time_now();
		$data['created_by'] = $this->session->userdata('name');
		return $data;
	}

	function add_updating_detail(){
		$data['updated_at'] = $this->mysql_time_now();
		$data['updated_by'] = $this->session->userdata('name');
		return $data;
	}

	function get_menu(){
		return $this->previllage->get_previllage();
	}

}
