<?php
class participantprofile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('course_model');
		$this->load->model('participantuser_model');
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
		 
		$data['title'] = 'Profile';
		$this->load->helper('url');
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		
		$data['userid'] = $uid['id'];
		//$data['userid'] = '4';

		$data['user'] = $this->participantuser_model->profileInfo($data['userid']);
		$data['addr'] = $this->participantuser_model->profileAddr($data['userid']);
		$data['mobile'] = $this->participantuser_model->profileMobile($data['userid']);
		
		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantprofile/index', $data);
		$this->load->view('templates/footerparticipant');
	}



	

	

	
	
	
}

?>