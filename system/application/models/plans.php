<?php
class Plans extends Model {

   	function Plans(){
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
               'name' => $info['name'] ,
               'description' => $info['description'] );

		$this->db->where('plan_id', $info['plan_id']);
		$this->db->update('_admin_plans', $data);  
	}
	
	function delete($id)
	{
		$this->db->where('plan_id', $id);
		$this->db->delete('_admin_plans'); 
	}
	
	function add_new($new)
	{
		$data = array(
               'plan_id' => "" ,
               'name' => $new['name'] ,
               'description' => $new['description']);

		$this->db->insert('_admin_plans', $data); 
	}
}