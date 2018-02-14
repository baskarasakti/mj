<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_details_model extends MY_Model {

	protected $_t = 'project_details';

	function get_project_details($id){
		$this->db->select(array('pd.id as id','pd.qty as qty','products_id','p.name'));
		$this->db->where('projects_id', $id);
		$this->db->join('products p', 'pd.products_id = p.id', 'left');
		$result = $this->db->get($this->_t.' pd');
		return $result->result();
	}

	function populate_product_select($id){
		$this->db->select('pd.id as id, p.name as value');
		$this->db->where('projects_id', $id);	
		$this->db->join('products p', 'pd.products_id = p.id', 'left');
		$result = $this->db->get($this->_t.' pd');
		return $result->result();
	}

	function populate_project_details($id){
		$this->db->select('p.id as id, p.name as name');
		$this->db->where('projects_id', $id);	
		$this->db->join('products p', 'pd.products_id = p.id', 'left');
		$result = $this->db->get($this->_t.' pd');
		return $result->result();
	}

}
