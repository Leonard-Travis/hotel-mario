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
	
	function delete($ci)
	{
		$this->db->where('customer_ci_id', $ci);
		$this->db->delete('_admin_customers'); 
	}
	
	function add_new($new)
	{
		$data = array(
               'customer_ci_id' => $new['ci_client'] ,
               'name' => $new['name'] ,
               'lastname' => $new['lastname'],
			   'phone' => $new['phone'] ,
			   'email' => $new['email'] ,
			   'address' => $new['address'] ,
			   'sex' => $new['sex'] ,
			   'birth_date' => $new['birthdate']
            );

		$this->db->insert('_admin_customers', $data); 
	}
	
	function update_info($info)
	{
		$data = array(
               'customer_ci_id' => $info['ci_client'] ,
               'name' => $info['name'] ,
               'lastname' => $info['lastname'],
			   'phone' => $info['phone'] ,
			   'email' => $info['email'] ,
			   'address' => $info['address'] ,
			   'sex' => $info['sex'] ,
			   'birth_date' => $info['birth_date']
            );

		$this->db->where('customer_ci_id', $info['ci_client']);
		$this->db->update('_admin_customers', $data);  
	}
	
	function existing_quotation($customer_id){
		$this->db->where('CUSTOMERS_ci_id',$customer_id);
		$query =  $this->db->get('_admin_quotations');
		return $query->result_array();
	}
	
	function login($type, $password){
		$this->db->where('type',$type);
		$this->db->where('password',$password);
		$query =  $this->db->get('_admin_employees');
		return $query->result_array();
	}
}
?>