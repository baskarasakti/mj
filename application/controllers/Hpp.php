<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hpp extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->helper('tablefield');
		$this->load->model('projects_model', 'pm');
		$this->load->model('project_details_model', 'pdm');
		$this->load->model('customers_model', 'cm');
	}
	
	private function get_column_attr(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('code', '', 'Code');        
		$table->addColumn('name', '', 'Name');        
		$table->addColumn('description', '', 'Description');        
		$table->addColumn('customer', '', 'Customer');        
		$table->addColumn('actions', '', 'Actions');        
		return $table->getColumns();
	}
	
	public function index()
	{
		$data['title'] = "ERP | HPP";
		$data['page_title'] = "HPP";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("HPP", "HPP Product");
		$data['page_view']  = "master/hpp";		
		$data['js_asset']   = "hpp";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();						
		$this->load->view('layouts/master', $data);
	}

	public function generate_id(){
		$id = $this->pm->generate_id();
		echo json_encode(array('id' => $id));
	}

	public function populate_product_select($id=-1){
		$result = $this->pdm->populate_product_select($id);
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

	public function populate_project_details($id){
		$result = $this->pdm->populate_project_details($id);
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

	public function view_data(){
		$result = $this->pm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$row['id'] = $value->id;
			$row['code'] = $value->code;
			$row['name'] = $value->name;
			$row['description'] = $value->description;
			$row['customer'] = $value->customer;
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
			'name' => $this->normalize_text($this->input->post('name')),
			'description' => $this->normalize_text($this->input->post('description')),
			'customers_id' =>$this->input->post('customers_id')
		);
		$inserted = $this->pm->add_id($data);
		echo json_encode(array('id' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->pm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name')),
			'product_categories_id' => $this->input->post('product_categories_id')
		);
		$status = $this->pm->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
	}

	function delete($id){        
		$status = $this->pm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

	function jsgrid_functions($id = -1){
		switch($_SERVER["REQUEST_METHOD"]) {
			case "GET":
			$result = $this->get_project_material($id);
			$data = array();
			$count = 0;
			foreach($result as $value){
				$row = array();
				$row['id'] = $value->id;
				$row['material'] = $value->material;
				$row['qty'] = $value->qty;
				$row['unit_price'] = $this->get_avg_price($value->id);
				$data[] = $row;
				$count++;
			}

			$result = $data;
			echo json_encode($result);
			break;

			case "POST":
			$data = array(
				'qty' => $this->input->post('qty'),
				'unit_price' =>$this->input->post('unit_price'),
				'total_price' => $this->input->post('total_price'),
				'products_id' => $this->input->post('products_id'),
				'projects_id' => $id
			);
			$insert = $this->pdm->add($data);

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
			$result = $this->pdm->update('id',$this->input->input_stream('id'),$data);
			break;

			case "DELETE":
			$this->input->raw_input_stream;
			$status = $this->pdm->delete('id', $this->input->input_stream('id'));
			break;
		}
	}

	public function get_project_material($id){
		$this->db->select('mud.materials_id as id, m.name as material, mud.qty as qty');
		$this->db->where('projects_id', $id);
		$this->db->where('pd.id = wo.project_details_id');
		$this->db->where('wo.id = prd.work_orders_id');
		$this->db->where('prd.id = mu.production_details_id');
		$this->db->where('mu.id = mud.material_usage_id');
		$this->db->where('mu.id = mud.material_usage_id');
		$this->db->where('mud.materials_id = m.id');
		$result = $this->db->get('project_details pd, work_orders wo, production_details prd, material_usage mu, material_usage_details mud, materials m');
		return $result->result();

	}

	function get_avg_price($id){
		$this->db->select('AVG(unit_price) as average');
		$this->db->where('materials_id', $id);
		$this->db->group_by('materials_id');
		$row = $this->db->get('purchase_details')->row();
		return $row->average;
	}


}
