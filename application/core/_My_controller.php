<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_controller extends CI_Controller {
	
	protected $csrf;

    function __construct() {
        parent::__construct();
		$this->load->library('session');
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

}
