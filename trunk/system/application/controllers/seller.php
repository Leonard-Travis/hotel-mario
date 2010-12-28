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
		$user_id = $_POST["user_id"];
		$user_password = $_POST["user_password"];

		$user = $this->seller_model->login($user_password, $user_id);

		if ($user){
			$newdata = array(
                   'type'  => $user[0]['type'],
                   'id'     => $user[0]['employees_id'],
				   'name' => $user[0]['name'],
				   'lastname' => $user[0]['lastname'],
				   'nick_name' => $user[0]['nick_name'],
				   'password' => $user[0]['password'],
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
		$possible = $this->seller_model->find($_POST["id"], "employees_id");
		$nick = $this->seller_model->find($_POST["nick"], "nick_name");
		
		if((count($possible) > 0) && ($possible[0]["status"] == "inactive")){
			$this->seller_model->update_status($_POST["id"], "active");
			$this->management();
		}
		elseif((count($possible) > 0) && ($possible[0]["status"] == "active")){
			echo "existing";
		}
		elseif(count($nick) > 0){
			echo "nick";
		}
		else{
			$new = array (	'employees_id' => $_POST["id"],
							'name' => $_POST["name"],
							'lastname' => $_POST["lastname"],
							'nick_name' => $_POST["nick"],
							'email' => $_POST["email"],
							'type' => $_POST["type"],
							'status' => "active",
							'password' => $_POST["password"]);
			
			$this->seller_model->add($new);
			$this->management();
		}
	}
	
	function delete_seller($employees_id){
		$this->seller_model->update_status($employees_id, "inactive");
		$this->management();
	}
	
	function options(){
		$data['emp'] = $this->seller_model->find($this->session->userdata('id'), "employees_id");
		$data['modify'] = 'not';
		$this->load->view('seller_options', $data);
		
	}
	
	//this function updates the information of an employee. The seller_options view works to print the information of the employee on a read only manner and on a modify manner (reused), that's why recieves the parameter 'modify' in 'yes' or 'not', and in the view there are several 'if' condition wheter or not 'modify' is on. 
	function modify(){
		$emp_id = $_POST["emp_id"];
		$process = $_POST["process"];//if it's 0 the modified process has begun, if it's 1 the process is endeed.
		$data['modify'] = 'yes';
		
		if($process == '0'){
			$data['emp'] = $this->seller_model->find($emp_id, "employees_id");
			$this->load->view('seller_options', $data);
		}
		else{
			$updated_info = array(	"employees_id" => $emp_id,
								  	"name" => $_POST["name"],
									"lastname" => $_POST["lastname"],
									"email" => $_POST["email"],
									"nick_name" => $_POST["nick_name"] );
			$this->seller_model->update($updated_info);	
		}
	}
	
	function change_password(){
		$process = $_POST["process"]; //Idem as modify function.
		
		if($process == 0){
			$this->load->view('seller_change_password');
		}
		else{
			$updated_info = array(	"employees_id" => $this->session->userdata('id'),
								  	"password" => $_POST["new_password"]);
			$this->seller_model->update($updated_info);	
		}
	}
}

?>