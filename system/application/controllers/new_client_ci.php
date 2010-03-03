<?php 

class New_client_ci extends Controller {
	
	function New_client_ci (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    { 		
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
			$data['ci_customer']=$_POST['ci_customer'];
			$this->load->view('new_client_ci',$data);
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
				$data['query'] = $this->client_model->add_new($data);
				$message_index['message_index']= 'success';
				$this->load->view('several_messages',$message_index);
		}
	}
}

?>