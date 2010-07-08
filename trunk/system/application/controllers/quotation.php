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
	
	function start_quote(){
		$hotel_selected_id = $_POST["hotel_id"];
		$date_end = $_POST["date_end"];
		$date_ini = $_POST["date_ini"];
		$plan_selected = $_POST["plan_id"];
		
		
		
		$seasons = $this->price_matrix_model->get_seasons($date_ini, $date_end);
		$i = 0; $k = 0;
		$prices = array(); $aux = array();;
		

		
		foreach ($seasons as $value){
			$aux = $this->quotations_model->get_prices($hotel_selected_id, $value['season_id'], $plan_selected);
			
			if (empty($aux)){
					$k = 1;
				}
			else {
				foreach($aux as $aux){
					$prices[$i]['name_spanish'] = $aux['name_spanish'];
					$prices[$i]['rooms_hotels_id'] = $aux['rooms_hotels_id'];
					$prices[$i]['price'] = $aux['price_per_night'];
					$prices[$i]['capacity'] = $aux['capacity'];
					$prices[$i]['date_start'] = $aux['date_start'];
					$prices[$i]['date_end'] = $aux['date_end'];
				}
				$i = $i + 1;
			}
		}
		
		/*echo('<pre>');
		var_dump($prices);
		echo('</pre>');*/
		
		if (empty($prices)) $data['prices'] = 11;
		else				$data['prices'] = $prices;
		$data['date_start_quote'] = $date_ini;
		$data['date_end_quote'] = $date_end;
		$data['plan_selected'] = $plan_selected;
		
		$this->load->view('start_quote',$data);
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

	function restaFechas($dFecIni, $dFecFin)
	{
		$dFecIni = str_replace("-","",$dFecIni);
		$dFecIni = str_replace("/","",$dFecIni);
		$dFecFin = str_replace("-","",$dFecFin);
		$dFecFin = str_replace("/","",$dFecFin);
		
		preg_match("/([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})/", $dFecIni, $aFecIni);
		preg_match("/([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})/", $dFecFin, $aFecFin);
	
		$date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
		$date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);
	
		return round(($date2 - $date1) / (60 * 60 * 24));
	}
	
	function cambiarFormatoFecha($fecha){ 
		list($anio,$mes,$dia)=explode("-",$fecha); 
		return $dia."-".$mes."-".$anio; 
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
					$subtract_season_dates = ($this->restaFechas($this->cambiarFormatoFecha($price['date_start']), $this->cambiarFormatoFecha($price['date_end'])));
					
					if (($this->check_in_range($date_start, $date_end, $price['date_start'])) && ($this->check_in_range($date_start, $date_end, $price['date_end']))){
						$subtotal = $subtotal + ($subtract_season_dates*$price['price_per_night']);																													  					}
						
					elseif ($this->check_in_range($date_start, $date_end, $price['date_start'])){
						$subtract_aux = ($this->restaFechas($this->cambiarFormatoFecha($date_end), $this->cambiarFormatoFecha($price['date_end'])));
						
						$subtotal = $subtotal+(($subtract_season_dates-$subtract_aux)*$price['price_per_night']);																 
					}
					elseif (check_in_range($date_start, $date_end, $price['date_end'])){
						$subtract_aux = ($this->restaFechas($this->cambiarFormatoFecha($price['date_start']), $this->cambiarFormatoFecha($date_start)));
						
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