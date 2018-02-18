<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup_material extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('productions_model', 'pm');
			$this->load->model('production_details_model', 'pdm');
			$this->load->model('usage_cat_model', 'uc');
			$this->load->model('material_usage_model', 'mu');
			$this->load->model('material_usage_cat_model', 'muc');
			$this->load->model('material_usage_det_model', 'mud');
			$this->load->model('material_inventory_model', 'mi');
			$this->load->model('machine_model', 'mm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
		$table->addColumn('production_date', '', 'Production Date');            
		$table->addColumn('actions', '', 'Actions');       
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Pickup Materials";
		$data['page_title'] = "Pickup Materials";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Pickup Materials");
		$data['page_view']  = "production/pickup";		
		$data['js_asset']   = "pickup";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;					
		$data['menu'] = $this->get_menu();		
		$data['u_categories']    = $this->uc->get_all_data();		
		$data['machines']    = $this->mm->populate_select();		
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
		$result = $this->pm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['production_date'] = $value->production_date;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="add('.$value->id.')" type="button">Pick Materials</button>';
			$data[] = $row;
			$count++;
		}

		$result['data'] = $data;

		echo json_encode($result);
	}

	function add(){
		$data = array(
			'usage_date' => $this->normalize_text($this->input->post('date')),
			'production_details_id' => $this->input->post('asd'),
			'usage_categories_id' => $this->input->post('usage_categories')
		);
		$inserted = $this->mu->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->mu->get_by_id('id', $id);
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
		$status = $this->pm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->mud->get_material_usage_details($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['name'] = $value->id_materials;
				$row['qty'] = $value->qty;
				$row['note'] = $value->note;
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
				'note' => $this->normalize_text($this->input->post('note')),
				'material_usage_id' => $id
			);
			$insert = $this->mud->add_id($data);

			$data2 = array(
				'date' => $this->mysql_time_now(),
				'type' => 'out',
				'material_usage_details_id' => $insert,
				'qty' => $this->normalize_text($this->input->post('qty')),
				'materials_id' => $this->normalize_text($this->input->post('name'))
			);

			$this->mi->add_id($data2);

			$row = array();
			$row['id'] = $insert;
			$row['name'] = $this->normalize_text($this->input->post('name'));
			$row['qty'] = $this->normalize_text($this->input->post('qty'));
			$row['note'] = $this->normalize_text($this->input->post('note'));

			echo json_encode($row);
			break;

			case "PUT":
			$this->input->raw_input_stream;
			$data = array(
				'materials_id' => $this->normalize_text($this->input->input_stream('name')),
				'qty' => $this->normalize_text($this->input->input_stream('qty')),
				'note' => $this->normalize_text($this->input->input_stream('note'))
			);
			$insert = $this->mud->update_id('id',$this->input->input_stream('id'),$data);

			$data2 = array(
				'date' => $this->mysql_time_now(),
				'type' => 'out',
				'qty' => $this->normalize_text($this->input->input_stream('qty')),
				'materials_id' => $this->normalize_text($this->input->input_stream('name')) 
			);

			$this->mi->update_id('material_usage_details_id',$this->input->input_stream('id'),$data2);
			break;

			case "DELETE":
			$status = $this->mud->delete('id', $this->input->input_stream('id'));
			break;
		}
	}

}
