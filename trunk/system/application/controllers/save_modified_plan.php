<?php 

class Save_modified_plan extends Controller {
	
	function Save_modified_plan (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		$data ['name'] = $_POST["name"];
		$data ['description'] = $_POST["description"];
		$data ['plan_id'] = $_POST["plan_id"];
		
		$this->load->model('plans');
		$data['query'] = $this->plans->update_info($data);
		$data['query'] = $this->plans->all();
		$this->load->view('management_plans', $data);
	}
}

?>