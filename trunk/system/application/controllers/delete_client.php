<?php 

class Delete_client extends Controller {
	
	function Delete_client (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    {
		$ci_client=$_POST['ci_customer'];
		$this->load->model('client_model');
		$data['query'] = $this->client_model->delete($ci_client);	
		$message_index['message_index']= 'deleted';
		$this->load->view('several_messages',$message_index);
		
	}
}

?>