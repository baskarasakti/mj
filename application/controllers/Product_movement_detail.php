<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_movement_detail extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('product_movement_model', 'pmm');
		$this->load->model('product_movement_det_model', 'pmdm');
		$this->load->model('product_process_model', 'ppm');
		$this->load->model('processes_model', 'prcm');
		$this->load->model('work_orders_model', 'wom');
		$this->load->model('work_order_detail_model', 'wodm');
		$this->load->model('products_model', 'pm');	
	}

	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('name', '', 'Name');     
		$table->addColumn('actions', '', 'Actions');     
		return $table->getColumns();
	}

	public function index($woid, $pid)
	{
		$pname = $this->pm->get_by_id('id', $pid);

		$data['title'] = "ERP | Product Movement Details";
		$data['page_title'] = "Product Movement Details";
		$data['table_title'] = "List Processes for ".$pname->name;	
		$data['breadcumb']  = array("Production", "Product Movement");
		$data['page_view']  = "production/product_movement_detail";		
		$data['js_asset']   = "product-movement-detail";	
		$data['columns']    = $this->get_column_attr();		
		$data['process'] = $this->prcm->get_all_data();	
		$data['menu'] = $this->get_menu();					
		$data['woid'] = $woid;					
		$data['pid'] = $pid;				
		$data['csrf'] = $this->csrf;		
		$this->load->view('layouts/master', $data);
	}

	public function details($woid, $pid)
	{
		$pname = $this->pm->get_by_id('id', $pid);

		$data['title'] = "ERP | Product Movement Details";
		$data['page_title'] = "Product Movement Details";
		$data['table_title'] = "List Processes for ".$pname->name;	
		$data['breadcumb']  = array("Production", "Product Movement");
		$data['page_view']  = "production/product_movement_detail";		
		$data['js_asset']   = "product-movement-detail";	
		$data['columns']    = $this->get_column_attr();		
		$data['process'] = $this->prcm->get_all_data();	
		$data['menu'] = $this->get_menu();					
		$data['woid'] = $woid;					
		$data['pid'] = $pid;				
		$data['csrf'] = $this->csrf;		
		$this->load->view('layouts/master', $data);
	}

	public function view_data($id){
		$result = $this->ppm->get_product_process($id);
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$row['name'] = $value->name;
			$row['id'] = $value->processes_id;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button">Move Product</button>';
			$data[] = $row;
			$count++;
		}

		$process = array(
			array('id'=>-2,'name'=>'Not Processed'),
			array('id'=>-1,'name'=>'Unfinished'),
			array('id'=>0,'name'=>'Finished')
		);
		foreach ($process as $value) { 
			$row['name'] = $value['name'];
			$row['id'] = $value['id'];
			$data[] = $row;
		}

		$result['data'] = $data;
		echo json_encode($result);
	}

	function generate_code($woid, $pid){
		$data = array(
			'work_orders_id' => $woid,
			'products_id' => $pid,
			'machine_id' => 1
		);

		$data = $this->add_adding_detail($data);
		$inserted = $this->pmm->add_id($data);

		$codes = $this->generate_product_code($woid, $pid);
		for ($i=0; $i < $this->input->post('estimate'); $i++) { 
			$data = array(
				'code' => $codes.sprintf("%03s", $i+1),
				'date' => date('Y-m-d H:i:s'),
				'product_movement_id' => $inserted,
				'processes_id' => -2
			);
			$insert = $this->pmdm->add($data);
		}

		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->pmm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'receive_date' => $this->input->post('receive_date'),
			'processes_id' => $this->input->post('processes_id'),
			'processes_id1' => $this->input->post('processes_id1')
		);
		$status = $this->pmm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
	}

	function delete($id){        
		$status = $this->pmm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($woid = -1, $pid = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->pmdm->get_product_movement_details($woid, $pid);
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

	public function generate_product_code($woid, $pid)
	{
		$products = $this->pm->get_by_id('id', $pid);

		$month = $this->get_roman_number(date('n'));
		$cat = null;
		if ($products->product_categories_id == 1) {
			$cat = 'MC';
		} else {
			$cat = 'AFTP';
		}
		$num = preg_replace('/[^0-9,.]/', "", $products->code);
		$pm = $this->pmm->count_product_movement($woid, $pid)+1;
		$count_pm = sprintf("%04s",$pm);

		$code = $month.$cat.$num." ".$count_pm;
		return $code;
	}

}
