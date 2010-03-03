<?php 

class Delete_plan extends Controller {
	
	function Delete_plan (){
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

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->plans->all();
			$this->load->view('delete_plan',$data);
		}
		else
		{
			$plan_selected_id = $_POST["plans"];
			
			$data['query'] = $this->plans->delete($plan_selected_id);	
			$data['query'] = $this->plans->all();
			$this->load->view('management_plans', $data);			
			
		}		
	}
}

?>