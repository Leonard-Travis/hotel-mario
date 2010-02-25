<?php
class New_client_controller extends Controller {
	
	function New_client_controller (){
		parent :: Controller();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		$rules['ci_client']	= "required";
		$rules['nombre']	= "required";
		$rules['apellido']	= "required";
		$rules['telefono']	= "required";
		$rules['email']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('new_client');
		}
		else
		{
			$ci_client = $_POST["ci_client"];
			$name_client = $_POST["nombre"];
			$lastname_client = $_POST["apellido"];
			$phone_client = $_POST["telefono"];
			$email_client = $_POST["email"];
			
			$this->load->model('find_model');
			$data['query'] = $this->find_model->index($ci_client);
			
			if ($data['query'])
				echo ('Ya existe un Cliente con ese número de cedula');
			else {
				$this->load->model('new_client');
				$this->new_client->index($ci_client, $name_client, $lastname_client, $phone_client, $email_client);
			}
			
			
			//$this->load->view('formsuccess');
		}
	}
}

?>