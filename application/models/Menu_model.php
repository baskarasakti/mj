<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials_model extends MY_Model {

	protected $_t = 'materials';

	protected $_menus = array(
		'Dashboard' => array(
			'link' => 'dashboard',
			'child' => array()
		),
		'Master' => array(
			'link' => '#',
			'child' => array(
				'Material Category' => array(
					'link' => 'material_categories',
				),
				'Materials' => array(
					'link' => 'materials',
				),
				'Product Category' => array(
					'link' => 'product_categories',
				),
				'Products' => array(
					'link' => 'products',
				),
				'Usage Category' => array(
					'link' => 'usage_categories',
				),
				'Processes' => array(
					'link' => 'processes',
				),
				'Customers' => array(
					'link' => 'customers',
				),
				'Vendors' => array(
					'link' => 'vendors',
				),
				'Colors' => array(
					'link' => 'colors',
				)
			)
		), 
		'Sales' => array(
			'link' => '#',
			'child' => array(
				'Sales Order' => array(
					'link' => 'projects',
				),
				'Shipping' => array(
					'link' => 'shipping',
				),
				'Return' => array(
					'link' => 'sales_return',
				)
			)
		),
		'Purchasing' => array(
			'link' => '#',
			'child' => array(
				'Purchase Order' => array(
					'link' => 'projects',
				),
				'Receiving' => array(
					'link' => 'receiving',
				),
				'Return' => array(
					'link' => 'purchase_return',
				)
			)
		),
		'Production' => array(
			'link' => '#',
			'child' => array(
				'Work Order' => array(
					'link' => 'work_orders',
				),
				'Production' => array(
					'link' => 'productions',
				),
				'Pickup Material' => array(
					'link' => 'pickup_material',
				),
				'Return Material' => array(
					'link' => 'return_material',
				),
				'Product Receiving' => array(
					'link' => 'product_receiving',
				)
			)
		),
		'Inventory' => array(
			'link' => '#',
			'child' => array(
				'Material Inventory' => array(
					'link' => 'material_inventory',
				),
				'Product Inventory' => array(
					'link' => 'product_inventory',
				)
			)
		),
		'Setting' => array(
			'link' => '#',
			'child' => array(
				'Roles' => array(
					'link' => 'roles',
				),
				'Users' => array(
					'link' => 'users',
				),
				'Previllage' => array(
					'link' => 'previllage',
				),
				'Application' => array(
					'link' => 'application',
				)
			)
		)
	);

	public function add_initial_menu(){
		foreach($menus as $key => $value){
			if(){
				
			}
		}
	}

}
