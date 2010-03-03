<?php 

class Modify_plan extends Controller {
	
	function Modify_plan (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('plans');
	}

    function index()
    { 
		$rules['plans']	= "required";
		$this->validation->set_rules($rules);
		$data['plan_to_change'] = NULL;

		if ($this->validation->run() == FALSE)
		{
			
			$data['query'] = $this->plans->all();
			$this->load->view('modify_plan',$data);
		}
		else
		{
			$data['query'] = NULL;
			$plan_selected_id = $_POST["plans"];
			$data['plan_to_change'] = $this->plans->find($plan_selected_id);
			$this->load->view('modify_plan',$data);			
			
		}
	}
}

?>