<?php 

class Hotels extends Controller {
	
	function Hotels (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model(array('hotels_model','plans_model','rooms_model'));
	}
	
	//First of all the user must choose a hotel and then it will be displayed all the attributes of this (including all the rooms and plans related with the hotel)
    function index()
    { 
		$rules['hotels']	= "required";
		$this->validation->set_rules($rules);
		$data['hotel_selected'] = NULL;

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->hotels_model->all_hotels();
			$this->load->view('management_hotels',$data);
		}
		else
		{
			$data['query'] = NULL;
			$hotel_selected_id = $_POST["hotels"];
			$data['rooms'] = $this->hotels_model->all_rooms($hotel_selected_id);
			$data['plans'] = $this->hotels_model->all_plans($hotel_selected_id);
			$data['hotel_selected'] = $this->hotels_model->find($hotel_selected_id);
			$this->load->view('management_hotels',$data);			
			
		}
	}
	
	function associate_plan()
    { 
		$rules['plans']	= "required";
		$rules['hotel_id']	= "required";
		$rules['description']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$hotel_selected_id = $_POST["hotel_id"];
			
			//Get the plans that belong to the hotel and all plan types, then I see those that are not in common and put them in all_plans array, wich is the one that receives the view
			$all_plans = $this->plans_model->all();
			$hotel_plans = $this->hotels_model->all_plans($hotel_selected_id);
			
			foreach ($all_plans as $key => $value){
				foreach ($hotel_plans as $key2 => $value2){
					if ($value['plan_id'] == $value2['plan_id']) {
						unset($all_plans[$key]); 
					}
				}
			}
			$all_plans = array_values($all_plans);
			if (count($all_plans) == 0){
				$message_index['message_index']= 'no_plans_left';
				$this->load->view('several_messages',$message_index);
			}
			else {
				$data['query'] = $this->hotels_model->find($hotel_selected_id);
				$data['plans'] = $all_plans;
				$this->load->view('associate_plan',$data);
			}
			
		}
		else
		{
			$data2['plan_id'] = $_POST["plans"];
			$data2['hotel_id'] = $_POST["hotel_id"];
			$data2['description'] = $_POST["description"];
			
			$this->hotels_model->associate_plan($data2);
			$data['hotel_selected'] = $this->hotels_model->find($data2['hotel_id']);
			$data['rooms'] = $this->hotels_model->all_rooms($data2['hotel_id']);
			$data['plans'] = $this->hotels_model->all_plans($data2['hotel_id']);
			$data['query'] = NULL;
			$this->load->view('management_hotels',$data);	
		}
	}
	
	function associate_room()
    { 
		$rules['rooms']	= "required";
		$rules['hotel_id']	= "required";
		$rules['commissionable']	= "required";
		$rules['description']	= "required";
		$rules['capacity']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$hotel_selected_id = $_POST["hotel_id"];
			
			//Get the rooms that belong to the hotel and all room types, then I see those that are not in common and put them in all_rooms array, wich is the one that receives the view
			
			$all_rooms = $this->rooms_model->all_types();
			$hotel_rooms = $this->hotels_model->all_rooms($hotel_selected_id);
			
			foreach ($all_rooms as $key => $value){
				foreach ($hotel_rooms as $key2 => $value2){
					if ($value['room_id'] == $value2['room_id']) {
						unset($all_rooms[$key]); 
					}
				}
			}
			$all_rooms = array_values($all_rooms);
			if (count($all_rooms) == 0){
				$message_index['message_index']= 'no_rooms_left';
				$this->load->view('several_messages',$message_index);
			}
			else {
				$data['query'] = $this->hotels_model->find($hotel_selected_id);
				$data['rooms'] = $all_rooms;
				$this->load->view('associate_room',$data);
			}
			
		}
		else
		{
			$data2['room_id'] = $_POST["rooms"];
			$data2['hotel_id'] = $_POST["hotel_id"];
			$data2['description'] = $_POST["description"];
			$data2['commissionable'] = $_POST["commissionable"];
			$data2['capacity'] = $_POST["capacity"];
			
			$this->hotels_model->associate_room($data2);
			$data['hotel_selected'] = $this->hotels_model->find($data2['hotel_id']);
			$data['rooms'] = $this->hotels_model->all_rooms($data2['hotel_id']);
			$data['plans'] = $this->hotels_model->all_plans($data2['hotel_id']);
			$data['query'] = NULL;
			$this->load->view('management_hotels',$data);	
		}
	}
	
	function modify_hotel($hotel_selected_id)
    { 
		
		$rules['hotel_id']	= "required";
		$rules['name']	= "required";
		$rules['location']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->hotels_model->find($hotel_selected_id);
			$this->load->view('modify_hotel',$data);
		}
		else
		{
			$data['name'] = $_POST["name"];
			$data['location'] = $_POST["location"];
			$data['hotel_id'] = $_POST["hotel_id"];
			
			$this->hotels_model->update_info($data);
			$data2['hotel_selected'] = $this->hotels_model->find($data['hotel_id']);
			$data2['rooms'] = $this->hotels_model->all_rooms($data['hotel_id']);
			$data2['plans'] = $this->hotels_model->all_plans($data['hotel_id']);
			$data2['query'] = NULL;
			$this->load->view('management_hotels',$data2);
			
		}
	}
	
	function disassociate_room ($room_id, $hotel_id){
		/*$data['hotel'] = $this->hotels_model->find($hotel_id);
		$data['room'] = $this->rooms_model->find($room_id);
		$data['message_index'] = 'disassociate_room';
		$this->load->view('several_messages',$data);*/
		
		$rooms_hotels_id = $this->hotels_model->find_rooms_hotels ($hotel_id, $room_id);
		foreach ($rooms_hotels_id as $rooms_hotels_id)
			$this->hotels_model->delete_room_from_hotel($rooms_hotels_id['rooms_hotels_id']);
		$data2['hotel_selected'] = $this->hotels_model->find($hotel_id);
		$data2['rooms'] = $this->hotels_model->all_rooms($hotel_id);
		$data2['plans'] = $this->hotels_model->all_plans($hotel_id);
		$data2['query'] = NULL;
		$this->load->view('management_hotels',$data2);
	}
	
	function disassociate_plan ($plan_id, $hotel_id){
		/*$data['hotel'] = $this->hotels_model->find($hotel_id);
		$data['room'] = $this->rooms_model->find($room_id);
		$data['message_index'] = 'disassociate_room';
		$this->load->view('several_messages',$data);*/

		$this->hotels_model->delete_plan_from_hotel($hotel_id, $plan_id);
		$data2['hotel_selected'] = $this->hotels_model->find($hotel_id);
		$data2['rooms'] = $this->hotels_model->all_rooms($hotel_id);
		$data2['plans'] = $this->hotels_model->all_plans($hotel_id);
		$data2['query'] = NULL;
		$this->load->view('management_hotels',$data2);
	}
}

?>