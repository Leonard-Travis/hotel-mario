<?php 

class Management_hotels extends Controller {
	
	function Management_hotels (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('hotels');
	}
	
	//First of all the user must choose a hotel and then it will be displayed all the attributes of this (including all the rooms and plans related with the hotel)
    function index()
    { 
		$rules['hotels']	= "required";
		$this->validation->set_rules($rules);
		$data['hotel_selected'] = NULL;

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->hotels->all_hotels();
			$this->load->view('management_hotels',$data);
		}
		else
		{
			$data['query'] = NULL;
			$hotel_selected_id = $_POST["hotels"];
			$data['rooms'] = $this->hotels->all_rooms($hotel_selected_id);
			$data['plans'] = $this->hotels->all_plans($hotel_selected_id);
			$data['hotel_selected'] = $this->hotels->find($hotel_selected_id);
			$this->load->view('management_hotels',$data);			
			
		}
	}
}

?>