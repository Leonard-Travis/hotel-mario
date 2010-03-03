<?php
class Hotels extends Model {

   	function Hotels(){
		parent :: Model();
   	}
	
	function all_hotels()
	{
		$query =  $this->db->get('_admin_hotels');
		return $query->result_array();
	}

	function find($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$query =  $this->db->get('_admin_hotels');
		return $query->result_array();
	}
	
	function update_info($info)
	{
		$data = array(
               'hotel_id' => $info['hotel_id'] ,
               'name' => $info['name'] ,
               'location' => $info['location'] );

		$this->db->where('hotel_id', $info['hotel_id']);
		$this->db->update('_admin_hotels', $data);  
	}
	
	function all_rooms($hotel_id)
	{
		/*$this->db->select('_admin_rooms.room_id, _admin_rooms.name');
		$this->db->where('_admin_rooms.room_id','_admin_rooms_hotels.ROOMS_room_id');
		$this->db->where('HOTELS_hotel_id', $hotel_id);
		$this->db->from('_admin_rooms_hotels');
		$this->db->from('_admin_rooms');*/
		
		$this->db->select('room_id, name, description, capacity, commissionable 
						   FROM _admin_rooms_hotels , _admin_rooms 
						   WHERE room_id = ROOMS_room_id 
						   AND HOTELS_hotel_id ='.$hotel_id);		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function all_plans($hotel_id)
	{
		$this->db->select('p.plan_id, p.name, p.description 
						   FROM _admin_plans p, _admin_hotels_plans hp
						   WHERE hp.PLANS_plan_id = p.plan_id
						   AND hp.HOTELS_hotel_id ='.$hotel_id);		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function delete_room_from_hotel($hotel_id, $room_id)
	{
		$this->db->where('HOTELS_hotel_id', $hotel_id);
		$this->db->where('ROOMS_room_id', $room_id);
		$this->db->delete('_admin_rooms_hotels'); 
	}
	
	function delete_plan_from_hotel($hotel_id, $plan_id)
	{
		$this->db->where('HOTELS_hotel_id', $hotel_id);
		$this->db->where('PLANS_plan_id', $plan_id);
		$this->db->delete('_admin_hotels_plans'); 
	}
	
	function associate_room($new)
	{
		$data = array(
               'rooms_hotels_id' => "" ,
               'ROOMS_room_id' => $new['room_id'] ,
               'HOTELS_hotel_id' => $new['hotel_id'],
			   'commissionable' => $new['commissionable']);

		$this->db->insert('_admin_rooms_hotels', $data); 
	}
	
	function associate_plan($new)
	{
		$data = array(
               'HOTELS_hotel_id' => $new['hotel_id'] ,
               'PLANS_plan_id' => $new['plan_id'] );

		$this->db->insert('_admin_hotels_plans', $data); 
	}
}
?>