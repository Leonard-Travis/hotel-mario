<?php
class Client_model extends Model {

   	function Client_model(){
		parent :: Model();
   	}
	
	function find($ci)
	{
		$this->db->where('customer_ci_id',$ci);
		$query =  $this->db->get('_admin_customers');
		return $query->result_array();
	}
	
	function add($new)
	{
		$data = array(
               'customer_ci_id' => $new['ci_client'] ,
               'name' => $new['name'] ,
               'lastname' => $new['lastname'],
			   'phone' => $new['phone'] ,
			   'email' => $new['email'] ,
			   'address' => $new['address'] ,
			   'sex' => $new['sex'] ,
			   'birth_date' => $new['birth_date']
            );

		$this->db->insert('_admin_customers', $data); 
	}
}
?>