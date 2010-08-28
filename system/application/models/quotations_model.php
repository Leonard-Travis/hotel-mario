<?php
class Quotations_model extends Model {

   	function Quotations_model(){
		parent :: Model();
   	}

	function get_prices ($hotel_id, $season_id, $plan_id){		 
		 $this->db->select('p.price_per_night, r.name_spanish, s.date_start, s.date_end, rh.capacity, rh.rooms_hotels_id, h.capacity');
		 $this->db->from('_admin_price p, _admin_rooms_hotels h, _admin_rooms r, _admin_season s, _admin_rooms_hotels rh');
		 $this->db->where("p.ROOMS_HOTELS_id = h.rooms_hotels_id
							AND h.HOTELS_id ='".$hotel_id."'
							AND p.PLAN_id ='".$plan_id."'
							AND p.SEASON_id ='".$season_id."'
							AND h.ROOMS_id = r.room_id
							AND s.season_id = p.SEASON_id
							AND rh.rooms_hotels_id = p.ROOMS_HOTELS_id
							AND h.status = 'active' ");
		 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_prices_with_room ($room_hotel_id, $season_id, $plan_id){
		$this->db->select ('p.price_per_night, s.date_start, s.date_end');
		$this->db->from ('_admin_price p, _admin_season s');
		$this->db->where ("p.ROOMS_HOTELS_id =".$room_hotel_id."
						   AND p.PLAN_id =".$plan_id."
						   AND p.SEASON_id =".$season_id."
						   AND s.season_id = p.SEASON_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function find_room_hotel_name ($rooms_hotels_id){
		$this->db->select ('r.name_spanish');
		$this->db->from ('_admin_rooms_hotels rh, _admin_rooms r');
		$this->db->where('rh.rooms_hotels_id ='.$rooms_hotels_id.' AND rh.ROOMS_id = r.room_id');
		$query =  $this->db->get();
		return $query->result_array();
	}
	
	function insert_quote($new_quote){
		$quote_hotel_id = 0;
		$data = array(
               'quote_hotel_id' => '' ,
			   'date_check_in' => $new_quote['date_start'],
			   'date_check_out' => $new_quote['date_end'],
			   'PLAN_id' => $new_quote['plan_id'],
			   'total' => $new_quote['subtotal'],
			   'reservation_status' => 'x',
			   'collect_status' => 'x',
			   'payment_status' => 'x',
			   'billing_status' => 'x');

		$this->db->insert('_admin_quotations_hotels', $data);
		
		$this->db->select_max('quote_hotel_id');
		$query = $this->db->get('_admin_quotations_hotels');
		
		foreach ($query->result_array() as $value)
			foreach ($value as $value)
				$quote_hotel_id = $value;
		
		foreach ($new_quote['quote_rooms'] as $quote_room){
			$data = array(
					'QUOTATIONS_HOTELS_id' => $quote_hotel_id,
					'ROOMS_HOTELS_id' => $quote_room['rooms_hotels_id'],
					'quantity_of_rooms' => $quote_room['quantity'],
					'subtotal' => $quote_room['subtotal'],
					'unit_price' => $quote_room['PU']);
			$this->db->insert('_admin_rooms_per_quote', $data);
		}
	}
}
?>