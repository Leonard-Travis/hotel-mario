<?php 

class Home extends Controller {
	
	function Home(){
		parent :: Controller();	
		$this->load->helper(array('form','url'));
		$this->load->library('validation');
		$this->load->library(array('form_validation'));
	}

    function index()
    {
		//$this->load->view('home');
		$this->load->view('login');
		
	}
	
	function management()
    {
		//This is the management area where the user will be able to manage (add,modify and delete) rooms, plans, hotels (hotels can not be eliminated) etc.
		
		$this->load->view('management');
		
	}
}

?>