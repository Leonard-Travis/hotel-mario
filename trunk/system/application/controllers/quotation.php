<?php 

class Quotation extends Controller {
	
	function Quotation(){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model(array ('hotels_model', 'client_model', 'price_matrix_model', 'quotations_model'));
	}

	function new_quote($ci_client){
		$data['customer'] = NULL;
		
		if ($ci_client != '0'){
			$data['customer'] = $this->client_model->find($ci_client);
		}   
		
		$this->load->view('quotation', $data);
	}
	
	function hotel_quote (){
		$data['hotels'] = $this->hotels_model->all_hotels();
		$data['hotel_selected'] = NULL;
		$this->load->view('hotel_quote',$data);

	}
	
	function flight_quote(){
		$data['cont_f'] = $_POST['cont_f'];
		$data['citys'] = $this->quotations_model->flight_citys();
		$data['airlines'] = $this->quotations_model->airlines();
		$class = $this->quotations_model->enum_values('_admin_flights', 'class');
		
		foreach($class as $class){
			preg_match('/enum\((.*)\)$/', $class['Type'], $matches);
			$data['classes'] = explode(',', $matches[1]);
		}	
		
		if ($data['cont_f'] == 0)
			$this->load->view('flight_frame');
		$this->load->view('flight_quote', $data);
	}
	
	function generic_quote(){
		$this->load->view('generic');
	}
	
	function hotel_selected_quote(){
		$ci_client = $_POST['customer_id'];
		$data['customer'] = $this->client_model->find($ci_client);
		$data['hotels'] = $this->hotels_model->all_hotels();
		$hotel_id = $_POST['hotel_id'];
		$data['plans'] = $this->hotels_model->all_plans($hotel_id);
		$data['hotel_selected'] = $this->hotels_model->find($hotel_id);
		$this->load->view('hotel_quote',$data);
	}
	
	function start_quote($flag){
		$hotel_selected_id = $_POST["hotel_id"];
		$date_end = $_POST["date_end"];
		$date_ini = $_POST["date_ini"];
		$plan_selected = $_POST["plan_id"];
		$counter = $_POST["counter"];	
		
		$seasons = $this->price_matrix_model->get_seasons($date_ini, $date_end);
		$i = 0;
		$prices = array(); $aux = array();;
		

		
		foreach ($seasons as $value){
			$aux = $this->quotations_model->get_prices($hotel_selected_id, $value['season_id'], $plan_selected);
			
			if (!empty($aux)) {
				foreach($aux as $aux){
					$prices[$i]['name_spanish'] = $aux['name_spanish'];
					$prices[$i]['rooms_hotels_id'] = $aux['rooms_hotels_id'];
					$prices[$i]['price'] = $aux['price_per_night'];
					$prices[$i]['capacity'] = $aux['capacity'];
					$prices[$i]['date_start'] = $aux['date_start'];
					$prices[$i]['date_end'] = $aux['date_end'];
					$prices[$i]['capacity'] = $aux['capacity'];
					$i = $i + 1;
				}
				
			}
		}
		
		/*echo('<pre>');
		var_dump($prices);
		echo('</pre>');*/		
		
		$data['date_start_quote'] = $date_ini;
		$data['date_end_quote'] = $date_end;
		$data['plan_selected'] = $plan_selected;
		$data['hotel_selected_id'] = $hotel_selected_id;
		$data['counter'] = $counter;

		if (($flag == 1) && (!empty($prices)) ){			
			$rooms_selected = explode('|',$_POST["rooms_selected"]);
			$pos = array();
			for($i=0; $i < count($prices); $i++){
				for ($j=0; $j < count($rooms_selected); $j++){
					if ($prices[$i]['rooms_hotels_id'] == $rooms_selected[$j]) {
						$pos[count($pos)] = $i;
						$j = count($rooms_selected) + 1;
					}
				}
			}
			
			foreach($pos as $pos){
				unset($prices[$pos]);
			}
		}
		
		if (empty($prices)) $data['prices'] = 11;
		else				{
			sort($prices);
			$data['prices'] = $prices; 
		}
		
		if ($flag == 0)	$this->load->view('start_quote',$data);
		
		$this->load->view('quote_details_form',$data);
	}
	
