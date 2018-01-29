<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
		$this->load->model('proses_model');
		$this->load->model('btkl_model');
	}

	public function index()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$produk = $this->produk_model->get_produk_all();

			$data = array('produk'=>$produk);

			$this->load->view('header');
			$this->load->view('navigation');
			$this->load->view('product/viewProduct', $data);
			$this->load->view('footer');
			$this->load->view('delete');
		}
	}

	public function addBom()
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();

			$data = array();

		    $this->form_validation->set_rules('kode', 'Kode Produk', 'required');
			$this->form_validation->set_rules('nama', 'Nama Produk', 'required|min_length[3]');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('product/addBom');
				$this->load->view('footer');
				$this->load->view('product/jsProduct', $data);
			} else {
				$kode = $this->input->post('kode');
				$nama = $this->input->post('nama');
				
				$insertid = 0;
				$insertid = $this->produk_model->create_produk($kode, $nama);

				if ($insertid) {
					header('location:'.base_url().'product/addBom1/'.$insertid);
					$success = "create success";
					$this->session->set_flashdata('success', $success);
				}
			}
		} else {
			$this->load->helper('url');
			header('location:'.base_url().'user/login');
		}
	}

	public function addBom1($id)
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$produk = $this->produk_model->get_produk($id);
			$bom = $this->produk_model->get_bom($id);
			$item = $this->item_model->get_item_all();
			$itemtemp = array();
			$i = 0;
			foreach ($item as $items) {
				$itemtemp[$i] = $items->kode_item;
				$i++;
			}

			$data = array('produk'=>$produk, 'bom'=>$bom, 'id'=>$id, 'item'=>$itemtemp);

		    $this->form_validation->set_rules('idproduk', 'Id Produk', 'required');
			$this->form_validation->set_rules('iditem', 'Id Bahan', 'required');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('product/addBom1', $data);
				$this->load->view('footer');
				$this->load->view('product/jsProduct', $data);
			} else {
				$idproduk = $this->input->post('idproduk');
				$item = $this->input->post('iditem');
				$items = $this->item_model->get_item_id($item);
				$iditem = $items->id_item;
				
				$insertid = 0;
				$insertid = $this->produk_model->create_bom($idproduk, $iditem);

				if ($insertid) {

					header('location:'.base_url().'product/addBom1/'.$id);
					$success = "create success";
					$this->session->set_flashdata('success', $success);
				}
			}
		} else {
			$this->load->helper('url');
			header('location:'.base_url().'user/login');
		}
	}

	public function addBom2($id)
	{
		if ($this->session->has_userdata('username')) {
			$data = new StdClass();
			$produk = $this->produk_model->get_produk($id);
			$btkl = $this->btkl_model->get_btkl_all($id);
			$proses = $this->proses_model->get_proses_all();
			$prosestemp = array();
			$i = 0;
			foreach ($proses as $prosess) {
				$prosestemp[$i] = $prosess->nama_proses;
				$i++;
			}

			$data = array('produk'=>$produk, 'btkl'=>$btkl, 'id'=>$id, 'proses'=>$prosestemp);

		    $this->form_validation->set_rules('idproduk', 'Id Produk', 'required');
			$this->form_validation->set_rules('idproses', 'Id Proses', 'required');

		    if ($this->form_validation->run() === false) {
				$this->load->view('header');
				$this->load->view('navigation');
				$this->load->view('product/addBom2', $data);
				$this->load->view('footer');
				$this->load->view('product/jsProduct1', $data);
			} else {
				$idproduk = $this->input->post('idproduk');
				$proses = $this->input->post('idproses');
				$prosess = $this->proses_model->get_proses_id($proses);
				$idproses = $prosess->id_proses;

				$insertid = 0;
				$insertid = $this->btkl_model->create_btkl($idproduk, $idproses);

				if ($insertid) {

					header('location:'.base_url().'product/addBom2/'.$id);
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
