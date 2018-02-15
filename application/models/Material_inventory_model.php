<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_inventory_model extends MY_Model {

	protected $_t = 'material_inventory';
		
	var $table = 'material_inventory';
	var $column = array('m.id', 'debit', 'credit','qty', 'name'); //set column field database for order and search
    var $order = array('m.id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select(array('m.id as id', 'SUM(CASE WHEN mi.type = "in" THEN mi.qty ELSE 0 END) as debit', 'SUM(CASE WHEN mi.type = "out" THEN mi.qty ELSE 0 END) as credit','SUM(CASE WHEN mi.type = "in" THEN mi.qty ELSE 0 END)-SUM(CASE WHEN mi.type = "out" THEN mi.qty ELSE 0 END) as qty', 'm.name as name'));
		$this->db->from($this->table. " mi");
		$this->db->join('materials m', 'm.id = mi.materials_id');
		$this->db->group_by('m.id, m.name');
 
		$i = 0;
	 
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		 
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_material_inventories($id)
	{
		$this->db->select(array('m.id as id', 'm.name as name', 'mi.date as date', 'mi.type as type', 'mi.qty as qty', 'mi.receive_details_id', 'mi.p_return_details_id', 'mi.material_usage_details_id', 'mi.material_return_detail_id', 'adjustment'),false);
		$this->db->from($this->table. " mi");
		$this->db->join('materials m', 'm.id = mi.materials_id');
		$this->db->where('mi.materials_id', $id);
		return $this->db->get()->result();
	}

	public function get_material_inventory($id)
	{
		$this->db->select(array('m.id as id', 'm.name as name', 'mi.date as date', 'mi.type as type', 'mi.qty as qty', 'mi.receive_details_id', 'mi.p_return_details_id', 'mi.material_usage_details_id', 'mi.material_return_detail_id'),false);
		$this->db->from($this->table. " mi");
		$this->db->join('materials m', 'm.id = mi.materials_id');
		$this->db->where('mi.materials_id', $id);
		return $this->db->get()->row();
	}

}
