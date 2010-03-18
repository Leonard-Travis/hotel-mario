<?php
class Price_matrix extends Model {

   	function Price_matrix(){
		parent :: Model();
   	}
	
	function get_seasons($date_ini, $date_end){
		$date_end = "'".$date_end."'";
		$date_ini = "'".$date_ini."'";
		$this->db->select('* FROM _admin_season 
						   WHERE date_start BETWEEN '.$date_ini.' AND '.$date_end.'
						   OR date_end BETWEEN '.$date_ini.' AND '.$date_end);		
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function get_prices ($hotel_id, $season_id, $plan_id){		
		 $this->db->select('p.*, r.name 
							FROM _admin_price p, _admin_rooms_hotels h, _admin_rooms r
							WHERE p.ROOMS_HOTELS_id = h.rooms_hotels_id
							AND h.HOTELS_hotel_id ='.$hotel_id.'
							AND p.PLAN_id ='.$plan_id.'
							AND p.SEASON_id ='.$season_id.'
							AND h.ROOMS_room_id = r.room_id');		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_prices_without_plan ($hotel_id, $season_id){		
		 $this->db->select('p.*, r.name 
							FROM _admin_price p, _admin_rooms_hotels h, _admin_rooms r
							WHERE p.ROOMS_HOTELS_id = h.rooms_hotels_id
							AND h.HOTELS_hotel_id ='.$hotel_id.'
							AND p.SEASON_id ='.$season_id.'
							AND h.ROOMS_room_id = r.room_id');		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function weekdays ($season_id){
		$this->db->select('w.* 
						   FROM _admin_season s, _admin_weekdays w
						   WHERE s.season_id = w.SEASON_id
						   AND s.season_id ='.$season_id);	
 		$query = $this->db->get();
		return $query->result_array();
	}
	
}
?>