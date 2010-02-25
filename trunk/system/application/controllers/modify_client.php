<?php 

class Modify_client extends Controller {
	
	function Modify_client (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		echo ('antes post');
		$ci_client = $_POST["ci_customer"];
		echo ($ci_client);
		echo ('dspues post');
		$rules['ci_client']	= "required";
		$rules['nombre']	= "required";
		$rules['apellido']	= "required";
		$rules['direccion']	= "required";
		$rules['tlf']	= "required";
		$rules['email']	= "required";
		$rules['fecha']	= "required";
		$rules['sexo']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			
			$this->load->model('client_model');
			$data['query'] = $this->client_model->find($ci_client);			
			$this->load->view('modify_client',$data);
		}
		else
		{
			$data ['ci_client'] = $_POST["ci_client"];
			$data ['name'] = $_POST["nombre"];
			$data ['lastname'] = $_POST["apellido"];
			$data ['address'] = $_POST["direccion"];
			$data ['phone'] = $_POST["tlf"];
			$data ['email'] = $_POST["email"];
			$data ['birth_date'] = $_POST["fecha"];
			$data ['sex'] = $_POST["sexo"];
			
			$this->load->model('client_model');
			$data['query'] = $this->client_model->add($data);
			$message_index['message_index']= 'success';
			$this->load->view('several_messages',$message_index);
			
		}
	}
}

?>