<?php
class Rooms extends Model {

   	function Rooms(){
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
			   'capacity' => $info['capacity'] ,
			   'description' => $info['description'] );

		$this->db->where('room_id', $info['room_id']);
		$this->db->update('_admin_rooms', $data);  
	}
	
	function delete($id)
	{
		$this->db->where('ROOMS_room_id', $id);
		$this->db->delete('_admin_rooms_hotels');
		
		$this->db->where('room_id', $id);
		$this->db->delete('_admin_rooms'); 
	}
	
	function room_in_quote($room_id)
	{
		//search if the room specified is in a quotation
		
		$this->db->select(' QUOTATIONS_HOTELS_quote_hotel_id FROM _admin_rooms_hotels, _admin_rooms_per_quote WHERE ROOMS_HOTELS_id_rooms_hotels = rooms_hotels_id
							AND ROOMS_room_id ='.$room_id);
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
               'description' => $new['description'],
			   'capacity' => $new['capacity'] ,
			   'special' => $new['special'] 
            );

		$this->db->insert('_admin_rooms', $data); 
	}
}
?>