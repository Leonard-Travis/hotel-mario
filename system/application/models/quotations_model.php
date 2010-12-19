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
		$this->db->select ('p.*, s.date_start, s.date_end');
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
	
	function insert_hotel_quote($new_quote){
		$quote_hotel_id = 0;
		$data = array(
               'quote_hotel_id' => '' ,
			   'date_check_in' => $new_quote['date_start'],
			   'date_check_out' => $new_quote['date_end'],
			   'PLAN_id' => $new_quote['plan_id'],
			   'total' => $new_quote['subtotal'],
			   'persons' => $new_quote['persons'],
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
		return $quote_hotel_id;
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
		return $flight_quote_id;
	}
	
	function find_city($city_id){
		$this->db->where('flight_city_id', $city_id);
		$query = $this->db->get('_admin_flights_city');
		return $query->result_array();
	}
	
	function find_airline($airline_id){
		$this->db->where('airline_id', $airline_id);
		$query = $this->db->get('_admin_airlines');
		return $query->result_array();
	}
	
	function insert_generic_quote($generic, $total){
		$generic_quote_id = 0;
		$generic_id = 0;
		
		$data_generic_quotation = array ('quotes_generic_id' => '', 'total' => $total);
		$this->db->insert('_admin_quotations_generic', $data_generic_quotation);
		
		$this->db->select_max('quotes_generic_id');
			$query = $this->db->get('_admin_quotations_generic');
			
		foreach ($query->result_array() as $value)
			foreach ($value as $value)
				$generic_quote_id = $value;
		
		foreach($generic as $new){
			if ($new[0] != ''){
				$data_generic = array('generic_id' => '',
									  'description' => $new[0],
									  'quantity' => $new[1],
									  'unit_price' => $new[2]);
				$this->db->insert('_admin_generic', $data_generic);
				
				$this->db->select_max('generic_id');
				$query = $this->db->get('_admin_generic');
				
				foreach ($query->result_array() as $value)
					foreach ($value as $value)
						$generic_id = $value;
						
				$data_generic_per_quote = array('QUOTES_GENERIC_id' => $generic_quote_id,
												'GENERIC_id' => $generic_id);
				$this->db->insert('_admin_generic_per_quote', $data_generic_per_quote);
			}
		}
		return $generic_quote_id;
	}
	
	function find_quote($id, $table, $column){
		$this->db->where($column, $id);
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	
	
	
	
	function insert_quotation($data){
		$total = 0;
		if($data['QUOTATIONS_HOTELS_id'] == 'null') $data['QUOTATIONS_HOTELS_id'] = NULL;	
		else {
		    $quote = $this->find_quote($data['QUOTATIONS_HOTELS_id'], '_admin_quotations_hotels', 'quote_hotel_id');	
			foreach($quote as $quote)
				$total += $quote['total'];
			
		}
		
		if($data['QUOTATIONS_FLIGHTS_id'] == 'null') $data['QUOTATIONS_FLIGHTS_id'] = NULL;
		else {
			$quote = $this->find_quote($data['QUOTATIONS_FLIGHTS_id'], '_admin_quotations_flights', 'quote_flight_id');	
			foreach($quote as $quote)
				$total += $quote['total'];
			
		}
		
		if($data['QUOTATIONS_GENERIC_id'] == 'null') $data['QUOTATIONS_GENERIC_id'] = NULL;
		else {
			$quote = $this->find_quote($data['QUOTATIONS_GENERIC_id'], '_admin_quotations_generic', 'quotes_generic_id');	
			foreach($quote as $quote)
				$total += $quote['total'];
			
		}
		
		if($data['QUOTATIONS_PACKAGE_id'] == 'null') $data['QUOTATIONS_PACKAGE_id'] = NULL;
		else {
			$quote = $this->find_quote($data['QUOTATIONS_PACKAGE_id'], '_admin_quotations_package', 'quote_package_id');	
			foreach($quote as $quote)
				$total += $quote['total'];
			
		}
		
		$data['total'] = $total;
		
		$this->db->insert('_admin_quotations', $data);
		
//The code below is to get the quotations id just inserted
		$quotation_id = 0;
		$this->db->select_max('quote_id');
		$query = $this->db->get('_admin_quotations');
		
		foreach ($query->result_array() as $value)
			foreach ($value as $value)
				$quotation_id = $value;
		
		return $quotation_id;
	}
	
	
	
	
	
	
	
	function quote_hotel_data($quotation){
		$hotel_data = array('hotel_name' => '', 'hotel_location' => '', 'check_in' => '', 'check_out' => '', 'plan' => '', 'persons' => '', 'total' => '', 'rooms' => array() );
		
		foreach($quotation as $quotation){
			$hotel_data['check_in'] = $quotation['date_check_in'];
			$hotel_data['check_out'] = $quotation['date_check_out'];
			$hotel_data['persons'] = $quotation['persons'];
			$hotel_data['total'] = $quotation['total'];
			
			$this->db->select ('h.hotel_name AS name, c.city_name AS location, hp.description, p.name_english, p.name_spanish');
			$this->db->from ('hotels h, _admin_rooms_hotels rh, _admin_rooms_per_quote rq, _admin_hotels_plans hp, _admin_plans p, cities c');
			$this->db->where ( "rq.QUOTATIONS_HOTELS_id =".$quotation['quote_hotel_id']."
								AND rq.ROOMS_HOTELS_id = rh.rooms_hotels_id
								AND rh.HOTELS_id = h.hotel_id
								AND h.city_id = c.city_id
								AND h.hotel_id = hp.HOTELS_id
								AND hp.PLANS_id =".$quotation['PLAN_id']."
								AND hp.PLANS_id = p.plan_id");
			$query = $this->db->get();
			
			foreach ($query->result_array() as $value){
				$hotel_data['hotel_name'] = $value['name'];
				$hotel_data['hotel_location'] = $value['location'];
				$hotel_data['plan'] = $value['name_spanish'].'/'.$value['name_english'];
				$hotel_data['plan_description'] = $value['description'];
			
			}
			
			
			$this->db->select ('r.name_spanish, r.special, rq.*');
			$this->db->from ('_admin_rooms r, _admin_rooms_hotels rh, _admin_rooms_per_quote rq');
			$this->db->where ( "rq.QUOTATIONS_HOTELS_id =".$quotation['quote_hotel_id']."
								AND rq.ROOMS_HOTELS_id = rh.rooms_hotels_id
								AND rh.ROOMS_id = r.room_id");
			$query = $this->db->get();
			
			$pos = 0;
			foreach ($query->result_array() as $value){
				$hotel_data['rooms'][$pos]['name'] = $value['name_spanish'];
				$hotel_data['rooms'][$pos]['special'] = $value['special'];
				$hotel_data['rooms'][$pos]['quantity'] = $value['quantity_of_rooms'];
				$hotel_data['rooms'][$pos]['unit_price'] = $value['unit_price'];
				$hotel_data['rooms'][$pos]['subtotal'] = $value['subtotal'];
				$pos++;				
			}
			
		}
		return ($hotel_data);		
	}
	
	function quote_flight_data($quotation){
		$flight_data = array();
		$pos = 0;
		foreach($quotation as $quotation){			
			$this->db->select('f . * , a.name AS airline, fc.name AS origin_name');
			$this->db->from('_admin_flights f, _admin_flights_per_quote fq, _admin_airlines a, _admin_flights_city fc');
			$this->db->where('fq.QUOTATIONS_FLIGHTS_id ='.$quotation['quote_flight_id'].'
								AND fq.FLIGHTS_id = f.flight_id
								AND f.AIRLINES_id = a.airline_id
								AND f.origin = fc.flight_city_id');
			$query = $this->db->get();
			
			 $post=0;
			foreach ($query->result_array() as $value){				
				$flight_data[$pos]['origin'] = $value['origin_name'];
				
				$destination = $this->find_quote($value['destination'], '_admin_flights_city', 'flight_city_id');
				foreach($destination as $destination)
					$flight_data[$pos]['destination'] = $destination['name']; 
					
				$flight_data[$pos]['number'] = $value['number'];
				$flight_data[$pos]['airline'] = $value['airline'];
				$flight_data[$pos]['price_per_adult'] = $value['price_per_adult'];
				$flight_data[$pos]['price_per_kid'] = $value['price_per_kid'];
				$flight_data[$pos]['date'] = $value['go_date'];
				$flight_data[$pos]['time'] = $value['go_time'];
				$flight_data[$pos]['back_date'] = $value['back_date'];
				$flight_data[$pos]['back_time'] = $value['back_time'];
				$flight_data[$pos]['round_trip'] = $value['round_trip'];
				
				$this->db->select('t.*');
				$this->db->from('_admin_travelers t, _admin_travelers_per_flight tf');
			    $this->db->where('tf.FLIGHTS_id ='.$value['flight_id'].' AND tf.TRAVELERS_ci_id = t.traveler_ci_id');
				$query = $this->db->get();
				foreach ($query->result_array() as $traveler){
					$flight_data[$pos]['traveler'][$post] = $traveler;	
					$post++;
				}
				$pos++;
			}
		}
		return $flight_data;
	}
	
	function quote_generic_data($quotation){
		foreach($quotation as $quotation){
			$this->db->select('g.*');
			$this->db->from('_admin_generic g, _admin_generic_per_quote gq');
			$this->db->where('gq.QUOTES_GENERIC_id ='.$quotation['quotes_generic_id'].' AND gq.GENERIC_id = g.generic_id');
			$query = $this->db->get();
		}
		return $query->result_array();
	}
	
	function quote_package_data($quotation){
		$pack_data = array();
		$rooms = array();
		 $this->db->select('p.*, h.hotel_name AS hotel FROM _admin_rooms_per_package_quote rpq, _admin_rooms_per_package rp, _admin_rooms_hotels rh, _admin_packages p, hotels h
						   WHERE rpq.QUOTE_PACKAGE_id ='.$quotation.'
						   AND rpq.ROOM_PER_PACKAGE_id = rp.room_per_package_id
						   AND rp.PACKAGE_id = p.package_id
						   AND rp.ROOMS_HOTELS_id = rh.rooms_hotels_id
						   AND rh.HOTELS_id = h.hotel_id');
		 $query = $this->db->get();
		 foreach ($query->result_array() as $value) {
			 $pack_data = $value;
		 }
			
									
		
		$this->db->where('QUOTE_PACKAGE_id', $quotation);
		$query2 = $this->db->get('_admin_rooms_per_package_quote');
		
		foreach ($query2->result_array() as $value){			
			 $this->db->select('rp.*, r.name_spanish FROM _admin_rooms_per_package rp, _admin_rooms r, _admin_rooms_hotels rh
							   WHERE rp.room_per_package_id ='.$value['ROOM_PER_PACKAGE_id'].'
							   AND rp.ROOMS_HOTELS_id = rh.rooms_hotels_id
							   AND rh.ROOMS_id = r.room_id');
			 $query3 = $this->db->get();
		 	 foreach ($query3->result_array() as $value2) {
				 $pos = count($rooms);
				 $rooms[$pos] = array();
				 $rooms[$pos] = $value2;
				 $rooms[$pos]['number_of_adults'] = $value['number_of_people'];
				 $rooms[$pos]['number_of_kids'] = $value['number_of_kids'];
				 $rooms[$pos]['number_of_additional_nights'] = $value['number_of_additional_nights'];
			 }
		}
		/*echo('pack data<pre>');
		var_dump($pack_data);
		echo('</pre>');
		
		echo('rooms<pre>');
		var_dump($rooms);
		echo('</pre>');*/
		
		$resp = array('pack_data' => $pack_data, 'rooms' => $rooms);
		
		return $resp;
		
		
	}
	
	function pq_insert($rooms, $total, $check_in, $check_out, $additional_nights){
		$pq_id = '';
		$data_pq = array('quote_package_id' => '', 'check_in' => $check_in, 'check_out' => $check_out, 'total' => $total);
		$this->db->insert('_admin_quotations_package', $data_pq);
		
		$this->db->select_max('quote_package_id');
		$query = $this->db->get('_admin_quotations_package');
				
		foreach ($query->result_array() as $value)
			foreach ($value as $value)
				$pq_id = $value;
				
		foreach($rooms as $room){
			if(count($room) > 0){
				if($room[0] != ''){
					$data_rp = array('QUOTE_PACKAGE_id' => $pq_id, 'ROOM_PER_PACKAGE_id' => $room[0], 'number_of_people' => $room[4], 'number_of_kids' => $room[5], 'number_of_additional_nights' => $additional_nights);
					$this->db->insert('_admin_rooms_per_package_quote', $data_rp);
				}
			}
		}
		
		return $pq_id;
	}
}
?>