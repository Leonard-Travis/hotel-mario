<?php
class Rooms_model extends Model {

   	function Rooms_model(){
		parent :: Model();
   	}
	
	function all_types()
	{
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
               'name' => $info['name'] ,
               'special' => $info['special'],
			   'capacity' => $info['capacity']);

		$this->db->where('room_id', $info['room_id']);
		$this->db->update('_admin_rooms', $data);  
	}
	
	function delete($id)
	{
		$this->db->where('ROOMS_id', $id);
		$this->db->delete('_admin_rooms_hotels');
		
		$this->db->where('room_id', $id);
		$this->db->delete('_admin_rooms'); 
	}
	
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
	
	
	function add_new($new)
	{
		$data = array(
               'room_id' => "" ,
               'name' => $new['name'] ,
			   'capacity' => $new['capacity'] ,
			   'special' => $new['special'] 
            );

		$this->db->insert('_admin_rooms', $data); 
	}
}
?>