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
		$data['customer'] = $this->client_model->find($ci_client);
		$this->load->view('quotation',$data);
	}
	
	function hotel_quote (){
		$ci_client = $_POST['customer_id'];
		$data['customer'] = $this->client_model->find($ci_client);
		$data['hotels'] = $this->hotels_model->all_hotels();
		$data['hotel_selected'] = NULL;
		$this->load->view('hotel_quote',$data);

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

}








?>