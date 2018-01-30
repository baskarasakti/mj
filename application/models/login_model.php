<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    function  __construct() {
		parent::__construct();
			$this->load->database();
	}

	function check_login($username, $password){	
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username_user',$username);

        $result = $this->db->get();
        if($result->num_rows() == 1){
            if(password_verify($password, $result->row(0)->password_user)){
               $data['username'] = $result->row(0)->username_user;
               $data['name'] = $result->row(0)->nama_user;
               return $data;
            }
        }else{
            return false;
        }
    }
}
