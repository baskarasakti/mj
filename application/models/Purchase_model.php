<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends MY_Model {

	protected $_t = 'purchasing';
		
	var $table = 'purchasing';
	var $column = array('id','code', 'delivery_date', 'vendors_id'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('pc.id, pc.code, pc.delivery_date, pc.vendors_id, v.name as vendor, CASE WHEN pc.vat = 0 THEN "NON-PPN" ELSE "PPN" END as vat', false);
		$this->db->from($this->table." pc");
		$this->db->join('vendors v', 'v.id = pc.vendors_id');
 
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

	public function generate_id(){
		$vat = "P";
		$seg1 = "/OP-MC"; 
		$seg2 = "/".$this->get_roman_number(date("n")); 
		$seg3 = "/".substr(date("Y"), 2, 2); 
		$this->db->select("MAX(LEFT(`code`, 3)) as 'maxID'");
        $this->db->like('code', $seg1.$seg2.$seg3, 'before');
        $result = $this->db->get($this->_t);
        $code = $result->row(0)->maxID;
        $code++; 
        return sprintf("%03s", $code).$seg1.$seg2.$seg3;
	}

}
