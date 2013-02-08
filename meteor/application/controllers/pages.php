<?php

class pages extends CI_Controller{
	
	public function __construct(){
			parent::__construct();
			$this->load->model(array('login_model','course_model'));
			$this->load->helper('url');
			$this->load->library(array('form_validation','session'));
	}

	public function index(){
		if(!$this->islogged()){
			$data['title'] = "Login";
			$data['error'] = " ";
			
			$this->load->view('templates/indexheader',$data);
			$this->load->view('pages/login',$data);
			$this->load->view('templates/footer');
		}
		else{
			redirect("http://meteor.upitdc.edu.ph/index.php/course");
		}
	}
	
	public function invalid(){
		$data['title'] = "Validation";
		$this->load->view('templates/indexheader',$data);
		$this->load->view('pages/validate');
		$this->load->view('templates/footer');
	}
	
	public function courselist(){
		$data['courses'] = $this->course_model->get_courses();
		$data['cancelled'] = $this->course_model->get_cancelledCourses();
		$data['title'] = 'Course List';
		
		$this->load->helper('url');

		$this->load->view('templates/indexheader', $data);
		$this->load->view('pages/courselist', $data);
		$this->load->view('templates/footer');
	}
	
	public function enroll(){
		if( !$this->islogged() ){
				$user = $this->session->userdata('user'); //Scan?
		}
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
	}
	
	public function submit(){
		$config = array(
			array(
				'field'   => 'fname', 
                'label'   => 'First name', 
                'rules'   => 'required'
            ),
            array(
				'field'   => 'lname', 
				'label'   => 'Last name', 
				'rules'   => 'required'
            ),
			array(
				'field'   => 'mail', 
				'label'   => 'Email', 
				'rules'   => 'required|valid_email|matches[mailconf]|is_unique[users.username]'
            ),
			array(
				'field'   => 'mailconf', 
				'label'   => 'Email Confirm', 
				'rules'   => 'required|valid_email'
            ),
			array(
				'field'   => 'pass', 
				'label'   => 'Password', 
				'rules'   => 'required|matches[passconf]|min_length[6]'
            ),
			array(
				'field'   => 'passconf', 
				'label'   => 'Password Confirm', 
				'rules'   => 'required|min_length[6]'
            )
        );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$this->login_model->putData();
			$this->invalid();
		}
	}
	
	public function login(){
		$config = array(
			array(
				'field'   => 'user', 
                'label'   => 'Username', 
                'rules'   => 'required|valid_email'
            ),
            array(
				'field'   => 'pword', 
				'label'   => 'Password', 
				'rules'   => 'required'
            )
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$uname = $this->input->post('user');
			$pword = $this->input->post('pword');
			if(!$this->login_model->verifyLog($uname,$pword)){
				$data['title'] = "Login";
				$data['error'] = "Invalid username and/or password";
				$this->load->view('templates/indexheader',$data);
				$this->load->view('pages/login');
				$this->load->view('templates/footer');
			}
			else{
				$this->log($uname);
				$result = $this->login_model->getuid($uname);
				if($result['role'] == 0) redirect('http://meteor.upitdc.edu.ph/index.php/course');	
				else if($result['role'] == 1) redirect('http://meteor.upitdc.edu.ph/index.php/managercourse');
				else if($result['role'] == 2) redirect('http://meteor.upitdc.edu.ph/index.php/participantcourse');
			}
		}
	}
	
	public function checkpw($rand){
		if($this->login_model->isReal($rand)){
			$user = $this->login_model->getuser($rand);
			$this->log($user['username']);
			redirect('http://meteor.upitdc.edu.ph/index.php/changepword');		}
		else $this->index();
	
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('http://meteor.upitdc.edu.ph/index.php/pages');
	}
	
	private function log($uname){
		$this->session->set_userdata('logged',true);
		$this->session->set_userdata('username',$uname);
	}
	
	public function validate($i){
		$result = $this->login_model->setValidation($i);
		$this->log($result['username']);
		redirect('http://meteor.upitdc.edu.ph/index.php/participantcourse');
	}
	
	
	public function aboutus(){
	
		$data['title'] = "About Us";
		
		$this->load->view('templates/aboutus',$data);
		
		
	}
	public function search_find(){
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Results";
		$a = array();
		$a['counter']=0;
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
		
		$result = $this->course_model->get_results($data, 'courses');

		foreach($result->result() as $row)
		{
			$a['id'][] = $row->id;
			$a['name'][] = $row->name;
			$a['description'][] = $row->description;
			$a['start'][] = $row->start;
			$a['end'][] = $row->end;
			$a['venue'][] = $row->venue;
			$a['cost'][] = $row->cost;
			$a['reserved'][] = $row->reserved;
			$a['available'][] = $row->available;
			$a['paid'][] = $row->paid;
			$a['counter']++;
		}
		$this->load->helper('url');
		
		$this->load->view('templates/indexheader', $data);
		$this->load->view('pages/search_find', $a);
		$this->load->view('templates/footer');
	}
	
	public function link( $num )
	{
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
		
		$data['letter'] = $num;
			
		$config = array();
		$config['total_rows'] = $this->course_model->record_count();
		$config['per_page'] = $this->course_model->record_count();
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0 ;
		$data['courses'] = $this->course_model->fetch_courses( $data['letter'], $config['per_page'], $page);
		$data['title'] = 'Course List';
			
		$this->load->view('templates/indexheader', $data);
		$this->load->view('pages/courselist', $data);
		$this->load->view('templates/footer');
	}
}