<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_details_model extends MY_Model {

	protected $_t = 'product_shipping_detail';

	function get_shipping_details($id){
		$this->db->select('psd.id, psd.qty, psd.total_price, psd.unit_price, psd.products_id as product_id, p.name as name');
		$this->db->where('product_shipping_id', $id);
		$this->db->join('products p', 'psd.products_id = p.id', 'left');
		$result = $this->db->get($this->_t.' psd');
		return $result->result();
	}

	function populate_shipping_details($id){
		$this->db->select('p.id as id, p.name as value');
		$this->db->where('product_shipping_id', $id);	
		$this->db->join('products p', 'psd.products_id = p.id', 'left');
		$result = $this->db->get($this->_t.' psd');
		return $result->result();
	}

}
