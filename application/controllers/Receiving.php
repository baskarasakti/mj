<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiving extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('purchase_model', 'prc');
		$this->load->model('purchase_det_model', 'prd');
		$this->load->model('materials_model', 'mm');
		$this->load->model('vendors_model', 'vd');
		$this->load->model('receive_model', 'rcv');
		$this->load->model('receive_det_model', 'rcvd');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('code', '', 'Kode');
		$table->addColumn('delivery_date', '', 'Delivery Date');       
		$table->addColumn('receive_date', '', 'Receive Date');     
		$table->addColumn('status', '', 'Status');     
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
		$data['title'] = "ERP | Receiving List";
		$data['page_title'] = "Receiving";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Receiving List");
		$data['page_view']  = "master/receiving";		
		$data['js_asset']   = "receiving";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$data['vendors'] = $this->vd->get_all_data();	
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->rcv->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['code'] = $value->code;
			$row['delivery_date'] = $value->delivery_date;
			$row['receive_date'] = $value->receive_date;
			$row['status'] = $value->status;
			$row['actions'] = $value->status=="true" ? '<button class="btn btn-sm btn-info" onclick="details('.$value->id_receive.')" type="button"><i class="fa  fa-info-circle"></i></button>
			<button class="btn btn-sm btn-success" type="button">Received</button>' : '<button class="btn btn-sm btn-info" onclick="details('.$value->id_receive.')" type="button"><i class="fa  fa-info-circle"></i></button>
			<button class="btn btn-sm btn-info" onclick="receiving('.$value->id.')" type="button">Receive</button>';
			$data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add($id){
		$purchase_data = $this->prc->get_by_id('id',$id);

		$data = array(
			'purchasing_id' => $id,
			'code' => $purchase_data->code,
			'receive_date' => date('Y-m-d H:i:s'),
			'created_at' => date('Y-m-d H:i:s'),
		);
		$inserted = $this->rcv->add_id($data);

		$purchase_details = $this->prd->get_purchase_details($id);
		foreach($purchase_details as $value){
			$data = array(
				'qty' => $value->qty,
				'unit_price' => $value->unit_price,
				'total_price' => $value->qty*$value->unit_price,
				'receiving_id' => $inserted,
				'materials_id' => $value->materials_id,
			);
			$this->rcvd->add($data);
		}

		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->rcv->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'code' => $this->normalize_text($this->input->post('code')),
			'delivery_date' => $this->normalize_text($this->input->post('date')),
			'vendors_id' => $this->normalize_text($this->input->post('vendor'))
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
			$result = $this->rcvd->get_receive_details($id);
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
