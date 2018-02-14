<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('currency_model', 'cm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('name', '', 'Name');        
        $table->addColumn('symbol', '', 'Symbol');
        $table->addColumn('rate', '', 'Rate');
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Currency";
		$data['page_title'] = "Currency";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Currency");
		$data['page_view']  = "master/currency";		
		$data['js_asset']   = "currency";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;		
		$data['menu'] = $this->get_menu();					
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
			$row['symbol'] = $value->symbol;
			$row['rate'] = $value->rate;
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
			'name' => ucfirst($this->input->post('name')),			
			'symbol' => strtoupper($this->input->post('symbol')),
			'rate' => strtoupper($this->input->post('rate')),
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
			'name' => ucfirst($this->input->post('name')),
			'symbol' => strtoupper($this->input->post('symbol')),
			'rate' => strtoupper($this->input->post('rate')),
		);
		$status = $this->cm->update('id', $this->input->post('change_id'), $data);
		echo json_encode(array('status' => $status));
   }

	function delete($id){        
		$status = $this->cm->delete('id', $id);
		echo json_encode(array('status' => $status));
	}

}