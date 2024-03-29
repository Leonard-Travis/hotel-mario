<?php
class Hotels_model extends Model {

   	function Hotels_model(){
		parent :: Model();
   	}
	
	function all_hotels()
	{
		$this->db->select('h.hotel_id, h.hotel_name AS name, c.city_name AS location');
		$this->db->from('hotels h');
		$this->db->join('cities c', 'c.city_id = h.city_id');
		$this->db->where('preferred', '1');
		
		$query = $this->db->get();
		return $query->result_array();
	}

	function find($hotel_id)
	{
		$this->db->select('h.hotel_id, h.city_id, h.address, h.preferred, h.phone, h.hotel_name AS name, c.city_name AS location');
		$this->db->from('hotels h');
		$this->db->join('cities c', 'c.city_id = h.city_id');
		$this->db->where('hotel_id', $hotel_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function all_cities(){
		$this->db->select('city_id, city_name');
		$query = $this->db->get('cities');
		return $query->result_array();
	}
	
	function all_hotels_from_city($city_id){
		$this->db->select('hotel_id, hotel_name AS name');
		$this->db->where('city_id', $city_id);
		$query = $this->db->get('hotels');
		return $query->result_array();
	}
	
	function update_preferred($hotel_id, $preferred_status){
		$data = array('preferred' => $preferred_status);
		
		$this->db->where('hotel_id', $hotel_id);
		$this->db->update('hotels', $data);
	}
	
	function update_info($info)
	{
		$data = array(
               'hotel_id' => $info['hotel_id'] ,
               'hotel_name' => $info['name'] ,
               'city_id' => $info['location'] );

		$this->db->where('hotel_id', $info['hotel_id']);
		$this->db->update('hotels', $data);  
	}
	
	function all_rooms($hotel_id)
	{
		//it search for all the rooms related to the hotel specified
		
		$this->db->select('r.room_id, r.name_spanish, r.name_english, rh.description, rh.capacity, rh.commissionable, rh.rooms_hotels_id 
						   FROM _admin_rooms_hotels rh , _admin_rooms r 
						   WHERE r.room_id = rh.ROOMS_id 
						   AND rh.status = "active"
						   AND rh.HOTELS_id ='.$hotel_id);		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function all_plans($hotel_id)
	{
		//it search for all the planss related to the hotel specified
		
		$this->db->select('p.plan_id, p.name_spanish, p.name_english, hp.description 
						   FROM _admin_plans p, _admin_hotels_plans hp
						   WHERE hp.PLANS_id = p.plan_id
						   AND hp.status = "active"
						   AND hp.HOTELS_id ='.$hotel_id);		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function find_rooms_hotels ($hotel_id, $room_id){
		$this->db->where('HOTELS_id', $hotel_id);
		$this->db->where('ROOMS_id', $room_id);
		$query =  $this->db->get('_admin_rooms_hotels');
		return $query->result_array();
	}
	
	function delete_room_from_hotel($rooms_hotels_id)
	{
		date_default_timezone_set('UTC');
		$date = date("Y-m-d");
		
		$this->db->where('ROOMS_HOTELS_id', $rooms_hotels_id);
		$query = $this->db->get('_admin_price');
		$query = $query->result_array();
		
		foreach ($query as $query){
			$data = array(
				   'price_id' => "" ,
				   'season_id' => $query['SEASON_id'] ,
				   'rooms_hotels_id' => $query['ROOMS_HOTELS_id'] ,
				   'price_per_night' => $query['price_per_night'],
				   'plan_id' => $query['PLAN_id'],
				   'elimination_date' => $date);
			$this->db->insert('_admin_price_record', $data);
		}
		$this->db->where('ROOMS_HOTELS_id', $rooms_hotels_id);
		$this->db->delete('_admin_price');
	
	    $data = array(
	   'status' => 'inactive' );
		$this->db->where('rooms_hotels_id', $rooms_hotels_id);
		$this->db->update('_admin_rooms_hotels', $data);
		
	}

//------------------------- unused for the moment------------------------
	function room_in_quote($room_id, $hotel_id)
	{
		//search if the room specified is in a quotation
		
		$this->db->select(' rp.QUOTATIONS_HOTELS_id 
						    FROM _admin_rooms_hotels rh, _admin_rooms_per_quote rp
							WHERE rp.ROOMS_HOTELS_id = rh.rooms_hotels_id
							AND rh.ROOMS_id ='.$room_id.' AND rh.HOTELS_id ='.$hotel_id);
		$query =  $this->db->get();
		return $query->result_array();
	}
	
	function plan_in_quote($plan_id, $hotel_id)
	{
		//search if the plan specified is in a quotation
		
		$this->db->select(' qh.quote_hotel_id FROM _admin_quotations_hotels qh, _admin_rooms_per_quote pq, _admin_rooms_hotels rh
							WHERE rh.HOTELS_id ='.$hotel_id.'
							AND rh.rooms_hotels_id = pq.ROOMS_HOTELS_id
							AND pq.QUOTATIONS_HOTELS_id = qh.quote_hotel_id
							AND qh.PLAN_id ='.$plan_id);
		$query =  $this->db->get();
		return $query->result_array();
	}
//----------------------------------------------------------------------------


	function delete_plan_from_hotel($hotel_id, $plan_id)
	{
		$data = array(
	   'status' => 'inactive' );
		$this->db->where('HOTELS_id', $hotel_id);
		$this->db->where('PLANS_id', $plan_id);
		$this->db->update('_admin_hotels_plans', $data);
	}
	
	function associate_room($new)
	{
		$this->db->where('HOTELS_id	', $new['hotel_id']);
		$this->db->where('ROOMS_id	', $new['room_id']);
		$query =  $this->db->get('_admin_rooms_hotels');
		$query = $query->result_array();
		
		if (count($query) == 0){
			$data = array(
				   'rooms_hotels_id' => "" ,
				   'ROOMS_id' => $new['room_id'] ,
				   'HOTELS_id' => $new['hotel_id'],
				   'commissionable' => $new['commissionable'],
				   'description' => $new['description'],
				   'capacity' => $new['capacity'],
				   'status' => 'active');
	
			$this->db->insert('_admin_rooms_hotels', $data); 
		}
		else {
			$data = array('status' => 'active',
						  'description' => $new['description'],
						  'capacity' => $new['capacity']);

			$this->db->where('HOTELS_id	', $new['hotel_id']);
			$this->db->where('ROOMS_id	', $new['room_id']);
			$this->db->update('_admin_rooms_hotels', $data);  
		}
	}
	
	function associate_plan($new)
	{
		$this->db->where('HOTELS_id	', $new['hotel_id']);
		$this->db->where('PLANS_id	', $new['plan_id']);
		$query =  $this->db->get('_admin_hotels_plans');
		$query = $query->result_array();
		
		if (count($query) == 0){
			$data = array(
				   'HOTELS_id' => $new['hotel_id'] ,
				   'PLANS_id' => $new['plan_id'],
				   'description' => $new['description'],
				   'status' => 'active');
	
			$this->db->insert('_admin_hotels_plans', $data); 
		}
		else {
			$data = array('status' => 'active',
						  'description' => $new['description']);

			$this->db->where('HOTELS_id	', $new['hotel_id']);
			$this->db->where('PLANS_id	', $new['plan_id']);
			$this->db->update('_admin_hotels_plans', $data);  
		}
	}
	
	function all_seasons_hotel($hotel_id){
		$this->db->select(' sh.season_name, s.* 
							FROM _admin_seasons_per_hotel sh, _admin_season s
							WHERE sh.HOTEL_id = '.$hotel_id.'
							AND sh.SEASON_id = s.season_id');
		$query =  $this->db->get();
		return $query->result_array();
	}
}
?>