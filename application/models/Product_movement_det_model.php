<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_movement_det_model extends MY_Model {

	protected $_t = 'product_movement_details';
		
	var $table = 'product_movement_details';
	var $column = array('id','code','date','product_movement_id','processes_id'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('pmd.ad as id, p.name as name, pmd.date, pmd.code');
		$this->db->join("product_movement pm", "pm.id = pmd.product_movement_id", "left");
		$this->db->join("products p", "p.id = pm.products_id", "left");
		$this->db->from($this->table. " pmd");
 
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

	public function get_data(){
		return $this->db->get('roles')->result();
	}

	public function get_product_movement_details($id)
	{
		$this->db->select(array('pmd.id as id', 'pmd.code as code', 'pc.id as processes_id'));
		$this->db->from($this->table." pmd");
		$this->db->join('processes pc', 'pc.id = pmd.processes_id');
		$this->db->join('product_movement pm', 'pm.id = pmd.product_movement_id');
		$this->db->join('products p', 'p.id = pm.products_id');
		return $this->db->get()->result();
	}
}
