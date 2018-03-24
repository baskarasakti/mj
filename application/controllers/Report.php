<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	function  __construct() {
		parent::__construct();
			$this->load->helper('tablefield');
			$this->load->model('sales_report_model', 'srm');
	}

    function _remap($param) {
		$temp = explode("_", $param);
		if(method_exists($this, $param)){
			return call_user_func_array(array($this, $param), array());
		}else{
			$this->index($param);
		}
    }

    function index($param){
        if($param == "purchase"){
			$this->get_purchase_report_view();
		}else if($param == "receiving"){
			$this->get_receiving_report_view();
		}else if($param == "purchase_return"){
			$this->get_preturn_report_view();
		}else if($param == "sales"){
			$this->get_sales_report_view();
		}else if($param == "shipping"){
			$this->get_shipping_report_view();
		}else if($param == "sales_return"){
			$this->get_sreturn_report_view();
		}
	}
	
	/* Generate Purchase Report View */

	private function get_purchase_report_column(){
        $table = new TableField();
        $table->addColumn('id', '', 'ID');
        $table->addColumn('code', '', 'Code');
        $table->addColumn('name', '', 'Name');        
        $table->addColumn('actions', '', 'Actions');        
        return $table->getColumns();
	}
	
	public function get_purchase_report_view()
	{
		$data['title'] = "ERP | Purchase Report";
		$data['page_title'] = "Purchase Report";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Report", "Purchase Report");
		$data['page_view']  = "report/purchase_report";		
		$data['js_asset']   = "purchase_report";	
		$data['columns']    = $this->get_purchase_report_column();	
		$data['csrf'] = $this->csrf;		
		$data['menu'] = $this->get_menu();			
		$this->add_history($data['page_title']);						
		$this->load->view('layouts/master', $data);
	}

	/* Generate Sales Report View */

	private function get_sales_report_column(){
		$table = new TableField();
		$table->addColumn('id', '', 'ID');
		$table->addColumn('date', '', 'Date');
		$table->addColumn('code', '', 'Code');        
		$table->addColumn('vat', '', 'VAT');        
		$table->addColumn('description', '', 'Note');        
		$table->addColumn('customer', '', 'Customer');        
		return $table->getColumns();
	}
	
	public function get_sales_report_view()
	{
		$data['title'] = "ERP | Sales Report";
		$data['page_title'] = "Sales Report";
		$data['table_title'] = "List Item";		
		$data['breadcumb']  = array("Report", "Sales Report");
		$data['page_view']  = "report/sales_report";		
		$data['js_asset']   = "sales_report";	
		$data['columns']    = $this->get_sales_report_column();	
		$data['csrf'] = $this->csrf;		
		$data['menu'] = $this->get_menu();			
		$this->add_history($data['page_title']);						
		$this->load->view('layouts/master', $data);
	}

	public function view_sales_report(){
		$result = $this->srm->get_output_data();
		$data = array();
		$count = 0;
		foreach($result['data'] as $value){
			$row = array();
			$count++;
			$row['id'] = $count;
			$row['date'] = $this->toFormat($value->date, "Y-m-d");
			$row['code'] = $value->code;
			$vat = "PPn";
			if($value->vat == 0){
				$vat = "Non PPn";
			}
			$row['vat'] = $vat;
			$row['description'] = $value->description;
			$row['customer'] = $value->customer;
			$data[] = $row;
		}

		$result['data'] = $data;
		echo json_encode($result);
	}

}
