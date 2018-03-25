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
		$this->load->model('product_inventory_model', 'pim');	
		$this->load->model('machine_model', 'mm');	
	}

	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('name', '', 'Name');  
		return $table->getColumns();
	}

	private function get_column_attr1(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');
		$table->addColumn('created_by', '', 'Created by');     
		$table->addColumn('actions', '', 'Actions');     
		return $table->getColumns();
	}

	public function index($woid, $pid)
	{
		$pname = $this->pm->get_by_id('id', $pid);

		$data['title'] = "ERP | Product Movement Details";
		$data['page_title'] = "Product Movement Details";
		$data['table_title'] = "List Processes for ".$pname->name;	
		$data['table_title1'] = "List Product Movement ";	
		$data['breadcumb']  = array("Production", "Product Movement");
		$data['page_view']  = "production/product_movement_detail";		
		$data['js_asset']   = "product-movement-detail";	
		$data['columns']    = $this->get_column_attr();		
		$data['columns1']    = $this->get_column_attr1();		
		$data['process'] = $this->prcm->get_all_data();	
		$data['menu'] = $this->get_menu();					
		$data['woid'] = $woid;					
		$data['pid'] = $pid;				
		$data['csrf'] = $this->csrf;	
		$this->add_history($data['page_title']);	
		$this->load->view('layouts/master', $data);
	}

	public function details($woid, $pid)
	{
		$pname = $this->pm->get_by_id('id', $pid);

		$data['title'] = "ERP | Product Movement Details";
		$data['page_title'] = "Product Movement Details";
		$data['table_title'] = "List Processes for ".$pname->name;	
		$data['table_title1'] = "List Product Movement ";	
		$data['breadcumb']  = array("Production", "Product Movement");
		$data['page_view']  = "production/product_movement_detail";		
		$data['js_asset']   = "product-movement-detail";	
		$data['columns']    = $this->get_column_attr();		
		$data['columns1']    = $this->get_column_attr1();		
		$data['process'] = $this->prcm->get_all_data();	
		$data['machine'] = $this->mm->get_all_data();	
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

	public function view_data1($woid, $pid, $prid){
		$result = $this->pmm->get_product_movement($woid, $pid, $prid);
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$code = str_replace(" ", "", $value->code);
			$row['id'] = $value->id;
			$row['code'] = substr($code, 0, sizeof($code)-4);
			$row['created_by'] = $value->created_by;
			$row['actions'] = '<button class="btn btn-sm btn-info" onClick="edit('.$woid.','.$pid.','.$prid.','.$value->id.')" type="button">Details</button>';
			$data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function generate_code($woid, $pid){
		$data = array(
			'work_orders_id' => $woid,
			'products_id' => $pid,
			'machine_id' => NULL
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

	public function get_product_movement_detail($woid, $pid, $prid)
	{
		$result = $this->pmdm->get_product_movement_detail($woid, $pid, $prid);
		$data = array();
		$count = 0;
		foreach($result as $value){
			$row = array();
			$code = str_replace(" ", "", $value->code);
			$row['id'] = $value->id;
			$row['code'] = substr($code, 0, sizeof($code)-4);
			$row['created_by'] = $value->created_by;
			$row['actions'] = '<button class="btn btn-sm btn-info" onClick="edit('.$woid.','.$prid.')" type="button">Details</button>';
			$data[] = $row;
			$count++;
		}

		$result = $data;

		echo json_encode($result);
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

	function jsgrid_functions($woid = -1, $pid = -1, $prid = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->pmdm->get_product_movement_detail($woid, $pid, $prid);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['code'] = $value->code;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
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

	public function update_process()
	{
		$machine_code = $this->input->post('machine_id');
		$count = 0;
		foreach ($this->input->post('item') as $value) {
			$pmd = $this->pmdm->get_by_id('id', $value);
			$code = $pmd->code;
			$temp = explode(" ", $code);
			$temp[0] .= $machine_code;
			$result = $temp[0]." ".$temp[1];
			$data = array(
				'processes_id' => $this->input->post('process_id'),
				'code' => $result
			);
			$status = $this->pmdm->update('id', $value, $data);
			$count++;
		}

		if ($this->input->post('process_id') == 0) {
			$product_movement = $this->pmm->get_by_id('id', $this->input->post('pm_id'));
			$data1 = array(
				'product_movement_id' => $this->input->post('pm_id'),
				'qty' => $count,
				'type' => 'in',
				'date' => date('Y-m-d H:i:s'),
				'products_id' => $product_movement->products_id
			);
			$this->pim->add($data1);
		}

		echo json_encode(array('status' => $status));
	}

}
