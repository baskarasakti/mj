<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_orders extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('projects_model', 'pm');
		$this->load->model('work_orders_model', 'wom');		
		$this->load->model('project_details_model', 'pdm');
		$this->load->model('work_orders_model', 'wom');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');        
		$table->addColumn('name', '', 'Name');        
		$table->addColumn('description', '', 'Description');        
		$table->addColumn('customer', '', 'Customer');        
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | Work Orders";
		$data['page_title'] = "Work Orders";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Production", "Work Orders");
		$data['page_view']  = "production/work_orders";		
		$data['js_asset']   = "work-orders";	
		$data['columns']    = $this->get_column_attr();		
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();						
		$this->load->view('layouts/master', $data);
	}

	public function populate_wo_select(){
		$result = $this->wom->populate_wo_select();
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$row['Name'] = $value->wo_code;
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
			$row['description'] = $value->description;
			$row['customer'] = $value->customer;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa fa-edit"></i></button>
							   <button class="btn btn-sm btn-danger" onclick="remove('.$value->id.')" type="button"><i class="fa fa-trash"></i></button>';
			$data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add(){
		$data = array(
			'code' => $this->input->post('code'),			
			'name' => $this->normalize_text($this->input->post('name')),
			'description' => $this->normalize_text($this->input->post('description')),
			'customers_id' =>$this->input->post('customers_id')
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
			$result = $this->wom->get_work_orders($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['pd_id'] = $value->pd_id;
				$row['code'] = $value->code;
				$row['start_date'] = $value->start_date;
				$row['end_date'] = $value->end_date;
				$row['qty'] = $value->qty;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'code' => $this->input->post('code'),
				'start_date' =>$this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'qty' => $this->input->post('qty'),
				'project_details_id' => $this->input->post('pd_id'),
				'created_at' => date("Y-m-d H:m:s")
			);
			$result = $this->wom->add($data);

			$row = array();
			$row['id'] = $insert;
			$row['pd_id'] = $this->input->post('pd_id');
			$row['code'] = $this->input->post('code');
			$row['start_date'] = $this->input->post('start_date');
			$row['end_date'] = $this->input->post('end_date');
			$row['qty'] = $this->input->post('qty');

			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'code' => $this->input->input_stream('code'),
				'start_date' =>$this->input->input_stream('start_date'),
				'end_date' => $this->input->input_stream('end_date'),
				'qty' => $this->input->input_stream('qty'),
				'project_details_id' => $this->input->input_stream('pd_id'),
				'updated_at' =>  date("Y-m-d H:m:s")
			);
			$result = $this->wom->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->wom->delete('id', $this->input->input_stream('id'));
			break;
		}
	}


}
