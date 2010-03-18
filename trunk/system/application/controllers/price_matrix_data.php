<?php 

class Price_matrix_data extends Controller {
	
	function Price_matrix_data (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('price_matrix');
		$this->load->model('hotels');
		$this->load->model('plans');
	}

    function index()
    {
		$hotel_selected_id = $_POST["hotel_id"];
		$date_end = $_POST["date_end"];
		$date_ini = $_POST["date_ini"];
		$plan_selected = $_POST["plan"];
		
		$seasons = $this->price_matrix->get_seasons($date_ini, $date_end);
		$i = 0;
		$prices = array();
		
		foreach ($seasons as $value){
			if ($plan_selected != 'no_plan')
				$prices[$i] = $this->price_matrix->get_prices($hotel_selected_id, $value['season_id'], $plan_selected);
			else
				$prices[$i] = $this->price_matrix->get_prices_without_plan($hotel_selected_id, $value['season_id']);
				
			if (empty($prices[$i]))	unset($prices[$i]); 
			else	$i = ($i + 1);
		}		
		
		$rules['weekdays']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			if (empty($prices)) $data['prices'] = 11;
			else				$data['prices'] = $prices;
			$data['date_ini'] = $date_ini;
			$data['date_end'] = $date_end;
			$data['query'] = $this->hotels->all_hotels();
			$data['plans'] = $this->hotels->all_plans($hotel_selected_id);
			$data['plan_selected'] = $this->plans->find($plan_selected);
			$data['hotel_selected'] = $this->hotels->find($hotel_selected_id);
			$data['weekdays'] = 0;
			$this->load->view('price_matrix_complete',$data);
		}
		else
		{
			$weekdays = $_POST["weekdays"]; 
			
			if ($weekdays == 0)	{
				$data['weekdays'] = 1;
				$price_with_weekdays = array();
				$weekdays;
				$j = 0;
				foreach($prices as $prices){
				foreach($prices as $price){
					$weekdays = $this->price_matrix->weekdays($price['SEASON_id']);
					if (empty ($weekdays)) $weekdays = 0;
					$price_aux = array ('name' => $price['name'] , 'price_per_night' => $price['price_per_night'] , 'weekdays' => $weekdays);
					$price_with_weekdays[$j] = $price_aux;
					$j = ($j + 1);
				}
				}
				$data['prices'] = $price_with_weekdays;
			}
			else if ($weekdays == 1){
				$data['weekdays'] = 0;
				if (empty($prices)) $data['prices'] = 11;
				else     			$data['prices'] = $prices;
			}
			
			$data['date_ini'] = $date_ini;
			$data['date_end'] = $date_end;
			$data['query'] = $this->hotels->all_hotels();
			$data['plans'] = $this->hotels->all_plans($hotel_selected_id);
			$data['plan_selected'] = $this->plans->find($plan_selected);
			$data['hotel_selected'] = $this->hotels->find($hotel_selected_id);
			$this->load->view('price_matrix_complete',$data);
		}
	}
}

?>