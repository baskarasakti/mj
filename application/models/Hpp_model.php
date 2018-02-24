<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hpp_model extends MY_Model {

	protected $_t = 'hpp';
		
	var $table = 'hpp';
	var $column = array('h.id','h.code', 'p.code', 'p.name'); //set column field database for order and search
    var $order = array('h.id' => 'asc'); // default order 
	
	protected function _get_datatables_query() {
         
		$this->db->select('h.id as id, h.code as code, p.code as pcode, p.name as name');
		$this->db->from($this->_t.' h');
		$this->db->join('products p', 'h.products_id = p.id', 'left');
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
		$seg2 = "/HPP-MJ";
		$seg3 = "/".$this->get_roman_number($this->input->post('month'));
		$seg4 = "/".substr($this->input->post('year'), 2, 2);
		$this->db->select("MAX(LEFT(`code`, 2)) as 'maxID'");
        $result = $this->db->get($this->_t);
        $code = $result->row(0)->maxID;
        $code++; 
        return sprintf("%02s", $code).$seg2.$seg3.$seg4;
	}

	public function get_total_btkl($id)
	{
		$this->db->select('SUM(qty*price) as `total`', false);
		$this->db->where('hpp_id', $id);
		$this->db->group_by('hpp_id');
		$row = $this->db->get('btkl')->row();
		if(isset($row)){
			return $row->total;
		}
		return 0;
	}
	public function get_total_bop($id)
	{
		$this->db->select('penyusutan + listrik + lain_lain as `total`', false);
		$this->db->where('id', $id);
		$row = $this->db->get($this->_t)->row();
		if(isset($row)){
			return $row->total;
		}
		return 0;
	}

	public function get_material_list($id)
	{
		$this->db->where('id', $id);
		$hpp = $this->db->get($this->_t)->row();

		if(!isset($hpp)){
			return array();
		}
		$month = $hpp->month;
		if(sizeof($month) == 1){
			$month = "0".$month;
		}
	
		$this->db->select('mud.materials_id as id,  m.name as name, SUM(qty_pick) as `pick`, SUM(qty_return) as `return`, u.symbol, mc.id as idcat,mc.name as category');
		$this->db->join('material_usages mu', 'mud.material_usages_id = mu.id', 'left');
		$this->db->join('materials m', 'mud.materials_id = m.id', 'left');
		$this->db->join('uom u', 'm.uom_id = u.id', 'left');
		$this->db->join('material_categories mc', 'm.material_categories_id = mc.id', 'left');
		$this->db->where('DATE_FORMAT(mu.date, "%Y-%m") = ', $hpp->year."-".$month);
		$this->db->where('mu.products_id', $hpp->products_id);
		$this->db->group_by('mud.materials_id');
		$this->db->order_by('mc.id', 'asc');
		$result = $this->db->get('material_usages_detail mud')->result();
		return $result;
	}

	public function get_per_pieces_price($id)
	{
		$this->db->select('SUM(total_price-discount)/SUM(qty) as `price`');
		$this->db->where('materials_id', $id);
		$row = $this->db->get('receive_details')->row();
		if(isset($row)){
			return $row->price;
		}
		return 0;
	}

}
