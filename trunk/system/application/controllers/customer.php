<?php 

class Customer extends Controller {
	
	function Customer (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function search_form()
    { 
		//Here it load the search form in the client view. After the search is made, the view receives a parameter called $client which contains all costumer information to be displayed as read only in the client view. 
		
		$data['query'] = NULL;		
		
		$rules['ci_client']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('client',$data);
		}
		else
		{
			$ci_client = $_POST["ci_client"];
			$this->load->model('client_model');
			$data['query'] = $this->client_model->find($ci_client);
			
		// If the C.I. does not exist in database is displayed an error message and gives the opportunity to add the new costumer	
			
			if ($data['query'])
				$this->load->view('client',$data);
			else {
				$message_index['new_ci'] = $ci_client;
				$message_index['message_index']= 'unknown';
				$this->load->view('several_messages',$message_index);
			}
		}
	}
	
	function delete_client()
    {
		//By now I'm working only with basic information of the client, later it will modify and delete all data related to that customer quotes.
		
		$ci_client=$_POST['ci_client'];
		$this->load->model('client_model');
		$data['query'] = $this->client_model->delete($ci_client);	
		$message_index['message_index']= 'deleted';
		$this->load->view('several_messages',$message_index);
		
	}
	
	function modify_client()
    { 
		//Displays all the information of the costumer in the modify_client view but this time it is editable
		
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
			$ci_client=$_POST['ci_client'];
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
			$data['query'] = $this->client_model->update_info($data);
			$this->search_form();
			//$message_index['message_index']= 'update';
			//$this->load->view('several_messages',$message_index);
			
		}
	}
	
	function new_client()
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
	
    function new_client_ci()
    { 		
		//the difference between new_client and new_cient_ci is that new_cient_ci displays the information with the new customer CI already place on the form

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