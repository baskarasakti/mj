<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

	function  __construct() {
		parent::__construct();
			//$this->load->model('Login', 'login');
		$this->load->model('purchase_model', 'prc');
		$this->load->model('receive_model', 'rcv');
		$this->load->model('receive_det_model', 'rcvd');
		$this->load->model('materials_model', 'mm');
		$this->load->model('vendors_model', 'vm');
		$this->load->model('customers_model', 'cm');
		$this->load->model('shipping_model', 'sm');
		$this->load->model('shipping_details_model', 'sdm');
		$this->load->model('projects_model', 'prm');
		$this->load->model('work_orders_model', 'wom');		
		$this->load->model('project_details_model', 'pdm');
		$this->load->model('product_movement_det_model', 'pmdm');
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

	public function print_sales_order($id)
	{
		$data['so'] = $this->prm->get_by_id('id', $id);
		$data['so_detail'] = $this->pdm->get_project_details($id);

		$customer_id = $data['so']->customers_id;
		$data['customer'] = $this->cm->get_by_id('id', $customer_id);

		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice_sales";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();							
		$this->load->view('layouts/master', $data);
	}

	public function print_purchasing($id)
	{
		$data['purchasing'] = $this->prc->get_by_id('id', $id);
		$data['receive_det'] = $this->rcvd->get_receive_det_where_id($id);

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

	public function print_receiving($id)
	{
		$data['receiving'] = $this->rcv->get_receiving($id);
		$data['receive_det'] = $this->rcvd->get_receive_det_where_id1($id);

		$vendor_id = $data['receiving']->vendors_id;
		$data['vendor'] = $this->vm->get_by_id('id', $vendor_id);

		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice_receiving";		
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

	public function print_wo($id)
	{
		$data['work_orders'] = $this->wom->get_by_id('id',$id);
		$data['project_details'] = $this->pdm->get_project_details($data['work_orders']->projects_id);
		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice_wo";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();							
		$this->load->view('layouts/master', $data);
	}

	public function print_production($date, $prid)
	{
		$data['product_movement_detail'] = $this->pmdm->get_product_movement_detail_print($date, $prid);
		if ($prid == 0) {
			$data['process'] = "JADI";
		} else {
			$data['process'] = "SETENGAH JADI";
		}
		$data['date'] = $date;

		$data['title'] = "ERP | Invoice";
		$data['page_title'] = "Invoice";
		$data['breadcumb']  = array("Invoice");
		$data['page_view']  = "invoice/invoice_production";		
		$data['js_asset']   = "invoice";	
		$data['csrf'] = $this->csrf;	
		$data['menu'] = $this->get_menu();							
		$this->load->view('layouts/master', $data);
	}
}
