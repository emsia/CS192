<?php
class managerprofile extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
		$this->load->model('profile_model');
		
			
		$this->load->model('validation_model', 'vm');
		$this->load->model('login_model');
		$this->load->library('session');
		$this->load->helper('url');
		
		if($this->islogged() == false){
			redirect("http://meteor.upitdc.edu.ph/index.php/pages");
		}
		if(!$this->login_model->isValid($this->session->userdata('username'))){
			redirect("http://meteor.upitdc.edu.ph/index.php/pages/invalid");
		}
	
	}
	  

	public function index()
	{
		// 
		$data['title'] = 'Manager';
	//	$input = $this->profile_model->getInfo($this->session->userdata('username'));

	//	$data['username'] = $input->username;
	//	$data['first'] = $input->firstname;
	//	$data['last'] = $input->lastname;

		$this->load->view('templates/indexmanager', $data);
		$this->load->view('managerprofile/index',$data);
		$this->load->view('templates/footerman');
	}



	

	

	
	
	
}

?>