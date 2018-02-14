<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('shipping_model', 'sm');
		$this->load->model('shipping_details_model', 'sdm');
		$this->load->model('projects_model', 'prm');
		$this->load->model('project_details_model', 'pdm');
	}

	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');        
		$table->addColumn('vat', '', 'VAT');        
		$table->addColumn('description', '', 'Description');        
		$table->addColumn('customer', '', 'Customer');        
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	private function get_column_attr1(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');      
		$table->addColumn('shipping_date', '', 'Shipping Date');        
		$table->addColumn('note', '', 'Note');               
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | Shipping";
		$data['page_title'] = "Shipping";
		$data['table_title'] = "List Sales Order";		
		$data['table_title1'] = "List Shipping";		
		$data['breadcumb']  = array("Sales", "Shipping");
		$data['page_view']  = "sales/shipping";		
		$data['js_asset']   = "shipping";	
		$data['columns']    = $this->get_column_attr();	
		$data['columns1']    = $this->get_column_attr1();	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();						
		$this->load->view('layouts/master', $data);
	}

	public function generate_id(){
		$id = $this->sm->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function populate_shipping_details($id=-1){
		$result = $this->sdm->populate_shipping_details($id);
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$row['Name'] = $value->value;
			$row['Id'] = $value->id;
			$data[] = $row;
			$count++;
		}

		$result = $data;
		echo json_encode($result);
	}

	public function view_data($id){
		$result = $this->sm->get_where_id('projects_id',$id);
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
			$row['shipping_date'] = $value->shipping_date;
			$row['note'] = $value->note;
			$row['actions'] = '<a href=invoice/print_shipping/'.$value->id.'><button class="btn btn-sm btn-success" type="button">Print</button></a> <button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa fa-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="remove('.$value->id.')" type="button"><i class="fa fa-trash"></i></button>';
			$data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add($id){
		$data = array(
			'projects_id' => $id,
			'code' => $this->input->post('code'),			
			'shipping_date' => $this->to_mysql_date($this->input->post('shipping_date')),
			'note' => $this->normalize_text($this->input->post('note')),
			'created_at' => $this->mysql_time_now()
		);
		$inserted = $this->sm->add_id($data);

		$project_details = $this->pdm->get_project_details($id);
		foreach($project_details as $value){
			$data = array(
				'products_id' => $value->products_id,
				'qty' => $value->qty,
				'unit_price' => 0,
				'total_price' => 0,
				'product_shipping_id' => $inserted
			);
			$insert = $this->sdm->add_id($data);
		}

		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->sm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'code' => $this->input->post('code'),			
			'shipping_date' => $this->to_mysql_date($this->input->post('shipping_date')),
			'note' => $this->normalize_text($this->input->post('note')),
			'projects_id' =>$this->input->post('projects_id'),
			'updated_at' => $this->mysql_time_now()
		);
		$status = $this->sm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
	}

	function delete($id){        
		$status = $this->sm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->sdm->get_shipping_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['products_id'] = $value->product_id;
				$row['qty'] = $value->qty;
				$row['unit_price'] = $value->unit_price;
				$row['total_price'] = $value->total_price;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'products_id' => $this->input->post('products_id'),
				'qty' => $this->input->post('qty'),
				'unit_price' =>$this->input->post('unit_price'),
				'total_price' => $this->input->post('total_price'),
				'product_shipping_id' => $id
			);
			$insert = $this->sdm->add_id($data);

			$row = array();
			$row['id'] = $insert;
			$row['products_id'] = $this->input->post('products_id');
			$row['qty'] = $this->input->post('qty');
			$row['unit_price'] = $this->input->post('unit_price');
			$row['total_price'] = $this->input->post('total_price');

			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'qty' => $this->input->input_stream('qty'),
				'unit_price' =>$this->input->input_stream('unit_price'),
				'total_price' => $this->input->input_stream('total_price'),
				'products_id' => $this->input->input_stream('products_id')
			);
			$result = $this->sdm->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->sdm->delete('id', $this->input->input_stream('id'));
			break;
		}
	}


}
