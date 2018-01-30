<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function  __construct() {
		parent::__construct();
			//$this->load->model('Login', 'login');
	}
                
	public function index()
	{
		$data['title'] = "ERP | Dashboard";
		$data['page_title'] = "Dashboard";
		$data['breadcumb']  = array("Dashboard");
		$data['page_view']  = "dashboard";		
		$data['js_asset']   = "dashboard";	
		$data['csrf'] = $this->csrf;							
		$this->load->view('layouts/master', $data);
	}
}
