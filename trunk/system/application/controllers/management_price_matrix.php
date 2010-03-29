<?php 

class Management_price_matrix extends Controller {
	
	function Management_price_matrix (){
		parent :: Controller();	
		$this->load->helper(array('form'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
		$this->load->model('hotels');
	}

    function index()
    {
		$rules['hotels']	= "required";
		$this->validation->set_rules($rules);
		$data['hotel_selected'] = NULL;

		if ($this->validation->run() == FALSE)
		{
			$data['query'] = $this->hotels->all_hotels();
			$this->load->view('management_price_matrix',$data);
		}
		else
		{
			$hotel_selected_id = $_POST["hotels"];
			$data['query'] = $this->hotels->all_hotels();
			$data['plans'] = $this->hotels->all_plans($hotel_selected_id);
			$data['hotel_selected'] = $this->hotels->find($hotel_selected_id);
			$this->load->view('management_price_matrix',$data);			
			
		}
	}
}

?>