<?php 

class Rooms extends Controller {
	
	function Rooms (){
		parent :: Controller();	
		$this->load->helper(array('form','url'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('rooms_model');
	}

    function index()
    { 
		//the management_rooms shows the three options (add, delete, modify) and simultaneously samples all rooms
		
		$data['query'] = $this->rooms_model->all_types();
		$this->load->view('management_rooms', $data);
	}
	
	function modify_room ($room_id){
		$data['room_to_change'] = $this->rooms_model->find($room_id);
		$this->load->view('modify_rooms',$data);				
	} 
	
	function new_room()
    { 
		$rules['name']	= "required";
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
			$data ['capacity'] = $_POST["capacity"];
			$data ['special'] = $_POST["special"];
			
			$data['query'] = $this->rooms_model->add_new($data);
			$data['query'] = $this->rooms_model->all_types();
			$this->load->view('management_rooms', $data);
		}
	}
	
	 function delete_room($room_id)
    {
		//First looks if that room is in a quotation, and if it is, it cant be eliminated
		
		$rooms_in_quote = $this->rooms_model->room_in_quote($room_id);
		
		if ($rooms_in_quote){	
			$message_index['quote_id']= $rooms_in_quote;
			$message_index['message_index']= 'cant_delet_room';
			$this->load->view('several_messages',$message_index);
		}
		else {
			$data['query'] = $this->rooms_model->delete($room_id);	
			$data['query'] = $this->rooms_model->all_types();
			$this->load->view('management_rooms', $data);

		}		
	}
	
	function save_modified_room()
    { 
		$data ['name'] = $_POST["name"];
		$data ['capacity'] = $_POST["capacity"];
		$data ['room_id'] = $_POST["room_id"];
		$data ['special'] = $_POST["special"];
		
		$data['query'] = $this->rooms_model->update_info($data);
		$data['query'] = $this->rooms_model->all_types();
		$this->load->view('management_rooms', $data);
	}
}

?>