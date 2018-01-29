<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

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
		$this->load->model('produk_model');
		$this->load->model('produksi_model');
	}

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$produksi = $this->produksi_model->get_produksi_all();

			$data = array('produksi'=>$produksi);

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('production/viewProject', $data);
			$this->load->view('footer');
			$this->load->view('delete');
		}
	}

	public function addProject()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$produk = $this->produk_model->get_produk_all();
			$produktemp = array();
			$i = 0;
			foreach ($produk as $produks) {
				$produktemp[$i] = $produks->kode_produk;
				$i++;
			}

			$data = array('produk'=>$produktemp);

		    $this->form_validation->set_rules('kode', 'Kode Produksi', 'required');
			$this->form_validation->set_rules('nama', 'Nama Produksi', 'required|min_length[3]');
			$this->form_validation->set_rules('proses', 'proses Produksi', 'required');
			$this->form_validation->set_rules('tanggal', 'tanggal Produksi', 'required');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('production/addProject');
				$this->load->view('footer');
				$this->load->view('production/jsProject1', $data);
			} else {
				$kode = $this->input->post('kode');
				$nama = $this->input->post('nama');
				$proses = $this->input->post('proses');
				$tanggal = $this->input->post('tanggal');
				
				$insertid = 0;
				$insertid = $this->produksi_model->create_produksi($kode, $nama, $proses, $tanggal);

				if ($insertid) {
					header('location:'.base_url().'production/addProduction1/'.$insertid);
					$success = "create success";
					$this->session->set_flashdata('success', $success);
				}
			}
		} else {
			$this->load->helper('url');
			header('location:'.base_url().'user/login');
		}
	}

	public function addProject1($id)
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$produk = $this->produk_model->get_produk_all();
			$produktemp = array();
			$i = 0;
			foreach ($produk as $produks) {
				$produktemp[$i] = $produks->kode_produk;
				$i++;
			}

			$data = array('produk'=>$produktemp, 'id'=>$id);

		    $this->form_validation->set_rules('kode', 'Kode Produksi', 'required');
			$this->form_validation->set_rules('nama', 'Nama Produksi', 'required|min_length[3]');
			$this->form_validation->set_rules('proses', 'proses Produksi', 'required');
			$this->form_validation->set_rules('tanggal', 'tanggal Produksi', 'required');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('production/addProject1', $data);
				$this->load->view('footer');
			} else {
				$kode = $this->input->post('kode');
				$nama = $this->input->post('nama');
				$proses = $this->input->post('proses');
				$tanggal = $this->input->post('tanggal');
				
				$insertid = 0;
				$insertid = $this->produksi_model->create_produksi($kode, $nama, $proses, $tanggal);

				if ($insertid) {
					header('location:'.base_url().'production/addProject1/'.$insertid);
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
