<?php 
class New_client_model extends Model {

   	function New_client_model(){
		parent :: Model();
   	}
	
	function index($ci)
	{
		$this->db->where('customer_ci_id',$ci);
		$query =  $this->db->get('_admin_customers');
		return $query->result_array();
	}
}

?>