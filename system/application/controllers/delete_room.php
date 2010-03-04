<?php 

class Delete_room extends Controller {
	
	function Delete_room (){
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

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->rooms->all_types();
			$this->load->view('delete_room',$data);
		}
		else
		{
			$room_selected_id = $_POST["rooms"];
			
			//First looks if that room is in a quotation, and if it is, it cant be eliminated
			
			$rooms_in_quote = $this->rooms->room_in_quote($room_selected_id);
			
			if ($rooms_in_quote){	
				$message_index['quote_id']= $rooms_in_quote;
				$message_index['message_index']= 'cant_delet';
				$this->load->view('several_messages',$message_index);
			}
			else {
				$data['query'] = $this->rooms->delete($room_selected_id);	
				$data['query'] = $this->rooms->all_types();
				$this->load->view('management_rooms', $data);

			}
			
		}		
	}
}

?>