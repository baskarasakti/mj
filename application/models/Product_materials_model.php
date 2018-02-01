<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_materials_model extends MY_Model {

	protected $_t = 'product_materials';

	function get_product_materials($id){
        $this->db->select(array('pm.id as id','qty','materials_id'));
        $this->db->where('products_id', $id);
        $this->db->join('materials m', 'pm.materials_id = m.id', 'left');
        $result = $this->db->get($this->_t.' pm');
        return $result->result();
	}

}
