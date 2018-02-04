<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_material extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('products_model', 'pm');
			$this->load->model('product_cat_model', 'pcm');
			$this->load->model('processes_model', 'psm');
			$this->load->model('materials_model', 'mm');
			$this->load->model('material_usage_model', 'mu');
			$this->load->model('material_usage_det_model', 'mud');
			$this->load->model('usage_cat_model', 'uc');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('usage_date', '', 'Date');      
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Return Materials";
		$data['page_title'] = "Return Materials";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Return Materials");
		$data['page_view']  = "master/return";		
		$data['js_asset']   = "return";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$data['u_categories']    = $this->uc->get_all_data();							
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->mu->get_output_data();
        $data = array();
        $count = 0;
        foreach($result['data'] as $value){
            $row = array();
            $row['id'] = $value->id;
			$row['usage_date'] = $value->usage_date;
			$row['actions'] = '<a class="btn btn-sm btn-info" href="'.site_url('products/detail_index/'.$value->id).'" type="button"><i class="fa  fa-info-circle"></i></a>
							   <button class="btn btn-sm btn-info" onclick="edit('.$value->id.')" type="button"><i class="fa fa-edit"></i></button>
							   <button class="btn btn-sm btn-danger" onclick="remove('.$value->id.')" type="button"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
            $count++;
        }

        $result['data'] = $data;

        echo json_encode($result);
	}

	function add(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name')),
			'product_categories_id' => $this->input->post('product_categories_id'),
			'created_at' => date("Y-m-d H:m:s")
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
			'name' => $this->normalize_text($this->input->post('name')),
			'product_categories_id' => $this->input->post('product_categories_id'),
			'updated_at' => date("Y-m-d H:m:s")
		);
		$status = $this->mu->update_id('id', $this->input->post('change_id'), $data);
		echo json_encode(array('id' => $status));
   }

	function delete($id){        
		$status = $this->mu->delete('id', $id);
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
