<?php
class Seller_model extends Model {

   	function Seller_model(){
		parent :: Model();
   	}
	
	function all_sellers(){
		$this->db->where("status", "active");
		$this->db->order_by("type", "asc");
		$query =  $this->db->get('_admin_employees');
		return $query->result_array();
	}
	
	function find($employees, $field){
		$this->db->where($field, $employees);
		$query =  $this->db->get('_admin_employees');
		return $query->result_array();
	}
	
	function login($password, $id){
		$this->db->where('password',$password);
		$this->db->where('nick_name',$id);
		$query =  $this->db->get('_admin_employees');
		return $query->result_array();
	}
	
	function add($new){
		$this->db->insert('_admin_employees', $new); 
	}
	
	function update_status($employees_id, $status){
		$data = array('status' => $status );
		$this->db->where('employees_id', $employees_id);
		$this->db->update('_admin_employees', $data);
	}
	
	function update($info){
		$this->db->where('employees_id', $info['employees_id']);
		$this->db->update('_admin_employees', $info);
	}
}
?>