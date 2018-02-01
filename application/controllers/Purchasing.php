<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasing extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('purchase_model', 'prc');
		$this->load->model('purchase_det_model', 'prd');
		$this->load->model('materials_model', 'mm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('code', '', 'Kode');
		$table->addColumn('delivery_date', '', 'Date');        
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
	
	public function index()
	{
		$data['title'] = "ERP | Purchase List";
		$data['page_title'] = "Purcchasing";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Purchase List");
		$data['page_view']  = "master/purchasing";		
		$data['js_asset']   = "purchasing";	
		$data['columns']    = $this->get_column_attr();	
		// $data['materials']    = $this->get_materials();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->prc->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['code'] = $value->code;
			$row['delivery_date'] = $value->delivery_date;
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
			'code' => $this->normalize_text($this->input->post('code')),
			'delivery_date' => $this->normalize_text($this->input->post('date'))
		);
		$inserted = $this->prc->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->prc->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'code' => $this->normalize_text($this->input->post('code')),
			'delivery_date' => $this->normalize_text($this->input->post('date'))
		);
		$status = $this->prc->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
	}

	function delete($id){        
		$status = $this->prc->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->prd->get_purchase_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['name'] = $value->id_materials;
				$row['qty'] = $value->qty;
				$row['price'] = $value->unit_price;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'materials_id' => $this->normalize_text($this->input->post('name')),
				'qty' => $this->normalize_text($this->input->post('qty')),
				'unit_price' => $this->normalize_text($this->input->post('price')),
				'purchasing_id' => $id
			);
			$result = $this->prd->add($data);
			break;

			case "PUT":
			$data = array(
				'materials_id' => $this->normalize_text($this->input->post('name')),
				'qty' => $this->normalize_text($this->input->post('qty')),
				'unit_price' => $this->normalize_text($this->input->post('price'))
			);
			$result = $this->prd->update('id',$this->input->post('id'),$data);
			break;

			case "DELETE":
			$status = $this->prc->delete('id', $this->input->post('id'));
			break;
		}
	}

}