	function setting_PU(){
		$room_hotel = $_POST["room"];
		$date_start = $_POST["date_start"];
		$date_end = $_POST["date_end"];
		$plan = $_POST["plan"];
		
		$seasons = $this->price_matrix_model->get_seasons($date_start, $date_end);
		$unit_price = '';
		
		foreach ($seasons as $value){
			$prices = $this->quotations_model->get_prices_with_room($room_hotel, $value['season_id'], $plan);
			
			if (!empty($prices)){
				foreach($prices as $price){
					$unit_price = ($unit_price.$price['price_per_night'].'BsF. (desde '.$price['date_start'].' hasta '.$price['date_end'].').<br />');
				}
			}
		}
		$data['PU'] = $unit_price;
		$this->load->view('unit_price', $data);		
	}
	
	
	
	function check_in_range($start_date, $end_date, $evaluame){
		$start_ts = strtotime($start_date);
		$end_ts = strtotime($end_date);
		$user_ts = strtotime($evaluame);
		return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}

	function subtract_dates($dDateIni, $dDateEnd)
	{
		$dDateIni = str_replace("-","",$dDateIni);
		$dDateIni = str_replace("/","",$dDateIni);
		$dDateEnd = str_replace("-","",$dDateEnd);
		$dDateEnd = str_replace("/","",$dDateEnd);
		
		preg_match("/([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})/", $dDateIni, $aDateIni);
		preg_match("/([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})/", $dDateEnd, $aDateEnd);
	
		$date1 = mktime(0,0,0,$aDateIni[2], $aDateIni[1], $aDateIni[3]);
		$date2 = mktime(0,0,0,$aDateEnd[2], $aDateEnd[1], $aDateEnd[3]);
	
		return round(($date2 - $date1) / (60 * 60 * 24));
	}
	
	function change_date_format($date){ 
		list($year,$month,$day)=explode("-",$date); 
		return $day."-".$month."-".$year; 
	}
	
	
	function setting_subtotal(){
		$room_hotel = $_POST["room"];
		$date_start = $_POST["date_start"];
		$date_end = $_POST["date_end"];
		$plan = $_POST["plan"];
		$quantity = $_POST["quantity"];
		
		$subtotal = 0; $days = 0; $subtract_season_dates = 0; $subtract_aux = 0;
		
		$seasons = $this->price_matrix_model->get_seasons($date_start, $date_end);
		
		foreach ($seasons as $value){
			$prices = $this->quotations_model->get_prices_with_room($room_hotel, $value['season_id'], $plan);
			
			if (!empty($prices)){
				foreach($prices as $price){
					$subtract_season_dates = ($this->subtract_dates($this->change_date_format($price['date_start']), $this->change_date_format($price['date_end'])));
					
					if (($this->check_in_range($date_start, $date_end, $price['date_start'])) && ($this->check_in_range($date_start, $date_end, $price['date_end']))){
						$subtotal = $subtotal + ($subtract_season_dates*$price['price_per_night']);																													  					}
						
					elseif ($this->check_in_range($date_start, $date_end, $price['date_start'])){
						$subtract_aux = ($this->subtract_dates($this->change_date_format($date_end), $this->change_date_format($price['date_end'])));
						
						$subtotal = $subtotal+(($subtract_season_dates-$subtract_aux)*$price['price_per_night']);																 
					}
					elseif ($this->check_in_range($date_start, $date_end, $price['date_end'])){
						$subtract_aux = ($this->subtract_dates($this->change_date_format($price['date_start']), $this->change_date_format($date_start)));
						
						$subtotal = $subtotal+(($subtract_season_dates-$subtract_aux)*$price['price_per_night']);																 
					}
				}
			}
		}
		
		$data['subtotal'] = $subtotal * $quantity;
		$this->load->view('subtotal', $data);
	}
	
	function str_to_array ($rooms_selected){
		$quote_rooms = array();		
		$cont = 0; $pos = 0;
		$room = array('rooms_hotels_id' => '','quantity' => '' ,'PU' => '' ,'subtotal' => '');
		
		for ($i=0; $i< strlen($rooms_selected); $i++){
			if (($rooms_selected[$i] != '|') && ($rooms_selected[$i] != '||') && ($cont == 0)){
				$room['rooms_hotels_id'] = $room['rooms_hotels_id'].$rooms_selected[$i];
			}
			elseif (($rooms_selected[$i] != '|') && ($rooms_selected[$i] != '||') && ($cont == 1)){
				$room['quantity'] = $room['quantity'].$rooms_selected[$i];
			}
			elseif (($rooms_selected[$i] != '|') && ($rooms_selected[$i] != '||') && ($cont == 2)){
				$room['PU'] = $room['PU'].$rooms_selected[$i];
			}
			elseif (($rooms_selected[$i] != '|') && ($rooms_selected[$i] != '||') && ($cont == 3)){
				$room['subtotal'] = $room['subtotal'].$rooms_selected[$i];
			}
			elseif (($rooms_selected[$i] == '|') && ($cont < 4 )){
				$cont = $cont +1;
			}
			elseif ($cont == 4){
				$aux = $this->quotations_model->find_room_hotel_name($room['rooms_hotels_id']);
				foreach ($aux as $aux){
					$room['name_spanish'] = $aux['name_spanish'];
				}
				$quote_rooms[$pos] = $room;
				$cont = 0;
				$pos = $pos + 1;
				$room = array('rooms_hotels_id' => '','quantity' => '' ,'PU' => '' ,'subtotal' => '');
			}
		}
		return ($quote_rooms);
	}
	
