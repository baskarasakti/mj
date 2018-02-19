<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_movement extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('product_movement_model', 'pmm');
		$this->load->model('product_movement_det_model', 'pmdm');
		$this->load->model('processes_model', 'prcm');
		$this->load->model('work_orders_model', 'wom');
		$this->load->model('work_order_detail_model', 'wodm');
	}

	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('no', '', 'No');
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');         
		$table->addColumn('projects_code', '', 'Sales Order');        
		$table->addColumn('ppn', '', 'VAT');        
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	private function get_column_attr1(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('qty', '', 'Qty');         
		$table->addColumn('note', '', 'Note');         
		$table->addColumn('products_id', '', 'Products');     
		$table->addColumn('actions', '', 'Actions');  
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | Product Movement";
		$data['page_title'] = "Product Movement";
		$data['table_title'] = "List Work Orders";		
		$data['table_title1'] = "List Products";		
		$data['breadcumb']  = array("Production", "Product Movement");
		$data['page_view']  = "production/product_movement";		
		$data['js_asset']   = "product-movement";	
		$data['columns']    = $this->get_column_attr();	
		$data['columns1']    = $this->get_column_attr1();	
		$data['process'] = $this->prcm->get_all_data();	
		$data['menu'] = $this->get_menu();					
		$data['csrf'] = $this->csrf;		
		$this->load->view('layouts/master', $data);
	}

	public function view_data($id){
		$result = $this->wodm->get_where_id('work_orders_id',$id);
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['qty'] = $value->qty;
			$row['note'] = $value->note;
			$row['products_id'] = $value->products_id;
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
			$result = $this->pmdm->get_product_movement_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['code'] = $value->code;
				$row['processes_id'] = $value->processes_id;
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
