<?php 

class Save_modified_room extends Controller {
	
	function Save_modified_room (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		$data ['name'] = $_POST["name"];
		$data ['capacity'] = $_POST["capacity"];
		$data ['description'] = $_POST["description"];
		$data ['room_id'] = $_POST["room_id"];
		$data ['special'] = $_POST["special"];
		
		$this->load->model('rooms');
		$data['query'] = $this->rooms->update_info($data);
		$data['query'] = $this->rooms->all_types();
		$this->load->view('management_rooms', $data);
	}
}

?>