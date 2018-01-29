<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Proses_model extends CI_Model {
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

	public function get_proses_all() {
		$this->db->from('proses');;
		return $this->db->get()->result();
	}

	public function get_proses_id($proses) {
		$this->db->from('proses');
		$this->db->where('nama_proses', $proses);
		return $this->db->get()->row();
	}

	public function create_proses($nama)
	{
		$data = array(
			'nama_proses'	=> $nama,
		);

		$this->db->insert('proses', $data);
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
}