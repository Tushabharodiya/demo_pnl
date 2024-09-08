<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
	}
	
	function checkLogin($table,$data){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('user_email',$data['user_email']);
		$this->db->where('user_password',$data['user_password']);
		$query = $this->db->get();
		return $query->row();
	}

	function editData($where, $table, $editData){
		$this->db->where($where);
        $result = $this->db->update($table, $editData);
		if($result)
			return  true;
		else
			return false;
	}
}	 

	
	

