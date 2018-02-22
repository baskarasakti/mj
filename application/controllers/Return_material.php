<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_material extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('usage_cat_model', 'uc');
			$this->load->model('material_cat_model', 'mcm');
			$this->load->model('material_return_model', 'mu');
			$this->load->model('material_usage_cat_model', 'muc');
			$this->load->model('material_return_det_model', 'mrd');
			$this->load->model('material_inventory_model', 'mi');
			$this->load->model('work_orders_model', 'wom');
			$this->load->model('machine_model', 'mm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
		$table->addColumn('date', '', 'Date');            
		$table->addColumn('code_pick', '', 'Pick Code');            
		$table->addColumn('code_return', '', 'Return Code');            
		$table->addColumn('wocode', '', 'WO Code');            
		$table->addColumn('name', '', 'Product');            
		$table->addColumn('actions', '', 'Actions');       
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Return Materials";
		$data['page_title'] = "Return Materials";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Return Materials");
		$data['page_view']  = "production/return";		
		$data['js_asset']   = "return";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;
		$data['menu'] = $this->get_menu();	
		$data['u_categories']    = $this->uc->get_all_data();	
		$data['categories']    = $this->mcm->get_all_data();	
		$data['machines']    = $this->mm->populate_select();					
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->mu->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['date'] = $value->date;
			$row['code_pick'] = $value->code_pick;
			$row['code_return'] = $value->code_return;
			$row['wocode'] = $value->wocode;
			$row['name'] = $value->name;
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
			'return_date' => $this->normalize_text($this->input->post('return_date')),
			'code' => $this->input->post('code'),
			'material_usage_id' => $this->input->post('asd'),
			'created_at' => date("Y-m-d H:m:s")
		);
		$inserted = $this->mr->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$data = array();
		$detail = $this->mu->get_by_id('id', $id);
		$data['detail'] = $detail;
		$status = $this->mr->have_material_return('material_usage_id', $id);
		$data['status'] = $status;
		echo json_encode($data);
	}

	function update(){
		$data = array(
			'return_date' => $this->normalize_text($this->input->post('return_date')),
			'code' => $this->input->post('code'),
			'material_usage_id' => $this->input->post('asd'),
			'updated_at' => date("Y-m-d H:m:s")
		);
		$status = $this->mr->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
   }

	function delete($id){        
		$status = $this->mr->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->mrd->get_material_return_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['materials_id'] = $value->materials_id;
				$row['name'] = $value->name;
				$row['qty'] = $value->qty;
				$row['note'] = $value->note;
				$row['symbol'] = $value->symbol;
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "DELETE":
			$status = $this->mrd->delete('id', $this->input->post('id'));
			break;
		}
	}


	public function update_detail(){
		$this->mu->generate_id($this->input->post('details_id'));
		$data = array(
			'return_note' => $this->normalize_text($this->input->post('note')),
			'qty_return' => $this->input->post('qty')
		);
		$status = $this->mrd->update_id('id',$this->input->post('details_id'),$data);
		echo json_encode(array('status'=> $status));
	}

}
