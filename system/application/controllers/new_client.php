<?php 

class New_client extends Controller {
	
	function New_client (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 
		$data['query'] = NULL;
		
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
			$this->load->view('new_client',$data);
		}
		else
		{
			$data['exist'] = NULL;
			$data ['ci_client'] = $_POST["ci_client"];
			$data ['name'] = $_POST["nombre"];
			$data ['lastname'] = $_POST["apellido"];
			$data ['address'] = $_POST["direccion"];
			$data ['phone'] = $_POST["tlf"];
			$data ['email'] = $_POST["email"];
			$data ['birth_date'] = $_POST["fecha"];
			$data ['sex'] = $_POST["sexo"];
			
			$this->load->model('client_model');
			$data['exist'] = $this->client_model->find($data ['ci_client']); 
			
		//it search the id (ci) in the database, if there is, it displayed an error message	
			if ($data['exist']){
				$message_index['message_index']= 'exist';
				$this->load->view('several_messages',$message_index);
			}
			else {
				$data['query'] = $this->client_model->add_new($data);
				$message_index['message_index']= 'success';
				$this->load->view('several_messages',$message_index);
			}
			
		}
	}
}

?>