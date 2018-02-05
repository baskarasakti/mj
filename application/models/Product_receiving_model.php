<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_receiving_model extends MY_Model {

	protected $_t = 'product_receiving';
		
	var $table = 'product_receiving';
	var $column = array('id','receive_date', 'production_details_id'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('id, receive_date, production_details_id');
		$this->db->from($this->table);
 
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

	public function get_movement($id)
	{
		$sql = "SELECT processes_id, processes_id1, production_details_id, 
		SUM(Select prd.qty group by pr.processes_id)-SUM(select prd.qty order_by pr.processes_id1) AS total
		FROM product_receiving pr
		LEFT JOIN product_receiving_details prd on prd.product_receiving_id = pr.id 
		LEFT JOIN production_details pd on prd.production_details_id = pd.id 
		LEFT JOIN production p on pd.production_id = p.id 
		WHERE prd.production_details_id = ".$id;

		return $this->db->query($sql)->result();
	}
}
