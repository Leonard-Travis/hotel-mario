<?php 

class Packages extends Controller {
	
	function Packages (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library(array('validation', 'session', 'form_validation'));
		$this->load->model(array('hotels_model', 'packages_model'));
	}
	
	function index(){
		$data['query'] = $this->packages_model->all_categories();
		$this->load->view('management_packages', $data);
	}
	
	function categorie_packages($cat_aux){
		if($cat_aux != '0') $categorie_id = $cat_aux;
		else 				$categorie_id = $_POST["categorie_id"];
		
		$packages = $this->packages_model->categorie_packages($categorie_id);		
		
		for($i=0; $i<count($packages);$i++){
			$lowest_price = $this->packages_model->select_lowest_price($packages[$i]['package_id']);
			foreach($lowest_price as $price) $packages[$i]['since_price'] = $price['price_per_person'];
		}		
		
		$data['package'] = $packages;
		$categorie = $this->packages_model->categorie($categorie_id);
		foreach($categorie as $categorie) 	$data['categorie_name'] = $categorie['name_spanish'];
		
		$this->load->view('all_packages_from_categorie', $data);
		
	}
	
	function package_details(){
		$pack_id = $_POST["pack_id"];
		$pack_rooms = array();
		
		$rooms = $this->packages_model->package_rooms($pack_id);
		
		foreach($rooms as $room)		$pack_rooms[count($pack_rooms)] = $room;
		
		$pack = $this->packages_model->find($pack_id);
		
		foreach($pack as $pack){
			$data['description'] = $pack['description'];
			$data['days_nights'] = $pack['number_of_days'].' D&iacute;as / '.$pack['number_of_nights'].' Noches';
		}
		
		$data['rooms'] = $pack_rooms;
		$this->load->view('package_details', $data);
	}
	
	function new_package($room, $hotel){
		$data['counter'] = $_POST["count"];
			
		if($room == '1') {
			//$data['query'] = $this->hotels_model->all_hotels();
			$this->load->view('new_package');
		}
		elseif ($room == '0') {
			$data['hotel_id'] = $_POST["hotel_id"];
			$data['number_of_hotel'] = $_POST["number_of_hotel"];
			$data['rooms'] = $this->hotels_model->all_rooms($data['hotel_id']);
			$data['new_package_room_frame'] = $hotel;
			$this->load->view('new_package_room', $data);
		}
	}
	
	function new_package_hotels($hotels){
		if($hotels == '1'){
			$data['number_of_hotels'] = NULL;
			$data['query'] = NULL;
			$this->load->view('new_package_hotels', $data);
		}
		elseif($hotels == '0') {
			$data['number_of_hotels'] = $_POST["number_of_hotels"];
			$data['query'] = $this->hotels_model->all_hotels();
			$this->load->view('new_package_hotels', $data);
		}
	}
	
	function package_categories(){
		$data['number_of_categories'] = $_POST["number_of_categories"];
		$data['categories'] = $this->packages_model->all_categories();
		$this->load->view('package_categories', $data);
	}
	
	function add_package(){
		$package['package_id'] = '';
		$package['name'] = $_POST["name"];
		$package['date_start'] = $_POST["date_start"];
		$package['date_end'] = $_POST["date_end"];
		$package['description'] = $_POST["description"];
		$package['number_of_days'] = $_POST["days"];
		$package['number_of_nights'] = $_POST["nights"];
		$categories = $_POST["categories"];
		$rooms = $_POST["rooms"]; //hotel_id||room1|priceAdult|priceKid|priceAdditional||room2|price2|priceAdult|priceKid|priceAdditional|||hotel_id|room1|price1||...|||
		
		$categories_array = array();
		$categories_array = explode('|', $categories);
		
		$array3 = array(); //momentarily storage location to every 3 sticks division
		$array2 = array(); //momentarily storage location to every 2 sticks division
		
		$rooms_array = array(); //final array
		
		$array3 = explode('|||',$rooms);
		
		for($i=0; $i < count($array3); $i++){
			$pos = count($rooms_array);
			
			$array2 = explode('||', $array3[$i]);
			
			$rooms_array[$pos] = array();
			$rooms_array[$pos]['hotel'] = $array2[0];
			
			for($f=1; $f < count($array2); $f++){
				$pos2 = ('room'.$f);
				$rooms_array[$pos][$pos2] = array();
				$rooms_array[$pos][$pos2] = explode('|', $array2[$f]);
			}
		}
		
		$this->packages_model->add_package($package, $rooms_array, $categories_array);
		$this->index();
	}
}

?>