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
			return ($all_matrices);
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
		$aux = array(); $k=0;
		for ($i=0; $i < strlen($prices_id); $i++)
		{
			if($prices_id[$i] != '|'){
				$aux[$k] = $prices_id[$i];
				$k++;
			}
		}
		$prices_id = $aux;
		$this->price_matrix_model->delete_matrix($prices_id);
		
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
		$plan_selected = $_POST["plan_id"];
		$season_name = $_POST["season_name"];
		$overlapping_dates = false;
		
		$hotel_seasons = $this->hotels_model->all_seasons_hotel($hotel_selected_id);
		
		$date_ini_aux = $date_ini;
		$date_end_aux = $date_end;
		
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
		
		if ($overlapping_dates == true){
			echo('');
		}
		else{
			/*$possible_season = $this->price_matrix_model->find_season($date_ini_aux, $date_end_aux);

			if (empty($possible_season)){
				$possible_season = $this->price_matrix_model->new_season($date_ini_aux, $date_end_aux);
			}
			foreach($possible_season as $possible_season)
				$this->price_matrix_model->add_hotel_season($hotel_selected_id, $possible_season['season_id'], $season_name);
			
			*/
			$this->load->view('new_matrix_frame');
		}
	}
	
	function new_matrix_add_room(){
		$hotel_selected_id = $_POST["hotel_id"];
		$data['counter'] = $_POST["counter"];
		$data['rooms'] = $this->hotels_model->all_rooms($hotel_selected_id);
		$data['hotel_id'] = $hotel_selected_id;
		$this->load->view('new_matrix_data', $data);
	}
}

?>