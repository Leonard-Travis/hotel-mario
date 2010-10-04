<?php 

class Price_matrix extends Controller {
	
	function Price_matrix (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->library('calendar');
		$this->load->model(array('hotels_model','plans_model','price_matrix_model'));
	}
	
//this function gets all the price matrices that belongs to an specific given hotel. Sorted by plan and dates.
	function matrices ($hotel_selected_id)
	{
		$query = $this->price_matrix_model->all_matrices ($hotel_selected_id);
		$m = 0;
		$all_matrices = array();
		
		if($query){
			for ($i=0; $i<count($query); $i++){
				if ($query[$i]['SEASON_id'] != "0"){
					$j=0; $k=0; $room_price = array();
					$matrix = array();
					$plan = $query[$i]['plan_name']; 
					$season = $query[$i]['SEASON_id'];
					
					$matrix['plan_name'] = $query[$i]['plan_name']; 
					$matrix['date_start'] = $query[$i]['date_start']; 
					$matrix['date_end'] = $query[$i]['date_end']; 
					$matrix['season_id'] = $query[$i]['SEASON_id'];
					
					$room_price[$k]['room_name'] = $query[$i]['room_name'];
					$room_price[$k]['price_per_night'] = $query[$i]['price_per_night'];
					$room_price[$k]['price_id'] = $query[$i]['price_id'];
					$k = $k + 1;
					
					$query[$i]['SEASON_id'] = "0";
					
					for($h=0; $h<count($query); $h++){
						if (($query[$h]['plan_name'] == $plan)&&($query[$h]['SEASON_id'] == $season)){
							$room_price[$k]['room_name'] = $query[$h]['room_name'];
							$room_price[$k]['price_per_night'] = $query[$h]['price_per_night'];
							$room_price[$k]['price_id'] = $query[$h]['price_id'];
							$k = $k + 1;
							$query[$h]['SEASON_id'] = "0";
						}
					}
					$matrix['prices'] = $room_price;
					$all_matrices[$m] = $matrix; 
					$m = $m + 1;
				}
			}
			
			/*echo('<br /> all matrices<pre>');
			var_dump($all_matrices);
			echo('</pre>');*/
			
//------------------Sorting by plan and within, by date.-------------------
			function cmp($a, $b)
			{
				return strcmp($a["date_start"], $b["date_start"]);
			}			
			
			$aux_matrix = array();
			$plan = '';
			$middle_matrix = array();
			
			foreach($all_matrices as $matrix){
				if($matrix['plan_name'] != $plan){
					if(count($middle_matrix) > 0){
						usort($middle_matrix, "cmp");
						foreach($middle_matrix as $middle) 
							$aux_matrix[count($aux_matrix)] = $middle;
						$middle_matrix = array();
					}
					$plan = $matrix['plan_name'];
				}
				$middle_matrix[count($middle_matrix)] = $matrix;
			}
//----------------------------------------------------------------------------
			
			/*echo('<br /> aux matrix <pre>');
			var_dump($aux_matrix);
			echo('</pre>');*/
	
			return ($aux_matrix);
		}
		else
			return ('empty');
	}

