<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasing extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('purchase_model', 'prc');
		$this->load->model('purchase_det_model', 'prd');
		$this->load->model('materials_model', 'mm');
		$this->load->model('vendors_model', 'vd');
		$this->load->model('currency_model', 'cm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'Id');
		$table->addColumn('code', '', 'Kode');
		$table->addColumn('delivery_date', '', 'Date');        
		$table->addColumn('vat', '', 'Vat');        
		$table->addColumn('vendor', '', 'Vendor');        
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
		$data['page_title'] = "Purchasing";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Purchase List");
		$data['page_view']  = "purchasing/purchasing";		
		$data['js_asset']   = "purchasing";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();						
		$data['vendors'] = $this->vd->get_all_data();	
		$data['currency'] = $this->cm->get_all_data();	
		$this->load->view('layouts/master', $data);
	}

	public function generate_id(){
		$id = $this->prc->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function view_data(){
		$result = $this->prc->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
			$row['delivery_date'] = $value->delivery_date;
			$row['vat'] = $value->vat;
			$row['vendor'] = $value->vendor;
			$row['actions'] = $value->status == 'true' ? '<a href=invoice/print_purchasing/'.$value->id.'><button class="btn btn-sm btn-success" type="button">Print</button></a>' : '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa fa-edit"></i></button>
			.<button class="btn btn-sm btn-danger" onclick="remove('.$value->id.')" type="button"><i class="fa fa-trash"></i></button>';
			$data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add(){
		$data = array(
			'code' => $this->input->post('code'),
			'vat' => $this->input->post('vat'),
			'delivery_date' => $this->input->post('delivery_date'),
			'delivery_place' => $this->normalize_text($this->input->post('delivery_place')),
			'note' => $this->normalize_text($this->input->post('note')),
			'vendors_id' => $this->input->post('vendor'),
			'currency_id' => $this->normalize_text($this->input->post('currency')),
			'created_at' => $this->mysql_time_now()
		);
		$inserted = $this->prc->add_id($data);
		echo json_encode(array('id' => $inserted,'vendors_id' => $this->input->post('vendor')));
	}

	function get_by_id($id){
		$detail = $this->prc->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'vat' => $this->input->post('vat'),
			'delivery_date' => $this->input->post('delivery_date'),
			'delivery_place' => $this->normalize_text($this->input->post('delivery_place')),
			'note' => $this->normalize_text($this->input->post('note')),
			'vendors_id' => $this->input->post('vendor'),
			'currency_id' => $this->normalize_text($this->input->post('currency')),
			'updated_at' => $this->mysql_time_now()
		);
		$status = $this->prc->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status, 'vendors_id' => $this->input->post('vendor')));
	}

	function delete($id){        
		$status = $this->prc->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id= -1){
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
				$row['uom'] = $value->uom;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'qty' => $this->normalize_text($this->input->post('qty')),
				'materials_id' => $this->normalize_text($this->input->post('name')),
				'purchasing_id' => $id
			);
			$result = $this->prd->add($data);

			$materials = $this->mm->get_by_id('id', $this->input->post('name'));

			$row = array();
			$row['id'] = $result;
			$row['name'] = $this->input->post('name');
			$row['qty'] = $this->input->post('qty');
			$row['uom'] = $materials->uom_id;

			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'materials_id' => $this->normalize_text($this->input->input_stream('name')),
				'qty' => $this->normalize_text($this->input->input_stream('qty')),
			);
			$result = $this->prd->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$received = $this->prd->check_received($this->input->input_stream('id'));
			if ($received == 0) {
				$status = $this->prd->delete('id', $this->input->input_stream('id'));
			}
			break;
		}
	}

}
