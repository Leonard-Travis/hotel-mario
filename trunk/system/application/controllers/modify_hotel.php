<?php 

class Modify_hotel extends Controller {
	
	function Modify_hotel (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('hotels');
	}
	
    function index()
    { 
		$rules['hotel_id']	= "required";
		$rules['name']	= "required";
		$rules['location']	= "required";
		$rules['rooms']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$hotel_selected_id = $_POST["hotel_id"];
			$data['rooms'] = $this->hotels->all_rooms($hotel_selected_id);
			$data['plans'] = $this->hotels->all_plans($hotel_selected_id);
			$data['query'] = $this->hotels->find($hotel_selected_id);
			$this->load->view('modify_hotel',$data);
		}
		else
		{
			$data['name'] = $_POST["name"];
			$data['location'] = $_POST["location"];
			$data['hotel_id'] = $_POST["hotel_id"];
			$room = $_POST["rooms"];
			$plan = $_POST["plans"];
			
			if ($room != '-')	$this->hotels->delete_room_from_hotel($data['hotel_id'], $room);
			if ($plan != '-')	$this->hotels->delete_plan_from_hotel($data['hotel_id'], $plan);
			$this->hotels->update_info($data);
			$data2['hotel_selected'] = $this->hotels->find($data['hotel_id']);
			$data2['rooms'] = $this->hotels->all_rooms($data['hotel_id']);
			$data2['plans'] = $this->hotels->all_plans($data['hotel_id']);
			$data2['query'] = NULL;
			$this->load->view('management_hotels',$data2);
			
		}
	}
}