    function index($management_flag)
    {
		$rules['hotels']	= "required";
		$this->validation->set_rules($rules);
		$data['hotel_selected'] = NULL;

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->hotels_model->all_hotels();
			$data['all_matrices'] = NULL;
			if ($management_flag == 1)
				$this->load->view('management_price_matrix',$data);
			else
				$this->load->view('price_matrix',$data);
		}
		else
		{
			$hotel_selected_id = $_POST["hotels"];
			$data['query'] = $this->hotels_model->all_hotels();
			$data['plans'] = $this->hotels_model->all_plans($hotel_selected_id);
			$data['hotel_selected'] = $this->hotels_model->find($hotel_selected_id);
			if ($management_flag == 1){
				$data['all_matrices'] = $this->matrices($hotel_selected_id);			
				$this->load->view('management_price_matrix',$data);	
			}
			else
			$this->load->view('price_matrix',$data);				
		}
	}
		

	function price_matrix_data($management_flag)
    {
		$hotel_selected_id = $_POST["hotel_id"];
		$date_end = $_POST["date_end"];
		$date_ini = $_POST["date_ini"];
		$plan_selected = $_POST["plan"];
		
		$seasons = $this->price_matrix_model->get_seasons($date_ini, $date_end);
		$i = 0;
		$prices = array();
		
		foreach ($seasons as $value){
			if ($plan_selected != 'no_plan'){
				$prices[$i] = $this->price_matrix_model->get_prices($hotel_selected_id, $value['season_id'], $plan_selected);
			}
			else{
				$prices[$i] = $this->price_matrix_model->get_prices_without_plan($hotel_selected_id, $value['season_id']);
			}
			if (empty($prices[$i]))	unset($prices[$i]); 
			else	$i = ($i + 1);
		}		
		
		$rules['weekdays']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$data['weekdays'] = 0;
		}
		else
		{
			$weekdays = $_POST["weekdays"]; 
			
			if ($weekdays == 0)
				$data['weekdays'] = 1;
			else if ($weekdays == 1)
				$data['weekdays'] = 0;
	
		}
			if (empty($prices)) $data['prices'] = 11;
			else				$data['prices'] = $prices;
			$data['date_ini'] = $date_ini;
			$data['date_end'] = $date_end;
			$data['query'] = $this->hotels_model->all_hotels();
			$data['plans'] = $this->hotels_model->all_plans($hotel_selected_id);
			$data['plan_selected'] = $this->plans_model->find($plan_selected);
			$data['hotel_selected'] = $this->hotels_model->find($hotel_selected_id);
			if ($management_flag == 1){
				$data['all_matrices'] = $this->matrices($hotel_selected_id);
				$this->load->view('management_price_matrix_complete',$data);
			}
			else
				$this->load->view('price_matrix_complete',$data);
	}
	
	function delete_matrix ()
	{
		$prices_id = $_POST["prices_id"];
		$hotel_selected_id = $_POST["hotel_id"];
		$season_id = $_POST["season_id"];
		
		$prices_id = explode('|', $prices_id);
		$this->price_matrix_model->delete_matrix($prices_id, $hotel_selected_id, $season_id);
		
		$data['query'] = $this->hotels_model->all_hotels();
		$data['plans'] = $this->hotels_model->all_plans($hotel_selected_id);
		$data['hotel_selected'] = $this->hotels_model->find($hotel_selected_id);
		$data['all_matrices'] = $this->matrices($hotel_selected_id);			
		$this->load->view('management_price_matrix',$data);	
	}
	
	function new_matrix_season(){
		$hotel_id = $_POST["hotel_selected_id"];
		$data['plans'] = $this->hotels_model->all_plans($hotel_id);
		$data['hotel_selected'] = $this->hotels_model->find($hotel_id);
		$this->load->view('matrix_initial_info', $data);
	}
	
	function validate_dates(){
		$hotel_selected_id = $_POST["hotel_id"];
		$date_end = $_POST["date_end"];
		$date_ini = $_POST["date_ini"];
		$overlapping_dates = false;
		
		$hotel_seasons = $this->hotels_model->all_seasons_hotel($hotel_selected_id);
		
		$date_ini=strtotime($date_ini);
		$date_end=strtotime($date_end);
		
		foreach ($hotel_seasons as $season){
			$season_date_ini=strtotime($season['date_start']);
			$season_date_end=strtotime($season['date_end']);
			
			if ($overlapping_dates == false){
				for($i=$season_date_ini; $i<=$season_date_end; $i+=86400){
					
					if (($i == $date_ini) || ($i == $date_end)){
						$overlapping_dates = true; $i = $season_date_end;
					}
				}
			}
			
			if ($overlapping_dates == false){
				for($i=$date_ini; $i<=$date_end; $i+=86400){
					if (($i == $season_date_ini) || ($i == $season_date_end)){
						$overlapping_dates = true; $i = $date_end;
					}
				}
			}
		}
		
		if ($overlapping_dates == true)		echo('');
		else	$this->load->view('new_matrix_frame');
	}
	
	function new_matrix_add_room(){
		$hotel_selected_id = $_POST["hotel_id"];
		$data['counter'] = $_POST["counter"];
		$data['rooms'] = $this->hotels_model->all_rooms($hotel_selected_id);
		$data['hotel_id'] = $hotel_selected_id;
		$this->load->view('new_matrix_data', $data);
	}
	
	function process_new_matrix(){
		$hotel_id = $_POST['hotel_id'];
		$plan_id = $_POST['plan_id'];
		$date_start = $_POST['date_start'];
		$date_end = $_POST['date_end'];
		$season_name = $_POST['season_name'];
		$new_matrix_str = $_POST['new_matrix'];
		$new_matrix = array();
		
		$possible_season = $this->price_matrix_model->find_season($date_start, $date_end);
		if (empty($possible_season)){
			$possible_season = $this->price_matrix_model->new_season($date_start, $date_end);
		}
		foreach($possible_season as $possible_season){
			$this->price_matrix_model->add_hotel_season($hotel_id, $possible_season['season_id'], $season_name);
			$new_matrix = $this->new_matrix_str_to_array($new_matrix_str, $plan_id, $possible_season['season_id']);
		}
		$this->price_matrix_model->new_matrix($new_matrix);
	}
	
	function new_matrix_str_to_array($new_matrix_str, $plan_id, $season_id){		
		$count = 0; $pointer = 0;
		$new_matrix = array('SEASON_id' => '', 'PLAN_id' => '', 'ROOMS_HOTELS_id' => '', 'price_per_night' => '', 'has_weekdays' => '', 'monday_price' => '', 'tuesday_price' => '', 'wednesday_price' => '', 'thursday_price' => '', 'friday_price' => '', 'saturday_price' => '', 'sunday_price' => '');
		$new_matrices = array();
		
		for ($i=0; $i<strlen($new_matrix_str); $i++){
			$new_matrix['SEASON_id'] = $season_id;
			$new_matrix['PLAN_id'] = $plan_id;
			
			if (($new_matrix_str[$i] != '|') && ($count==0)){
				$new_matrix['ROOMS_HOTELS_id'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==1)){
				$new_matrix['price_per_night'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==2)){
				
				if ($new_matrix_str[$i] == 0){
					$new_matrix['has_weekdays'] = $new_matrix['monday_price'] = $new_matrix['tuesday_price'] = $new_matrix['wednesday_price'] = $new_matrix['thursday_price'] = $new_matrix['friday_price'] = $new_matrix['saturday_price'] = $new_matrix['sunday_price'] = '0';
					
					$count = 0; $i = $i +2;
					$new_matrices[$pointer] = $new_matrix;
					
					$new_matrix = array('SEASON_id' => '', 'PLAN_id' => '', 'ROOMS_HOTELS_id' => '', 'price_per_night' => '', 'has_weekdays' => '', 'monday_price' => '', 'tuesday_price' => '', 'wednesday_price' => '', 'thursday_price' => '', 'friday_price' => '', 'saturday_price' => '', 'sunday_price' => '');
					
					$pointer++;
				}
				else	
					$new_matrix['has_weekdays'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==3)){
				$new_matrix['monday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==4)){
				$new_matrix['tuesday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==5)){
				$new_matrix['wednesday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==6)){
				$new_matrix['thursday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==7)){
				$new_matrix['friday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==8)){
				$new_matrix['saturday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] != '|') && ($count==9)){
				$new_matrix['sunday_price'] .= $new_matrix_str[$i];
			}
			elseif (($new_matrix_str[$i] == '|') && ($count==9)){
				$count = 0; $i++;
				$new_matrices[$pointer] = $new_matrix; 
				
				$new_matrix = array('SEASON_id' => '', 'PLAN_id' => '', 'ROOMS_HOTELS_id' => '', 'price_per_night' => '', 'has_weekdays' => '', 'monday_price' => '', 'tuesday_price' => '', 'wednesday_price' => '', 'thursday_price' => '', 'friday_price' => '', 'saturday_price' => '', 'sunday_price' => '');
				
				$pointer++;
			}
			elseif (($new_matrix_str[$i] == '|') && ($count < 9)){
				$count++;
			}
		}
		return($new_matrices);
	}
}

?>