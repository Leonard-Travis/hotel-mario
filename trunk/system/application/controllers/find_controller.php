<?php 
class Find_controller extends Controller {
	
	function Find_controller (){
		parent :: Controller();
	}

    function index()
    { 
		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
				
			$ci_client = $_POST["ci_client"];
			echo ($ci_client);
			/*$this->load->model('find_model');
			$data['client'] = $this->find_model->index($ci_client);
			$this->load->view('asociar_client',$data);*/
	}
}


?>