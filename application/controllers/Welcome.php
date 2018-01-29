<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();

			$data = array();

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('home', $data);
			$this->load->view('footer');
		} else {
			$this->load->helper('url');
			header('location:'.base_url().'user/login');
		}
	}

}
