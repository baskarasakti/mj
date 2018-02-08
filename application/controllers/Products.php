<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('products_model', 'pm');
		$this->load->model('product_cat_model', 'pcm');
		$this->load->model('product_materials_model', 'pmm');
		$this->load->model('product_process_model', 'ppm');
		$this->load->model('colors_model', 'cm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');
		$table->addColumn('name', '', 'Name');        
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}

	public function get_materials(){
		$result = $this->mm->get_all_data();
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
		$id = $this->pm->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function index()
	{
		$data['title'] = "ERP | Products";
		$data['page_title'] = "Products";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Products");
		$data['page_view']  = "master/products";		
		$data['js_asset']   = "products";	
		$data['columns']    = $this->get_column_attr();	
		$data['p_categories'] = $this->pcm->get_all_data();	
		$data['colors'] = $this->cm->get_all_data();		
		$data['csrf'] = $this->csrf;		
		$data['menu'] = $this->get_menu();					
		$this->load->view('layouts/master', $data);
	}

	public function populate_select(){
		$result = $this->pm->get_all_data();
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

	public function view_data(){
		$result = $this->pm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
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
			'name' => $this->normalize_text($this->input->post('name')),
			'code' => $this->input->post('code'),
			'product_categories_id' =>$this->input->post('product_categories_id')
		);
		$inserted = $this->pm->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->pm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name')),
			'code' => $this->input->post('code'),
			'product_categories_id' => $this->input->post('product_categories_id')
		);
		$status = $this->pm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
	}

	function delete($id){        
		$status = $this->pm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->pmm->get_product_materials($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['materials_id'] = $value->materials_id;
				$row['qty'] = $value->qty;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'materials_id' => $this->input->post('materials_id'),
				'qty' => $this->input->post('qty'),
				'products_id' => $id
			);
			$result = $this->pmm->add_id($data);

			$row = array();
			$row['id'] = $result;
			$row['materials_id'] = $this->input->post('materials_id');
			$row['qty'] = $this->input->post('qty');

			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'materials_id' => $this->input->input_stream('materials_id'),
				'qty' => $this->input->input_stream('qty'),
			);
			$result = $this->pmm->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->pmm->delete('id', $this->input->input_stream('id'));
			break;
		}
	}

	function jsgrid_functions2($id = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->ppm->get_product_process($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['processes_id'] = $value->processes_id;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'processes_id' => $this->input->post('processes_id'),
				'products_id' => $id
			);
			$result = $this->ppm->add($data);

			$row = array();
			$row['id'] = $result;
			$row['processes_id'] = $this->input->post('processes_id');
			
			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'processes_id' => $this->input->input_stream('processes_id')
			);
			$result = $this->ppm->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->ppm->delete('id', $this->input->input_stream('id'));
			break;
		}
	}


}
