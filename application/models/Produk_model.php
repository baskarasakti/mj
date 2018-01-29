<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Produk_model extends CI_Model {
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

	public function get_produk_all() {
		$this->db->from('produk');
		return $this->db->get()->result();
	}

	public function get_produk($id) {
		$this->db->from('produk');
		$this->db->where('id_produk', $id);
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

	public function create_produk($kode, $nama)
	{
		$data = array(
			'kode_produk'	=> $kode,
			'nama_produk'	=> $nama,
			'qty_produk'	=> 0,
		);

		$this->db->insert('produk', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function create_bom($produk, $item)
	{
		$data = array(
			'id_produk_bom'		=> $produk,
			'id_item_bom'	=> $item,
		);

		$this->db->insert('bom', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
}