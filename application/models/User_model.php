<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
	}

	public function get_user_all() {
		return $this->db->get('user')->result();
	}

	public function get_user_count() {
		
		$this->db->from('user');
		$count = $this->db->count_all_results();
		return $count;
		
	}
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($nama, $username, $email, $password, $role) {
		
		$data = array(
			'nama_user'   			=> $nama,
			'username_user'   		=> $username,
			'email_user'      		=> $email,
			'role_user'      		=> $role,
			'password_user'   		=> $this->hash_password($password),
			'created_at' 			=> date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('user', $data);
		
	}

	public function update_user_np($id, $nama, $username, $email, $role) {
		
		$data = array(
			'nama_user'   			=> $nama,
			'username_user'   		=> $username,
			'email_user'      		=> $email,
			'role_user'      		=> $role,
			'updated_at'			=> date('Y-m-j H:i:s'),
		);
		
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		return $username;
		
	}

	public function update_user($id, $nama, $username, $email, $password, $role) {
		
		$data = array(
			'nama_user'   			=> $nama,
			'username_user'   		=> $username,
			'email_user'      		=> $email,
			'role_user'      		=> $role,
			'password_user'   		=> $this->hash_password($password),
			'updated_at'			=> date('Y-m-j H:i:s'),
		);
		
		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		return $username;
		
	}
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		
		$this->db->select('password_user');
		$this->db->from('user');
		$this->db->where('username_user', $username);
		$hash = $this->db->get()->row('password_user');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @return int the adm id
	 */
	public function get_user_id_from_username($username) {
		
		$this->db->select('id_user');
		$this->db->from('user');
		$this->db->where('username_user', $username);
		return $this->db->get()->row('id_user');
		
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the adm object
	 */
	public function get_user($id) {
		
		$this->db->from('user');
		$this->db->where('id_user', $id);
		return $this->db->get()->row();
		
	}

	public function delete_user($user_id) {
		
		$this->db->where('id_user', $user_id);
		$this->db->delete('user');
		return $user_id;
		
	}

	public function get_user_by_username($username) {
		
		$this->db->from('user');
		$this->db->where('username_user', $username);
		return $this->db->get()->row();
		
	}
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}
	
}