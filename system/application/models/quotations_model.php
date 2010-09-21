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
	
	function flight_citys(){
		$query =  $this->db->get('_admin_flights_city');
		return $query->result_array();
	}
	
	function airlines(){
		$query =  $this->db->get('_admin_airlines');
		return $query->result_array();
	}
	
	function enum_values($table, $enum_column){		
		$query =  $this->db->query("SHOW COLUMNS FROM ".$table." LIKE '".$enum_column."'");
		return $query->result_array();
	}
	
	function select_venezuela(){
		$this->db->select('flight_country_id');
		$this->db->where('name', 'venezuela');
		$query = $this->db->get('_admin_flights_country');
		return $query->result_array();
	}
	
	function select_country($city_id){
		$this->db->select('FLIGHTS_COUNTRY_id');
		$this->db->where('flight_city_id', $city_id);
		$query = $this->db->get('_admin_flights_city');
		return $query->result_array();
	}
	
	function find_traveler($traveler_ci_id){
		$this->db->where('traveler_ci_id', $traveler_ci_id);
		$query = $this->db->get('_admin_travelers');
		return $query->result_array();
	}
	
	function insert_flight_quote($new, $total){
		$flights = array();
		
		foreach($new as $flight){
			$flight_id = 0;
			$flight_quote_id = 0;
			$this->db->insert('_admin_flights', $flight[0]);
			
			$this->db->select_max('flight_id');
			$query = $this->db->get('_admin_flights');
			
			foreach ($query->result_array() as $value)
				foreach ($value as $value)
					$flight_id = $value;
			
			$flights[count($flights)] = $flight_id;
			
			
			for($i=1; $i<count($flight); $i++){
				$traveler = $this->find_traveler($flight[$i]['traveler_ci_id']);
				if ($traveler == NULL){
					$this->db->insert('_admin_travelers', $flight[$i]);
					$data_traveler['TRAVELERS_ci_id'] = $flight[$i]['traveler_ci_id'];
				}
				else{
					foreach($traveler as $traveler){
						$data_traveler['TRAVELERS_ci_id'] = $traveler['traveler_ci_id'];
					}
				}
				$data_traveler['FLIGHTS_id']= $flight_id;
				$this->db->insert('_admin_travelers_per_flight', $data_traveler);
				
			}
		}
		$data_quote_flight = array('quote_flight_id' => '', 'status' => 'x', 'total' => $total);
		$this->db->insert('_admin_quotations_flights', $data_quote_flight);
		
		$this->db->select_max('quote_flight_id');
			$query = $this->db->get('_admin_quotations_flights');
			
		foreach ($query->result_array() as $value)
			foreach ($value as $value)
				$flight_quote_id = $value;
				
		foreach ($flights as $flight){
			$data_flights_per_quote = array ('QUOTATIONS_FLIGHTS_id' => $flight_quote_id, 'FLIGHTS_id' => $flight);
			$this->db->insert('_admin_flights_per_quote', $data_flights_per_quote);
		}
				
		
	}
}
?>