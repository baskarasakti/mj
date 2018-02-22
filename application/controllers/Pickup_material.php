<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup_material extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('usage_cat_model', 'uc');
			$this->load->model('material_usage_model', 'mu');
			$this->load->model('material_usage_cat_model', 'muc');
			$this->load->model('material_usage_det_model', 'mud');
			$this->load->model('material_inventory_model', 'mi');
			$this->load->model('work_orders_model', 'wom');
			$this->load->model('machine_model', 'mm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
		$table->addColumn('date', '', 'Date');            
		$table->addColumn('code', '', 'Pick Code');           
		$table->addColumn('wocode', '', 'WO Code');            
		$table->addColumn('name', '', 'Product');            
		$table->addColumn('actions', '', 'Actions');       
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Pickup Materials";
		$data['page_title'] = "Pickup Materials";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Pickup Materials");
		$data['page_view']  = "production/pickup";		
		$data['js_asset']   = "pickup";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;					
		$data['menu'] = $this->get_menu();		
		$data['u_categories']    = $this->uc->get_all_data();		
		$data['machines']    = $this->mm->populate_select();		
		$this->load->view('layouts/master', $data);
	}

	public function get_material_usage_details($id){
		$result = $this->mud->get_material_usage_details($id);
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
	
	public function generate_id(){
		$id = $this->mu->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function view_data(){
		$result = $this->mu->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['date'] = $value->date;
			$row['code'] = $value->code;
			$row['wocode'] = $value->wocode;
			$row['name'] = $value->name;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa fa-edit"></i></button>
							  .<button class="btn btn-sm btn-danger" onclick="remove('.$value->id.')" type="button"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add(){
		$data = array(
			'code_pick' => $this->input->post('code'),
			'date' => $this->input->post('date'),
			'machine_id' => $this->input->post('machine_id'),
			'products_id' => $this->input->post('products_id'),
			'work_orders_id' => $this->input->post('work_orders_id'),
			'usage_categories_id' => $this->input->post('usage_categories_id')
		);
		$data = $this->add_adding_detail($data);
		$inserted = $this->mu->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->mu->get_by_id('id', $id);
		$wo = $this->wom->get_by_id('id', $detail->work_orders_id);
		$detail->work_orders_code = $wo->code;
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'usage_date' => $this->normalize_text($this->input->post('date')),
			'production_details_id' => $this->input->post('asd'),
			'usage_categories_id' => $this->input->post('usage_categories')
		);
		$status = $this->pm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
   }

	function delete($id){        
		$status = $this->mu->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id=-1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->mud->get_material_usage_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['materials_id'] = $value->materials_id;
				$row['name'] = $value->name;
				$row['qty'] = $value->qty;
				$row['note'] = $value->note;
				$row['symbol'] = $value->symbol;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->mud->delete('id', $this->input->input_stream('id'));
			break;
		}
	}

	public function add_detail(){
		$data = array(
			'material_usages_id' => $this->input->post('material_usages_id'),
			'materials_id' => $this->input->post('materials_id'),
			'pick_note' => $this->normalize_text($this->input->post('note')),
			'qty_pick' => $this->input->post('qty')
		);
		$status = $this->mud->add($data);
		echo json_encode(array('status'=> $status));
	}

	public function update_detail(){
		$data = array(
			'pick_note' => $this->normalize_text($this->input->post('note')),
			'qty_pick' => $this->input->post('qty')
		);
		$status = $this->mud->update_id('id',$this->input->post('details_id'),$data);
		echo json_encode(array('status'=> $status));
	}

}
