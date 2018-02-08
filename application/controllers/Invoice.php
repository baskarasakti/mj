<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

	function  __construct() {
		parent::__construct();
			//$this->load->model('Login', 'login');
		$this->load->model('purchase_model', 'prc');
		$this->load->model('purchase_det_model', 'prd');
		$this->load->model('materials_model', 'mm');
		$this->load->model('vendors_model', 'vm');
		$this->load->model('customers_model', 'cm');
		$this->load->model('shipping_model', 'sm');
		$this->load->model('shipping_details_model', 'sdm');
		$this->load->model('projects_model', 'prm');
	}
                
	public function index()
	{
		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();							
		$this->load->view('layouts/master', $data);
	}

	public function print_purchasing($id)
	{
		$data['purchasing'] = $this->prc->get_by_id('id', $id);
		$data['purchase_det'] = $this->prd->get_purchase_det_where_id('purchasing_id', $id);

		$vendor_id = $data['purchasing']->vendors_id;
		$data['vendor'] = $this->vm->get_by_id('id', $vendor_id);

		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice_purchasing";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();							
		$this->load->view('layouts/master', $data);
	}

	public function print_shipping($id)
	{
		$data['shipping'] = $this->sm->get_shipping_by_id($id);
		$data['shipping_det'] = $this->sdm->get_shipping_details($id);

		$customer_id = $data['shipping']->customers_id;
		$data['customer'] = $this->cm->get_by_id('id', $customer_id);

		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice_shipping";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();							
		$this->load->view('layouts/master', $data);
	}
}
