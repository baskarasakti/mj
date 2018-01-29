<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Produksi_model extends CI_Model {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}

	public function get_produksi_all() {
		$this->db->from('produksi');
		return $this->db->get()->result();
	}

	public function get_produksi($id) {
		$this->db->from('produksi');
		$this->db->where('id_produksi', $id);
		return $this->db->get()->result();
	}

	public function get_bom($id) {
		$this->db->from('bom');
		$this->db->where('id_produk_bom', $id);
		$this->db->join('item', 'item.id_item = bom.id_item_bom', 'LEFT');
		$this->db->join('item_kertas', 'item.id_item = item_kertas.id_item_k', 'LEFT');
		$this->db->join('item_silinder', 'item.id_item = item_silinder.id_item_s', 'LEFT');
		$this->db->join('item_tinta', 'item.id_item = item_tinta.id_item_t', 'LEFT');
		return $this->db->get()->result();
	}

	public function create_produksi($kode, $nama, $proses, $tanggal)
	{
		$data = array(
			'kode_produksi'	=> $kode,
			'nama_produksi'	=> $nama,
			'proses_produksi'	=> $proses,
			'tanggal_produksi'	=> $tanggal,
		);

		$this->db->insert('produksi', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
}