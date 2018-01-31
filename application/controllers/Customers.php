<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('customers_model', 'cm');
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
		$data['title'] = "ERP | Customers";
		$data['page_title'] = "Customers";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Customers");
		$data['page_view']  = "master/customers";		
		$data['js_asset']   = "customers";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->cm->get_output_data();
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
		$inserted = $this->cm->add($data);
		echo json_encode(array('status' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->cm->get_by_id('id', $id);
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
		$status = $this->cm->update('id', $this->input->post('change_id'), $data);
		echo json_encode(array('status' => $status));
   }

	function delete($id){        
		$status = $this->cm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

}
