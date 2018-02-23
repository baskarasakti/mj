<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_inventory extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('material_inventory_model', 'mi');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('no', '', 'No');
        $table->addColumn('name', '', 'Name');       
        $table->addColumn('debit', '', 'Debit');       
        $table->addColumn('credit', '', 'Credit');       
        $table->addColumn('qty', '', 'Balance');        
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }

    public function get_material_categories(){
		$result = $this->mi->get_all_data();
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$row['Name'] = $value->name;
			$row['Id'] = $value->id;
			$data[] = $row;
			$count++;
		}

		$result = $data;
		echo json_encode($result);
	}
	
	public function index()
	{
		$data['title'] = "ERP | Material Inventory";
		$data['page_title'] = "Material Inventory";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Inventory", "Material Inventory");
		$data['page_view']  = "inventory/material_inventory";		
		$data['js_asset']   = "material-inventory";	
		$data['columns']    = $this->get_column_attr();
		$data['columns1']    = $this->get_column_attr1();
		$data['csrf'] = $this->csrf;		
		$data['menu'] = $this->get_menu();					
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->mi->get_output_data();
        $data = array();
        $count = 0;
        foreach($result['data'] as $value){
            $count++;
            $row = array();
            $row['id'] = $value->id;
			$row['name'] = $value->name;
			$row['no'] = $count;
			$row['debit'] = $value->debit;
			$row['credit'] = $value->credit;
			$row['qty'] = $value->qty;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button">View Detail</button>';
            $data[] = $row;
        }

        $result['data'] = $data;

        echo json_encode($result);
	}

	public function get_material_inventory($id){
		$result = $this->mi->get_material_inventory($id);
        echo json_encode($result);
	}

	function add(){
		$data = array(
			'materials_id' => $this->normalize_text($this->input->post('materials_id')),
			'type' => $this->normalize_text($this->input->post('type')),
			'date' => date("Y-m-d H:i:s"),
			'qty' => $this->normalize_text($this->input->post('qty')),
			'adjustment' => 1
		);
		$inserted = $this->mi->add($data);
		echo json_encode(array('status' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->mi->get_by_id('materials_id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name'))
		);
		$status = $this->mi->update('id', $this->input->post('change_id'), $data);
		echo json_encode(array('status' => $status));
   }

	function delete($id){        
		$status = $this->mi->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->mi->get_material_inventories($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['name'] = $value->name;
				$row['date'] = $value->date;
				$row['type'] = $value->type;
				$row['qty'] = $value->qty;
				if ($value->receive_details_id != null) {
					$row['status'] = "receiving";
				} elseif ($value->p_return_details_id) {
					$row['status'] = "return";
				} elseif ($value->material_usages_detail_id) {
					$row['status'] = "pickup/return";
				} elseif ($value->adjustment) {
					$row['status'] = "adjustment";
				}
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;
		}
	}

}
