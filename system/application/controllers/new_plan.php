<?php 

class New_plan extends Controller {
	
	function New_plan (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('plans');
	}

    function index()
    { 
		$rules['name']	= "required";
		$rules['description']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('new_plan');
		}
		else
		{
			$data ['name'] = $_POST["name"];
			$data ['description'] = $_POST["description"];
			
			$data['query'] = $this->plans->add_new($data);
			$data['query'] = $this->plans->all();
			$this->load->view('management_plans', $data);
		}
	}
}
?>