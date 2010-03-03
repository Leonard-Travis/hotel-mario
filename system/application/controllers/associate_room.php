<?php 

class Associate_room extends Controller {
	
	function Associate_room (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('hotels');
		$this->load->model('rooms');
	}
	
    function index()
    { 
		$rules['rooms']	= "required";
		$rules['hotel_id']	= "required";
		$rules['commissionable']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$hotel_selected_id = $_POST["hotel_id_aux"];
			
			//Get the rooms that belong to the hotel and all room types, then I see those that are not in common and put them in all_rooms array, wich is the one that receives the view
			$all_rooms = $this->rooms->all_types();
			$hotel_rooms = $this->hotels->all_rooms($hotel_selected_id);
			
			foreach ($all_rooms as $key => $value){
				foreach ($hotel_rooms as $key2 => $value2){
					if ($value['room_id'] == $value2['room_id']) {
						unset($all_rooms[$key]); 
					}
				}
			}
			$all_rooms = array_values($all_rooms);
			if (count($all_rooms) == 0){
				echo ('esta vacio');
			}
			else {
				$data['query'] = $this->hotels->find($hotel_selected_id);
				$data['rooms'] = $all_rooms;
				$this->load->view('associate_room',$data);
			}
			
		}
		else
		{
			$data2['room_id'] = $_POST["rooms"];
			$data2['hotel_id'] = $_POST["hotel_id"];
			$data2['commissionable'] = $_POST["commissionable"];
			
			$this->hotels->associate_room($data2);
			$data['hotel_selected'] = $this->hotels->find($data2['hotel_id']);
			$data['rooms'] = $this->hotels->all_rooms($data2['hotel_id']);
			$data['plans'] = $this->hotels->all_plans($data2['hotel_id']);
			$data['query'] = NULL;
			$this->load->view('management_hotels',$data);	
		}
	}
}

?>