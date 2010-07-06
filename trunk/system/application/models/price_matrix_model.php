<?php
class Price_matrix_model extends Model {

   	function Price_matrix_model(){
		parent :: Model();
   	}
	
	function get_seasons($date_ini, $date_end){
		$date_end = "'".$date_end."'";
		$date_ini = "'".$date_ini."'";
		$this->db->select('* FROM _admin_season 
						   WHERE date_start BETWEEN '.$date_ini.' AND '.$date_end.'
						   OR date_end BETWEEN '.$date_ini.' AND '.$date_end.'
						   OR '.$date_ini.' BETWEEN date_start AND date_end
						   OR '.$date_end.' BETWEEN date_start AND date_end');		
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function get_prices ($hotel_id, $season_id, $plan_id){		
		 $this->db->select('p.*, r.*
							FROM _admin_price p, _admin_rooms_hotels h, _admin_rooms r
							WHERE p.ROOMS_HOTELS_id = h.rooms_hotels_id
							AND h.HOTELS_id ='.$hotel_id.'
							AND p.PLAN_id ='.$plan_id.'
							AND p.SEASON_id ='.$season_id.'
							AND h.ROOMS_id = r.room_id');		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_prices_without_plan ($hotel_id, $season_id){		
		 $this->db->select('p.*, r.* 
							FROM _admin_price p, _admin_rooms_hotels h, _admin_rooms r
							WHERE p.ROOMS_HOTELS_id = h.rooms_hotels_id
							AND h.HOTELS_id ='.$hotel_id.'
							AND p.SEASON_id ='.$season_id.'
							AND h.ROOMS_id = r.room_id');		
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
	
	function all_matrices ($hotel_id){
		$this->db->select(' p.price_per_night, p.price_id, p.SEASON_id, pl.name_spanish AS plan_name, s.date_start, s.date_end, r.name_spanish AS room_name
							FROM _admin_price p, _admin_plans pl, _admin_season s, _admin_rooms_hotels rh, _admin_rooms r
							WHERE rh.HOTELS_id ='.$hotel_id.'
							AND rh.ROOMS_id = r.room_id
							AND rh.rooms_hotels_id = p.ROOMS_HOTELS_id
							AND p.SEASON_id = s.season_id
							AND P.PLAN_id = pl.plan_id
							ORDER BY  `pl`.`name_spanish` ASC ');	
 		$query = $this->db->get();
		return $query->result_array();
	}
	
	function delete_matrix($prices_id)
	{
		foreach ($prices_id as $price_id){
			$this->db->where('price_id',$price_id);
			$this->db->delete('_admin_price');
		}
	}
}
?>