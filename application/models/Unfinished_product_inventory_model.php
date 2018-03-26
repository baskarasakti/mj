<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unfinished_product_inventory_model extends MY_Model {

	protected $_t = 'unfinished_product_inventory';
		
	var $table = 'unfinished_product_inventory';
	var $column = array('p.id', 'debit', 'credit','qty', 'name'); //set column field database for order and search
    var $order = array('p.id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select(array('p.id as id', 'SUM(CASE WHEN upi.type = "in" THEN upi.qty ELSE 0 END)+p.initial_half_qty as debit', 'SUM(CASE WHEN upi.type = "out" THEN upi.qty ELSE 0 END) as credit','SUM(CASE WHEN upi.type = "in" THEN upi.qty ELSE 0 END)+p.initial_half_qty-SUM(CASE WHEN upi.type = "out" THEN upi.qty ELSE 0 END) as qty', 'p.name as name'));
		$this->db->from($this->table. " upi");
		$this->db->join('products p', 'p.id = upi.products_id');
		$this->db->group_by('p.id, p.name');
 
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

	public function get_unfinished_product_inventories($id)
	{
		$this->db->select(array('p.id as id', 'p.name as name', 'upi.date as date', 'upi.type as type', 'upi.qty as qty', 'upi.nonmaterial_usages_detail_id', 'upi.product_movement_id', 'p.initial_half_qty', 'wo.code as wocode', 'mu.code_pick as mucodepick', 'mu.code_return as mucodereturn'),false);
		$this->db->from($this->table. " upi");
		$this->db->join('products p', 'upi.products_id = p.id', 'left');
		$this->db->join('product_movement pm', 'upi.product_movement_id = pm.id', 'left');
		$this->db->join('work_orders wo', 'pm.work_orders_id = wo.id', 'left');
		$this->db->join('material_usages mu', 'upi.nonmaterial_usages_detail_id = mu.id', 'left');
		$this->db->where('upi.products_id', $id);
		return $this->db->get()->result();
	}

	public function get_unfinished_product_inventory($id)
	{
		$this->db->select(array('p.id as id', 'p.name as name', 'upi.date as date', 'upi.type as type', 'upi.qty as qty', 'upi.nonmaterial_usages_detail_id', 'upi.product_movement_id', 'p.initial_half_qty'),false);
		$this->db->from($this->table. " upi");
		$this->db->join('products p', 'upi.products_id = p.id', 'left');
		$this->db->where('upi.products_id', $id);
		return $this->db->get()->row();
	}

	public function material_usage_change($id, $products_id, $detail, $type){
		$this->db->where('nonmaterial_usages_detail_id', $id);
		$this->db->where('products_id', $products_id);
		$this->db->where('type', $type);
		$row = $this->db->get($this->_t)->row();
		if(isset($row)){
			$qty = 0;
			if($type == "out"){
				$qty = $detail->qty_pick;
			}else{
				$qty = $detail->qty_return;
			}
			$data = array(
				'date' => date("Y-m-d h:m:s"),
				'type' => $type,
				'qty' =>  $qty
			);
			$this->db->where('id', $row->id);
			$status = $this->db->update($this->_t, $data);
		}else{
			$qty = 0;
			if($type == "out"){
				$qty = $detail->qty_pick;
			}else{
				$qty = $detail->qty_return;
			}
			$data = array(
				'date' => date("Y-m-d h:m:s"),
				'type' => $type,
				'nonmaterial_usages_detail_id' => $id,
				'qty' => $qty,
				'products_id' => $detail->products_id
			);
			$status = $this->db->insert($this->_t, $data);
		}
		return true;
	}

}
