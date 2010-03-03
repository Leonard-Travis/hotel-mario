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
		$this->db->where('room_id', $id);
		$this->db->delete('_admin_rooms'); 
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