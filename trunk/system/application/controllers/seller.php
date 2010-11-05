<?php 

class Seller extends Controller {
	
	function Seller (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library(array('validation', 'session', 'form_validation'));
		$this->load->model('seller_model');
	}
	
	function management(){
		$data['query'] = $this->seller_model->all_sellers();
		$this->load->view('management_sellers', $data);
	}
	
	function login(){
		$user_type = $_POST["user_type"];
		$user_id = $_POST["user_id"];
		$user_password = $_POST["user_password"];
		$user = $this->seller_model->login($user_type, $user_password, $user_id);

		if ($user){
			$newdata = array(
                   'type'  => $user_type,
                   'id'     => $user[0]['employees_id'],
				   'name' => $user[0]['name'],
				   'lastname' => $user[0]['lastname'],
                   'logged_in' => TRUE
               );
			$this->session->set_userdata($newdata);
			
			$this->load->view('home');
		}
		else echo('error1');
	}
	
	function new_seller(){
		$this->load->view('new_seller');
	}
	
	function add_seller(){
		$new = array (	'employees_id' => $_POST["id"],
					    'name' => $_POST["name"],
						'lastname' => $_POST["lastname"],
						'type' => $_POST["type"],
						'password' => $_POST["password"]);
		
		$this->seller_model->add($new);
		$this->management();
	}
}

?>