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
			$this->load->model('material_return_model', 'mr');
			$this->load->model('material_return_det_model', 'mrd');
			$this->load->model('material_inventory_model', 'mi');
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
		$data['page_view']  = "production/return";		
		$data['js_asset']   = "return";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;
		$data['menu'] = $this->get_menu();	
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
				'material_return_id' => $id
			);
			$insert = $this->mrd->add($data);

			$data2 = array(
				'date' => $this->mysql_time_now(),
				'type' => 'in',
				'material_usage_details_id' => $insert,
				'qty' => $this->normalize_text($this->input->post('qty')),
				'materials_id' => $this->normalize_text($this->input->post('name'))
			);

			$this->mi->add_id($data2);

			$row = array();
			$row['id'] = $insert;
			$row['name'] = $this->input->post('name');
			$row['qty'] = $this->input->post('qty');
			$row['note'] = $this->input->post('note');

			echo json_encode($row);
			break;

			case "PUT":
			$data = array(
				'materials_id' => $this->normalize_text($this->input->post('name')),
				'qty' => $this->normalize_text($this->input->post('qty')),
				'note' => $this->normalize_text($this->input->post('note'))
			);
			$result = $this->mrd->update('id',$this->input->post('id'),$data);
			break;

			case "DELETE":
			$status = $this->mrd->delete('id', $this->input->post('id'));
			break;
		}
	}


}
