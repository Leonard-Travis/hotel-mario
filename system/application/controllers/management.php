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
		$this->load->view('management');
		
	}
}

?>