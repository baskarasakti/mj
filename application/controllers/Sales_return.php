<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_return extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('shipping_model', 'sm');
		$this->load->model('shipping_details_model', 'sdm');
		$this->load->model('sales_return_model', 'srm');
		$this->load->model('sales_return_detail_model', 'srdm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');  
		$table->addColumn('p_code', '', 'Shipping Code');       
		$table->addColumn('date', '', 'Return Date');               
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | Sales Return";
		$data['page_title'] = "Sales Return";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Sales", "Sales Return");
		$data['page_view']  = "sales/return";		
		$data['js_asset']   = "sales_return";	
		$data['columns']    = $this->get_column_attr();	
		$data['shippings'] = $this->sm->get_all_data();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function generate_id(){
		$id = $this->srm->generate_id();
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
		$result = $this->srm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
			$row['p_code'] = $value->p_code;
			$row['date'] = $value->date;
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
			'date' => $this->to_mysql_date($this->input->post('sales_return_date')),
			'product_shipping_id' => $this->input->post('product_shipping_id'),
		);
		$data = $this->add_adding_detail($data);
		$inserted = $this->srm->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->srm->get_by_id('id', $id);
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
			$result = $this->sdm->add($data);

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
