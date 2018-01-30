<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('material_cat_model', 'mcm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id_kategori_item', '', 'ID');
        $table->addColumn('nama_kategori', '', 'Kategori');        
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Materials";
		$data['page_title'] = "Materials";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Materials");
		$data['page_view']  = "master/materials";		
		$data['js_asset']   = "materials";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$this->load->view('layouts/master', $data);
	}

	public function view_data(){
		$result = $this->mcm->get_output_data();
        $data = array();
        $count = 0;
        foreach($result['data'] as $value){
            $row = array();
            $row['id_kategori_item'] = $value->id_kategori_item;
            $row['nama_kategori'] = $value->nama_kategori;
            $data[] = $row;
            $count++;
        }

        $result['data'] = $data;

        echo json_encode($result);
	}

	function add(){
		$data = array(
			'nama_kategori' => $this->normalize_text($this->input->post('category'))
		);
		$inserted = $this->mcm->add($data);
		echo json_encode(array('status' => $inserted));
	}

}
