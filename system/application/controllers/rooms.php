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
		$rules['name_english']	= "required";
		$rules['special']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('new_room');
		}
		else
		{
			$data ['name_spanish'] = $_POST["name"];
			$data ['name_english'] = $_POST["name_english"];
			$data ['special'] = $_POST["special"];
			
			$room_inactive = $this->rooms_model->find_room_inactive($data['name_english'], $data['name_spanish']);
			if ($room_inactive){
				foreach ($room_inactive as $room_inactive)
					$this->rooms_model->active_room($room_inactive['room_id']);	
			}
			else{
				$data['query'] = $this->rooms_model->add_new($data);
			}
			
			$data['query'] = $this->rooms_model->all_types();
			$this->load->view('management_rooms', $data);
		}
	}
	
	 function delete_room($room_id)
    {
		//set 'inactive' status in rooms table and in rooms_hotels table in every record that belongs to the room
		$data['query'] = $this->rooms_model->delete($room_id);	
		$data['query'] = $this->rooms_model->all_types();
		$this->load->view('management_rooms', $data);		
	}
	
	function save_modified_room()
    { 
		$data ['name_spanish'] = $_POST["name"];
		$data ['name_english'] = $_POST["name_english"];
		$data ['room_id'] = $_POST["room_id"];
		$data ['special'] = $_POST["special"];
		
		$data['query'] = $this->rooms_model->update_info($data);
		$data['query'] = $this->rooms_model->all_types();
		$this->load->view('management_rooms', $data);
	}
}

?>