<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

	function  __construct() {
		parent::__construct();
			//$this->load->model('Login', 'login');
	}
                
	public function index()
	{
		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;							
		$this->load->view('layouts/master', $data);
	}
}
