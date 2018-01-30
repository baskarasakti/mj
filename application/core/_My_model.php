<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
	protected $_t = '';

	var $table = '';
	var $column = array(); //set column field database for order and search
    var $order = array(); // default order
        
    function __construct() {
        parent::__construct();
        $this->load->database();
	}

	protected function _get_datatables_query() {
         
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

	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }
    
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
	}

	function get_output_data(){
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->count_all(),
			"recordsFiltered" => $this->count_filtered(),
			"data" => $this->get_datatables(),
		);
		return $output;
	}

	public function get_all_data(){
		return $this->db->get($this->_t)->result();
	}

	public function count_all_data(){
		$this->db->from($this->_t);
		return $this->db->count_all_results();
	}

	function add($data){
        $inserted = $this->db->insert($this->_t, $data);     
        return $inserted;
	}
	
	function get_by_id($column, $id){
        $this->db->where($column, $id);
        $result = $this->db->get($this->_t);
        $data = array();
        if($result->result()){
            $data = $result->row();
        }
        return $data;
	}
	
	function update($column, $id, $data){
        $this->db->where($column, $id);
        $this->db->update($this->_t, $data);
        $num_removed = $this->db->affected_rows();
        if($num_removed == 1){
            return TRUE;
        }else{
            return TRUE;
        }
    }

	function delete($column, $id){
        $this->db->delete($this->_t, array($column => $id));
        $num_removed = $this->db->affected_rows();
        if($num_removed == 1){
            return TRUE;
        }
        return FALSE;
    }

}
