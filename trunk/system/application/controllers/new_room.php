<?php 

class New_room extends Controller {
	
	function New_room (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('rooms');
	}

    function index()
    { 
		$rules['name']	= "required";
		$rules['description']	= "required";
		$rules['special']	= "required";
		$rules['capacity']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('new_room');
		}
		else
		{
			$data ['name'] = $_POST["name"];
			$data ['description'] = $_POST["description"];
			$data ['capacity'] = $_POST["capacity"];
			$data ['special'] = $_POST["special"];
			
			$data['query'] = $this->rooms->add_new($data);
			$data['query'] = $this->rooms->all_types();
			$this->load->view('management_rooms', $data);
		}
	}
}
?>