<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Item_model extends CI_Model {
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

	public function get_item_all() {
		$this->db->from('item');
		$this->db->join('kategori_item', 'kategori_item = id_kategori_item');
		$this->db->join('uom', 'uom_item = id_uom');
		$this->db->join('item_kertas', 'item.id_item = item_kertas.id_item_k', 'LEFT');
		$this->db->join('item_silinder', 'item.id_item = item_silinder.id_item_s', 'LEFT');
		$this->db->join('item_tinta', 'item.id_item = item_tinta.id_item_t', 'LEFT');
		return $this->db->get()->result();
	}

	public function get_item_id($item) {
		$this->db->from('item');
		$this->db->where('kode_item', $item);
		return $this->db->get()->row();
	}

	public function create_item($kategori)
	{
		$data = array(
			'kategori_item'	=> $kategori,
		);

		$this->db->insert('item', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	public function create_item_kertas($id_item, $nama, $qty)
	{
		$data = array(
			'id_item_k'		=> $id_item,
			'nama_kertas'	=> $nama,
			'qty_kertas'	=> $qty,
		);
		
		return $this->db->insert('item_kertas', $data);
	}

	public function create_item_tinta($id_item, $nama, $qty)
	{
		$data = array(
			'id_item_t'		=> $id_item,
			'nama_tinta'	=> $nama,
			'qty_tinta'		=> $qty,
		);
		
		return $this->db->insert('item_tinta', $data);
	}

	public function create_item_silinder($id_item, $nama, $qty, $kapasitas)
	{
		$data = array(
			'id_item_s'				=> $id_item,
			'nama_silinder'			=> $nama,
			'qty_silinder'			=> $qty,
			'kapasitas_silinder'	=> $qty,
		);
		
		return $this->db->insert('item_silinder', $data);
	}
	
}