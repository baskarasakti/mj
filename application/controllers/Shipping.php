<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('shipping_model', 'sm');
		$this->load->model('shipping_details_model', 'sdm');
		$this->load->model('projects_model', 'prm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');  
		$table->addColumn('projects_id', '', 'Projects Code');       
		$table->addColumn('shipping_date', '', 'Shipping Date');        
		$table->addColumn('note', '', 'Note');               
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | Shipping";
		$data['page_title'] = "Shipping";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Sales", "Shipping");
		$data['page_view']  = "sales/shipping";		
		$data['js_asset']   = "shipping";	
		$data['columns']    = $this->get_column_attr();	
		$data['projects'] = $this->prm->get_all_data();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function generate_id(){
		$id = $this->sm->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function populate_product_select($id=-1){
		$result = $this->sm->populate_product_select($id);
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

	public function view_data(){
		$result = $this->sm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
			$row['projects_id'] = $value->p_code;
			$row['shipping_date'] = $value->shipping_date;
			$row['note'] = $value->note;
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
			'shipping_date' => $this->to_mysql_date($this->input->post('shipping_date')),
			'note' => $this->normalize_text($this->input->post('note')),
			'projects_id' =>$this->input->post('projects_id'),
			'created_at' => $this->mysql_time_now()
		);
		$inserted = $this->sm->add_id($data);
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
				$row['unit_price'] = $value->total_price;
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
			$result = $this->sdm->add($data);
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
