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
		
		$data['package'] = $packages;
		$categorie = $this->packages_model->categorie($categorie_id);
		foreach($categorie as $categorie) 	$data['categorie_name'] = $categorie['name_spanish'];
		
		$this->load->view('categorie_packages', $data);
		
	}
	
	function package_details(){
		$pack_id = $_POST["pack_id"];
		$pack_rooms = array();
		
		$rooms = $this->packages_model->package_rooms($pack_id);
		
		foreach($rooms as $room)		$pack_rooms[count($pack_rooms)] = $room;
		
		$pack = $this->packages_model->find($pack_id);
		
		foreach($pack as $pack) 		$data['description'] = $pack['description'];
		
		$data['rooms'] = $pack_rooms;
		$this->load->view('package_details', $data);
	}
	
	function new_package($room, $hotel){
		$data['counter'] = $_POST["count"];
		
		if($room == '1') {
			$data['query'] = $this->hotels_model->all_hotels();
			$this->load->view('new_package', $data);
		}
		elseif ($room == '0') {
			$data['hotel_id'] = $_POST["hotel_id"];
			$data['rooms'] = $this->hotels_model->all_rooms($data['hotel_id']);
			$data['new_package_room_frame'] = $hotel;
			$this->load->view('new_package_room', $data);
		}
	}
	
	function package_categories(){
		$data['number_of_categories'] = $_POST["number_of_categories"];
		$data['categories'] = $this->packages_model->all_categories();
		$this->load->view('package_categories', $data);
	}
	
	function add_package(){
		$package['package_id'] = '';
		$package['HOTEL_id'] = $_POST["hotel"];
		$package['name'] = $_POST["name"];
		$package['date_start'] = $_POST["date_start"];
		$package['date_end'] = $_POST["date_end"];
		$package['description'] = $_POST["description"];
		$categories = $_POST["categories"];
		$rooms = $_POST["rooms"];
		
		$categories_array = array();
		$categories_array = explode('|', $categories);
		
		$rooms_array = array();
		$rooms_array = explode('||', $rooms);
		
		for($i=0; $i<count($rooms_array); $i++){
			$room_aux = array();
			$room_aux = explode('|', $rooms_array[$i]);
			$rooms_array[$i] = $room_aux;
		}
		
		$this->packages_model->add_package($package, $rooms_array, $categories_array);
		$this->index();
		//$this->categorie_packages($categories_array[0]);
	}
}

?>