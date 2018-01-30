<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->model('login_model', 'login');
			$this->load->library('session');
			$this->lang->load('login', 'english');
	}
                
	public function index()
	{
		if($this->session->userdata('loggedIn')){
			redirect('dashboard');
		}else{
			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);	
			$data['title'] = "ERP | Application Login";
			$this->load->view('authentication/login', $data);
		}
	}

	public function check_login(){
		extract($_POST);
		$data = $this->login->check_login($username, $password);
		if(!$data){
			$this->session->set_flashdata('login_error', 'TRUE');
			redirect('login');
		}
		else{
			$this->session->set_userdata(
				array(
					'loggedIn'=> TRUE,
					'username'=> $data['username'],
					'name'=> $data['name'],
					'language'=> 'english',
				));
			redirect('dashboard');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
