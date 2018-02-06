<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_usage_det_model extends MY_Model {

	protected $_t = 'material_usage_details';
		
	var $table = 'material_usage_details';
	var $column = array('id','qty', 'note', 'material_usage_id', 'materials_id'); //set column field database for order and search
    var $order = array('id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('md.id as id, md.qty, md.note, md.material_usage_id, md.mateirals_id, m.name');
		$this->db->from($this->table. " md");
		$this->db->join('materials m', 'md.materials_id = m.id', 'left');
 
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

	public function get_material_usage_details($id)
	{
		$this->db->select(array('mud.id as id','m.id as id_materials','qty','note','materials_id','m.name as name'));
        $this->db->where('material_usage_id', $id);
        $this->db->join('materials m', 'm.id = mud.materials_id', 'LEFT');
        $result = $this->db->get('material_usage_details mud');
        return $result->result();
	}

}
