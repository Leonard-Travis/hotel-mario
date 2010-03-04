<?php 

class Management_rooms extends Controller {
	
	function Management_rooms (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('rooms');
	}

    function index()
    { 
		//the management_rooms shows the three options (add, delete, modify) and simultaneously samples all rooms
		
		$data['query'] = $this->rooms->all_types();
		$this->load->view('management_rooms', $data);
	}
}

?>