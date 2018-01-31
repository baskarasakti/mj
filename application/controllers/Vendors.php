<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('vendors_model', 'vm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
		$table->addColumn('name', '', 'Name');
        $table->addColumn('description', '', 'Description');        
        $table->addColumn('address', '', 'Address');        
        $table->addColumn('telp', '', 'Telp');        
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Vendors";
		$data['page_title'] = "Vendors";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Vendors");
		$data['page_view']  = "master/vendors";		
		$data['js_asset']   = "Vendors";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->vm->get_output_data();
        $data = array();
        $count = 0;
        foreach($result['data'] as $value){
            $row = array();
            $row['id'] = $value->id;
			$row['name'] = $value->name;
			$row['description'] = $value->description;
			$row['address'] = $value->address;
			$row['telp'] = $value->telp;
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
			'name' => $this->normalize_text($this->input->post('name')),
			'description' => $this->normalize_text($this->input->post('description')),
			'address' => $this->normalize_text($this->input->post('address')),
			'telp' => $this->input->post('telp'),
			'created_at' => date("Y-m-d H:m:s")
		);
		$inserted = $this->vm->add($data);
		echo json_encode(array('status' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->vm->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'name' => $this->normalize_text($this->input->post('name')),
			'description' => $this->normalize_text($this->input->post('description')),
			'address' => $this->normalize_text($this->input->post('address')),
			'telp' => $this->input->post('telp'),
			'updated_at' => date("Y-m-d H:m:s")
		);
		$status = $this->vm->update('id', $this->input->post('change_id'), $data);
		echo json_encode(array('status' => $status));
   }

	function delete($id){        
		$status = $this->vm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

}
