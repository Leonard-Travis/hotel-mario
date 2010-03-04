<?php 

class Management_plans extends Controller {
	
	function Management_plans (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('plans');
	}

    function index()
    { 
		//shows the three options to remove, add and modify and simultaneously displays all the plans stored in system
		$data['query'] = $this->plans->all();
		$this->load->view('management_plans', $data);
	}
}

?>