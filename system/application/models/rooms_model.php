<?php
class Rooms_model extends Model {

   	function Rooms_model(){
		parent :: Model();
   	}
	
	function all_types()
	{
		$this->db->where('status', 'active');
		$query =  $this->db->get('_admin_rooms');
		return $query->result_array();
	}

	function find($room_id)
	{
		$this->db->where('room_id', $room_id);
		$query =  $this->db->get('_admin_rooms');
		return $query->result_array();
	}
	
	function update_info($info)
	{
		$data = array(
               'room_id' => $info['room_id'] ,
               'name_spanish' => $info['name_spanish'] ,
               'special' => $info['special'],
			   'name_english' => $info['name_english']);

		$this->db->where('room_id', $info['room_id']);
		$this->db->update('_admin_rooms', $data);  
	}
	
	function delete($room_id)
	{
		$data = array('status' => 'inactive' );
		$this->db->where('ROOMS_id', $room_id);
		$this->db->update('_admin_rooms_hotels', $data);
		
		$data2 = array('status' => 'inactive' );
		$this->db->where('room_id', $room_id);
		$this->db->update('_admin_rooms', $data2);
	}
	
	
//-----------------------------SIN USAR---------------------------------------		
	function room_in_quote($room_id)
	{
		//search if the room specified is in a quotation
		
		$this->db->select(' rp.QUOTATIONS_HOTELS_id 
						    FROM _admin_rooms_hotels rh, _admin_rooms_per_quote rp
							WHERE rp.ROOMS_HOTELS_id = rh.rooms_hotels_id
							AND rh.ROOMS_id ='.$room_id);
		/* $this->db->from('_admin_rooms_hotels');
		$this->db->from('_admin_rooms_per_quote');
		$this->db->where('ROOMS_HOTELS_id_rooms_hotels','rooms_hotels_id');
		$this->db->where('ROOMS_room_id', $room_id); */
		$query =  $this->db->get();
		return $query->result_array();
	}
//----------------------------------------------------------------------------
	
	function add_new($new)
	{
		$data = array(
               'room_id' => "" ,
			   'name_spanish' => $new['name_spanish'],
			   'name_english' => $new['name_english'],
			   'special' => $new['special'],
			   'status' => 'active');

		$this->db->insert('_admin_rooms', $data); 
	}
	
	function find_room_inactive($name_english, $name_spanish){
		$this->db->like('name_english', $name_english);
		$this->db->like('name_spanish', $name_spanish);
		$this->db->where('status', 'inactive');
		$query =  $this->db->get('_admin_rooms');
		return $query->result_array();
	}
	
	function active_room ($room_id){
		$data = array('status' => 'active' );
		$this->db->where('room_id', $room_id);
		$this->db->update('_admin_rooms', $data);
	}
}
?>