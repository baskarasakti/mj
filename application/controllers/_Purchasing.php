<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasing extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('purchase_model', 'prc');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('code', '', 'Kode');
        $table->addColumn('delivery_date', '', 'Date');        
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Purchase List";
		$data['page_title'] = "Purcchasing";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Purchase List");
		$data['page_view']  = "master/purchasing";		
		$data['js_asset']   = "purchasing";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->prc->get_output_data();
        $data = array();
        $count = 0;
        foreach($result['data'] as $value){
            $row = array();
            $row['code'] = $value->code;
			$row['delivery_date'] = $value->delivery_date;
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
			'code' => $this->normalize_text($this->input->post('code')),
			'delivery_date' => $this->normalize_text($this->input->post('date'))
		);
		$inserted = $this->prc->add($data);
		echo json_encode(array('status' => $inserted));
	}

	function get_by_id($id){
		$detail = $this->prc->get_by_id('id', $id);
		echo json_encode($detail);
	}

	function update(){
		$data = array(
			'code' => $this->normalize_text($this->input->post('code')),
			'delivery_date' => $this->normalize_text($this->input->post('date'))
		);
		$status = $this->prc->update('id', $this->input->post('change_id'), $data);
		echo json_encode(array('status' => $status));
   }

	function delete($id){        
		$status = $this->prc->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

}