	function hotel_summary(){
		$data['subtotal'] = $_POST["subtotal"];
		$data['quote_rooms'] = $this->str_to_array($_POST["rooms_selected"]);
		$this->load->view('hotel_summary', $data);
	}
	
	function save_quote(){
		$data['plan_id'] = $_POST["plan_id"];
		$data['date_start'] = $_POST["date_start"];
		$data['date_end'] = $_POST["date_end"];
		$data['subtotal'] = $_POST["subtotal"];
		$data['quote_rooms'] = $this->str_to_array($_POST["rooms_selected"]);
		$quote_hotel_id = $this->quotations_model->insert_hotel_quote($data);
		echo($quote_hotel_id);
	}
	
	function travelers_info(){
		$data['cant_adults'] = $_POST["cant_adults"];
		$data['cant_kids'] = $_POST["cant_kids"];
		$data['cont_f'] = $_POST["cont_flight"];
		$this->load->view('travelers_info', $data);
	}
	
	function flight_type($origin, $destination){
		$venezuela_id = $this->quotations_model->select_venezuela();
		$origin_country = $this->quotations_model->select_country($origin);
		$destination_country = $this->quotations_model->select_country($destination);
		
		foreach($origin_country as $origin_country){
			foreach($venezuela_id as $venezuela_id){
				foreach($destination_country as $destination_country){
					if (($origin_country['FLIGHTS_COUNTRY_id'] == $venezuela_id['flight_country_id']) && ($destination_country['FLIGHTS_COUNTRY_id'] == $venezuela_id['flight_country_id']))
						return ('national');
					else return('international');
				}
			}
		}
		
	}
	
	function process_flight($flight_aux, $all_data, $summary){
		$flight = array(  'flight_id' => '', 'AIRLINES_id' => '', 'number' => '', 'class' => '', 'price_per_adult' => '', 'price_per_kid' => '', 'origin' => '', 'destination' => '', 'time' => '', 'date' => '', 'type' => '');
		
		$flight_data = array(); //all info of one flight including passengers once processed and ready		
		$travelers_aux = array(); //travelers before explode, example: name|lastname|passport|...||..
		$traveler_aux = array(); //each traveler after explode but with no indexes
		$traveler = array('traveler_ci_id' => '', 'name' => '', 'lastname' => '', 'passport' => '', 'email' => '', 'type' => '');
		
		if ($summary == 0)
			$flight['flight_id'] = '';
		elseif ($summary == 1) $flight['flight_id'] = $flight_aux[11];
				
		if ($flight_aux[12] == 'S'){
			$flight['origin'] = $flight_aux[1];
			$flight['destination'] = $flight_aux[0];
			$flight['date'] = $flight_aux[13];
			$flight['time'] = $flight_aux[14];
			
		}
		else {
			$flight['origin'] = $flight_aux[0];
			$flight['destination'] = $flight_aux[1];
			$flight['date'] = $flight_aux[2];
			$flight['time'] = $flight_aux[3];
			
		}
		$flight['number'] = $flight_aux[4];
		$flight['AIRLINES_id'] = $flight_aux[5];
		$flight['class'] = str_replace("'", "",$flight_aux[6]);
		$flight['type'] = $this->flight_type($flight['origin'], $flight['destination']);
		$flight['price_per_adult'] = $flight_aux[7];
		$flight['price_per_kid'] = $flight_aux[8];
		
		$flight_data[0] = $flight;
		
		for ($i=1; $i<count($all_data); $i++){
			$travelers_aux[count($travelers_aux)] = $all_data[$i]; 
		}
		
		foreach($travelers_aux as $travelers_aux){
			$traveler_aux = explode('|', $travelers_aux);
			$traveler['name'] = $traveler_aux[0];
			$traveler['lastname'] = $traveler_aux[1];
			$traveler['traveler_ci_id'] = $traveler_aux[2];
			$traveler['passport'] = $traveler_aux[3];
			$traveler['email'] = $traveler_aux[4];
			$traveler['type'] =  $traveler_aux[5];
			
			$flight_data[count($flight_data)] = $traveler;
		}
		return $flight_data;
	}
	
