<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hpp extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('usage_cat_model', 'uc');
			$this->load->model('material_usage_model', 'mu');
			$this->load->model('material_usage_cat_model', 'muc');
			$this->load->model('material_usage_det_model', 'mud');
			$this->load->model('material_inventory_model', 'mi');
			$this->load->model('work_orders_model', 'wom');
			$this->load->model('machine_model', 'mm');
			$this->load->model('hpp_model', 'hm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');            
		$table->addColumn('pcode', '', 'Product Code');           
		$table->addColumn('name', '', 'Product');            
		$table->addColumn('material_cost', '', 'Material Cost');            
		$table->addColumn('btkl', '', 'BTKL');            
		$table->addColumn('bop', '', 'BOP');            
		$table->addColumn('actions', '', 'Actions');       
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | HPP";
		$data['page_title'] = "HPP";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Production", "HPP");
		$data['page_view']  = "production/hpp";		
		$data['js_asset']   = "hpp";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;					
		$data['menu'] = $this->get_menu();			
		$this->load->view('layouts/master', $data);
	}

	public function get_material_usage_details($id){
		$result = $this->mud->get_material_usage_details($id);
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
	
	public function generate_id(){
		$id = $this->mu->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function view_data(){
		$result = $this->hm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
			$row['pcode'] = $value->pcode;
			$row['name'] = $value->name;
			$row['material_cost'] = $this->get_material_cost($value->id);
			$row['btkl'] = $this->hm->get_total_btkl($value->id);;
			$row['bop'] = $this->hm->get_total_bop($value->id);
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="printEvidence('.$value->id.')" type="button"><i class="fa fa-print"></i></button>
							  .<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa fa-edit"></i></button>
							  .<button class="btn btn-sm btn-danger" onclick="remove('.$value->id.')" type="button"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add(){
		$code = $this->hm->generate_id();
		$data = array(
			'month' => $this->input->post('month'),
			'year' => $this->input->post('year'),
			'code' => $code,
			'products_id' => $this->input->post('products_id'),
			'penyusutan' => 0,
			'listrik' => 0,
			'lain_lain' => 0
		);
		$data = $this->add_adding_detail($data);
		$inserted = $this->hm->add_id($data);
		echo json_encode(array('id' => $inserted, 'code' => $code));
	}

	function get_by_id($id){
		$detail = $this->hm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'usage_date' => $this->normalize_text($this->input->post('date')),
			'production_details_id' => $this->input->post('asd'),
			'usage_categories_id' => $this->input->post('usage_categories')
		);
		$status = $this->pm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
   }

	function delete($id){        
		$status = $this->mu->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id=-1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->hm->get_material_list($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['category'] = $value->category;
				$row['name'] = $value->name;
				$row['pick'] = $value->pick."(".$value->symbol.")";
				$row['used'] = $value->pick-$value->return."(".$value->symbol.")";
				$row['return'] = $value->return."(".$value->symbol.")";
				$unit_price = round($this->hm->get_per_pieces_price($value->id), 2);
				$row['unit_price'] = $unit_price;
				$row['total_price'] = round(($value->pick-$value->return)*$unit_price, 2);
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;
		}
	}

	public function update_bop()
	{
		$data = array(
			'penyusutan' => $this->input->post('penyusutan'),
			'listrik' => $this->input->post('listrik'),
			'lain_lain' => $this->input->post('lain_lain')
		);
		$status = $this->hm->update_id('id', $this->input->post('hpp_id'), $data);
		echo json_encode(array('status' => $status));
   }

   public function get_material_cost($id)
   {
		$result = $this->hm->get_material_list($id);
		$total = 0;
		foreach($result as $value){
			$unit_price = round($this->hm->get_per_pieces_price($value->id), 2);
			$total += round(($value->pick-$value->return)*$unit_price, 2);
		}
		return $total;
   }

}
