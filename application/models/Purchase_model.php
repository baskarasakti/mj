<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Purchase_model extends CI_Model {
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

	public function get_purchase_all() {
		$this->db->from('purchase');
		return $this->db->get()->result();
	}

	public function get_purchase($id) {
		$this->db->from('purchase');
		$this->db->where('id_pruchase', $id);
		return $this->db->get()->result();
	}

	public function get_purchase_item($id) {
		$this->db->from('purchase_item');
		$this->db->where('id_purchase_pi', $id);
		$this->db->join('item', 'item.id_item = purchase_item.id_item_pi', 'LEFT');
		return $this->db->get()->result();
	}

	public function create_purchase($nomor, $tanggal, $keterangan)
	{
		$data = array(
			'no_purchase'	=> $nomor,
			'tanggal_purchase'	=> $tanggal,
			'ket_purchase'	=> $keterangan,
		);

		$this->db->insert('purchase', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function create_purchase_item($id, $id_item, $qty, $harga)
	{
		$data = array(
			'id_purchase_pi'	=> $id,
			'id_item_pi'	=> $id_item,
			'qty_pi'	=> $qty,
			'harga_pi'	=> $harga,
		);

		$this->db->insert('purchase_item', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
}