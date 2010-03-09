<?php 

class Form_controller extends Controller {
	
	function Form_controller (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		//Here it load the search form in the client view. After the search is made, the view receives a parameter called $client which contains all costumer information to be displayed as read only in the client view. 
		
		$data['query'] = NULL;		
		
		$rules['ci_client']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('client',$data);
		}
		else
		{
			$ci_client = $_POST["ci_client"];
			$this->load->model('client_model');
			$data['query'] = $this->client_model->find($ci_client);
			
		// If the C.I. does not exist in database is displayed an error message and gives the opportunity to add the new costumer	
			
			if ($data['query'])
				$this->load->view('client',$data);
			else {
				$message_index['new_ci'] = $ci_client;
				$message_index['message_index']= 'unknown';
				$this->load->view('several_messages',$message_index);
			}
		}
	}
}

?>