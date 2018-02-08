<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Previllage_model extends MY_Model {

	protected $_t = 'previllage';

	public function set_initial_previllage(){
		if($this->count_all_data() == 0){
			$this->set_previllage();
		}
		return true;
	}

	public function set_previllage(){
		$row = $this->db->get('roles')->row();
		$id = $row->id;
		$menu = $this->db->get('menu')->result();
		$data = array();
		foreach($menu as $m){
			$row = array();
			$row['view'] = 1;	
			$row['add'] = 1;	
			$row['update'] = 1;	
			$row['delete'] = 1;	
			$row['roles_id'] = $id;	
			$row['menu_id'] = $m->id;
			$data[] = $row;	
		} 
		$this->db->insert_batch($this->_t, $data);
	}

	public function get_previllage(){
		$this->db->select('menu, link, parent_id, view');
		$this->db->where('roles_id', $this->session->userdata('role_id'));
		$this->db->where('view', 1);
		$this->db->join('menu m', 'p.menu_id = m.id', 'left');
		$result = $this->db->get($this->_t.' p')->result();
		return $result;
	}

}
