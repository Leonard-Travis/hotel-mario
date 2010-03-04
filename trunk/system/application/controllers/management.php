<?php 

class Management extends Controller {
	
	function Management (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    {
		//This is the management area where the user will be able to manage (add,modify and delete) rooms, plans, hotels (hotels can not be eliminated) etc.
		
		$this->load->view('management');
		
	}
}

?>