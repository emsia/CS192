<?php
class managerhome extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
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
		
		$this->load->helper('url');

		$this->load->view('templates/indexmanager', $data);
		$this->load->view('adminhome/index', $data);
		$this->load->view('templates/footer');
	}



	

	

	
	
	
}

?>