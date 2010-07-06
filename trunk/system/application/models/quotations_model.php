<?php
class Quotations_model extends Model {

   	function Quotations_model(){
		parent :: Model();
   	}

	function get_prices ($hotel_id, $season_id, $plan_id){		
		 $this->db->select('p.*, r.*, s.*, rh.capacity_
			FROM _admin_price p, _admin_rooms_hotels h, _admin_rooms r, _admin_season s, _admin_rooms_hotels rh
							WHERE p.ROOMS_HOTELS_id = h.rooms_hotels_id
							AND h.HOTELS_id ='.$hotel_id.'
							AND p.PLAN_id ='.$plan_id.'
							AND p.SEASON_id ='.$season_id.'
							AND h.ROOMS_id = r.room_id
							AND s.season_id = p.SEASON_id
							AND rh.rooms_hotels_id = p.ROOMS_HOTELS_id');		
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>