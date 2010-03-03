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
		$data['query'] = $this->plans->all();
		$this->load->view('management_plans', $data);
	}
}

?>