<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup_material extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('products_model', 'pm');
			$this->load->model('product_cat_model', 'pcm');
			$this->load->model('processes_model', 'psm');
			$this->load->model('materials_model', 'mm');
			$this->load->model('productions_det_model', 'ppd');
			$this->load->model('material_usage_model', 'mu');
			$this->load->model('material_usage_det_model', 'mud');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('production_date', '', 'Date');       
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Pickup Materials";
		$data['page_title'] = "Pickup Materials";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Pickup Materials");
		$data['page_view']  = "master/pickup";		
		$data['js_asset']   = "pickup";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$data['p_categories'] = $this->pcm->get_all_data();							
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->pm->get_output_data();
        $data = array();
        $count = 0;
        foreach($result['data'] as $value){
            $row = array();
            $row['id'] = $value->id;
			$row['date'] = $value->production_date;
			$row['actions'] = '<button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa  fa-info-circle"></i></button>';
            $data[] = $row;
            $count++;
        }

        $result['data'] = $data;

        echo json_encode($result);
	}

	function add(){
		$data = array(
			'date' => $this->normalize_text($this->input->post('date')),
			'production_details_id' => $this->input->post('id'),
			'created_at' => date("Y-m-d H:m:s")
		);
		$inserted = $this->mu->add($data);
		echo json_encode(array('status' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->pm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name')),
			'product_categories_id' => $this->input->post('product_categories_id'),
			'updated_at' => date("Y-m-d H:m:s")
		);
		$status = $this->pm->update('id', $this->input->post('change_id'), $data);
		echo json_encode(array('status' => $status));
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
			$result = $this->mud->add($data);
			break;

			case "PUT":
			$data = array(
				'materials_id' => $this->normalize_text($this->input->post('name')),
				'qty' => $this->normalize_text($this->input->post('qty')),
				'note' => $this->normalize_text($this->input->post('note'))
			);
			$result = $this->mud->update('id',$this->input->post('id'),$data);
			break;

			case "DELETE":
			$status = $this->mud->delete('id', $this->input->post('id'));
			break;
		}
	}

}
