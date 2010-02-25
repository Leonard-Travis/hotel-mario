<?php 

class Form_controller extends Controller {
	
	function Form_controller (){
		parent :: Controller();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		$data['query'] = NULL;
		$rules['ci_client']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('designed_views/asociar');
		}
		else
		{
			$ci_client = $_POST["ci_client"];
			$this->load->model('find_model');
			$data['query'] = $this->find_model->index($ci_client);
			
			if ($data['query'])
				$this->load->view('designed_views/asociar_client',$data);
			else 
				$this->load->view('new_client',$data);	
			
			
			
			//$this->load->view('formsuccess');
		}
	}
}

?>