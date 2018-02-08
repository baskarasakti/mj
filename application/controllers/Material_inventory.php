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
        $table->addColumn('qty', '', 'Qty');        
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }

    private function get_column_attr1(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('date', '', 'Date');
        $table->addColumn('type', '', 'Type');      
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
		$data['breadcumb']  = array("Master", "Material Inventory");
		$data['page_view']  = "inventory/material_inventory";		
		$data['js_asset']   = "material-inventory";	
		$data['columns']    = $this->get_column_attr();
		$data['columns1']    = $this->get_column_attr1();
		$data['csrf'] = $this->csrf;		
		$data['menu'] = $this->get_menu();					
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->mi->get_material_stock();
        $data = array();
        $count = 0;
        foreach($result as $value){
            $count++;
            $row = array();
            $row['id'] = $value->id;
			$row['name'] = $value->name;
			$row['no'] = $count;
			$row['qty'] = $value->qty;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button">View Detail</button>';
            $data[] = $row;
        }

        $result['data'] = $data;

        echo json_encode($result);
	}

	public function view_data1($id){
		$result = $this->mi->get_material_inventory($id);
        $data = array();
        $count = 0;
        foreach($result as $value){
            $count++;
            $row = array();
            $row['id'] = $value->id;
			$row['date'] = $value->date;
			$row['type'] = $type;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button">View Detail</button>';
            $data[] = $row;
        }

        $result['data'] = $data;

        echo json_encode($result);
	}

	function add(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name'))
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
			$result = $this->mi->get_material_inventory($id);
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
				} elseif ($value->material_usage_details_id) {
					$row['status'] = "pickup";
				} elseif ($value->material_return_detail_id) {
					$row['status'] = "return";
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
