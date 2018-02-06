<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_return_det_model extends MY_Model {

	protected $_t = 'material_return_details';
		
	var $table = 'material_return_details';
	var $column = array('id','qty', 'note', 'materials_id'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('m.id, m.qty, m.note, m.materials_id, m.material_return_id, m.name as name');
		$this->db->from($this->table. "mrd");
		$this->db->join('materials m', 'm.id = mrd.materials_id');
 
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

	public function get_material_return_details($id)
	{
		$this->db->select(array('mrd.id as id','m.id as id_materials','qty','note','materials_id','m.name as name'));
        $this->db->where('material_return_id', $id);
        $this->db->join('materials m', 'm.id = mrd.materials_id', 'LEFT');
        $result = $this->db->get('material_return_detail mrd');
        return $result->result();
	}

}
