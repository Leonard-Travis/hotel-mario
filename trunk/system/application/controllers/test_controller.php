<?php 
class Test_controller extends Controller {

	function Test_controller (){
		parent :: Controller();	
	}
	
	function index (){
		$this->load->view('client');
	}

}
?>