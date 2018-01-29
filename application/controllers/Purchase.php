<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

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
		$this->load->model('purchase_model');
	}

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$purchase = $this->purchase_model->get_purchase_all();

			$data = array('purchase'=>$purchase);

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('purchase/viewPurchase', $data);
			$this->load->view('footer');
			$this->load->view('delete');
		}
	}

	public function addPurchase()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$data = array();

		    $this->form_validation->set_rules('nomor', 'Nomor PO', 'required');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|min_length[3]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
			$this->form_validation->set_rules('vendor', 'Nama Vendor', 'required');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('purchase/addPurchase');
				$this->load->view('footer');
				$this->load->view('purchase/jsPurchase');
			} else {
				$nomor = $this->input->post('nomor');
				$tanggal = $this->input->post('tanggal');
				$keterangan = $this->input->post('keterangan');
				$vendor = $this->input->post('vendor');
				
				$insertid = 0;
				$insertid = $this->purchase_model->create_purchase($nomor, $tanggal, $keterangan, $vendor);

				if ($insertid) {
					header('location:'.base_url().'purchase');
					$success = "create success";
					$this->session->set_flashdata('success', $success);
				}
			}
		} else {
			$this->load->helper('url');
			header('location:'.base_url().'user/login');
		}
	}
}
