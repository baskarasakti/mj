<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_orders_model extends MY_Model {

	protected $_t = 'work_orders';
		
	function get_work_orders($id){
        $this->db->select('wo.id as id, pd.id as pd_id, wo.code as code, start_date, end_date, wo.qty as qty');
        $this->db->where('projects_id', $id);
		$this->db->join('project_details pd', 'wo.project_details_id = pd.id', 'left');
        $this->db->join('projects p', 'pd.projects_id = p.id', 'left');		
        $result = $this->db->get($this->_t.' wo');
        return $result->result();
	}

	function populate_wo_select(){
		$this->db->select('wo.id as id, wo.code as wo_code, p.code as p_code');
		$this->db->join('projects p', 'wo.projects_id = p.id', 'left');	
		$result = $this->db->get($this->_t.' wo');
        return $result->result();
	}

	public function generate_id(){
		$prefix = "WO-";
		$infix = date("Ymd-");
		$this->db->select("MAX(RIGHT(`code`, 4)) as 'maxID'");
        $this->db->like('code', $prefix.$infix, 'after');
        $result = $this->db->get($this->_t);
        $code = $result->row(0)->maxID;
        $code++; 
        return $prefix.$infix.sprintf("%04s", $code);
	}
	

}
