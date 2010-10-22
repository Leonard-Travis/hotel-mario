<?php
class Seller_model extends Model {

   	function Seller_model(){
		parent :: Model();
   	}
	
	function all_sellers(){
		$this->db->order_by("type", "asc");
		$query =  $this->db->get('_admin_employees');
		return $query->result_array();
	}
	
	function login($type, $password, $id){
		$this->db->where('type',$type);
		$this->db->where('password',$password);
		$this->db->where('employees_id',$id);
		$query =  $this->db->get('_admin_employees');
		return $query->result_array();
	}
	
	function add($new){
		$this->db->insert('_admin_employees', $new); 
	}
}
?>