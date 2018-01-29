<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller {

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
		$this->load->model('proses_model');
	}

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$proses = $this->proses_model->get_proses_all();

			$data = array('proses'=>$proses);

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('proses/viewProses', $data);
			$this->load->view('footer');
			$this->load->view('delete');
		}
	}

	public function addProses()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();

			$this->form_validation->set_rules('nama', 'Nama Proses', 'required|min_length[3]');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('proses/addProses');
				$this->load->view('footer');
			} else {
				$nama = $this->input->post('nama');
				
				$insertid = 0;
				$insertid = $this->proses_model->create_proses($nama);

				if ($insertid) {
					header('location:'.base_url().'proses');
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
