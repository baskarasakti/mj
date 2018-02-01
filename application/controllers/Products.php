<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('products_model', 'pm');
			$this->load->model('product_cat_model', 'pcm');
			$this->load->model('processes_model', 'psm');
			$this->load->model('materials_model', 'mm');
	}
	
	private function get_column_attr(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('name', '', 'Name');        
        $table->addColumn('category', '', 'Category');        
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
    }
	
	public function index()
	{
		$data['title'] = "ERP | Products";
		$data['page_title'] = "Products";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Products");
		$data['page_view']  = "master/products";		
		$data['js_asset']   = "products";	
		$data['columns']    = $this->get_column_attr();	
		$data['csrf'] = $this->csrf;						
		$data['p_categories'] = $this->pcm->get_all_data();							
		$this->load->view('layouts/master', $data);
	}

	public function detail_index($id){
		$data['title'] = "ERP | Product Detail";
		$data['page_title'] = "Product Detail";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Master", "Products", "Product Detail");
		$data['page_view']  = "master/product_detail";		
		$data['js_asset']   = "product_detail";	
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
			$row['name'] = $value->name;
			$row['category'] = $value->category;
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
		$inserted = $this->pm->add($data);
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

}
