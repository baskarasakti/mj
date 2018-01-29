<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

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
			$item = $this->item_model->get_item_all();

			$data = array('item'=>$item);

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('inventory/viewItem', $data);
			$this->load->view('footer');
			$this->load->view('delete');
		} else {
			$this->load->helper('url');
			header('location:'.base_url().'user/login');
		}
	}

	public function addItem()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$kategori = $this->kategori_model->get_kategori_all();

			$data = array('kategori'=>$kategori);

			$this->form_validation->set_rules('nama', 'Nama Item', 'required|min_length[3]');
		    $this->form_validation->set_rules('kategori', 'Kategori Item', 'required');
		    $this->form_validation->set_rules('qty', 'Kuantitas', 'required');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('inventory/addItem', $data);
				$this->load->view('footer');
			} else {
				$nama = $this->input->post('nama');
				$kategori = $this->input->post('kategori');
				$qty = $this->input->post('qty');
				
				$insertid = 0;
				$insertid = $this->item_model->create_item($kategori);

				if ($insertid) {
					if ($kategori == 1) {
						$this->item_model->create_item_kertas($insertid, $nama, $qty);
					} else if ($kategori == 2) {
						$this->item_model->create_item_tinta($insertid, $nama, $qty);
					} else if ($kategori == 3) {
						$kapasitas = $this->input->post('kapasitas');
						$this->item_model->create_item_kertas($insertid, $nama, $qty, $kapasitas);
					}

					header('location:'.base_url().'inventory');
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