	function flight_quote_insert($summary){
		$flights_quote = $_POST["flights_quote"];
		
		$flights_each = array();
		$flights_each = explode('|||', $flights_quote); //array with info of every flight
		$all_flights = array(); //all flights from the same quote that in the end will be saved.
		
		$total = 0;
		
		
		foreach($flights_each as $flights){			
			if ($flights != ''){
				
				$all_data = array(); //all info of one flight including passengers, but rough
				$flight_aux = array(); //all info of flight exploded but with no indexes
				
				$all_data = explode('||', $flights);
				$flight_aux = explode('|', $all_data[0]);
				$all_flights[count($all_flights)] = $this->process_flight($flight_aux, $all_data, $summary);
				$total += (($flight_aux[9] * (floatval($flight_aux[7]))) + ($flight_aux[10] * (floatval($flight_aux[8]))));
				if ($flight_aux[12] == 'Y'){
					$back_flight = str_replace("|Y|", "|S|", $flights);
					$all_data = explode('||', $back_flight);
					$flight_aux = explode('|', $all_data[0]);		
					$all_flights[count($all_flights)] = $this->process_flight($flight_aux, $all_data, $summary);
					$total += (($flight_aux[9] * (floatval($flight_aux[7]))) + ($flight_aux[10] * (floatval($flight_aux[8]))));
				}
			}
			
		}
		if ($summary == '1')
			$this->flight_quote_summary($all_flights, $total);
		elseif ($summary == '0'){
			$flight_quote_id = $this->quotations_model->insert_flight_quote($all_flights, $total);
			echo($flight_quote_id);
		}
	}
	
	function flight_quote_summary($all_flights, $total){
		for($i=0; $i < count($all_flights); $i++){			
			$city_aux = $this->quotations_model->find_city($all_flights[$i][0]['origin']);
			foreach($city_aux as $city){
				$all_flights[$i][0]['origin'] = $city['name'];
			}
			
			
			$city_aux = $this->quotations_model->find_city($all_flights[$i][0]['destination']);
			foreach($city_aux as $city){
				$all_flights[$i][0]['destination'] = $city['name'];
			}
			
			$airline_aux = $this->quotations_model->find_airline($all_flights[$i][0]['AIRLINES_id']);
			foreach ($airline_aux as $airline_aux){
				$all_flights[$i][0]['AIRLINES_id'] = $airline_aux['code'];
			}
		}
		
		/*echo('<pre>');
		var_dump($all_flights);
		echo('</pre>');*/
		
		$data['all_flights'] = $all_flights;
		$data['total'] = $total;
		$this->load->view('flight_quote_summary', $data);
	}
	
	function find_traveler($traveler_ci){
		$traveler = $this->quotations_model->find_traveler($traveler_ci);
		if ($traveler != NULL){
			foreach($traveler as $traveler){
				echo($traveler['name'].'|'.$traveler['lastname'].'|'.$traveler['passport'].'|'.$traveler['email']);
			}
		}
		else echo('');
	}
	
	function generic_summary(){
		$generic = $_POST["generic_quote"];	
		$total = $_POST["generic_total"];
		$generic = explode('||', $generic);

		for($i=0; $i < count($generic); $i++){
			$generic[$i] = explode('|', $generic[$i]);
		}
		
		$data['generic'] = $generic;
		$data['total'] = $total;
		$this->load->view('generic_summary', $data);
	}
	
	function generic_process(){
		$generic = $_POST["generic_quote"];	
		$total = $_POST["generic_total"];
		$generic = explode('||', $generic);

		for($i=0; $i < count($generic); $i++){
			$generic[$i] = explode('|', $generic[$i]);
		}
		
		$generic_quote_id = $this->quotations_model->insert_generic_quote($generic, $total);
		echo($generic_quote_id);
	}
	
	function process_quotation(){
		$data['quote_id'] = '';
		$data['CUSTOMERS_ci_id'] = $_POST["customer_id"];
		$data['EMPLOYEES_id'] = 1;
		$data['QUOTATIONS_HOTELS_id'] = $_POST["hotel_quote_id"];		
		$data['QUOTATIONS_FLIGHTS_id'] = $_POST["flight_quote_id"];
		$data['QUOTATIONS_GENERIC_id'] = $_POST["generic_quote_id"];
		$data['quote_date'] = date('Y-m-d');
		
		$this->quotations_model->insert_quotation($data);
	}
}








?>