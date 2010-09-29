<?php 

class Customer extends Controller {
	
	function Customer (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model(array('client_model', 'quotations_model'));
	}

    function search_form()
    { 
		//Here it load the search form in the client view. After the search is made, the view receives a parameter called $client which contains all costumer information to be displayed as read only in the client view. 		
		
		$rules['ci_client']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('client');
		}
		else
		{
			$ci_client = $_POST["ci_client"];
			$data['query'] = $this->client_model->find($ci_client);
			
		// If the C.I. does not exist in database is displayed an error message and gives the opportunity to add the new costumer	
			
			if ($data['query'])			$this->load->view('client_data',$data);
			else 						echo('non_existent');
		}
	}
	
	function delete_client($ci_client)
    {
		//By now I'm working only with basic information of the client, later it will modify and delete all data related to that customer quotes.
		$data['query'] = $this->client_model->delete($ci_client);		
	}
	
	function modify_client()
    { 
		//Displays all the information of the costumer in the modify_client view but this time it is editable
		
		$rules['ci_client']	= "required";
		$rules['name']	= "required";
		$rules['lastname']	= "required";
		$rules['address']	= "required";
		$rules['phone']	= "required";
		$rules['email']	= "required";
		$rules['birthdate']	= "required";
		$rules['sex']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$ci_client=$_POST['ci_client'];
			$data['query'] = $this->client_model->find($ci_client);			
			$this->load->view('modify_client',$data);
		}
		else
		{
			$data ['ci_client'] = $_POST["ci_client"];
			$data ['name'] = $_POST["name"];
			$data ['lastname'] = $_POST["lastname"];
			$data ['address'] = $_POST["address"];
			$data ['phone'] = $_POST["phone"];
			$data ['email'] = $_POST["email"];
			$data ['birth_date'] = $_POST["birthdate"];
			$data ['sex'] = $_POST["sex"];
	
			$data['query'] = $this->client_model->update_info($data);			
		}
	}
	
	function new_client($ci_client)
    { 
		$rules['ci_client']	= "required";
		$rules['name']	= "required";
		$rules['lastname']	= "required";
		$rules['address']	= "required";
		$rules['phone']	= "required";
		$rules['email']	= "required";
		$rules['birthdate']	= "required";
		$rules['sex']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$data['ci_client'] = $ci_client;
			$this->load->view('new_client',$data);
		}
		else
		{
			$data['ci_client'] = $_POST["ci_client"];
			$data['name'] = $_POST["name"];
			$data['lastname'] = $_POST["lastname"];
			$data['address'] = $_POST["address"];
			$data['phone'] = $_POST["phone"];
			$data['email'] = $_POST["email"];
			$data['birthdate'] = $_POST["birthdate"];
			$data['sex'] = $_POST["sex"];
			
			$prospect = $this->client_model->find($data['ci_client']); 
			
		//it search the id (ci) in the database, if there is, it displayed an error message	
			if ($prospect)	echo('exist');
			else 			$data['query'] = $this->client_model->add_new($data);
			
		}
	}
	
	function existing_quotation(){
		$customer_id = $_POST["customer"];
		$data['quotations'] = $this->client_model->existing_quotation($customer_id);
		$this->load->view('existing_quotations', $data);
	}
	
	function existing_quote_details(){
		$quote_id = $_POST["quote_id"];
		$data = array ('hotel' => NULL, 'flight' => NULL, 'generic' => NULL);
		$quote = $this->quotations_model->find_quote($quote_id, '_admin_quotations', 'quote_id');
		foreach($quote as $quote){
			if ($quote['QUOTATIONS_HOTELS_id']) {
				$data['hotel'] = $this->quotations_model->find_quote($quote['QUOTATIONS_HOTELS_id'], '_admin_quotations_hotels', 'quote_hotel_id');
				$data['hotel'] = $this->quotations_model->quote_hotel_data($data['hotel']);
			}
			
			
			if ($quote['QUOTATIONS_FLIGHTS_id']) {
				$data['flight'] = $this->quotations_model->find_quote($quote['QUOTATIONS_FLIGHTS_id'], '_admin_quotations_flights', 'quote_flight_id');
				$data['flight'] = $this->quotations_model->quote_flight_data($data['flight']);
				
			}
			
			if ($quote['QUOTATIONS_GENERIC_id']){ 
				$data['generic'] = $this->quotations_model->find_quote($quote['QUOTATIONS_GENERIC_id'], '_admin_quotations_generic', 'quotes_generic_id');
				$data['generic'] = $this->quotations_model->quote_generic_data($data['generic']);
			}
		}
		$this->load->view('existing_quote_details', $data);
	}
}

?>