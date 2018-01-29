<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

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
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('item_model');
		$this->load->model('kategori_model');
	}

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			//$item = $this->item_model->get_item_all();

			//$data = array('item'=>$item);

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('customer/viewCustomer');
			$this->load->view('footer');
			$this->load->view('delete');
		}
	}

	public function addCustomer()
	{
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('customer/addCustomer');
				$this->load->view('footer');
	}
}
