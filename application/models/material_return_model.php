<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_return_model extends MY_Model {

	protected $_t = 'material_return';
		
	var $table = 'material_return';
	var $column = array('id','code', 'return_date'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('id, code, return_date');
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

	public function have_material_return($a, $id)
	{		
		$this->db->select(array('id','return_date','code'));
		$this->db->where($a, $id);
        $result = $this->db->get($this->table);
        $data = array();
        if($result->result()){
            $data = $result->row();
        }
        return $data;
	}

}
