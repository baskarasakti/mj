<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_receiving extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('product_receiving_model', 'prm');
		$this->load->model('product_receiving_det_model', 'prdm');
		$this->load->model('productions_model', 'pm');
		$this->load->model('processes_model', 'prcm');
		$this->load->model('production_details_model', 'pdm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('receive_date', '', 'Receive Date');         
		$table->addColumn('name', '', 'Process');         
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | Shipping";
		$data['page_title'] = "Product Receiving";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Production", "Product Receiving");
		$data['page_view']  = "master/product_receiving";		
		$data['js_asset']   = "product-receiving";	
		$data['columns']    = $this->get_column_attr();	
		$data['process'] = $this->prcm->get_all_data();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->prm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['receive_date'] = $value->receive_date;
			$row['name'] = $value->name;
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
			'receive_date' => $this->input->post('receive_date'),
			'processes_id' => $this->input->post('processes_id'),
			'processes_id1' => $this->input->post('processes_id1')
		);
		$inserted = $this->prm->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->prm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'receive_date' => $this->input->post('receive_date'),
			'processes_id' => $this->input->post('processes_id'),
			'processes_id1' => $this->input->post('processes_id1')
		);
		$status = $this->prm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
	}

	function delete($id){        
		$status = $this->prm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->prdm->get_product_receiving_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['products_id'] = $value->product_id;
				$row['qty'] = $value->qty;
				$row['note'] = $value->note;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$temp = explode("-", $this->input->post('products_id'));
			$data = array(
				'products_id' => $temp[1],
				'production_details_id' => $temp[0],
				'qty' => $this->input->post('qty'),
				'note' =>$this->input->post('note'),
				'product_receiving_id' => $id
			);
			$insert = $this->prdm->add_id($data);

			$row = array();
			$row['id'] = $insert;
			$row['products_id'] = $this->input->post('products_id');
			$row['qty'] = $this->input->post('qty');
			$row['note'] = $this->input->post('note');

			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'products_id' => $this->input->input_stream('products_id'),
				'qty' => $this->input->input_stream('qty'),
				'note' =>$this->input->input_stream('note')
			);
			$result = $this->prdm->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->prdm->delete('id', $this->input->input_stream('id'));
			break;
		}
	}


}
