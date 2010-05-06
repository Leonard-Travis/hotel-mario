<?php
class Plans_model extends Model {

   	function Plans_model(){
		parent :: Model();
   	}
	
	function all()
	{
		$this->db->where('status', 'active');
		$query =  $this->db->get('_admin_plans');
		return $query->result_array();
	}

	function find($plan_id)
	{
		$this->db->where('plan_id', $plan_id);
		$query =  $this->db->get('_admin_plans');
		return $query->result_array();
	}
	
	function update_info($info)
	{
		$data = array(
               'plan_id' => $info['plan_id'] ,
               'name' => $info['name']);

		$this->db->where('plan_id', $info['plan_id']);
		$this->db->update('_admin_plans', $data);  
	}
	
	function delete($plan_id)
	{
		$data = array('status' => 'inactive' );
		$this->db->where('PLANS_id', $plan_id);
		$this->db->update('_admin_hotels_plans', $data);
		
		$data2 = array('status' => 'inactive' );
		$this->db->where('plan_id', $plan_id);
		$this->db->update('_admin_plans', $data2);
	}
	
	function add_new($new)
	{
		$data = array(
               'plan_id' => "" ,
               'name' => $new['name'],
			   'status' => 'active');

		$this->db->insert('_admin_plans', $data); 
	}
	
	function find_plan_inactive($plan_name){
		$this->db->where('name', $plan_name);
		$this->db->where('status', 'inactive');
		$query =  $this->db->get('_admin_plans');
		return $query->result_array();
	}
	
	function active_plan ($plan_id){
		$data = array('status' => 'active' );
		$this->db->where('plan_id', $plan_id);
		$this->db->update('_admin_plans', $data);
	}
	
	
//-------------------------------sin usar------------------------	
	function plan_in_quote($plan_id)
	{
		//search if the plan specified is in a quotation
		
		$this->db->where('PLAN_id', $plan_id);
		$query =  $this->db->get('_admin_quotations_hotels');
		return $query->result_array();
	}
//------------------------------------------------------------
}