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
		$this->load->model('material_inventory_model', 'mi');
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
	
	public function populate_receiving_details($id=-1){
		$result = $this->rcvd->populate_receiving_details($id);
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


	public function index()
	{
		$data['title'] = "ERP | Receiving List";
		$data['page_title'] = "Receiving";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Receiving List");
		$data['page_view']  = "purchasing/receiving";		
		$data['js_asset']   = "receiving";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;
		$data['menu'] = $this->get_menu();							
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
			$row['actions'] = $value->status=="true" ? '<button class="btn btn-sm btn-success" onclick="details('.$value->id.')" type="button">Received</button>' : '<button class="btn btn-sm btn-info" onclick="receiving('.$value->id.')" type="button">Receive</button>';
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
			'code' => $this->input->post('code'),
			'receive_date' => $this->input->post('receive_date'),
			'currency_id' => $purchase_data->currency_id,
			'created_at' => date('Y-m-d H:i:s'),
		);
		$inserted = $this->rcv->add_id($data);

		$purchase_details = $this->prd->get_purchase_details($id);
		foreach($purchase_details as $value){
			$data = array(
				'qty' => 0,
				'unit_price' => 0,
				'discount' => 0,
				'total_price' => 0,
				'receiving_id' => $inserted,
				'materials_id' => $value->materials_id,
			);
			$insert = $this->rcvd->add_id($data);

			$data2 = array(
				'date' => $this->mysql_time_now(),
				'type' => 'in',
				'receive_details_id' => $insert,
				'qty' => $value->qty,
				'materials_id' => $value->materials_id 
			);

			$this->mi->add_id($data2);
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
				$row['discount'] = $value->discount;
				$row['total_price'] = $value->total_price;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			// case "POST":
			// $data = array(
			// 	'materials_id' => $this->normalize_text($this->input->post('name')),
			// 	'qty' => $this->normalize_text($this->input->post('qty')),
			// 	'unit_price' => $this->normalize_text($this->input->post('price')),
			// 	'purchasing_id' => $id
			// );
			// $result = $this->prd->add($data);

			// $row = array();
			// $row['id'] = $insert;
			// $row['name'] = $this->input->post('name');
			// $row['qty'] = $this->input->post('qty');
			// $row['price'] = $this->input->post('price');

			// echo json_encode($row);
			// break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				// 'materials_id' => $this->normalize_text($this->input->post('name')),
				'qty' => $this->input->input_stream('qty'),
				'unit_price' => $this->input->input_stream('price'),
				'discount' => $this->input->input_stream('discount'),
				'total_price' => $this->input->input_stream('price')*$this->input->input_stream('qty')
			);
			$result = $this->rcvd->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$status = $this->rcvd->delete('id', $this->input->input_stream('id'));
			break;
		}
	}

}
