<?php
class participant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('participant_model');
		$this->load->model('participantuser_model');
		$this->load->model('course_model');
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
		$data['participant'] = $this->participant_model->get_participant();
		$data['title'] = 'Participant';
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
		
		$this->load->helper('url');

		$this->load->view('templates/indexadmin', $data);
		$this->load->view('participant/index', $data);
		$this->load->view('templates/footeradmin');
	}
	
	public function viewprofile()
	{
		 
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'View Profile';
		
		
		$this->load->helper('url');

		$this->form_validation->set_rules('user_id', 'User_id', 'required');

		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/indexadmin', $data);
			$this->load->view('participant/index', $data);
			$this->load->view('templates/footeradmin');
			
		}
		else
		{
		
			$userrow = $this->participant_model->get_userid();
		
			$data['user'] = $this->participantuser_model->profileInfo($userrow['id']);
			$data['addr'] = $this->participantuser_model->profileAddr($userrow['id']);
			$data['mobile'] = $this->participantuser_model->profileMobile($userrow['id']);
		
			$data['courses'] = $this->course_model->get_courses();
			
			$this->load->view('templates/indexadmin', $data);
			$this->load->view('participant/viewprofile', $data);
			$this->load->view('templates/footeradmin');
		}
	}

	
}