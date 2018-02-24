<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Btkl_model extends MY_Model {

	protected $_t = 'btkl';

	public function get_btkl_list($id)
	{
		$this->db->where('hpp_id', $id);
		$result = $this->db->get($this->_t)->result();
		return $result;
	}

}
