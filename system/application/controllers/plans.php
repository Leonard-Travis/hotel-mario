<?php 

class Plans extends Controller {
	
	function Plans (){
		parent :: Controller();	
		$this->load->helper(array('form','url'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('plans_model');
	}

    function index()
    { 
		//shows the three options to remove, add and modify and simultaneously displays all the plans stored in system
		$data['query'] = $this->plans_model->all();
		$this->load->view('management_plans', $data);
	}
	
	function delete_plan($plan_id)
    {
		$data['query'] = $this->plans_model->delete($plan_id);	
		$data['query'] = $this->plans_model->all();
		$this->load->view('management_plans', $data);
	}
	
	function modify_plan($plan_id)
    { 
		$data['plan_to_change'] = $this->plans_model->find($plan_id);
		$this->load->view('modify_plan',$data);			
	}
	
	function new_plan()
    { 
		$rules['name']	= "required";
		$rules['name_english']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->load->view('new_plan');
		}
		else
		{
			$data ['name_spanish'] = $_POST["name"];
			$data ['name_english'] = $_POST["name_english"];
			
			$plan_inactive= $this->plans_model->find_plan_inactive($data ['name_english'], $data ['name_spanish']);
			if ($plan_inactive){
				foreach ($plan_inactive as $plan_inactive)
					$this->plans_model->active_plan($plan_inactive['plan_id']);	
			}
			else{
				$data['query'] = $this->plans_model->add_new($data);
			}
			
			$data['query'] = $this->plans_model->all();
			$this->load->view('management_plans', $data);
		}
	}
	
	function save_modified_plan()
    { 
		$plan_id = $_POST["plan_id"];
		$rules['name']	= "required";
		$rules['name_english']	= "required";
		$this->validation->set_rules($rules);
		
		if ($this->validation->run() == FALSE)
		{
			$this->modify_plan($plan_id);
		}
		else{		
			$data ['name_spanish'] = $_POST["name"];
			$data ['name_english'] = $_POST["name_english"];
			$data ['plan_id'] = $plan_id;
			$data['query'] = $this->plans_model->update_info($data);
			$data['query'] = $this->plans_model->all();
			$this->load->view('management_plans', $data);
		}
	}
}

?>