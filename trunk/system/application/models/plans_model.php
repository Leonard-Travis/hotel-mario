<?php
class Plans_model extends Model {

   	function Plans_model(){
		parent :: Model();
   	}
	
	function all()
	{
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
	
	function delete($id)
	{
		$this->db->where('PLANS_id', $id);
		$this->db->delete('_admin_hotels_plans');
		
		$this->db->where('plan_id', $id);
		$this->db->delete('_admin_plans'); 
	}
	
	function add_new($new)
	{
		$data = array(
               'plan_id' => "" ,
               'name' => $new['name']);

		$this->db->insert('_admin_plans', $data); 
	}
	
	function plan_in_quote($plan_id)
	{
		//search if the plan specified is in a quotation
		
		$this->db->where('PLAN_id', $plan_id);
		$query =  $this->db->get('_admin_quotations_hotels');
		return $query->result_array();
	}
}