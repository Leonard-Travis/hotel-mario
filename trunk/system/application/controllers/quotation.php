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
		$prices = array(); $aux;
		
		foreach ($seasons as $value){
			$aux = $this->quotations_model->get_prices($hotel_selected_id, $value['season_id'], $plan_selected);
			if (empty($aux)){
				$k = 1;
			}
			else {
				foreach($aux as $aux){
					$prices[$i]['name_spanish'] = $aux['name_spanish'];
					$prices[$i]['price'] = $aux['price_per_night'];
					$prices[$i]['capacity'] = $aux['capacity'];
					$prices[$i]['date_start'] = $aux['date_start'];
					$prices[$i]['date_end'] = $aux['date_end'];
				}
				$i = $i + 1;
			}
		}
		
		echo('<pre>');
		var_dump($prices);
		echo('</pre>');
		
		if (empty($prices)) $data['prices'] = 11;
		else				$data['prices'] = $prices;
		
		//$this->load->view('start_quote',$data);
	}
}









?>