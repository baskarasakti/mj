<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Btkl_model extends CI_Model {
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

	public function get_btkl_all() {
		$this->db->from('btkl');
		$this->db->join('proses', 'proses.id_proses = btkl.id_proses_btkl', 'LEFT');
		return $this->db->get()->result();
	}

	public function get_btkl_id($proses) {
		$this->db->from('btkl');
		$this->db->where('id_proses_btkl', $proses);
		return $this->db->get()->row();
	}

	public function create_btkl($produk, $proses)
	{
		$data = array(
			'id_produk_btkl'	=> $produk,
			'id_proses_btkl'	=> $proses,
		);

		$this->db->insert('btkl', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
}