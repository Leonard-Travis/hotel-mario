<?php 

class Associate_plan extends Controller {
	
	function Associate_plan (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('hotels');
		$this->load->model('plans');
	}
	
    function index()
    { 
		$rules['plans']	= "required";
		$rules['hotel_id']	= "required";
		$this->validation->set_rules($rules);

		if ($this->validation->run() == FALSE)
		{
			$hotel_selected_id = $_POST["hotel_id_aux"];
			
			//Get the plans that belong to the hotel and all plan types, then I see those that are not in common and put them in all_plans array, wich is the one that receives the view
			$all_plans = $this->plans->all();
			$hotel_plans = $this->hotels->all_plans($hotel_selected_id);
			
			foreach ($all_plans as $key => $value){
				foreach ($hotel_plans as $key2 => $value2){
					if ($value['plan_id'] == $value2['plan_id']) {
						unset($all_plans[$key]); 
					}
				}
			}
			$all_plans = array_values($all_plans);
			if (count($all_plans) == 0){
				echo ('esta vacio');
			}
			else {
				$data['query'] = $this->hotels->find($hotel_selected_id);
				$data['plans'] = $all_plans;
				$this->load->view('associate_plan',$data);
			}
			
		}
		else
		{
			$data2['plan_id'] = $_POST["plans"];
			$data2['hotel_id'] = $_POST["hotel_id"];
			
			$this->hotels->associate_plan($data2);
			$data['hotel_selected'] = $this->hotels->find($data2['hotel_id']);
			$data['rooms'] = $this->hotels->all_rooms($data2['hotel_id']);
			$data['plans'] = $this->hotels->all_plans($data2['hotel_id']);
			$data['query'] = NULL;
			$this->load->view('management_hotels',$data);	
		}
	}
}

?>