<?php 

class Modify_room extends Controller {
	
	function Modify_room (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('rooms');
	}

    function index()
    { 
		$rules['rooms']	= "required";
		$this->validation->set_rules($rules);
		$data['room_to_change'] = NULL;

		if ($this->validation->run() == FALSE)
		{
			
			$data['query'] = $this->rooms->all_types();
			$this->load->view('modify_rooms',$data);
		}
		else
		{
			$data['query'] = NULL;
			$room_selected_id = $_POST["rooms"];
			$data['room_to_change'] = $this->rooms->find($room_selected_id);
			$this->load->view('modify_rooms',$data);			
			
		}
	}
}

?>